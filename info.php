<?PHP
// 开启session
session_start();
// 引入设置
include_once("./config.inc.php");
// 引入插件
include("./plugins/color.php");  // 引入主题颜色修改
// 引入数据库
// 链接数据库
$conn=new MySQLi($setting["sql"]["host"],$setting["sql"]["username"],$setting["sql"]["password"],$setting["sql"]["sqlname"]);
if ($setting["Debug"] == TRUE) {
    if($conn->connect_error){
        die("数据库连接失败！<br/>".$conn->connect_error);
    }
}
$email = $_COOKIE["uid"];
// 从数据库根据email调取用户信息
$result = $conn->query( "SELECT * FROM members WHERE email='$email'" )->fetch_assoc();

$listfor = 100;
// 参数
$hyo = $setting["sql"]["authme"];
$Essentials = $setting["sql"]["Essentials"];
$playerpoints = $setting["sql"]["playerpoints"];
$Web = $setting["sql"]["web"];
$username = $_COOKIE["username"];
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
    <meta name="viewport" content="width=device-width, initial-sclae=1.0">
    <meta name="full-screen" content="yes"><!--UC强制全屏-->
    <meta name="browsermode" content="application"><!--UC应用模式-->
    <meta name="x5-fullscreen" content="true"><!--QQ强制全屏-->
    <meta name="x5-page-mode" content="app"><!--QQ应用模式-->
    <!-- 主要 -->
    <title>后台 &mdash; <?PHP echo $setting["Info"]["name"] ?></title>
    <link rel="shortcut icon" href="<?php echo $setting["Web"]["Icon"] ?>" type="image/x-icon">
    <!-- MDUI CSS -->
    <link
  rel="stylesheet"
  href="https://cdn.jsdelivr.net/npm/mdui@1.0.1/dist/css/mdui.min.css"
  integrity="sha384-cLRrMq39HOZdvE0j6yBojO4+1PrHfB7a9l5qLcmRm/fiWXYY+CndJPmyu5FV/9Tw"
  crossorigin="anonymous"
/>
</head>
<body class="mdui-theme-primary-<?php echo check_night_time_primary() ?> mdui-theme-accent-<?php echo check_night_time_accent() ?> padding-top mdui-appbar-with-toolbar mdui-drawer-body-left <?PHP echo check_night_black() ?>">
<!-- TAB及菜单 -->
<!-- 顶部TAB -->
<?PHP include('./header.php') ?>
<!-- 菜单 -->
<?PHP include('./menu.php') ?>
<!-- 右上角菜单 -->
<!-- 正文 -->
<div class="mdui-container">
    <div class="mdui-col-xs-12 mdui-valign mdui-m-t-1 mdui-m-b-1">
        <div class="mdui-typo mdui-center">
            <h2><?PHP echo $setting["Info"]["name"] ?> &mdash; 设置修改</h2>
        </div>
    </div>
