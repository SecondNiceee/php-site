-- Добавляем поля slug и content в таблицу brand
ALTER TABLE `brand` ADD COLUMN `slug` VARCHAR(255) NULL AFTER `title`;
ALTER TABLE `brand` ADD COLUMN `content` TEXT NULL AFTER `slug`;

-- Добавляем индекс на slug для быстрого поиска
ALTER TABLE `brand` ADD INDEX `idx_slug` (`slug`);
