@extends('layouts.vendor')

@section('title', 'Dashboard')

@section('content')
<div class="container-fluid">
    <!-- Welcome Section -->
    <div class="row mb-4">
        <div class="col-12">
            <h1 class="h3 mb-0 text-gray-800">Welcome back, {{ auth()->user()->name }}!</h1>
            <p class="text-muted">Here's your vendor activity overview.</p>
        </div>
    </div>

    <!-- Metrics Cards -->
    <div class="row mb-4">
        <!-- Submitted Proposals -->
        <div class="col-xl-4 col-md-6 mb-4">
            <div class="card border-left-primary shadow h-100 py-2">
                <div class="card-body">
                    <div class="row align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">Submitted Proposals</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">28</div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-paper-plane fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Won Projects -->
        <div class="col-xl-4 col-md-6 mb-4">
            <div class="card border-left-success shadow h-100 py-2">
                <div class="card-body">
                    <div class="row align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-success text-uppercase mb-1">Won Projects</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">12</div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-trophy fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Available RFPs -->
        <div class="col-xl-4 col-md-6 mb-4">
            <div class="card border-left-info shadow h-100 py-2">
                <div class="card-body">
                    <div class="row align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-info text-uppercase mb-1">Available RFPs</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">15</div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-file-contract fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Chart & Activities Section -->
    <div class="row">
        <!-- Chart -->
        <div class="col-xl-8 col-lg-7">
            <div class="card shadow mb-4">
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                    <h6 class="m-0 font-weight-bold text-primary">Proposal Success Rate</h6>
                </div>
                <div class="card-body">
                    <div id="proposalChart" style="height: 300px;">
                        <!-- Chart will be rendered here -->
                    </div>
                </div>
            </div>
        </div>

        <!-- Recent Activities -->
        <div class="col-xl-4 col-lg-5">
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Recent Activities</h6>
                </div>
                <div class="card-body">
                    <div class="list-group list-group-flush">
                        <div class="list-group-item border-bottom">
                            <div class="d-flex w-100 justify-content-between">
                                <h6 class="mb-1">Proposal Submitted</h6>
                                <small class="text-muted">3 mins ago</small>
                            </div>
                            <p class="mb-1">IT Infrastructure Project</p>
                        </div>
                        <div class="list-group-item border-bottom">
                            <div class="d-flex w-100 justify-content-between">
                                <h6 class="mb-1">New RFP Available</h6>
                                <small class="text-muted">1 hour ago</small>
                            </div>
                            <p class="mb-1">Cloud Migration Services</p>
                        </div>
                        <div class="list-group-item border-bottom">
                            <div class="d-flex w-100 justify-content-between">
                                <h6 class="mb-1">Proposal Accepted</h6>
                                <small class="text-muted">2 hours ago</small>
                            </div>
                            <p class="mb-1">Software Development Project</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
    // Chart placeholder - You can integrate your preferred charting library here
    document.addEventListener('DOMContentLoaded', function() {
        // Initialize your chart here
    });
</script>
@endpush