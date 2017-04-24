<h2 class=""><?php echo $title; ?></h2>

<?php echo form_open('tiporesiduo/cadastrar', array('class' => 'form-horizontal')); ?>
<div class="form-group" >
    <label for="nome" class="col-sm-1 control-label">Nome</label>
    <div class="col-sm-3">
        <input type="text" class="form-control" name="nome" value="<?php echo set_value('nome'); ?>" /><?php echo form_error('nome'); ?>
    </div>
</div>
<div class="form-group" >
    <label for="descricao" class="col-sm-1 control-label">Descri&ccedil;&atilde;o</label>
    <div class="col-sm-3">
        <textarea class="form-control" name="descricao" ><?php echo set_value('descricao'); ?></textarea>
        <?php echo form_error('descricao'); ?>
    </div>
</div>


<input type="submit" class="btn btn-default" name="submit" value="Cadastrar residuo" />

</form>