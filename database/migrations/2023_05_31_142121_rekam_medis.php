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
        Schema::create('rekam_medis', function (Blueprint $table) {
            $table->string('kode');
            $table->string('antrian');
            $table->string("bpjs");
            $table->text("anamnesa");
            $table->text('pemeriksaan_fisik');
            $table->string("diagnosa");
            $table->string("tindakan");
            $table->string("giz");
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
