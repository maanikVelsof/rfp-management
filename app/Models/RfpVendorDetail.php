<?php

/**
 * @BOC
 * @Task #160741 Develop RFP Management System
 * @Author Maanik Arya 
 * @date 31-05-2025
 * @use_of_code: Created the rfp_vendor_detail model for the rfp_management_system.
 */
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class RfpVendorDetail extends Model
{
    /**
     * @BOC
     * @Task #160741 Develop RFP Management System
     * @Author Maanik Arya 
     * @date 31-05-2025
     * @use_of_code: Created the rfp_vendor_detail model for the rfp_management_system.
     * Added the table name and the fillable fields.
     */
    protected $table = 'rfp_vendors_details';  // Correct table name
    
    protected $fillable = [
        'company_name',
        'phone_number',
        'gst_number',
        'pan_number',
        'revenue',
        'no_of_employees',
        'status',
    ];
    /**
     * @EOC
     */
}
