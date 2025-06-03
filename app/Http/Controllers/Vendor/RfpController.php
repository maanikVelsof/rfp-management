<?php

namespace App\Http\Controllers\Vendor;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\RfpDetail;
use App\Models\RfpVendorMapping;
use App\Models\RfpQuote;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use App\Mail\NewQuoteSubmitted;
use Exception;
use Illuminate\Support\Facades\Log;

class RfpController extends Controller
{
    public function index()
    {
        try {
            // Get the vendor's ID
            $vendorId = Auth::id();

            // Get IDs of RFPs that the vendor has already quoted
            $quotedRfpIds = RfpQuote::where('vendor_id', $vendorId)
                ->pluck('rfp_id')
                ->toArray();

            // Fetch RFPs where this vendor is assigned and hasn't quoted yet
            $rfps = RfpDetail::where('status', 'open') // Only open RFPs
                ->whereHas('assignedVendors', function ($q) use ($vendorId) {
                    $q->where('vendor_id', $vendorId); // Assigned to logged-in vendor
                })
                ->whereNotIn('id', $quotedRfpIds) // Exclude RFPs that already have quotes
                ->with('category') // Eager load category relationship
                ->orderBy('last_date') // Order by last submission date
                ->paginate(10); // Paginate results (10 per page)

            return view('vendor.rfps.index', compact('rfps'));
        } catch (Exception $e) {
            Log::error('Error fetching RFPs for vendor', [
                'vendor_id' => Auth::id(),
                'error' => $e->getMessage(),
                'trace' => $e->getTraceAsString()
            ]);
            
            return back()->with('error', 'Error loading RFPs. Please try again later.');
        }
    }

    public function show(RfpDetail $rfp)
    {
        try {
            // Check if the vendor is assigned to this RFP
            $isAssigned = $rfp->assignedVendors()->where('vendor_id', Auth::id())->exists();

            if (! $isAssigned) {
                abort(403, 'This RFP is not assigned to you.');
            }

            // Check if vendor has already submitted a quote
            $hasQuoted = RfpQuote::where('rfp_id', $rfp->id)
                ->where('vendor_id', Auth::id())
                ->exists();

            if ($hasQuoted) {
                return back()->with('error', 'You have already submitted a quote for this RFP.');
            }

            return view('vendor.rfps.submit-quote', compact('rfp'));
        } catch (Exception $e) {
            Log::error('Error showing RFP details', [
                'rfp_id' => $rfp->id,
                'vendor_id' => Auth::id(),
                'error' => $e->getMessage(),
                'trace' => $e->getTraceAsString()
            ]);
            
            return back()->with('error', 'Error loading RFP details. Please try again later.');
        }
    }
}
