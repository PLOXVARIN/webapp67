<?php
require('conn.php'); // เชื่อมต่อกับฐานข้อมูล

// ตรวจสอบว่ามีการส่ง ID มาหรือไม่
if (isset($_GET['id'])) {
    $id = $_GET['id'];
    
    // ดึงข้อมูลสมาชิกจากฐานข้อมูล โดยใช้ member_id
    $sql = "SELECT * FROM members WHERE member_id='$id'";
    $result = $conn->query($sql);

    // ตรวจสอบว่าคำสั่ง SQL ถูกต้องหรือไม่
    if (!$result) {
        die("เกิดข้อผิดพลาดใน SQL: " . $conn->error); // แสดงข้อความเมื่อคำสั่ง SQL มีปัญหา
    }

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
    } else {
        echo "ไม่พบข้อมูลสมาชิก";
        exit();
    }
} else {
    echo "ID ไม่ถูกต้อง";
    exit();
}

// ตรวจสอบว่ามีการส่งฟอร์มมา
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // รับข้อมูลจากฟอร์ม
    $first_name = $_POST['first_name'];
    $last_name = $_POST['last_name'];
    $address = $_POST['address'];
    $phone = $_POST['phone'];

    // สร้างคำสั่ง SQL สำหรับอัปเดตข้อมูลสมาชิก โดยใช้ member_id
    $sql = "UPDATE members SET first_name='$first_name', last_name='$last_name', address='$address', phone='$phone' WHERE member_id='$id'";

    // ตรวจสอบการดำเนินการ
    if ($conn->query($sql) === TRUE) {
        echo "อัปเดตข้อมูลสมาชิกเรียบร้อยแล้ว";
        header("Location: members.php"); // เปลี่ยนหน้าไปยัง members.php
        exit();
    } else {
        echo "เกิดข้อผิดพลาด: " . $conn->error;
    }
}
?>

<!DOCTYPE html>
<html lang="th">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>แก้ไขข้อมูลสมาชิก</title>
    <link rel="stylesheet" href="styles.css"> <!-- เรียกใช้ไฟล์ CSS ถ้ามี -->
</head>
<body>
    <div class="container">
        <h1>แก้ไขข้อมูลสมาชิก</h1>
        <form method="POST" action="">
            <label for="first_name">ชื่อ:</label>
            <input type="text" id="first_name" name="first_name" value="<?php echo $row['first_name']; ?>" required>

            <label for="last_name">นามสกุล:</label>
            <input type="text" id="last_name" name="last_name" value="<?php echo $row['last_name']; ?>" required>

            <label for="address">ที่อยู่:</label>
            <textarea id="address" name="address" required><?php echo $row['address']; ?></textarea>

            <label for="phone">เบอร์โทร:</label>
            <input type="text" id="phone" name="phone" value="<?php echo $row['phone']; ?>" required>

            <input class="submit" type="submit" value="บันทึก">
        </form>
        <a href='members.php'> <button> Home </button></a>
    </div>

    <?php
    // ปิดการเชื่อมต่อ
    $conn->close();
    ?>
</body>
</html>
