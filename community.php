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
$listfor = 3;

// 检查登录是否合规
if (empty($_COOKIE["uid"])) {
  echo <<<EOF
            <script language="javascript">
                alert( "您还未登录" )
                window.location.href = "../auth.php?lg=login"
            </script>
            EOF;
}
?>
<!DOCTYPE html>
<html lang="zh-cn">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <script src="./src/js/waline.js"></script>
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
<div class="mdui-container">
  <div class="mdui-col-xs-12 mdui-valign mdui-m-t-1 mdui-m-y-1">
      <div class="mdui-typo mdui-center">
          <h2><?PHP echo $setting["Info"]["name"] ?> &mdash; 作业布置及讨论</h2>
      </div>
  </div>
</div>
    <div class="mdui-container" id="waline"></div>
    <script>
        Waline({
          el: '#waline',
          serverURL: 'https://ths-xi.vercel.app/',
        });
      </script>
<!-- 页脚 -->
<?PHP include('./foot.php'); ?>
</body>
</html>