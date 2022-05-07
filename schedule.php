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
// 判断班级，转换格式
if ($results["class"] == "高一一班") {
  $class = "1";
} elseif ($results["class"] == "高一二班") {
  $class = "2";
} elseif ($results["class"] == "高一三班") {
  $class = "3";
} elseif ($results["class"] == "高一四班") {
  $class = "4";
} elseif ($results["class"] == "高一五班") {
  $class = "5";
} elseif ($results["class"] == "高一六班") {
  $class = "6";
} elseif ($results["class"] == "高一七班") {
  $class = "7";
} elseif ($results["class"] == "高一八班") {
  $class = "8";
} elseif ($results["class"] == "高一九班") {
  $class = "9";
} elseif ($results["class"] == "高一十班") {
  $class = "10";
}
$result = $conn->query( "SELECT * FROM class WHERE class='$class'" )->fetch_assoc();

// 检查是否是学生
if ($results["list"] == "teacher") {
  header("location:./core-teacher.php");
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
      <h3>您的班级： <?PHP echo $results["class"] ?> </h3>
    </div>
    <!-- 表格 -->
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
                <td><strong><?PHP echo $result["1_1"] ?></strong></td>
                <td><strong><?PHP echo $result["1_2"] ?></strong></td>
                <td><strong><?PHP echo $result["1_3"] ?></strong></td>
                <td><strong><?PHP echo $result["1_4"] ?></strong></td>
                <td><strong><?PHP echo $result["1_5"] ?></strong></td>
                <td><strong><?PHP echo $result["1_6"] ?></strong></td>        
              </tr>
              <tr>
                <td>2</td>
                <td><strong><?PHP echo $result["2_1"] ?></strong></td>
                <td><strong><?PHP echo $result["2_2"] ?></strong></td>
                <td><strong><?PHP echo $result["2_3"] ?></strong></td>
                <td><strong><?PHP echo $result["2_4"] ?></strong></td>
                <td><strong><?PHP echo $result["2_5"] ?></strong></td>
                <td><strong><?PHP echo $result["2_6"] ?></strong></td>
              </tr>
              <tr>
                <td>3</td>
                <td><strong><?PHP echo $result["3_1"] ?></strong></td>
                <td><strong><?PHP echo $result["3_2"] ?></strong></td>
                <td><strong><?PHP echo $result["3_3"] ?></strong></td>
                <td><strong><?PHP echo $result["3_4"] ?></strong></td>
                <td><strong><?PHP echo $result["3_5"] ?></strong></td>
                <td><strong><?PHP echo $result["3_6"] ?></strong></td> 
              </tr>
              <tr>
                <td>4</td>
                <td><strong><?PHP echo $result["4_1"] ?></strong></td>
                <td><strong><?PHP echo $result["4_2"] ?></strong></td>
                <td><strong><?PHP echo $result["4_3"] ?></strong></td>
                <td><strong><?PHP echo $result["4_4"] ?></strong></td>
                <td><strong><?PHP echo $result["4_5"] ?></strong></td>
                <td><strong><?PHP echo $result["4_6"] ?></strong></td> 
              </tr>
              <tr>
                <td>5</td>
                <td><strong><?PHP echo $result["5_1"] ?></strong></td>
                <td><strong><?PHP echo $result["5_2"] ?></strong></td>
                <td><strong><?PHP echo $result["5_3"] ?></strong></td>
                <td><strong><?PHP echo $result["5_4"] ?></strong></td>
                <td><strong><?PHP echo $result["5_5"] ?></strong></td>
                <td><strong><?PHP echo $result["5_6"] ?></strong></td>  
              </tr>
              <tr>
                <td>6</td>
                <td><strong><?PHP echo $result["6_1"] ?></strong></td>
                <td><strong><?PHP echo $result["6_2"] ?></strong></td>
                <td><strong><?PHP echo $result["6_3"] ?></strong></td>
                <td><strong><?PHP echo $result["6_4"] ?></strong></td>
                <td><strong><?PHP echo $result["6_5"] ?></strong></td>
                <td><strong><?PHP echo $result["6_6"] ?></strong></td> 
              </tr>
              <tr>
                <td>7</td>
                <td><strong><?PHP echo $result["7_1"] ?></strong></td>
                <td><strong><?PHP echo $result["7_2"] ?></strong></td>
                <td><strong><?PHP echo $result["7_3"] ?></strong></td>
                <td><strong><?PHP echo $result["7_4"] ?></strong></td>
                <td><strong><?PHP echo $result["7_5"] ?></strong></td>
                <td><strong><?PHP echo $result["7_6"] ?></strong></td>  
              </tr>
              <tr>
                <td>8</td>
                <td><strong><?PHP echo $result["8_1"] ?></strong></td>
                <td><strong><?PHP echo $result["8_2"] ?></strong></td>
                <td><strong><?PHP echo $result["8_3"] ?></strong></td>
                <td><strong><?PHP echo $result["8_4"] ?></strong></td>
                <td><strong><?PHP echo $result["8_5"] ?></strong></td>
                <td><strong><?PHP echo $result["8_6"] ?></strong></td> 
              </tr>
              <tr>
                <td>9</td>
                <td><strong><?PHP echo $result["9_1"] ?></strong></td>
                <td><strong><?PHP echo $result["9_2"] ?></strong></td>
                <td><strong><?PHP echo $result["9_3"] ?></strong></td>
                <td><strong><?PHP echo $result["9_4"] ?></strong></td>
                <td><strong><?PHP echo $result["9_5"] ?></strong></td>
                <td><strong><?PHP echo $result["9_6"] ?></strong></td>  
              </tr>
              <tr>
                <td>10</td>
                <td><strong><?PHP echo $result["10_1"] ?></strong></td>
                <td><strong><?PHP echo $result["10_2"] ?></strong></td>
                <td><strong><?PHP echo $result["10_3"] ?></strong></td>
                <td><strong><?PHP echo $result["10_4"] ?></strong></td>
                <td><strong><?PHP echo $result["10_5"] ?></strong></td>
                <td><strong><?PHP echo $result["10_6"] ?></strong></td> 
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