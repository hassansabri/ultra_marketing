<?php
// Test MySQL connection using the same settings as the application
$hostname = 'localhost';
$username = 'root';
$password = '';
$database = 'ultra_marketing';

echo "Testing MySQL connection...\n";

try {
    $mysqli = new mysqli($hostname, $username, $password, $database);
    
    if ($mysqli->connect_error) {
        echo "Connection failed: " . $mysqli->connect_error . "\n";
        echo "Error number: " . $mysqli->connect_errno . "\n";
    } else {
        echo "Connection successful!\n";
        echo "Server info: " . $mysqli->server_info . "\n";
        echo "Host info: " . $mysqli->host_info . "\n";
        
        // Test a simple query
        $result = $mysqli->query("SELECT 1 as test");
        if ($result) {
            $row = $result->fetch_assoc();
            echo "Query test successful: " . $row['test'] . "\n";
        } else {
            echo "Query test failed: " . $mysqli->error . "\n";
        }
        
        $mysqli->close();
    }
} catch (Exception $e) {
    echo "Exception: " . $e->getMessage() . "\n";
}

echo "Test completed.\n";
?> 