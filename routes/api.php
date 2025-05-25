<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Models\Funcionarios;
use App\Models\Departamentos;


Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

//1. Criar, Listar, Buscar por Id, Atualizar, Deletar Funcionários
Route::post('/funcionarios' , function (Request $request) {
 $funcionarios = new Funcionarios();
 $funcionarios->nome_completo = $request->input('nome_completo');;
 $funcionarios->CPF = $request->input('CPF');;
 $funcionarios->data_nascimento = $request->input('data_nascimento');;
 $funcionarios->endereco = $request->input('endereco');;
 $funcionarios->telefone = $request->input('telefone');;
 $funcionarios->email = $request->input('email');;
 $funcionarios->cargo = $request->input('cargo');;
 $funcionarios->data_admissao = $request->input('data_admissao');;
 $funcionarios->salario = $request->input('salario');;
$funcionarios->departamento_id = $request->input('departamento_id');;

 $funcionarios->save();
 return response()->json($funcionarios);
});

Route::get('funcionarios', function(){
    $funcionarios = Funcionarios::all();

    return response()->json($funcionarios);
});

Route::get('/funcionarios/{id}', function ($id) {
    $funcionarios = Funcionarios::find($id);
    return response ()->json($funcionarios);
});


Route::patch('/funcionarios/{id}', function (request $request, $id){
    $funcionarios = Funcionarios::find($id);
    if($request->input('nome_completo') !== null){
        $funcionarios->nome_completo = $request->input('nome_completo');
    }
    if ($request->input('CPF') !== null){
        $funcionarios->CPF = $request->input('CPF'); 
    }
    if ($request->input('data_nascimento') !== null){
        $funcionarios->data_nascimento = $request->input('data_nascimento'); 
    }
    if ($request->input('endereco') !== null){
        $funcionarios->endereco = $request->input('endereco'); 
    }
    if ($request->input('telefone') !== null){
        $funcionarios->telefone = $request->input('telefone'); 
    }
    if ($request->input('email') !== null){
        $funcionarios->email = $request->input('email'); 
    }
    if ($request->input('cargo') !== null){
        $funcionarios->cargo = $request->input('cargo'); 
    }
    if ($request->input('data_admissao') !== null){
        $funcionarios->data_admissao = $request->input('data_admissao'); 
    }
    if ($request->input('salario') !== null){
        $funcionarios->salario = $request->input('salario'); 
    }
    $funcionarios->save();
    return response()->json($funcionarios);
});

Route::delete('/funcionarios/{id}', function ($id){
    $funcionarios = Funcionarios::find($id);
    $funcionarios->delete();
    return response()->json($funcionarios);
});

////1. Criar, Listar, Buscar por Id, Atualizar, Deletar Departamentos
Route::post('/departamentos' , function (Request $request) {
 $departamentos = new Departamentos();
 $departamentos->nome_departamento = $request->input('nome_departamento');;
 $departamentos->descricao_departamento = $request->input('descricao_departamento');;
 $departamentos->responsavel = $request->input('responsavel' );;
 $departamentos->localizacao = $request->input('localizacao');;
 $departamentos->numero_funcionarios = $request->input('numero_funcionarios');;

 $departamentos->save();
 return response()->json($departamentos);
});

Route::get('departamentos', function(){
    $departamentos = Departamentos::all();

    return response()->json($departamentos);
});

Route::get('/departamentos/{id}', function ($id) {
    $departamentos = Departamentos::find($id);
    return response ()->json($departamentos);
});


Route::patch('/departamentos/{id}', function (request $request, $id){
    $departamentos = Departamentos::find($id);
    if($request->input('nome_departamento') !== null){
        $departamentos->nome_departamento = $request->input('nome_departamento');
    }
    if ($request->input('descricao_departamento') !== null){
        $departamentos->descricao_departamento = $request->input('descricao_departamento'); 
    }
    if ($request->input('responsavel') !== null){
        $departamentos->responsavel = $request->input('responsavel'); 
    }
    if ($request->input('localizacao') !== null){
        $departamentos->localizacao = $request->input('localizacao'); 
    }
    if ($request->input('numero_funcionarios') !== null){
        $departamentos->numero_funcionarios = $request->input('numero_funcionarios'); 
    }
    $departamentos->save(); // <-- FALTAVA
    return response()->json($departamentos); // <-- FALTAVA
});

Route::delete('/departamentos/{id}', function ($id){
    $departamentos = Departamentos::find($id);
    $departamentos->delete();
    return response()->json($departamentos);
});


//3. Listar Funcionários com seus Departamentos
Route::get('/funcionarios-com-departamentos', function () {
    $funcionarios = Funcionarios::with('departamento')->get();
    return response()->json($funcionarios);
});

//4. Listar Departamentos com seus Funcionários
Route::get('/departamentos-com-funcionarios', function () {
    $departamentos = Departamentos::with('funcionarios')->get();
    return response()->json($departamentos);
});

//5. Buscar Departamento de um Funcionário
Route::get('/funcionarios/{id}/departamento', function ($id) {
    $funcionario = Funcionarios::with('departamento')->find($id);
    if (!$funcionario) {
        return response()->json(['erro' => 'Funcionário não encontrado'], 404);
    }
    return response()->json($funcionario->departamento);
});

//6. Buscar Funcionários de um Departamento
Route::get('/departamentos/{id}/funcionarios', function ($id) {
    $departamento = Departamentos::with('funcionarios')->find($id);
    if (!$departamento) {
        return response()->json(['erro' => 'Departamento não encontrado'], 404);
    }
    return response()->json($departamento->funcionarios);
});