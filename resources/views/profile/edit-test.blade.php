@extends('layouts.app')
@section('title', 'Edit Profile')

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
                <div class="col-12 col-md-6 order-md-2 order-last">

                </div>
                <div class="col-12 col-md-6 order-md-1 order-first">
                    <nav aria-label="breadcrumb" class="breadcrumb-header float-start">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Profile Setting</li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>

        <!-- // Basic multiple Column Form section start -->
        <section id="multiple-column-form">
            <div class="row match-height">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <div class="row d-flex align-items-center">
                                <div class="col-md-6 order-md-2">
                                    <div class="avatar avatar-lg float-end">
                                        <div class="ms-3 name d-none d-sm-block">

                                            @if ($user->image)
                                            <img src="{{ asset('storage/' . $user->image) }}" alt="Face 1" class="profile">
                                            @else
                                            <img src="{{ url('assets/images/faces/1.jpg') }}" alt="Face 1">
                                            @endif
                                            <span class="ms-2">{{ Auth::user()->name }}</span>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6 order-md-1">
                                    <h4 class="card-title">Edit Profile</h4>
                                </div>
                            </div>
                        </div>
                        <div class="card-content">
                            <div class="card-body">

                                <form class="form" id="form-update" action="{{ route('profile.update') }}" method="POST"
                                    enctype="multipart/form-data">
                                    @csrf
                                    @method('patch')

                                    <div class="row">
                                        <p>User Information</p>

                                        <div class="col-md-6 col-12 mt-3">
                                            <div class="form-group">
                                                <label for="NIK" class="mb-2">NIK</label>
                                                <input type="text"
                                                    class="form-control form-control-lg @error('nik') is-invalid @enderror"
                                                    placeholder="Your Employee ID" name="nik"
                                                    value="{{ old('nik', $user->nik) }}" readonly>

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
                                                    value="{{ old('email', $user->email) }}" readonly>

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
                                            <label for="division_id" class="mb-2">Division</label>
                                            <div class="form-group @error('division_id') is-invalid @enderror">
                                                <select class="choices form-select" name="division_id">
                                                    <option value="" selected @readonly(true)>Choose Division</option>

                                                    @foreach ($division as $division)
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
                                                    value="{{ old('phone', $user->phone ?? '') }}">

                                                @error('phone')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                                @enderror
                                            </div>
                                        </div>

                                        <div class="col-md-6 col-12 mt-3">
                                            <div class="form-group">
                                                {{-- <label for="image" class="mb-2">Photo</label>
                                                <input type="file"
                                                    class="form-control form-control-lg imgbb-filepond @error('image') is-invalid @enderror"
                                                    name="image"> --}}

                                                <label for="formFileLg" class="form-label mb-2">Photo</label>
                                                <input class="form-control form-control-lg" id="formFileLg" type="file"
                                                    name="image">

                                                <input type="hidden" name="oldImage" value="{{ $user->image ?? '' }}">

                                                @error('image')
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
        <!-- // Basic multiple Column Form section end -->
    </div>

    @include('includes.footer')
</div>
@endsection
