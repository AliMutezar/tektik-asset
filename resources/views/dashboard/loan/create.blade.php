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

                                <form class="form" action="{{ route('loans.store') }}" method="POST"
                                    enctype="multipart/form-data">
                                    @csrf

                                    <div class="row mb-4">
                                        <div class="col-md-6 col-12 mt-3">
                                            <div class="form-group">
                                                <label for="loan_code" class="mb-2">Loan Code</label>
                                                <input type="text"
                                                    class="form-control form-control-lg @error('loan_code') is-invalid @enderror"
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
                                            <label for="loan_user_id" class="mb-2">Employee Borrowed</label>
                                            <div class="form-group  @error('loan_user_id') is-invalid @enderror">
                                                <select class="form-select choices" name="loan_user_id" id="user">
                                                    <option value="" disabled>Select User</option>

                                                    @foreach ($users as $user)

                                                    <option value="{{ $user->id}}" @if (old('loan_user_id') == $user->id) selected @endif>
                                                        {{ $user->name}}
                                                    </option>

                                                    @endforeach

                                                </select>
                                                @error('loan_user_id')
                                                <div class="invalid-feedback" style="margin-top:-1.25rem; display: block;">
                                                    {{ $message }}
                                                </div>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row mb-4">
                                        <div class="col-md-6 col-12 mt-3">
                                            <label for="asset" class="mb-2">Asset</label>
                                            <div class="form-group @error('asset_id') is-invalid @enderror">
                                                <select class="form-select choices" name="asset_id[]" id="assets">
                                                    <option value="" disabled>Select Asset</option>

                                                    @foreach ($assets as $asset)
                                                    <p>test {{ $asset->id }}</p>
                                                    <option value="{{ $asset->id}}" @if (in_array($asset->id, old('asset_id', []))) selected @endif>
                                                        {{ $asset->asset_name . ' - ' . $asset->stock_unit . ' - ' . $asset->vendor->company_name}}
                                                    </option>

                                                    @endforeach

                                                </select>
                                                @error('asset_id')
                                                <div class="invalid-feedback" style="margin-top:-1.25rem; display: block;">
                                                    {{ $message }}
                                                </div>
                                                @enderror
                                            </div>
                                        </div>

                                        <div class="col-md-6 col-12 mt-3">
                                            <div class="form-group">
                                                <label for="unit_borrowed" class="mb-2">Units</label>
                                                <input type="number" class="form-control form-control-lg @error('unit_borrowed') is-invalid @enderror"
                                                    placeholder="Total Borrowed" name="unit_borrowed[]" min="0" max="4" required>
                                                
                                                @error('unit_borrowed')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                                @enderror
                                            </div>
                                        </div>

                                        <div class="col-md-6 col-12" id="newAssetRow"></div>
                                        <div class="col-md-6 col-12" id="newUnitRow"></div>

                                        <div class="col-md-4 col-12 mt-3 d-flex gap-3">
                                            <a href="#"
                                                class="btn text-center icon icon-left btn-primary btn-sm d-flex align-items-center justify-content-center"
                                                id="addAsset">
                                                <i data-feather="plus" class="me-2"></i> Add Asset
                                            </a>
                                            <div id="deleteAssetContainer" style="display: none;">
                                                <a href="#"
                                                    class="btn text-center icon icon-left btn-outline-danger btn-sm d-flex align-items-center justify-content-center"
                                                    id="deleteAsset">
                                                    <i data-feather="x" class="me-2"></i> Delete Asset
                                                </a>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row my-4 g-3">
                                        <div class="col-md-6 col-12">
                                            <label for="date_receipt" class="form-label">Date Receipt</label>
                                            <div class="input-group"
                                                data-target-input="nearest">
                                                <input type="date"
                                                    class="form-control form-control-lg @error('date_receipt') is-invalid @enderror"
                                                    name="date_receipt" value="{{ old('date_receipt') }}" />

                                                @error('date_receipt')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-md-6 col-12">
                                            <label for="#" class="form-label mb-2">Photo Receipt</label>
                                            <input class="form-control form-control-lg @error('photo_receipt') is-invalid @enderror" id="#" type="file" name="photo_receipt">

                                            @error('photo_receipt')
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
    var incrementalId = 2;
    $(document).ready(function () {
        $('#addAsset').click(function () {
            // console.log("test tombol");
            var newRowAsset = '';
            newRowAsset += `
            <div class="form-group @error('asset_id') is-invalid @enderror" id="rowAsset${incrementalId}">
                <label for="asset" class="mb-2">Asset ${incrementalId}</label>
                    <select class="form-select choices" name="asset_id[]" id="newAssets${incrementalId}">
                        <option value="" disabled>Select Asset</option>

                        @foreach ($assets as $asset)
                            
                            <option value="{{ $asset->id}}">{{ $asset->asset_name . ' - ' . $asset->stock_unit . ' - ' . $asset->vendor->company_name}}</option>
                        
                        @endforeach

                    </select>
                    @error('asset_id')
                    <div class="invalid-feedback" style="display: block;">
                        {{ $message }}
                    </div>
                    @enderror
            </div>`;

            $('#newAssetRow').append(newRowAsset);

            var newRowUnit = '';
            newRowUnit += `
                <div class="form-group" id="rowUnit${incrementalId}">
                    <label for="unit_borrowed" class="mb-2">Units ${incrementalId}</label>
                    <input type="number"
                        class="form-control form-control-lg @error('unit_borrowed') is-invalid @enderror"
                        placeholder="Total Borrowed" name="unit_borrowed[]" min=0
                        id="unit_borrowed${incrementalId}">

                    @error('unit_borrowed')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                    @enderror
                </div>`;

            $('#newUnitRow').append(newRowUnit);

            const element = document.querySelector(`#newAssets${incrementalId}`);
            new Choices(element, {
                searchEnabled: true, // Mengaktifkan fitur pencarian
                searchChoices: true, // Mengaktifkan pencarian saat mengetik
                itemSelectText: 'Press to Select', // Mengubah teks yang ditampilkan saat item dipilih (opsional)
                allowHTML: true,
            });

            incrementalId++;

            // log biar tau kenapa harus di kurangain incrementalId--
            console.log(incrementalId);

            if (incrementalId > 2) {
                $('#deleteAssetContainer').show();
            }
        });

        $('#deleteAsset').click(function () {
            // Mengurangi incrementalId sebelum menghapus elemen
            incrementalId--;

            $(`#rowAsset${incrementalId}`).remove();
            $(`#rowUnit${incrementalId}`).remove();

            if (incrementalId === 2) {
                $('#deleteAssetContainer').hide();
            }
        });

        const elements = document.querySelectorAll('#assets, #user');
        elements.forEach(element => {
            new Choices(element, {
                searchEnabled: true,
                searchChoices: true,
                itemSelectText: 'Press to Select',
                allowHTML: true
            })
        });
    });
</script>
@endpush