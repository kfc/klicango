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
                    $('.banner-upload').styler({browseText: 'Add banner photo'});

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
});

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