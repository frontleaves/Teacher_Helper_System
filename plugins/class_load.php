<?php
//入库
include_once("../config.inc.php");

// 到数据
$class_load = $_POST["class"];

// 设置2小时COOKIE
setcookie("class",$class_load,time()+60*60*2,"/");

header("location:../core-teacher.php");