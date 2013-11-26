var last_search;
// redirect from Facebook canvas
if (top.location!= self.location) {
    top.location = self.location
}

$(function() {
    $( ".popup" )
      .click(function(e) {
        e.preventDefault();
        if(!$('#dialog-' + e.target.id).length) {
            $.ajax({
               type: 'GET',
               dataType: 'html',
               url: '/dialog/open',
               data: {id: e.target.id},
               success : function (data, textStatus, jqXHR) {   
                    $('body').append(data);
               }, 
               complete : function (jqXHR, textStatus) {  
                    $('#dialog-' + e.target.id).dialog({
            		  autoOpen: false,
                      width: $('#dialog-' + e.target.id).attr('width'),
                      height: 'auto',
            		  modal: true
            		});
                    
                    $("select").styler();
                    $('input[type="checkbox"]').styler();
                    
                    $('.profile-upload').styler({browseText: 'Add profile photo'});
                    $('.profile-upload-update').styler({browseText: 'Change profile photo'});
                    $('.banner-upload').styler({browseText: 'Add banner photo'});
                    $('.banner-upload-update').styler({browseText: 'Add more photos'});

                    var dialog_id = e.target.id;
                    $('#dialog-' + e.target.id + ' input[type="submit"]').click(function(e){  
                        e.preventDefault();
                        validateRemote(dialog_id, e);
                    });
                    $('#dialog-' + e.target.id).dialog('open');

               }, 
            });    
        } else {
            $('#dialog-' + e.target.id).dialog('open');    
        }
        
        
    });  
    
    $(".accaunt-name > a, .accaunt-thumbnail > a").bind('click', function(e){
		e.preventDefault();
		if ($(this).hasClass('active') == false){
			$("#accaunt-menu").show();
			$(".accaunt-name > a, .accaunt-thumbnail > a").addClass("active");
		} else {
			$("#accaunt-menu").hide();
			$(".accaunt-name > a, .accaunt-thumbnail > a").removeClass("active");
		}
		
	});  


	$(".scroll-pane").hide();
	$( "#create-event-form #add-friends")
		  .click(function(e) {
			e.preventDefault();
            $("#search-friends").show();
            loadFriends(0, 10);
			//$(".scroll-pane").slideDown("normal");
	});
    
    $('#create-event-form #search-friends').keyup(function () {
        if(this.value.length > 1) {
           last_search = this.value;
           var current_search = this.value;
           $('.search-for-friends').addClass('loading');
           $.ajax({
               type: 'GET',
               dataType: 'html',
               url: '/friends/find',
               data: {"search": this.value},
               success : function (data, textStatus, jqXHR) {
                    if(last_search == current_search) {
                        $('.mCSB_container').html('');
                        $('.mCSB_container').append(data);                
                        
                        $(".scroll-pane").hide();
                    }                    
               }, 
               complete : function (jqXHR, textStatus) {
                    if(last_search == current_search) {
                        $(".scroll-pane").show();
            			$(".ui-dialog.ui-widget.ui-widget-content.ui-corner-all.ui-front.ui-draggable.ui-resizable").css({"height" : 695, 'top' : 50});
            			$(".ui-dialog-content.ui-widget-content").css({"height" : 620});
            			$(".scroll-pane").mCustomScrollbar("update"); //update scrollbar according to newly loaded content
            			$('.search-for-friends').removeClass('loading');
                        //$(".scroll-pane").mCustomScrollbar("scrollTo","top",{scrollInertia:200}); //scroll to top
                    }  
               }, 
            }); 
        }
    });
});

