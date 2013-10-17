jQuery.fn.center = function(parent) {
  if (parent) {
      parent = this.parent();
  } else {
      parent = window;
  }
  this.css({
      "position": "fixed",
      //"top": ((($(parent).height() - this.outerHeight()) / 2) + $(parent).scrollTop() + "px"),
      "left": ((($(parent).width() - this.outerWidth()) / 2) + $(parent).scrollLeft() + "px")
  });
  return this;
}
jQuery.fn.absCenter = function(parent) {
        if (parent) {
            parent = this.parent();
        } else {
            parent = window;
        }
        var img = this.siblings('img')[0];
        this.css({
            "position": "absolute",
            "top": ((($(parent).height() - this.outerHeight()) / 2) + $(parent).scrollTop() + "px"),
            //"left": ((($(parent).width() - this.outerWidth()) / 2) + $(parent).scrollLeft() + "px")
        });
    return this;
    }



$(function() {
  //POPUP HIDE
      $("#photo-overlay").hide();
      $("#photo-box").hide();

      function loadPhotoComments(link){
        $("#comment-wrapper").html('');
        var url = $(link).attr("href"); 
        $.ajax({
          type: "POST",
          url: url,
          dataType: 'json',
          success: function(data){
            $(link).addClass("processed");
            $("#photo-box #photo-wrapper img").attr("src", data.image.src).load(function(){$("#photo-box #photo-wrapper a").absCenter(true)});
            var height = $("#wrapper").height();
            $("#photo-overlay").css({"position" : "absolute"}).css({"left" : 0}).css({"top" : 0}).css({"width" : "100%"}).css({"min-height" : "100%"}).css({"z-index" : 2000}).css({"height" : height}).show();
            $("#photo-box").show().center(true);
            
            $("#photo-box #photo-wrapper a#next-photo").attr('href','/event_photo/75/218');
            $("#photo-box #photo-wrapper a#prev-photo").attr('href','/event_photo/75/217');
            
            $("#comment-wrapper").html(data.author + data.comments);
            
            if(data.prev_url != '')
              $("#photo-box #photo-wrapper a#prev-photo").attr('href',data.prev_url).show();
            else
              $("#photo-box #photo-wrapper a#prev-photo").hide();  
              
            
            if(data.next_url != ''){
              $("#photo-box #photo-wrapper a#next-photo").attr('href',data.next_url).show();
            }
            else
              $("#photo-box #photo-wrapper a#next-photo").hide();      
            
          },
        });  
        
      }

      // POPUP SHOW
      $("a.klicango-popup").bind('click', function(e){
        e.preventDefault();
        loadPhotoComments(this);
        
        
       /* 
        var imgURL = $(this).attr("href");
        var height = $("#wrapper").height();

        $(this).addClass("processed");
        $("#photo-box #photo-wrapper img").attr("src", imgURL);
        $("#photo-overlay").css({"position" : "absolute"}).css({"left" : 0}).css({"top" : 0}).css({"width" : "100%"}).css({"min-height" : "100%"}).css({"z-index" : 2000}).css({"height" : height}).show();
        $("#photo-box").show().center(true);
        $("#photo-box #photo-wrapper a").absCenter(true);  */
      });
      
      // PREV PHOTO
      $("#photo-box #photo-wrapper a#prev-photo").bind('click', function(e){
        e.preventDefault();
        loadPhotoComments(this);
      });  

      // NEXT PHOTO
      $("#photo-box #photo-wrapper a#next-photo").bind('click', function(e){
        e.preventDefault();
        loadPhotoComments(this);
      }); 
      
      $("#close-box a").bind('click', function(e){
        e.preventDefault();
        $("a.klicango-popup").removeClass("processed");
        $("#photo-overlay").hide();
        $("#photo-box").hide();
      });

       
      
});
