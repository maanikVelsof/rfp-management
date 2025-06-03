<?php

/**
 * @BOC
 * @Task #160741 Develop RFP Management System
 * @Author Maanik Arya 
 * @date 31-05-2025
 * @use_of_code: Created the rfp_detail model for the rfp_management_system.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class RfpDetail extends Model
{
    protected $table = "rfp_details";

    protected $fillable = [
        'rfp_number', 
        'status',
        'item_name',
        'item_description',
        'quantity',
        'last_date', 
        'minimum_price',
        'maximum_price',
        'category_id', 
        'created_by'
    ];

    public function category(){
        return $this->belongsTo(\App\Models\RfpCategory::class, 'category_id');
    }

    public function assignedVendors()
    {
        return $this->hasMany(\App\Models\RfpVendorMapping::class, 'rfp_id');
    }
}
