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
        Schema::create('item_sale_dts', function (Blueprint $table) {
            $table->id();
            $table->integer('item_sale_id');
            $table->date('sales_date');
            $table->string('type')->nullable(); //work or sale
            $table->integer('worker_id')->nullable();
            $table->double('rate')->nullable();
            $table->double('worker_commission')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('item_sale_dts');
    }
};
