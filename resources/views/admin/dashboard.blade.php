@extends('admin.master')

@section('title', 'Dashboard')

@section('content')
<main class="app-main">
    <div class="app-content-header">
        <div class="container-fluid">
            <div class="row">
                <div class="col-sm-6">
                    <h3 class="mb-0">Dashboard</h3>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-end">
                        <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Home</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Dashboard</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>

    <div class="app-content">
        <div class="container-fluid">
            <div class="row">
                <!-- Total Orders -->
                <div class="col-lg-3 col-6">
                    <div class="small-box text-bg-primary">
                        <div class="inner">
                            <h3>{{ $totalOrders }}</h3>
                            <p>Total Orders</p>
                        </div>
                        <a href="{{ route('admin.orders.index') }}" class="small-box-footer">
                            More info <i class="bi bi-link-45deg"></i>
                        </a>
                    </div>
                </div>

                <!-- Bounce Rate (Bisa diganti dengan data lain) -->
                <div class="col-lg-3 col-6">
                    <div class="small-box text-bg-success">
                        <div class="inner">
                            <h3>{{ $totalEvents }}</h3>
                            <p>Total Events</p>
                        </div>
                        <a href="{{ route('admin.events.index') }}" class="small-box-footer">
                            More info <i class="bi bi-link-45deg"></i>
                        </a>
                    </div>
                </div>

                <!-- Total Users -->
                <div class="col-lg-3 col-6">
                    <div class="small-box text-bg-warning">
                        <div class="inner">
                            <h3>{{ $totalUsers }}</h3>
                            <p>User Registrations</p>
                        </div>
                        <a href="{{ route('admin.users.index') }}" class="small-box-footer">
                            More info <i class="bi bi-link-45deg"></i>
                        </a>
                    </div>
                </div>

                <!-- Total Tickets -->
                <div class="col-lg-3 col-6">
                    <div class="small-box text-bg-danger">
                        <div class="inner">
                            <h3>{{ $totalTickets }}</h3>
                            <p>Total Tickets</p>
                        </div>
                        <a href="{{ route('admin.tickets.index') }}" class="small-box-footer">
                            More info <i class="bi bi-link-45deg"></i>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>
@endsection