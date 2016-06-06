$(document).ready(function(){
    $('input.add-amount').on('click', function() {
        $('form.form-products').attr('action', "/product/add").submit();
    });
    $('input.del-amount').on('click', function() {
        $('form.form-products').attr('action', "/product/del").submit();
    });

    $(".plaatje").hover(
    function(){
    $(this).addClass('active');
    },
    function(){
        $(this).removeClass('active');
    });

    var i = 0;
    $('li.has-children').hover(function(event){
        console.log(i);
        i++;
        event.preventDefault();
        if ($(this).children('.children').children('ul').hasClass('selected')) {
            $(this).children('.children').children('ul').removeClass('selected');
        }
        else {
            $(this).children('.children').children('ul').addClass('selected');
        }
    });

    $('form input.search-panel').keypress(function(e) {
        if(e.which == 13) {
            var form = (this).parent().html();
            form.trigger('submit');
        }
    });
});