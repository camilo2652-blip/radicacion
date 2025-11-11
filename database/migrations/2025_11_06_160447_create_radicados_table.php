<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('radicados', function (Blueprint $table) {
            $table->id();
            $table->string('numero')->unique();
            $table->string('asunto');
            $table->text('descripcion');
            $table->string('archivo')->nullable();
            $table->foreignId('ciudadano_id')->constrained('users')->onDelete('cascade');
            $table->foreignId('dependencia_id')->nullable()->constrained('dependencias')->nullOnDelete();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('radicados');
    }
};
