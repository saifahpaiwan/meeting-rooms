<?php 
$host = "192.168.0.38"; 
$dbname = "bg_hrms"; 
$user = "sasd";
$password = "y8U7E0n2SV6Tk50w";

// $host = "10.210.57.4"; 
// $dbname = "stockmobile_db"; 
// $user = "sd_admin";
// $password = "Th@1l@nd2233";
 
try { 
    $pdo = new PDO("mysql:host=$host;dbname=$dbname", $user, $password);
 
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    echo "Connected successfully";
} catch (PDOException $e) {
    echo "Connection failed: " . $e->getMessage();
} 
 
?>
 