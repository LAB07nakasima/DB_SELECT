-- phpMyAdmin SQL Dump
-- version 5.1.3
-- https://www.phpmyadmin.net/
--
-- ホスト: localhost
-- 生成日時: 2022 年 5 月 27 日 10:54
-- サーバのバージョン： 10.4.21-MariaDB
-- PHP のバージョン: 8.1.5

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- データベース: `gif_lo07_task`
--

-- --------------------------------------------------------

--
-- テーブルの構造 `job_change`
--

CREATE TABLE `job_change` (
  `article_id` int(11) NOT NULL,
  `title` varchar(128) COLLATE utf8mb4_bin NOT NULL,
  `text` text COLLATE utf8mb4_bin NOT NULL,
  `keyword` varchar(128) COLLATE utf8mb4_bin NOT NULL,
  `updated_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_bin;

--
-- テーブルのデータのダンプ `job_change`
--

INSERT INTO `job_change` (`article_id`, `title`, `text`, `keyword`, `updated_at`) VALUES
(1, '転職', 'お仕事やめて転職しました！', 'job_change', '2022-05-24 00:03:52');

-- --------------------------------------------------------

--
-- テーブルの構造 `topic_table`
--

CREATE TABLE `topic_table` (
  `id` int(11) NOT NULL,
  `topic` varchar(128) COLLATE utf8mb4_bin NOT NULL,
  `keyword` varchar(20) COLLATE utf8mb4_bin NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_bin;

--
-- テーブルのデータのダンプ `topic_table`
--

INSERT INTO `topic_table` (`id`, `topic`, `keyword`, `created_at`, `updated_at`) VALUES
(1, '転職', 'job_change', '2022-05-22 15:24:08', '2022-05-22 15:24:08'),
(8, '留学！', 'job_change', '2022-05-23 16:28:05', '2022-05-23 16:28:05'),
(9, '学び直し', 're_learn', '2022-05-23 16:28:21', '2022-05-23 16:28:21'),
(10, 'ワーホリ', 'working_holiday', '2022-05-25 18:06:52', '2022-05-25 18:06:52'),
(11, '仕事を続ける', 'job_continue', '2022-05-25 18:21:55', '2022-05-25 18:21:55'),
(12, '休憩', 'break', '2022-05-25 18:22:41', '2022-05-25 18:22:41');

-- --------------------------------------------------------

--
-- テーブルの構造 `users_table`
--

CREATE TABLE `users_table` (
  `id` int(11) NOT NULL,
  `username` varchar(128) COLLATE utf8mb4_bin NOT NULL,
  `password` varchar(128) COLLATE utf8mb4_bin NOT NULL,
  `is_admin` int(1) NOT NULL,
  `is_deleted` int(1) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_bin;

--
-- ダンプしたテーブルのインデックス
--

--
-- テーブルのインデックス `job_change`
--
ALTER TABLE `job_change`
  ADD PRIMARY KEY (`article_id`);

--
-- テーブルのインデックス `topic_table`
--
ALTER TABLE `topic_table`
  ADD PRIMARY KEY (`id`);

--
-- テーブルのインデックス `users_table`
--
ALTER TABLE `users_table`
  ADD PRIMARY KEY (`id`);

--
-- ダンプしたテーブルの AUTO_INCREMENT
--

--
-- テーブルの AUTO_INCREMENT `job_change`
--
ALTER TABLE `job_change`
  MODIFY `article_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- テーブルの AUTO_INCREMENT `topic_table`
--
ALTER TABLE `topic_table`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- テーブルの AUTO_INCREMENT `users_table`
--
ALTER TABLE `users_table`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
