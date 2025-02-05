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
            $table->string('product_name');
            $table->double('fws')->nullable();
            $table->double('rws')->nullable();
            $table->double('l1')->nullable();
            $table->double('l2')->nullable();
            $table->double('l3')->nullable();
            $table->double('r1')->nullable();
            $table->double('r2')->nullable();
            $table->double('r3')->nullable();
            $table->double('srf')->nullable();
            $table->integer('is_active')->default(1);
            $table->timestamps();
            $table->softDeletes();
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
