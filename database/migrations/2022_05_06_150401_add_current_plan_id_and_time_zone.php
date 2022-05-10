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
        Schema::table("companies", function (Blueprint $table) {
            $table->unsignedBigInteger("current_plan_id")->nullable();
            $table->string("timezone")->nullable();
            $table->string("epm_username")->nullable(); //last employee in system b who created an update

            $table
                ->foreign("current_plan_id")
                ->references("id")
                ->on("plans")
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
        Schema::table("companies", function (Blueprint $table) {
            //
        });
    }
};
