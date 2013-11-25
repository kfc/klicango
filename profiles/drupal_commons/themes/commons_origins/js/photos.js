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
        //$("#comment-wrapper").html('');
        
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
              
            bindCommentSubmit();    
            
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
      
      $("#prev-photo-span").hover(
        function(){        
          $(this).siblings("#prev-photo").addClass('hovered');
        },
        function(){
          $(this).siblings("#prev-photo").removeClass('hovered')  
        } 
      );
      
      $("#prev-photo-span").bind('click',function(){
        $(this).siblings("#prev-photo").trigger('click');
        
      }); 

      // NEXT PHOTO
      $("#photo-box #photo-wrapper a#next-photo").bind('click', function(e){
        e.preventDefault();
        loadPhotoComments(this);
      }); 
      
      $("#next-photo-span").hover(
        function(){        
          $(this).siblings("#next-photo").addClass('hovered');
        },
        function(){
          $(this).siblings("#next-photo").removeClass('hovered')  
        } 
      );
      
      $("#next-photo-span").bind('click',function(){
        $(this).siblings("#next-photo").trigger('click');
        
      });
      
      $("#close-box a").bind('click', function(e){
        e.preventDefault();
        $("a.klicango-popup").removeClass("processed");
        $("#photo-overlay").hide();
        $("#photo-box").hide();
      });
      
      
      
      
      function bindCommentSubmit(){ 
        
        $("#photo-comment-submit").bind('click', function(e){
          e.preventDefault();
          if($(this).attr('disabled') != 'disabled')
            $("#photo-comment-post-form").submit();
          $(this).attr('disabled','disabled');
          $('#photo-comment-post-form').attr("disabled", "disabled");

        });
        
        $("#photo-comment-post-form").on('submit', function(){
          if($(this).attr('disabled') == 'disabled')
            return false; 
          var comment = $("#photo-comment-body", $(this)).val();
          if(comment.trim() == ''){
            alert('Please enter your comment');  
          }
          else{
            $('#photo-comment-post-form').attr("disabled", "disabled");
            $("#photo-comment-submit").attr('disabled','disabled'); 
            postPhotoComment($(this),comment);  
          }
          return false;
        });
      }
      
       function postPhotoComment(form, comment){
         $.ajax({
          type: "POST",
          url: '/add_photo_comment',
          data:  $(form).serialize(),
          dataType: 'json',
          success: function(data){
            if(data.result){  
              var comment = data.new_comment;
              console.log($("#comment-table tr").length);
              console.log($("#comment-table"));
              if($("#comment-table tr").length > 0 )
                $("#comment-table tr").last().after(comment);    
              else
                $("#comment-table").append(comment);    
              var height = $("#comment-table").height();
              $("#comment-table-wrapper").scrollTop(height);
              $("#photo-comment-body", $(form)).val('');  
              
              $('#photo-comment-post-form').attr("disabled", false);
              $("#photo-comment-submit").attr('disabled',false);  
            }
            else{ 
              
            }
          },
        }); 
         
       }
      
      

       
      
});
