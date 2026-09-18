-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Sep 03, 2026 at 09:16 PM
-- Server version: 8.0.30
-- PHP Version: 8.3.13

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `grafica_yuri`
--

-- --------------------------------------------------------

--
-- Table structure for table `cache`
--

CREATE TABLE `cache` (
  `key` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `value` mediumtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `expiration` bigint NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `cache`
--

INSERT INTO `cache` (`key`, `value`, `expiration`) VALUES
('grafica-yuri-cache-setting:grafica_email', 's:0:\"\";', 2102791222),
('grafica-yuri-cache-setting:grafica_endereco', 's:0:\"\";', 2102791222),
('grafica-yuri-cache-setting:grafica_logo', 's:51:\"config/6O7cla7bdlE366sniOh7FFIBZvmPMw5yoYJCPnrZ.jpg\";', 2102791222),
('grafica-yuri-cache-setting:grafica_nome', 's:13:\"Gráfica Yuri\";', 2102791222),
('grafica-yuri-cache-setting:grafica_telefone', 's:0:\"\";', 2102791222),
('grafica-yuri-cache-setting:site_publico_ativo', 's:1:\"1\";', 2102791222),
('grafica-yuri-cache-spatie.permission.cache', 'a:3:{s:5:\"alias\";a:4:{s:1:\"a\";s:2:\"id\";s:1:\"b\";s:4:\"name\";s:1:\"c\";s:10:\"guard_name\";s:1:\"r\";s:5:\"roles\";}s:11:\"permissions\";a:19:{i:0;a:4:{s:1:\"a\";i:1;s:1:\"b\";s:14:\"categorias.ver\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:3:{i:0;i:1;i:1;i:2;i:2;i:3;}}i:1;a:4:{s:1:\"a\";i:2;s:1:\"b\";s:16:\"categorias.gerir\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:2:{i:0;i:1;i:1;i:2;}}i:2;a:4:{s:1:\"a\";i:3;s:1:\"b\";s:9:\"itens.ver\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:4:{i:0;i:1;i:1;i:2;i:2;i:3;i:3;i:4;}}i:3;a:4:{s:1:\"a\";i:4;s:1:\"b\";s:11:\"itens.gerir\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:2:{i:0;i:1;i:1;i:2;}}i:4;a:4:{s:1:\"a\";i:5;s:1:\"b\";s:10:\"vendas.ver\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:3:{i:0;i:1;i:1;i:2;i:2;i:3;}}i:5;a:4:{s:1:\"a\";i:6;s:1:\"b\";s:12:\"vendas.criar\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:3:{i:0;i:1;i:1;i:2;i:2;i:3;}}i:6;a:4:{s:1:\"a\";i:7;s:1:\"b\";s:13:\"vendas.editar\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:2:{i:0;i:1;i:1;i:2;}}i:7;a:4:{s:1:\"a\";i:8;s:1:\"b\";s:15:\"vendas.cancelar\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:2:{i:0;i:1;i:1;i:2;}}i:8;a:4:{s:1:\"a\";i:9;s:1:\"b\";s:11:\"estoque.ver\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:3:{i:0;i:1;i:1;i:2;i:2;i:3;}}i:9;a:4:{s:1:\"a\";i:10;s:1:\"b\";s:13:\"estoque.gerir\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:2:{i:0;i:1;i:1;i:2;}}i:10;a:4:{s:1:\"a\";i:11;s:1:\"b\";s:16:\"funcionarios.ver\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:2:{i:0;i:1;i:1;i:2;}}i:11;a:4:{s:1:\"a\";i:12;s:1:\"b\";s:18:\"funcionarios.gerir\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:2:{i:0;i:1;i:1;i:2;}}i:12;a:4:{s:1:\"a\";i:13;s:1:\"b\";s:11:\"pedidos.ver\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:4:{i:0;i:1;i:1;i:2;i:2;i:3;i:3;i:4;}}i:13;a:4:{s:1:\"a\";i:14;s:1:\"b\";s:13:\"pedidos.gerir\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:2:{i:0;i:1;i:1;i:2;}}i:14;a:4:{s:1:\"a\";i:15;s:1:\"b\";s:14:\"relatorios.ver\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:2:{i:0;i:1;i:1;i:2;}}i:15;a:4:{s:1:\"a\";i:16;s:1:\"b\";s:18:\"utilizadores.gerir\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:1:{i:0;i:1;}}i:16;a:4:{s:1:\"a\";i:17;s:1:\"b\";s:19:\"configuracoes.gerir\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:1:{i:0;i:1;}}i:17;a:4:{s:1:\"a\";i:18;s:1:\"b\";s:10:\"gastos.ver\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:3:{i:0;i:1;i:1;i:2;i:2;i:3;}}i:18;a:4:{s:1:\"a\";i:19;s:1:\"b\";s:12:\"gastos.gerir\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:3:{i:0;i:1;i:1;i:2;i:2;i:3;}}}s:5:\"roles\";a:4:{i:0;a:3:{s:1:\"a\";i:1;s:1:\"b\";s:5:\"admin\";s:1:\"c\";s:3:\"web\";}i:1;a:3:{s:1:\"a\";i:2;s:1:\"b\";s:7:\"gerente\";s:1:\"c\";s:3:\"web\";}i:2;a:3:{s:1:\"a\";i:3;s:1:\"b\";s:11:\"funcionario\";s:1:\"c\";s:3:\"web\";}i:3;a:3:{s:1:\"a\";i:4;s:1:\"b\";s:7:\"cliente\";s:1:\"c\";s:3:\"web\";}}}', 1788542377);

-- --------------------------------------------------------

--
-- Table structure for table `cache_locks`
--

CREATE TABLE `cache_locks` (
  `key` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `owner` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `expiration` bigint NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `id` bigint UNSIGNED NOT NULL,
  `nome` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `grupo` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `descricao` text COLLATE utf8mb4_unicode_ci,
  `ativo` tinyint(1) NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`id`, `nome`, `grupo`, `slug`, `descricao`, `ativo`, `created_at`, `updated_at`) VALUES
(1, 'Custo da Gráfica', 'custo', 'custo-da-grafica', NULL, 1, '2026-08-19 19:43:58', '2026-08-19 19:43:58'),
(2, 'Serviços Prestados', 'servico', 'servicos-prestados', NULL, 1, '2026-08-19 19:43:58', '2026-08-19 19:43:58'),
(3, 'Reprografia', 'reprografia', 'reprografia', NULL, 1, '2026-08-19 19:43:58', '2026-08-19 19:43:58'),
(4, 'Timbragem', 'timbragem', 'timbragem', NULL, 1, '2026-08-19 19:43:58', '2026-08-19 19:43:58');

-- --------------------------------------------------------

--
-- Table structure for table `employees`
--

CREATE TABLE `employees` (
  `id` bigint UNSIGNED NOT NULL,
  `user_id` bigint UNSIGNED NOT NULL,
  `cargo` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `salario` decimal(12,2) DEFAULT NULL,
  `data_admissao` date DEFAULT NULL,
  `bilhete_identidade` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `observacoes` text COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `employees`
--

INSERT INTO `employees` (`id`, `user_id`, `cargo`, `salario`, `data_admissao`, `bilhete_identidade`, `observacoes`, `created_at`, `updated_at`) VALUES
(1, 2, 'Gerente de Operações', '285000.00', '2024-02-12', 'BI-DEMO-00002', 'Registo demonstrativo para apresentação do sistema.', '2026-08-22 19:17:12', '2026-08-22 19:17:12'),
(2, 3, 'Operador de Reprografia', '165000.00', '2024-08-19', 'BI-DEMO-00003', 'Registo demonstrativo para apresentação do sistema.', '2026-08-22 19:17:12', '2026-08-22 19:17:12'),
(3, 4, 'Designer Gráfica', '190000.00', '2025-01-20', 'BI-DEMO-00004', 'Registo demonstrativo para apresentação do sistema.', '2026-08-22 19:17:13', '2026-08-22 19:17:13');

-- --------------------------------------------------------

--
-- Table structure for table `expenses`
--

CREATE TABLE `expenses` (
  `id` bigint UNSIGNED NOT NULL,
  `user_id` bigint UNSIGNED NOT NULL,
  `categoria` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `descricao` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `valor` decimal(12,2) NOT NULL,
  `data` date NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint UNSIGNED NOT NULL,
  `uuid` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `connection` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `items`
--

CREATE TABLE `items` (
  `id` bigint UNSIGNED NOT NULL,
  `category_id` bigint UNSIGNED NOT NULL,
  `nome` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tipo` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `descricao` text COLLATE utf8mb4_unicode_ci,
  `preco_venda` decimal(12,2) DEFAULT NULL,
  `preco_custo` decimal(12,2) DEFAULT NULL,
  `unidade` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'unidade',
  `estoque_atual` int NOT NULL DEFAULT '0',
  `estoque_minimo` int NOT NULL DEFAULT '0',
  `disponivel_online` tinyint(1) NOT NULL DEFAULT '0',
  `ativo` tinyint(1) NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `items`
--

INSERT INTO `items` (`id`, `category_id`, `nome`, `tipo`, `descricao`, `preco_venda`, `preco_custo`, `unidade`, `estoque_atual`, `estoque_minimo`, `disponivel_online`, `ativo`, `created_at`, `updated_at`) VALUES
(1, 1, 'Tinta Sublimática', 'custo', NULL, NULL, '0.00', 'unidade', 18, 5, 0, 1, '2026-08-19 19:43:58', '2026-08-22 19:17:15'),
(2, 1, 'Tinta da Máquina Pequena', 'custo', NULL, NULL, '0.00', 'unidade', 12, 5, 0, 1, '2026-08-19 19:43:58', '2026-08-22 19:17:15'),
(3, 1, 'Capa de Processo', 'custo', 'Material de apoio para organizar processos e documentos internos.', NULL, '500.00', 'unidade', 24, 5, 0, 1, '2026-08-19 19:43:58', '2026-08-20 17:45:05'),
(4, 1, 'Mica', 'custo', NULL, NULL, '0.00', 'unidade', 40, 5, 0, 1, '2026-08-19 19:43:58', '2026-08-22 19:17:15'),
(5, 1, 'Envelope Castanho', 'custo', NULL, NULL, '0.00', 'unidade', 120, 5, 0, 1, '2026-08-19 19:43:58', '2026-08-22 19:17:15'),
(6, 1, 'Taxi', 'custo', NULL, NULL, '0.00', 'unidade', 0, 5, 0, 1, '2026-08-19 19:43:58', '2026-08-19 19:43:58'),
(7, 1, 'Caixa de A4', 'custo', NULL, NULL, '0.00', 'unidade', 15, 5, 0, 1, '2026-08-19 19:43:58', '2026-08-22 19:17:15'),
(9, 2, 'Flyers', 'servico', 'Flyers coloridos para campanhas, eventos e promoções.', '1500.00', NULL, 'serviço', 0, 0, 1, 1, '2026-08-19 19:43:58', '2026-08-20 17:45:05'),
(10, 2, 'Banners', 'servico', 'Banners impressos com acabamento profissional para divulgação.', '18000.00', NULL, 'serviço', 0, 0, 1, 1, '2026-08-19 19:43:58', '2026-08-20 17:45:05'),
(12, 2, 'Cartão de Visita', 'servico', 'Cartões de visita personalizados para fortalecer a sua marca.', '8500.00', NULL, 'serviço', 0, 0, 1, 1, '2026-08-19 19:43:58', '2026-08-20 17:45:05'),
(21, 3, 'Encadernação', 'servico', 'Encadernação resistente para trabalhos, relatórios e documentos.', '2500.00', NULL, 'serviço', 0, 0, 1, 1, '2026-08-19 19:43:58', '2026-08-20 17:45:05'),
(22, 4, 'T-shirts', 'servico', 'Estampagem personalizada em t-shirts para equipas e eventos.', '12000.00', NULL, 'serviço', 0, 0, 1, 1, '2026-08-19 19:43:58', '2026-08-20 17:45:05'),
(23, 4, 'Chapéus', 'servico', NULL, '0.00', NULL, 'serviço', 0, 0, 0, 1, '2026-08-19 19:43:58', '2026-08-19 19:43:58');

-- --------------------------------------------------------

--
-- Table structure for table `item_images`
--

CREATE TABLE `item_images` (
  `id` bigint UNSIGNED NOT NULL,
  `imageable_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `imageable_id` bigint UNSIGNED NOT NULL,
  `caminho` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `legenda` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `principal` tinyint(1) NOT NULL DEFAULT '0',
  `ordem` int UNSIGNED NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `item_images`
--

INSERT INTO `item_images` (`id`, `imageable_type`, `imageable_id`, `caminho`, `legenda`, `principal`, `ordem`, `created_at`, `updated_at`) VALUES
(15, 'App\\Models\\Item', 7, 'itens/DTrXBLZmfXguf4sZ0qYDdUBC19tBVa12GDyBZtiv.jpg', NULL, 1, 1, '2026-08-22 19:33:09', '2026-08-22 19:33:09'),
(16, 'App\\Models\\Item', 23, 'itens/kbBCyOZgDHDjo11eilLw1Bc0ppZRPovH7AEd7fTb.jpg', NULL, 1, 1, '2026-08-22 19:35:57', '2026-08-22 19:35:57'),
(17, 'App\\Models\\Item', 9, 'config/demo-flyers-1683e6.svg', 'Foto demonstrativa do serviço', 1, 1, '2026-09-03 20:11:05', '2026-09-03 20:11:05'),
(18, 'App\\Models\\Item', 9, 'config/demo-flyers-50b77a.svg', 'Foto demonstrativa do serviço', 0, 2, '2026-09-03 20:11:05', '2026-09-03 20:11:05'),
(19, 'App\\Models\\Item', 10, 'config/demo-banners-0b5fb3.svg', 'Foto demonstrativa do serviço', 1, 1, '2026-09-03 20:11:05', '2026-09-03 20:11:05'),
(20, 'App\\Models\\Item', 12, 'config/demo-cartao-de-visita-e5ad42.svg', 'Foto demonstrativa do serviço', 1, 1, '2026-09-03 20:11:05', '2026-09-03 20:11:05'),
(21, 'App\\Models\\Item', 21, 'config/demo-encadernacao-6cb9a1.svg', 'Foto demonstrativa do serviço', 1, 1, '2026-09-03 20:11:05', '2026-09-03 20:11:05'),
(22, 'App\\Models\\Item', 22, 'config/demo-t-shirts-7b61a8.svg', 'Foto demonstrativa do serviço', 1, 1, '2026-09-03 20:11:05', '2026-09-03 20:11:05'),
(23, 'App\\Models\\Item', 22, 'config/demo-t-shirts-d66b5d.svg', 'Foto demonstrativa do serviço', 0, 2, '2026-09-03 20:11:05', '2026-09-03 20:11:05'),
(24, 'App\\Models\\Item', 3, 'config/demo-capa-de-processo-64748b.svg', 'Foto demonstrativa do serviço', 1, 1, '2026-09-03 20:11:05', '2026-09-03 20:11:05');

-- --------------------------------------------------------

--
-- Table structure for table `jobs`
--

CREATE TABLE `jobs` (
  `id` bigint UNSIGNED NOT NULL,
  `queue` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `attempts` smallint UNSIGNED NOT NULL,
  `reserved_at` int UNSIGNED DEFAULT NULL,
  `available_at` int UNSIGNED NOT NULL,
  `created_at` int UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `job_batches`
--

CREATE TABLE `job_batches` (
  `id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `total_jobs` int NOT NULL,
  `pending_jobs` int NOT NULL,
  `failed_jobs` int NOT NULL,
  `failed_job_ids` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `options` mediumtext COLLATE utf8mb4_unicode_ci,
  `cancelled_at` int DEFAULT NULL,
  `created_at` int NOT NULL,
  `finished_at` int DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int UNSIGNED NOT NULL,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '0001_01_01_000000_create_users_table', 1),
(2, '0001_01_01_000001_create_cache_table', 1),
(3, '0001_01_01_000002_create_jobs_table', 1),
(4, '2025_01_01_000001_create_settings_table', 1),
(5, '2025_01_01_000002_create_categories_table', 1),
(6, '2025_01_01_000003_create_items_table', 1),
(7, '2025_01_01_000004_create_item_images_table', 1),
(8, '2025_01_01_000005_add_fields_to_users_table', 1),
(9, '2025_01_01_000006_create_employees_table', 1),
(10, '2025_01_01_000007_create_sales_table', 1),
(11, '2025_01_01_000008_create_sale_items_table', 1),
(12, '2025_01_01_000009_create_stock_movements_table', 1),
(13, '2025_01_01_000010_create_service_requests_table', 1),
(14, '2026_08_19_204124_create_permission_tables', 1),
(15, '2026_08_29_000001_create_expenses_table', 2),
(16, '2026_08_29_000002_add_foto_perfil_to_users_table', 2);

-- --------------------------------------------------------

--
-- Table structure for table `model_has_permissions`
--

CREATE TABLE `model_has_permissions` (
  `permission_id` bigint UNSIGNED NOT NULL,
  `model_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `model_id` bigint UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `model_has_roles`
--

CREATE TABLE `model_has_roles` (
  `role_id` bigint UNSIGNED NOT NULL,
  `model_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `model_id` bigint UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `model_has_roles`
--

INSERT INTO `model_has_roles` (`role_id`, `model_type`, `model_id`) VALUES
(1, 'App\\Models\\User', 1),
(2, 'App\\Models\\User', 2),
(3, 'App\\Models\\User', 3),
(3, 'App\\Models\\User', 4),
(4, 'App\\Models\\User', 5),
(4, 'App\\Models\\User', 6),
(4, 'App\\Models\\User', 7),
(4, 'App\\Models\\User', 8);

-- --------------------------------------------------------

--
-- Table structure for table `password_reset_tokens`
--

CREATE TABLE `password_reset_tokens` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `permissions`
--

CREATE TABLE `permissions` (
  `id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `guard_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `permissions`
--

INSERT INTO `permissions` (`id`, `name`, `guard_name`, `created_at`, `updated_at`) VALUES
(1, 'categorias.ver', 'web', '2026-08-19 19:43:58', '2026-08-19 19:43:58'),
(2, 'categorias.gerir', 'web', '2026-08-19 19:43:58', '2026-08-19 19:43:58'),
(3, 'itens.ver', 'web', '2026-08-19 19:43:58', '2026-08-19 19:43:58'),
(4, 'itens.gerir', 'web', '2026-08-19 19:43:58', '2026-08-19 19:43:58'),
(5, 'vendas.ver', 'web', '2026-08-19 19:43:58', '2026-08-19 19:43:58'),
(6, 'vendas.criar', 'web', '2026-08-19 19:43:58', '2026-08-19 19:43:58'),
(7, 'vendas.editar', 'web', '2026-08-19 19:43:58', '2026-08-19 19:43:58'),
(8, 'vendas.cancelar', 'web', '2026-08-19 19:43:58', '2026-08-19 19:43:58'),
(9, 'estoque.ver', 'web', '2026-08-19 19:43:58', '2026-08-19 19:43:58'),
(10, 'estoque.gerir', 'web', '2026-08-19 19:43:58', '2026-08-19 19:43:58'),
(11, 'funcionarios.ver', 'web', '2026-08-19 19:43:58', '2026-08-19 19:43:58'),
(12, 'funcionarios.gerir', 'web', '2026-08-19 19:43:58', '2026-08-19 19:43:58'),
(13, 'pedidos.ver', 'web', '2026-08-19 19:43:58', '2026-08-19 19:43:58'),
(14, 'pedidos.gerir', 'web', '2026-08-19 19:43:58', '2026-08-19 19:43:58'),
(15, 'relatorios.ver', 'web', '2026-08-19 19:43:58', '2026-08-19 19:43:58'),
(16, 'utilizadores.gerir', 'web', '2026-08-19 19:43:58', '2026-08-19 19:43:58'),
(17, 'configuracoes.gerir', 'web', '2026-08-19 19:43:58', '2026-08-19 19:43:58'),
(18, 'gastos.ver', 'web', '2026-08-29 13:23:01', '2026-08-29 13:23:01'),
(19, 'gastos.gerir', 'web', '2026-08-29 13:23:01', '2026-08-29 13:23:01');

-- --------------------------------------------------------

--
-- Table structure for table `roles`
--

CREATE TABLE `roles` (
  `id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `guard_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `roles`
--

INSERT INTO `roles` (`id`, `name`, `guard_name`, `created_at`, `updated_at`) VALUES
(1, 'admin', 'web', '2026-08-19 19:43:58', '2026-08-19 19:43:58'),
(2, 'gerente', 'web', '2026-08-19 19:43:58', '2026-08-19 19:43:58'),
(3, 'funcionario', 'web', '2026-08-19 19:43:58', '2026-08-19 19:43:58'),
(4, 'cliente', 'web', '2026-08-19 19:43:58', '2026-08-19 19:43:58');

-- --------------------------------------------------------

--
-- Table structure for table `role_has_permissions`
--

CREATE TABLE `role_has_permissions` (
  `permission_id` bigint UNSIGNED NOT NULL,
  `role_id` bigint UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `role_has_permissions`
--

INSERT INTO `role_has_permissions` (`permission_id`, `role_id`) VALUES
(1, 1),
(2, 1),
(3, 1),
(4, 1),
(5, 1),
(6, 1),
(7, 1),
(8, 1),
(9, 1),
(10, 1),
(11, 1),
(12, 1),
(13, 1),
(14, 1),
(15, 1),
(16, 1),
(17, 1),
(18, 1),
(19, 1),
(1, 2),
(2, 2),
(3, 2),
(4, 2),
(5, 2),
(6, 2),
(7, 2),
(8, 2),
(9, 2),
(10, 2),
(11, 2),
(12, 2),
(13, 2),
(14, 2),
(15, 2),
(18, 2),
(19, 2),
(1, 3),
(3, 3),
(5, 3),
(6, 3),
(9, 3),
(13, 3),
(18, 3),
(19, 3),
(3, 4),
(13, 4);

-- --------------------------------------------------------

--
-- Table structure for table `sales`
--

CREATE TABLE `sales` (
  `id` bigint UNSIGNED NOT NULL,
  `numero` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `vendedor_id` bigint UNSIGNED DEFAULT NULL,
  `cliente_id` bigint UNSIGNED DEFAULT NULL,
  `cliente_nome` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `cliente_telefone` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `total` decimal(12,2) NOT NULL DEFAULT '0.00',
  `desconto` decimal(12,2) NOT NULL DEFAULT '0.00',
  `total_pago` decimal(12,2) NOT NULL DEFAULT '0.00',
  `forma_pagamento` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'dinheiro',
  `origem` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'balcao',
  `status` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'pendente',
  `observacoes` text COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `sales`
--

INSERT INTO `sales` (`id`, `numero`, `vendedor_id`, `cliente_id`, `cliente_nome`, `cliente_telefone`, `total`, `desconto`, `total_pago`, `forma_pagamento`, `origem`, `status`, `observacoes`, `created_at`, `updated_at`) VALUES
(6, 'VD-2026-000101', 1, 5, 'Ana Joaquim', '+244 922 184 605', '4500.00', '0.00', '4500.00', 'transferencia', 'balcao', 'pago', 'Campanha de lançamento do novo espaço.', '2026-09-03 20:11:08', '2026-09-03 20:11:08'),
(7, 'VD-2026-000102', 3, 6, 'Bruno Martins', '+244 926 403 711', '17000.00', '0.00', '17000.00', 'multicaixa', 'balcao', 'entregue', 'Entrega confirmada no balcão.', '2026-09-03 20:11:08', '2026-09-03 20:11:08'),
(8, 'VD-2026-000103', 1, NULL, 'Mar Azul Eventos', '+244 923 870 144', '36000.00', '0.00', '0.00', 'dinheiro', 'balcao', 'pendente', 'Aguardar levantamento.', '2026-09-03 20:11:08', '2026-09-03 20:11:08'),
(9, 'VD-2026-000104', 3, 8, 'Joana Mateus', '+244 925 229 830', '10000.00', '0.00', '0.00', 'dinheiro', 'balcao', 'cancelado', 'Cancelada a pedido da cliente.', '2026-09-03 20:11:08', '2026-09-03 20:11:08');

-- --------------------------------------------------------

--
-- Table structure for table `sale_items`
--

CREATE TABLE `sale_items` (
  `id` bigint UNSIGNED NOT NULL,
  `sale_id` bigint UNSIGNED NOT NULL,
  `item_id` bigint UNSIGNED NOT NULL,
  `item_nome` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `quantidade` int NOT NULL DEFAULT '1',
  `preco_unitario` decimal(12,2) NOT NULL,
  `subtotal` decimal(12,2) NOT NULL,
  `detalhes` text COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `sale_items`
--

INSERT INTO `sale_items` (`id`, `sale_id`, `item_id`, `item_nome`, `quantidade`, `preco_unitario`, `subtotal`, `detalhes`, `created_at`, `updated_at`) VALUES
(6, 6, 9, 'Flyers', 3, '1500.00', '4500.00', 'Formato A5, frente e verso, papel couché 150g', '2026-09-03 20:11:08', '2026-09-03 20:11:08'),
(7, 7, 12, 'Cartão de Visita', 2, '8500.00', '17000.00', '500 unidades por lote, acabamento mate', '2026-09-03 20:11:08', '2026-09-03 20:11:08'),
(8, 8, 10, 'Banners', 2, '18000.00', '36000.00', 'Lona 80x120 cm com acabamento em ilhós', '2026-09-03 20:11:08', '2026-09-03 20:11:08'),
(9, 9, 21, 'Encadernação', 4, '2500.00', '10000.00', 'Capa transparente e espiral preta', '2026-09-03 20:11:08', '2026-09-03 20:11:08');

-- --------------------------------------------------------

--
-- Table structure for table `service_requests`
--

CREATE TABLE `service_requests` (
  `id` bigint UNSIGNED NOT NULL,
  `cliente_id` bigint UNSIGNED DEFAULT NULL,
  `cliente_nome` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `cliente_telefone` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `cliente_email` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `item_id` bigint UNSIGNED NOT NULL,
  `descricao` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'novo',
  `sale_id` bigint UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `service_requests`
--

INSERT INTO `service_requests` (`id`, `cliente_id`, `cliente_nome`, `cliente_telefone`, `cliente_email`, `item_id`, `descricao`, `status`, `sale_id`, `created_at`, `updated_at`) VALUES
(6, 7, 'Mar Azul Eventos', '+244 923 870 144', 'eventos@marazul.co.ao', 10, 'Precisamos de 3 banners para um evento corporativo, tamanho 80x120 cm, com entrega até sexta-feira.', 'aprovado', NULL, '2026-09-03 20:11:08', '2026-09-03 20:11:08'),
(7, 5, 'Ana Joaquim', '+244 922 184 605', 'ana.comercial@kumbalastudio.co.ao', 9, 'Flyers A5 para promoção de inauguração. Gostaríamos de receber uma sugestão de acabamento e prazo.', 'em_analise', NULL, '2026-09-03 20:11:09', '2026-09-03 20:11:09'),
(8, 6, 'Bruno Martins', '+244 926 403 711', 'bruno.martins@novaconta.co.ao', 12, 'Cartões frente e verso, 500 unidades, papel mate. O ficheiro final será enviado por e-mail.', 'convertido', 7, '2026-09-03 20:11:09', '2026-09-03 20:11:09'),
(9, 8, 'Joana Mateus', '+244 925 229 830', 'joana.mateus@gmail.com', 22, 'Orçamento para 12 t-shirts brancas com estampagem frontal para uma equipa de voluntários.', 'novo', NULL, '2026-09-03 20:11:09', '2026-09-03 20:11:09'),
(10, 7, 'Mar Azul Eventos', '+244 923 870 144', 'eventos@marazul.co.ao', 21, 'Pedido de encadernação de 6 relatórios com capa dura e lombada personalizada.', 'rejeitado', NULL, '2026-09-03 20:11:09', '2026-09-03 20:11:09');

-- --------------------------------------------------------

--
-- Table structure for table `sessions`
--

CREATE TABLE `sessions` (
  `id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` bigint UNSIGNED DEFAULT NULL,
  `ip_address` varchar(45) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `user_agent` text COLLATE utf8mb4_unicode_ci,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `last_activity` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `sessions`
--

INSERT INTO `sessions` (`id`, `user_id`, `ip_address`, `user_agent`, `payload`, `last_activity`) VALUES
('1tZfLs4LHUfh2Oadmi99XBC6BGzor5OGP91ilzCq', NULL, '2c0f:f888:a980:6b1e:38d3:f388:9c26:95ba', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/151.0.0.0 Safari/537.36', 'eyJfdG9rZW4iOiJmWFEzUDlOcnBCTWpNbW9UTU9uWjBjYTdlN3JvcWk3S2xDSVYzTTRFIiwiX3ByZXZpb3VzIjp7InVybCI6Imh0dHBzOlwvXC9tYWluLWxpZC1ndWlkZS1wdXNoLnRyeWNsb3VkZmxhcmUuY29tIiwicm91dGUiOiJob21lIn0sIl9mbGFzaCI6eyJvbGQiOltdLCJuZXciOltdfX0=', 1788033409),
('90sPOvNyiTWg4EgJtl21Nfybc8Tbhf59OjsFH1VM', NULL, '142.250.32.42', 'Mozilla/5.0 (Linux; Android 10; K) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/138.0.0.0 Mobile Safari/537.36 (compatible; Google-Read-Aloud; +https://support.google.com/webmasters/answer/1061943)', 'eyJfdG9rZW4iOiJsUjR4M3lGSXQ3b0NaZkN0OFFMc25DRDFabGlJQnQ0U3g5N3hMOE5oIiwiX3ByZXZpb3VzIjp7InVybCI6Imh0dHBzOlwvXC9tYWluLWxpZC1ndWlkZS1wdXNoLnRyeWNsb3VkZmxhcmUuY29tXC9sb2dpbiIsInJvdXRlIjoibG9naW4ifSwiX2ZsYXNoIjp7Im9sZCI6W10sIm5ldyI6W119fQ==', 1788037444),
('cMqNBJLwOAIB8tj32iIBCWXJAeBC3cEgr04lv8UO', NULL, '74.125.208.74', 'Mozilla/5.0 (Linux; Android 10; K) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/138.0.0.0 Mobile Safari/537.36 (compatible; Google-Read-Aloud; +https://support.google.com/webmasters/answer/1061943)', 'eyJfdG9rZW4iOiJza01VWmF1dE5iWWhhSXhOS1pob0g4NVVIQWp6MjdYMmNvSE0wTDIxIiwidXJsIjp7ImludGVuZGVkIjoiaHR0cHM6XC9cL21haW4tbGlkLWd1aWRlLXB1c2gudHJ5Y2xvdWRmbGFyZS5jb21cL2FkbWluXC9yZWxhdG9yaW9zIn0sIl9wcmV2aW91cyI6eyJ1cmwiOiJodHRwczpcL1wvbWFpbi1saWQtZ3VpZGUtcHVzaC50cnljbG91ZGZsYXJlLmNvbVwvYWRtaW5cL3JlbGF0b3Jpb3MiLCJyb3V0ZSI6ImFkbWluLnJlbGF0b3Jpb3MuaW5kZXgifSwiX2ZsYXNoIjp7Im9sZCI6W10sIm5ldyI6W119fQ==', 1788037845),
('FK41bk6e8AyXfs8MBrAuHga4JFyXC1XOXfUaM39G', 1, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/152.0.0.0 Safari/537.36', 'eyJfdG9rZW4iOiJBcDI0VGJkb3NJRUpjUXM2amlhUHhOOXBwa2ZoQWk1RXQ4N0ZjYlphIiwiX3ByZXZpb3VzIjp7InVybCI6Imh0dHA6XC9cLzEyNy4wLjAuMTo4MDAwXC9hZG1pbiIsInJvdXRlIjoiYWRtaW4uZGFzaGJvYXJkIn0sIl9mbGFzaCI6eyJvbGQiOltdLCJuZXciOltdfSwibG9naW5fd2ViXzU5YmEzNmFkZGMyYjJmOTQwMTU4MGYwMTRjN2Y1OGVhNGUzMDk4OWQiOjF9', 1788455979),
('Jef5whfnsziMIQZKE5PhgistfwFEs9qnp5RvoUuE', NULL, '2c0f:f888:a980:6b1e:178c:9d17:e0b8:9816', 'Mozilla/5.0 (Linux; Android 10; K) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/151.0.0.0 Mobile Safari/537.36', 'eyJfdG9rZW4iOiJCQm90OHljbTNjNFdWRlNnc3c0d21nZG9LMDFiT0ZIZGJ3S0pZNkd6IiwiX3ByZXZpb3VzIjp7InVybCI6Imh0dHBzOlwvXC9tYWluLWxpZC1ndWlkZS1wdXNoLnRyeWNsb3VkZmxhcmUuY29tIiwicm91dGUiOiJob21lIn0sIl9mbGFzaCI6eyJvbGQiOltdLCJuZXciOltdfX0=', 1788037556),
('jqeCn6LWH6gPDIqF85hkZI4xRm6TFdZoEclWbh0X', NULL, '74.125.208.74', 'Mozilla/5.0 (Linux; Android 10; K) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/138.0.0.0 Mobile Safari/537.36 (compatible; Google-Read-Aloud; +https://support.google.com/webmasters/answer/1061943)', 'eyJfdG9rZW4iOiJDR05hTEJjN09jOE9nSTlWanFPWFoyTXhUMmlpQVN5akxxYUlWTDh4IiwiX3ByZXZpb3VzIjp7InVybCI6Imh0dHBzOlwvXC9tYWluLWxpZC1ndWlkZS1wdXNoLnRyeWNsb3VkZmxhcmUuY29tXC9sb2dpbiIsInJvdXRlIjoibG9naW4ifSwiX2ZsYXNoIjp7Im9sZCI6W10sIm5ldyI6W119fQ==', 1788037845),
('PWkRurgJKLzrCQGFFMRRWj2OgU0qWjVx65i05viQ', 1, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/152.0.0.0 Safari/537.36', 'eyJfdG9rZW4iOiJnN1FvdldtU3hpbmFjOUxVOE1DQlZYQXV1SEpoTHBhQlJWTGwzNTZYIiwidXJsIjpbXSwiX3ByZXZpb3VzIjp7InVybCI6Imh0dHA6XC9cLzEyNy4wLjAuMTo4MDAwXC9hZG1pblwvY2F0ZWdvcmlhcyIsInJvdXRlIjoiYWRtaW4uY2F0ZWdvcmlhcy5pbmRleCJ9LCJfZmxhc2giOnsib2xkIjpbXSwibmV3IjpbXX0sImxvZ2luX3dlYl81OWJhMzZhZGRjMmIyZjk0MDE1ODBmMDE0YzdmNThlYTRlMzA5ODlkIjoxfQ==', 1788470126),
('qQn2Tb1wSoUhxk8qik7PEKDWai9WJZ0CnydTH7qF', NULL, '142.250.32.41', 'Mozilla/5.0 (Linux; Android 10; K) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/138.0.0.0 Mobile Safari/537.36 (compatible; Google-Read-Aloud; +https://support.google.com/webmasters/answer/1061943)', 'eyJfdG9rZW4iOiJVQ0YxU0VuQzFWMjhabW8xYm9UQ3VuQlUxZXg4ZjE2WEFidG8zbk1uIiwidXJsIjp7ImludGVuZGVkIjoiaHR0cHM6XC9cL21haW4tbGlkLWd1aWRlLXB1c2gudHJ5Y2xvdWRmbGFyZS5jb21cL2FkbWluIn0sIl9wcmV2aW91cyI6eyJ1cmwiOiJodHRwczpcL1wvbWFpbi1saWQtZ3VpZGUtcHVzaC50cnljbG91ZGZsYXJlLmNvbVwvYWRtaW4iLCJyb3V0ZSI6ImFkbWluLmRhc2hib2FyZCJ9LCJfZmxhc2giOnsib2xkIjpbXSwibmV3IjpbXX19', 1788037443),
('rIqadxblvwu9nywkzSN5TvBk0h61bGu57MtXcNMe', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Microsoft Windows 10.0.26200; pt-PT) PowerShell/7.6.5', 'eyJfdG9rZW4iOiJkMjhobzY5U0JIaUtyOUt3Y1JEMzlpRHI4b0k5YmRTUUJTazZoV1BKIiwiX3ByZXZpb3VzIjp7InVybCI6Imh0dHA6XC9cLzEyNy4wLjAuMTo4MDAwIiwicm91dGUiOiJob21lIn0sIl9mbGFzaCI6eyJvbGQiOltdLCJuZXciOltdfX0=', 1788032702),
('x1HHEYF1rFr6m1oPM9vwvAZrOjDBe6IzHcB8honu', 1, '102.214.36.199', 'Mozilla/5.0 (Linux; Android 10; K) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/150.0.0.0 Mobile Safari/537.36', 'eyJfdG9rZW4iOiJMS2pncTBKWUt4MGdmQTFFRVpkckdYZDhhZXFKdkRQN2FhWWxMWFhOIiwiX3ByZXZpb3VzIjp7InVybCI6Imh0dHBzOlwvXC9tYWluLWxpZC1ndWlkZS1wdXNoLnRyeWNsb3VkZmxhcmUuY29tXC9hZG1pblwvdmVuZGFzXC9jcmVhdGUiLCJyb3V0ZSI6ImFkbWluLnZlbmRhcy5jcmVhdGUifSwiX2ZsYXNoIjp7Im9sZCI6W10sIm5ldyI6W119LCJsb2dpbl93ZWJfNTliYTM2YWRkYzJiMmY5NDAxNTgwZjAxNGM3ZjU4ZWE0ZTMwOTg5ZCI6MX0=', 1788038253);

-- --------------------------------------------------------

--
-- Table structure for table `settings`
--

CREATE TABLE `settings` (
  `id` bigint UNSIGNED NOT NULL,
  `chave` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `valor` text COLLATE utf8mb4_unicode_ci,
  `tipo` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'texto',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `settings`
--

INSERT INTO `settings` (`id`, `chave`, `valor`, `tipo`, `created_at`, `updated_at`) VALUES
(1, 'grafica_nome', 'Gráfica Yuri', 'texto', '2026-08-19 19:43:58', '2026-08-22 19:17:09'),
(2, 'grafica_telefone', '', 'texto', '2026-08-19 19:43:58', '2026-08-22 19:17:09'),
(3, 'grafica_email', '', 'texto', '2026-08-19 19:43:58', '2026-08-19 19:43:58'),
(4, 'grafica_endereco', '', 'texto', '2026-08-19 19:43:58', '2026-08-19 19:43:58'),
(5, 'grafica_logo', 'config/6O7cla7bdlE366sniOh7FFIBZvmPMw5yoYJCPnrZ.jpg', 'imagem', '2026-08-19 19:43:58', '2026-08-22 19:40:21'),
(6, 'site_publico_ativo', '1', 'boolean', '2026-08-19 19:43:58', '2026-08-20 17:49:26');

-- --------------------------------------------------------

--
-- Table structure for table `stock_movements`
--

CREATE TABLE `stock_movements` (
  `id` bigint UNSIGNED NOT NULL,
  `item_id` bigint UNSIGNED NOT NULL,
  `user_id` bigint UNSIGNED DEFAULT NULL,
  `tipo` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `quantidade` int NOT NULL,
  `custo_unitario` decimal(12,2) DEFAULT NULL,
  `motivo` text COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `stock_movements`
--

INSERT INTO `stock_movements` (`id`, `item_id`, `user_id`, `tipo`, `quantidade`, `custo_unitario`, `motivo`, `created_at`, `updated_at`) VALUES
(1, 1, 3, 'entrada', 18, '4200.00', 'Compra de reposição - Fornecedor PrintMais', '2026-08-22 19:17:15', '2026-08-22 19:17:15'),
(2, 2, 3, 'entrada', 12, '3500.00', 'Compra de reposição - Fornecedor PrintMais', '2026-08-22 19:17:15', '2026-08-22 19:17:15'),
(3, 4, 3, 'entrada', 40, '850.00', 'Entrada de material para acabamento', '2026-08-22 19:17:15', '2026-08-22 19:17:15'),
(4, 5, 3, 'entrada', 120, '180.00', 'Compra de consumíveis para expedição', '2026-08-22 19:17:15', '2026-08-22 19:17:15'),
(5, 7, 3, 'entrada', 15, '9800.00', 'Compra de papel A4 - Papelaria Central', '2026-08-22 19:17:15', '2026-08-22 19:17:15');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `telefone` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `nif` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `ativo` tinyint(1) NOT NULL DEFAULT '1',
  `foto_perfil` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `telefone`, `nif`, `ativo`, `foto_perfil`, `email_verified_at`, `password`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'Administrador', 'admin@graficayuri.local', NULL, NULL, 1, NULL, NULL, '$2y$12$hxWKKbKn9mnLtkqug3jl4ua5KQQtjvGG..MSw6xPKT0DSDKKrpKRG', 'QVcp1AQiuQMAfwm4M83DoQokwj6fboZ4K8KxGkvTxnhjFhwIJ5YufSNnzN8k', '2026-08-19 19:43:58', '2026-08-19 19:43:58'),
(2, 'Carla Mendes', 'gerente@graficayuri.local', '+244 923 410 228', NULL, 1, NULL, '2026-08-22 19:17:12', '$2y$12$CI4XYXr/8fUxQRSCV2JkZ.7UgMIJnALSTittaypVt2SmOWs8c5KuC', NULL, '2026-08-22 19:17:12', '2026-08-22 19:17:12'),
(3, 'Mateus Silva', 'operador@graficayuri.local', '+244 924 735 106', NULL, 1, NULL, '2026-08-22 19:17:12', '$2y$12$BWAZXDSmjIw3UMBpDJyMCuevfHrIkdNt/FiVhpP1/gQVeiHsDb2yu', NULL, '2026-08-22 19:17:12', '2026-08-22 19:17:12'),
(4, 'Nadia Paulo', 'designer@graficayuri.local', '+244 925 612 480', NULL, 1, NULL, '2026-08-22 19:17:13', '$2y$12$p9Sr7HaflXhBEkFkZLyE.ugV5/wLAQEQPxqzrIqGJI/AaBG19U3c.', NULL, '2026-08-22 19:17:13', '2026-08-22 19:17:13'),
(5, 'Ana Joaquim', 'ana.comercial@kumbalastudio.co.ao', '+244 922 184 605', '5417283901', 1, NULL, '2026-08-22 19:17:13', '$2y$12$ChmC.x56FLpNVYkDo5vPNeeJ5QgfLVvEEXeEXR884rODoJLQwgQ8O', NULL, '2026-08-22 19:17:13', '2026-08-22 19:17:13'),
(6, 'Bruno Martins', 'bruno.martins@novaconta.co.ao', '+244 926 403 711', '5419362087', 1, NULL, '2026-08-22 19:17:14', '$2y$12$xCDcy6OXHHzQtyqTijMT0.tngXpaMAfNaA2Ec3C5tcJHO8IgGQ9zG', NULL, '2026-08-22 19:17:14', '2026-08-22 19:17:14'),
(7, 'Mar Azul Eventos', 'eventos@marazul.co.ao', '+244 923 870 144', '5415076219', 1, NULL, '2026-08-22 19:17:14', '$2y$12$2H.L2QnOnVduExcQPBjzHefyJHsALSxPEQrkZT3YtUaAGo9FE2KJi', NULL, '2026-08-22 19:17:14', '2026-08-22 19:17:14'),
(8, 'Joana Mateus', 'joana.mateus@gmail.com', '+244 925 229 830', NULL, 1, NULL, '2026-08-22 19:17:15', '$2y$12$uxCj6SCYq4zJeSknA0k0We1WdZWgGTPXU1Mq1NgAifz3sbvbHUDQO', NULL, '2026-08-22 19:17:15', '2026-08-22 19:17:15');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `cache`
--
ALTER TABLE `cache`
  ADD PRIMARY KEY (`key`),
  ADD KEY `cache_expiration_index` (`expiration`);

--
-- Indexes for table `cache_locks`
--
ALTER TABLE `cache_locks`
  ADD PRIMARY KEY (`key`),
  ADD KEY `cache_locks_expiration_index` (`expiration`);

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `categories_slug_unique` (`slug`),
  ADD KEY `categories_grupo_index` (`grupo`);

--
-- Indexes for table `employees`
--
ALTER TABLE `employees`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `employees_user_id_unique` (`user_id`);

--
-- Indexes for table `expenses`
--
ALTER TABLE `expenses`
  ADD PRIMARY KEY (`id`),
  ADD KEY `expenses_user_id_foreign` (`user_id`);

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`),
  ADD KEY `failed_jobs_connection_queue_failed_at_index` (`connection`,`queue`,`failed_at`);

--
-- Indexes for table `items`
--
ALTER TABLE `items`
  ADD PRIMARY KEY (`id`),
  ADD KEY `items_category_id_foreign` (`category_id`),
  ADD KEY `items_tipo_ativo_index` (`tipo`,`ativo`);

--
-- Indexes for table `item_images`
--
ALTER TABLE `item_images`
  ADD PRIMARY KEY (`id`),
  ADD KEY `item_images_imageable_type_imageable_id_index` (`imageable_type`,`imageable_id`);

--
-- Indexes for table `jobs`
--
ALTER TABLE `jobs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `jobs_queue_index` (`queue`);

--
-- Indexes for table `job_batches`
--
ALTER TABLE `job_batches`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `model_has_permissions`
--
ALTER TABLE `model_has_permissions`
  ADD PRIMARY KEY (`permission_id`,`model_id`,`model_type`),
  ADD KEY `model_has_permissions_model_id_model_type_index` (`model_id`,`model_type`);

--
-- Indexes for table `model_has_roles`
--
ALTER TABLE `model_has_roles`
  ADD PRIMARY KEY (`role_id`,`model_id`,`model_type`),
  ADD KEY `model_has_roles_model_id_model_type_index` (`model_id`,`model_type`);

--
-- Indexes for table `password_reset_tokens`
--
ALTER TABLE `password_reset_tokens`
  ADD PRIMARY KEY (`email`);

--
-- Indexes for table `permissions`
--
ALTER TABLE `permissions`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `permissions_name_guard_name_unique` (`name`,`guard_name`);

--
-- Indexes for table `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `roles_name_guard_name_unique` (`name`,`guard_name`);

--
-- Indexes for table `role_has_permissions`
--
ALTER TABLE `role_has_permissions`
  ADD PRIMARY KEY (`permission_id`,`role_id`),
  ADD KEY `role_has_permissions_role_id_foreign` (`role_id`);

--
-- Indexes for table `sales`
--
ALTER TABLE `sales`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `sales_numero_unique` (`numero`),
  ADD KEY `sales_vendedor_id_foreign` (`vendedor_id`),
  ADD KEY `sales_cliente_id_foreign` (`cliente_id`),
  ADD KEY `sales_status_origem_index` (`status`,`origem`);

--
-- Indexes for table `sale_items`
--
ALTER TABLE `sale_items`
  ADD PRIMARY KEY (`id`),
  ADD KEY `sale_items_sale_id_foreign` (`sale_id`),
  ADD KEY `sale_items_item_id_foreign` (`item_id`);

--
-- Indexes for table `service_requests`
--
ALTER TABLE `service_requests`
  ADD PRIMARY KEY (`id`),
  ADD KEY `service_requests_cliente_id_foreign` (`cliente_id`),
  ADD KEY `service_requests_item_id_foreign` (`item_id`),
  ADD KEY `service_requests_sale_id_foreign` (`sale_id`);

--
-- Indexes for table `sessions`
--
ALTER TABLE `sessions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `sessions_user_id_index` (`user_id`),
  ADD KEY `sessions_last_activity_index` (`last_activity`);

--
-- Indexes for table `settings`
--
ALTER TABLE `settings`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `settings_chave_unique` (`chave`);

--
-- Indexes for table `stock_movements`
--
ALTER TABLE `stock_movements`
  ADD PRIMARY KEY (`id`),
  ADD KEY `stock_movements_item_id_foreign` (`item_id`),
  ADD KEY `stock_movements_user_id_foreign` (`user_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `employees`
--
ALTER TABLE `employees`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `expenses`
--
ALTER TABLE `expenses`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `items`
--
ALTER TABLE `items`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT for table `item_images`
--
ALTER TABLE `item_images`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT for table `jobs`
--
ALTER TABLE `jobs`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `permissions`
--
ALTER TABLE `permissions`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `roles`
--
ALTER TABLE `roles`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `sales`
--
ALTER TABLE `sales`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `sale_items`
--
ALTER TABLE `sale_items`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `service_requests`
--
ALTER TABLE `service_requests`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `settings`
--
ALTER TABLE `settings`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `stock_movements`
--
ALTER TABLE `stock_movements`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `employees`
--
ALTER TABLE `employees`
  ADD CONSTRAINT `employees_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `expenses`
--
ALTER TABLE `expenses`
  ADD CONSTRAINT `expenses_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `items`
--
ALTER TABLE `items`
  ADD CONSTRAINT `items_category_id_foreign` FOREIGN KEY (`category_id`) REFERENCES `categories` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `model_has_permissions`
--
ALTER TABLE `model_has_permissions`
  ADD CONSTRAINT `model_has_permissions_permission_id_foreign` FOREIGN KEY (`permission_id`) REFERENCES `permissions` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `model_has_roles`
--
ALTER TABLE `model_has_roles`
  ADD CONSTRAINT `model_has_roles_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `role_has_permissions`
--
ALTER TABLE `role_has_permissions`
  ADD CONSTRAINT `role_has_permissions_permission_id_foreign` FOREIGN KEY (`permission_id`) REFERENCES `permissions` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `role_has_permissions_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `sales`
--
ALTER TABLE `sales`
  ADD CONSTRAINT `sales_cliente_id_foreign` FOREIGN KEY (`cliente_id`) REFERENCES `users` (`id`) ON DELETE SET NULL,
  ADD CONSTRAINT `sales_vendedor_id_foreign` FOREIGN KEY (`vendedor_id`) REFERENCES `users` (`id`) ON DELETE SET NULL;

--
-- Constraints for table `sale_items`
--
ALTER TABLE `sale_items`
  ADD CONSTRAINT `sale_items_item_id_foreign` FOREIGN KEY (`item_id`) REFERENCES `items` (`id`) ON DELETE RESTRICT,
  ADD CONSTRAINT `sale_items_sale_id_foreign` FOREIGN KEY (`sale_id`) REFERENCES `sales` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `service_requests`
--
ALTER TABLE `service_requests`
  ADD CONSTRAINT `service_requests_cliente_id_foreign` FOREIGN KEY (`cliente_id`) REFERENCES `users` (`id`) ON DELETE SET NULL,
  ADD CONSTRAINT `service_requests_item_id_foreign` FOREIGN KEY (`item_id`) REFERENCES `items` (`id`),
  ADD CONSTRAINT `service_requests_sale_id_foreign` FOREIGN KEY (`sale_id`) REFERENCES `sales` (`id`) ON DELETE SET NULL;

--
-- Constraints for table `stock_movements`
--
ALTER TABLE `stock_movements`
  ADD CONSTRAINT `stock_movements_item_id_foreign` FOREIGN KEY (`item_id`) REFERENCES `items` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `stock_movements_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE SET NULL;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
