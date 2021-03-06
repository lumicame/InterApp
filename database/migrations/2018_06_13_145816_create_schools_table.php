<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSchoolsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('schools', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->string('nit',12);
            $table->string('email',100)->unique();
            $table->string('phone',15);
            $table->string('logo')->nullable();
            $table->string('portada')->nullable();
            $table->string('direction')->nullable();
            $table->string('description')->nullable();
            $table->integer('license')->default(30);
            $table->string('estado')->default("activo");
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
        Schema::dropIfExists('schools');
    }
}
