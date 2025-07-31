-- Add packing_id column to orders table (for order-level packing)
ALTER TABLE `orders` ADD COLUMN `packing_id` bigint(20) DEFAULT NULL AFTER `order_price`;

-- Add packing_id column to order_detail table for item-specific packing
ALTER TABLE `order_detail` ADD COLUMN `packing_id` bigint(20) DEFAULT NULL AFTER `attribute_quantity`;

-- Add foreign key constraints (if they don't exist)
-- Note: These constraints will only be added if the packing_options table exists
-- ALTER TABLE `orders` ADD CONSTRAINT `fk_orders_packing` FOREIGN KEY (`packing_id`) REFERENCES `packing_options` (`packing_id`) ON DELETE SET NULL;
-- ALTER TABLE `order_detail` ADD CONSTRAINT `fk_order_detail_packing` FOREIGN KEY (`packing_id`) REFERENCES `packing_options` (`packing_id`) ON DELETE SET NULL;

-- Create packing_options table if it doesn't exist
CREATE TABLE IF NOT EXISTS `packing_options` (
  `packing_id` bigint(20) NOT NULL AUTO_INCREMENT,
  `packing_title` varchar(255) NOT NULL,
  `packing_description` text,
  `packing_cost` decimal(10,2) DEFAULT 0.00,
  `status` int(11) NOT NULL DEFAULT 1,
  `created_date` datetime NOT NULL DEFAULT current_timestamp(),
  `modified_date` datetime NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`packing_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

-- Insert default packing options if table is empty
INSERT IGNORE INTO `packing_options` (`packing_id`, `packing_title`, `packing_description`, `packing_cost`, `status`, `created_date`, `modified_date`) VALUES
(1, 'Standard Packing', 'Basic packing with bubble wrap and cardboard box', 5.00, 1, '2025-01-20 10:00:00', '2025-01-20 10:00:00'),
(2, 'Premium Packing', 'Premium packing with extra protection and branded box', 15.00, 1, '2025-01-20 10:00:00', '2025-01-20 10:00:00'),
(3, 'Gift Packing', 'Special gift packing with decorative wrapping', 10.00, 1, '2025-01-20 10:00:00', '2025-01-20 10:00:00'),
(4, 'Bulk Packing', 'Economical packing for large quantities', 2.00, 1, '2025-01-20 10:00:00', '2025-01-20 10:00:00'),
(5, 'No Packing', 'No additional packing required', 0.00, 1, '2025-01-20 10:00:00', '2025-01-20 10:00:00'); 