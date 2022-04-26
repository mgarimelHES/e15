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
        Schema::create('parking_user', function (Blueprint $table) {
            $table->id();
            $table->timestamps();

            # `parking_id` and `user_id` will be foreign keys, so they have to be unsigned
            #  Note how the field names here correspond to the tables they will connect...
            # `parking_id` will reference the `parkings` table and `user_id` will reference the `users` table.
            $table->bigInteger('parking_id')->unsigned();
            $table->bigInteger('user_id')->unsigned();

            # Make foreign keys
            $table->foreign('parking_id')->references('id')->on('parkings');
            $table->foreign('user_id')->references('id')->on('users');

            # (Optional) Add additional columns for data you want to associate with this relationship
            $table->text('comments')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('parking_user');
    }
};