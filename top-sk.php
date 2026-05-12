<?php
include 'main.php';
?>
<div class="card">
    <div class="card-body">
    <center>
        <p>
            <h2 style="color: #ff8400;">🍑️BXH TOP SỰ KIỆN🍑️</h2>
        </p>
    </center>
        <div class="table-responsive">
            <?php

            $sql = "SELECT event_points.player_id, players.name, event_points.point 
                    FROM event_points 
                    JOIN players ON event_points.player_id = players.id";

            // Thực hiện truy vấn
            $result = $conn->query($sql);

            // Kiểm tra và lấy dữ liệu
            $data = [];
            if ($result && $result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    // Chuyển đổi chuỗi JSON thành mảng PHP
                    $pointData = json_decode($row["point"], true);

                    // Kiểm tra trước khi sử dụng $pointData
                    if (isset($pointData[0]) && isset($pointData[0]['point'])) {
                        // Thêm mảng dữ liệu vào mảng chính
                        $data[] = [
                            "player_name" => $row["name"],
                            "point" => $pointData[0]['point']
                        ];
                    }
                }
            }

            // Kiểm tra mảng trước khi sắp xếp
            if (!empty($data)) {
                // Sắp xếp mảng theo giảm dần của giá trị cột point
                usort($data, function ($a, $b) {
                    return $b['point'] - $a['point'];
                });

                // In ra bảng kết quả, giới hạn chỉ hiển thị 12 hàng
                echo "<table border='1'><tr><th>Xếp hạng</th><th>Tên nhân vật</th><th>Số điểm</th></tr>";

                $index = 1;
                foreach ($data as $row) {
                    $rankColor = ''; // Màu chữ mặc định
                    $fontWeight = ''; // Trọng lượng chữ mặc định

                    // Đặt màu chữ tùy thuộc vào vị trí
                    switch ($index) {
                        case 1:
                            $rankColor = 'color: red;';
                            $fontWeight = 'font-weight: bold;';
                            break;
                        case 2:
                            $rankColor = 'color: blue;';
                            $fontWeight = 'font-weight: bold;';
                            break;
                        case 3:
                            $rankColor = 'color: #0096ff;';
                            $fontWeight = 'font-weight: bold;';
                            break;
                        default:
                            $rankColor = 'color: #008080;';
                            break;
                    }

                    if ($index <= 10) {
                        echo "<tr style='{$rankColor}'>";

                        // Thêm kiểu chữ đậm cho cột "TOP"
                        echo "<td style='{$rankColor}{$fontWeight}'>TOP {$index}</td>";

                        // Thêm kiểu chữ đậm cho cột "Tên nhân vật"
                        echo "<td style='{$rankColor}{$fontWeight}'>{$row['player_name']}</td>";

                        // Thêm kiểu chữ đậm cho cột "Số điểm"
                        echo "<td style='{$rankColor}{$fontWeight}'>{$row['point']}</td>";

                        echo "</tr>";
                        $index++;
                    } else {
                        break; // Dừng vòng lặp khi đã hiển thị 10 hàng
                    }
                }

                echo "</table>";
            } else {
                echo "<p>Không có dữ liệu để hiển thị.</p>";
            }

            // Đóng kết nối
            ?>
        </div>
    </div>
</div>

<style>
    /* CSS styles for the table and overall layout */
    .table-container {
        text-align: center;
        margin-top: 20px;
    }

    table {
        width: 100%;
        border-collapse: collapse;
        margin-top: 20px;
    }

    th, td {
        padding: 10px;
        border: 1px solid #ddd;
    }

    table th {
        background-color: #ff8400;
        color: white;
    }
</style>
<?php
include './end.php';
?>
