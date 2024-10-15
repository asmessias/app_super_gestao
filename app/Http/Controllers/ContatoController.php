<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\SiteContato;
use App\MotivoContato;

class ContatoController extends Controller
{
    public function contato(Request $request){

        $motivo_contatos = MotivoContato::all();

        return view('site.contato', ['titulo' => 'Contato (Teste)', 'motivo_contatos' => $motivo_contatos]);
    }

    public function salvar(Request $request){

        //validação dos dados do formulário.
        $request->validate([
            //nomes com no mínimo 3 e no máximo 40 caracteres.
            'nome' => 'required|min:3|max:40|unique:site_contatos',
            'telefone' => 'required',
            'email' => 'email',
            'motivo_contatos_id' => 'required',
            'mensagem' => 'required|max:2000'            
        ],
        [
            'nome.required' => 'O campo nome é obrigatório.',
            'nome.min' => 'O campo nome precisa ter no mínimo 3 caracteres.',
            'nome.max' => 'O campo nome precisa ter no máximo 40 caracteres.',
            'nome.unique' => 'O nome informado já está em uso.',
            'telefone.required' => 'O campo telefone é obrigatório',
            'email.email' => 'Informe um e-mail válido.',
            'motivo_contatos_id.required' => 'O campo motivo contato é obrigatório.',
            'mensagem.required' => 'O campo mensagem é obrigatório.',
            'mensagem.max' => 'O campo mensagem suporta até 2000 caracteres.'
            //'required' => 'O campo :attribute é obrigatório'
        ]
    );

        SiteContato::create($request->all());

        return redirect()->route('site.index');
    }
}
