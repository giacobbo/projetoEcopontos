<?php echo validation_errors(); ?>

<?php echo form_open('login/login'); ?>

<div class="form-group">
<label for="email">E-mail</label>
<input type="text" class="form-control" name="email" /><br />
</div>

<div class="form-group">
<label for="senha">Senha</label>
<input type="password" class="form-control" name="senha" /><br />
</div>


<input type="submit" class="btn btn-default" name="submit" value="Login" />

</form>