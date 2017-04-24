<h2 class=""><?php echo $title; ?></h2>

<?php echo form_open('tipoResiduo/editar', array('class' => 'form-horizontal')); ?>

<input type="hidden" name="id" value="<?php echo $residuo['id'] ?>"/>

<div class="form-group" >
    <label for="nome" class="col-sm-1 control-label">Nome</label>
    <div class="col-sm-3">
        <input type="text" class="form-control" name="nome" value="<?php echo $residuo['nome'] ?>"/><?php echo form_error('nome'); ?>
    </div>
</div>

<div class="form-group" >
    <label for="descricao" class="col-sm-1 control-label">Descri&ccedil;&atilde;o</label>
    <div class="col-sm-3">
        <textarea class="form-control" name="descricao" ><?php echo $residuo['descricao'] ?></textarea>
        <?php echo form_error('descricao'); ?>
    </div>
</div>
<input type="submit" class="btn btn-default" name="submit" value="Salvar" />

</form>