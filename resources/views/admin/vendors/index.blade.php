@extends('layouts.admin')
@section('title', 'Vendors')

@section('content')
<div class="container-fluid">
    <!-- Page Heading -->
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1 class="h3 mb-0 text-gray-800">Vendors</h1>
        <!-- You can add a button here if needed, similar to categories -->
    </div>

    <!-- Alert Messages -->
    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    @if(session('error'))
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            {{ session('error') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    <!-- Vendors Table -->
    <div class="card shadow mb-4">
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered table-striped table-hover">
                    <thead class="table-primary">
                        <tr>
                            <th width="5%" class="align-middle">ID</th>
                            <th class="align-middle">Name</th>
                            <th class="align-middle">Email</th>
                            <th class="align-middle">Company</th>
                            <th class="align-middle">Phone Number</th>
                            <th class="align-middle">Revenue</th>
                            <th width="15%" class="align-middle">Status</th>
                            <th width="15%" class="align-middle">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($vendors as $vendor)
                            <tr>
                                <td class="align-middle">{{ $vendor->id }}</td>
                                <td class="align-middle">{{ $vendor->name }}</td>
                                <td class="align-middle">{{ $vendor->email }}</td>
                                <td class="align-middle">{{ $vendor->vendorDetail->company_name ?? 'N/A' }}</td>
                                <td class="align-middle">{{ $vendor->vendorDetail->phone_number }}</td>
                                <td class="align-middle">{{ $vendor->vendorDetail->revenue }}</td>
                                <td class="align-middle">
                                    @php
                                        $status = $vendor->vendorDetail->status ?? 'pending';
                                        $badgeClass = match($status) {
                                            'approved' => 'bg-success',
                                            'rejected' => 'bg-danger',
                                            default => 'bg-warning'
                                        };
                                    @endphp
                                    <span class="badge {{ $badgeClass }}">
                                        {{ ucfirst($status) }}
                                    </span>
                                </td>
                                <td class="align-middle">
                                    @if(($vendor->vendorDetail->status ?? 'pending') === 'pending')
                                        <div class="d-flex gap-2">
                                            <form action="{{ route('admin.vendors.approve', $vendor) }}" method="POST" class="d-inline">
                                                @csrf
                                                <button type="submit" class="btn btn-success btn-sm">
                                                    <i class="fas fa-check me-1"></i>Approve
                                                </button>
                                            </form>
                                            <form action="{{ route('admin.vendors.reject', $vendor) }}" method="POST" class="d-inline">
                                                @csrf
                                                <button type="submit" class="btn btn-danger btn-sm">
                                                    <i class="fas fa-times me-1"></i>Reject
                                                </button>
                                            </form>
                                        </div>
                                    @else
                                        <span class="text-muted">No actions available</span>
                                    @endif
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="8" class="text-center">No vendors found</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <!-- Pagination -->
            @if($vendors->hasPages())
                <div class="d-flex justify-content-end mt-3">
                    {{ $vendors->onEachSide(1)->links('pagination::bootstrap-5') }}
                </div>
            @endif
        </div>
    </div>
</div>
@endsection
