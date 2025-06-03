@extends('layouts.vendor')

@section('content')
<div class="container-fluid">
    <!-- Page Heading -->
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1 class="h3 mb-0 text-gray-800">Open RFPs</h1>
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

    <!-- RFPs Table -->
    <div class="card shadow mb-4">
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered table-striped table-hover">
                    <thead class="table-primary">
                        <tr>
                            <th width="5%" class="align-middle">ID</th>
                            <th class="align-middle">RFP Number</th>
                            <th width="20%" class="align-middle">RFP Name</th>
                            <th class="align-middle">Last Date</th>
                            <th class="align-middle">RFP Minimum Price</th>
                            <th class="align-middle">RFP Maximum Price</th>
                            <th class="align-middle">RFP Status</th>
                            <th width="15%" class="align-middle">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($rfps as $rfp)
                            <tr>
                                <td class="align-middle">{{ $rfp->id }}</td>
                                <td class="align-middle">{{ $rfp->rfp_number }}</td>
                                <td class="align-middle">{{ $rfp->item_name }}</td>
                                <td class="align-middle">{{ $rfp->last_date }}</td>
                                <td class="align-middle">{{ number_format($rfp->minimum_price, 2) }}</td>
                                <td class="align-middle">{{ number_format($rfp->maximum_price, 2) }}</td>
                                <td class="align-middle">
                                    <span class="badge bg-success">Open</span>
                                </td>
                                <td class="align-middle">
                                    <div class="d-flex gap-2">
                                        <a href="{{ route('vendor.rfps.show', $rfp->id) }}" class="btn btn-primary btn-sm">
                                            Apply
                                        </a>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="8" class="text-center">No open RFPs available for quotation</td>
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
