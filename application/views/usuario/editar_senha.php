<h2 class=""><?php echo $title; ?></h2>

<?php echo form_open('usuario/alterarSenha', array('class' => 'form-horizontal')); ?>

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

<input type="submit" class="btn btn-default" name="submit" value="Salvar" />

</form>