<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('movimientos', function (Blueprint $table) {
            $table->id();
            $table->foreignId('radicado_id')->constrained('radicados')->onDelete('cascade');
            $table->foreignId('dependencia_origen_id')->nullable()->constrained('dependencias')->nullOnDelete();
            $table->foreignId('dependencia_destino_id')->nullable()->constrained('dependencias')->nullOnDelete();
            $table->string('estado');
            $table->text('observacion')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('movimientos');
    }
};
