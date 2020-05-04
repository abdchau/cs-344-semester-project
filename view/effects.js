$(document).ready(function(){
    product_hover_effect();
});

function product_hover_effect() {
    $(".product-info").hover(function () {
        $(this).removeClass("shadow-sm").addClass("shadow");
    }, function () {
        $(this).removeClass("shadow").addClass("shadow-sm");
    })
}