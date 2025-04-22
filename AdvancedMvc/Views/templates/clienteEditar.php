<h2 class="text-primary mb-4">Editar Cliente</h2>

<div class="container">
    <!-- Debug: Mostra os dados recebidos -->
    <?php echo "<!-- DEBUG: " . print_r($cliente, true) . " -->"; ?>

    <form method="post" class="row g-3">
        <div class="col-md-6">
            <label class="form-label">Nome:</label>
            <input type="text" name="nome" value="<?= $cliente['nome'] ?? '' ?>" class="form-control" required>
        </div>

        <div class="col-md-6">
            <label class="form-label">Data de Nascimento:</label>
            <input type="date" name="data_nascimento" value="<?= $cliente['data_nascimento'] ?? '' ?>" class="form-control" required>
        </div>

        <div class="col-md-6">
            <label class="form-label">CPF:</label>
            <input type="text" id="cpf" name="cpf" maxlength="14" value="<?= $cliente['cpf'] ?>" class="form-control" required>
            <?php if(empty($cliente['cpf'])) { echo "<!-- ERRO: CPF não encontrado -->"; } ?>
        </div>

        <div class="col-md-6">
            <label class="form-label">RG:</label>
            <input type="text" name="rg" maxlength="12" value="<?= $cliente['rg'] ?? '' ?>" class="form-control" required>
            <?php if(empty($cliente['rg'])) { echo "<!-- ERRO: RG não encontrado -->"; } ?>
        </div>

        <div class="col-md-6">
            <label class="form-label">Telefone:</label>
            <input type="text" id="telefone" name="telefone" maxlength="17" value="<?= $cliente['telefone'] ?>" class="form-control">
            <?php if(!isset($cliente['telefone'])) { echo "<!-- AVISO: Telefone não definido -->"; } ?>
        </div>

        <input type="hidden" name="id" value="<?= $cliente['id'] ?? '' ?>">

        <div class="col-12 d-flex gap-2">
            <input type="submit" name="salvar" value="Salvar Alterações" class="btn btn-success">
            <a href="/advancedmvc/endereco/index/<?= $cliente['id'] ?? '' ?>" class="btn btn-outline-primary">Endereços</a>
            <a href="/advancedmvc/cliente<?= htmlspecialchars($endereco['cliente_id'] ?? '') ?>" class="btn btn-secondary">Cancelar</a>
        </div>
    </form>

    <form method="post" class="mt-3" onsubmit="return confirm('Tem certeza que deseja excluir este cliente?');">
        <input type="hidden" name="id" value="<?= $cliente['id'] ?? '' ?>">
        <input type="submit" name="deletar" value="Deletar Cliente" class="btn btn-danger">
    </form>
</div>

<script>
function formatarCPF(cpf) {
    cpf = cpf.replace(/\D/g, '');
    return cpf.replace(/(\d{3})(\d{3})(\d{3})(\d{2})/, '$1.$2.$3-$4');
}

function formatarTelefone(tel) {
    tel = tel.replace(/\D/g, '');
    if (tel.length > 2) {
        return `+${tel.substring(0,2)}(${tel.substring(2,4)})${tel.substring(4,9)}-${tel.substring(9)}`;
    }
    return tel;
}

document.addEventListener('DOMContentLoaded', function() {
    const cpfInput = document.getElementById('cpf');
    const telInput = document.getElementById('telefone');

    // Máscara para CPF
    cpfInput.addEventListener('input', function(e) {
        let value = e.target.value.replace(/\D/g, '');
        if (value.length > 3) value = value.substring(0,3) + '.' + value.substring(3);
        if (value.length > 7) value = value.substring(0,7) + '.' + value.substring(7);
        if (value.length > 11) value = value.substring(0,11) + '-' + value.substring(11,13);
        e.target.value = value;
    });

    // Máscara para Telefone
    telInput.addEventListener('input', function(e) {
        let value = e.target.value.replace(/\D/g, '');
        if (value.length > 0) value = '+' + value;
        if (value.length > 3) value = value.substring(0,3) + '(' + value.substring(3);
        if (value.length > 6) value = value.substring(0,6) + ')' + value.substring(6);
        if (value.length > 11) value = value.substring(0,11) + '-' + value.substring(11);
        e.target.value = value;
    });

    cpfInput.addEventListener('keypress', function(e) {
        if (e.key === '.' || e.key === '-') return;
        if (isNaN(parseInt(e.key))) e.preventDefault();
    });

    telInput.addEventListener('keypress', function(e) {
        if (e.key === '+' || e.key === '(' || e.key === ')' || e.key === '-') return;
        if (isNaN(parseInt(e.key))) e.preventDefault();
    });
});
</script>
