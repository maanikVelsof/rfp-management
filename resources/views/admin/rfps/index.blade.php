@extends('layouts.admin')

@section('title' , 'RFPs')

@section('content')

<div class="container-fluid">
    <!-- Page Heading -->
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1 class="h3 mb-0 text-gray-800">RFPs</h1>
        <a href="{{ route('admin.rfps.create') }}" class="btn btn-primary">
            <i class="fas fa-plus me-2"></i>Add New RFP
        </a>
    </div>

    <!-- Alert Messages -->
    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    <!-- RFPs Table -->
    <div class="card shadow mb-4">
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered table-striped table-hover">
                    <thead class="table-primary">
                        <tr>
                            <th width="5%">#</th>
                            <th width="10%">Title</th>
                            <th width="15%">Category</th>
                            <th width="15%">Submission Deadline</th>
                            <th width="20%">Budget</th>
                            <th width="10%">Status</th>
                            <th width="15%">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($rfps as $key => $rfp)
                            <tr>
                                <td>{{ $rfp->id }}</td>
                                <td>{{ $rfp->item_name }}</td>
                                <td>{{ $rfp->category->name }}</td>
                                <td>{{ $rfp->last_date }}</td>
                                <td>{{ number_format($rfp->minimum_price, 2) }} - {{ number_format($rfp->maximum_price, 2) }}</td>
                                <td>
                                    @if($rfp->status === 'open')
                                        <span class="badge bg-success">Open</span>
                                    @elseif($rfp->status === 'closed')
                                        <span class="badge bg-danger">Closed</span>
                                    @elseif($rfp->status === 'draft')
                                        <span class="badge bg-warning">Draft</span>
                                    @endif
                                </td>
                                <td>
                                    <div class="d-flex gap-2">
                                        @if($rfp->status === 'open')
                                            <a href="{{ route('admin.rfps.close', $rfp->id) }}" 
                                               class="btn btn-danger btn-sm"
                                               onclick="return confirm('Are you sure you want to close this RFP?');">
                                                <i class="fas fa-times"></i> Close
                                            </a>
                                        @else 
                                            <span class="badge bg-secondary">No Action</span>
                                        @endif
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="7" class="text-center">No RFPs found</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <!-- Pagination -->
            @if($rfps->hasPages())
                <div class="d-flex justify-content-end mt-3">
                    {{ $rfps->onEachSide(1)->links('pagination::bootstrap-5') }}
                </div>
            @endif
        </div>
    </div>
</div>

@endsection