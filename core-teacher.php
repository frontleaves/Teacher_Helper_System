<?PHP
// 开启session
session_start();
//禁用错误报告
error_reporting(0);
// 引入设置
include("./config.inc.php");
// 引入插件
include("./plugins/color.php");  // 引入主题颜色修改
include("./plugins/img.php"); // 图片库自动判断
include("./plugins/kebiao.php"); // 引入课表组件
$listfor = 2;

// 监测输入框
$class = $_COOKIE["class"];

// 检查登录是否合规
if (empty($_COOKIE["uid"])) {
  echo <<<EOF
            <script language="javascript">
                alert( "您还未登录" )
                window.location.href = "../auth.php?lg=login"
            </script>
            EOF;
}

// 链接数据库
$conn=new MySQLi($setting["sql"]["host"],$setting["sql"]["username"],$setting["sql"]["password"],$setting["sql"]["sqlname"]);
if ($setting["Debug"] == TRUE) {
    if($conn->connect_error){
        die("数据库连接失败！<br/>".$conn->connect_error);
    }
}
$email = $_COOKIE["uid"];
// 从数据库根据email调取用户信息
$results = $conn->query( "SELECT * FROM members WHERE email='$email'" )->fetch_assoc();
$result = $conn->query( "SELECT * FROM class WHERE class='$class'" )->fetch_assoc();

// 检查是否是老师
if ($results["list"] == "student") {
  header("location:./schedule.php");
}
?>
<!DOCTYPE html>
<html lang="zh-cn">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <meta name="full-screen" content="yes"><!--UC强制全屏-->
    <meta name="browsermode" content="application"><!--UC应用模式-->
    <meta name="x5-fullscreen" content="true"><!--QQ强制全屏-->
    <meta name="x5-page-mode" content="app"><!--QQ应用模式-->
  
    <!-- MDUI CSS -->
    <link
  rel="stylesheet"
  href="https://cdn.jsdelivr.net/npm/mdui@1.0.1/dist/css/mdui.min.css"
  integrity="sha384-cLRrMq39HOZdvE0j6yBojO4+1PrHfB7a9l5qLcmRm/fiWXYY+CndJPmyu5FV/9Tw"
  crossorigin="anonymous"
/>
</head>
<body class="mdui-theme-primary-<?php echo check_night_time_primary() ?> mdui-theme-accent-<?php echo check_night_time_accent() ?> padding-top mdui-appbar-with-toolbar mdui-drawer-body-left <?PHP echo check_night_black() ?>">
<!-- 页眉 -->
<?PHP include('./header.php') ?>
<?PHP include('./menu.php') ?>
<!-- 正文 -->
<div class="mdui-container">
    <div class="mdui-col-xs-12 mdui-valign mdui-m-t-1 mdui-m-y-1">
        <div class="mdui-typo mdui-center">
            <h2><?PHP echo $setting["Info"]["name"] ?> &mdash; 课表管理系统</h2>
        </div>
    </div>
