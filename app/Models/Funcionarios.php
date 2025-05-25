<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Funcionarios extends Model
{
    protected $table = 'funcionarios';
    protected $fillable = ['nome_completo', 'CPF', 'data_nascimento', 'endereco', 'telefone', 'email', 'cargo', 'data_admissao', 'salario', 'departamento_id'
    ];

    public function departamento()
    {
        return $this->belongsTo(Departamentos::class, 'departamento_id'); 
    }
}
