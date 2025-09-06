@extends('admin.layouts.app', ['panelType' => 'Dashboard'])

@section('title', 'ArtLine Dashboard - ' . ($store->title ?? 'Store'))

@section('sidebar')
<div class="px-3 py-2 border-bottom">
    <h6 class="text-muted mb-0">{{ $store->title ?? 'Store' }}</h6>
    <small class="text-muted">{{ $store->slug ?? 'store-slug' }}</small>
</div>

<ul class="nav flex-column">
    <li class="nav-item">
        <a class="nav-link active" href="{{ route('dashboard.index', $store->slug ?? 'store') }}">
            <i class="bi bi-house"></i> Dashboard
        </a>
    </li>
    <li class="nav-item">
        <a class="nav-link" href="{{ route('dashboard.categories.index', $store->slug ?? 'store') }}">
            <i class="bi bi-grid"></i> Categories
        </a>
    </li>
    <li class="nav-item">
        <a class="nav-link" href="{{ route('dashboard.products.index', $store->slug ?? 'store') }}">
            <i class="bi bi-box"></i> Products
        </a>
    </li>
    <li class="nav-item">
        <a class="nav-link" href="{{ route('dashboard.banners.index', $store->slug ?? 'store') }}">
            <i class="bi bi-image"></i> Banners
        </a>
    </li>
    <li class="nav-item">
        <a class="nav-link" href="{{ route('dashboard.product-options.index', $store->slug ?? 'store') }}">
            <i class="bi bi-list-ul"></i> Product Options
        </a>
    </li>
    <li class="nav-item">
        <a class="nav-link" href="{{ route('dashboard.vouchers.index', $store->slug ?? 'store') }}">
            <i class="bi bi-ticket-perforated"></i> Vouchers
        </a>
    </li>
    <li class="nav-item">
        <a class="nav-link" href="{{ route('dashboard.orders.index', $store->slug ?? 'store') }}">
            <i class="bi bi-cart"></i> Orders
        </a>
    </li>
</ul>

<h6 class="sidebar-heading d-flex justify-content-between align-items-center px-3 mt-4 mb-1 text-muted">
    <span>Store Management</span>
</h6>
<ul class="nav flex-column mb-2">
    <li class="nav-item">
        <a class="nav-link" href="{{ route('dashboard.employees.index', $store->slug ?? 'store') }}">
            <i class="bi bi-people"></i> Employees
        </a>
    </li>
    <li class="nav-item">
        <a class="nav-link" href="{{ route('dashboard.roles.index', $store->slug ?? 'store') }}">
            <i class="bi bi-shield"></i> Roles & Permissions
        </a>
    </li>
    <li class="nav-item">
        <a class="nav-link" href="{{ route('dashboard.settings.index', $store->slug ?? 'store') }}">
            <i class="bi bi-gear"></i> Store Settings
        </a>
    </li>
</ul>

<h6 class="sidebar-heading d-flex justify-content-between align-items-center px-3 mt-4 mb-1 text-muted">
    <span>Storefront</span>
</h6>
<ul class="nav flex-column mb-2">
    <li class="nav-item">
        <a class="nav-link" href="{{ url('/' . ($store->slug ?? 'store')) }}" target="_blank">
            <i class="bi bi-arrow-up-right-square"></i> View Storefront
        </a>
    </li>
</ul>
@endsection

@section('content')
<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
    <h1 class="h2">
        <i class="bi bi-shop text-primary"></i> {{ $store->title ?? 'Store Dashboard' }}
        @if($store->busy ?? false)
            <span class="badge bg-warning ms-2">Busy</span>
        @endif
    </h1>
    <div class="btn-toolbar mb-2 mb-md-0">
        <div class="btn-group me-2">
            <a href="{{ url('/' . ($store->slug ?? 'store')) }}" class="btn btn-sm btn-outline-primary" target="_blank">
                <i class="bi bi-eye"></i> View Store
            </a>
        </div>
        <div class="btn-group">
            <button type="button" class="btn btn-sm btn-outline-secondary dropdown-toggle" data-bs-toggle="dropdown">
                <i class="bi bi-gear"></i> Actions
            </button>
            <ul class="dropdown-menu">
                <li><a class="dropdown-item" href="{{ route('dashboard.settings.index', $store->slug ?? 'store') }}">
                    <i class="bi bi-gear"></i> Store Settings
                </a></li>
                <li><a class="dropdown-item" href="{{ route('dashboard.employees.index', $store->slug ?? 'store') }}">
                    <i class="bi bi-people"></i> Manage Team
                </a></li>
                <li><hr class="dropdown-divider"></li>
                <li><a class="dropdown-item" href="#">
                    <i class="bi bi-download"></i> Export Data
                </a></li>
            </ul>
        </div>
    </div>
</div>

