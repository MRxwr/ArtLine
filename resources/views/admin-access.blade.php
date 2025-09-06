@extends('admin.layouts.app')

@section('title', 'ArtLine Admin - Access Panel')

@section('sidebar')
<ul class="nav flex-column">
    <li class="nav-item">
        <a class="nav-link active" href="#">
            <i class="bi bi-house"></i> Admin Access
        </a>
    </li>
</ul>
@endsection

@section('content')
<div class="container-fluid py-4">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="text-center mb-5">
                <h1 class="display-4">🎨 ArtLine Admin</h1>
                <p class="lead">Multi-tenant E-commerce Platform</p>
            </div>

            <div class="row">
                <div class="col-md-6 mb-4">
                    <div class="card shadow h-100">
                        <div class="card-body text-center">
                            <div class="mb-3">
                                <i class="bi bi-shield-check text-primary" style="font-size: 3rem;"></i>
                            </div>
                            <h5 class="card-title">SuperDashboard</h5>
                            <p class="card-text">
                                Full platform control for superadmins. Manage all stores, users, and system-wide settings.
                            </p>
                            <a href="{{ route('superdashboard.index') }}" class="btn btn-primary">
                                <i class="bi bi-arrow-right"></i> Access SuperDashboard
                            </a>
                        </div>
                    </div>
                </div>

                <div class="col-md-6 mb-4">
                    <div class="card shadow h-100">
                        <div class="card-body text-center">
                            <div class="mb-3">
                                <i class="bi bi-shop text-success" style="font-size: 3rem;"></i>
                            </div>
                            <h5 class="card-title">Store Dashboard</h5>
                            <p class="card-text">
                                Store-specific management panel for store owners and employees.
                            </p>
                            
                            <div class="mb-3">
                                <select class="form-select" id="storeSelect">
                                    <option value="">Select a store...</option>
                                    <option value="demo-shop">Demo Shop</option>
                                    <option value="alpha-shop">Alpha Shop</option>
                                    <option value="beta-store">Beta Store</option>
                                </select>
                            </div>
                            
                            <button class="btn btn-success" onclick="accessStoreDashboard()">
                                <i class="bi bi-arrow-right"></i> Access Dashboard
                            </button>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row mt-4">
                <div class="col-12">
                    <div class="card shadow">
                        <div class="card-header">
                            <h6 class="mb-0"><i class="bi bi-info-circle"></i> Admin Panel Features</h6>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-6">
                                    <h6 class="text-primary">SuperDashboard Features:</h6>
                                    <ul class="list-unstyled">
                                        <li><i class="bi bi-check text-success"></i> Manage all stores</li>
                                        <li><i class="bi bi-check text-success"></i> User management</li>
                                        <li><i class="bi bi-check text-success"></i> View soft-deleted items</li>
                                        <li><i class="bi bi-check text-success"></i> Audit logs</li>
                                        <li><i class="bi bi-check text-success"></i> System-wide analytics</li>
                                    </ul>
                                </div>
                                <div class="col-md-6">
                                    <h6 class="text-success">Store Dashboard Features:</h6>
                                    <ul class="list-unstyled">
                                        <li><i class="bi bi-check text-success"></i> Product management</li>
                                        <li><i class="bi bi-check text-success"></i> Category organization</li>
                                        <li><i class="bi bi-check text-success"></i> Banner management</li>
                                        <li><i class="bi bi-check text-success"></i> Voucher system</li>
                                        <li><i class="bi bi-check text-success"></i> Team & permissions</li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="text-center mt-4">
                <a href="{{ url('/') }}" class="btn btn-outline-secondary">
                    <i class="bi bi-arrow-left"></i> Back to Homepage
                </a>
            </div>
        </div>
    </div>
</div>

<script>
function accessStoreDashboard() {
    const storeSelect = document.getElementById('storeSelect');
    const selectedStore = storeSelect.value;
    
    if (selectedStore) {
        window.location.href = `/dashboard/${selectedStore}`;
    } else {
        alert('Please select a store first.');
    }
}
</script>
@endsection
