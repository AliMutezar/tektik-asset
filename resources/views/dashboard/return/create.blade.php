@extends('layouts.app')
@section('title', 'Add Asset Return')

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
                            <li class="breadcrumb-item"><a href="{{ route('returns.index') }}">Returns</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Add Asset Return</li>
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
                                    <h4 class="card-title">Add New Asset Return</h4>
                                </div>
                            </div>
                        </div>
                        <div class="card-content">
                            <div class="card-body">

                                <form class="form" action="{{ route('returns.store') }}" method="POST"
                                    enctype="multipart/form-data">
                                    @csrf

                                    <div class="row mb-4">
                                        <div class="col-md-6 col-12 mt-3">
                                            <div class="form-group">
                                                <label for="return_code" class="mb-2">Return Code</label>
                                                <input type="text"
                                                    class="form-control form-control-lg @error('return_code') is-invalid @enderror"
                                                    placeholder="return-####" name="return_code"
                                                    value="{{ old('return_code') }}">

                                                @error('return_code')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                                @enderror
                                            </div>
                                        </div>

                                        <div class="col-md-6 col-12 mt-3">
                                            <label for="loan_id" class="mb-2">Loan Code</label>
                                            <div class="form-group  @error('loan_id') is-invalid @enderror">
                                                <select class="form-select choices" name="loan_id" id="loan">
                                                    <option value="" disabled>Select Loan Code</option>

                                                    @foreach ($loans as $loan)

                                                    <option value="{{ $loan->id}}" @if (old('loan_id') == $loan->id) selected @endif>
                                                        {{ $loan->loan_code . " - " . $loan->user->name}}
                                                    </option>

                                                    @endforeach

                                                </select>
                                                @error('loan_id')
                                                <div class="invalid-feedback" style="margin-top:-1.25rem; display: block;">
                                                    {{ $message }}
                                                </div>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row my-4 g-3">
                                        <div class="col-md-6 col-12">
                                            <label for="date_returned" class="form-label">Date Returned</label>
                                            <div class="input-group"
                                                data-target-input="nearest">
                                                <input type="date"
                                                    class="form-control form-control-lg @error('date_returned') is-invalid @enderror"
                                                    name="date_returned" value="{{ old('date_returned') }}" />

                                                @error('date_returned')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                                @enderror
                                            </div>
                                        </div>

                                        <div class="col-md-6 col-12">
                                            <label for="photo_returned" class="form-label mb-2">Photo Asset Return</label>
                                            <input class="form-control form-control-lg @error('photo_returned') is-invalid @enderror" id="photo_returned" type="file" name="photo_returned">

                                            @error('photo_returned')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="col-12 d-grid gap-2 mt-3 d-md-block mt-5">
                                        <button type="submit" class="btn btn-primary me-1">Save</button>
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
    <script>
        const elements = document.querySelectorAll('#loan');
        elements.forEach(element => {
            new Choices(element, {
                searchEnabled: true,
                searchChoices: true,
                itemSelectText: 'Press to Select',
                allowHTML: true,
            });
        });
    </script>    

@endpush