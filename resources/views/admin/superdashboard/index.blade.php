@extends('admin.layouts.app', ['panelType' => 'SuperDashboard'])

@section('title', 'ArtLine SuperDashboard')

@section('sidebar')
<ul class="nav flex-column">
    <li class="nav-item">
        <a class="nav-link active" href="{{ route('superdashboard.index') }}">
            <i class="bi bi-house"></i> Dashboard
        </a>
    </li>
    <li class="nav-item">
        <a class="nav-link" href="{{ route('superdashboard.stores.index') }}">
            <i class="bi bi-shop"></i> Stores
        </a>
    </li>
    <li class="nav-item">
        <a class="nav-link" href="{{ route('superdashboard.users.index') }}">
            <i class="bi bi-people"></i> Users
        </a>
    </li>
    <li class="nav-item">
        <a class="nav-link" href="{{ route('superdashboard.soft-deleted.index') }}">
            <i class="bi bi-trash"></i> Soft Deleted Items
        </a>
    </li>
    <li class="nav-item">
        <a class="nav-link" href="{{ route('superdashboard.audit-logs.index') }}">
            <i class="bi bi-clock-history"></i> Audit Logs
        </a>
    </li>
</ul>

<h6 class="sidebar-heading d-flex justify-content-between align-items-center px-3 mt-4 mb-1 text-muted">
    <span>Store Management</span>
</h6>
<ul class="nav flex-column mb-2">
    <li class="nav-item">
        <a class="nav-link" href="{{ route('superdashboard.categories.index') }}">
            <i class="bi bi-grid"></i> All Categories
        </a>
    </li>
    <li class="nav-item">
        <a class="nav-link" href="{{ route('superdashboard.products.index') }}">
            <i class="bi bi-box"></i> All Products
        </a>
    </li>
    <li class="nav-item">
        <a class="nav-link" href="{{ route('superdashboard.vouchers.index') }}">
            <i class="bi bi-ticket-perforated"></i> All Vouchers
        </a>
    </li>
</ul>
@endsection

@section('content')
<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
    <h1 class="h2"><i class="bi bi-shield-check text-primary"></i> SuperDashboard</h1>
    <div class="btn-toolbar mb-2 mb-md-0">
        <div class="btn-group me-2">
            <button type="button" class="btn btn-sm btn-outline-secondary">
                <i class="bi bi-download"></i> Export
            </button>
        </div>
        <button type="button" class="btn btn-sm btn-primary" data-bs-toggle="modal" data-bs-target="#createStoreModal">
            <i class="bi bi-plus"></i> New Store
        </button>
    </div>
</div>

<!-- Statistics Cards -->
<div class="row">
    <div class="col-xl-3 col-md-6 mb-4">
        <div class="card border-left-primary shadow h-100 py-2">
            <div class="card-body">
                <div class="row no-gutters align-items-center">
                    <div class="col me-2">
                        <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                            Total Stores
                        </div>
                        <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $stats['total_stores'] ?? 0 }}</div>
                    </div>
                    <div class="col-auto">
                        <i class="bi bi-shop fa-2x text-gray-300"></i>
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
                            Active Stores
                        </div>
                        <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $stats['active_stores'] ?? 0 }}</div>
                    </div>
                    <div class="col-auto">
                        <i class="bi bi-check-circle fa-2x text-gray-300"></i>
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
                            Total Users
                        </div>
                        <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $stats['total_users'] ?? 0 }}</div>
                    </div>
                    <div class="col-auto">
                        <i class="bi bi-people fa-2x text-gray-300"></i>
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
                            Total Products
                        </div>
                        <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $stats['total_products'] ?? 0 }}</div>
                    </div>
                    <div class="col-auto">
                        <i class="bi bi-box fa-2x text-gray-300"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Recent Stores Table -->
<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">Recent Stores</h6>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered" width="100%" cellspacing="0">
                <thead>
                    <tr>
                        <th>Store</th>
                        <th>Title</th>
                        <th>Status</th>
                        <th>Shipping</th>
                        <th>Created</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($recent_stores ?? [] as $store)
                    <tr>
                        <td>
                            <strong>{{ $store->slug }}</strong>
                        </td>
                        <td>{{ $store->title }}</td>
                        <td>
                            @if($store->busy)
                                <span class="badge bg-warning">Busy</span>
                            @else
                                <span class="badge bg-success">Active</span>
                            @endif
                        </td>
                        <td>
                            <span class="badge bg-info">{{ $store->intl_shipping_method }}</span>
                        </td>
                        <td>{{ $store->created_at->format('M d, Y') }}</td>
                        <td>
                            <div class="btn-group" role="group">
                                <a href="{{ route('superdashboard.stores.show', $store) }}" class="btn btn-sm btn-outline-primary">
                                    <i class="bi bi-eye"></i>
                                </a>
                                <a href="{{ route('superdashboard.stores.edit', $store) }}" class="btn btn-sm btn-outline-secondary">
                                    <i class="bi bi-pencil"></i>
                                </a>
                                <a href="{{ route('dashboard.index', $store->slug) }}" class="btn btn-sm btn-outline-info" target="_blank">
                                    <i class="bi bi-arrow-up-right-square"></i>
                                </a>
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="6" class="text-center text-muted">No stores found</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>

<!-- Create Store Modal -->
<div class="modal fade" id="createStoreModal" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Create New Store</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <form action="{{ route('superdashboard.stores.store') }}" method="POST">
                @csrf
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="slug" class="form-label">Store Slug</label>
                        <input type="text" class="form-control" id="slug" name="slug" required>
                        <div class="form-text">This will be the store's URL: https://createshop.link/{slug}</div>
                    </div>
                    <div class="mb-3">
                        <label for="title" class="form-label">Store Title</label>
                        <input type="text" class="form-control" id="title" name="title" required>
                    </div>
                    <div class="mb-3">
                        <label for="intl_shipping_method" class="form-label">International Shipping</label>
                        <select class="form-select" id="intl_shipping_method" name="intl_shipping_method" required>
                            <option value="DHL">DHL</option>
                            <option value="ARAMEX">ARAMEX</option>
                            <option value="COMPANY">Company Shipping</option>
                            <option value="NONE">No International Shipping</option>
                        </select>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" id="busy" name="busy" value="1">
                        <label class="form-check-label" for="busy">
                            Start as busy (maintenance mode)
                        </label>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-primary">Create Store</button>
                </div>
            </form>
        </div>
    </div>
</div>
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
