<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Fornecedor;

class FornecedorController extends Controller
{
    public function index() {
        return view('app.fornecedor.index');
    }

    public function listar(Request $request) {

        $fornecedores = Fornecedor::with('produtos')->where('nome', 'like', '%'.$request->input('nome').'%')
        ->where('site', 'like', '%'.$request->input('site').'%')
        ->where('uf', 'like', '%'.$request->input('uf').'%')
        ->where('email', 'like', '%'.$request->input('email').'%')
        ->simplePaginate(10);
        
        return view('app.fornecedor.listar', ['fornecedores' => $fornecedores, 'request' => $request->all()]);
    }

    public function adicionar(Request $request) {

        $msg = '';

        //Inclusão do registro.
        if($request->input('_token') != '' && $request->input('id') == '') {

            $regras = [
                'nome' => 'required|min:3',
                'site' => 'required',
                'uf' => 'required|min:2|max:2',
                'email' => 'email'
            ];

            $feedback = [
                'required' => 'O campo :attribute é obrigatório.',
                'nome.min' => 'O campo Nome deve ter no mínimo 3 caracteres.',
                'uf.min' => 'O campo UF deve ter 2 caracteres.',
                'uf.max' => 'O campo UF deve ter apenas 2 caracteres.',
                'email.email' => 'O campo e-mail não foi preenchido corretamente.'                
            ];

            $request->validate($regras, $feedback);

            $fornecedor = new Fornecedor();
            $fornecedor->create($request->all());

            $msg = 'Cadastro realizado com sucesso.';

        }

        //Edição do registro.
        if($request->input('_token') != '' && $request->input('id') != '') {
            $fornecedor = Fornecedor::find($request->input('id'));
            $update = $fornecedor->update($request->all());

            if($update) {
                $msg = 'Atualização realizada com sucesso.';
            }
            else {
                $msg = 'Erro na atualização.';
            }

            return redirect()->route('app.fornecedor.editar', ['id' => $request->input('id'), 'msg' => $msg]);
        }

        return view('app.fornecedor.adicionar', ['msg' => $msg]);
    }

    public function editar($id, $msg = '') {
        
        $fornecedor = Fornecedor::find($id);
       
        return view('app.fornecedor.adicionar', ['fornecedor' => $fornecedor, 'msg' => $msg]);
    }

    public function excluir($id) {
        
        $fornecedor = Fornecedor::find($id)->delete();

        $msg = 'Registro excluído com sucesso.';
        
        return view('app.fornecedor.index', ['msg' => $msg]);

    }
}
