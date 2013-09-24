$(function() {   
    $("#create-event-form" ).dialog({
    autoOpen: false,
    height: 442,
    width: 484,
    modal: true
  });
 
  $("#create-event-link")
    .click(function(e) {
    e.preventDefault();
    $('#create-event-form .profile-upload').styler({browseText: 'Add event photo'});
    $( "#create-event-form" ).dialog( "open" );
  });
  
  $("#modify-event-link")
    .click(function(e) {
    e.preventDefault();
    $( "#create-event-form" ).dialog( "open" );
  });
  
  
  $("#form_create_event input[type='submit']").click(function(e){  
    e.preventDefault();
    var form = $("#form_create_event");
    console.log( $(form).serialize());
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
            $(".going-status-button a").html(Drupal.t("Add to calendar"));  
          }
        }
        else{ 
         alert('error acting the event');
        }
      }
    });
 });
 
 
 $(".hover-wrapper a.add-event-from-calendar").on('click',function(e){
  e.preventDefault();
  var event_id = $(this).attr('id').replace('add-event-from-calendar-','');  
  $.ajax({
    type: "POST",
    url: '/add_event_for_user',
    data:  {'event_id' : event_id},
    dataType: 'json',
    success: function(data){
      if(data.success){
        $("#add-event-from-calendar-"+event_id).parent().append('<div class="event-location">Event added</div>');
         $("#add-event-from-calendar-"+event_id).remove(); 
      }
      else{ 
       alert('error acting the event');
      }
    }
  }); 
   
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
 
  
 });