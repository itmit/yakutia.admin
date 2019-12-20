<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDocumentToContestsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('document_to_contests', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('contest_id');
            $table->string('document');
            $table->timestamps();

            // $table->foreign('contest_id')->references('id')->on('contests')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('document_to_contests');
    }
}
