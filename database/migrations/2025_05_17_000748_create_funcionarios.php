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
        Schema::create('funcionarios', function (Blueprint $table) {
            $table->id();
            $table->string('nome_completo');
            $table->string('CPF', 11);
            $table->date('data_nascimento');
            $table->text('endereco');
            $table->string('telefone', 15);
            $table->string('email');
            $table->string('cargo');
            $table->date('data_admissao');
            $table->decimal('salario', 10, 2);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('funcionarios');
    }
};
