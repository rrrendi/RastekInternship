<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('documents', function (Blueprint $table) {
            $table->id();
            $table->foreignId('pendaftar_id')->constrained()->onDelete('cascade');
            $table->string('cover_letter_path'); // Surat Pengantar
            $table->string('transcript_path'); // Transkrip Nilai
            $table->string('cv_path'); // CV
            $table->string('photo_path')->nullable(); // Foto
            $table->string('id_card_path')->nullable(); // KTP
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('documents');
    }
};