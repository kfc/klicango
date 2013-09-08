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

  
 });