/**
 * Created by sasha on 21.10.15.
 */
$(document).on('click', '.static_page', function(){
    var id = $(this).parent('li').data('id_page');
    $.ajax({
        url: '/index.php/ajax/Pages/display_page/'+id,
        success: function(data)
        {
            $('.container').html(data);
        }
    });
});

$(document).on('click', '.faq_page', function(){
    var id = $(this).parent('li').data('id_faq');
    $.ajax({
        url: '/index.php/ajax/Pages/display_faq/'+id,
        success: function(data)
        {
            $('.container').html(data);
        },
        error: function(data)
        {
            $('.container').html(data);
        }
    });
});

$(".price_list").on("click", function() {
    $.ajax({
        type:"GET",
        url:"/index.php/price_list/price_list/display_parameters_list",
        success: function(data) {
            $("section#about").children("div.container").html(data);

            var top = $("#table-price-list").offset().top;
            $('body,html').animate({scrollTop: top}, 1500);
        },
        error: function() {
            alert("Error!!!");
        }
    });
});