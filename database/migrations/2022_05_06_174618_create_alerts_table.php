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
        Schema::create("alerts", function (Blueprint $table) {
            $table->id();
            $table->string("message_en");
            $table->string("message_ar");
            $table->boolean("is_shown");
            $table->date("start_date");
            $table->date("end_date");
            $table->unsignedBigInteger("user_id");
            $table->timestamps();
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
        Schema::dropIfExists("alerts");
    }
};
