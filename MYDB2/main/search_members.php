<?php
// เชื่อมต่อกับฐานข้อมูล
require('conn.php');

if (isset($_POST['query'])) {
    $query = $_POST['query'];

    // ใช้ SQL เพื่อค้นหาข้อมูลสมาชิกที่ตรงกับคำค้น
    $sql = "SELECT member_id, CONCAT(first_name, ' ', last_name) AS full_name 
            FROM members 
            WHERE CONCAT(first_name, ' ', last_name) LIKE '%" . $conn->real_escape_string($query) . "%'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        // หากพบสมาชิกให้สร้าง <option> สำหรับแต่ละคน
        while ($row = $result->fetch_assoc()) {
            echo "<option value='" . $row['member_id'] . "'>" . $row['full_name'] . "</option>";
        }
    } else {
        // หากไม่พบสมาชิก
        echo "<option value=''>ไม่พบสมาชิก</option>";
    }
}

?>