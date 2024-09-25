<?php
require('conn.php'); // รวมไฟล์เชื่อมต่อฐานข้อมูล

// สร้างคำสั่ง SQL เพื่อตรวจสอบข้อมูลสมาชิก
$sql = "SELECT member_id, first_name, last_name, address, phone FROM members"; // เพิ่มฟิลด์ที่อยู่และเบอร์โทร
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="th">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>รายชื่อสมาชิก</title>
    <link rel="stylesheet" href="styles.css"> <!-- เรียกใช้ไฟล์ CSS ถ้ามี -->
</head>
<body>
    <div class="container">
        <h1>รายชื่อสมาชิก</h1>
        <table>
            <thead>
                <tr>
                    <th>รหัสสมาชิก</th>
                    <th>ชื่อ</th>
                    <th>นามสกุล</th>
                    <th>ที่อยู่</th>
                    <th>เบอร์โทร</th>
                    <th>แก้ไข</th> <!-- คอลัมน์ใหม่สำหรับปุ่ม Edit -->
                </tr>
            </thead>
            <tbody>
                <?php
                // เช็คว่ามีข้อมูลหรือไม่
                if ($result->num_rows > 0) {
                    // แสดงข้อมูลสมาชิกแต่ละคน
                    while($row = $result->fetch_assoc()) {
                        echo "<tr>
                                <td>" . $row["member_id"] . "</td>
                                <td>" . $row["first_name"] . "</td>
                                <td>" . $row["last_name"] . "</td>
                                <td>" . $row["address"] . "</td>
                                <td>" . $row["phone"] . "</td>
                                <td><a href='edit.php?id=" . $row['member_id'] . "' class='edit-button'>แก้ไข</a></td>
                                </tr>";
                    }
                } else {
                    echo "<tr><td colspan='7'>ไม่พบข้อมูลสมาชิก</td></tr>";
                }
                ?>
            </tbody>
        </table>
        <a href='main.php'> <button> Home </button></a>
        <a href="insert.php"><button>insert</button> </a>
        
    </div>
    

    <?php
    // ปิดการเชื่อมต่อ
    $conn->close();
    ?>
</body>
</html>
