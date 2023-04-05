<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('guitars', function (Blueprint $table) {

            // normal columns
            $table->id();
            $table->string('name');
            $table->string('description');
            $table->string('make');
            $table->dateTime('bid_expiration');
            $table->float('price');
            $table->string('image');

            
            // fk for types
            $table->bigInteger("type_id")->unsigned();
            $table->foreign("type_id")->references("id")->on("types")->onUpdate("cascade")->onDelete("restrict");

            // fk for conditions
            $table->bigInteger("condition_id")->unsigned();
            $table->foreign("condition_id")->references("id")->on("conditions")->onUpdate("cascade")->onDelete("restrict");

            // fk for users
            $table->bigInteger("user_id")->unsigned();
            $table->foreign("user_id")->references("id")->on("users")->onUpdate("cascade")->onDelete("restrict");

            $table->rememberToken();
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
        Schema::dropIfExists('guitars');
    }
};