function loadFriends(offset, limit) {
    if (offset == 0 && $("#create-event-form div.scroll-pane.mCustomScrollbar").length) {
        $("#create-event-form .scroll-pane").show();
        $(".ui-dialog.ui-widget.ui-widget-content.ui-corner-all.ui-front.ui-draggable.ui-resizable").css({"height" : 695, 'top' : 50});
        $(".ui-dialog-content.ui-widget-content").css({"height" : 620});    			
    } else {
        $.ajax({
           type: 'GET',
           dataType: 'html',
           url: '/friends/load',
           data: {"offset": offset, "limit": limit},
           success : function (data, textStatus, jqXHR) {
                $('#create-event-form .show_more').remove();
                
                if ($("#create-event-form div.scroll-pane.mCustomScrollbar").length) {
                    $('#create-event-form .mCSB_container').append(data);
                } else {
                    $('#create-event-form .scroll-pane').append(data);
                    $("#create-event-form div.scroll-pane").mCustomScrollbar({
                        scrollButtons:{
                        	enable:true
                        }
                    });    
                }                
                
                $("#create-event-form .scroll-pane").hide();
           }, 
           complete : function (jqXHR, textStatus) {  
                $("#create-event-form .scroll-pane").show();
	              $(".ui-dialog.ui-widget.ui-widget-content.ui-corner-all.ui-front.ui-draggable.ui-resizable").css({"height" : 695, 'top' : 50});
    			      $(".ui-dialog-content.ui-widget-content").css({"height" : 620});
    			      $("#create-event-form .scroll-pane").mCustomScrollbar("update"); //update scrollbar according to newly loaded content
    			     //$(".scroll-pane").mCustomScrollbar("scrollTo","top",{scrollInertia:200}); //scroll to top  
           }, 
        }); 
    } 
}

function validateRemote(id, data) {
    var datastring = $('#dialog-' + id + ' form').serialize();
    $.ajax({
        type: 'POST',
        dataType: 'json',
        url: '/dialog/validate',
        data: datastring + '&id=' + id,
        success : function (data, textStatus, jqXHR) {
            parseResults(id, data);
        },
        complete : function (jqXHR, textStatus) {
            $("select").styler();
            $('input[type="checkbox"]').styler();
        }
    }); 
               
}

function parseResults(dialog_id, data) {
    $('#dialog-' + dialog_id + ' .error').removeClass('error');
    if (data.success == false) {
        if (!$('#dialog-' + dialog_id + ' .error-message').length) {
            $('#dialog-' + dialog_id + ' form').before('<div class="error-message">' + data.message + '</div>');
        }
        
        $(data.id).each(
            function() {
                $('#dialog-' + dialog_id + ' input[name="' + this + '"]').addClass('error');
                $('#dialog-' + dialog_id + ' select[name="' + this + '"]').addClass('error');
                $('#dialog-' + dialog_id + ' select[checkbox="' + this + '"]').addClass('error');
            }
        );        
    } else {
        if (data.action == 'redirect') {
            redirectPage(data.value);
        } else if (data.action == 'submit') {
            submitForm(dialog_id);
        }
    }
}

function redirectPage(url) {
    document.location = url;
}

function submitForm(dialog_id) {
    $('#dialog-' + dialog_id + ' form').submit();
}

function showDialog(dialog_id) {
    if(!$('#dialog-' + dialog_id).length) {
        $.ajax({
           type: 'GET',
           dataType: 'html',
           url: 'dialog/open',
           data: {id: dialog_id},
           success : function (data, textStatus, jqXHR) { 
                $('body').append(data);
           }, 
           complete : function (jqXHR, textStatus) {  
                $('#dialog-' + dialog_id).dialog({
        		  autoOpen: false,
                  width: $('#dialog-' + dialog_id).attr('width'),
                  height: 'auto',
        		  modal: true
        		});
                
                $("select").styler();
                $('input[type="checkbox"]').styler();
                $('.profile-upload').styler({browseText: 'Add profile photo'});
                $('.banner-upload').styler({browseText: 'Add banner photo'});

                $('#dialog-' + dialog_id + ' input[type="submit"]').click(function(e){  
                    e.preventDefault();
                    validateRemote(dialog_id, e);
                });
                $('#dialog-' + dialog_id).dialog('open');
           }, 
        });    
    } else {
        $('#dialog-' + dialog_id).dialog({
    	  autoOpen: false,
          width: $('#dialog-' + dialog_id).attr('width'),
          height: 'auto',
    	  modal: true
    	});
        $('#dialog-' + dialog_id).dialog('open');    
    }
}

function inviteFriend(object, id, local) {
    var form_id = $(object).closest('form').attr('id');
    
    if($('#' + form_id + ' #invite_' + id).length) {
        $('#' + form_id + ' #invite_' + id).remove();
        $(object).removeClass('already-invited');
        $(object).addClass('invite-friend');
        $(object).text('Invite friend');
    } else {
        
        if (local == 1) {
            title = 'local';
        } else {
            title = 'facebook';
        }
        
        $('#' + form_id).append('<input type="hidden" title="' + title + '" name="invite[]" id="invite_' + id + '" value="' + id + '">');
        $(object).removeClass('invite-friend');
        $(object).addClass('already-invited');
        $(object).text('Friend invited');
    }
}

