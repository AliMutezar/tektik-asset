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
                    <div class="card shadow">
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
                                                <select class="form-select single-select2" name="loan_id" id="loan" data-placeholder="Select Loan Code">
                                                    <option value="">Select Loan Code</option>

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

                                    <div class="row my-4 p-2 d-flex justify-content-between">
                                        <div class="col-md-5 shadow p-3 mb-3">
                                            <label class="form-label" for="signature_loan ">Admin Signature:</label>
                                            <br />
                                            <div id="signAdmin" class=""
                                                @error('signature_admin') border border-danger @enderror></div>
                                            <br />
                                            <button id="clearAdmin" class="btn btn-danger btn-sm">Clear
                                                Signature</button>
                                            <textarea id="signatureAdmin" name="signature_admin" style="display: none;"></textarea>

                                            @error('signature_admin')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                            @enderror

                                        </div>

                                        <div class="col-md-5 shadow p-3 mb-3">
                                            <label class="form-label" for="signature_returner">Returner
                                                Signature:</label>
                                            <br />
                                            <div id="signBorrower"
                                                @error('signature_admin') border border-danger @enderror></div>
                                            <br />
                                            <button id="clearBorrower" class="btn btn-danger btn-sm">Clear
                                                Signature</button>
                                            <textarea id="signatureBorrower" name="signature_returner" style="display: none;"></textarea>

                                            @error('signature_admin')
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

@include('includes.select2')
    {{-- <script>
        const elements = document.querySelectorAll('#loan');
        elements.forEach(element => {
            new Choices(element, {
                searchEnabled: true,
                searchChoices: true,
                itemSelectText: 'Press to Select',
                allowHTML: true,
            });
        });
    </script>     --}}

    <script type="text/javascript">
        var signAdmin = $('#signAdmin').signature({
            syncField: '#signatureAdmin',
            syncFormat: 'PNG'
        });
        $('#clearAdmin').click(function(e) {
            e.preventDefault();
            signAdmin.signature('clear');
            $("#signatureAdmin").val('');
        });
    </script>

    <script type="text/javascript">
        var signBorrower = $('#signBorrower').signature({
            syncField: '#signatureBorrower',
            syncFormat: 'PNG'
        });
        $('#clearBorrower').click(function(e) {
            e.preventDefault();
            signBorrower.signature('clear');
            $("#signatureBorrower").val('');
        });
    </script>

@endpush