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
        Schema::create('dosen', function (Blueprint $table) {
            $table->increments('id');
            $table->string('nama');
            $table->string('nip')->unique();
            $table->string('tempat_lahir', 50);
            $table->date('tanggal_lahir', 0);
            $table->enum('jenis_kelamin', ['L', 'P']);
            $table->text('alamat');
            $table->string('agama', 50);
            $table->string('no_telepon', 50);
            $table->string('foto');
            $table->timestamps();
            $table->integer('id_fakultas')->unsigned();
            $table->integer('id_prodi')->unsigned();
            $table->integer('id_user')->unsigned();

            $table->foreign('id_prodi')
                ->references('id')
                ->on('prodi')
                ->cascadeOnDelete()
                ->cascadeOnUpdate();
            $table->foreign('id_fakultas')
                ->references('id')
                ->on('fakultas')
                ->cascadeOnDelete()
                ->cascadeOnUpdate();
            $table->foreign('id_user')
                ->references('id')
                ->on('user')
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
        Schema::dropIfExists('dosen');
    }
};
