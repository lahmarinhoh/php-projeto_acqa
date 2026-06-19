<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Editar Tarefa - Sistema ACQA</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
</head>
<body class="bg-light">
    <div class="container mt-5" style="max-width: 600px;">
        <div class="card shadow-sm p-4">
            <h2 class="mb-4">Editar Tarefa</h2>

            <?php if (!empty($error)): ?>
                <div class="alert alert-danger"><?= htmlspecialchars($error) ?></div>
            <?php endif; ?>

            <form action="index.php?action=edit_task&id=<?= $task['id'] ?>" method="POST">
                <div class="mb-3">
                    <label class="form-label">Título da Tarefa</label>
                    <input type="text" name="title" class="form-control" value="<?= htmlspecialchars($task['title']) ?>" required>
                </div>
                <div class="mb-3">
                    <label class="form-label">Descrição</label>
                    <textarea name="description" class="form-control" rows="4"><?= htmlspecialchars($task['description']) ?></textarea>
                </div>
                <div class="mb-3">
                    <label class="form-label">Status</label>
                    <select name="status" class="form-select">
                        <option value="pendente" <?= $task['status'] === 'pendente' ? 'selected' : '' ?>>Pendente</option>
                        <option value="concluida" <?= $task['status'] === 'concluida' ? 'selected' : '' ?>>Concluída</option>
                    </select>
                </div>
                <div class="d-flex justify-content-between">
                    <a href="index.php?action=dashboard" class="btn btn-secondary">Voltar</a>
                    <button type="submit" class="btn btn-success">Atualizar</button>
                </div>
            </form>
        </div>
    </div>
</body>
</html>