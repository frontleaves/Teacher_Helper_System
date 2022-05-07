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
$listfor = 1;
// 定义函数
$email = $_COOKIE["uid"];

// 链接数据库
$conn=new MySQLi($setting["sql"]["host"],$setting["sql"]["username"],$setting["sql"]["password"],$setting["sql"]["sqlname"]);
if ($setting["Debug"] == TRUE) {
    if($conn->connect_error){
        die("数据库连接失败！<br/>".$conn->connect_error);
    }
}
// 从数据库根据email调取用户信息
$result = $conn->query( "SELECT * FROM members WHERE email='$email'" )->fetch_assoc();

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
<body class="mdui-theme-primary-<?php echo check_night_time_primary() ?> mdui-theme-accent-<?php echo check_night_time_accent() ?> padding-top mdui-appbar-with-toolbar <?PHP echo check_night_black() ?>">
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

<div class="mdui-container">
    <!-- 基本信息概况 -->
    <div class="mdui-col-sm-8 mdui-col-xs-12 mdui-m-y-2"> 
        <div class="mdui-btn-raised mdui-hoverable">
            <div class="mdui-container">
                <div class="mdui-typo">
                    <br />
                    <div class="mdui-typo-title"><p><i class="mdui-icon material-icons">info_outline</i> <strong>概况</strong></p></div>
                    <div class="mdui-typo-body-2 mdui-m-a-2">
                        <p><i class="mdui-icon material-icons">insert_chart</i> 职务： <?php 
                                if ($result["list"] == "teacher") {
                                    echo '<strong class="mdui-text-color-black"> 老师';
                                } else {
                                    echo '<strong class="mdui-text-color-black"> 学生';
                                }
                            ?></strong>
                        </p>
                    </div>
                    <div class="mdui-typo-body-2 mdui-m-a-2">
                        <p><i class="mdui-icon material-icons">assessment</i> <?PHP 
                            if ($result["list"] == "teacher") {
                                echo "任教班级：";
                            } else {
                                echo "所属班级";
                            }
                            if ($result["class"] == NULL) {
                                echo '<strong class="mdui-text-color-red"> 暂未分配班级';
                            } else {
                                echo '<strong class="mdui-text-color-black"> ' . $result["class"] ;
                            }
                        ?></strong></p>
                    </div>
                    <div class="mdui-typo-title"><p><i class="mdui-icon material-icons">info_outline</i> <strong>账户信息</strong></p></div>
                    <div class="mdui-typo-body-2 mdui-m-a-2">
                        <p><i class="mdui-icon material-icons">account_circle</i> 邮箱：<strong class="mdui-text-color-black"><?php echo $_COOKIE["uid"] ?></strong></p>
                    </div>
                    <div class="mdui-typo-body-2 mdui-m-a-2">
                        <p><i class="mdui-icon material-icons">person</i> 用户名（昵称）：<strong class="mdui-text-color-black"><?php echo $result["name"] ?></strong></p>
                    </div>
                    <br />
                </div>
            </div>
        </div>
    </div>
    <!-- 自己的信息 -->
    <div class="mdui-col-sm-4 mdui-col-xs-6 mdui-m-y-2">
        <div class="mdui-card mdui-hoverable mdui-hidden-sm-down">
            <!-- 卡片头部，包含头像、标题、副标题 -->
            <div class="mdui-card-header">
                <img class="mdui-card-header-avatar" src="./src/img/icon.jpg"/>
                <div class="mdui-card-header-title"><?PHP
                                echo "你好 " . $result["name"];
                                ?></div>
                <div class="mdui-card-header-subtitle"><?PHP echo $result["email"] ?></div>
            </div>
            <!-- 卡片的媒体内容，可以包含图片、视频等媒体内容，以及标题、副标题 -->
            <div class="mdui-card-media">
                <img src="../src/img/background.webp"/>
                <!-- 卡片中可以包含一个或多个菜单按钮 
                <div class="mdui-card-menu">
                    <button class="mdui-btn mdui-btn-icon mdui-text-color-white"><i class="mdui-icon material-icons">share</i></button>
                </div>-->
            </div>
            <!-- 卡片的内容 -->
            <!-- 进度指示器
            <div class="mdui-progress">
                <div class="mdui-progress-determinate" style="width: 100%;"></div>
            </div> -->
            <div class="mdui-card-content">
                <?PHP 
                if ($result["info"] == NULL) {
                    echo "用户暂无介绍";
                } else {
                    echo $result["info"];
                }
                ?>
            </div>
            <!-- 卡片的按钮 -->
            <div class="mdui-card-actions">
                <a href="./info.php"><button class="mdui-btn mdui-ripple mdui-text-color-black">修改信息</button></a>
                <a href="../plugins/logout.php"><button class="mdui-btn mdui-ripple mdui-text-color-red">退出登录</button></a>
                <!-- <button class="mdui-btn mdui-btn-icon mdui-float-right"><i class="mdui-icon material-icons">expand_more</i></button> -->
            </div>
        </div>
    </div>
</div>
<!-- 页脚 -->
<?PHP include('./foot.php'); ?>
</body>
    <!-- MDUI JavaScript -->
<script
  src="https://cdn.jsdelivr.net/npm/mdui@1.0.1/dist/js/mdui.min.js"
  integrity="sha384-gCMZcshYKOGRX9r6wbDrvF+TcCCswSHFucUzUPwka+Gr+uHgjlYvkABr95TCOz3A"
  crossorigin="anonymous"
></script>

</html>
<?PHP
// 关闭数据库释放内存
mysqli_close($conn);
?>