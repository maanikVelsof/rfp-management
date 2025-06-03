<?php

namespace App\Http\Controllers\Vendor;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\RfpQuote;
use App\Models\RfpDetail;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;
use Exception;
use App\Notifications\VendorQuoteSubmitted;
use Illuminate\Support\Facades\Notification;
use App\Models\User;

class QuoteController extends Controller
{
    public function store(Request $request, RfpDetail $rfp)
    {
        
        // Validate request
        $request->validate([
            'price_per_unit' => 'required|numeric',
            'item_description' => 'required|string',
            'quantity' => 'required|integer',
            'total_cost' => 'required|numeric'
        ]); 


        try {

            // Check if RFP is still active
            if ($rfp->status !== 'open') {
                return back()->with('error', 'This RFP is no longer active.');
            }

            // Check if vendor is assigned to this RFP
            $isAssigned = $rfp->assignedVendors()->where('vendor_id', Auth::id())->exists();
            if (!$isAssigned) {
                return back()->with('error', 'You are not authorized to quote on this RFP.');
            }

            // Check if vendor has already submitted a quote
            $existingQuote = RfpQuote::where('rfp_id', $rfp->id)
                ->where('vendor_id', Auth::id())
                ->first();

            if ($existingQuote) {
                return back()->with('error', 'You have already submitted a quote for this RFP.');
            }

            DB::beginTransaction();

            try {
                // Create the quote
                $quote = RfpQuote::create([
                    'rfp_id' => $rfp->id,
                    'vendor_id' => Auth::id(),
                    'price_per_unit' => $request->price_per_unit,
                    'item_description' => $request->item_description,
                    'quantity' => $request->quantity,
                    'total_cost' => $request->total_cost,
                    'submitted_at' => now()
                ]);

                // Send email notification to all admin users
                $adminUsers = User::where('user_type', 'admin')->get();
                Notification::send($adminUsers, new VendorQuoteSubmitted($rfp, $quote));

                DB::commit();
                
                return redirect()->route('vendor.rfps.index')
                ->with('success', 'Quote submitted successfully.');
            } catch (Exception $e) {
                DB::rollBack();
                Log::error('Quote submission failed', [
                    'error' => $e->getMessage(),
                    'rfp_id' => $rfp->id,
                    'vendor_id' => Auth::id(),
                    'trace' => $e->getTraceAsString()
                ]);
                throw $e;
            }

        } catch (Exception $e) {
            Log::error('Quote submission failed', [
                'error' => $e->getMessage(),
                'rfp_id' => $rfp->id,
                'vendor_id' => Auth::id(),
                'trace' => $e->getTraceAsString()
            ]);

            return back()->with('error', 'Failed to submit quote. Please try again later.');
        }
    }
}
