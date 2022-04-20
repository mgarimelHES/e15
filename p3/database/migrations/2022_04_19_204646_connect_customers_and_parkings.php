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
        //
        Schema::table('parkings', function (Blueprint $table) {

            # Remove the field associated with the old way we were storing owners or customers
            # Can do this here, or update the original migration that creates the `parkings` table
            # $table->dropColumn('owner');
    
            # Add a new bigint field called `customer_id`
            # has to be unsigned (i.e. positive)
            # nullable so it's possible to have a parking without an existing customer or membership
            $table->bigInteger('customer_id')->unsigned()->nullable();
    
            # This field `customer_id` is a foreign key that connects to the `id` field in the `customers` table
            $table->foreign('customer_id')->references('id')->on('customers');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
        Schema::table('parkings', function (Blueprint $table) {

            # ref: http://laravel.com/docs/migrations#dropping-indexes
            # combine tablename + fk field name + the word "foreign"
            $table->dropForeign('parkings_customer_id_foreign');
    
            $table->dropColumn('customer_id');
        });
    }
};