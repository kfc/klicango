$(function() {   
  $("#create-event-form" ).dialog({
    autoOpen: false,
    height: 442,
    width: 484,
    modal: true,
    close: function() {
     $(".scroll-pane").hide();
     $("#search-friends").hide();
      }
  });
  
  $("#invite-friends-form" ).dialog({
    autoOpen: false,
    width: 484,
    modal: true,
    close: function() {
     $(".scroll-pane").hide();
     $("#search-friends").hide();
      }
  });
  
  $(".invite-friend")
    .click(function(e) {
    e.preventDefault();
    var event_id = 0;
    if ($(e.target).hasClass('current-event')) {
        event_id = e.target.id;
    }
    loadInviteFriends(0, 10, event_id);
  });
  
  $(".going-users-link")
    .click(function(e) {
    e.preventDefault();
    loadEventUsers('going', e.target.id);
  }); 
  
  $(".invited-users-link")
    .click(function(e) {
    e.preventDefault();
    loadEventUsers('invited', e.target.id);
  }); 
  
  $("#create-event-link")
    .click(function(e) {
    e.preventDefault();
    $('#create-event-form .profile-upload').styler({browseText: 'Add event photo'});
    
   
    $("#create-event-form input[type='text'], #create-event-form input[type='hidden']").each(function(){
      $(this).val(user_data[$(this).attr('name')]);
     // $(this).val('');
    });
    $("#create-event-form textarea").each(function(){
      $(this).val('');
    });

   // $( "#create-event-form" ).dialog( {title:'Create Event'} );
    $( "#create-event-form" ).dialog( "open" );
  });
  
  $("#modify-event-link")
    .click(function(e) {
    e.preventDefault();
    $("#create-event-form input[type='text'], #create-event-form input[type='hidden']").each(function(){
      $(this).val(form_data.data[$(this).attr('name')]);
    });
    $("#create-event-form textarea").each(function(){
      $(this).val(form_data.data[$(this).attr('name')]);
    });
    $("#create-event-form input[type='submit']").each(function(){
      $(this).val('Save');
    });
    
    $('#create-event-form .profile-upload').styler({browseText: 'Change event photo'});
    $( "#create-event-form" ).dialog( {title:'Modify Event'} );
    $( "#create-event-form" ).dialog( "open" );
  });
  
  
  $("#show-events-wrapper" ).dialog({
      autoOpen: false,
      width: 800,
      height: 400,
      modal: true,
      close: function() {
       $(".scroll-pane").hide();
      }
  });
  
  
  $("#form_create_event input[type='submit']").click(function(e){  
    e.preventDefault();
    var form = $("#form_create_event");
    var is_submitted = false;
    $.ajax({
      type: "POST",
      url: '/check_event_form_values',
      data:  $(form).serialize(),
      dataType: 'json',
      success: function(data){
        if(data.isValid){  
          $(form).submit();  
        }
        else{ 
          $("#form_create_event input").removeClass('error')
          $.each(data.errors, function( key, value){
            $("#form_create_event input[name='"+key+"'], #form_create_event textarea[name='"+key+"']").addClass('error');
            //$("#form_create_event input[name='"+key+"'], #form_create_event textarea[name='"+key+"']").attr('placeholder',value);
          });
        }
      },
    });
       
 });
 
 $("#comment_add_photo_link").click(function(e){
   e.preventDefault();
   $("#filesContainer").show();
   var filesNum =  $('input[type="file"]',$('#filesContainer')).length;
   
   $('#filesContainer').append(
    $('<input/>').attr('type', 'file').attr('name', 'files[photo-'+filesNum+']')
    );
  if(filesNum == 0) 
    $(this).html('Add one more photo');  
   //$
 });
 
 $("#event-action-button a").on('click', function(e){
   e.preventDefault();   
   var event_id = $(this).attr('href').replace('/event_action?event_id=','');
   var action = '';
   if($(this).hasClass('add-event-link'))
    action = '/add_event_for_user';
   else 
    action = '/remove_event_for_user'; 
  var event_name = $(this).attr('title');  

  if((action == '/add_event_for_user') ||  (action == '/remove_event_for_user' && confirm("Are you sure you won't participate to "+event_name+" anymore"))){   
     $.ajax({
      type: "POST",
      url: action,
      data:  {'event_id' : event_id},
      dataType: 'json',
      success: function(data){
        if(data.success){
          var $remove_button = $('<a>');
          $remove_button.attr('href', $(".add-event-link").attr('href'));
          $remove_button.addClass('remove-event-link');
          $remove_button.html(Drupal.t("I'm going"));
          
          if($("#event-action-button a").hasClass('add-event-link')){
            $(".going-status-button a").addClass('remove-event-link');
            $(".going-status-button a").removeClass('add-event-link');  
            $(".going-status-button a").html(Drupal.t("I'm going"));
          }
          else{
            $(".going-status-button a").addClass('add-event-link');
            $(".going-status-button a").removeClass('remove-event-link');  
            $(".going-status-button a").html(Drupal.t("Add to my calendar"));  
          }
        }
        else{ 
         alert('error acting the event');
        }
      }
    });
  }
 });
 
    $('#invite-friends-form #search-friends').keyup(function () {
        if(this.value.length > 1) {
           last_search = this.value;
           var current_search = this.value;
           $('#invite-friends-form .search-for-friends').addClass('loading');
           var current_id = 0;
           if($('#invite-friends-form .scroll-pane').length && $('#invite-friends-form .scroll-pane').attr('id')) {
              current_id = $('#invite-friends-form .scroll-pane').attr('id');
           }
           $.ajax({
               type: 'GET',
               dataType: 'html',
               url: '/friends/find',
               data: {"search": this.value, "event_id" : current_id},
               success : function (data, textStatus, jqXHR) { 
                    if(last_search == current_search) {
                        $('#invite-friends-form .mCSB_container').html('');
                        $('#invite-friends-form .mCSB_container').append(data);                
                    
                        $(".scroll-pane").hide();
                    }
               }, 
               complete : function (jqXHR, textStatus) {
                    if(last_search == current_search) {
                      $("#invite-friends-form .scroll-pane").show();
                      $(".ui-dialog.ui-widget.ui-widget-content.ui-corner-all.ui-front.ui-draggable.ui-resizable").css({"height" : 420});
                      $(".ui-dialog-content.ui-widget-content").css({"height" : 495});
                      $("#invite-friends-form .scroll-pane").mCustomScrollbar("update"); //update scrollbar according to newly loaded content
                      $('#invite-friends-form .search-for-friends').removeClass('loading');
                        //$(".scroll-pane").mCustomScrollbar("scrollTo","top",{scrollInertia:200}); //scroll to top
                    }  
               }, 
            }); 
        }
    });
 
 $(".hover-wrapper a.add-event-from-calendar").on('click',function(e){
  e.preventDefault();
  var date = $(this).attr('id').replace('add-event-from-calendar-','').split('-'); 
  date = date[2]+'/'+date[1]+'/'+date[0];
  $("#create-event-form input[name='date']").val(date);  
  $( "#create-event-form" ).dialog( "open" );
 });
 
 
 function setEqualHeight(columns){
   var tallestcolumn = 0;
   columns.each(function()
   {
     currentHeight = $(this).height();
     if(currentHeight > tallestcolumn)
     {
       tallestcolumn  = currentHeight;
     }
   }
 );
 
 columns.height(tallestcolumn);
 
}

  $(".block .calendar-calendar .month-view table tr").each(function(){
    setEqualHeight($(this).find("div.inner"));
  });
 
  $("a.show-events-link").on('click',function(e){
    e.preventDefault();
    var date = $(this).attr('href').substring(18); // crop date part of an URL /show_events?date={date} 

    $( "#show-events-wrapper" ).dialog( "open" );
    
    $.ajax({
           type: 'GET',
           dataType: 'html',
           url: $(this).attr('href'),
           success : function (data) {
            $( "#show-events-wrapper" ).html(data);  
           }
    });
        
    return false;
  });
  
  
  
  
});
 
 function loadInviteFriends(offset, limit, event_id) {
    /*if (offset == 0 && $("#invite-friends-form div.scroll-pane.mCustomScrollbar").length) {
        $("#invite-friends-form .scroll-pane").show();
        $(".ui-dialog.ui-widget.ui-widget-content.ui-corner-all.ui-front.ui-draggable.ui-resizable").css({"height" : 420});
        $(".ui-dialog-content.ui-widget-content").css({"height" : 495}); 
        $( "#invite-friends-form" ).dialog( "open" );   			
    } else { */
        if (typeof $('#invite-friends-form .scroll-pane').attr('id') == 'undefined') {
            $('#invite-friends-form .scroll-pane').attr('id', event_id);
        } else {
            var current = $('#invite-friends-form .scroll-pane').attr('id');
            if (event_id != current) {
                $('#invite-friends-form .mCSB_container').html('');
                $('#invite-friends-form .scroll-pane').attr('id', event_id);
                $('#search-friends').val('');
            }
        }
        $.ajax({
           type: 'GET',
           dataType: 'html',
           url: '/friends/load',
           data: {"offset": offset, "limit": limit, "invite" : "true", "event_id" : event_id},
           success : function (data, textStatus, jqXHR) {
                $('#invite-friends-form .show_more').remove();
                
                if ($("#invite-friends-form div.scroll-pane.mCustomScrollbar").length) {
                    $('#invite-friends-form .mCSB_container').append(data);
                } else {
                    $('#invite-friends-form .scroll-pane').append(data);
                    $("#invite-friends-form div.scroll-pane").mCustomScrollbar({
                        scrollButtons:{
                        	enable:true
                        }
                    });    
                }                
                
                $("#invite-friends-form .scroll-pane").hide();
           }, 
           complete : function (jqXHR, textStatus) {  
              if (offset == 0) {
                  $( "#invite-friends-form" ).dialog( "open" );
                  $('.invite-friend-search').val('')
              }  
              $("#invite-friends-form .scroll-pane").show();
              $(".ui-dialog.ui-widget.ui-widget-content.ui-corner-all.ui-front.ui-draggable.ui-resizable").css({"height" : 420});
              $(".ui-dialog-content.ui-widget-content").css({"height" : 495});
              $("#invite-friends-form .scroll-pane").mCustomScrollbar("update");
           }, 
        }); 
    /*}*/ 
    $("#invite-friends-form #search-friends").show();
}