<!-- Quick Stats -->
<div class="row">
    <div class="col-xl-3 col-md-6 mb-4">
        <div class="card border-left-primary shadow h-100 py-2">
            <div class="card-body">
                <div class="row no-gutters align-items-center">
                    <div class="col me-2">
                        <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                            Categories
                        </div>
                        <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $stats['categories'] ?? 0 }}</div>
                    </div>
                    <div class="col-auto">
                        <i class="bi bi-grid fa-2x text-gray-300"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="col-xl-3 col-md-6 mb-4">
        <div class="card border-left-success shadow h-100 py-2">
            <div class="card-body">
                <div class="row no-gutters align-items-center">
                    <div class="col me-2">
                        <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                            Products
                        </div>
                        <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $stats['products'] ?? 0 }}</div>
                    </div>
                    <div class="col-auto">
                        <i class="bi bi-box fa-2x text-gray-300"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="col-xl-3 col-md-6 mb-4">
        <div class="card border-left-info shadow h-100 py-2">
            <div class="card-body">
                <div class="row no-gutters align-items-center">
                    <div class="col me-2">
                        <div class="text-xs font-weight-bold text-info text-uppercase mb-1">
                            Orders (This Month)
                        </div>
                        <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $stats['orders'] ?? 0 }}</div>
                    </div>
                    <div class="col-auto">
                        <i class="bi bi-cart fa-2x text-gray-300"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="col-xl-3 col-md-6 mb-4">
        <div class="card border-left-warning shadow h-100 py-2">
            <div class="card-body">
                <div class="row no-gutters align-items-center">
                    <div class="col me-2">
                        <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">
                            Active Vouchers
                        </div>
                        <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $stats['vouchers'] ?? 0 }}</div>
                    </div>
                    <div class="col-auto">
                        <i class="bi bi-ticket-perforated fa-2x text-gray-300"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Quick Actions -->
<div class="row">
    <div class="col-lg-6 mb-4">
        <div class="card shadow">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Quick Actions</h6>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-6 mb-3">
                        <a href="{{ route('dashboard.products.create', $store->slug ?? 'store') }}" class="btn btn-primary w-100">
                            <i class="bi bi-plus-circle"></i><br>
                            Add Product
                        </a>
                    </div>
                    <div class="col-6 mb-3">
                        <a href="{{ route('dashboard.categories.create', $store->slug ?? 'store') }}" class="btn btn-success w-100">
                            <i class="bi bi-grid-3x3-gap"></i><br>
                            Add Category
                        </a>
                    </div>
                    <div class="col-6 mb-3">
                        <a href="{{ route('dashboard.banners.create', $store->slug ?? 'store') }}" class="btn btn-info w-100">
                            <i class="bi bi-image"></i><br>
                            Add Banner
                        </a>
                    </div>
                    <div class="col-6 mb-3">
                        <a href="{{ route('dashboard.vouchers.create', $store->slug ?? 'store') }}" class="btn btn-warning w-100">
                            <i class="bi bi-ticket-perforated"></i><br>
                            Create Voucher
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="col-lg-6 mb-4">
        <div class="card shadow">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Recent Activity</h6>
            </div>
            <div class="card-body">
                <div class="list-group list-group-flush">
                    @forelse($recent_activities ?? [] as $activity)
                    <div class="list-group-item">
                        <div class="d-flex w-100 justify-content-between">
                            <h6 class="mb-1">{{ $activity->action }}</h6>
                            <small>{{ $activity->created_at->diffForHumans() }}</small>
                        </div>
                        <p class="mb-1">{{ $activity->entity_type }} #{{ $activity->entity_id }}</p>
                        <small>by {{ $activity->actor->name ?? 'System' }}</small>
                    </div>
                    @empty
                    <div class="text-center text-muted py-3">
                        <i class="bi bi-clock-history fa-2x mb-2"></i>
                        <p>No recent activity</p>
                    </div>
                    @endforelse
                </div>
            </div>
        </div>
    </div>
</div>

@if($store->busy ?? false)
<!-- Busy Mode Alert -->
<div class="alert alert-warning" role="alert">
    <h4 class="alert-heading"><i class="bi bi-exclamation-triangle"></i> Store is in Busy Mode</h4>
    <p>Your store is currently in busy mode. Customers will see a maintenance message and cannot place orders.</p>
    <hr>
    <p class="mb-0">
        <a href="{{ route('dashboard.settings.index', $store->slug ?? 'store') }}" class="btn btn-warning">
            Change Store Settings
        </a>
    </p>
</div>
@endif
@endsection

@push('styles')
<style>
.border-left-primary { border-left: 0.25rem solid #4e73df !important; }
.border-left-success { border-left: 0.25rem solid #1cc88a !important; }
.border-left-info { border-left: 0.25rem solid #36b9cc !important; }
.border-left-warning { border-left: 0.25rem solid #f6c23e !important; }
</style>
@endpush
@endsection
