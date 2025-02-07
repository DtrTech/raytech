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
        Schema::create('item_sales', function (Blueprint $table) {
            $table->id();
            $table->integer('item_id');
            $table->date('sales_date');
            $table->string('car_plate')->nullable();
            $table->double('quantity')->nullable();
            $table->double('per_cost_price')->nullable();
            $table->double('total_cost_price')->nullable();
            $table->double('total_sale_price')->nullable();
            $table->double('profit')->nullable();
            $table->double('sa_commission')->nullable();
            $table->date('issue_pv_date')->nullable();
            $table->double('sales_commission')->nullable();
            $table->double('work_commission')->nullable();
            $table->double('net_profit')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('item_sales');
    }
};
