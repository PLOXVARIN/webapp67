<!DOCTYPE html>
<html lang="th">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>DVD Movie Store - Actors</title>
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
        <h2>ข้อมูลนักแสดง</h2>
        <table>
            <tr>
                <th>รหัสนักแสดง</th>
                <th>ชื่อ</th>
                <th>นามสกุล</th>
                <th>ภาพยนตร์ที่แสดง</th>
            </tr>
            <!-- Loop through actors and movies data from database -->
            <?php
            // เชื่อมต่อกับฐานข้อมูล
            require('conn.php');
            
            // คำสั่ง SQL เพื่อดึงข้อมูลนักแสดงและภาพยนตร์ที่แสดง
            $sql = "
                SELECT actors.actor_id, actors.first_name, actors.last_name, GROUP_CONCAT(movies.title SEPARATOR ', ') AS movies
                FROM actors
                LEFT JOIN actor_movie ON actors.actor_id = actor_movie.actor_id
                LEFT JOIN movies ON actor_movie.movie_id = movies.movie_id
                GROUP BY actors.actor_id
            ";
            $result = $conn->query($sql);

            if ($result->num_rows > 0) {
                while($row = $result->fetch_assoc()) {
                    echo "<tr>
                            <td>" . $row["actor_id"] . "</td>
                            <td>" . $row["first_name"] . "</td>
                            <td>" . $row["last_name"] . "</td>
                            <td>" . $row["movies"] . "</td>
                          </tr>";
                }
            } else {
                echo "<tr><td colspan='4'>ไม่พบข้อมูลนักแสดง</td></tr>";
            }
            ?>
        </table>
        
        <a href='insert_actor.php'><button>เพิ่มนักแสดง</button></a>
        
    </div>

    <?php
    // ปิดการเชื่อมต่อฐานข้อมูล
    $conn->close();
    ?>
</body>
</html>
