<?php
ob_start();
include "./main.php";
ob_end_flush();
?>

<style>
    #itemTable {
        border-collapse: collapse;
        width: 100%;
        border-radius: 8px;
        overflow: hidden;
    }

    #itemTable th,
    #itemTable td {
        padding: 12px;
        text-align: left;
        border-right: 1px solid #ff9899;
    }

    #itemTable tbody tr {
        border-bottom: 1px solid #ff9899;
    }

    #itemTable tbody tr:last-child {
        border-bottom: none;
    }

    #itemTable th:last-child,
    #itemTable td:last-child {
        border-right: none;
    }

    #itemTable thead th {
        background-color: #ff9899;
        color: white;
    }

    #itemTable th {
        background-color: #ff9899;
        color: white;
    }

    @media only screen and (max-width: 600px) {
        .search-container input[type="text"] {
            width: 100%;
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

<div class="card">
    <center>
        <p>
            <h2 style="color: #ff8400;">🍑️Danh sách GiftCode🍑️</h2>
        </p>
    </center>
    <hr>
    
</div>

<?php
include 'end.php';
?>