function preprocessRequest(event_id) {
    $( "#invite-friends-form" ).dialog("close");
    var ids = '';
    var local_ids = '';
    $("#invite-friends-form input[name='invite[]']").each(function(){
        if (this.title == 'facebook') {
            ids += this.value + ',';
        } else {
            local_ids += this.value + ',';
        }
    });
    initRequest(ids, event_id);
    initLocalRequest(local_ids, event_id);
}

function declineEvent(event_id) {
    $.ajax({
       type: 'GET',
       dataType: 'json',
       url: '/invitation/decline',
       data: {"event_id": event_id},
       success : function (data, textStatus, jqXHR) {
            if (data.status == 'success') {
                $('#event_' + event_id).closest('tr').hide('slow');
                if ($('#event_' + event_id).closest('table').find('tr').length == 1) {
                    $('#public-event-list').remove();
                    $('#content').prepend('<div style="margin-bottom: 10px;"></div>');
                } else {
                    $('#event_' + event_id).closest('tr').remove();    
                }
            }
       },  
    });
}

function acceptEvent(event_id) {
    var status;
    $('.add-event-link#event_' + event_id).toggleClass('already-accepted');
    if($('.add-event-link#event_' + event_id).hasClass('already-accepted')) {
       $('.add-event-link#event_' + event_id).text('I am going'); 
       status = 'accepted';
    } else {
        var name = $('.add-event-link#event_' + event_id).attr('title');
        if(confirm("Are you sure you won't participate to "+name+" anymore")){
          $('.add-event-link#event_' + event_id).text('Add to my calendar');
          status = 'new';
        }
        else{
          status = false;
        }
    }
    if(status != false){
      $.ajax({
         type: 'GET',
         dataType: 'json',
         url: '/invitation/accept',
         data: {"event_id": event_id, "status": status},
         success : function (data, textStatus, jqXHR) {
              if (data.status == 'success') {
                  //to do
              }
         },  
      });
    }
}

function loadEventUsers(type, event_id) {
        $('#dialog-' + type).remove();
        $.ajax({
           type: 'GET',
           dataType: 'html',
           url: '/event/users',
           data: {"event_id": event_id, "type": type},
           success : function (data, textStatus, jqXHR) {
                $('body').append(data);
                if ($('#dialog-' + type + 'div.scroll-pane.mCustomScrollbar').length) {
                    $('#dialog-' + type + ' .mCSB_container').append(data);
                } else {
                    $('#dialog-' + type + ' div.scroll-pane').mCustomScrollbar({
                        scrollButtons:{
                        	enable:true
                        }
                    });    
                }
           },  
           complete : function (jqXHR, textStatus) {  
                $('#dialog-' + type).dialog({
        		  autoOpen: false,
                  width: 484,
                  height: 340,
        		  modal: true
        		});
                
                $('#dialog-' + type).dialog('open');

           },
        });
}