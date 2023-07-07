<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('vorname');
            $table->string('strasse')->nullable();
            $table->string('stadt')->nullable();
            $table->string('plz')->nullable();
            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->integer('rolle_id');
            $table->string('geschlecht')->nullable();
            $table->string('telefonnummer')->nullable();
            $table->string('fachbereich')->nullable();
            $table->string('bild')->nullable();
            $table->string('bildungsgrad')->nullable();
            $table->string('geburtsdatum')->nullable();
            $table->text('beschreibung')->nullable();

            $table->rememberToken();
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
        Schema::dropIfExists('users');
    }
};
