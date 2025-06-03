<?php

/**
 * @BOC
 * @Task #160741 Develop RFP Management System
 * @Author Maanik Arya 
 * @date 31-05-2025
 * @use_of_code: Created the rfp_quote model for the rfp_management_system.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\RfpDetail;
use App\Models\User;

class RfpQuote extends Model
{
    protected $table = 'rfp_quotes';

    public $timestamps = false;

    protected $fillable = [
        'rfp_id', 'vendor_id', 'price_per_unit',
        'quantity', 'item_description', 'total_cost', 'submitted_at'
    ];

    public function rfp()
    {
        return $this->belongsTo(RfpDetail::class, 'rfp_id');
    }

    public function vendor()
    {
        return $this->belongsTo(User::class, 'vendor_id');
    }
    
}
