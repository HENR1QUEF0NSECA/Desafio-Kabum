<h2 class="text-primary mb-4">Cadastrar Novo Endereço</h2>

<form method="post" class="row g-3">
    <div class="col-md-6">
        <label for="logradouro" class="form-label">Logradouro:</label>
        <input type="text" id="logradouro" name="logradouro" required class="form-control">
    </div>

    <div class="col-md-6">
        <label for="numero" class="form-label">Número:</label>
        <input type="text" id="numero" name="numero" required class="form-control">
    </div>

    <div class="col-md-6">
        <label for="complemento" class="form-label">Complemento:</label>
        <input type="text" id="complemento" name="complemento" class="form-control">
    </div>

    <div class="col-md-6">
        <label for="bairro" class="form-label">Bairro:</label>
        <input type="text" id="bairro" name="bairro" required class="form-control">
    </div>

    <div class="col-md-6">
        <label for="cidade" class="form-label">Cidade:</label>
        <input type="text" id="cidade" name="cidade" required class="form-control">
    </div>

    <div class="col-md-6">
        <label for="estado" class="form-label">Estado (UF):</label>
        <input type="text" id="estado" name="estado" maxlength="2" required 
               pattern="[A-Za-z]{2}" title="Digite a sigla do estado (ex: SP)" 
               class="form-control">
    </div>

    <div class="col-md-6">
        <label for="cep" class="form-label">CEP:</label>
        <input type="text" id="cep" name="cep" maxlength="9" required
               pattern="\d{5}-?\d{3}" title="Digite um CEP válido (ex: 12345-678)"
               class="form-control">
    </div>

    <input type="hidden" name="cliente_id" value="<?= htmlspecialchars($cliente['id_cliente'] ?? '') ?>">

    <div class="col-12">
        <button type="submit" name="cadastrar" class="btn btn-primary">Cadastrar</button>
        <a href="/advancedmvc/endereco/index/<?= htmlspecialchars($cliente['id_cliente'] ?? '') ?>" class="btn btn-secondary">Cancelar</a>
    </div>
</form>

<script>
// Máscara para CEP
document.getElementById('cep').addEventListener('input', function(e) {
    var value = e.target.value.replace(/\D/g, '');
    if (value.length > 5) {
        value = value.substring(0,5) + '-' + value.substring(5,8);
    }
    e.target.value = value;
});

// Converter estado para maiúsculas
document.getElementById('estado').addEventListener('input', function(e) {
    e.target.value = e.target.value.toUpperCase();
});
</script>
