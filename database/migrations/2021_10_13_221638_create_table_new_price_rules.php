<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTableNewPriceRules extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('new_price_rules', function (Blueprint $table) {
            $table->id();
            $table->unsignedInteger('category_id')->nullable();
            $table->double('quantityPerPackage',12,3)->nullable();
            $table->double('unitPrice',12,3)->nullable();
            $table->double('discount',12,3)->nullable();
            $table->double('priceDiscount',12,3)->nullable();
            $table->double('packageDiscount',12,3)->nullable();
            $table->double('packagePrice',12,3)->nullable();
            $table->double('savedPurchase',12,3)->nullable();
            $table->double('savedShipping',12,3)->nullable();
            $table->double('savedTotal',12,3)->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('new_price_rules');
    }
}
