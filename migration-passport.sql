-- Add passport_number column to users table
-- Run this via phpMyAdmin or your hosting control panel's SQL editor

ALTER TABLE `users` ADD COLUMN `passport_number` VARCHAR(50) NULL UNIQUE AFTER `national_insurance_number`;
