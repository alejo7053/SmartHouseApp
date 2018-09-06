<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDevicesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('devices', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->string('description');
            $table->enum('role', ['load','sensor']);
            $table->enum('type', ['AC','DC','Digital','Analogic']);
            $table->float('value', 8, 4)->default(0);
            $table->enum('status', ['off', 'on'])->default('off');
            $table->enum('action', ['off', 'on'])->nullable();
            $table->datetime('start')->nullable();
            $table->datetime('end')->nullable();
            $table->integer('room_id')->unsigned();
            $table->foreign('room_id')->references('id')->on('rooms');
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
        Schema::table('devices', function (Blueprint $table) {
            $table->dropForeign(['room_id']);
        });

        Schema::dropIfExists('devices');
    }
}
