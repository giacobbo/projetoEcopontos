<h2 class=""><?php echo $title; ?></h2>

<?php echo validation_errors(); ?>

<?php echo form_open('pontoColeta/cadastrar', array('class' => 'form-horizontal')); ?>
<div class="form-group" >
    <label for="nome" class="col-sm-1 control-label">Nome</label>
    <div class="col-sm-3">
        <input type="text" class="form-control" name="nome" />
    </div>
</div>

<div class="form-group">
    <label for="estado" class="col-sm-1 control-label">Estado</label>
    <div class="col-sm-3">
        <select name="estado" class="form-control">
            <option></option>
            <?php
            foreach ($estados as $estado) {
                echo '<option value="' . $estado->id . '">' . $estado->nome . '</option>';
            }
            ?>
        </select>
    </div>
</div>
<div class="form-group">
    <label for="cidade" class="col-sm-1 control-label">Cidade</label>
    <div class="col-sm-3">
        <select name="cidade" class="form-control"> a
            <option></option>
            <?php
            foreach ($cidades as $cidade) {
                echo '<option value="' . $cidade->id . '">' . $cidade->nome . '</option>';
            }
            ?>
        </select>
    </div>
</div>
<div class="form-group">
    <label for="rua" class="col-sm-1 control-label">Rua</label>
    <div class="col-sm-3">
        <input type="text" class="form-control" name="rua" />
    </div>
</div>

<div class="form-group">
    <label for="numero" class="col-sm-1 control-label">Numero</label>
    <div class="col-sm-3">
        <input type="text" class="form-control" name="numero" />
    </div>
</div>
<div class="form-group">
    <label for="complemento" class="col-sm-1 control-label">Complemento</label>
    <div class="col-sm-3">
        <input type="text" class="form-control" name="complemento" />
    </div>
</div>
<div class="form-group">
    <label for="cep" class="col-sm-1 control-label">CEP</label>
    <div class="col-sm-3">
        <input type="text" class="form-control" name="cep" />
    </div>
</div>
<!--<label for="residuo" class="col-sm-1 control-label">Res&iacute;duos aceitos</label>-->
<fieldset>
    <legend>Res&iacute;duos aceitos</legend>
    <div class="form-group">
        <div class="col-sm-1">
            <?php
            foreach ($residuos as $residuo) {
                echo '<label><input class="form-control" name="residuo-' . $residuo["id"] . '"  type="checkbox" value="' . $residuo["id"] . '"/>' . $residuo["nome"] . '</label>';
            }
            ?>
        </div>
    </div>
</fieldset>
<input type="submit" class="btn btn-default" name="submit" value="Cadastrar ponto" />
</form>
<script type="text/javascript" src="<?php echo base_url('assets/js/jquery-3.2.0.min.js') ?>"></script>
<script type="text/javascript">
    jQuery('select[name=estado]').change(function () {
        var dadosFormulario = {estado: jQuery(this).val()};
        jQuery.ajax({
            type: 'POST',
            url: '<?php echo base_url('index.php/pontoColeta/cidades') ?>',
            data: dadosFormulario,
            success: function (o) {
                var retorno = eval('(' + o + ')');
                var option = jQuery('<option>', {value: '', text: ''});

                jQuery('select[name=cidade]').empty();
                jQuery('select[name=cidade]').append(option);

                for (var i = 0; i < retorno.cidades.length; i++) {
                    var cidade = retorno.cidades[i];
                    option = jQuery('<option>', {value: cidade.id, text: cidade.nome});

                    jQuery('select[name=cidade]').append(option);
                }
            },
            error: function () {
            }
        });
    });
</script>