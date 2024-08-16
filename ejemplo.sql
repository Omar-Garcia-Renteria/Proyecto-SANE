-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 16-08-2024 a las 21:39:08
-- Versión del servidor: 10.4.32-MariaDB
-- Versión de PHP: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `ejemplo`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `categories`
--

CREATE TABLE `categories` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `citas`
--

CREATE TABLE `citas` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `cliente` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `datos`
--

CREATE TABLE `datos` (
  `curp` varchar(18) DEFAULT NULL,
  `folio` int(11) DEFAULT NULL,
  `nombre` varchar(100) DEFAULT NULL,
  `prim_apell` varchar(100) DEFAULT NULL,
  `segu_apell` varchar(100) DEFAULT NULL,
  `id_ent` int(11) DEFAULT NULL,
  `entidad` varchar(100) DEFAULT NULL,
  `sost` varchar(50) DEFAULT NULL,
  `clv_sost` varchar(50) DEFAULT NULL,
  `funcion` varchar(100) DEFAULT NULL,
  `clv_nivel` varchar(50) DEFAULT NULL,
  `nivel` varchar(100) DEFAULT NULL,
  `valoracion` decimal(5,2) DEFAULT NULL,
  `clv_val` varchar(50) DEFAULT NULL,
  `clv_ica` varchar(50) DEFAULT NULL,
  `p_fp` decimal(5,2) DEFAULT NULL,
  `p_a` decimal(5,2) DEFAULT NULL,
  `p_e` decimal(5,2) DEFAULT NULL,
  `p_rbd` decimal(5,2) DEFAULT NULL,
  `p_ica` decimal(5,2) DEFAULT NULL,
  `clv_nivel_unificado` varchar(50) DEFAULT NULL,
  `clv_val_unificado` varchar(50) DEFAULT NULL,
  `clv_sost_unificado` varchar(50) DEFAULT NULL,
  `p_final` decimal(5,2) DEFAULT NULL,
  `clv_orden` varchar(50) DEFAULT NULL,
  `nivel_unificado` varchar(100) DEFAULT NULL,
  `valoracion_unificada` decimal(5,2) DEFAULT NULL,
  `sost_unificado` varchar(50) DEFAULT NULL,
  `pos_orden` int(11) DEFAULT NULL,
  `formato` varchar(50) DEFAULT NULL,
  `obtuvo_definitiva` varchar(100) DEFAULT NULL,
  `plaza_antecedente` varchar(100) DEFAULT NULL,
  `incentivo_atp` varchar(100) DEFAULT NULL,
  `incentivo_pfi` varchar(100) DEFAULT NULL,
  `incentivo_carrera` varchar(100) DEFAULT NULL,
  `incentivo_horizontal` varchar(100) DEFAULT NULL,
  `no_susceptible_asignacion` varchar(100) DEFAULT NULL,
  `numero_telefonico1` varchar(15) DEFAULT NULL,
  `numero_telefonico2` varchar(15) DEFAULT NULL,
  `correo_electronico1` varchar(100) DEFAULT NULL,
  `correo_electronico2` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `datos`
--

INSERT INTO `datos` (`curp`, `folio`, `nombre`, `prim_apell`, `segu_apell`, `id_ent`, `entidad`, `sost`, `clv_sost`, `funcion`, `clv_nivel`, `nivel`, `valoracion`, `clv_val`, `clv_ica`, `p_fp`, `p_a`, `p_e`, `p_rbd`, `p_ica`, `clv_nivel_unificado`, `clv_val_unificado`, `clv_sost_unificado`, `p_final`, `clv_orden`, `nivel_unificado`, `valoracion_unificada`, `sost_unificado`, `pos_orden`, `formato`, `obtuvo_definitiva`, `plaza_antecedente`, `incentivo_atp`, `incentivo_pfi`, `incentivo_carrera`, `incentivo_horizontal`, `no_susceptible_asignacion`, `numero_telefonico1`, `numero_telefonico2`, `correo_electronico1`, `correo_electronico2`) VALUES
('GARO020603HZSRNMA0', 1, 'omar', 'garcia', 'renteria', 1, 'ejemplo', 'ejemplo', 'ejemplo', 'ejemplo', 'ejemplo', 'ejemplo', 1.10, 'ejemplo', 'ejemplo', 1.00, 1.00, 1.00, 1.00, 1.00, 'ejemplo', 'ejemplo', 'ejemplo', 1.10, 'ejemplo', 'ejemplo', 1.10, 'ejemplo', 1, 'ejemplo', 'ejemplo', 'ejemplo', 'ejemplo', 'ejemplo', 'ejemplo', 'ejemplo', 'ejemplo', '4922459429', NULL, 'omar@gmail.com', NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `escuelas`
--

CREATE TABLE `escuelas` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `uuid` varchar(255) NOT NULL,
  `connection` text NOT NULL,
  `queue` text NOT NULL,
  `payload` longtext NOT NULL,
  `exception` longtext NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `imported_files`
--

CREATE TABLE `imported_files` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `file_name` varchar(255) NOT NULL,
  `file_path` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `imported_files`
--

INSERT INTO `imported_files` (`id`, `file_name`, `file_path`, `created_at`, `updated_at`) VALUES
(80, '1719464454_ejemplooo.csv', 'uploads/1719464454_ejemplooo.csv', '2024-06-27 11:00:54', '2024-06-27 11:00:54'),
(93, 'SANE.csv', 'uploads/SANE.csv', '2024-07-04 20:24:15', '2024-07-04 20:24:15'),
(217, 'hkgutftkhll,xfhhjkl.csv', 'uploads/hkgutftkhll,xfhhjkl.csv', '2024-08-15 01:16:41', '2024-08-15 01:16:41');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2014_10_12_000000_create_users_table', 1),
(2, '2014_10_12_100000_create_password_resets_table', 1),
(3, '2019_08_19_000000_create_failed_jobs_table', 1),
(4, '2019_12_14_000001_create_personal_access_tokens_table', 1),
(5, '2023_02_20_012048_create_todos_table', 1),
(6, '2023_02_23_162416_create_citas_table', 1),
(7, '2023_03_23_190214_create_categories_table', 1),
(8, '2024_02_22_164216_create_escuelas_table', 1),
(9, '2024_03_08_140604_user', 1),
(10, '2024_03_15_010632_create_products_table', 1),
(11, '2024_03_15_141242_nuevo', 1),
(12, '2024_03_15_151618_create_productos_table', 1),
(13, '2024_05_23_192732_create_imported_files_table', 2);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(255) NOT NULL,
  `token` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `personal_access_tokens`
--

CREATE TABLE `personal_access_tokens` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `tokenable_type` varchar(255) NOT NULL,
  `tokenable_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `token` varchar(64) NOT NULL,
  `abilities` text DEFAULT NULL,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `productos`
--

CREATE TABLE `productos` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `description` varchar(255) NOT NULL,
  `price` double(8,2) NOT NULL,
  `stock` double NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `products`
--

CREATE TABLE `products` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `description` text DEFAULT NULL,
  `price` decimal(8,2) NOT NULL,
  `quantity` int(10) UNSIGNED NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `todos`
--

CREATE TABLE `todos` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `title` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `curp` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `users`
--

INSERT INTO `users` (`id`, `name`, `curp`, `created_at`, `updated_at`) VALUES
(1, '', 'GARO020603HZSRNMA0', '2024-05-21 00:08:05', '2024-05-21 00:08:05'),
(2, 'curp', 'folio', '2024-05-21 01:13:20', '2024-05-21 01:13:20'),
(3, 'GARO020306HSRNMA0', '123456789', '2024-05-21 01:13:20', '2024-05-21 01:13:20'),
(4, 'folio', 'nombre', '2024-05-21 01:21:02', '2024-05-21 01:21:02'),
(5, '123456789', 'OMAR', '2024-05-21 01:21:03', '2024-05-21 01:21:03'),
(6, '123456789', 'EJEMPLO', '2024-05-21 01:21:03', '2024-05-21 01:21:03'),
(7, 'nombre', 'prim_apell', '2024-05-21 01:30:18', '2024-05-21 01:30:18'),
(8, 'OMAR', 'GARCIA', '2024-05-21 01:30:18', '2024-05-21 01:30:18'),
(9, 'prim_apell', 'segu_apell', '2024-05-21 01:34:26', '2024-05-21 01:34:26'),
(10, 'GARCIA', 'RENTERIA', '2024-05-21 01:34:27', '2024-05-21 01:34:27'),
(11, 'nombre', 'curp', '2024-05-21 01:48:48', '2024-05-21 01:48:48'),
(12, 'OMAR', 'GARO020306HSRNMA0', '2024-05-21 01:48:48', '2024-05-21 01:48:48'),
(13, 'EJEMPLO', 'EJEMPLO01234567890', '2024-05-21 01:48:49', '2024-05-21 01:48:49'),
(14, 'EJEMPLO2', 'EJEMPLO2H123456789', '2024-05-21 21:55:24', '2024-05-21 21:55:24'),
(15, 'EJEMPLO3', 'EJEMPLO3', '2024-05-21 21:55:25', '2024-05-21 21:55:25');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `citas`
--
ALTER TABLE `citas`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `datos`
--
ALTER TABLE `datos`
  ADD KEY `idx_curp` (`curp`),
  ADD KEY `idx_nombre` (`nombre`),
  ADD KEY `idx_entidad` (`entidad`);

--
-- Indices de la tabla `escuelas`
--
ALTER TABLE `escuelas`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indices de la tabla `imported_files`
--
ALTER TABLE `imported_files`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`);

--
-- Indices de la tabla `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  ADD KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`);

--
-- Indices de la tabla `productos`
--
ALTER TABLE `productos`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `todos`
--
ALTER TABLE `todos`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_curp_unique` (`curp`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `categories`
--
ALTER TABLE `categories`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `citas`
--
ALTER TABLE `citas`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `escuelas`
--
ALTER TABLE `escuelas`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `imported_files`
--
ALTER TABLE `imported_files`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=218;

--
-- AUTO_INCREMENT de la tabla `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT de la tabla `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `productos`
--
ALTER TABLE `productos`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `products`
--
ALTER TABLE `products`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `todos`
--
ALTER TABLE `todos`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
