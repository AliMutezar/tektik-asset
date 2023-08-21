@extends('layouts.app')
@section('title', 'User')

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
                            <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Master Data</li>
                            <li class="breadcrumb-item active" aria-current="page">Employee</li>
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

                        <a href="{{ route('users.create') }}"
                            class="btn icon icon-left btn-primary btn-sm d-flex align-items-center"><i
                                data-feather="user-plus" class="me-2"></i> Add Employee</a>
                    </div>
                </div>
                <div class="card-body mt-3">
                    <table class="table display nowrap table-hover" style="width: 100%" id="data-table">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>NIK</th>
                                <th>Division</th>
                                <th>Role</th>
                                <th>Name</th>
                                <th>Email</th>
                                <th>Phone</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($users as $user)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $user->nik }}</td>
                                <td>{{ $user->division ? $user->division->name : 'No Division' }}</td>
                                <td>{{ $user->role }}</td>
                                <td>{{ $user->name }}</td>
                                <td>{{ $user->email }}</td>
                                <td>{{ $user->phone }}</td>
                                <td>
                                    <div class="d-flex">
                                        <a href="{{ route('users.edit', ['user' => $user->id]) }}" class="icon me-3"><i
                                                class="bi bi-pencil-fill" style="font-size: 0.8rem;"></i></a>
                                        <form action="{{ route('users.destroy', ['user' => $user->id]) }}" method="POST"
                                            id="deleteForm{{ $user->id }}">
                                            @csrf
                                            @method('DELETE')

                                            <a href="#" class="icon text-danger"
                                                onclick="confirmDelete(event, '{{ $user->id }}')"><i class="bi bi-x"
                                                    style="font-size: 1.2rem;"></i></a>
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
    </div>

    @include('includes.footer')
</div>
@endsection