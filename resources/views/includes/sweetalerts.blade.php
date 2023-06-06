@if ($errors->any())
<script>
    Swal.fire({
        toast: true,
        title : 'Opps!',
        text : 'Something went wrong',
        icon : 'error',
        position : 'top-end',
        showConfirmButton: false,
        timerProgressBar: true,
        timer: 3000
    });
</script>
@endif

@if (session()->has('success'))
<script>
    Swal.fire({
        toast: true,
        title : 'Yeay!',
        text : '{{ session('success') }}',
        icon : 'success',
        position : 'top-end',
        showConfirmButton: false,
        timerProgressBar: true,
        timer: 3500
    });
</script>
@endif

<script>
    function confirmDelete(event, userId) {
        event.preventDefault();
        
        Swal.fire({
            title: 'Want to delete this data?',
            text: "All data related to this data will also be deteled",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#fff',
            cancelButtonColor: '#dc3545',
            confirmButtonText: 'Yes, delete it!',
            customClass : {
                confirmButton : 'swall-confirm-button'
            }
        }).then((result) => {
            if (result.isConfirmed) {
                document.getElementById('deleteForm' + userId).submit();
            }
        });
    }
</script>
