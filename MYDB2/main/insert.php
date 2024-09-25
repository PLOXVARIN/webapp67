<?php
require('conn.php'); // เชื่อมต่อกับฐานข้อมูล

// ตรวจสอบว่ามีการส่งฟอร์มมา
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // รับข้อมูลจากฟอร์ม
    $first_name = $_POST['first_name'];
    $last_name = $_POST['last_name'];
    $address = $_POST['address'];
    $phone = $_POST['phone'];

    // สร้างคำสั่ง SQL สำหรับเพิ่มข้อมูลสมาชิกใหม่
    $sql = "INSERT INTO members (first_name, last_name, address, phone) VALUES ('$first_name', '$last_name', '$address', '$phone')";

    // ตรวจสอบการดำเนินการ
    if ($conn->query($sql) === TRUE) {
        echo "เพิ่มสมาชิกใหม่เรียบร้อยแล้ว";
        header("Location: members.php"); // เปลี่ยนหน้าไปยัง members.php
        exit();
    } else {
        echo "เกิดข้อผิดพลาด: " . $sql . "<br>" . $conn->error;
    }
}
?>

<!DOCTYPE html>
<html lang="th">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>เพิ่มสมาชิกใหม่</title>
    <link rel="stylesheet" href="styles.css"> <!-- เรียกใช้ไฟล์ CSS ถ้ามี -->
</head>
<body>
    <div class="container">
        <h1>เพิ่มสมาชิกใหม่</h1>
        <form method="POST" action="">
            <label for="first_name">ชื่อ:</label>
            <input type="text" id="first_name" name="first_name" required>

            <label for="last_name">นามสกุล:</label>
            <input type="text" id="last_name" name="last_name" required>

            <label for="address">ที่อยู่:</label>
            <textarea id="address" name="address" required></textarea>

            <label for="phone">เบอร์โทร:</label>
            <input type="text" id="phone" name="phone" required>

            <input class="submit" type="submit" value="บันทึก">
        </form>
        <a href='main.php'> <button> Home </button></a>
        
        
    </div>

    <?php
    // ปิดการเชื่อมต่อ
    $conn->close();
    ?>
</body>
</html>
