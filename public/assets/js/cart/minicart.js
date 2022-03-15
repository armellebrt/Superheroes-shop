// create an object 'minicart' stocked in window to manage the display of minicart
window.minicart = {
    initialize: function() {
        // $('#cart-navbar-icon').mouseenter('show()').mouseleave('hidden()');
        $('#minicart').hover(this.show, this.hide);
    },

    addToCart: function (productId, quantity) {
        return fetch('/cart/add/' + productId + '/' + quantity)
            .then(response => response.text())
            .then(cart => {
                $('#cart-popin').replaceWith(cart);
            })
    },

    show: function (delay = null) {
        $('#cart-popin').removeClass('d-none');

        if (typeof delay === 'number') {
            setTimeout(function () {
                if (!$('#minicart').is(":hover")) {
                    this.hide();
                }
            }.bind(this), delay);
        }
    },

    hide: function() {
        $("#cart-popin").addClass('d-none');
    }
};

window.minicart.initialize();