<?php

/**
 * @BOC
 * @Task #160741 Develop RFP Management System
 * @Author Maanik Arya 
 * @date 31-05-2025
 * @use_of_code: Created the admin controller for the rfp_management_system.
 */
namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function dashboard(){
        return view('admin.dashboard');
    }
}
