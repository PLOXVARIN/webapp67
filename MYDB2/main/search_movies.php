<?php
// เชื่อมต่อกับฐานข้อมูล
require('conn.php');

if (isset($_POST['query'])) {
    $query = $_POST['query'];

    // ใช้ SQL เพื่อค้นหาข้อมูลภาพยนตร์ที่ตรงกับคำค้น
    $sql = "SELECT movie_id, title 
            FROM movies 
            WHERE title LIKE '%" . $conn->real_escape_string($query) . "%'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        // หากพบภาพยนตร์ให้สร้าง <option> สำหรับแต่ละเรื่อง
        while ($row = $result->fetch_assoc()) {
            echo "<option value='" . $row['movie_id'] . "'>" . $row['title'] . "</option>";
        }
    } else {
        // หากไม่พบภาพยนตร์
        echo "<option value=''>ไม่พบภาพยนตร์</option>";
    }
}
?>
