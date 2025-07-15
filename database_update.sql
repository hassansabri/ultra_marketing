-- Database Update for Profile Management System
-- Add logo column to profile table

ALTER TABLE `profile` ADD COLUMN `logo` VARCHAR(255) NULL AFTER `adress`;

-- Update existing profile record to have a default logo field
UPDATE `profile` SET `logo` = NULL WHERE `logo` IS NULL;

-- Add status column if not exists (for future use)
ALTER TABLE `profile` ADD COLUMN `status` TINYINT(1) DEFAULT 1 AFTER `logo`;

-- Update existing profile record to have active status
UPDATE `profile` SET `status` = 1 WHERE `status` IS NULL; 

-- Add shop_id to orders table
ALTER TABLE `orders` ADD COLUMN `shop_id` BIGINT(20) DEFAULT NULL; 