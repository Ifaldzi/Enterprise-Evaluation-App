<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class UpdatePertanyaanTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('pertanyaan', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->unsignedBigInteger('struktur_id');
            $table->foreign('struktur_id')
                ->references('id')
                ->on('struktur')
                ->onDelete('cascade');
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
        Schema::table('pertanyaan', function(Blueprint $table){
            $table->dropForeign('pertanyaan_struktur_id_foreign');
            $table->dropColumn('struktur_id');
            $table->dropForeign('pertanyaan_tipe_evaluasi_id_foreign');
            $table->dropColumn('tipe_evaluasi_id');
        });
    }
}
