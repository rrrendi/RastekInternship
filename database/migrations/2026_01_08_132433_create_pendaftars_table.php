<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('pendaftars', function (Blueprint $table) {
            $table->id();
            $table->string('full_name');
            $table->string('email')->unique();
            $table->string('phone');
            $table->text('address');
            $table->enum('education_level', ['SMK', 'D3', 'S1', 'S2']);
            $table->string('institution');
            $table->decimal('gpa_average', 4, 2); // IPK atau Rata-rata Rapor
            $table->date('birth_date');
            $table->string('birth_place');
            $table->enum('gender', ['Laki-laki', 'Perempuan']);
            $table->enum('status', ['pending', 'reviewed', 'accepted', 'rejected'])->default('pending');
            $table->text('notes')->nullable();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('pendaftars');
    }
};