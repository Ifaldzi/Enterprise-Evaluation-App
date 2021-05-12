<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePertanyaansTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pertanyaan', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('tipe_evaluasi_id');
            $table->string('pertanyaan');
            $table->timestamps();
            $table->engine = 'InnoDB';
            $table->foreign('tipe_evaluasi_id')
                    ->references('id')
                    ->on('tipe_evaluasi')
                    ->onCascade('delete');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('pertanyaan');
    }
}
