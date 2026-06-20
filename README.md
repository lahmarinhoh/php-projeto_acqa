# Sistema de Gerenciamento de Tarefas (ACQA)

Este é um projeto acadêmico desenvolvido em PHP com arquitetura MVC e banco de dados MySQL, focado na criação de um Task Manager completo com autenticação de usuários.

## 🛠️ Tecnologias e Padrões Utilizados
* **Linguagem:** PHP
* **Banco de Dados:** MySQL
* **Estilização:** Bootstrap 5 (via CDN)
* **Arquitetura:** MVC (Model-View-Controller)
* **Design Patterns:** Singleton (para conexão com o banco) e Front Controller (para roteamento centralizado)
* **Segurança:** PDO com Prepared Statements e hash de senhas (BCRYPT)

## ⚙️ Como executar o projeto localmente

1. Clone este repositório na pasta `htdocs` do seu XAMPP (ou equivalente).
2. Certifique-se de que os módulos **Apache** e **MySQL** estejam rodando no painel de controle do XAMPP.
3. Acesse o **phpMyAdmin** (`http://localhost/phpmyadmin/`).
4. Na aba **SQL**, cole e execute o script abaixo para estruturar o banco de dados:

```sql
-- 1. Criação do Banco de Dados
CREATE DATABASE IF NOT EXISTS acqa_db CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
USE acqa_db;

-- 2. Criação da Tabela de Usuários
CREATE TABLE IF NOT EXISTS users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(50) NOT NULL,
    email VARCHAR(100) NOT NULL UNIQUE,
    password VARCHAR(255) NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB;

-- 3. Criação da Tabela de Tarefas
CREATE TABLE IF NOT EXISTS tasks (
    id INT AUTO_INCREMENT PRIMARY KEY,
    user_id INT NOT NULL,
    title VARCHAR(255) NOT NULL,
    description TEXT,
    status ENUM('pendente', 'concluida') DEFAULT 'pendente',
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (user_id) REFERENCES users(id) ON DELETE CASCADE
) ENGINE=InnoDB;