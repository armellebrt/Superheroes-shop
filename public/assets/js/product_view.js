
$("#form-add-to-cart").on("submit", function(event) {
    event.preventDefault();
    let quantity = $('#form_quantity').val();
    let productId = $('#form_product_id').val();

    fetch('/cart/add/' + productId + '/' + quantity)
        .then(response => response.text())
        .then(cart => {
            // $('#cart-popin').
        })
});