@extends('layouts.app')
@section('title', 'Add Asset')

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
                            <li class="breadcrumb-item"><a href="{{ route('asets.index') }}">Asset</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Add Asset</li>
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
                                    <h4 class="card-title">Add New Asset</h4>
                                </div>
                            </div>
                        </div>
                        <div class="card-content">
                            <div class="card-body">

                                <form class="form" action="{{ route('asets.store') }}" method="POST">
                                    @csrf

                                    <div class="row mb-4">
                                        <div class="col-md-6 col-12 mt-3">
                                            <label for="vendor" class="mb-2">Vendor Name</label>
                                            <div class="form-group @error('vendor_id') is-invalid @enderror">
                                                <select class="single-select2 form-select form-select form-control-lg" name="vendor_id" id="vendor" data-placeholder="Select Vendor">
                                                    <option value="">Select Vendor</option>

                                                    @foreach ($vendors as $vendor)
                                                        <option value="{{ $vendor->id }}">{{ $vendor->company_name }}</option>
                                                    @endforeach

                                                </select>
                                                @error('vendor_id')
                                                <div class="invalid-feedback" style="display: block; margin-top: -1.25rem;">
                                                    {{ $message }}
                                                </div>
                                                @enderror
                                            </div>
                                        </div>

                                        <div class="col-md-6 col-12 mt-3">
                                            <label for="category" class="mb-2">Category</label>
                                            <div class="form-group @error('category_asset_id') is-invalid @enderror">
                                                <select class="single-select2 form-select form-select form-control-lg" name="category_asset_id" id="category" data-placeholder="Select Category">
                                                    <option value="">Select Category</option>

                                                    @foreach ($categories as $category)
                                                        <option value="{{ $category->id }}">{{ $category->name }}</option>
                                                    @endforeach

                                                </select>
                                                @error('category_asset_id')
                                                <div class="invalid-feedback" style="display: block; margin-top: -1.25rem;">
                                                    {{ $message }}
                                                </div>
                                                @enderror
                                            </div>
                                        </div>

                                        <div class="col-md-6 col-12 mt-3">
                                            <div class="form-group">
                                                <label for="asset_name" class="mb-2">Asset Name</label>
                                                <input type="text"
                                                    class="form-control form-control-lg @error('asset_name') is-invalid @enderror"
                                                    placeholder="Exp: Laptop or Camera etc" name="asset_name"
                                                    value="{{ old('asset_name') }}">

                                                @error('asset_name')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                                @enderror
                                            </div>
                                        </div>

                                        

                                        <div class="col-md-6 col-12 mt-3">
                                            <label for="condition" class="mb-2">Asset Condition</label>
                                            <div class="form-group @error('condition') is-invalid @enderror">
                                                <select class="form-select single-select2" name="condition" id="condition" data-placeholder="Select Condition">
                                                    <option value="" disabled selected>Select Condition</option>
                                                        <option value="good">Good</option>
                                                        <option value="not bad">Not Bad</option>
                                                        <option value="bad">Bad</option>
                                                </select>

                                                @error('condition')
                                                <div class="invalid-feedback" style="display: block;">
                                                    {{ $message }}
                                                </div>
                                                @enderror
                                            </div>
                                        </div>

                                        <div class="col-md-6 col-12 my-3">
                                            <div class="form-group">
                                                <label for="price_unit" class="mb-2">Price / unit</label>
                                                <input type="number"
                                                    class="form-control form-control-lg @error('price_unit') is-invalid @enderror"
                                                    placeholder="The Price of The Asset" name="price_unit"
                                                    value="{{ old('price_unit') }}" min="0">

                                                @error('price_unit')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                                @enderror
                                            </div>
                                        </div>

                                        <div class="col-md-6 col-12 my-3">
                                            <div class="form-group">
                                                <label for="stock_unit" class="mb-2">Asset Stock</label>
                                                <input type="number"
                                                    class="form-control form-control-lg @error('stock_unit') is-invalid @enderror"
                                                    placeholder="Stock of Asset" name="stock_unit"
                                                    value="{{ old('stock_unit') }}" min="0">

                                                @error('stock_unit')
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
@endsection

@push('after-script')
   <script src="{{ url('assets/js/id_location.js') }}"></script>
   @include('includes.select2')
   {{-- <script>
        const elements = document.querySelectorAll('#vendor, #condition')
        elements.forEach(element => {
            new Choices(element, {
                searchEnabled: true,
                searchChoices: true,
                itemSelectText: 'Press to Select',
                allowHTML: true
            });
        });
   </script> --}}
@endpush
