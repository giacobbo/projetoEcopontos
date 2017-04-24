<?php

$config = array(
    'cad_usuario' => array(
        array(
            'field' => 'nome',
            'label' => 'Nome',
            'rules' => 'required'
        ),
        array(
            'field' => 'cpf',
            'label' => 'CPF',
            'rules' => 'required|is_unique[usuario.cpf]'
        ),
        array(
            'field' => 'email',
            'label' => 'E-mail',
            'rules' => 'required|is_unique[usuario.email]|valid_email'
        ),
        array(
            'field' => 'senha',
            'label' => 'Senha',
            'rules' => 'required'
        ),
        array(
            'field' => 'confirmasenha',
            'label' => 'Confirma&ccedil;&atilde;o de Senha',
            'rules' => 'matches[senha]'
        )
    ),
    'alterar_senha' => array(
        array(
            'field' => 'senha',
            'label' => 'Senha',
            'rules' => 'required'
        ),
        array(
            'field' => 'confirmasenha',
            'label' => 'Confirma&ccedil;&atilde;o de Senha',
            'rules' => 'matches[senha]'
        )
    ),
    'cad_tipo' => array(
        array(
            'field' => 'nome',
            'label' => 'Nome',
            'rules' => 'required'
        )
    ),
    'edit_usuario' => array(
        array(
            'field' => 'nome',
            'label' => 'Nome',
            'rules' => 'required'
        ),
        array(
            'field' => 'cpf',
            'label' => 'CPF',
            'rules' => 'required'
        ),
        array(
            'field' => 'email',
            'label' => 'E-mail',
            'rules' => 'required|valid_email'
        )
    ),
    'login' => array(
        array(
            'field' => 'email',
            'label' => 'E-mail',
            'rules' => 'required'
        ),
        array(
            'field' => 'senha',
            'label' => 'Senha',
            'rules' => 'required'
        )
    ),
    'alterar_senha' => array(
        array(
            'field' => 'senha',
            'label' => 'Senha',
            'rules' => 'required'
        ),
        array(
            'field' => 'confirmasenha',
            'label' => 'Confirma&ccedil;&atilde;o de Senha',
            'rules' => 'matches[senha]'
        )
    )
);

