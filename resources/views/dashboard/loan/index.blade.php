@extends('layouts.app')
@section('title', 'Asset Loan')

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
                            <li class="breadcrumb-item">
                                <a href="{{ route('dashboard') }}">Dashboard</a>
                            </li>
                            <li class="breadcrumb-item active" aria-current="page">Loan Form</li>
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

                        <a href="{{ route('loans.create') }}"
                            class="btn icon icon-left btn-primary btn-sm d-flex align-items-center"><i
                                data-feather="user-plus" class="me-2"></i> Add Loan</a>
                    </div>
                </div>

                <div class="card-body mt-3">
                    <table class="table table-responsive table-hover display nowrap" id="tableLoans">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Loan Code</th>
                                <th>Admin</th>
                                <th>Borrower</th>
                                <th>Borrower Division</th>
                                <th>Borrowed Units</th>
                                <th>Date Receipt</th>
                                <th>Photo</th>
                                <th>Status</th>
                                <th>Return Code</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                    </table>
                </div>
            </div>

        </section>
        <!-- Basic Tables end -->
    </div>
    @foreach($loans as $loan)
    <div class="modal fade" id="galleryModal{{ $loan->id }}" tabindex="-1" role="dialog"
        aria-labelledby="galleryModalTitle{{ $loan->id }}" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-dialog-centered"
            role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="galleryModalTitle{{ $loan->id }}">Bukti
                        Pinjaman</h5>
                    <button type="button" class="close" data-bs-dismiss="modal"
                        aria-label="Close">
                        <i data-feather="x"></i>
                    </button>
                </div>

                <div class="modal-body">
                    <img class="d-block w-100"
                        src="{{ asset('storage/photo_receipt/' . $loan->photo_receipt ) }}">
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary"
                        data-bs-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>
        
    @endforeach
    @include('includes.footer')
</div>

@push('after-script')
    <script>
        $(document).ready(function(){
            $('#tableLoans').DataTable({
                scrollX: true,
                processing: true,
                serverSide: true,
                language: {
                    processing: '<img src="assets/images/svg-loaders/puff.svg" class="me-4" style="width: 3rem" alt="audio">'
                },
                ajax: '/loans/',

                // menambahkan kolom sesuai dengan kolom tabel, dan eberapa kolom seperti no, condition, price di custom
                columns: [
                            {
                                data: 'DT_RowIndex',
                                name: 'DT_RowIndex'
                            },
                            {
                                data: 'loan_code',
                                name: 'loan_code'
                            },
                            {
                                data: 'admin_user.name',
                                name: 'admin_user.name'
                            },
                            {
                                data: 'user.name',
                                name: 'user.name'
                            },
                            {
                                data: 'user.division.name',
                                name: 'user.division.name'
                            },
                            {
                                data: 'sum_borrowed_units',
                                name: 'sum_borrowed_units'
                            },
                            {
                                data: 'date_receipt',
                                name: 'date_receipt'
                            },
                            {
                                data: 'photo',
                                name: 'photo'
                            },
                            {
                                data: 'status',
                                name: 'status'
                            },
                            {
                                data: 'return_code',
                                name: 'return_code'
                            },
                            {
                                data: 'action',
                                name: 'action'
                            }
                        ]
            });
        });    
    </script>    
@endpush
@endsection