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
        Schema::create('user_bid', function (Blueprint $table) {
            $table->id();

            // bid amount
            $table->float("bid_amount");

            // fk for users
            $table->bigInteger("user_id")->unsigned();
            $table->foreign("user_id")->references("id")->on("users")->onUpdate("cascade")->onDelete("restrict");

            // fk for guitars
            $table->bigInteger("guitar_id")->unsigned();
            $table->foreign("guitar_id")->references("id")->on("guitars")->onUpdate("cascade")->onDelete("restrict");

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
        Schema::dropIfExists('user_bid');
    }
};
