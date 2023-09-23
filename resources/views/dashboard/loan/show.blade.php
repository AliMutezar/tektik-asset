@extends('layouts.app')
@section('title', $title)

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
                            <li class="breadcrumb-item active" aria-current="page">{{ $active_breadcrumb }}</li>
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
                                    <h4 class="card-title">{{ $title }}</h4>
                                </div>
                            </div>
                        </div>
                        <div class="card-content">
                            <div class="card-body">

                                <div class="row">
                                    <div class="col-md-6 col-12">
                                        <div class="form-group">
                                            <label for="loan_code" class="mb-2">Loan Code</label>
                                            <input type="text" class="form-control form-control-lg"
                                                value="{{ $record->loan_code }}" @readonly(true)>
                                        </div>
                                    </div>

                                    <div class="col-md-6 col-12">
                                        <div class="form-group">
                                            <label for="loan_user_id" class="mb-2">Employee Borrowed</label>
                                            <input type="text" class="form-control form-control-lg"
                                                value="{{ $record->user->name }}" @readonly(true)>
                                        </div>
                                    </div>

                                    <div class="col-12">
                                        <div class="table-responsive">
                                            <table class="table table-lg">
                                                <thead>
                                                    <tr>
                                                        <th>Asset</th>
                                                        <th>Serial Number</th>
                                                        <th>Vendor</th>
                                                        <th>Jumlah dipinjam</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @foreach ($record->assets as $data)
                                                    <tr>
                                                        <td>{{ $data->asset_name }}</td>
                                                        <td>
                                                            @if(!$data->pivot->serial_number)
                                                            <b> - </b>
                                                            @else
                                                            {{ $data->pivot->serial_number }}
                                                            @endif
                                                        </td>
                                                        <td>{{ $data->vendor->company_name }}</td>
                                                        <td>{{ $data->pivot->unit_borrowed }}</td>
                                                    </tr>
                                                    @endforeach
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>

                                <div class="row my-4">
                                    <div class="col-md-6 col-12 mt-3">
                                        <label for="date_receipt" class="form-label">Date Receipt</label>
                                        <div class="input-group" data-target-input="nearest">
                                            <input type="date"
                                                class="form-control form-control-lg @error('date_receipt') is-invalid @enderror"
                                                name="date_receipt" value="{{ old('date_receipt', $record->date_receipt) }}" disabled/>

                                            @error('date_receipt')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-6 col-12 text-center">
                                        <img src="{{ asset('storage/photo_receipt/'. $record->photo_receipt) }}" alt="photo receipt" width="50%" height="auto">
                                    </div>
                                </div>
                                <div class="row my-4 p-2 d-flex justify-content-between">
                                    <div
                                        class="col-md-5 shadow p-3">
                                       <h6>Admin</h6>
                                       <img src="{{ asset('storage/signature/admin/'. $record->signature_admin) }}" alt="">

                                    </div>

                                    <div class="col-md-5 shadow p-3">
                                        <h6>Borrower</h6>
                                       <img src="{{ asset('storage/signature/borrower/'. $record->signature_borrower) }}" alt="">
                                    </div>
                                </div>
                                {{-- Signature --}}
                                {{-- <div class="row my-4 p-2 d-flex justify-content-between">
                                    <div
                                        class="col-md-5 shadow p-3 @error('signature_loan') border border-danger @enderror">
                                        <label for="signature_loan" class="form-label mt-3">Borrower Signature</label>
                                        <canvas id="example"></canvas>
                                        <button class="btn" type="button" onclick="sketchpad.undo();">Undo</button>
                                        <button class="btn" type="button" onclick="sketchpad.redo();">Redo</button>
                                        <input type="text" name="signature_loan">

                                        @error('signature_loan')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                        @enderror

                                    </div>

                                    <div class="col-md-5 shadow">
                                        <label for="" class="form-label mt-3">Admin Signature</label>
                                        <div id="signature"></div>
                                        <input type="hidden" name="signature_loan">
                                    </div>
                                </div> --}}

                                <div class="col-12 d-grid gap-2 mt-3 d-md-block mt-5">
                                    <a role="button" href="{{ route('loans.index') }}"
                                        class="btn btn-primary me-1">Back</a>
                                </div>
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

@endpush