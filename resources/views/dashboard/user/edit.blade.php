@extends('layouts.app')
@section('title', 'Edit Employee')

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
                            <li class="breadcrumb-item"><a href="{{ route('users.index') }}">Employees</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Edit Employee</li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>

        <section id="multiple-column-form">
            <div class="row match-height">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <div class="row">
                                <div class="col-12 col-md-6 order-md-1">
                                    <h4 class="card-title">{{ $title . ' ' . $user->name}}</h4>
                                </div>
                            </div>
                        </div>
                        <div class="card-content">
                            <div class="card-body">

                                <form class="form" action="{{ route('users.update', [$user->id]) }}" method="POST">
                                    @method('PUT')
                                    @csrf

                                    <div class="row">
                                        <div class="col-md-6 col-12 mt-3">
                                            <div class="form-group">
                                                <label for="NIK" class="mb-2">NIK</label>
                                                <input type="text"
                                                    class="form-control form-control-lg @error('nik') is-invalid @enderror"
                                                    placeholder="Employee ID" name="nik"
                                                    value="{{ old('nik', $user->nik ?? '') }}">

                                                @error('nik')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                                @enderror
                                            </div>
                                        </div>

                                        <div class="col-md-6 col-12 mt-3">
                                            <div class="form-group">
                                                <label for="email" class="mb-2">Email</label>
                                                <input type="email"
                                                    class="form-control form-control-lg @error('email') is-invalid @enderror"
                                                    placeholder="your@mail.com" name="email"
                                                    value="{{ old('email', $user->email ?? '') }}">

                                                @error('email')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                                @enderror
                                            </div>
                                        </div>

                                        <div class="col-md-6 col-12 mt-3">
                                            <div class="form-group">
                                                <label for="name" class="mb-2">Name</label>
                                                <input type="text"
                                                    class="form-control form-control-lg @error('name') is-invalid @enderror"
                                                    placeholder="Fullname" name="name"
                                                    value="{{ old('name', $user->name ?? '') }}">

                                                @error('name')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                                @enderror
                                            </div>
                                        </div>

                                        <div class="col-md-6 col-12 mt-3">
                                            <div class="form-group">
                                                <label for="position" class="mb-2">Position</label>
                                                <input type="text"
                                                    class="form-control form-control-lg @error('position') is-invalid @enderror"
                                                    placeholder="Your Position" name="position"
                                                    value="{{ old('position', $user->position ?? '') }}">

                                                @error('position')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                                @enderror
                                            </div>
                                        </div>

                                        <div class="col-md-6 col-12 mt-3">
                                            <label for="role" class="mb-2">Role User</label>
                                            <div class="form-group @error('role') is-invalid @enderror">
                                                <select class="single-select2 role form-select" name="role">
                                                    <option value="" selected disabled>Choose Role</option>

                                                    <option value="staff" {{ old('role', $user->role) == 'staff' ?
                                                        'selected' : '' }}>Staff</option>

                                                    <option value="admin" {{ old('role', $user->role) == 'admin' ?
                                                        'selected' : '' }}>Admin</option>
                                                     @can('superadmin')
                                                     <option value="admin" {{ old('role', $user->role) == 'superadmin' ?
                                                        'selected' : '' }}>Super Admin</option>
                                                        
                                                     @endcan   

                                                    @can('superadmin')
                                                    <option value="superadmin" {{ old('role')=='superadmin' ? 'selected'
                                                        : '' }}>
                                                        Super Admin</option>

                                                    @endcan


                                                </select>
                                                @error('role')
                                                <div class="invalid-feedback error-style"
                                                    style="display:block; margin-top:-1.25rem;">
                                                    {{ $message }}
                                                </div>
                                                @enderror
                                            </div>
                                        </div>

                                        <div class="col-md-6 col-12 mt-3">
                                            <label for="division_id" class="mb-2">Division</label>
                                            <div class="form-group @error('division_id') is-invalid @enderror">
                                                <select class="form-select single-select2" name="division_id">
                                                    <option value="" selected @readonly(true)>Choose Division</option>
                                                    @foreach ($divisions as $division)
                                                    <option value="{{ $division->id }}" {{ old('division_id', $user->
                                                        division_id) == $division->id ?
                                                        'selected' : '' }}>{{ $division->name }}</option>
                                                    @endforeach
                                                </select>

                                                @error('division_id')
                                                <div class="invalid-feedback error-style"
                                                    style="display:block; margin-top:-1.25rem;">
                                                    {{ $message }}
                                                </div>
                                                @enderror
                                            </div>
                                        </div>

                                        <div class="col-md-6 col-12 mt-3">
                                            <div class="form-group">
                                                <label for="phone" class="mb-2">WhatsApp</label>
                                                <input type="text"
                                                    class="form-control form-control-lg @error('phone') is-invalid @enderror"
                                                    name="phone" placeholder="Your Number"
                                                    value="{{ old('phone', $user->phone) }}">

                                                @error('phone')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                                @enderror
                                            </div>
                                        </div>

                                        <div class="col-md-6 col-12 mt-3">
                                            <div class="form-group">
                                                <label for="password" class="mb-2">Password</label>
                                                <input type="password"
                                                    class="form-control form-control-lg @error('password') is-invalid @enderror"
                                                    name="password" placeholder="Password">

                                                @error('password')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                                @enderror
                                            </div>
                                        </div>

                                        <div class="col-md-6 col-12 mt-3">
                                            <div class="form-group">
                                                <label for="password_confirmation" class="mb-2">Password
                                                    Confirmation</label>
                                                <input type="password"
                                                    class="form-control form-control-lg @error('password_confirmation') is-invalid @enderror"
                                                    name="password_confirmation" placeholder="Password Confirmation">

                                                @error('password_confirmation')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                                @enderror
                                            </div>
                                        </div>

                                        <div class="col-12 d-grid gap-2 mt-3 d-md-block">
                                            <button type="submit" class="btn btn-primary me-1">Save</button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>

    @include('includes.footer')
</div>

@push('after-script')
@include('includes.select2')
@endpush
@endsection