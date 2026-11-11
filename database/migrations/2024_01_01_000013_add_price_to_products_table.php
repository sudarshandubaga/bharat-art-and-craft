<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('products', function (Blueprint $table) {
            if (!Schema::hasColumn('products', 'price')) {
                $table->decimal('price', 10, 2)->nullable()->after('quantity');
            }
            if (!Schema::hasColumn('products', 'material')) {
                $table->string('material')->nullable()->after('price');
            }
            if (!Schema::hasColumn('products', 'excerpt')) {
                $table->text('excerpt')->nullable()->after('cbm');
            }
        });
    }

    public function down(): void
    {
        Schema::table('products', function (Blueprint $table) {
            $table->dropColumn(['price', 'material', 'excerpt']);
        });
    }
};

