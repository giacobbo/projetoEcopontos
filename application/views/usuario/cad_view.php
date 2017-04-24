<h2 class=""><?php echo $title; ?></h2>

<?php echo form_open('usuario/cadastrar', array('class' => 'form-horizontal')); ?>
<div class="form-group" >
    <label for="nome" class="col-sm-1 control-label">Nome</label>
    <div class="col-sm-3">
        <input type="text" class="form-control" name="nome" value="<?php echo set_value('nome'); ?>" /><?php echo form_error('nome'); ?>
    </div>
</div>

<div class="form-group">
    <label for="cpf" class="col-sm-1 control-label">CPF</label>
    <div class="col-sm-3">
        <input type="text" class="form-control" name="cpf" value="<?php echo set_value('cpf'); ?>" /><?php echo form_error('cpf'); ?>
    </div>
</div>

<div class="form-group">
    <label for="email" class="col-sm-1 control-label">E-mail</label>
    <div class="col-sm-3">
        <input type="text" class="form-control" name="email" value="<?php echo set_value('email'); ?>" /><?php echo form_error('email'); ?>
    </div>
</div>

<div class="form-group">
    <label for="senha" class="col-sm-1 control-label">Senha</label>
    <div class="col-sm-3">
        <input type="password" class="form-control" name="senha" /><?php echo form_error('senha'); ?>
    </div>
</div>

<div class="form-group">
    <label for="confirmasenha" class="col-sm-1 control-label">Confirma&ccedil;&atilde;o de senha</label>
    <div class="col-sm-3">
        <input type="password" class="form-control" name="confirmasenha" /><?php echo form_error('confirmasenha'); ?>
    </div>
</div>
<?php 
if ($this->session->userdata('tipo') == '1') {
?>
<div class="form-group">
    <label for="administrador" class="col-sm-1 control-label">Usu&aacute;rio &eacute; administrador</label>
    <div class="col-sm-1">
        <input type="checkbox" class="form-control" name="administrador" value="1" /><?php echo form_error('administrador'); ?>
    </div>
</div>
<?php } ?>
<input type="submit" class="btn btn-default" name="submit" value="Cadastrar usuario" />

</form>