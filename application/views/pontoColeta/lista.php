<?php

$this->table->set_heading('Nome', 'Endere&ccedil;o', 'Res&iacute;duos aceitos', 'A&ccedil;&otilde;es');
$template = array('table_open' => '<table class="table">');
$this->table->set_template($template);


foreach ($pontos as $ponto) {
    $dados['nome'] = $ponto['nomePonto'];
    $dados['endereco'] = "Rua " . $ponto['rua']. ", " . $ponto['numero'] . " - " . $ponto['cidade']. ", " . $ponto['estado'] ;
    $dados['residuos'] = $ponto['residuo'];
    $dados['acoes'] = '<a href="'.base_url('index.php/pontoColeta/editar/'.$ponto['id']). '"><img src="' . base_url("assets/images/actions/edit.png") . '" alt="Editar ponto"/></a>';
    $dados['acoes'] .= '<a href="'.base_url('index.php/pontoColeta/deletar/'.$ponto['id']). '"><img src="' . base_url("assets/images/actions/delete.png") . '" alt="Remover ponto"/></a>';


    $valoresTabela[] = $dados;
}

echo $this->table->generate($valoresTabela);
