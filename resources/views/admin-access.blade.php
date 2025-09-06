<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ArtLine Admin Access</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.7.2/font/bootstrap-icons.css" rel="stylesheet">
</head>
<body class="bg-light">
    <div class="container mt-5">
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
                                <p class="card-text">Full platform control for superadmins.</p>
                                <a href="{{ route('admin.superdashboard') }}" class="btn btn-primary">
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
                                <p class="card-text">Store-specific management panel.</p>
                                <a href="{{ route('admin.dashboard') }}" class="btn btn-success">
                                    <i class="bi bi-arrow-right"></i> Access Dashboard
                                </a>
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
</body>
</html>