@extends('layouts.app')
@section('title', 'Add Vendor')

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
                                <li class="breadcrumb-item active" aria-current="page">Add Vendor</li>
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
                                        <h4 class="card-title">Add New Vendor</h4>
                                    </div>
                                </div>
                            </div>
                            <div class="card-content">
                                <div class="card-body">

                                    <form class="form" action="{{ route('vendors.store') }}" method="POST">
                                        @csrf

                                        <div class="row mb-4">
                                            <p class="fw-bolder" style="color: #25396f;">Company Information</p>
                                            <div class="col-md-6 col-12 mt-3">
                                                <div class="form-group">
                                                    <label for="company_name" class="mb-2">Company Name</label>
                                                    <input type="text"
                                                        class="form-control @error('company_name') is-invalid @enderror"
                                                        placeholder="Name of Vendor" name="company_name"
                                                        value="{{ old('company_name') }}">

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
                                                        value="{{ old('website') }}">

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
                                                        value="{{ old('pic') }}">

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
                                                        value="{{ old('phone') }}">

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
                                                        value="{{ old('address') }}">

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
                                                    <select class="form-select" name="province_code" id="province"
                                                        onchange="getCities(this)" data-placeholder="Select Province">
                                                        <option value="" selected @readonly(true)>
                                                            {{ __('Select Province') }}</option>

                                                        @foreach ($provinces as $provinceCode => $provinceName)
                                                            <option value="{{ $provinceCode }}"> {{ $provinceName }}
                                                            </option>
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
                                                    <select class="form-select form-select-md" name="city_code"
                                                        id="city" onchange="getDistrict(this)" data-placeholder="Select City">

                                                        <option value="" selected @readonly(true)>
                                                            {{ __('Select City') }}</option>

                                                        @foreach ($cities as $citiesCode => $citiesName)
                                                            <option value="{{ $citiesCode }}"> {{ $citiesName }}
                                                            </option>
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
                                                    <select class="choices form-select form-select-md"
                                                        name="district_code" id="district" onchange="getVillage(this)" data-placeholder="Select Disrict">

                                                        <option value="">{{ __('Select District') }}</option>
                                                        @foreach ($districts as $districtCode => $districtName)
                                                            <option value="{{ $districtCode }}"> {{ $districtName }}
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
                                                    <select class="choices form-select form-select-md" name="village_code"
                                                        id="village" data-placeholder="Select Village">

                                                        <option value="">{{ __('Select Village') }}</option>
                                                        
                                                        @foreach ($villages as $villageCode => $villageName)
                                                            <option value="{{ $villageCode }}">{{ $villageName }}</option>
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

    {{-- ajax trigger chained dropdown --}}
    <script>
        function getCities(province) {
            console.log('getCities');
            const code = province.value;
            $.ajax({
                type: 'GET',
                url: '{{ url('cities') }}/' + code,
                data: {
                    province_code: code
                },
                success: function(response) {
                    console.log(response);
                    $('#city').empty();

                    for (i = 0; i < response.length; i++) {
                        $('#city').append('<option value="' + response[i].code + '">' + response[i].name +
                            '</option>');
                    }

                    $('#city').trigger('change');
                }
            });
        }

        function getDistrict(city) {
            console.log('getDistrict');
            const cityCode = city.value;
            $.ajax({
                type: 'GET',
                url: '{{ url('districts') }}/' + cityCode,
                data: {
                    city_code: cityCode
                },
                success: function(response) {
                    console.log(response);

                    $('#district').empty();

                    for (i = 0; i < response.length; i++) {
                        $('#district').append('<option value="' + response[i].code + '">' + response[i].name +
                            '</option>');
                    }

                    $('#district').trigger('change');
                }

            });
        }

        function getVillage(district) {
            console.log('getVillage');
            const districtCode = district.value;
            $.ajax({
                type: 'GET',
                url: '{{ url('villages') }}/' + districtCode,
                data: {
                    district_code: districtCode
                },
                success: function(response) {
                    console.log(response);

                    $('#village').empty();

                    for (i = 0; i < response.length; i++) {
                        $('#village').append('<option value="' + response[i].code + '">' + response[i].name +
                            '</option>');
                    }

                    $('#village').trigger('change');
                }
            });
        }
    </script>

    <script>
        $(document).ready(function() {
            $('#province, #city, #district, #village').select2({
                theme: 'bootstrap-5',
                placeholder: $( this ).data( 'placeholder' ),
            });
        });
        // const elements = document.querySelectorAll('#province, #city, #district, #village');
        // elements.forEach(element => {
        //     new Choices(element, {
        //         searchEnabled: true, // Mengaktifkan fitur pencarian
        //         searchChoices: true, // Mengaktifkan pencarian saat mengetik
        //         itemSelectText: 'Press to Select', // Mengubah teks yang ditampilkan saat item dipilih (opsional)
        //         allowHTML: true,
        //     });
        // });
    </script>
@endpush
