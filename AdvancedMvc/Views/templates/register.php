<?php if (!empty($erro)): ?>
    <div class="alert alert-danger"><?= $erro ?></div>
<?php endif; ?>

<h2>Registrar</h2>
<form method="post" class="row g-3">
    <div class="col-md-6">
        <label>Nome:</label>
        <input type="text" name="nome" value="<?= $_POST['nome'] ?? '' ?>" required class="form-control">
    </div>
    
    <div class="col-md-6">
        <label>Email:</label>
        <input type="email" name="email" value="<?= $_POST['email'] ?? '' ?>" required class="form-control">
    </div>
    
    <div class="col-md-6">
        <label>Senha:</label>
        <input type="password" name="senha" required minlength="6" class="form-control">
    </div>
    <div class="col-md-6">

    </div>
    <div class="col-md-6">
        <button type="submit" name="registrar" class="btn btn-primary">Registrar</button>
    </div>

    <p>Ja possui uma conta? <a href="login">Faça login</a></p>

</form>
