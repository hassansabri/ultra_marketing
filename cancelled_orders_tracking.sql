-- Add cancelled status to orders table
ALTER TABLE `orders` MODIFY COLUMN `order_status` enum('draft','confirm','cancelled') NOT NULL DEFAULT 'draft';

-- Create cancelled orders tracking table
CREATE TABLE `cancelled_orders` (
  `cancellation_id` bigint(20) NOT NULL AUTO_INCREMENT,
  `order_number` bigint(20) NOT NULL,
  `cancelled_date` datetime NOT NULL DEFAULT current_timestamp(),
  `cancelled_by` bigint(20) NOT NULL,
  `cancellation_reason` varchar(255) DEFAULT NULL,
  `original_status` enum('draft','confirm') NOT NULL,
  `stock_restored` tinyint(1) DEFAULT 0,
  `stock_restoration_date` datetime DEFAULT NULL,
  PRIMARY KEY (`cancellation_id`),
  KEY `order_number` (`order_number`),
  KEY `cancelled_by` (`cancelled_by`),
  KEY `cancelled_date` (`cancelled_date`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

-- Add indexes for better performance
ALTER TABLE `orders` ADD INDEX `idx_order_status` (`order_status`);
ALTER TABLE `orders` ADD INDEX `idx_modified_date` (`modified_date`); 