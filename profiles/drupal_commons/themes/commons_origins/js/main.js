$(function() {
    $( ".popup" )
      .click(function(e) {
        e.preventDefault();
        if(!$('#dialog-' + e.target.id).length) {
            $.ajax({
               type: 'GET',
               dataType: 'html',
               url: 'dialog/open',
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
    
    $("div.scroll-pane").mCustomScrollbar({
		scrollButtons:{
			enable:true
		}
	});

	$(".scroll-pane").hide();
	$( "#create-event-form #add-friends")
		  .click(function(e) {
			e.preventDefault();
            loadFriends();
			//$(".scroll-pane").slideDown("normal");
	});
});

function loadFriends() {
    $.ajax({
       type: 'GET',
       dataType: 'html',
       url: 'friends/load',
       data: {offset: 0, limit: 10},
       success : function (data, textStatus, jqXHR) {   
            $('.scroll-pane').append(data);
            $("div.scroll-pane").mCustomScrollbar({
                scrollButtons:{
                	enable:true
                }
            });
            
            $(".scroll-pane").hide();
       }, 
       complete : function (jqXHR, textStatus) {  
            $(".scroll-pane").show();
			$(".ui-dialog.ui-widget.ui-widget-content.ui-corner-all.ui-front.ui-draggable.ui-resizable").css({"height" : 675, 'top' : 150});
			$(".ui-dialog-content.ui-widget-content").css({"height" : 600});
			$(".scroll-pane").mCustomScrollbar("update"); //update scrollbar according to newly loaded content
			$(".scroll-pane").mCustomScrollbar("scrollTo","top",{scrollInertia:200}); //scroll to top  
       }, 
    });   
}

function validateRemote(id, data) {
    var datastring = $('#dialog-' + id + ' form').serialize();
    $.ajax({
        type: 'POST',
        dataType: 'json',
        url: 'dialog/validate',
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

function inviteFriend(object, id) {
    if($('#form_create_event #invite_' + id).length) {
        $('#invite_' + id).remove();
        $(object).removeClass('already-invited');
        $(object).addClass('invite-friend');
        $(object).text('Invite friend');
    } else {
        $('#form_create_event').append('<input type="hidden" name="invite[]" id="invite_' + id + '" value="' + id + '">');
        $(object).removeClass('invite-friend');
        $(object).addClass('already-invited');
        $(object).text('Friend invited');
    }
}

function processInvitation(response, event_id) {
    if($(response.to).length) {
        $.ajax({
           type: 'GET',
           dataType: 'json',
           url: 'friends/invite',
           data: {"to": response.to, "event_id": event_id},
           success : function (data, textStatus, jqXHR) { 
               alert('success');
           },
        });
    }
}

function initRequest(ids, event_id) {
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
        }, 3000);
    }
}