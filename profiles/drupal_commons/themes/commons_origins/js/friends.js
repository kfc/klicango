$(function() { 

$(".follow-place-action").click(function(e){
  e.preventDefault();
  var link = $(this);
  var name = $(this).attr('title');
  var id = $(this).attr('id');
  if((id == 'follow-place-calendar') || (id == 'unfollow-place-calendar' && confirm("Are you sure you don't want follow "+name+" anymore?"))){
    $.ajax({
        type: "POST",
        url: $(this).attr('href'),
        dataType: 'json',
        success: function(data){
          if(data.success){ 
            if($(link).parent().hasClass('i-like-this-place')){
              $(link).parent().removeClass('i-like-this-place');    
              $(link).parent().addClass('add-to-calendar');  
              $(link).attr('href', $(link).attr('href').replace('unfollow','follow'));
              $(link).removeClass('white-button');
              $(link).addClass('black-button');
              
              $(link).html(Drupal.t('Follow this place'));  
              $(link).attr('id', 'follow-place-calendar');
            } 
            else{
               $(link).parent().addClass('i-like-this-place');    
               $(link).parent().removeClass('add-to-calendar');  
               $(link).attr('href', $(link).attr('href').replace('follow','unfollow'));
               $(link).html(Drupal.t('I like this place'));  
               $(link).removeClass('black-button');
               $(link).addClass('white-button');
               $(link).attr('id', 'unfollow-place-calendar');
            }
          }
          else{ 
            alert('Error. Please try again later.');  
          }
        },
      });
  }
});


$(".follow-user-action").click(function(e){
  e.preventDefault();
  var link = $(this);
  var name = $(this).attr('title');
  var id = $(this).attr('id');
  if((id == 'follow-user-calendar') || (id == 'unfollow-user-calendar' && confirm("Are you sure you don't want to be friend with "+name+" anymore?")))
  {
    $.ajax({
        type: "POST",
        url: $(this).attr('href'),
        dataType: 'json',
        success: function(data){
          if(data.success){ 
            if($(link).parent().hasClass('i-like-this-place')){
              $(link).parent().removeClass('i-like-this-place');    
              $(link).parent().addClass('follow-this-place');  
              $(link).attr('href', $(link).attr('href').replace('removefriend','addfriend'));
              $(link).attr('id', 'follow-user-calendar');
              $(link).html(Drupal.t('Add as friend'));  
            } 
            else{
               $(link).parent().addClass('i-like-this-place');    
               $(link).parent().removeClass('follow-this-place');  
               $(link).attr('href', $(link).attr('href').replace('addfriend','removefriend'));
               $(link).attr('id', 'unfollow-user-calendar');
               $(link).html(Drupal.t('Invitation pending'));  
            }
          }
          else{ 
            alert('Error. Please try again later.');  
          }
        },
    });
  }
});


$(".action-friend-user-page").click(function(e){
  e.preventDefault();
  var href=$(this).attr('href');  
  var id=$(this).attr('id');  
  var name=$(this).attr('title');
                                                
  if((id == 'remove-friend-user-page' && confirm("Are you sure you don't want to be friend with  "+name+" anymore")) || (id == 'add-friend-user-page')){
    $.ajax({
          type: "POST",
          url: href,
          dataType: 'json',
          success: function(data){
            if(data.success == true){
              if(id == 'remove-friend-user-page'){
                $("#remove-friend-user-page").attr('href',$("#remove-friend-user-page").attr('href').replace('/removefriend','/addfriend'));
                $("#remove-friend-user-page").addClass('black-button');
                $("#remove-friend-user-page").removeClass('white-button');
                $("#remove-friend-user-page").text(Drupal.t('Add friend'));
                $("#remove-friend-user-page").attr('id','add-friend-user-page');
                
              } 
              else if(id == 'add-friend-user-page'){
                $("#add-friend-user-page").attr('href',$("#add-friend-user-page").attr('href').replace('/addfriend','/removefriend'));
                $("#add-friend-user-page").addClass('white-button');
                $("#add-friend-user-page").removeClass('black-button');
                $("#add-friend-user-page").text(Drupal.t('Invitation sent'));
                $("#add-friend-user-page").attr('id','remove-friend-user-page');
                
              } 
              
              
            }
          }
    });
  }
  //addfriend/%  
    
  
});




});


function declineFriend(user_id) {
    $.ajax({
       type: 'GET',
       dataType: 'json',
       url: '/friend/decline',
       data: {"sender_id": user_id},
       success : function (data, textStatus, jqXHR) {
            if (data.status == true) {
                $('#user_' + user_id).closest('tr').hide('slow');
                if ($('#user_' + user_id).closest('table').find('tr').length == 1) {
                    $('#new-friends-list').remove();
                    $('#content').prepend('<div style="margin-bottom: 10px;"></div>');
                } else {
                    $('#user_' + user_id).closest('tr').remove();    
                }
            }
       },  
    });
}

function acceptFriend(event_id) {
    var status;
    $('.add-user-link#user_' + event_id).toggleClass('already-accepted');
    if($('.add-user-link#user_' + event_id).hasClass('already-accepted')) {
       $('.add-user-link#user_' + event_id).text('Accepted'); 
       status = 'accepted';
    } else {
        var name = $('.add-user-link#user_' + event_id).attr('title');
        if(confirm("Are you sure you don't want to be friend with  "+name+" anymore")){
          $('.add-user-link#user_' + event_id).text('Accept');
          status = 'new';
        }
        else 
          status = false;
    }
    if(status != false){
      $.ajax({
         type: 'GET',
         dataType: 'json',
         url: '/friend/accept',
         data: {"sender_id": event_id, "status": status},
         success : function (data, textStatus, jqXHR) {
              if (data.status == true) {
                  //to do
              }
         },  
      });
    }
}

function showFriendsInCommon(user_id) {
  if ($('#invite-friends-form').length) {
    $('#invite-friends-form').dialog("destroy");
    $('#invite-friends-form').remove();
  }
  $.ajax({
     type: 'GET',
     dataType: 'html',
     url: '/friends_in_common/list',
     data: {"uid": user_id},
     success : function (data, textStatus, jqXHR) { 
         $('body').append(data);
         
         $("#invite-friends-form.user-" + user_id).dialog({
            autoOpen: false,
            width: 484,
            modal: true,
            position: ['middle',120],
            close: function() {
             $("#invite-friends-form.user-" + user_id + " .scroll-pane").hide();
             $("#invite-friends-form.user-" + user_id + " #search-friends").hide();
            }
          });
         
          $("#invite-friends-form.user-" + user_id +" div.scroll-pane").mCustomScrollbar({
              scrollButtons:{
                enable:true
              }
          });
          
          $("#invite-friends-form.user-" + user_id).dialog('open');
     },
  });
}