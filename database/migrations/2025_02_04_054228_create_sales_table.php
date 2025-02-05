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
        Schema::create('sales', function (Blueprint $table) {
            $table->id();
            $table->string('car_model')->nullable();
            $table->string('carplate')->nullable();
            $table->date('sales_date')->nullable();
            $table->string('product_ids')->nullable();
            $table->integer('fws_worker_id')->nullable();
            $table->integer('fws_product_id')->nullable();
            $table->double('fws_degree')->nullable();
            $table->integer('fws_remove_worker_id')->nullable();
            $table->integer('rws_worker_id')->nullable();
            $table->integer('rws_product_id')->nullable();
            $table->double('rws_degree')->nullable();
            $table->integer('rws_remove_worker_id')->nullable();
            $table->integer('srf_worker_id')->nullable();
            $table->integer('srf_product_id')->nullable();
            $table->double('srf_degree')->nullable();
            $table->integer('srf_remove_worker_id')->nullable();
            $table->integer('l1_worker_id')->nullable();
            $table->integer('l1_product_id')->nullable();
            $table->double('l1_degree')->nullable();
            $table->integer('l1_remove_worker_id')->nullable();
            $table->integer('l2_worker_id')->nullable();
            $table->integer('l2_product_id')->nullable();
            $table->double('l2_degree')->nullable();
            $table->integer('l2_remove_worker_id')->nullable();
            $table->integer('l3_worker_id')->nullable();
            $table->integer('l3_product_id')->nullable();
            $table->double('l3_degree')->nullable();
            $table->integer('l3_remove_worker_id')->nullable();
            $table->integer('r1_worker_id')->nullable();
            $table->integer('r1_product_id')->nullable();
            $table->double('r1_degree')->nullable();
            $table->integer('r1_remove_worker_id')->nullable();
            $table->integer('r2_worker_id')->nullable();
            $table->integer('r2_product_id')->nullable();
            $table->double('r2_degree')->nullable();
            $table->integer('r2_remove_worker_id')->nullable();
            $table->integer('r3_worker_id')->nullable();
            $table->integer('r3_product_id')->nullable();
            $table->double('r3_degree')->nullable();
            $table->integer('r3_remove_worker_id')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('sales');
    }
};
