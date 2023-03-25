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
        Schema::create('matakuliah', function (Blueprint $table) {
            $table->increments('id');
            $table->string('nama', 50);
            $table->string('kode', 20);
            $table->integer('sks');
            $table->integer('semester');
            $table->string('hari');
            $table->time('waktu_mulai');
            $table->time('waktu_selesai');
            $table->enum('kategori', ['W', 'P']);
            $table->timestamps();
            $table->integer('id_prodi')->unsigned();
            $table->integer('id_ruangan')->unsigned();

            $table->foreign('id_prodi')
                ->references('id')
                ->on('prodi')
                ->cascadeOnDelete()
                ->cascadeOnUpdate();
            $table->foreign('id_ruangan')
                ->references('id')
                ->on('ruangan')
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
        Schema::dropIfExists('matakuliah');
    }
};
