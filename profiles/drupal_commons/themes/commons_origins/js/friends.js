$(function() { 

$(".follow-place-action").click(function(e){
  e.preventDefault();
  var link = $(this);
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
            $(link).html(Drupal.t('Follow this place'));  
          } 
          else{
             $(link).parent().addClass('i-like-this-place');    
             $(link).parent().removeClass('add-to-calendar');  
             $(link).attr('href', $(link).attr('href').replace('follow','unfollow'));
             $(link).html(Drupal.t('I like this place'));  
          }
        }
        else{ 
          alert('Error. Please try again later.');  
        }
      },
    });
});




















});