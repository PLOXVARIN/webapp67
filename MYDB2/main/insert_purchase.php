<?php
require('conn.php');

// ตรวจสอบการเชื่อมต่อฐานข้อมูล
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// ตรวจสอบการส่งข้อมูลจากฟอร์ม
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $member_id = $_POST['member_id'];
    $movie_id = $_POST['movie_id'];
    $purchase_date = $_POST['purchase_date'];
    $quantity = $_POST['quantity'];

    // คำสั่ง SQL สำหรับเพิ่มข้อมูลการซื้อ
    $sql = "INSERT INTO purchases (member_id, movie_id, purchase_date, quantity) VALUES (?, ?, ?, ?)";

    // เตรียมคำสั่ง
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("iisi", $member_id, $movie_id, $purchase_date, $quantity); // iisi คือชนิดข้อมูล (integer, integer, string, integer)

    if ($stmt->execute()) {
        echo "เพิ่มข้อมูลการซื้อสำเร็จ!";
        header("Location: purchases.php"); // เปลี่ยนเส้นทางไปยังหน้าข้อมูลการซื้อหลังจากเพิ่มเสร็จ
        exit;
    } else {
        echo "เกิดข้อผิดพลาด: " . $stmt->error;
    }

    // ปิดการเตรียมคำสั่ง
    $stmt->close();
}
?>

<!DOCTYPE html>
<html lang="th">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>เพิ่มข้อมูลการซื้อ</title>
    <link rel="stylesheet" href="styles.css"> <!-- เรียกใช้ไฟล์ CSS ถ้ามี -->
</head>
<body>
    <div class="container">
        <h2>เพิ่มข้อมูลการซื้อ</h2>
        <form action="insert_purchase.php" method="post">
            <label for="member_id">ชื่อสมาชิก:</label>
            <select name="member_id" id="member_id" required>
                <?php
                // ดึงชื่อสมาชิกจากฐานข้อมูล
                $sql = "SELECT member_id, CONCAT(first_name, ' ', last_name) AS full_name FROM members";
                $result = $conn->query($sql);
                if ($result && $result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) {
                        echo "<option value='" . $row['member_id'] . "'>" . $row['full_name'] . "</option>";
                    }
                } else {
                    echo "<option value=''>ไม่พบข้อมูลสมาชิก</option>";
                }
                ?>
            </select>
            <br>

            <label for="movie_id">ชื่อภาพยนตร์:</label>
            <select name="movie_id" id="movie_id" required>
                <?php
                // ดึงชื่อภาพยนตร์จากฐานข้อมูล
                $sql = "SELECT movie_id, title FROM movies";
                $result = $conn->query($sql);
                if ($result && $result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) {
                        echo "<option value='" . $row['movie_id'] . "'>" . $row['title'] . "</option>";
                    }
                } else {
                    echo "<option value=''>ไม่พบข้อมูลภาพยนตร์</option>";
                }
                ?>
            </select>
            <br>

            <label for="purchase_date">วันที่ซื้อ:</label>
            <input type="date" name="purchase_date" id="purchase_date" required>
            <br>

            <label for="quantity">จำนวน:</label>
            <input type="number" name="quantity" id="quantity" required min="1">
            <br>

            <button type="submit" class="submit">เพิ่มการซื้อ</button>
        </form>
        <a href='purchases.php'><button>กลับไปหน้าข้อมูลการซื้อ</button></a>
    </div>

    <?php
    // ปิดการเชื่อมต่อฐานข้อมูล
    $conn->close();
    ?>
</body>
</html>
