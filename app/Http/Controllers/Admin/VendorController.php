<?php

/**
 * @BOC
 * @Task #160741 Develop RFP Management System
 * @Author Maanik Arya 
 * @date 31-05-2025
 * @use_of_code: Created the vendor controller for the rfp_management_system.
 */
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Notifications\VendorApprovalNotification;
use App\Notifications\VendorRejectionNotification;

class VendorController extends Controller
{
    public function index()
    {
        $vendors = User::where('user_type', 'vendor')->with('vendorDetail')->orderBy('created_at', 'desc')->paginate(10);
        return view('admin.vendors.index', compact('vendors'));
    }

    public function approveVendor(User $user)
    {
        $user->vendorDetail->update(['status' => 'approved']);
        $user->notify(new VendorApprovalNotification($user));

        return back()->with('success', 'Vendor approved successfully');
    }

    public function rejectVendor(User $user)
    {
        $user->vendorDetail->update(['status' => 'rejected']);
        $user->notify(new VendorRejectionNotification($user));
        return back()->with('success', 'Vendor rejected successfully');
    }

}
