<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUnidadesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('unidades', function (Blueprint $table) {
            $table->id();
            $table->string('unidade', 5);
            $table->string('descricao', 30);
            $table->timestamps();
        });

        //Relacionamento com a tabela Produto.
        Schema::table('produtos', function(Blueprint $table) {
            $table->unsignedBigInteger('unidade_id');
            $table->foreign('unidade_id')->references('id')->on('unidades');
        });

        //Relacionamento com a tabela Produto_detalhes.
        Schema::table('produto_detalhes', function(Blueprint $table) {
            $table->unsignedBigInteger('unidade_id');
            $table->foreign('unidade_id')->references('id')->on('unidades');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //Remover relacionamento com a tabela Produtos_detalhes.
        Schema::table('produto_detalhes', function(Blueprint $table) {
            //Remover FK.
            $table->dropForeign('produto_detalhes_unidade_id_foreign');

            //Remover a coluna unidade_id.
            $table->dropColumn('unidade_id');
        });

        //Remover relacionamento com a tabela Produto.
        Schema::table('produtos', function(Blueprint $table) {
            //Remover FK.
            $table->dropForeign('produtos_unidade_id_foreign');

            //Remover a coluna unidade_id.
            $table->dropColumn('unidade_id');
        });

        Schema::dropIfExists('unidades');
    }
}
