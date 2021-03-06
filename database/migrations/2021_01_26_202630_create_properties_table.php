<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePropertiesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('properties', function (Blueprint $table) {
            $table->id();
            $table->uuid('uuid')->nullable();
            $table->string('county');
            $table->string('country');
            $table->string('town');
            $table->string('postcode')->nullable();
            $table->text('description');
            $table->string('address');
            $table->string('image_full')->nullable();
            $table->string('image_thumbnail')->nullable();
            $table->decimal('latitude', $precision = 8, $scale = 6)->nullable();
            $table->decimal('longitude', $precision = 9, $scale = 6)->nullable();
            $table->integer('num_bedrooms');
            $table->integer('num_bathrooms');
            $table->integer('price');
            $table->integer('property_type_id');
            $table->string('type');
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
        Schema::dropIfExists('properties');
    }
}
