<?php
// Verificação direta dos dados
if (empty($data['endereco'])) {
    die("<script>alert('ERRO: Dados do endereço não recebidos!'); history.back();</script>");
}

$endereco = $data['endereco'];
?>

<h2 class="text-primary mb-4">Editar Endereço</h2>

<form method="post" class="row g-3">
    <div class="col-md-6">
        <label for="logradouro" class="form-label">Logradouro:</label>
        <input type="text" id="logradouro" name="logradouro" value="<?= $endereco['logradouro'] ?? '' ?>" required class="form-control">
    </div>

    <div class="col-md-6">
        <label for="numero" class="form-label">Número:</label>
        <input type="text" id="numero" name="numero" value="<?= $endereco['numero'] ?? '' ?>" required class="form-control">
    </div>

    <div class="col-md-6">
        <label for="complemento" class="form-label">Complemento:</label>
        <input type="text" id="complemento" name="complemento" value="<?= $endereco['complemento'] ?? '' ?>" class="form-control">
    </div>

    <div class="col-md-6">
        <label for="bairro" class="form-label">Bairro:</label>
        <input type="text" id="bairro" name="bairro" value="<?= $endereco['bairro'] ?? '' ?>" required class="form-control">
    </div>

    <div class="col-md-6">
        <label for="cidade" class="form-label">Cidade:</label>
        <input type="text" id="cidade" name="cidade" value="<?= $endereco['cidade'] ?? '' ?>" required class="form-control">
    </div>

    <div class="col-md-6">
        <label for="estado" class="form-label">Estado (UF):</label>
        <input type="text" id="estado" name="estado" maxlength="2" required 
               pattern="[A-Za-z]{2}" title="Digite a sigla do estado (ex: SP)" 
               value="<?= $endereco['estado'] ?? '' ?>" class="form-control">
    </div>

    <div class="col-md-6">
        <label for="cep" class="form-label">CEP:</label>
        <input type="text" id="cep" name="cep" maxlength="9" required
               pattern="\d{5}-?\d{3}" title="Digite um CEP válido (ex: 12345-678)"
               value="<?= $endereco['cep'] ?? '' ?>" class="form-control">
    </div>

    <input type="hidden" name="id" value="<?= $endereco['id'] ?? '' ?>">
    <input type="hidden" name="cliente_id" value="<?= $endereco['cliente_id'] ?? '' ?>">

    <div class="col-12 d-flex gap-2">
        <input type="submit" name="salvar" class="btn btn-success" value="Salvar Alterações">
        <a href="/advancedmvc/endereco/index/<?= htmlspecialchars($endereco['cliente_id'] ?? '') ?>" class="btn btn-secondary">Cancelar</a>
    </div>
</form>

<form method="post" onsubmit="return confirm('Tem certeza que deseja excluir este endereço?');" class="mt-3">
    <input type="hidden" name="id" value="<?= $endereco['id'] ?? '' ?>">
    <button type="submit" name="deletar" class="btn btn-danger">Deletar Endereço</button>
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
