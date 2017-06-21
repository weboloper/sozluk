$("#more").click(function(e){
    e.preventDefault();
    var page = parseInt($(this).attr("data-page"));
    var button = $(this);
    
    $.ajax({
        url: "/posts/more",
        type:'POST',
        data: { page : page},
        success: function(data) {
            if(data.trim().length == 0){
                //notify user if nothing to load
               
                button.remove();
                return;
            }
            page = page +1;
            button.attr('data-page', page);
            $('#post-list').append(data);

        }
    })   
}); 

$('#post-list.not-mobile').on('click', '.solframe-link', function (e){
 
    e.preventDefault();
    var href =   $(this).attr("href") ;
    var id =   $(this).attr("data-id") ;
     
    $.ajax({
        url: "/posts/ajax/" + id ,
        type:'POST',
        data: { id : id},
        success: function(data) {
            if(data.trim().length == 0){
                //notify user if nothing to load
               
 
                return;
            }
 
            $('#content').html(data);

        }
    })   
});  