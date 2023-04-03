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
        Schema::create('nilai', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('nilai_absen');
            $table->integer('nilai_tugas');
            $table->integer('nilai_uts');
            $table->integer('nilai_uas');
            $table->timestamps();
            $table->integer('id_mahasiswa')->unsigned();
            $table->integer('id_matakuliah')->unsigned();
            $table->integer('id_krs')->unsigned();

            $table->foreign('id_mahasiswa')
                ->references('id')
                ->on('mahasiswa')
                ->cascadeOnDelete()
                ->cascadeOnUpdate();
            $table->foreign('id_matakuliah')
                ->references('id')
                ->on('matakuliah')
                ->cascadeOnDelete()
                ->cascadeOnUpdate();
            $table->foreign('id_krs')
                ->references('id')
                ->on('krs')
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
        Schema::dropIfExists('nilai');
    }
};
