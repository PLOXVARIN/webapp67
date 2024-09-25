<?php
      require('conn.php');
      // ตรวจสอบว่าฟอร์มถูกส่งหรือยัง
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            // เชื่อมต่อกับฐานข้อมูล
            require('conn.php');

            // รับค่าจากฟอร์ม
            $title = $_POST["title"];
            $detal = $_POST["detal"];
            $moive_Time = $_POST["moive_Time"];
            $movie_date = $_POST["movie_date"];

            // เตรียมคำสั่ง SQL เพื่อเพิ่มข้อมูลภาพยนตร์ใหม่
            $sql = "INSERT INTO movies (title, detal, moive_Time, movie_date) 
                    VALUES ('$title', '$detal', '$moive_Time', '$movie_date')";

            if ($conn->query($sql) === TRUE) {
                echo "<p>เพิ่มข้อมูลภาพยนตร์สำเร็จ!</p>";
            } else {
                echo "<p>เกิดข้อผิดพลาด: " . $conn->error . "</p>";
            }

            // ปิดการเชื่อมต่อ
            $conn->close();
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
        <h2>เพิ่มภาพยนตร์ใหม่</h2>
        
        <!-- ฟอร์มสำหรับเพิ่มข้อมูลภาพยนตร์ใหม่ -->
        <form action="insert_movie.php" method="POST">
            <label for="title">ชื่อภาพยนตร์:</label>
            <input type="text" id="title" name="title" required>

            <label for="detal">รายละเอียด:</label>
            <textarea id="detal" name="detal" rows="4" required></textarea>

            <label for="moive_Time">ระยะเวลา (นาที):</label>
            <input type="number" id="moive_Time" name="moive_Time" required>

            <label for="movie_date">วันที่ออกฉาย:</label>
            <input type="date" id="movie_date" name="movie_date" required>

            <button type="submit" class="submit">เพิ่มภาพยนตร์</button>
        </form>
        <a href="movie.php"><button>กลับไปหน้าภาพยนตร์</button></a>
        
        
    </div>

    <?php
    // ปิดการเชื่อมต่อ
    $conn->close();
    ?>
</body>
</html>
