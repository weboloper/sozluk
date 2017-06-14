$(document).ready(function(){
    $("#more").click(function(e){

        
        e.preventDefault();
        var page = $(this).attr("data-page");
        
        $.ajax({
            url: "/posts/more",
            type:'POST',
            dataType: 'json',
            success: function(data) {
                page = page +1;
                $('this').attr('data-page', page);
                console.log(data);
            }
        });     
    });
});
 