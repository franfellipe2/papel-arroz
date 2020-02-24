window.onscroll = function () {
    var p = document.body.scrollTop; // For Safari
    var p2 = document.documentElement.scrollTop; // For Chrome, Firefox, IE and Opera

    // Mostrar ocultar botão voltar ao topo
    if (p > 300 || p2 > 300) {
        $('.btn-to-top').fadeIn().addClass('visible');
    } else {
        $('.btn-to-top').fadeOut().removeClass('visible');
    }

};


$('.btn-to-top').on('click', function () {
    appScrollTo('#site-top');
});

function appScrollTo(element) {
    $('html, body').animate({
        scrollTop: $(element).offset().top
    }, 1000);
}