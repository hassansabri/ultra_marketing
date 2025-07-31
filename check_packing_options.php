<?php
// Database configuration
$host = 'localhost';
$username = 'root';
$password = '';
$database = 'ultra_marketing';

try {
    $pdo = new PDO("mysql:host=$host;dbname=$database", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    
    echo "Connected to database successfully.\n";
    
    // Check if packing_options table exists
    $stmt = $pdo->query("SHOW TABLES LIKE 'packing_options'");
    $tableExists = $stmt->rowCount() > 0;
    
    if ($tableExists) {
        echo "✓ packing_options table exists.\n";
        
        // Check if table has data
        $stmt = $pdo->query("SELECT COUNT(*) as count FROM packing_options");
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        $count = $result['count'];
        
        echo "✓ packing_options table has $count records.\n";
        
        if ($count == 0) {
            echo "Inserting default packing options...\n";
            
            $defaultOptions = [
                ['Standard Packing', 'Basic packing with bubble wrap and cardboard box', 5.00],
                ['Premium Packing', 'Premium packing with extra protection and branded box', 15.00],
                ['Gift Packing', 'Special gift packing with decorative wrapping', 10.00],
                ['Bulk Packing', 'Economical packing for large quantities', 2.00],
                ['No Packing', 'No additional packing required', 0.00]
            ];
            
            $stmt = $pdo->prepare("INSERT INTO packing_options (packing_title, packing_description, packing_cost, status, created_date, modified_date) VALUES (?, ?, ?, 1, NOW(), NOW())");
            
            foreach ($defaultOptions as $option) {
                $stmt->execute($option);
            }
            
            echo "✓ Default packing options inserted successfully.\n";
        }
        
        // Show current packing options
        $stmt = $pdo->query("SELECT * FROM packing_options ORDER BY packing_id");
        $options = $stmt->fetchAll(PDO::FETCH_ASSOC);
        
        echo "\nCurrent packing options:\n";
        foreach ($options as $option) {
            echo "- ID: {$option['packing_id']}, Title: {$option['packing_title']}, Cost: \${$option['packing_cost']}\n";
        }
        
    } else {
        echo "✗ packing_options table does not exist.\n";
        echo "Creating packing_options table...\n";
        
        $sql = "CREATE TABLE `packing_options` (
            `packing_id` bigint(20) NOT NULL AUTO_INCREMENT,
            `packing_title` varchar(255) NOT NULL,
            `packing_description` text,
            `packing_cost` decimal(10,2) DEFAULT 0.00,
            `status` int(11) NOT NULL DEFAULT 1,
            `created_date` datetime NOT NULL DEFAULT current_timestamp(),
            `modified_date` datetime NOT NULL DEFAULT current_timestamp(),
            PRIMARY KEY (`packing_id`)
        ) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci";
        
        $pdo->exec($sql);
        echo "✓ packing_options table created successfully.\n";
        
        // Insert default data
        echo "Inserting default packing options...\n";
        
        $defaultOptions = [
            ['Standard Packing', 'Basic packing with bubble wrap and cardboard box', 5.00],
            ['Premium Packing', 'Premium packing with extra protection and branded box', 15.00],
            ['Gift Packing', 'Special gift packing with decorative wrapping', 10.00],
            ['Bulk Packing', 'Economical packing for large quantities', 2.00],
            ['No Packing', 'No additional packing required', 0.00]
        ];
        
        $stmt = $pdo->prepare("INSERT INTO packing_options (packing_title, packing_description, packing_cost, status, created_date, modified_date) VALUES (?, ?, ?, 1, NOW(), NOW())");
        
        foreach ($defaultOptions as $option) {
            $stmt->execute($option);
        }
        
        echo "✓ Default packing options inserted successfully.\n";
    }
    
    // Check if orders table has packing_id column
    $stmt = $pdo->query("SHOW COLUMNS FROM orders LIKE 'packing_id'");
    $columnExists = $stmt->rowCount() > 0;
    
    if (!$columnExists) {
        echo "Adding packing_id column to orders table...\n";
        $pdo->exec("ALTER TABLE `orders` ADD COLUMN `packing_id` bigint(20) DEFAULT NULL AFTER `order_price`");
        echo "✓ packing_id column added to orders table.\n";
    } else {
        echo "✓ packing_id column already exists in orders table.\n";
    }
    
    // Check if order_detail table has packing_id column
    $stmt = $pdo->query("SHOW COLUMNS FROM order_detail LIKE 'packing_id'");
    $columnExists = $stmt->rowCount() > 0;
    
    if (!$columnExists) {
        echo "Adding packing_id column to order_detail table...\n";
        $pdo->exec("ALTER TABLE `order_detail` ADD COLUMN `packing_id` bigint(20) DEFAULT NULL AFTER `attribute_quantity`");
        echo "✓ packing_id column added to order_detail table.\n";
    } else {
        echo "✓ packing_id column already exists in order_detail table.\n";
    }
    
    echo "\n✓ Database setup completed successfully!\n";
    
} catch(PDOException $e) {
    echo "Error: " . $e->getMessage() . "\n";
}
?> 