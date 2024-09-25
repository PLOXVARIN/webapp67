<!DOCTYPE html>
<html lang="th">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>DVD Movie Store - Movies</title>
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
        <h2>ข้อมูลภาพยนตร์</h2>
        <table>
            <tr>
                <th>รหัสภาพยนตร์</th>
                <th>ชื่อภาพยนตร์</th>
                <th>รายละเอียด</th>
                <th>ระยะเวลา</th>
                <th>วันที่</th>
                
            </tr>
            <!-- Loop through movies data from database -->
            <?php
            // เชื่อมต่อกับฐานข้อมูล
            require('conn.php');
            
            // คำสั่ง SQL เพื่อดึงข้อมูลภาพยนตร์
            $sql = "SELECT * FROM movies";
            $result = $conn->query($sql);

            if ($result->num_rows > 0) {
                while($row = $result->fetch_assoc()) {
                    echo "<tr>
                            <td>" . $row["movie_id"] . "</td>
                            <td>" . $row["title"] . "</td>
                            <td>" . $row["detal"] . "</td>
                            <td>" . $row["moive_Time"] . "</td>
                            <td>" . $row["movie_date"] . "</td>
                            
                          </tr>";
                }
            } else {
                echo "<tr><td colspan='5'>ไม่พบข้อมูลภาพยนตร์</td></tr>";
            }
            ?>
        </table>
        
        <a href='insert_movie.php'><button>เพิ่มภาพยนตร์</button></a>
        
    </div>

    <?php
    // ปิดการเชื่อมต่อฐานข้อมูล
    $conn->close();
    ?>
</body>
</html>
