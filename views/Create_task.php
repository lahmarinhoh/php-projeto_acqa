<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Nova Tarefa - Sistema ACQA</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
</head>
<body class="bg-light">
    <div class="container mt-5" style="max-width: 600px;">
        <div class="card shadow-sm p-4">
            <h2 class="mb-4">Adicionar Nova Tarefa</h2>

            <?php if (!empty($error)): ?>
                <div class="alert alert-danger"><?= htmlspecialchars($error) ?></div>
            <?php endif; ?>

            <form action="index.php?action=create_task" method="POST">
                <div class="mb-3">
                    <label class="form-label">Título da Tarefa</label>
                    <input type="text" name="title" class="form-control" required placeholder="Ex: Estudar Padrões de Projeto">
                </div>
                <div class="mb-3">
                    <label class="form-label">Descrição (Opcional)</label>
                    <textarea name="description" class="form-control" rows="4" placeholder="Detalhes sobre a tarefa..."></textarea>
                </div>
                <div class="d-flex justify-content-between">
                    <a href="index.php?action=dashboard" class="btn btn-secondary">Voltar</a>
                    <button type="submit" class="btn btn-primary">Salvar Tarefa</button>
                </div>
            </form>
        </div>
    </div>
</body>
</html>