<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('parkings', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->string('slug');
            $table->string('parking_lot');
            $table->string('license_plate');
            $table->string('owner');
            $table->tinyInteger('model_year');
            #  $table->string('vehicle_image')->nullable(); # Here we use a column modifier to specify this column can be left empty (null)
            $table->dateTime('parking_start_time');
            $table->date('parking_end_time');
            $table->string('vehicle_image')->nullable();
            $table->string('make');
            $table->string('model');
            $table->text('description');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('parkings');
    }
};