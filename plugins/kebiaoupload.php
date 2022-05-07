<?php
//入库
include_once("../config.inc.php");
// 检测输入框
$class = $_COOKIE["class"];
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
$result = $conn->query( "SELECT * FROM class WHERE class='".$class."'" )->fetch_assoc();

// 获取数据
$R1_1 = $_POST["1_1"];
$R1_2 = $_POST["1_2"];
$R1_3 = $_POST["1_3"];
$R1_4 = $_POST["1_4"];
$R1_5 = $_POST["1_5"];
$R1_6 = $_POST["1_6"];
$R2_1 = $_POST["2_1"];
$R2_2 = $_POST["2_2"];
$R2_3 = $_POST["2_3"];
$R2_4 = $_POST["2_4"];
$R2_5 = $_POST["2_5"];
$R2_6 = $_POST["2_6"];
$R3_1 = $_POST["3_1"];
$R3_2 = $_POST["3_2"];
$R3_3 = $_POST["3_3"];
$R3_4 = $_POST["3_4"];
$R3_5 = $_POST["3_5"];
$R3_6 = $_POST["3_6"];
$R4_1 = $_POST["4_1"];
$R4_2 = $_POST["4_2"];
$R4_3 = $_POST["4_3"];
$R4_4 = $_POST["4_4"];
$R4_5 = $_POST["4_5"];
$R4_6 = $_POST["4_6"];
$R5_1 = $_POST["5_1"];
$R5_2 = $_POST["5_2"];
$R5_3 = $_POST["5_3"];
$R5_4 = $_POST["5_4"];
$R5_5 = $_POST["5_5"];
$R5_6 = $_POST["5_6"];
$R6_1 = $_POST["6_1"];
$R6_2 = $_POST["6_2"];
$R6_3 = $_POST["6_3"];
$R6_4 = $_POST["6_4"];
$R6_5 = $_POST["6_5"];
$R6_6 = $_POST["6_6"];
$R7_1 = $_POST["7_1"];
$R7_2 = $_POST["7_2"];
$R7_3 = $_POST["7_3"];
$R7_4 = $_POST["7_4"];
$R7_5 = $_POST["7_5"];
$R7_6 = $_POST["7_6"];
$R8_1 = $_POST["8_1"];
$R8_2 = $_POST["8_2"];
$R8_3 = $_POST["8_3"];
$R8_4 = $_POST["8_4"];
$R8_5 = $_POST["8_5"];
$R8_6 = $_POST["8_6"];
$R9_1 = $_POST["9_1"];
$R9_2 = $_POST["9_2"];
$R9_3 = $_POST["9_3"];
$R9_4 = $_POST["9_4"];
$R9_5 = $_POST["9_5"];
$R9_6 = $_POST["9_6"];
$R10_1 = $_POST["10_1"];
$R10_2 = $_POST["10_2"];
$R10_3 = $_POST["10_3"];
$R10_4 = $_POST["10_4"];
$R10_5 = $_POST["10_5"];
$R10_6 = $_POST["10_6"];


// DEBUG
if ($setting["Debug"] == TRUE) {
    echo "[DeBUG] 输出数据";
    echo "<br/>数据太多了，懒得一个个导出了" .$R1_2;
    echo "<br/>数据:" .$class;
}

// 检测是否选中班级
if (empty($class)) {
    if (!$setting["Debug"] == TRUE) {
        echo <<<EOF
        <script language="javascript">
            alert( "您未选中班级！" )
            window.location.href = "../core-teacher.php"
        </script>
        EOF;
    } else {
        echo "<br/>您未选中班级！";
    }
}
// 定义需要导入的数据 
if (mysqli_query($conn,"UPDATE class set 1_1='$R1_1',1_2='$R1_2',1_3='$R1_3',1_4='$R1_4',1_5='$R1_5',1_6='$R1_6',2_1='$R2_1',2_2='$R2_2',2_3='$R2_3',2_4='$R2_4',2_5='$R2_5',2_6='$R2_6',3_1='$R3_1',3_2='$R3_2',3_3='$R3_3',3_4='$R3_4',3_5='$R3_5',3_6='$R3_6',4_1='$R4_1',4_2='$R4_2',4_3='$R4_3',4_4='$R4_4',4_5='$R4_5',4_6='$R4_6',5_1='$R5_1',5_2='$R5_2',5_3='$R5_3',5_4='$R5_4',5_5='$R5_5',5_6='$R5_6',6_1='$R6_1',6_2='$R6_2',6_3='$R6_3',6_4='$R6_4',6_5='$R6_5',6_6='$R6_6',7_1='$R7_1',7_2='$R7_2',7_3='$R7_3',7_4='$R7_4',7_5='$R7_5',7_6='$R7_6',8_1='$R8_1',8_2='$R8_2',8_3='$R8_3',8_4='$R8_4',8_5='$R8_5',8_6='$R8_6',9_1='$R9_1',9_2='$R9_2',9_3='$R9_3',9_4='$R9_4',9_5='$R9_5',9_6='$R9_6',10_1='$R10_1',10_2='$R10_2',10_3='$R10_3',10_4='$R10_4',10_5='$R10_5',10_6='$R10_6' WHERE class='".$class."'") == true) {
    setcookie("class",$class_load,time()-1,"/");
    if (!$setting["Debug"] == TRUE) {
        echo <<<EOF
        <script language="javascript">
            alert( "成功！" )
            window.location.href = "../core-teacher.php"
        </script>
        EOF;
    } else {
        echo "<br/>数据上传成功";
    }
} else {
    if (!$setting["Debug"] == TRUE) {
        echo <<<EOF
        <script language="javascript">
            alert( "失败！" )
            window.location.href = "../core-teacher.php"
        </script>
        EOF;
    } else {
        echo "<br/>数据上传失败";
    }
};

mysqli_close($conn);
?>