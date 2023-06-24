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
        Schema::create('krs', function (Blueprint $table) {
            $table->increments('id');
            $table->enum('status', ['pending', 'process', 'rejected', 'accepted']);
            $table->timestamps();
            $table->integer('id_mahasiswa')->unsigned();
            $table->integer('id_tahun_akademik')->unsigned();

            $table->foreign('id_mahasiswa')
                ->references('id')
                ->on('mahasiswa')
                ->cascadeOnDelete()
                ->cascadeOnUpdate();
            $table->foreign('id_tahun_akademik')
                ->references('id')
                ->on('tahun_akademik')
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
        Schema::dropIfExists('krs');
    }
};
