<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\RfpDetail;
use App\Models\RfpCategory;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use App\Models\RfpVendorMapping;
use App\Notifications\NewRfpNotification;
use Illuminate\Support\Facades\Log;

class RfpController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $rfps = RfpDetail::with('category')->orderBy('created_at' , 'desc')->paginate(5);
        
        return view('admin.rfps.index' , compact('rfps'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $vendors = User::where('user_type', 'vendor')->whereHas('vendorDetail', fn($q) => $q->where('status', 'approved'))->get();
        $categories = RfpCategory::where('status', 1)->get();

        return view('admin.rfps.create', compact('vendors', 'categories'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'item_name' => 'required|string',
            'item_description' => 'required|string',
            'quantity' => 'required|integer',
            'last_date' => 'required|date',
            'minimum_price' => 'required|nullable|numeric',
            'maximum_price' => 'required|nullable|numeric',
            'category_id' => 'required|exists:rfp_categories,id',
            'vendors' => 'required|array',
            'vendors.*' => 'exists:users,id',
        ]);

        DB::beginTransaction();

        try {
            $rfp = RfpDetail::create([
                'rfp_number' => 'RFP-' . strtoupper(Str::random(6)),
                'item_name' => $request->item_name,
                'item_description' => $request->item_description,
                'quantity' => $request->quantity,
                'last_date' => $request->last_date,
                'minimum_price' => $request->minimum_price,
                'maximum_price' => $request->maximum_price,
                'category_id' => $request->category_id,
                'created_by' => auth()->user()->id,
                'status' => 'open',
            ]);

            // Map selected vendors
            foreach ($request->vendors as $vendorId) {
                RfpVendorMapping::create([
                    'rfp_id' => $rfp->id,
                    'vendor_id' => $vendorId,
                    'notified_at' => now()
                ]);

                $vendor = User::find($vendorId);
                $vendor->notify(new NewRfpNotification($rfp));
            }

            DB::commit();
            return redirect()->route('admin.rfps.index')->with('success', 'RFP created and vendors notified!');
        } catch (\Exception $e) {
            DB::rollBack();
            Log::error('Failed to create RFP: ' . $e->getMessage());
            return redirect()->back()->with('error', 'Failed to create RFP');
        }
    }


    /**
     * Close the specified RFP.
     *
     * @param  \App\Models\Rfp  $rfp
     * @return \Illuminate\Http\RedirectResponse
     */
    public function close(RfpDetail $rfp)
    {
        try {
            // Check if RFP is already closed
            if ($rfp->status === 'closed') {
                return redirect()->route('admin.rfps.index')
                    ->with('error', 'This RFP is already closed.');
            }

            // Update RFP status to closed
            $rfp->update([
                'status' => 'closed',
                'closed_at' => now()
            ]);

            return redirect()->route('admin.rfps.index')
                ->with('success', 'RFP has been closed successfully.');
        } catch (\Exception $e) {
            return redirect()->route('admin.rfps.index')
                ->with('error', 'Failed to close RFP. Please try again.');
        }
    }
}
