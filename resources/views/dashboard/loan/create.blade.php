@extends('layouts.app')
@section('title', 'Add Asset Loan')

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
                            <li class="breadcrumb-item active" aria-current="page">Add Asset Loan</li>
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
                                    <h4 class="card-title">Add New Asset Loan</h4>
                                </div>
                            </div>
                        </div>
                        <div class="card-content">
                            <div class="card-body">

                                <form class="form" action="{{ route('loans.store') }}" method="POST"
                                    enctype="multipart/form-data">
                                    @csrf

                                    <div class="row my-4">
                                        <div class="col-md-6 col-12">
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

                                        <div class="col-md-6 col-12">
                                            <label for="loan_user_id" class="mb-2">Employee Borrowed</label>
                                            <div class="form-group  @error('loan_user_id') is-invalid @enderror">
                                                <select class="form-select choices" name="loan_user_id" id="user">
                                                    <option value="" disabled>Select User</option>

                                                    @foreach ($users as $user)

                                                    <option value="{{ $user->id}}" @if (old('loan_user_id')==$user->id)
                                                        selected @endif>
                                                        {{ $user->name}}
                                                    </option>

                                                    @endforeach

                                                </select>
                                                @error('loan_user_id')
                                                <div class="invalid-feedback"
                                                    style="margin-top:-1.25rem; display: block;">
                                                    {{ $message }}
                                                </div>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row my-4">
                                        <div class="col-md-6 col-12">
                                            <label for="asset" class="mb-2">Asset</label>
                                            <div class="form-group @error('asset_id') is-invalid @enderror">
                                                <select class="form-select choices" name="asset_id[]" id="assets">
                                                    <option value="" disabled>Select Asset</option>

                                                    @foreach ($assets as $asset)
                                                    <option value="{{ $asset->id}}"
                                                        data-stock="{{ $asset->stock_unit }}" @if (in_array($asset->id,
                                                        old('asset_id', []))) selected @endif>
                                                        {{ $asset->asset_name . ' - Stock ' . $asset->stock_unit . ' - '
                                                        . $asset->vendor->company_name}}
                                                    </option>

                                                    @endforeach

                                                </select>
                                                @error('asset_id')
                                                <div class="invalid-feedback"
                                                    style="margin-top:-1.25rem; display: block;">
                                                    {{ $message }}
                                                </div>
                                                @enderror
                                            </div>
                                        </div>

                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <label for="unit_borrowed" class="mb-2">Units</label>
                                                <div class="gap-3 col-12 d-flex align-items-center">
                                                    <button type="button"
                                                        class="btn btn-outline-primary decreaseButton">-</button>
                                                    <input type="number" name="unit_borrowed[]"
                                                        class="numberInput text-center form-control form-control-lg @error('unit_borrowed') is-invalid @enderror"
                                                        min="1" readonly>
                                                    <button type="button"
                                                        class="btn btn-outline-primary increaseButton">+</button>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-md-6 col-12" id="newAssetRow"></div>
                                        <div class="col-md-3" id="newUnitRow"></div>

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

                                    <div class="row my-4">
                                        <div class="col-md-6 col-12 mt-3">
                                            <label for="date_receipt" class="form-label">Date Receipt</label>
                                            <div class="input-group" data-target-input="nearest">
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
                                        <div class="col-md-6 col-12 mt-3">
                                            <label for="#" class="form-label mb-2">Photo Receipt</label>
                                            <input
                                                class="form-control form-control-lg @error('photo_receipt') is-invalid @enderror"
                                                id="#" type="file" name="photo_receipt">

                                            @error('photo_receipt')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                            @enderror
                                        </div>
                                    </div>

                                    {{-- Signature --}}
                                    {{-- <div class="row my-4 p-2 d-flex justify-content-between">
                                        <div class="col-md-5 shadow p-3 @error('signature_loan') border border-danger @enderror">
                                            <label for="signature_loan" class="form-label mt-3">Borrower Signature</label>
                                                <canvas id="example"></canvas>
                                                <button class="btn" type="button" onclick="sketchpad.undo();">Undo</button>
                                                <button class="btn" type="button" onclick="sketchpad.redo();">Redo</button>
                                                <input type="text"  name="signature_loan">

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
    $(document).ready(function() {
        const decreaseButtons = $('.decreaseButton');
        const increaseButtons = $('.increaseButton');
        const numberInputs = $('.numberInput');

        // Fungsi untuk mengatur status tombol berdasarkan nilai saat ini
        function updateButtonStatus(numberInput, decreaseButton, increaseButton) {
            const currentNumber = parseInt(numberInput.val());
            decreaseButton.prop('disabled', currentNumber <= 1);
        }

        // Mengatur nilai awal input number dan memperbarui status tombol saat halaman dimuat
        numberInputs.val('1');
        numberInputs.each(function(index, element) {
            const decreaseButton = decreaseButtons.eq(index);
            const increaseButton = increaseButtons.eq(index);
            updateButtonStatus($(element), decreaseButton, increaseButton);
        });

        // Event listener untuk tombol decrease
        decreaseButtons.on('click', function(event) {
            event.preventDefault();
            const index = decreaseButtons.index(this);
            const numberInput = numberInputs.eq(index);
            const decreaseButton = decreaseButtons.eq(index);
            const increaseButton = increaseButtons.eq(index);
            let currentNumber = parseInt(numberInput.val());
            if (currentNumber > 1) {
                currentNumber--;
                numberInput.val(currentNumber);
                updateButtonStatus(numberInput, decreaseButton, increaseButton);
            }
        });

        // Event listener untuk tombol increase
        increaseButtons.on('click', function(event) {
            event.preventDefault();
            const index = increaseButtons.index(this);
            const numberInput = numberInputs.eq(index);
            const decreaseButton = decreaseButtons.eq(index);
            const increaseButton = increaseButtons.eq(index);
            let currentNumber = parseInt(numberInput.val());
            currentNumber++;
            numberInput.val(currentNumber);
            updateButtonStatus(numberInput, decreaseButton, increaseButton);
        });
    });
</script>

<script>
    var incrementalId = 2;
    $(document).ready(function () {
        $('#addAsset').click(function () {
            var newRowAsset = '';
            newRowAsset += `
            <div class="form-group @error('asset_id') is-invalid @enderror" id="rowAsset${incrementalId}">
                <label for="asset" class="mb-2">Asset ${incrementalId}</label>
                <select class="form-select choices" name="asset_id[]" id="newAssets${incrementalId}">
                    <option value="" disabled>Select Asset</option>
                    @foreach ($assets as $asset)
                        <option value="{{ $asset->id}}">{{ $asset->asset_name . ' - Stock ' . $asset->stock_unit . ' - ' . $asset->vendor->company_name}}</option>
                    @endforeach
                </select>
            </div>`;

            $('#newAssetRow').append(newRowAsset);

            var newRowUnit = '';
            newRowUnit += `
            <div class="form-group" id="rowUnit${incrementalId}">
                <label for="unit_borrowed" class="mb-2">Units ${incrementalId}</label>
                <div class="gap-3 col-12 d-flex align-items-center">
                    <button class="btn btn-outline-primary decreaseButton" data-row="${incrementalId}">-</button>
                    <input type="number"  name="unit_borrowed[]" class="numberInput text-center form-control form-control-lg @error('unit_borrowed') is-invalid @enderror" min="1" value="1" readonly>
                    <button class="btn btn-outline-primary increaseButton" data-row="${incrementalId}">+</button>
                </div>
            </div>`;

            $('#newUnitRow').append(newRowUnit);

            const element = document.querySelector(`#newAssets${incrementalId}`);
            new Choices(element, {
                searchEnabled: true,
                searchChoices: true,
                itemSelectText: 'Press to Select',
                allowHTML: true,
            });

            incrementalId++;

            if(incrementalId > 2) {
                $('#deleteAssetContainer').show();
            }
        });

        $('#newUnitRow').on('click', '.decreaseButton', function (event) {
            event.preventDefault();
            const rowId = $(this).data('row');
            const numberInput = $(`#rowUnit${rowId} .numberInput`);
            let currentNumber = parseInt(numberInput.val());
            if (currentNumber > 1) {
                currentNumber--;
                numberInput.val(currentNumber);
            }
        });

        $('#newUnitRow').on('click', '.increaseButton', function (event) {
            event.preventDefault();
            const rowId = $(this).data('row');
            const numberInput = $(`#rowUnit${rowId} .numberInput`);
            let currentNumber = parseInt(numberInput.val());
            currentNumber++;
            numberInput.val(currentNumber);
        });

        $('#deleteAsset').click(function () {
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
                allowHTML: true,
            });
        });
    });
</script>

<script>
    $(document).ready(function() {
        $('#signature').signature({
            background: '#537188',
            color: '#ffffff'
        });
    });

    var sketchpad = new Sketchpad({
        element: '#example',
        width: 320,
        height: 300,
    });

    console.log("test " + sketchpad.toJSON()); 
</script>

@endpush