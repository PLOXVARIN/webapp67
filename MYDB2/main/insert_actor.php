<?php
// เชื่อมต่อกับฐานข้อมูล
require('conn.php');

// ตรวจสอบว่ามีข้อมูลถูกส่งมาจากฟอร์มหรือไม่
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // รับค่าจากฟอร์ม
    $first_name = $_POST['first_name'];
    $last_name = $_POST['last_name'];
    $movie_ids = $_POST['movie_id']; // รับค่า movie_id เป็น array

    // เริ่ม transaction เพื่อทำงานหลายคำสั่งพร้อมกัน
    $conn->begin_transaction();

    try {
        // เพิ่มนักแสดงใหม่ลงในตาราง actors
        $sql = "INSERT INTO actors (first_name, last_name) 
                VALUES ('$first_name', '$last_name')";
        if ($conn->query($sql) === TRUE) {
            // รับ actor_id ที่เพิ่งถูกสร้างใหม่
            $actor_id = $conn->insert_id;

            // เพิ่มความสัมพันธ์ระหว่างนักแสดงและภาพยนตร์ลงในตาราง actor_movie
            foreach ($movie_ids as $movie_id) {
                $sql = "INSERT INTO actor_movie (actor_id, movie_id) 
                        VALUES ('$actor_id', '$movie_id')";
                $conn->query($sql);
            }

            // ถ้าทุกอย่างเรียบร้อย ให้ commit transaction
            $conn->commit();
            echo "เพิ่มนักแสดงใหม่เรียบร้อยแล้ว";
        } else {
            throw new Exception("เกิดข้อผิดพลาดในการเพิ่มนักแสดง");
        }
    } catch (Exception $e) {
        // ถ้ามีข้อผิดพลาด ให้ rollback transaction
        $conn->rollback();
        echo "เกิดข้อผิดพลาด: " . $e->getMessage();
    }

    // ปิดการเชื่อมต่อฐานข้อมูล
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
        <h2>เพิ่มนักแสดงใหม่</h2>
        <!-- ฟอร์มสำหรับกรอกข้อมูลนักแสดงและเลือกภาพยนตร์ -->
        <form action="insert_actor.php" method="POST">
            <label for="first_name">ชื่อ</label>
            <input type="text" id="first_name" name="first_name" required>

            <label for="last_name">นามสกุล</label>
            <input type="text" id="last_name" name="last_name" required>

            <label for="movie">ภาพยนตร์ที่แสดง</label>
            <select id="movie" name="movie_id[]" multiple required>
                <?php
                // ดึงข้อมูลภาพยนตร์ทั้งหมดจากฐานข้อมูล
                require('conn.php');
                $sql = "SELECT movie_id, title FROM movies";
                $result = $conn->query($sql);

                // แสดงภาพยนตร์ใน dropdown
                if ($result->num_rows > 0) {
                    while($row = $result->fetch_assoc()) {
                        echo "<option value='" . $row['movie_id'] . "'>" . $row['title'] . "</option>";
                    }
                } else {
                    echo "<option value=''>ไม่มีภาพยนตร์ให้เลือก</option>";
                }
                ?>
            </select>

            <button type="submit" class="submit">เพิ่มนักแสดง</button>
        </form>
        <a href='actors.php'> <button> Home </button></a>
        
        
    </div>

    <?php
    // ปิดการเชื่อมต่อ
    $conn->close();
    ?>
</body>
</html>
