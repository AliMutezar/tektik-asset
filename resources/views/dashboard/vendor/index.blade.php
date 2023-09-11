@extends('layouts.app')
@section('title', 'Vendor')

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
                            <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Master Data</li>
                            <li class="breadcrumb-item active" aria-current="page">Vendor</li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>

        <!-- Basic Tables start -->
        <section class="section">
            <div class="card">
                <div class="card-header">
                    <div class="col-sm-6 col-md-12 d-flex justify-content-between">
                        {{ $title }}

                        <a href="{{ route('vendors.create') }}" class="btn icon icon-left btn-primary btn-sm d-flex align-items-center"><i data-feather="plus" class="me-2"></i> Add Vendor</a>
                    </div>
                </div>
                <div class="card-body mt-3">
                    <table class="table display nowrap table-hover" style="width: 100%" id="data-table">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Company</th>
                                <th>PIC</th>
                                <th>Phone</th>
                                <th>Adress</th>
                                <th>Province</th>
                                <th>City</th>
                                <th>District</th>
                                <th>Village</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($vendors as $vendor)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $vendor->company_name }}</td>
                                <td>{{ $vendor->pic }}</td>
                                <td>{{ $vendor->phone }}</td>
                                <td>{{ $vendor->address }}</td>
                                <td>{{ $vendor->province->name ?? ''}}</td>
                                <td>{{ $vendor->city->name ?? ''}}</td>
                                <td>{{ $vendor->district->name ?? '' }}</td>
                                <td>{{ $vendor->village->name ?? '' }}</td>
                                <td>
                                    <div class="d-flex">
                                        <a href="{{ route('vendors.edit', ['vendor' => $vendor->id]) }}" class="icon me-3"><i class="bi bi-pencil-fill" style="font-size: 0.8rem;"></i></a>
                                        <form action="{{ route('vendors.destroy', ['vendor' => $vendor->id]) }}" method="POST" id="deleteForm{{ $vendor->id }}">
                                            @csrf
                                            @method('DELETE')
                                            
                                            <a href="#" class="icon text-danger" onclick="confirmDelete(event, '{{ $vendor->id }}')"><i class="bi bi-x" style="font-size: 1.2rem;"></i></a>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                            @endforeach
                            
                        </tbody>
                    </table>
                </div>
            </div>

        </section>
        <!-- Basic Tables end -->
    </div>

    @include('includes.footer')
</div>
@endsection