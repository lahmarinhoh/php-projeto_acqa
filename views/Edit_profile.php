<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Editar Perfil - Sistema ACQA</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
</head>
<body class="bg-light">

    <nav class="navbar navbar-expand-lg navbar-dark bg-dark mb-5">
        <div class="container">
            <a class="navbar-brand" href="index.php?action=dashboard">ACQA Tasks</a>
            <div class="d-flex align-items-center text-white">
                <span class="me-3">Olá, <?= htmlspecialchars($_SESSION['username']) ?>!</span>
                <a href="index.php?action=logout" class="btn btn-sm btn-outline-light">Sair</a>
            </div>
        </div>
    </nav>

    <div class="container" style="max-width: 500px;">
        <div class="card shadow-sm p-4">
            <h2 class="mb-4 text-center">Meu Perfil</h2>

            <?php if (!empty($error)): ?>
                <div class="alert alert-danger"><?= htmlspecialchars($error) ?></div>
            <?php endif; ?>
            <?php if (!empty($success)): ?>
                <div class="alert alert-success"><?= htmlspecialchars($success) ?></div>
            <?php endif; ?>

            <form action="index.php?action=edit_profile" method="POST">
                <div class="mb-3">
                    <label class="form-label">Nome de Usuário</label>
                    <input type="text" name="username" class="form-control" value="<?= htmlspecialchars($user['username']) ?>" required>
                </div>
                <div class="mb-3">
                    <label class="form-label">E-mail</label>
                    <input type="email" name="email" class="form-control" value="<?= htmlspecialchars($user['email']) ?>" required>
                </div>
                <div class="mb-4">
                    <label class="form-label">Nova Senha (opcional)</label>
                    <input type="password" name="password" class="form-control" placeholder="Deixe em branco para manter a atual">
                    <small class="text-muted">Preencha apenas se desejar trocar a senha atual.</small>
                </div>
                <div class="d-flex justify-content-between">
                    <a href="index.php?action=dashboard" class="btn btn-secondary">Voltar</a>
                    <button type="submit" class="btn btn-primary">Salvar Alterações</button>
                </div>
            </form>
        </div>
    </div>
</body>
</html>