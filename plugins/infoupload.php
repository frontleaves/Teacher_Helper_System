<?php
//入库
include_once("../config.inc.php");

// 数据库
// 链接数据库
$conn=new MySQLi($setting["sql"]["host"],$setting["sql"]["username"],$setting["sql"]["password"],$setting["sql"]["sqlname"]);
if ($setting["Debug"] == TRUE) {
    if($conn->connect_error){
        die("数据库连接失败！<br/>".$conn->connect_error);
    }
}
$email = $_COOKIE["uid"];
// 从数据库根据email调取用户信息
$result = $conn->query( "SELECT * FROM ".$setting["sql"]["members"]." WHERE email='".$email."'" )->fetch_assoc();

// 获取数据
$name = $_POST["name"];
$info = $_POST["info"];
$classes = $_POST["classes"];
$qq = $_POST["qq"];
$tel = $_POST["tel"];

// DEBUG
if ($setting["Debug"] == TRUE) {
    echo "[DeBUG] 输出数据";
    echo "<br/>昵称： ";
    echo $name;
    echo "<br/>一句话介绍： ";
    echo $info;
    echo "<br/>班级： ";
    echo $classes;
    echo "<br/>qq： ";
    echo $qq;
    echo "<br/>电话： ";
    echo $tel;
    echo "<br/>";
}

if (mysqli_query($conn,"UPDATE members set name='$name',class='$classes',info='$info',phone='$tel',qq='$qq' WHERE email='".$email."'") == true) {
    if (!$setting["Debug"] == TRUE) {
        echo <<<EOF
        <script language="javascript">
            alert( "成功！" )
            window.location.href = "../info.php"
        </script>
        EOF;
    } else {
        echo "数据上传成功";
    }
} else {
    if (!$setting["Debug"] == TRUE) {
        echo <<<EOF
        <script language="javascript">
            alert( "失败！" )
            window.location.href = "../info.php"
        </script>
        EOF;
    } else {
        echo "数据上传失败";
    }
};

mysqli_close($conn);
?>