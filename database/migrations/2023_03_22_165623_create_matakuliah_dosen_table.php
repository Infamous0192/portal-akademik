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
        Schema::create('matakuliah_dosen', function (Blueprint $table) {
            $table->integer('id_matakuliah')->unsigned();
            $table->integer('id_dosen')->unsigned();

            $table->foreign('id_matakuliah')
                ->references('id')
                ->on('matakuliah')
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
        Schema::dropIfExists('matakuliah_dosen');
    }
};
