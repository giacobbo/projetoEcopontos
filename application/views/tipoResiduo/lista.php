<?php

$this->table->set_heading('Nome', 'Descri&ccedil;&atilde;o', 'A&ccedil;&otilde;es');
$template = array('table_open' => '<table class="table">');
$this->table->set_template($template);


foreach ($residuos as $residuo) {
    $dados['nome'] = $residuo['nome'];
    $dados['descricao'] = $residuo['descricao'];
    $dados['acoes'] = '<a href="'.base_url('index.php/tipoResiduo/editar/'.$residuo['id']). '"><img src="' . base_url("assets/images/actions/edit.png") . '" alt="Editar res&iacute;duo"/></a>';
    $dados['acoes'] .= '<a href="'.base_url('index.php/tipoResiduo/deletar/'.$residuo['id']). '"><img src="' . base_url("assets/images/actions/delete.png") . '" alt="Remover res&iacute;duo"/></a>';


    $valoresTabela[] = $dados;
}

echo $this->table->generate($valoresTabela);
