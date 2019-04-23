<?php
    // 接收html表单数据
    $_post = $_POST;
    print_r($_post);
    $title = isset($_post["title"])?$_post["title"]:"";
    $radioWeather = isset($_post["radioWeather"])?$_post["radioWeather"]:"";
    $content = isset($_post["content"])?$_post["content"]:"";
    $dateWrite = isset($_post["dateWrite"])?$_post["dateWrite"]:"";
    $selectList = isset($_post["selectList"])?$_post["selectList"]:"";
    //与本地服务器链接并判断服务器是否连接成功
    $servername = "localhost";
    $user = "root";
    $password = "123";
    $conn = new mysqli($servername,$user,$password);
    if($conn->connect_error) {
        die("连接失败" . $conn->connect_error);
    }
    // 创建数据库practice 数据表persons并判断是否建立成功
    echo '连接成功<br/>';
    $sql = "create database if not exists journal";
    if ($conn->query($sql) === TRUE) {
        echo "数据库创建成功";
    } else {
        echo "<mark><br/>Error creating database: " . $conn->error."</mark>";
        echo "<br/>";
    }
    echo "连接成功<br/>";
    if (!mysqli_select_db($conn,'journal')) {
        echo 'error('.mysqli_errno($conn).'):'.mysqli_error($conn);
        die;
    }
    $table = "create table if not exists practice( " . 
        "journal_id int not null auto_increment," . 
        "title varchar(30) not null," . 
        "weather varchar(20) not null," . 
        "content text not null," . 
        "date varchar(30) not null," . 
        "selectList varchar(20) not null," . 
        "primary key ( journal_id )) default charset=utf8;";
    $retval = mysqli_query( $conn, $table);
    if(!$retval) {
        die('数据表创建失败:' . mysqli_error($conn));
    }
    echo "数据表创建成功\n";
    // 给数据库practice插入数据并判断数据是否插入成功
        $idata = "insert into practice" . " (title,weather,content,date,selectList)" . "values" . "('$title','$radioWeather','$content','$dateWrite','$selectList')";
    if($conn->query($idata) === true) {
        echo 'insert success';
    } else {
        echo 'insert fail' . "<br/>" . $conn->error;
    }
    $conn->close();
?>