</div>
<div class="mdui-container">
    <div class="mdui-col-xs-12 mdui-m-y-5"> 
        <div class="mdui-btn-raised mdui-hoverable">
            <div class="mdui-container mdui-valign">
                <div class="mdui-typo mdui-col-xs-10 mdui-center">
                    <br />
                    <form action="../plugins/infoupload.php" method="post">
                        <div class="mdui-typo-title mdui-m-y-2"><p><i class="mdui-icon material-icons">device_hub</i> <strong>基本信息</strong></p></div>
                        <div class="mdui-m-y-1">
                            <div class="mdui-col-xs-4 mdui-typo-body-2">
                                <p><i class="mdui-icon material-icons">account_circle</i> <strong>用户昵称</strong></p>
                            </div>
                            <div class="mdui-col-xs-8 mdui-textfield ">
                                <input class="mdui-textfield-input" type="text" name="name" id="name" value="<?PHP echo $result["name"] ?>"/>
                            </div>
                        </div>
                        <div class="mdui-m-y-1">
                            <div class="mdui-col-xs-4 mdui-typo-body-2">
                                <p><i class="mdui-icon material-icons">account_circle</i> <strong>个人序列号</strong></p>
                            </div>
                            <div class="mdui-col-xs-8 mdui-textfield ">
                                <input class="mdui-textfield-input" type="text" name="uuid" id="uuid" value="<?PHP echo $result["uid"] ?>" disabled/>
                            </div>
                        </div>
                        <div class="mdui-m-y-1">
                            <div class="mdui-col-xs-4 mdui-typo-body-2">
                                <p><i class="mdui-icon material-icons">info_outline</i> <strong>一句话介绍</strong></p>
                            </div>
                            <div class="mdui-col-xs-8 mdui-textfield ">
                                <input class="mdui-textfield-input" type="text" name="info" id="info" placeholder="例如：我是一个品学兼优的学生/我是一个负责任的老师" value="<?PHP echo $result["info"] ?>"/>
                            </div>
                        </div>
                        <div class="mdui-m-y-1">
                            <div class="mdui-col-xs-4 mdui-typo-body-2">
                                <p><i class="mdui-icon material-icons">assessment</i> <strong>班级</strong></p>
                            </div>
                                <select class="mdui-col-xs-8 mdui-textfield mdui-select" id="classes" name="classes" mdui-select>
                                    <option value="NULL" <?PHP if ($result["class"] == NULL) {echo "selected";}?>>未选择</option>
                                    <option value="高一一班" <?PHP if ($result["class"] == "高一一班") {echo "selected";}?>>高一一班</option>
                                    <option value="高一二班" <?PHP if ($result["class"] == "高一二班") {echo "selected";}?>>高一二班</option>
                                    <option value="高一三班" <?PHP if ($result["class"] == "高一三班") {echo "selected";}?>>高一三班</option>
                                    <option value="高一四班" <?PHP if ($result["class"] == "高一四班") {echo "selected";}?>>高一四班</option>
                                    <option value="高一五班" <?PHP if ($result["class"] == "高一五班") {echo "selected";}?>>高一五班</option>
                                    <option value="高一六班" <?PHP if ($result["class"] == "高一六班") {echo "selected";}?>>高一六班</option>
                                    <option value="高一七班" <?PHP if ($result["class"] == "高一七班") {echo "selected";}?>>高一七班</option>
                                    <option value="高一八班" <?PHP if ($result["class"] == "高一八班") {echo "selected";}?>>高一八班</option>
                                    <option value="高一九班" <?PHP if ($result["class"] == "高一九班") {echo "selected";}?>>高一九班</option>
                                    <option value="高一十班" <?PHP if ($result["class"] == "高一十班") {echo "selected";}?>>高一十班</option>
                                    <option value="高一十一班" <?PHP if ($result["class"] == "高一十一班") {echo "selected";}?>>高一十一班</option>
                                    <option value="高一十二班" <?PHP if ($result["class"] == "高一十二班") {echo "selected";}?>>高一十二班</option>
                                </select>
                        </div>
                        <div class="mdui-typo-title mdui-m-y-2"><p><i class="mdui-icon material-icons">device_hub</i> <strong>联系方式</strong></p></div>
                        <div class="mdui-m-y-1">
                            <div class="mdui-col-xs-4 mdui-typo-body-2">
                                <p><i class="mdui-icon material-icons">hearing</i> <strong>QQ</strong></p>
                            </div>
                            <div class="mdui-col-xs-8 mdui-textfield ">
                                <input class="mdui-textfield-input" type="text" name="qq" id="qq" placeholder="例如：1817165707" value="<?PHP echo $result["qq"] ?>"/>
                            </div>
                        </div>
                        <div class="mdui-m-y-1">
                            <div class="mdui-col-xs-4 mdui-typo-body-2">
                                <p><i class="mdui-icon material-icons">email</i> <strong>邮箱</strong></p>
                            </div>
                            <div class="mdui-col-xs-8 mdui-textfield ">
                                <input class="mdui-textfield-input" type="email" name="email" id="email" value="<?PHP echo $result["email"] ?>" disabled/>
                            </div>
                        </div>
                        <div class="mdui-m-y-1">
                            <div class="mdui-col-xs-4 mdui-typo-body-2">
                                <p><i class="mdui-icon material-icons">phone</i> <strong>手机</strong></p>
                            </div>
                            <div class="mdui-col-xs-8 mdui-textfield ">
                                <input class="mdui-textfield-input" type="text" name="tel" id="tel" placeholder="例：133****5865" value="<?PHP echo $result["phone"] ?>"/>
                            </div>
                        </div>
                        <br />
						<div class="mdui-m-s-4">
                            <input name="button" type="submit" class="mdui-center mdui-btn mdui-btn-raised mdui-ripple mdui-color-theme-accent" id="button" value="提交">
						</div>
					</form>
                    <br />
                </div>
            </div>
        </div>
    </div>
</div>
<!-- 页脚版权内容 -->
<?PHP include("./foot.php") ?>
</body>
<!-- MDUI JavaScript -->
<script
  src="https://cdn.jsdelivr.net/npm/mdui@1.0.1/dist/js/mdui.min.js"
  integrity="sha384-gCMZcshYKOGRX9r6wbDrvF+TcCCswSHFucUzUPwka+Gr+uHgjlYvkABr95TCOz3A"
  crossorigin="anonymous"
></script>
</html>
<?PHP
// mysqli_free_result($result);
mysqli_close($conn);
?>