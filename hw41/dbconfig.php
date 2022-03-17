<?php
// ตั้งค่าตัวแปรสำหรับเชื่อมต่อฐานข้อมูล
$db_host = "database";
$db_user = "root";
$db_password = "tiger";
$db_name = "docdb";

// connect ไปยังฐานข้อมูล
$mysqli = new mysqli($db_host, $db_user, $db_password, $db_name);

// กำหนด ชุดตัวอักษรเป็น utf8
$mysqli->set_charset("utf8");

// ตรวจสอบการเชื่อมต่อ
// ถ้าติดต่อไม่สำเร็จจะแสดงข้อความ error, ถ้าติดต่อสำเร็จ ก็ไม่แสดงอะไรออกมา 
if ($mysqli->connect_errno) {
    echo "Failed to connect to MySQL: (" . $mysqli->connect_errno . ") " . $mysqli->connect_error;
} else {
    // connect success, do nothing
}