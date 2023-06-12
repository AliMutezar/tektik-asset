@extends('layouts.app')
@section('title', 'Add Loan')

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
                            <li class="breadcrumb-item"><a href="{{ route('loans.index') }}">Loans</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Add Loan</li>
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
                                    <h4 class="card-title">Add New Loan</h4>
                                </div>
                            </div>
                        </div>
                        <div class="card-content">
                            <div class="card-body">

                                <form class="form" action="{{ route('loans.store') }}" method="POST" enctype="multipart/form-data">
                                    @csrf

                                    <div class="row mb-4">
                                        <div class="col-md-6 col-12 mt-3">
                                            <div class="form-group">
                                                <label for="loan_code" class="mb-2">Loan Code</label>
                                                <input type="text"
                                                    class="form-control @error('loan_code') is-invalid @enderror"
                                                    placeholder="loan-####" name="loan_code"
                                                    value="{{ old('loan_code') }}">

                                                @error('loan_code')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                                @enderror
                                            </div>
                                        </div>

                                        <div class="col-md-6 col-12 mt-3">
                                            <label for="asset" class="mb-2">Asset</label>
                                            <div class="form-group @error('asset_id') is-invalid @enderror">
                                                <select class="form-select choices" name="asset_id" id="asset">
                                                    <option value="" disabled>Select Asset</option>

                                                    @foreach ($assets as $asset)
                                                        
                                                        <option value="{{ $asset->id}}">{{ $asset->asset_name . ' - ' . $asset->vendor->company_name}}</option>
                                                    
                                                    @endforeach

                                                </select>
                                                @error('asset_id')
                                                <div class="invalid-feedback" style="display: block;">
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