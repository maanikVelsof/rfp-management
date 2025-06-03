<?php

/**
 * @BOC
 * @Task #160741 Develop RFP Management System
 * @Author Maanik Arya 
 * @date 31-05-2025
 * @use_of_code: Created the vendor register controller for the rfp_management_system.
 */
namespace App\Http\Controllers\Auth;
use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\RfpCategory;
use App\Models\RfpVendorCategoryMapping;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\Rules;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Notification;
use App\Notifications\VendorRegistrationNotification;
use App\Notifications\AdminVendorRegistrationNotification;


class VendorRegisterController extends Controller
{
    /**
     * Show the vendor registration form.
     */
    public function showRegistrationForm()
    {
        $categories = RfpCategory::where('status', 1)->get();
        return view('auth.vendor-register', compact('categories'));
    }

    /**
     * Handle an incoming registration request.
     */
    public function register(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
            'company_name' => 'required|string|max:255',
            'phone_number' => 'nullable|string|max:20',
            'gst_number' => 'nullable|string|max:50',
            'pan_number' => 'nullable|string|max:50',
            'revenue' => 'nullable|string|max:50',
            'no_of_employees' => 'nullable|integer',
            'categories' => 'required|array',
            'categories.*' => 'exists:rfp_categories,id',
        ]);

        try {
            DB::beginTransaction();

            $user = User::create([
                'name' => $request->name,
                'email' => $request->email,
                'password' => Hash::make($request->password),
                'user_type' => 'vendor',
            ]);

            $user->vendorDetail()->create([
                'company_name' => $request->company_name,
                'phone_number' => $request->phone_number,
                'gst_number' => $request->gst_number,
                'pan_number' => $request->pan_number,
                'revenue' => $request->revenue,
                'no_of_employees' => $request->no_of_employees,
                'status' => 'pending',
            ]);

            foreach ($request->categories as $categoryId) {
                RfpVendorCategoryMapping::create([
                    'vendor_id' => $user->id,
                    'category_id' => $categoryId,
                    'created_at' => now(),
                ]);
            }

            $user->notify(new VendorRegistrationNotification());

            // Send notification to all admin users
            $adminUsers = User::where('user_type', 'admin')->get();
            Notification::send($adminUsers, new AdminVendorRegistrationNotification($user));

            DB::commit();

            return redirect()->route('login')
                ->with('success', 'Registration successful! Please wait for admin approval.');


        } catch (\Exception $e) {
            DB::rollBack();
            Log::error('Failed to Register Vendor: ' . $e->getMessage());
            return back()->with('error' , 'Registration failed. Please try again.');
        }
    }
} 