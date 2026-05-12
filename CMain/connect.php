<?php
//session_start();
//config 

$ip_sv = "localhost";
$dbname_sv = "db_shop";
$user_sv = "root";
$pass_sv = "";

//GMT +7

date_default_timezone_set('Asia/Ho_Chi_Minh');

// Create connection

$conn = new mysqli($ip_sv, $user_sv, $pass_sv, $dbname_sv);
    
// Check connection
    
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
    exit(0);
}

$list_recharge_price_momo = [
    [
        "amount" => 10000,
        "bonus" => 0
    ],
    [
        "amount" => 50000,
        "bonus" => 0
    ],
    [
        "amount" => 100000,
        "bonus" => 0
    ],
    [
        "amount" => 200000,
        "bonus" => 0
    ],
    [
        "amount" => 500000,
        "bonus" => 0
    ],
    [
        "amount" => 1000000,
        "bonus" => 2
    ],
    [
        "amount" => 2000000,
        "bonus" => 2
    ],
    [
        "amount" => 5000000,
        "bonus" => 3
    ],
    [
        "amount" => 10000000,
        "bonus" => 5
    ],
];

$configNapTien = [
    'atm' => [
        'nganhang' => 'TP Bank', //Tên Ngân Hàng
        'chutaikhoan' => '', //chủ tài khoản atm mà bạn sử dụng
        'sotaikhoan' => '', //số tài khoản atm bạn sử dụng
        'apikey' => 'A6D6F2FD-610B-858D-D6C7-6C76D6FF6FC8', //Api key mà api.web2m.com cung cấp cho bạn
        'matkhau' => '' //Mật khẩu ngân hàng của bạn
    ],
    'momo' => [
        'chutaikhoan' => '',
        'sotaikhoan' => '',
        'apikey' => '',
    ],
    'zalo' => [
        'sdt' => '0',
        'group' => 'https://zalo.me/g/hycaec831',
    ],
    'SEVER' => [
        'tensv' => 'vnz',        
        'TENSV' => 'VNZ',
    ],
];

function getQrMomoPayment($username, $amount, $acctNum){
    return "https://api.qrserver.com/v1/create-qr-code/?size=250x250&data=2|99|$acctNum|||0|0|$amount|$username|transfer_p2p";
}

function getLinkMomoPayment($username, $amount, $acctNum){
    return "https://nhantien.momo.vn/$acctNum/$amount";
}


function getQrAtmPayment($username,$amount, $acctNum){
    return "https://api.vietqr.io/970422/$acctNum/$amount/nt $username/qr_only.jpg";
}
function getgiaAtmPayment($amount){
    return number_format($amount, 0, '.');
}

$connect = true;
?>
