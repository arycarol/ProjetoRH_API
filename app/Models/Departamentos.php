<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Departamentos extends Model
{
    protected $table = 'departamentos';
    protected $fillable = ['nome_departamento', 'descricao_departamento', 'responsavel', 'localizacao', 'numero_funcionarios'
    ];

    public function funcionarios()
    {
        return $this->hasMany(Funcionarios::class, 'departamento_id');
    }
}
