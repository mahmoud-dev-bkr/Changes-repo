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
        Schema::create("companies", function (Blueprint $table) {
            $table->id();
            $table->string("name_en");
            $table->string("name_ar");
            $table->string("Tel_1");
            $table->string("Tel_2")->nullable();
            $table->string("Tel_3")->nullable();
            $table->string("email");
            $table->string("website")->nullable();
            $table->string("main_address")->nullable();
            $table->decimal("long")->nullable();
            $table->decimal("lat")->nullable();
            $table->string("commercial_record")->nullable(); //ألسجل التجاري
            $table->string("logo_url")->default("/images/logo.png"); //ألسجل التجاري
            $table->string("tax_card")->nullable();
            $table->string("note")->nullable();
            $table->string("registration_num"); //12 numbers
            $table->boolean("isActive")->default(false);
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
        Schema::dropIfExists("companies");
    }
};
