<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    /**
     * @BOC
     * @Task #160741 Develop RFP Management System
     * @Author Maanik Arya 
     * @date 31-05-2025
     * @use_of_code: I have created the migration for the rfp_management_tables.
     */
    public function up(): void
    {
        Schema::create('rfp_vendors_details', function (Blueprint $table) {
            $table->id()->comment('Primary key');
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade')->comment('Foreign key to users table');
            $table->enum('status', ['pending', 'approved', 'rejected'])->default('pending')->comment('Vendor approval status');
            $table->string('company_name')->comment('Name of the vendor company');
            $table->string('revenue')->nullable()->comment('Annual revenue of the company');
            $table->string('gst_number')->nullable()->comment('GST registration number');
            $table->string('pan_number')->nullable()->comment('PAN card number');
            $table->integer('no_of_employees')->nullable()->comment('Total number of employees');
            $table->string('phone_number')->nullable()->comment('Contact phone number');
            $table->timestamps();
        });

        Schema::create('rfp_categories', function (Blueprint $table) {
            $table->id()->comment('Primary key');
            $table->string('name')->unique()->comment('Name of the category');
            $table->tinyInteger('status')->default(1)->comment('0 = deactive, 1 = active')->comment('Category status');
            $table->timestamps();
        });

        Schema::create('rfp_vendor_category_mapping', function (Blueprint $table) {
            $table->id()->comment('Primary key');
            $table->foreignId('vendor_id')->constrained('users')->onDelete('cascade')->comment('Foreign key to users table');
            $table->foreignId('category_id')->constrained('rfp_categories')->onDelete('cascade')->comment('Foreign key to rfp_categories table');
            $table->timestamp('created_at')->nullable()->comment('Record creation timestamp');
        });

        Schema::create('rfp_details', function (Blueprint $table) {
            $table->id()->comment('Primary key');
            $table->string('rfp_number')->unique()->comment('Unique RFP number');
            $table->enum('status', ['open', 'closed'])->default('open')->comment('RFP status');
            $table->string('item_name')->comment('Name of item/service being requested');
            $table->longText('item_description')->comment('Detailed item or service description');
            $table->integer('quantity')->comment('Quantity of the item');
            $table->date('last_date')->comment('Last date for submission');
            $table->decimal('minimum_price', 10, 2)->nullable()->comment('Minimum price of the item');
            $table->decimal('maximum_price', 10, 2)->nullable()->comment('Maximum price of the item');
            $table->foreignId('category_id')->constrained('rfp_categories')->onDelete('cascade')->comment('Foreign key to rfp_categories table');
            $table->foreignId('created_by')->constrained('users')->onDelete('cascade')->comment('Foreign key to users table');
            $table->timestamps();
        });

        Schema::create('rfp_vendor_mapping', function (Blueprint $table) {
            $table->id()->comment('Primary key');
            $table->foreignId('rfp_id')->constrained('rfp_details')->onDelete('cascade')->comment('Foreign key to rfp_details table');
            $table->foreignId('vendor_id')->constrained('users')->onDelete('cascade')->comment('Foreign key to users table');
            $table->timestamp('notified_at')->nullable()->comment('Notification timestamp');
        });

        Schema::create('rfp_quotes', function (Blueprint $table) {
            $table->id()->comment('Primary key');
            $table->foreignId('rfp_id')->constrained('rfp_details')->onDelete('cascade')->comment('Foreign key to rfp_details table');
            $table->foreignId('vendor_id')->constrained('users')->onDelete('cascade')->comment('Foreign key to users table');
            $table->decimal('price_per_unit', 10, 2)->comment('Price per unit');
            $table->longText('item_description')->nullable()->comment('Item description');
            $table->integer('quantity')->comment('Quantity');
            $table->decimal('total_cost', 10, 2)->comment('Total cost');
            $table->timestamp('submitted_at')->nullable()->comment('Submission timestamp');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('rfp_quotes');
        Schema::dropIfExists('rfp_vendor_mapping');
        Schema::dropIfExists('rfp_details');
        Schema::dropIfExists('rfp_vendor_category_mapping');
        Schema::dropIfExists('rfp_categories');
        Schema::dropIfExists('rfp_vendors_details');
    }
};
