-- Script de inicialização do banco de dados
USE solidariedade;

-- Criar tabela de configurações se não existir
CREATE TABLE IF NOT EXISTS `settings` (
    `id` bigint unsigned NOT NULL AUTO_INCREMENT,
    `key` varchar(255) NOT NULL,
    `value` text,
    `created_at` timestamp NULL DEFAULT NULL,
    `updated_at` timestamp NULL DEFAULT NULL,
    PRIMARY KEY (`id`),
    UNIQUE KEY `settings_key_unique` (`key`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Inserir configurações padrão
INSERT IGNORE INTO `settings` (`key`, `value`, `created_at`, `updated_at`) VALUES
('app_name', 'Sistema Solidariedade', NOW(), NOW()),
('app_description', 'Plataforma para ações solidárias', NOW(), NOW()),
('maintenance_mode', '0', NOW(), NOW());

-- Criar usuário administrativo padrão (senha: admin123)
INSERT IGNORE INTO `users` (`name`, `email`, `email_verified_at`, `password`, `created_at`, `updated_at`) VALUES
('Administrador', 'admin@solidariedade.com', NOW(), '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', NOW(), NOW());

-- Configurar charset e collation
ALTER DATABASE solidariedade CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
