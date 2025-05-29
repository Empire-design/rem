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
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->foreignId('idcategory')->references('id')->on('categories')->cascadeOnDelete();
            $table->foreignId('idsubcategory')->references('id')->on('subcategories')->cascadeOnDelete();
            $table->string('productname');
            $table->string('price');
            $table->string('productimage');
            $table->text('description');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('products');
    }
};
