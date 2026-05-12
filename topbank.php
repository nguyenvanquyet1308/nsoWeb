<style>
    /* CSS cho bảng xếp hạng */
    .styled-table {
        width: 100%;
        border-collapse: collapse;
        margin: 25px 0;
        font-size: 18px;
        text-align: left;
    }

    .styled-table th,
    .styled-table td {
        padding: 12px 15px;
        border-bottom: 1px solid #ddd;
    }

    .styled-table th {
        background-color: #f2f2f2;
    }

    @media only screen and (max-width: 600px) {
        .search-container input[type="text"] {
            width: 100%; /* Thiết lập chiều rộng là 100% trên màn hình có chiều rộng tối đa 600px */
        }
    }

    .card1 {
        width: 100%;
        overflow: hidden;
    }

    .card-body1 {
        overflow-x: auto;
    }
</style>

<?php
include_once './main.php';
echo '<div class="card">
<div class="card1">
<div class="card-body1">
<center>

<h2 style="color: #fe7d90;">🍓BẢNG XẾP HẠNG NẠP🍓</h2>
<hr>
</center>';
// Truy vấn SQL mới để lấy dữ liệu từ bảng players và users
/*$sql = "SELECT players.user_id, players.name, users.tongnap, users.vip FROM players
            INNER JOIN users ON players.user_id = users.id
            ORDER BY users.tongnap DESC";*/

/*$sql = "SELECT players.user_id, players.name, users.tongnap, users.vip FROM players
            INNER JOIN users ON players.user_id = users.id
            WHERE users.vip >= 1
            ORDER BY users.tongnap DESC";*/

$sql = "SELECT players.user_id, players.name, users.tongnap, users.vip FROM players
            INNER JOIN users ON players.user_id = users.id
            WHERE users.vip >= 1
            ORDER BY 
                CASE
                    WHEN users.tongnap = 0 THEN users.vip
                    ELSE users.tongnap
                END DESC, users.vip DESC";

$result = $conn->query($sql);

// Kiểm tra xem có lỗi trong truy vấn không
if (!$result) {
    die("Lỗi truy vấn: " . $conn->error);
}

// Hiển thị bảng xếp hạng
if ($result->num_rows > 0) {
    echo "<table class='styled-table'>";
    echo "<thead><tr>
        <th>Top</th>
        <th>Hảo hán</th>
        <th>Vip</th>
        <th>Tổng nạp</th>
        </tr></thead>";
    echo "<tbody>";
    $rank = 1; // Biến đếm số thứ tự
    while ($row = $result->fetch_assoc()) {
        $name = $row['name'];

        // Kiểm tra giá trị vip trước khi hiển thị
        echo "<tr>
            <td>{$rank}</td>
            <td>{$name}</td>
            <td>";
        // Kiểm tra giá trị vip trước khi hiển thị
        /*if ($row['vip'] != -1) {*/
        // Kiểm tra giá trị của vip và hiển thị màu tương ứng
        switch ($row['vip']) {
            case '-1':
                echo '<div><span>Thành viên</span></div>';
                break;
            case '0':
                echo '<div style="color: rgb(26 106 205);"><b>Thành viên</b></div>';
                break;
            /*case '1':
                echo '<div style="color: rgb(60 207 0);"><b>VIP 1 ✧</b></div>';
                break;
            case '2':
                echo '<div style="color: rgb(253 210 11);"><b>VIP 2 ✧✧</b></div>';
                break;*/
            case '1':
                echo '<div style="color: rgb(253 68 13);"><b>VIP ✧</b></div>';
                break;
            case '2':
                echo '<div style="color: rgb(199 7 255);"><b>V_VIP ✧✧</b></div>';
                break;
            case '3':
                echo '<div style="color: rgb(253 68 13);"><b id="r1">S_VIP ✧✧✧</b></div>';
                echo '<script type="text/javascript">
                    function toSpans(span) {
                        var str=span.firstChild.data;
                        var a=str.length;
                        span.removeChild(span.firstChild);
                        for(var i=0; i<a; i++) {
                            var theSpan=document.createElement("SPAN");
                            theSpan.appendChild(document.createTextNode(str.charAt(i)));
                            span.appendChild(theSpan);
                        }
                    }

                    function RainbowSpan(span, hue, deg, brt, spd, hspd) {
                        this.deg=(deg==null?360:Math.abs(deg));
                        this.hue=(hue==null?0:Math.abs(hue)%360);
                        this.hspd=(hspd==null?3:Math.abs(hspd)%360);
                        this.length=span.firstChild.data.length;
                        this.span=span;
                        this.speed=(spd==null?50:Math.abs(spd));
                        this.hInc=this.deg/this.length;
                        this.brt=(brt==null?255:Math.abs(brt)%256);
                        this.timer=null;
                        toSpans(span);
                        this.moveRainbow();
                    }
                    RainbowSpan.prototype.moveRainbow = function() {
                        if(this.hue>359) this.hue-=360;
                        var color;
                        var b=this.brt;
                        var a=this.length;
                        var h=this.hue;

                        for(var i=0; i<a; i++) {

                            if(h>359) h-=360;

                            if(h<60) { color=Math.floor(((h)/60)*b); red=b;grn=color;blu=0; }
                            else if(h<120) { color=Math.floor(((h-60)/60)*b); red=b-color;grn=b;blu=0; }
                            else if(h<180) { color=Math.floor(((h-120)/60)*b); red=0;grn=b;blu=color; }
                            else if(h<240) { color=Math.floor(((h-180)/60)*b); red=0;grn=b-color;blu=b; }
                            else if(h<300) { color=Math.floor(((h-240)/60)*b); red=color;grn=0;blu=b; }
                            else { color=Math.floor(((h-300)/60)*b); red=b;grn=0;blu=b-color; }

                            h+=this.hInc;

                            this.span.childNodes[i].style.color="rgb("+red+", "+grn+", "+blu+")";
                        }
                        this.hue+=this.hspd;
                    }
                    var r1=document.getElementById("r1");
                    var myRainbowSpan=new RainbowSpan(r1, 0, 360, 255, 50, 18);
                    myRainbowSpan.timer=window.setInterval("myRainbowSpan.moveRainbow()", myRainbowSpan.speed);
                </script>';
                break;
            default:
                echo "&nbsp;"; // Hiển thị khoảng trắng nếu giá trị không phù hợp
                break;
        }
        /*} else {
            echo "&nbsp;"; // Hiển thị khoảng trắng nếu giá trị là -1
        }*/
        echo "</td>
            <td>" . number_format($row['tongnap']) . " Coin</td>
            </tr>";
        $rank++;
    }
    echo "</tbody></table>";
} else {
    echo "Không có dữ liệu.";
}

// Đóng kết nối
$conn->close();
?>
</div>
</div>
</div>
<?php include_once './end.php'; ?>
