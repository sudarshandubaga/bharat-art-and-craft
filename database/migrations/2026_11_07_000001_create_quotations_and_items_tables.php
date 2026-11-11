<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        // 1. Add dimension to products table if missing
        if (Schema::hasTable('products') && !Schema::hasColumn('products', 'dimension')) {
            Schema::table('products', function (Blueprint $table) {
                $table->string('dimension')->nullable()->after('material');
            });
        }

        // 2. Create quotations table
        if (!Schema::hasTable('quotations')) {
            Schema::create('quotations', function (Blueprint $table) {
                $table->id();
                $table->string('quotation_no')->unique();
                $table->unsignedBigInteger('user_id')->nullable()->index();
                $table->unsignedBigInteger('order_id')->nullable()->index();
                $table->string('customer_name');
                $table->string('customer_email');
                $table->string('customer_phone')->nullable();
                $table->string('customer_company')->nullable();
                $table->text('customer_address')->nullable();
                $table->date('date')->nullable();
                $table->date('valid_until')->nullable();
                $table->string('title')->default('Bespoke Handcrafted Furniture Quotation');
                $table->string('company_name')->default('Bharat Art & Craft');
                $table->text('company_address')->nullable();
                $table->string('company_email')->nullable();
                $table->string('company_phone')->nullable();
                $table->string('status')->default('draft');
                $table->string('currency')->default('USD');
                $table->text('notes')->nullable();
                $table->text('terms')->nullable();
                $table->decimal('total_cbm', 10, 3)->default(0);
                $table->decimal('total_amount', 12, 2)->default(0);
                $table->softDeletes();
                $table->timestamps();

                $table->foreign('user_id')->references('id')->on('users')->onDelete('set null');
                $table->foreign('order_id')->references('id')->on('orders')->onDelete('set null');
            });
        }

        // 3. Create quotation_items table
        if (!Schema::hasTable('quotation_items')) {
            Schema::create('quotation_items', function (Blueprint $table) {
                $table->id();
                $table->unsignedBigInteger('quotation_id')->index();
                $table->unsignedBigInteger('product_id')->nullable()->index();
                $table->string('product_name');
                $table->string('product_code')->nullable();
                $table->string('image')->nullable();
                $table->string('material')->nullable();
                $table->string('dimension')->nullable();
                $table->string('finish')->nullable();
                $table->integer('moq')->default(1);
                $table->decimal('price_usd', 10, 2)->default(0);
                $table->decimal('cbm', 10, 3)->default(0);
                $table->string('loadability')->nullable();
                $table->text('notes')->nullable();
                $table->integer('sort_order')->default(0);
                $table->timestamps();

                $table->foreign('quotation_id')->references('id')->on('quotations')->onDelete('cascade');
                $table->foreign('product_id')->references('id')->on('products')->onDelete('set null');
            });
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('quotation_items');
        Schema::dropIfExists('quotations');

        if (Schema::hasTable('products') && Schema::hasColumn('products', 'dimension')) {
            Schema::table('products', function (Blueprint $table) {
                $table->dropColumn('dimension');
            });
        }
    }
};
