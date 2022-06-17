<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateStatusEmailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('status_emails', function (Blueprint $table) {
            $table->id();
            $table->integer('email_id')->unsigned();
            $table->integer('spam')->nullable()->default(0);
            $table->integer('favorite')->nullable()->default(0);
            $table->integer('delete')->nullable()->default(0);
            $table->integer('to_file')->nullable()->default(0);
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
        Schema::dropIfExists('status_emails');
    }
}
