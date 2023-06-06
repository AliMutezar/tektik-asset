@extends('layouts.app')
@section('title', 'Asset')

@section('content')
<div id="main">
    <header class="mb-3">
        <a href="#" class="burger-btn d-block d-xl-none">
            <i class="bi bi-justify fs-3"></i>
        </a>
    </header>

    <div class="page-heading">
        <div class="page-title">
            <div class="row mb-3">
                <div class="col-12 col-md-6 order-md-1 order-first">
                    <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-start">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item active" aria-current="page">Master Data</li>
                            <li class="breadcrumb-item active" aria-current="page">Asset</li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>

        <!-- Basic Tables start -->
        <section class="section">
            <div class="card">
                <div class="card-header">
                    <div class="col-sm-6 col-md-12 d-flex justify-content-between">
                        {{ $title }}

                        <a href="{{ route('assets.create') }}"
                            class="btn icon icon-left btn-primary btn-sm d-flex align-items-center"><i
                                data-feather="plus" class="me-2"></i> Add Asset</a>
                    </div>
                </div>
                <div class="card-body mt-3">
                    <table class="table display nowrap table-hover" style="width: 100%" id="asset-table">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Vendor</th>
                                <th>Asset</th>
                                <th>No. Serial</th>
                                <th>Condition</th>
                                <th>Price</th>
                                <th>Stock</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody></tbody>
                        <tfoot>
                            <th></th>
                            <th>Vendor</th>
                            <th>Asset</th>
                            <th>No. Serial</th>
                            <th>Condition</th>
                            <th>Price</th>
                            <th>Stock</th>
                            <th></th>
                        </tfoot>
                    </table>
                </div>
            </div>

        </section>
        <!-- Basic Tables end -->
    </div>

    @include('includes.footer')
</div>
@endsection

@push('after-script')
<script>
    $(document).ready(function () {
        // set up text input to each footer cell
        $('#asset-table tfoot th:not(:first-child, :last-child)').each(function () {
            var title = $(this).text();
            $(this).html(' <input type="text" class="form-control" style="width: 150px;" placeholder="Search ' + title + '" />');
        });

        var table = $('#asset-table').DataTable({
            scrollX:true,
            processing:true,
            serverSide:true,
            ajax: '{{ route('assets.index') }}',

            // menambahkan kolom sesuai dengan kolom tabel, dan eberapa kolom seperti no, condition, price di custom 
            columns: [
                { 
                    data: null,
                    render: function(data, type, row, meta) {
                        return meta.row + meta.settings._iDisplayStart + 1;
                    }
                },
    
                { data: 'vendor.company_name', name: 'vendor.company_name' },
                { data: 'asset_name', name: 'asset_name' },
                { data: 'serial_number', name: 'serial_number', className: 'text-center'},

                { 
                    data: 'condition', name: 'condition',
                    render: function(data) {
                        var badgeClass = '';

                        if (data === 'good') {
                            badgeClass = 'bg-light-success';
                        } else if (data === 'not bad') {
                            badgeClass = 'bg-light-warning'
                        } else {
                            badgeClass = 'bg-light-danger';
                        }

                        return '<span class="badge ' + badgeClass + '">' + data + '</span>';
                    }
                },

                { 
                    data: 'price_unit', name: 'price_unit',
                    render: function(data) {
                        var formattedPrice = numeral(data).format('0,0');
                        return 'Rp ' + formattedPrice;
                    }
                },

                { data: 'stock_unit', name: 'stock_unit', className: 'text-center' },
                { data: 'action', name: 'action', orderable: false, searchable: false },
            ],

            // agar nomor pada page berikutnya melanjutkan nomor terakhir pada page sebelumnya
            "drawCallback": function(settings) {
                var api = this.api();
                api.columns(0).nodes().each(function(cell, i) {
                    cell.innerHTML =  i + 1;
                });
            },

            initComplete: function() {
                // Apply search
                this.api()
                    .columns()
                    .every(function() {
                        var that = this;
                        $('input', this.footer()).on('keyup change clear', function () {
                            // console.log("ini that " + that.search() + " " + " ini this " + this.value);
                            if (that.search() !== this.value) {
                                that.search(this.value).draw();
                            }
                        });
                    });
            },
        });


        // Hover column
        // $('#asset-table tbody').on('mouseenter', 'td', function() {
        //     var colIdx = table.cell(this).index().column;
        
        //     $(table.cells().nodes()).removeClass('highlight');
        //     $(table.column(colIdx).nodes()).addClass('highlight');
        // }).on('mouseleave', function() {
        //     $(table.cells().nodes()).removeClass('highlight')
        // });
    

    
        $('#asset-table').on('click', '.delete-btn', function (e) {
            e.preventDefault();
            var assetId = $(this).data('id');
            confirmDelete(assetId);
        });
    
        function confirmDelete(assetId) {
            Swal.fire({
                title: 'Are you sure?',
                text: "This asset will be permanently deleted!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#fff',
                cancelButtonColor: '#dc3545',
                confirmButtonText: 'Yes, delete it!',
                customClass: {
                    confirmButton: 'swall-confirm-button'
                }
            }).then((result) => {
                if (result.isConfirmed) {
                    deleteAsset(assetId);
                }
            });
        }
    
        function deleteAsset(assetId) {
            var deleteUrl = '{{ route('assets.destroy', ':id') }}';
            deleteUrl = deleteUrl.replace(':id', assetId);
    
            $.ajax({
                url: deleteUrl,
                type: 'DELETE',
                data: {
                    "_token": "{{ csrf_token() }}",
                    "_method": "DELETE"
                },
                dataType: 'json',
                success: function (response) {
                    $('#asset-table').DataTable().ajax.reload();
                    if(response.success) {
                        Swal.fire({
                            toast: true,
                            title: 'Deleted!',
                            text: response.message,
                            icon: 'success',
                            position: 'top-end',
                            showConfirmButton: false,
                            timerProgressBar: true,
                            timer: 3500
                        });
                    } else {
                        Swal.fire({
                            icon: 'error',
                            toast: true,
                            title: 'Sorry!',
                            text: response.message,
                            position: 'top-end',
                            timerProgressBar: true,
                            showConfirmButton: false,
                            timer: 3500
                        });
    
                    }
                },
    
                error: function(xhr) {
                    Swal.fire({
                        icon: 'error',
                        toast: true,
                        title: 'Error!',
                        text: 'Faild to deleted asset',
                        position: 'top-end',
                        timerProgressbar: true,
                        showConfirmButton: false,
                        timer: 3500
                    });
                }
            });
        }
    });
</script>
@endpush