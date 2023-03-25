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
        Schema::create('prodi', function (Blueprint $table) {
            $table->increments('id');
            $table->string('nama', 50);
            $table->string('kode', 10);
            $table->enum('jenjang', ['D3', 'S1', 'S2', 'S3']);
            $table->timestamps();
            $table->integer('id_fakultas')->unsigned();

            $table->foreign('id_fakultas')
                ->references('id')
                ->on('fakultas')
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
        Schema::dropIfExists('prodi');
    }
};