function processInvitation(response, event_id) {
    if($(response).length && $(response.to).length) {
        $.ajax({
           type: 'GET',
           dataType: 'json',
           url: '/friends/invite',
           data: {"to": response.to, "event_id": event_id},
           success : function (data, textStatus, jqXHR) { 
               //alert('success');
           },
        });
    }
}

function initLocalRequest(ids, event_id) {
    if (ids.length) {
        $.ajax({
           type: 'GET',
           dataType: 'json',
           url: '/friends/invite_local',
           data: {"to": ids, "event_id": event_id},
           success : function (data, textStatus, jqXHR) { 
               //alert('success');
           },
        });
    }
}

function initRequest(ids, event_id) {
    if (ids.length) {
        $.ajax({
           type: 'GET',
           dataType: 'json',
           url: '/friends/check_facebook_invite',
           data: {"to": ids, "event_id": event_id},
           success : function (data, textStatus, jqXHR) { 
               if(data.success == true && data.ids.length) {
                    ids = data.ids;
                    if (typeof FB == 'object') {
                        FB.ui({method: "apprequests",
                          message: "Dear friend! Please join me on Klicango to always stay in touch and share with me the best parties and places.",
                          display: "iframe",
                          to: ids
                        }, function(response){
                            processInvitation(response, event_id);   
                        });
                    } else {
                        setTimeout(function(){
                            initRequest(ids, event_id);   
                        }, 1000);
                    }     
               }
           },
        });
    }
}

function setActiveEvent(event_id) {
    if($('#top-event-list #active_event').length) {
       $('#top-event-list #active_event').val(event_id); 
    } else {
        $('#top-event-list').append('<input id="active_event" type="hidden" name="active_event" value="' + event_id + '">');
    }
}

function loadJoinFriends(offset, limit) {
        $.ajax({
           type: 'GET',
           dataType: 'html',
           url: '/friends/join',
           data: {"offset": offset, "limit": limit, "invite" : "true"},
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
    $("#invite-friends-form #search-friends").show();
}

function inviteJoinFriend(object, id, local) {
    var form_id = $(object).closest('form').attr('id');
    
    if($('#invite_' + id).length) {
        $('#' + form_id + ' #invite_' + id).remove();
        $(object).removeClass('already-invited');
        $(object).addClass('invite-friend');
        $(object).text('Invite friend');
    } else {
        
        if (local == 1) {
            title = 'local';
        } else {
            title = 'facebook';
        }
        
        $('#' + form_id).append('<input type="hidden" title="' + title + '" name="invite[]" id="invite_' + id + '" value="' + id + '">');
        $(object).removeClass('invite-friend');
        $(object).addClass('already-invited');
        $(object).text('Friend request sent');
    }
}

function processJoinInvitation(response) {
    if($(response).length && $(response.to).length) {
        $.ajax({
           type: 'GET',
           dataType: 'json',
           url: '/friends/invite',
           data: {"to": response.to},
           success : function (data, textStatus, jqXHR) { 
               //alert('success');
           },
        });
    }
}

function initLocalJoinRequest(ids) {
    if (ids.length) {
        $.ajax({
           type: 'GET',
           dataType: 'json',
           url: '/friends/invite_local',
           data: {"to": ids},
           success : function (data, textStatus, jqXHR) { 
               //alert('success');
           },
        });
    }
}

function initJoinRequest(ids) {
    if (ids.length) {
        $.ajax({
           type: 'GET',
           dataType: 'json',
           url: '/friends/check_facebook_invite',
           data: {"to": ids},
           success : function (data, textStatus, jqXHR) { 
               if(data.success == true && data.ids.length) {
                    ids = data.ids;
                    if (typeof FB == 'object') {
                        FB.ui({method: "apprequests",
                          message: "Dear friend! Please join me on Klicango to always stay in touch and share with me the best parties and places.",
                          display: "iframe",
                          to: ids
                        }, function(response){
                            processJoinInvitation(response);   
                        });
                    } else {
                        setTimeout(function(){
                            initJoinRequest(ids);   
                        }, 1000);
                    }     
               }
           },
        });
    }
}
