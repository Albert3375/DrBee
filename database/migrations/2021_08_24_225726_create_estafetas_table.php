<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEstafetasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('estafetas', function (Blueprint $table) {
            $table->id();
            $table->string('destination_info_addrees1')->nullable();
            $table->string('destination_info_address2')->nullable();
            $table->string('destination_info_city')->nullable();
            $table->string('destination_info_contactName')->nullable();
            $table->string('destination_info_corporateName')->nullable();
            $table->string('destination_info_customerNumber')->nullable();
            $table->string('destination_info_neighborhood')->nullable();
            $table->string('destination_info_phoneNumber')->nullable();
            $table->string('destination_info_state')->nullable();
            $table->boolean('destination_info_valid')->nullable();
            $table->string('destination_info_zipCode')->nullable();
            $table->string('destination_info_CellPhone')->nullable();

            $table->string('origin_info_addreess1')->nullable();
            $table->string('origin_info_addreess2')->nullable();
            $table->string('origin_info_city')->nullable();
            $table->string('origin_info_contactName')->nullable();
            $table->string('origin_info_corporateName')->nullable();
            $table->string('origin_info_customerNumber')->nullable();
            $table->string('origin_info_neighborhood')->nullable();
            $table->string('origin_info_phoneNumber')->nullable();
            $table->string('origin_info_state')->nullable();
            $table->boolean('origin_info_valid')->nullable();
            $table->string('origin_info_zipCode')->nullable();
            $table->string('origin_info_CellPhone')->nullable();

            $table->string('label_request_content')->nullable();
            $table->boolean('label_request_deliveryToEstafetaOffice')->nullable();
            $table->string('label_request_destinationInfo')->nullable();
            $table->string('label_request_numberOfLabels')->nullable();
            $table->string('label_request_officeNum')->nullable();
            $table->string('label_request_originInfo')->nullable();
            $table->string('label_request_parcelTypeId')->nullable();
            $table->string('label_request_reference')->nullable();
            $table->boolean('label_request_returnDocument')->nullable();
            $table->string('label_request_serviceTypeId')->nullable();
            $table->boolean('label_request_valid')->nullable();
            $table->string('label_request_weight')->nullable();
            $table->string('label_request_originZipCodeForRouting')->nullable();
            $table->string('label_request_contentDescription')->nullable();

            $table->string('estafeta_label_quadrant')->nullable();
            $table->boolean('estafeta_label_valid')->nullable();
            $table->string('estafeta_label_password')->nullable();
            $table->string('estafeta_label_labelDescriptionListCount')->nullable();
            $table->string('estafeta_label_login')->nullable();
            $table->string('estafeta_label_customerNumber')->nullable();
            $table->string('estafeta_label_labelDescriptionList')->nullable();
            $table->string('estafeta_label_suscriberId')->nullable();
            $table->string('estafeta_label_paperType')->nullable();

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
        Schema::dropIfExists('estafetas');
    }
}
