<?php

use Illuminate\Database\Seeder;
use App\SiteContato;

class SiteContatoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        /*
        $contato = new SiteContato();

        $contato->nome = 'Sistema';
        $contato->telefone = '(61) 99999-9999';
        $contato->email = 'contato@sg.com.br';
        $contato->motivo = 1;
        $contato->mensagem = 'Seja bem-vindo ao sistema SG';

        $contato->save();
        */
        factory(SiteContato::class, 100)->create();
    }
}
