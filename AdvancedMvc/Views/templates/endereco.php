<h2 class="text-primary mb-4">Lista de Endereços</h2>

<?php if (!empty($cliente) && isset($cliente['id_cliente'])): ?>
    <a href="/advancedmvc/endereco/cadastrar/<?= $cliente['id_cliente'] ?>" class="btn btn-success mb-3">
        Cadastrar Novo Endereço
    </a>
<?php endif; ?>

<div class="table-responsive">
<table class="table table-bordered table-hover align-middle" border="1" cellpadding="8" cellspacing="0">
    <thead class="thead-dark">
        <tr>
            <th class="col-id">ID</th>
            <th class="col-rua">Rua</th>
            <th class="col-numero">Número</th>
            <th class="col-complemento">Complemento</th>
            <th class="col-bairro">Bairro</th>
            <th class="col-cidade">Cidade</th>
            <th class="col-estado">Estado</th>
            <th class="col-acao">Ação</th>
        </tr>
    </thead>
    <tbody>
        <?php if (!empty($data)): ?>
            <?php foreach ($data as $endereco): ?>
                <tr class="linha-endereco">
                    <td class="celula-id"><?= htmlspecialchars($endereco['id']) ?></td>
                    <td class="celula-rua"><?= htmlspecialchars($endereco['logradouro']) ?></td>
                    <td class="celula-numero"><?= htmlspecialchars($endereco['numero']) ?></td>
                    <td class="celula-complemento"><?= htmlspecialchars($endereco['complemento']) ?></td>
                    <td class="celula-bairro"><?= htmlspecialchars($endereco['bairro']) ?></td>
                    <td class="celula-cidade"><?= htmlspecialchars($endereco['cidade']) ?></td>
                    <td class="celula-estado"><?= htmlspecialchars($endereco['estado']) ?></td>
                    <td class="celula-acao">
                        <a href="/advancedmvc/endereco/editar/<?= $endereco['id'] ?>" class="btn btn-warning btn-editar">
                            Editar
                        </a>
                    </td>
                </tr>
            <?php endforeach; ?>
        <?php else: ?>
            <tr class="linha-vazia">
                <td colspan="8" class="sem-endereco">Nenhum endereço encontrado.</td>
            </tr>
        <?php endif; ?>
    </tbody>
</table>
</div>
<div class="col-12 d-flex gap-2">
    <a href="/advancedmvc/cliente/editar/<?= $cliente['id_cliente'] ?>" class="btn btn-primary mb-3"    >
        Voltar
    </a>
    </div>
