<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTablePriceRules extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('price_rules', function (Blueprint $table) {
            $table->id();
            $table->unsignedInteger('category_id')->nullable();
            $table->double('costPerPiece',8,3)->nullable();
            $table->double('quantityPerPackage',8,3)->nullable();
            $table->double('costPackage',12,3)->nullable();
            $table->double('shippingCost',12,3)->nullable();
            $table->double('costPerPound',12,3)->nullable();
            $table->double('totaCostPoundPerShipping',12,3)->nullable();
            $table->double('packageCostPlusShipping',12,3)->nullable();
            $table->double('packageDiscount',12,3)->nullable();
            $table->double('totalPackageWithDiscount',12,3)->nullable();
            $table->double('costPieceWithoutDiscount',8,3)->nullable();
            $table->double('costPieceWithDiscount',8,3)->nullable();
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
        Schema::dropIfExists('price_rules');
    }
}
