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
        Schema::create('absensi', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('pertemuan');
            $table->timestamps();
            $table->integer('id_kehadiran')->unsigned();
            $table->integer('id_krs')->unsigned();
            $table->integer('id_mahasiswa')->unsigned();
            $table->integer('id_dosen')->unsigned();

            $table->foreign('id_kehadiran')
                ->references('id')
                ->on('kehadiran')
                ->cascadeOnDelete()
                ->cascadeOnUpdate();
            $table->foreign('id_krs')
                ->references('id')
                ->on('krs')
                ->cascadeOnDelete()
                ->cascadeOnUpdate();
            $table->foreign('id_mahasiswa')
                ->references('id')
                ->on('mahasiswa')
                ->cascadeOnDelete()
                ->cascadeOnUpdate();
            $table->foreign('id_dosen')
                ->references('id')
                ->on('dosen')
                ->cascadeOnDelete()
                ->cascadeOnUpdate();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('absensi');
    }
};
