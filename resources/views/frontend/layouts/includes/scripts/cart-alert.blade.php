<script>
    document.addEventListener('cart-updated-success', function(event) {
        localStorage.setItem('showCartUpdateSuccess', 'true');
        location.reload();
    });

    document.addEventListener('cart-updated-warning', function(event) {
        localStorage.setItem('showCartUpdateWarning', 'true');
        location.reload();
    });

    document.addEventListener('reload-page', function() {
        location.reload();
    });

    window.onload = function() {
        if (localStorage.getItem('showCartUpdateSuccess') === 'true') {
            Swal.fire({
                title: 'Success!',
                text: 'Product has been added to cart',
                icon: 'success',
                confirmButtonText: 'OK',
                timer: 3000,
                showConfirmButton: false
            }).then(() => {
                localStorage.removeItem('showCartUpdateSuccess');
            });
        } else if (localStorage.getItem('showCartUpdateWarning') === 'true') {
            Swal.fire({
                title: 'Warning!',
                text: 'There was an issue adding the product to the cart.',
                icon: 'warning',
                confirmButtonText: 'OK',
                timer: 3000,
                showConfirmButton: false
            }).then(() => {
                localStorage.removeItem('showCartUpdateWarning');
            });
        }
    };
</script>
