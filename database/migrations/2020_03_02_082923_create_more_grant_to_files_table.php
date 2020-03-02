<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMoreGrantToFilesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('more_grant_to_files', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('m_grant_id')->unsigned();
            $table->text('file');
            $table->timestamps();

            $table->foreign('m_grant_id')->references('id')->on('more_grants');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('more_grant_to_files');
    }
}
