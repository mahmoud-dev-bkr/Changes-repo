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
        Schema::create("companies_registration_requests", function (
            Blueprint $table
        ) {
            $table->id();
            $table->unsignedBigInteger("company_id");
            $table->enum("status", [1, 2, 3])->default(1); //1-pending 2-waiting 3-declined
            $table->timestamps();
            $table->unsignedBigInteger("user_id");

            $table
                ->foreign("user_id")
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
        Schema::dropIfExists("companies_registration_requests");
    }
};
