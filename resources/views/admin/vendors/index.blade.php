@extends('layouts.admin')
@section('title' , 'Vendors')

@section('content')
<div class="container-fluid px-4">
    <div class="row">
        <div class="col-12">
            <div class="card shadow-sm">
                <div class="card-header bg-white py-3">
                    <h5 class="mb-0">Vendor Management</h5>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-hover align-middle">
                            <thead class="table-light">
                                <tr>
                                    <th scope="col">Vendor Id</th>
                                    <th scope="col">Name</th>
                                    <th scope="col">Email</th>
                                    <th scope="col">Company</th>
                                    <th scope="col">Phone Number</th>
                                    <th scope="col">Revenue (Last 3 Years in Lakh)</th>
                                    <th scope="col">Status</th>
                                    <th scope="col">Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($vendors as $vendor)
                                <tr>
                                    <!-- <td>{{ ($vendors->currentPage() - 1) * $vendors->perPage() + $loop->iteration }}</td> -->
                                    <td>{{ $vendor->id}}</td>
                                    <td>{{ $vendor->name }}</td>
                                    <td>{{ $vendor->email }}</td>
                                    <td>{{ $vendor->vendorDetail->company_name ?? 'N/A' }}</td>
                                    <td>{{ $vendor->vendorDetail->phone_number }}</td>
                                    <td>{{ $vendor->vendorDetail->revenue }}</td>
                                    <td>
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
                                    <td>
                                        @if(($vendor->vendorDetail->status ?? 'pending') === 'pending')
                                            <div class="btn-group" role="group" aria-label="Vendor actions">
                                                <form action="{{ route('admin.vendors.approve', $vendor) }}" method="POST" class="d-inline">
                                                    @csrf
                                                    <button type="submit" class="btn btn-success btn-sm me-2">
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
                                    <td colspan="6" class="text-center py-4 text-muted">
                                        <i class="fas fa-inbox fa-2x mb-3 d-block"></i>
                                        No vendors found
                                    </td>
                                </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>

                    <div class="d-flex justify-content-end mt-3">
                        @if($vendors->hasPages())
                        <div>
                            {{ $vendors->links('pagination::bootstrap-5') }}
                        </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>

    @if(session('success'))
    <div class="position-fixed bottom-0 end-0 p-3" style="z-index: 11">
        <div class="toast show" role="alert" aria-live="assertive" aria-atomic="true">
            <div class="toast-header bg-success text-white">
                <strong class="me-auto">Success</strong>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="toast" aria-label="Close"></button>
            </div>
            <div class="toast-body">
                {{ session('success') }}
            </div>
        </div>
    </div>
    @endif
</div>

@push('scripts')
<script>
    // Auto-hide toast after 3 seconds
    document.addEventListener('DOMContentLoaded', function() {
        var toastElList = [].slice.call(document.querySelectorAll('.toast'));
        var toastList = toastElList.map(function(toastEl) {
            var toast = new bootstrap.Toast(toastEl, {
                autohide: true,
                delay: 3000
            });
            return toast;
        });
    });
</script>
@endpush
@endsection
