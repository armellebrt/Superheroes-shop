$("#form-add-to-cart").on("submit", function(event) {
    event.preventDefault();
    let quantity = $('#form_quantity').val();
    let productId = $('#form_product_id').val();

    window.minicart.addToCart(productId, quantity)
        .then(() => {
            window.minicart.show(2000);
        });
});