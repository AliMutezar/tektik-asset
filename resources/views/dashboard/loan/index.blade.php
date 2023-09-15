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
                    <table class="table display nowrap table-hover" style="width: 100%" id="data-table">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Loan Code</th>
                                <th>Borrower</th>
                                <th>Borrowed units</th>
                                <th>Date Receipt</th>
                                <th>Photo</th>
                                <th>Status</th>
                                <th>Return Code</th>
                                <th class="text-center">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($loans as $loan)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $loan->loan_code }}</td>
                                <td>{{ $loan->user->name }}</td>
                                <td class="text-center">{{ $loan->assets->sum('pivot.unit_borrowed') }}</td>
                                <td>{{ $loan->date_receipt }}</td>

                                <td class="text-center">
                                    <a href="#" class="icon text-info" data-bs-toggle="modal"
                                        data-bs-target="#galleryModal{{ $loan->id }}" data-bs-toggle="tooltip" data-bs-placement="top"
                                        title="See Photo">
                                        <i class="bi bi-camera-fill" style="font-size: 1.2rem;"></i>
                                    </a>
                                </td>

                                <td class="text-center">
                                    @if ($loan->status == 1)
                                    <span class="badge bg-light-success">Returned</span>
                                    @elseif ($loan->status == 0)
                                    <span class="badge bg-light-warning">Borrowed</span>
                                    @else
                                    <span class="badge bg-light-danger">Lost</span>
                                    @endif
                                </td>
                                <td class="text-center">
                                    @if ($loan->return_code !== null)
                                        <span class="badge bg-light-success">{{ $loan->return_code }}</span>
                                    @else
                                        <span class="badge bg-light-danger">Empty</span>
                                    @endif
                                </td>

                                <td>
                                    <div class="d-flex">
                                        <a href="{{ route('loans.show', ['loan' => $loan->id]) }}" class="icon text-info me-3">
                                            <i class="bi bi-eye" style="font-size: 1.2rem;"></i>Show
                                        </a>

                                        <form action="{{ route('loans.destroy', $loan->id) }}" method="POST"
                                            id="deleteForm{{ $loan->id }}">
                                            @csrf
                                            @method('DELETE')
                                            <a href="#" class="icon text-danger"
                                                onclick="confirmDeleteLoan(event, '{{ $loan->id }}')"><i class="bi bi-x"
                                                    style="font-size: 1.2rem;"></i>Delete
                                            </a>
                                        </form>
                                    </div>
                                </td>

                                <div class="modal fade" id="galleryModal{{ $loan->id }}" tabindex="-1" role="dialog"
                                    aria-labelledby="galleryModalTitle{{ $loan->id }}" aria-hidden="true">
                                    <div class="modal-dialog modal-dialog-centered modal-dialog-centered"
                                        role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="galleryModalTitle{{ $loan->id }}">Bukti Pinjaman</h5>
                                                <button type="button" class="close" data-bs-dismiss="modal"
                                                    aria-label="Close">
                                                    <i data-feather="x"></i>
                                                </button>
                                            </div>
                                            <div class="modal-body">
                                                <img class="d-block w-100" src="{{ asset('storage/' . $loan->photo_receipt ) }}">
                                            </div>

                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary"
                                                    data-bs-dismiss="modal">Close</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </tr>
                            @endforeach

                        </tbody>
                    </table>
                </div>
            </div>

        </section>
        <!-- Basic Tables end -->
    </div>

    @include('includes.footer')
</div>
@endsection
