<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Dashboard - Sistema ACQA</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
</head>
<body class="bg-light">

    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <div class="container">
            <a class="navbar-brand" href="index.php?action=dashboard">ACQA Tasks</a>
            <div class="d-flex align-items-center text-white">
                <span class="me-3">Olá, <?= htmlspecialchars($userName) ?>!</span>
                <a href="index.php?action=logout" class="btn btn-sm btn-outline-light">Sair</a>
            </div>
        </div>
    </nav>

    <div class="container mt-5">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h2>Minhas Tarefas</h2>
            <a href="index.php?action=create_task" class="btn btn-primary">Nova Tarefa</a>
        </div>

        <div class="card shadow-sm">
            <div class="card-body">
                <?php if (empty($tasks)): ?>
                    <p class="text-muted mb-0">Você ainda não possui tarefas cadastradas.</p>
                <?php else: ?>
                    <table class="table table-hover mb-0">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Título</th>
                                <th>Descrição</th>
                                <th>Status</th>
                                <th>Data de Criação</th>
                                <th class="text-center">Ações</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($tasks as $task): ?>
                                <tr>
                                    <td><?= htmlspecialchars($task['id']) ?></td>
                                    <td><strong><?= htmlspecialchars($task['title']) ?></strong></td>
                                    <td><small class="text-muted"><?= htmlspecialchars($task['description'] ?? '') ?></small></td>
                                    <td>
                                        <?php if ($task['status'] === 'concluida'): ?>
                                            <span class="badge bg-success">Concluída</span>
                                        <?php else: ?>
                                            <span class="badge bg-warning text-dark">Pendente</span>
                                        <?php endif; ?>
                                    </td>
                                    <td><?= date('d/m/Y H:i', strtotime($task['created_at'])) ?></td>
                                    <td class="text-center">
                                        <a href="index.php?action=edit_task&id=<?= $task['id'] ?>" class="btn btn-sm btn-outline-primary me-1">Editar</a>
                                        <a href="index.php?action=delete_task&id=<?= $task['id'] ?>" class="btn btn-sm btn-outline-danger" onclick="return confirm('Tem certeza que deseja excluir esta tarefa?')">Excluir</a>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                <?php endif; ?>
            </div>
        </div>
    </div>

</body>
</html>