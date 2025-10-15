<script>
    window.onload = function() {
        @if (session()->has('success'))
            Swal.fire({
                title: 'Success!',
                text: 'Product has been added to cart',
                icon: 'success',
                confirmButtonText: 'OK',
                timer: 3000,
                showConfirmButton: false
            });
        @endif
        @if (session()->has('review-success'))
            Swal.fire({
                title: 'Success!',
                text: 'Thank you for your review!',
                icon: 'success',
                confirmButtonText: 'OK',
                timer: 3000,
                showConfirmButton: false
            });
        @endif
    };
</script>
