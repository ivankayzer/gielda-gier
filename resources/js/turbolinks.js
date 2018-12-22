var Barba = require('barba.js');

$(document).ready(function () {
    Barba.Pjax.start();
});

var OfferShow = Barba.BaseView.extend({
    namespace: 'offer-show',
    onEnter: function() {
        $('.gallery').slick({
            infinite: true,
            slidesToShow: 3,
            slidesToScroll: 1
        });
    },
    onEnterCompleted: function() {},
    onLeave: function() {},
    onLeaveCompleted: function() {
    }
});

OfferShow.init();

document.addEventListener('turbolinks:request-start', function () {
    var wrapper = document.querySelector('#wrapper');
    wrapper.classList.remove('animated');
    wrapper.classList.remove('fadeIn');
    wrapper.classList.add('animated');
    wrapper.classList.add('fadeOut');

    setTimeout(function () {
        document.querySelector('#loader').style.display = 'flex';
    }, 400);
});

document.addEventListener('turbolinks:load', function () {
    document.querySelector('#loader').style.display = 'none';
    var wrapper = document.querySelector('#wrapper');
    wrapper.classList.remove('animated');
    wrapper.classList.remove('fadeOut');
    wrapper.classList.add('animated');
    wrapper.classList.add('fadeIn');
});
