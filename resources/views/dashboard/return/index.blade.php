@extends('layouts.app')
@section('title', 'Asset Return')

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
                                <li class="breadcrumb-item active">
                                    <a href="{{ route('dashboard') }}">Dashboard</a>
                                </li>
                                <li class="breadcrumb-item active" aria-current="page">Return Form</li>
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

                            <a href="{{ route('returns.create') }}"
                                class="btn icon icon-left btn-primary btn-sm d-flex align-items-center"><i
                                    data-feather="user-plus" class="me-2"></i> Add Return</a>
                        </div>
                    </div>
                    <div class="card-body mt-3">
                        <table class="table display nowrap table-hover" style="width: 100%" id="data-table">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Return Code</th>
                                    <th>Loan Code</th>
                                    <th>Borrower</th>
                                    <th>Borrower Division</th>
                                    <th>Date Returned</th>
                                    <th class="text-center">Photo</th>
                                    <th class="text-center">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($returns as $return)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $return->return_code }}</td>
                                        <td>{{ $return->loan->loan_code }}</td>
                                        <td>{{ $return->loan->user->name }}</td>
                                        <td class="text-center">{{ $return->loan->user->division->name}}</td>
                                        <td>{{ $return->date_returned }}</td>

                                        <td class="text-center">
                                            <a href="#" class="icon text-info" data-bs-toggle="modal"
                                                data-bs-target="#galleryModal{{ $return->id }}" data-bs-toggle="tooltip"
                                                data-bs-placement="top" title="See Photo">
                                                <i class="bi bi-camera-fill" style="font-size: 1.2rem;"></i>
                                            </a>
                                        </td>

                                        <td>
                                            <div class="d-flex">
                                                <a href="" class="icon text-info me-3">
                                                    <i class="bi bi-eye" style="font-size: 1.2rem;"></i>Show
                                                </a>
                                                @can('superadmin')
                                                
                                                <form action="" method="POST" id="deleteForm">
                                                    @csrf
                                                    @method('DELETE')
                                                    <a href="#" class="icon text-danger"
                                                        onclick="confirmDeleteReturn(event, '{{ $return->id}}')"><i class="bi bi-x"
                                                            style="font-size: 1.2rem;"></i>Delete
                                                    </a>
                                                </form>
                                                @endcan
                                            </div>
                                        </td>

                                        <div class="modal fade" id="galleryModal{{ $return->id }}" tabindex="-1"
                                            role="dialog" aria-labelledby="galleryModalTitle{{ $return->id }}"
                                            aria-hidden="true">
                                            <div class="modal-dialog modal-dialog-centered modal-dialog-centered"
                                                role="document">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="galleryModalTitle{{ $return->id }}">
                                                            Our Gallery Example</h5>
                                                        <button type="button" class="close" data-bs-dismiss="modal"
                                                            aria-label="Close">
                                                            <i data-feather="x"></i>
                                                        </button>
                                                    </div>
                                                    <div class="modal-body">
                                                        {{-- <img class="d-block w-100" src="{{ asset('storage/' . $return->photo_receipt ) }}"> --}}
                                                        <img class="d-block w-100"
                                                            src=" {{ asset('storage/photo_returned/' . $return->photo_returned) }} ">
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
