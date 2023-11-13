<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('surat_rujukan', function (Blueprint $table) {
            $table->string('id');
            $table->string('kode_rekammedis');
            $table->string("fasilitas");
            $table->string("rencana_tindak_lanjut");
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
    }
};
