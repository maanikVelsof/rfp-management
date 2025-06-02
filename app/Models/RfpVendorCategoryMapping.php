<?php

/**
 * @BOC
 * @Task #160741 Develop RFP Management System
 * @Author Maanik Arya 
 * @date 31-05-2025
 * @use_of_code: Created the rfp_vendor_category_mapping model for the rfp_management_system.
 */
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class RfpVendorCategoryMapping extends Model
{
    /**
     * @BOC
     * @Task #160741 Develop RFP Management System
     * @Author Maanik Arya 
     * @date 31-05-2025
     * @use_of_code: Created the rfp_vendor_category_mapping model for the rfp_management_system.
     * Added the table name and the fillable fields.
     */
    protected $table = 'rfp_vendor_category_mapping';

    public $timestamps = false;

    protected $fillable = [
        'vendor_id',
        'category_id'
    ];
    /**
     * @EOC
     */
}
