```php
<?php
require_once __DIR__ . "/../../conexao.php";

$mensagem = "";

// Adicionar produto ao pedido
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $conta_id = filter_input(INPUT_POST, "conta_id", FILTER_VALIDATE_INT);
    $produto_id = filter_input(INPUT_POST, "produto_id", FILTER_VALIDATE_INT);
    $quantidade = filter_input(INPUT_POST, "quantidade", FILTER_VALIDATE_INT);

    if (!$conta_id || !$produto_id || !$quantidade || $quantidade < 1) {
        $mensagem = "Preencha todos os campos corretamente.";
    } else {
        $sql = "SELECT mesa_id FROM contas
                WHERE id = ? AND status = 'aberta'";

        $stmt = $conn->prepare($sql);
        $stmt->bind_param("i", $conta_id);
        $stmt->execute();
        $conta = $stmt->get_result()->fetch_assoc();
        $stmt->close();

        if (!$conta) {
            $mensagem = "Conta não encontrada ou já fechada.";
        } else {
            $sql = "SELECT nome, preco FROM produtos WHERE id = ?";
            $stmt = $conn->prepare($sql);
            $stmt->bind_param("i", $produto_id);
            $stmt->execute();
            $produto = $stmt->get_result()->fetch_assoc();
            $stmt->close();

            if (!$produto) {
                $mensagem = "Produto não encontrado.";
            } else {
                $conn->begin_transaction();

                try {
                    // Criar um pedido para a mesa
                    $mesa_id = (int)$conta["mesa_id"];
                    $garcom_id = null;

                    $sql = "INSERT INTO pedidos
                            (mesa_id, garcom_id, data_pedido, status)
                            VALUES (?, NULL, NOW(), 'aberto')";

                    $stmt = $conn->prepare($sql);
                    $stmt->bind_param("i", $mesa_id);
                    $stmt->execute();
                    $pedido_id = $conn->insert_id;
                    $stmt->close();

                    // Guardar o produto no pedido
                    $preco = (float)$produto["preco"];

                    $sql = "INSERT INTO itens_pedido
                            (pedido_id, produto_id, quantidade, preco)
                            VALUES (?, ?, ?, ?)";

                    $stmt = $conn->prepare($sql);
                    $stmt->bind_param(
                        "iiid",
                        $pedido_id,
                        $produto_id,
                        $quantidade,
                        $preco
                    );
                    $stmt->execute();
                    $stmt->close();

                    // Atualizar o valor da conta
                    $sql = "UPDATE contas
                            SET valor = valor + (? * ?)
                            WHERE id = ? AND status = 'aberta'";

                    $stmt = $conn->prepare($sql);
                    $stmt->bind_param("ddi", $preco, $quantidade, $conta_id);
                    $stmt->execute();
                    $stmt->close();

                    // Associar o pedido à conta
                    $sql = "UPDATE contas SET pedido_id = ?
                            WHERE id = ?";

                    $stmt = $conn->prepare($sql);
                    $stmt->bind_param("ii", $pedido_id, $conta_id);
                    $stmt->execute();
                    $stmt->close();

                    $conn->commit();
                    $mensagem = "Produto adicionado ao pedido com sucesso!";
                } catch (Throwable $erro) {
                    $conn->rollback();
                    $mensagem = "Não foi possível adicionar o produto. Confira a estrutura das tabelas.";
                }
            }
        }
    }
}

// Buscar contas abertas
$sql = "SELECT c.id, m.numero
        FROM contas c
        INNER JOIN mesas m ON c.mesa_id = m.id
        WHERE c.status = 'aberta'
        ORDER BY m.numero";

$contas = $conn->query($sql);

// Buscar produtos cadastrados
$produtos = $conn->query(
    "SELECT id, nome, preco, categoria
     FROM produtos
     ORDER BY categoria, nome"
);
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pedidos - Cara de Mau Pizzaria</title>
</head>
<body>

    <h1>Adicionar produtos ao pedido</h1>

    <?php if ($mensagem !== ""): ?>
        <p><?= htmlspecialchars($mensagem) ?></p>
    <?php endif; ?>

    <?php if ($contas && $contas->num_rows > 0): ?>
        <?php if ($produtos && $produtos->num_rows > 0): ?>

            <form method="POST">
                <label for="conta_id">Mesa / Conta:</label>
                <select name="conta_id" id="conta_id" required>
                    <option value="">Selecione a mesa</option>
                    <?php while ($conta = $contas->fetch_assoc()): ?>
                        <option value="<?= (int)$conta["id"] ?>">
                            Mesa <?= htmlspecialchars($conta["numero"]) ?>
                            — Conta <?= (int)$conta["id"] ?>
                        </option>
                    <?php endwhile; ?>
                </select>

                <br><br>

                <label for="produto_id">Produto:</label>
                <select name="produto_id" id="produto_id" required>
                    <option value="">Selecione o produto</option>
                    <?php while ($produto = $produtos->fetch_assoc()): ?>
                        <option value="<?= (int)$produto["id"] ?>">
                            <?= htmlspecialchars($produto["nome"]) ?>
                            — R$ <?= number_format(
                                (float)$produto["preco"], 2, ",", "."
                            ) ?>
                        </option>
                    <?php endwhile; ?>
                </select>

                <br><br>

                <label for="quantidade">Quantidade:</label>
                <input
                    type="number"
                    name="quantidade"
                    id="quantidade"
                    min="1"
                    value="1"
                    required
                >

                <br><br>

                <button type="submit">Adicionar produto</button>
            </form>

        <?php else: ?>
            <p>Nenhum produto cadastrado.</p>
        <?php endif; ?>
    <?php else: ?>
        <p>Não há contas abertas. Abra uma conta antes de adicionar pedidos.</p>
    <?php endif; ?>

    <p><a href="contas.php">Ver contas</a></p>
    <p><a href="abrir-conta.php">Abrir nova conta</a></p>
    <p><a href="../sistema/painel.php">Voltar ao painel</a></p>

</body>
</html>