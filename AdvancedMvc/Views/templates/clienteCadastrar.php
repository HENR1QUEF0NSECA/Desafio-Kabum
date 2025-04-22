<h2 class="text-primary mb-4">Cadastrar Novo Cliente</h2>

<form method="post" class="row g-3">
    <div class="col-md-6">
        <label class="form-label">Nome:</label>
        <input type="text" name="nome" class="form-control" required>
    </div>

    <div class="col-md-6">
        <label class="form-label">Data de Nascimento:</label>
        <input type="date" name="data_nascimento" class="form-control" required>
    </div>

    <div class="col-md-6">
        <label class="form-label">CPF:</label>
        <input type="text" id="cpf" name="cpf" maxlength="14" placeholder="000.000.000-00" class="form-control" required>
    </div>

    <div class="col-md-6">
        <label class="form-label">RG:</label>
        <input type="text" name="rg" maxlength="12" class="form-control" required>
    </div>

    <div class="col-md-6">
        <label class="form-label">Telefone:</label>
        <input type="text" id="telefone" name="telefone" maxlength="17" placeholder="+00(00)00000-0000" class="form-control">
    </div>

    <div class="col-12">
        <input type="submit" name="cadastrar" value="Cadastrar" class="btn btn-success">
        <a href="/advancedmvc/cliente" class="btn btn-secondary">Cancelar</a>
    </div>
</form>


<script>
// Máscara para CPF (000.000.000-00)
document.getElementById('cpf').addEventListener('input', function(e) {
    let value = e.target.value.replace(/\D/g, '');
    
    if (value.length > 3) {
        value = value.substring(0,3) + '.' + value.substring(3);
    }
    if (value.length > 7) {
        value = value.substring(0,7) + '.' + value.substring(7);
    }
    if (value.length > 11) {
        value = value.substring(0,11) + '-' + value.substring(11,13);
    }
    
    e.target.value = value;
});

// Máscara para Telefone (+00(00)00000-0000)
document.getElementById('telefone').addEventListener('input', function(e) {
    let value = e.target.value.replace(/\D/g, '');
    
    if (value.length > 0) {
        value = '+' + value;
    }
    if (value.length > 3) {
        value = value.substring(0,3) + '(' + value.substring(3);
    }
    if (value.length > 6) {
        value = value.substring(0,6) + ')' + value.substring(6);
    }
    if (value.length > 11) {
        value = value.substring(0,11) + '-' + value.substring(11);
    }
    
    e.target.value = value;
});

document.getElementById('cpf').addEventListener('keypress', function(e) {
    if (e.key === '.' || e.key === '-') return;
    if (isNaN(parseInt(e.key))) {
        e.preventDefault();
    }
});

document.getElementById('telefone').addEventListener('keypress', function(e) {
    if (e.key === '+' || e.key === '(' || e.key === ')' || e.key === '-') return;
    if (isNaN(parseInt(e.key))) {
        e.preventDefault();
    }
});
</script>
