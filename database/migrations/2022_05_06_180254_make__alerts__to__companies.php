<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up()
    {
        Schema::create("alerts_to_companies", function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger("alert_id");
            $table->unsignedBigInteger("company_id");

            $table
                ->foreign("alert_id")
                ->references("id")
                ->on("alerts")
                ->onDelete("Cascade")
                ->onUpdate("Cascade");

            $table
                ->foreign("company_id")
                ->references("id")
                ->on("companies")
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
        Schema::table("_companies", function (Blueprint $table) {
            //
        });
    }
};
