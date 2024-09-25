<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
<?php
// conn.php

// กำหนดค่าการเชื่อมต่อฐานข้อมูล
$servername = "localhost"; // ชื่อเซิร์ฟเวอร์
$username = "root";         // ชื่อผู้ใช้ (โดยปกติใน XAMPP คือ root)
$password = "";             // รหัสผ่าน (โดยปกติใน XAMPP ไม่มีรหัสผ่าน)
$dbname = "moive_dvd_shop";      // ชื่อฐานข้อมูลที่คุณสร้าง

// สร้างการเชื่อมต่อ
$conn = new mysqli($servername, $username, $password, $dbname);

// ตรวจสอบการเชื่อมต่อ
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// สามารถใช้ $conn ในการเรียกใช้งานฐานข้อมูลต่อไปได้
?>
    
</body>
</html>