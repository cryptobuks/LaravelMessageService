<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAliveMessageProcessesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('alive_message_processes', function (Blueprint $table) {
            $table->increments('id');

            $table->enum('type', ['sms', 'notification', 'store'])
                ->nullable();

            $table->text('form')
                ->nullable();

            $table->text('to');

            $table->text('body');

            // Event field
            $table->unsignedInteger('event_id')
                ->index();

            $table->foreign('event_id')
                ->references('id')
                ->on('alive_message_events')
                ->onDelete('cascade')
                ->onUpdate('cascade');

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
        Schema::dropIfExists('alive_message_processes');
    }
}