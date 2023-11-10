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
        timer: 5000
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
        timer: 5000
    });
</script>
@endif

@if (session('error'))
    <script>
        Swal.fire({
            toast: true,
            icon: 'error',
            title: 'Oops...',
            text: '{{ session('error') }}',
            position: 'top-end',
            showConfirmButton: false,
            timerProgressBar: true,
            timer: 5000
        });
    </script>
@endif


<script>
    function confirmDelete(event, dataId) {
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
                document.getElementById('deleteForm' + dataId).submit();
            }
        });
    }

    function confirmDeleteLoan(e) {
        let id = e.getAttribute('data-id');
        
        Swal.fire({
            title: 'Want to delete this data?',
            text: "All stock items related to this loan will be returned and return code for this loan will also deleted",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#fff',
            cancelButtonColor: '#dc3545',
            confirmButtonText: 'Yes, delete it!',
            customClass : {
                confirmButton : 'swall-confirm-button'
            }
        }).then((result) => {
            if (result.value) {
                $.ajax({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                type: 'Delete',
                url: '/loans/' + id,
                dataType: "json",
                success:function(response){
                    Swal.fire({
                        toast: true,
                        title : 'Yeay!',
                        text : response.message,
                        icon : 'success',
                        position : 'top-end',
                        showConfirmButton: false,
                        timerProgressBar: true,
                        timer: 1000
                    }).then((result) => {
                        window.location.href = '/loans';
                    })
                },
                error: function(xhr, ajaxOptions, thrownError){
                    alert(xhr. status + "\n" + xhr.responseText + "\n" + thrownError);
                }
            });
            }
        });
    }

    function confirmDeleteReturn(event, dataId) {
        event.preventDefault();
        
        Swal.fire({
            title: 'Want to delete this data?',
            text: "All stock items related to this loan will be returned and return code for this loan will also deleted",
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
                document.getElementById('deleteForm' + dataId).submit();
            }
        });
    }
</script>
