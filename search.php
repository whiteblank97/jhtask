<?php

header("Content-Type:text/html; charset=utf-8");

function connect(){
    $conn = mysqli_connect("localhost", "root", "123456");
    return $conn;
}

function selectByCondition($array){
    $conn = connect();
    if (!$conn){
        echo 'connect failed';
    }
    $sql = null;
    $conn->select_db("jhtest");
    // mysqli_query($conn,"set names 'utf8'");
    $sql = "SELECT * FROM person WHERE 1 = 1";
    if ($array['name'] != null){
        $name = $array['name'];
        $sql = $sql." AND personName LIKE '%$name%'";
    }
    if ($array['number'] != null){
        $number = $array['number'];
        $sql = $sql." AND personNumber = '$number'";
    }
    if ($array['major'] != null){
        $sql = $sql." AND personMajor like '%{$array['major']}%'";
    }
    if ($array['Year'] != null){
        $year = $array['Year'];
        $sql = $sql." AND personBirth_year = '$year'";
    }
    if ($array['Month'] != 0){
        $month = $array['Month'];
        $sql = $sql." AND personBirth_month = '$month'";
    }
    if ($array['Day'] != 0){
        $day = $array['Day'];
        $sql = $sql." AND personBirth_day = '$day'";
    }
    $result = mysqli_query($conn, $sql);
    echo '查询结果如下：'.'<br/>';
    $count = 1;
    while ($row = mysqli_fetch_array($result)){
        echo '第'.$count.'位同学'.'<br/>';
        echo '名字:'.$row['personName'].'<br>';
        echo '学号:'.$row['personNumber'].'<br>';
        echo '专业:'.$row['personMajor'].'<br>';
        echo '简介:'.$row['introducation'].'<br>';
        echo '出生日期：'.$row['personBirth_year'].' '.$row['personBirth_month'].' '.$row['personBirth_day'].'<br>';
        echo '<br />';
        $count = $count + 1;
    }
    //if ($array['number'] != null)
}

$name = $_POST['name'];
$number = $_POST['number'];
$major = $_POST['major'];
$selYear = $_POST['selYear'];
$selMonth = $_POST['selMonth'];
$selDay = $_POST['selDay'];

$array = array(
    'name' => $name,
    'number' => $number,
    'major' => $major,
    'Year' => $selYear,
    'Month' => $selMonth,
    'Day' => $selDay
);

$result = selectByCondition($array);

