<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Contact Our Team</title>

    @include('includes.style')
    <link rel="stylesheet" href="{{ url('assets/css/shared/iconly.css') }}">
    </style>
</head>

<body>
    <div id="app">

        <div class="container mt-5">
            <div class="card">
                <h1 class="card-header text-white bg-primary">Contact Our Team</h1>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6 col-12 p-3 text-center">
                            <div class="card shadow pt-5" style="height: 300px">
                                <h4>Gunawan Wibisono | Candra Chozinul Asror</h4>
                                <h2>Team IT</h2>
                                <h6>Contact Person : +62-821-1332-4411 | +62 819-3253-1683</h6>
                            </div>
                        </div>
                        <div class="col-md-6 col-12 p-3 text-center">
                            <div class="card shadow pt-5" style="height: 300px">
                                <h4>Ali Mutezar | Restu Wibowo</h4>
                                <h2>Developer</h2>
                                <h6>Contact Person : +62-821-1332-4411 | +62 819-3253-1683</h6>
                            </div>
                        </div>
                    </div>
                    <a href="{{ route('dashboard')}}" class="btn btn-primary">Back</a>
                </div>
            </div>
        </div>

        @include('includes.script')
        @include('includes.sweetalerts')
    </div>

</body>

</html>