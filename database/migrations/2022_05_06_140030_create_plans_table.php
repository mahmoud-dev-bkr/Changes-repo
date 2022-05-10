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
        Schema::create("plans", function (Blueprint $table) {
            $table->id();
            $table->string("name_en");
            $table->string("name_ar");
            $table->integer("max_emp");
            $table->float("coast");
            $table->integer("duration_days"); //in days
            $table->unsignedBigInteger("create_user_id");
            $table->unsignedBigInteger("update_user_id");
            $table->timestamps();
            // //////////////////////////////////////////////////////////
            $table
                ->foreign("create_user_id")
                ->references("id")
                ->on("users")
                ->onDelete("Cascade")
                ->onUpdate("Cascade");
            ////////////////////////////////////////////////////////////////////////////////////
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
        Schema::dropIfExists("plans");
    }
};
