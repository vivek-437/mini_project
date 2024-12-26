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
        Schema::create('tbl_product_variant_attribute_values', function (Blueprint $table) {
            $table->integer('id', 11)->autoIncrement();
            $table->integer('tbl_product_variant_id');
            $table->integer('tbl_variant_attribute_id');
            $table->string('value');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tbl_product_variant_attribute_values');
    }
};
