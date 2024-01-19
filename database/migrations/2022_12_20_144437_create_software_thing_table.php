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
        Schema::create('software_thing', function (Blueprint $table) {
            $table->id();
            $table->foreignId('software_id')->constrained('softwares')->onDelete('cascade');
            $table->foreignId('thing_id')->constrained('things')->onDelete('cascade');
            $table->string('function');
            $table->string('number_of_branchs');
            $table->string('software_version');
            $table->string('url');
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
        Schema::dropIfExists('software_thing');
    }
};