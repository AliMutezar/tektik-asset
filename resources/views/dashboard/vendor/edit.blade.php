@extends('layouts.app')
@section('title', 'Edit Vendor')

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
                                <li class="breadcrumb-item"><a href="{{ route('vendors.index') }}">Vendor</a></li>
                                <li class="breadcrumb-item active" aria-current="page">Edit Vendor</li>
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
                                        <h4 class="card-title">{{ $title . ' ' . $vendor->company_name }}</h4>
                                    </div>
                                </div>
                            </div>
                            <div class="card-content">
                                <div class="card-body">

                                    <form class="form" action="{{ route('vendors.update', [$vendor->id]) }}"
                                        method="POST">
                                        @method('PUT')
                                        @csrf

                                        <div class="row mb-4">
                                            <p class="fw-bolder" style="color: #25396f;">Company Information</p>
                                            <div class="col-md-6 col-12 mt-3">
                                                <div class="form-group">
                                                    <label for="company_name" class="mb-2">Company Name</label>
                                                    <input type="text"
                                                        class="form-control @error('company_name') is-invalid @enderror"
                                                        placeholder="Name of Vendor" name="company_name"
                                                        value="{{ old('company_name', $vendor->company_name ?? '') }}">

                                                    @error('company_name')
                                                        <div class="invalid-feedback">
                                                            {{ $message }}
                                                        </div>
                                                    @enderror
                                                </div>
                                            </div>

                                            <div class="col-md-6 col-12 mt-3">
                                                <div class="form-group">
                                                    <label for="website" class="mb-2">Website</label>
                                                    <input type="text"
                                                        class="form-control @error('website') is-invalid @enderror"
                                                        placeholder="https://companywebsite.com " name="website"
                                                        value="{{ old('website', $vendor->website ?? '') }}">

                                                    @error('website')
                                                        <div class="invalid-feedback">
                                                            {{ $message }}
                                                        </div>
                                                    @enderror
                                                </div>
                                            </div>

                                            <div class="col-md-6 col-12 my-3">
                                                <div class="form-group">
                                                    <label for="pic" class="mb-2">Person in Charge</label>
                                                    <input type="text"
                                                        class="form-control @error('pic') is-invalid @enderror"
                                                        placeholder="Name of PIC" name="pic"
                                                        value="{{ old('pic', $vendor->pic ?? '') }}">

                                                    @error('pic')
                                                        <div class="invalid-feedback">
                                                            {{ $message }}
                                                        </div>
                                                    @enderror
                                                </div>
                                            </div>

                                            <div class="col-md-6 col-12 my-3">
                                                <div class="form-group">
                                                    <label for="phone" class="mb-2">Company Phone</label>
                                                    <input type="number"
                                                        class="form-control @error('phone') is-invalid @enderror"
                                                        placeholder="exp: 021 7536 8473" name="phone"
                                                        value="{{ old('phone', $vendor->phone ?? '') }}">

                                                    @error('phone')
                                                        <div class="invalid-feedback">
                                                            {{ $message }}
                                                        </div>
                                                    @enderror
                                                </div>
                                            </div>

                                            <p class="mt-5 fw-bolder" style="color: #25396f;">Company Location</p>
                                            <div class="col-md-12 col-12 mt-3">
                                                <div class="form-group">
                                                    <label for="address" class="mb-2">Company Address</label>
                                                    <input type="text"
                                                        class="form-control @error('address') is-invalid @enderror"
                                                        placeholder="exp: Jln. Agus Salim no.12" name="address"
                                                        value="{{ old('address', $vendor->address ?? '') }}">

                                                    @error('address')
                                                        <div class="invalid-feedback">
                                                            {{ $message }}
                                                        </div>
                                                    @enderror
                                                </div>
                                            </div>


                                            {{-- Chain Dropdown --}}

                                            <div class="col-md-6 col-12 mt-3">
                                                <label for="province" class="mb-2">Province</label>
                                                <div class="form-group @error('province_code') is-invalid @enderror">
                                                    <select class="form-select form-select-md single-select2" name="province_code" id="province"
                                                        onchange="getCities(this)">
                                                        <option value="" disabled>Select Province</option>

                                                        @foreach ($provinces as $provinceCode => $provinceName)
                                                            <option value="{{ $provinceCode }}"
                                                                {{ old('province_code', $vendor->province_code) == $provinceCode ? 'selected' : '' }}>
                                                                {{ $provinceName }}</option>
                                                        @endforeach

                                                    </select>
                                                    @error('province_code')
                                                        <div class="invalid-feedback" style="display: block;">
                                                            {{ $message }}
                                                        </div>
                                                    @enderror
                                                </div>
                                            </div>

                                            <div class="col-md-6 col-12 mt-3">
                                                <label for="cities" class="mb-2">City</label>
                                                <div class="form-group @error('city_code') is-invalid @enderror">
                                                    <select class="form-select form-select-md single-select2" name="city_code"
                                                        id="city" onchange="getDistrict(this)">
                                                        @foreach ($cities as $cityCode => $cityName)
                                                            <option value="{{ $vendor->city_code }}"
                                                                {{ old('city_code', $vendor->city_code) == $cityCode ? 'selected' : '' }}>
                                                                {{ $cityName }}</option>
                                                        @endforeach
                                                    </select>

                                                    @error('city_code')
                                                        <div class="invalid-feedback" style="display: block;">
                                                            {{ $message }}
                                                        </div>
                                                    @enderror
                                                </div>
                                            </div>

                                            <div class="col-md-6 col-12 mt-3">
                                                <label for="cities" class="mb-2">District</label>
                                                <fieldset class="form-group @error('district_code') is-invalid @enderror">
                                                    <select class="form-select form-select-md single-select2" name="district_code"
                                                        id="district" onchange="getVillage(this)">
                                                        @foreach ($districts as $districtCode => $districtName)
                                                            <option value="{{ $vendor->district_code }}"
                                                                {{ old('district', $vendor->district_code) == $districtCode ? 'selected' : '' }}>
                                                                {{ $districtName }}
                                                            </option>
                                                        @endforeach
                                                    </select>

                                                    @error('district_code')
                                                        <div class="invalid-feedback" style="display: block;">
                                                            {{ $message }}
                                                        </div>
                                                    @enderror
                                                </fieldset>
                                            </div>

                                            <div class="col-md-6 col-12 mt-3">
                                                <label for="cities" class="mb-2">Village</label>
                                                <div class="form-group @error('village_code') is-invalid @enderror">
                                                    <select class="form-select form-select-md single-select2" name="village_code"
                                                        id="village">
                                                        @foreach ($villages as $villageCode => $villageName)
                                                            <option value="{{ $vendor->village_code }}"
                                                                {{ old('city_code', $vendor->village_code) == $villageCode ? 'selected' : '' }}>
                                                                {{ $villageName }}</option>
                                                        @endforeach

                                                    </select>
                                                    @error('village_code')
                                                        <div class="invalid-feedback" style="display: block;">
                                                            {{ $message }}
                                                        </div>
                                                    @enderror
                                                </div>
                                            </div>

                                            {{-- End Chain Dropdown --}}



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
@endsection

@push('after-script')
    {{-- <script src="{{ url('assets/js/id_location.js') }}"></script> --}}
    @include('includes.chained_dropdown')
    @include('includes.select2')
@endpush
