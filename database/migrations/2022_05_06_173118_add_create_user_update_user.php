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
        Schema::table("payment_methods", function (Blueprint $table) {
            $table->unsignedBigInteger("update_user_id");

            $table
                ->foreign("update_user_id")
                ->references("id")
                ->on("users")
                ->onDelete("Cascade")
                ->onUpdate("Cascade");
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table("payment_methods", function (Blueprint $table) {
            //
        });
    }
};
