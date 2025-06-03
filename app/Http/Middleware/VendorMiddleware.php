<?php

/**
 * @BOC
 * @Task #160741 Develop RFP Management System
 * @Author Maanik Arya 
 * @date 31-05-2025
 * @use_of_code: Created the vendor middleware for the rfp_management_system.
 */
namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class VendorMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if (auth()->check() && auth()->user()->user_type === 'vendor') {
            if (auth()->user()->vendorDetail->status === 'approved') {
                return $next($request);
            }
        }
        abort(403, 'Unauthorized');
    }
}
