<?php

/**
 * @BOC
 * @Task #160741 Develop RFP Management System
 * @Author Maanik Arya 
 * @date 31-05-2025
 * @use_of_code: Created the rfp_category model for the rfp_management_system.
 */

namespace App\Models;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class RfpCategory extends Model
{
    /**
     * @BOC
     * @Task #160741 Develop RFP Management System
     * @Author Maanik Arya 
     * @date 31-05-2025
     * @use_of_code: We have added the fillable properties for the rfp_category model which is used to store the data in the database using the create method.
     * @fillable_properties: name, status
     * Also, define the relationship with the rfp_detail model and rfp_vendor_category_mapping model.
     * @relationship_with_rfp_detail: The rfp_category model has a one-to-many relationship with the rfp_detail model.
     * @relationship_with_rfp_vendor_category_mapping: The rfp_category model has a one-to-many relationship with the rfp_vendor_category_mapping model.
     * The use of relationship is to get the rfp_detail and rfp_vendor_category_mapping data from the rfp_category model.
     */
    use HasFactory;
    
    protected $fillable = ['name' , 'status'];

    public function rfpDetails()
    {
        return $this->hasMany(RfpDetail::class);
    }

    public function rfpVendorCategoryMappings()
    {
        return $this->hasMany(RfpVendorCategoryMapping::class);
    }
    /**
     * @EOC
     */
}
