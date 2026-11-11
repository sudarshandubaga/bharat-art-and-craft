<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('products', function (Blueprint $table) {
            $table->unsignedBigInteger('finish_id')->nullable()->after('category_id');
            $table->foreign('finish_id')->references('id')->on('finishes')->nullOnDelete();

            $table->unsignedBigInteger('wood_id')->nullable()->after('finish_id');
            $table->foreign('wood_id')->references('id')->on('woods')->nullOnDelete();
        });
    }

    public function down(): void
    {
        Schema::table('products', function (Blueprint $table) {
            $table->dropForeign(['finish_id']);
            $table->dropColumn('finish_id');
            $table->dropForeign(['wood_id']);
            $table->dropColumn('wood_id');
        });
    }
};
