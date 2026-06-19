<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Cadastro - Sistema ACQA</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
</head>
<body class="bg-light d-flex align-items-center" style="height: 100vh;">
    <div class="container" style="max-width: 400px;">
        <div class="card shadow-sm p-4">
            <h2 class="text-center mb-4">Criar Conta</h2>
            
            <?php if (!empty($error)): ?>
                <div class="alert alert-danger"><?= htmlspecialchars($error) ?></div>
            <?php endif; ?>
            <?php if (!empty($success)): ?>
                <div class="alert alert-success"><?= htmlspecialchars($success) ?></div>
            <?php endif; ?>

            <form action="index.php?action=register" method="POST">
                <div class="mb-3">
                    <label class="form-label">Nome de Usuário</label>
                    <input type="text" name="username" class="form-control" required>
                </div>
                <div class="mb-3">
                    <label class="form-label">E-mail</label>
                    <input type="email" name="email" class="form-control" required>
                </div>
                <div class="mb-3">
                    <label class="form-label">Senha</label>
                    <input type="password" name="password" class="form-control" required placeholder="Mínimo 6 caracteres">
                </div>
                <button type="submit" class="btn btn-success w-100">Registrar</button>
            </form>
            <div class="text-center mt-3">
                <p class="small text-muted">Já possui uma conta? <a href="index.php?action=login">Faça Login</a></p>
            </div>
        </div>
    </div>
</body>
</html>