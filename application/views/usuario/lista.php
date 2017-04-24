<?php

$this->table->set_heading('Nome', 'CPF', 'E-mail', 'Remover');
$template = array('table_open' => '<table class="table">');
$this->table->set_template($template);

foreach ($usuarios as $usuario) {
    $dados['nome'] = $usuario['nome'];
    $dados['cpf'] = $usuario['cpf'];
    $dados['email'] = $usuario['email'];
    $dados['remover'] = '<a href="'.base_url('index.php/usuario/editar/'.$usuario['id']).'"><img src="' . base_url("assets/images/actions/edit.png") . '" alt="Editar usu&aacute;rio"/></a>';
    $dados['remover'] .= '<a href="'.base_url('index.php/usuario/deletar/'.$usuario['id']).'"><img src="' . base_url("assets/images/actions/delete.png") . '" alt="Deletar usu&aacute;rio"/></a>';
            
    $valoresTabela[] = $dados;
}

echo $this->table->generate($valoresTabela);