@extends('layouts.app')
@section('title', 'Divsion')

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
                                <li class="breadcrumb-item"><a href="index.html">Dashboard</a></li>
                                <li class="breadcrumb-item active" aria-current="page">Master Data</li>
                                <li class="breadcrumb-item active" aria-current="page">Division</li>
                            </ol>
                        </nav>
                    </div>
                </div>
            </div>

            <!-- Basic Tables start -->
            <!-- Basic Tables start -->
            <section class="section">
                <div class="card">
                    <div class="card-header">
                        <div class="col-sm-6 col-md-12 d-flex justify-content-between">
                            {{ $title }}

                            <button class="btn icon icon-left btn-primary btn-sm d-flex align-items-center" data-bs-toggle="modal" data-bs-target="#modalCreate"><i
                                data-feather="plus" class="me-2"></i> Add Division</button>
                        </div>
                    </div>
                    <div class="card-body mt-3t">
                        <table class="table display nowrap table-hover" style="width: 100%" id="data-table">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Name</th>
                                    <th>Created At</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($divisions as $division)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $division->name }}</td>
                                        <td>{{ $division->created_at }}</td>
                                        <td class="text-center">
                                            <div class="d-flex">
                                                <button class="btn btn-link" data-bs-toggle="modal" data-bs-target="#modalEdit{{$division->id}}" class="icon me-3"><i class="bi bi-pencil-fill"
                                                        style="font-size: 0.8rem;"></i></button>
                                                <form action="{{route('divisions.destroy', $division->id)}}" method="POST" id="deleteForm{{$division->id}}">
                                                    @csrf
                                                    @method('DELETE')

                                                    <button href="#" class="btn btn-link text-danger"
                                                        onclick="confirmDelete(event, '{{$division->id}}')"><i class="bi bi-x"
                                                            style="font-size: 1.2rem;"></i></button>
                                                </form>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>

            </section>
            <!-- Basic Tables end -->
            {{-- <section class="section">
                <div class="card">
                    <div class="card-header">
                        <div class="col-sm-6 col-md-12 d-flex justify-content-between">
                            {{ $title }}

                            <button class="btn icon icon-left btn-primary btn-sm d-flex align-items-center" data-bs-toggle="modal" data-bs-target="#modalCreate"><i
                                    data-feather="plus" class="me-2"></i> Add Division</button>
                        </div>
                    </div>
                    <div class="card-body">
                        <table class="table table-borderd" id="data-table">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Name</th>
                                    <th>Created At</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($divisions as $division)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $division->name }}</td>
                                        <td>{{ $division->created_at }}</td>
                                        <td class="text-center">
                                            <div class="d-flex">
                                                <button class="btn btn-link" data-bs-toggle="modal" data-bs-target="#modalEdit{{$division->id}}" class="icon me-3"><i class="bi bi-pencil-fill"
                                                        style="font-size: 0.8rem;"></i></button>
                                                <form action="{{route('divisions.destroy', $division->id)}}" method="POST" id="deleteForm{{$division->id}}">
                                                    @csrf
                                                    @method('DELETE')

                                                    <button href="#" class="btn btn-link text-danger"
                                                        onclick="confirmDelete(event, '{{$division->id}}')"><i class="bi bi-x"
                                                            style="font-size: 1.2rem;"></i></button>
                                                </form>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>

            </section> --}}
            <!-- Basic Tables end -->
        </div>


        @include('includes.footer')
    </div>

    @include('dashboard.division.modal-create')
    @include('dashboard.division.modal-edit')

@endsection

@push('after-script')
@endpush
