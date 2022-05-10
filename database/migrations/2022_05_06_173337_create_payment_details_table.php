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
        Schema::create("payment_details", function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger("company_id");
            $table->unsignedBigInteger("plan_id");
            $table->unsignedBigInteger("paymethod_id");
            $table->date("pay_date");
            $table->date("start_date");
            $table->date("end_date");

            $table->timestamps();

            $table
                ->foreign("company_id")
                ->references("id")
                ->on("companies")
                ->onDelete("Cascade")
                ->onUpdate("Cascade");

            $table
                ->foreign("plan_id")
                ->references("id")
                ->on("plans")
                ->onDelete("Cascade")
                ->onUpdate("Cascade");

            $table
                ->foreign("paymethod_id")
                ->references("id")
                ->on("payment_methods")
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
        Schema::dropIfExists("payment_details");
    }
};
