<?php
require('conn.php');

// ตรวจสอบการเชื่อมต่อฐานข้อมูล
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>

<!DOCTYPE html>
<html lang="th">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>DVD Movie Store - ข้อมูลการซื้อ</title>
    <link rel="stylesheet" href="styles.css"> <!-- เรียกใช้ไฟล์ CSS ถ้ามี -->
</head>
<body>
<h1 class="h1_main">DVD Movie Store</h1>
    <header>
        <nav>
            <ul>
                <li><a href="main.php">สมาชิก</a></li>
                <li><a href="movie.php">ภาพยนตร์</a></li>
                <li><a href="actors.php">นักแสดง</a></li>
                <li><a href="purchases.php">การซื้อ</a></li>
            </ul>
        </nav>
    </header>

    <div class="container">
        <h2>ข้อมูลการซื้อ</h2>
        <table>
            <tr>
                <th>รหัสการซื้อ</th>
                <th>รหัสสมาชิก</th>
                <th>ชื่อสมาชิก</th>
                <th>ชื่อภาพยนตร์</th>
                <th>วันที่ซื้อ</th>
                <th>จำนวน</th>
            </tr>
            <!-- Loop through purchase data from database -->
            <?php
            // คำสั่ง SQL เพื่อดึงข้อมูลการซื้อ
            $sql = "
                SELECT p.purchase_id, p.member_id, CONCAT(m.first_name, ' ', m.last_name) AS full_name, p.purchase_date, p.quantity, GROUP_CONCAT(mv.title SEPARATOR ', ') AS movie_titles
                FROM purchases p
                JOIN members m ON p.member_id = m.member_id
                JOIN movies mv ON p.movie_id = mv.movie_id
                GROUP BY p.purchase_id
            ";
            $result = $conn->query($sql);

            if ($result === false) {
                die("Query failed: " . $conn->error);
            }

            if ($result->num_rows > 0) {
                while($row = $result->fetch_assoc()) {
                    echo "<tr>
                            <td>" . $row["purchase_id"] . "</td>
                            <td>" . $row["member_id"] . "</td>
                            <td>" . $row["full_name"] . "</td>
                            <td>" . $row["movie_titles"] . "</td>
                            <td>" . $row["purchase_date"] . "</td>
                            <td>" . $row["quantity"] . "</td>
                          </tr>";
                }
            } else {
                echo "<tr><td colspan='6'>ไม่พบข้อมูลการซื้อ</td></tr>";
            }
            ?>
        </table>
        <a href='insert_purchase.php'><button>เพิ่มภาพยนตร์</button></a>
    </div>

    <?php
    // ปิดการเชื่อมต่อฐานข้อมูล
    $conn->close();
    ?>
</body>
</html>
