-- Add visa and user information columns to users table
-- Run this via phpMyAdmin or your hosting control panel's SQL editor

ALTER TABLE `users` ADD COLUMN `date_of_birth` DATE NULL AFTER `password`;
ALTER TABLE `users` ADD COLUMN `nationality` VARCHAR(100) NULL AFTER `date_of_birth`;
ALTER TABLE `users` ADD COLUMN `status` VARCHAR(100) NULL AFTER `nationality`;
ALTER TABLE `users` ADD COLUMN `valid_from` DATE NULL AFTER `status`;
ALTER TABLE `users` ADD COLUMN `valid_until` DATE NULL AFTER `valid_from`;
ALTER TABLE `users` ADD COLUMN `national_insurance_number` VARCHAR(50) NULL UNIQUE AFTER `valid_until`;
ALTER TABLE `users` ADD COLUMN `photo_path` VARCHAR(255) NULL AFTER `national_insurance_number`;
ALTER TABLE `users` ADD COLUMN `code` VARCHAR(50) NULL UNIQUE AFTER `photo_path`;
ALTER TABLE `users` ADD COLUMN `code_valid_until` DATE NULL AFTER `code`;
