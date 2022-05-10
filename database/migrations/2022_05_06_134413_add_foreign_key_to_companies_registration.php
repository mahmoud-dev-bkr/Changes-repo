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
        Schema::table("companies_registration_requests", function (
            Blueprint $table
        ) {
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
        Schema::table("companies_registration_requests", function (
            Blueprint $table
        ) {
            //
        });
    }
};
