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
        Schema::table('Products', function (Blueprint $table) {
            //
            $table->foreignId('subcategory_id')->constrained('categories')->onDelete('cascade')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('Products', function (Blueprint $table) {
            //
            $table->foreignId('subcategory_id')->constrained('categories')->onDelete('cascade')->onUpdate('cascade');

        });
    }
};
