<!DOCTYPE html>
<html lang="th">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>DVD Movie Store</title>
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
        <h2>ข้อมูลสมาชิก</h2>
        <table>
            <tr>
                <th>รหัสสมาชิก</th>
                <th>ชื่อ</th>
                <th>นามสกุล</th>
                <th>ที่อยู่</th>
                <th>เบอร์โทร</th>
                <th>จัดการ</th>
            </tr>
            <!-- Loop through members data from database -->
            <?php
            // Example PHP to fetch and display member data
            require('conn.php'); // เชื่อมต่อกับฐานข้อมูล
            $sql = "SELECT * FROM members";
            $result = $conn->query($sql);

            if ($result->num_rows > 0) {
                while($row = $result->fetch_assoc()) {
                    echo "<tr>
                            <td>" . $row["member_id"] . "</td>
                            <td>" . $row["first_name"] . "</td>
                            <td>" . $row["last_name"] . "</td>
                            <td>" . $row["address"] . "</td>
                            <td>" . $row["phone"] . "</td>
                            <td><a href='edit.php?id=" . $row["member_id"] . "' class='edit-button'>แก้ไข</a></td>
                          </tr>";
                }
            } else {
                echo "<tr><td colspan='6'>ไม่พบข้อมูลสมาชิก</td></tr>";
            }
            ?>
        </table>
        
        <a href='insert.php'><button>เพิ่มสมาชิก</button></a>
        
    </div>

    <?php
    // ปิดการเชื่อมต่อ
    $conn->close();
    ?>
</body>
</html>
