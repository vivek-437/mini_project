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
        Schema::create('tbl_categories', function (Blueprint $table) {
            $table->integer('id', 11)->autoIncrement();
            $table->integer('tbl_category_id')->nullable()->default(1);
            $table->string('name');
            $table->text('description');
            $table->string('slug');
            $table->string('image_url');
            $table->boolean('is_active')->default(1);
            $table->integer('order');
            $table->timestamps();

            $table->foreign('tbl_category_id')->references('id')->on('tbl_categories')->onDelete('restrict');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tbl_categories');
    }
};
