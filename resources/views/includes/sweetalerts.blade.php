@if ($errors->any())
<script>
    Swal.fire({
        'toast': true,
        'title' : 'Opps!',
        'text' : 'Something went wrong',
        'icon' : 'error',
        'position' : 'top-end',
        showConfirmButton: false,
        'timerProgressBar': true,
        'timer': 3000
    });
</script>
@endif

@if (session()->has('success'))
<script>
    Swal.fire({
        'toast': true,
        'title' : 'Yeay!',
        'text' : '{{ session('success') }}',
        'icon' : 'success',
        'position' : 'top-end',
        showConfirmButton: false,
        'timerProgressBar': true,
        'timer': 3000
    });
</script>
@endif