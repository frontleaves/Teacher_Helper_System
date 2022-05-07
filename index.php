<?PHP
// 开启session
session_start();
// 禁用错误报告
error_reporting(0);
// 检测
// 登陆检测
if (isset($_COOKIE["uid"])==False) {
    header("location:auth.php");
} else {
    header("location:./teacherbasic.php");
}