$(document).ready(function(){

  $(".plaatje").hover(
    function(){
    $(this).addClass('active');
    },
    function(){
        $(this).removeClass('active');
    });
});