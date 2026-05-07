-- Добавить поле content для текстового описания категории
ALTER TABLE `category` ADD COLUMN `content` TEXT NULL AFTER `description`;