</div>
<div class="mdui-col-xs-12 mdui-valign mdui-m-t-1 mdui-m-y-1">
  <div class="mdui-typo mdui-center">
    <div class="mdui-container mdui-col-xs-12 mdui-typo mdui-m-a-2">
      <form action="./plugins/class_load.php" method="post">
      <h3>选择班级</h3>
        <div class="mdui-col-xs-2">
          <select class="mdui-select" id="class" name="class" mdui-select>
            <option <?PHP if ($_COOKIE["class"] == NULL) {echo "selected";}?>>选择班级</option>
            <option value="1" <?PHP if ($_COOKIE["class"] == 1) {echo "selected";}?>>高一一班</option>
            <option value="2" <?PHP if ($_COOKIE["class"] == 2) {echo "selected";}?>>高一二班</option>
            <option value="3" <?PHP if ($_COOKIE["class"] == 3) {echo "selected";}?>>高一三班</option>
            <option value="4" <?PHP if ($_COOKIE["class"] == 4) {echo "selected";}?>>高一四班</option>
            <option value="5" <?PHP if ($_COOKIE["class"] == 5) {echo "selected";}?>>高一五班</option>
            <option value="6" <?PHP if ($_COOKIE["class"] == 6) {echo "selected";}?>>高一六班</option>
            <option value="7" <?PHP if ($_COOKIE["class"] == 7) {echo "selected";}?>>高一七班</option>
            <option value="8" <?PHP if ($_COOKIE["class"] == 8) {echo "selected";}?>>高一八班</option>
            <option value="9" <?PHP if ($_COOKIE["class"] == 9) {echo "selected";}?>>高一九班</option>
            <option value="10" <?PHP if ($_COOKIE["class"] == 10) {echo "selected";}?>>高一十班</option>
            <option value="11" <?PHP if ($_COOKIE["class"] == 11) {echo "selected";}?>>高一十一班</option>
            <option value="12" <?PHP if ($_COOKIE["class"] == 12) {echo "selected";}?>>高一十二班</option>
          </select>
        </div>
        <div class="mdui-col-xs-2">
          <button class="mdui-btn mdui-color-theme-accent mdui-ripple">确认</button>
        </div>
      </form>
    </div>
    <!-- 表格 -->
    <div class="mdui-container">
      <form action="./plugins/kebiaoupload.php" method="post">
      <button class="mdui-btn mdui-color-theme-accent mdui-ripple">提交修改</button>
    </div>
    <div class="mdui-table-fluid mdui-container mdui-typo mdui-m-a-2">
        <table class="mdui-table mdui-table-hoverable">
          <thead>
            <tr>
              <th>课时</th>
              <th>星期一</th>
              <th>星期二</th>
              <th>星期三</th>
              <th>星期四</th>
              <th>星期五</th>
              <th>星期六</th>        
            </tr>
          </thead>
          <tbody>
              <tr>
                <td>1</td>
                <td><?PHP echo kebiao("1_1") ?></td>
                <td><?PHP echo kebiao("1_2") ?></td>
                <td><?PHP echo kebiao("1_3") ?></td>
                <td><?PHP echo kebiao("1_4") ?></td>
                <td><?PHP echo kebiao("1_5") ?></td>
                <td><?PHP echo kebiao("1_6") ?></td>        
              </tr>
              <tr>
                <td>2</td>
                <td><?PHP echo kebiao("2_1") ?></td>
                <td><?PHP echo kebiao("2_2") ?></td>
                <td><?PHP echo kebiao("2_3") ?></td>
                <td><?PHP echo kebiao("2_4") ?></td>
                <td><?PHP echo kebiao("2_5") ?></td>
                <td><?PHP echo kebiao("2_6") ?></td>
              </tr>
              <tr>
                <td>3</td>
                <td><?PHP echo kebiao("3_1") ?></td>
                <td><?PHP echo kebiao("3_2") ?></td>
                <td><?PHP echo kebiao("3_3") ?></td>
                <td><?PHP echo kebiao("3_4") ?></td>
                <td><?PHP echo kebiao("3_5") ?></td>
                <td><?PHP echo kebiao("3_6") ?></td> 
              </tr>
              <tr>
                <td>4</td>
                <td><?PHP echo kebiao("4_1") ?></td>
                <td><?PHP echo kebiao("4_2") ?></td>
                <td><?PHP echo kebiao("4_3") ?></td>
                <td><?PHP echo kebiao("4_4") ?></td>
                <td><?PHP echo kebiao("4_5") ?></td>
                <td><?PHP echo kebiao("4_6") ?></td> 
              </tr>
              <tr>
                <td>5</td>
                <td><?PHP echo kebiao("5_1") ?></td>
                <td><?PHP echo kebiao("5_2") ?></td>
                <td><?PHP echo kebiao("5_3") ?></td>
                <td><?PHP echo kebiao("5_4") ?></td>
                <td><?PHP echo kebiao("5_5") ?></td>
                <td><?PHP echo kebiao("5_6") ?></td>  
              </tr>
              <tr>
                <td>6</td>
                <td><?PHP echo kebiao("6_1") ?></td>
                <td><?PHP echo kebiao("6_2") ?></td>
                <td><?PHP echo kebiao("6_3") ?></td>
                <td><?PHP echo kebiao("6_4") ?></td>
                <td><?PHP echo kebiao("6_5") ?></td>
                <td><?PHP echo kebiao("6_6") ?></td> 
              </tr>
              <tr>
                <td>7</td>
                <td><?PHP echo kebiao("7_1") ?></td>
                <td><?PHP echo kebiao("7_2") ?></td>
                <td><?PHP echo kebiao("7_3") ?></td>
                <td><?PHP echo kebiao("7_4") ?></td>
                <td><?PHP echo kebiao("7_5") ?></td>
                <td><?PHP echo kebiao("7_6") ?></td>  
              </tr>
              <tr>
                <td>8</td>
                <td><?PHP echo kebiao("8_1") ?></td>
                <td><?PHP echo kebiao("8_2") ?></td>
                <td><?PHP echo kebiao("8_3") ?></td>
                <td><?PHP echo kebiao("8_4") ?></td>
                <td><?PHP echo kebiao("8_5") ?></td>
                <td><?PHP echo kebiao("8_6") ?></td> 
              </tr>
              <tr>
                <td>9</td>
                <td><?PHP echo kebiao("9_1") ?></td>
                <td><?PHP echo kebiao("9_2") ?></td>
                <td><?PHP echo kebiao("9_3") ?></td>
                <td><?PHP echo kebiao("9_4") ?></td>
                <td><?PHP echo kebiao("9_5") ?></td>
                <td><?PHP echo kebiao("9_6") ?></td>  
              </tr>
              <tr>
                <td>10</td>
                <td><?PHP echo kebiao("10_1") ?></td>
                <td><?PHP echo kebiao("10_2") ?></td>
                <td><?PHP echo kebiao("10_3") ?></td>
                <td><?PHP echo kebiao("10_4") ?></td>
                <td><?PHP echo kebiao("10_5") ?></td>
                <td><?PHP echo kebiao("10_6") ?></td> 
              </tr>
          </tbody>
        </table>
    </div>
    </form>
<!-- 页脚 -->
<?PHP include('./foot.php'); ?>
</div>
</div>
</body>
    <!-- MDUI JavaScript -->
<script
  src="https://cdn.jsdelivr.net/npm/mdui@1.0.1/dist/js/mdui.min.js"
  integrity="sha384-gCMZcshYKOGRX9r6wbDrvF+TcCCswSHFucUzUPwka+Gr+uHgjlYvkABr95TCOz3A"
  crossorigin="anonymous"
></script>

</html>