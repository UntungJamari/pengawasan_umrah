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
        Schema::create('pengawasans', function (Blueprint $table) {
            $table->id();
            $table->string('hari');
            $table->date('tanggal');
            $table->time('jam');
            $table->foreignId('id_ppiu');
            $table->string('izin');
            $table->integer('jumlah_jemaah_laki_laki');
            $table->integer('jumlah_jemaah_wanita');
            $table->date('tanggal_keberangkatan');
            $table->date('tanggal_kepulangan');
            $table->text('temuan_lapangan');
            $table->string('petugas_1');
            $table->string('petugas_2');
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
        Schema::dropIfExists('pengawasans');
    }
};
