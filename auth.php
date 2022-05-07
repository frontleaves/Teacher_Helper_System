<?PHP
// 开启session
session_start();
// 禁用错误报告
error_reporting(0);
// 引入设置
include("./config.inc.php");
include("./plugins/mirror.php");
// 配置
$lg=htmlspecialchars($_GET["lg"]);
$step = htmlspecialchars($_GET["step"]);
?>
<!DOCTYPE html>
<html lang="zh-cn">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?PHP echo $setting["Info"]["name"]; ?> | 登陆系统</title>
    <!-- CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/mdui@1.0.1/dist/css/mdui.min.css" integrity="sha384-cLRrMq39HOZdvE0j6yBojO4+1PrHfB7a9l5qLcmRm/fiWXYY+CndJPmyu5FV/9Tw" crossorigin="anonymous"/>
</head>
<body  class="mdui-theme-primary-blue mdui-theme-accent-blue">
<!-- 标题 -->
<div class="mdui-container">
    <div class="mdui-col-xs-12 mdui-valign mdui-m-t-1 mdui-m-y-1">
        <div class="mdui-typo mdui-center">
            <h2 class="mdui-text-center" style="font-size: 36px"><?PHP echo $setting["Info"]["name"] ?> &mdash; 终端登录系统</h2>
        </div>
    </div>
</div>
<br/>
<br/>
<br/>
<br/>
<?PHP
if (isset($_COOKIE["uid"])==False) {
    if (empty($lg) or $lg=="login") {
?>
<!-- 登录复选框 -->
<div class="mdui-container mdui-valign">
	<div class="mdui-center">
		<form action="./plugins/login.php" method="post">
			<div class="mdui-textfield mdui-textfield-floating-label">
				<i class="mdui-icon material-icons">account_circle</i>
				<label class="mdui-textfield-label">邮箱</label>
				<input class="mdui-textfield-input" type="text" name="email" id="email" required></input>
			</div>
			<div class="mdui-textfield mdui-textfield-floating-label">
				<i class="mdui-icon material-icons">lock</i>
				<label class="mdui-textfield-label">密码</label>
				<input class="mdui-textfield-input" type="password" id="passwd" name="passwd" required></input>
			</div>
            <br/>
            <label class="mdui-checkbox">
                <input type="checkbox" id="sevenmian" name="sevenmian"/>
                <i class="mdui-checkbox-icon"></i>
                七日免登录
            </label>
            <br/>
			<p><input name="button" type="submit" class="mdui-center mdui-btn mdui-btn-raised mdui-ripple mdui-color-theme-accent" id="email" value="提交">
			</p>
		</form>
		<div class="mdui-typo mdui-text-right">
			<a href="?lg=register&step=1">还没账号，点击注册 </a>
		</div>
	</div>
</div>
<?PHP
    } else {
        if (empty($step) or $step=="1") {
?>
<!-- 登录复选框 -->
<div class="mdui-container mdui-valign">
	<div class="mdui-center">
		<form action="./plugins/register-email.php" method="post">
            <h3>注册 (1)：</h3>
			<div class="mdui-textfield mdui-textfield-floating-label">
				<i class="mdui-icon material-icons">account_circle</i>
				<label class="mdui-textfield-label">邮箱</label>
				<input class="mdui-textfield-input" type="text" name="email" id="email" required></input>
			</div>
            <br/>
			<p><input name="button" type="submit" class="mdui-center mdui-btn mdui-btn-raised mdui-ripple mdui-color-theme-accent" id="email" value="下一步">
			</p>
		</form>
		<div class="mdui-typo mdui-text-right">
			<a href="?lg=login">已有账号，点击登录</a>
		</div>
	</div>
</div>
<?PHP
        } else {
            // 验证是否收到验证码与是否超时
            if (empty($_SESSION['Code']) or empty($_COOKIE["Email"])) {
                setcookie('Email', '' , time()-1 ,"/");
                $_SESSION['Code'] = array();
                header('location:?lg=register&step=1');
            }
?>
<div class="mdui-container mdui-valign">
	<div class="mdui-center">
		<form action="./plugins/register.php" method="post">
            <h3>注册 (2)：</h3>
			<div class="mdui-textfield mdui-textfield-floating-label">
				<i class="mdui-icon material-icons">account_circle</i>
				<label class="mdui-textfield-label">用户名(昵称) <font color="red">*</font></label>
				<input class="mdui-textfield-input" type="text" name="name" id="name" required></input>
			</div>
			<div class="mdui-textfield mdui-textfield-floating-label">
				<i class="mdui-icon material-icons">lock</i>
				<label class="mdui-textfield-label">密码  <font color="red">*</font></label>
				<input class="mdui-textfield-input" type="password" id="passwd-1" name="passwd-1" required></input>
			</div>
            <div class="mdui-textfield mdui-textfield-floating-label">
				<i class="mdui-icon material-icons">lock</i>
				<label class="mdui-textfield-label">再次输入密码  <font color="red">*</font></label>
				<input class="mdui-textfield-input" type="password" id="passwd-2" name="passwd-2" required></input>
			</div>
            <div class="">
                <label class="mdui-radio mdui-m-a-1">
                    <input type="radio" id="list" name="list" value="student" checked/>
                    <i class="mdui-radio-icon"></i>
                    学生
                </label>
                <label class="mdui-radio mdui-m-a-1">
                    <input type="radio" id="list" name="list" value="teacher"/>
                    <i class="mdui-radio-icon"></i>
                    老师
                </label>
            </div>
			<div class="mdui-textfield mdui-textfield-floating-label">
				<i class="mdui-icon material-icons">mail</i>
				<label class="mdui-textfield-label">邮箱验证码 <font color="red">*</font></label>
				<input class="mdui-textfield-input" name="email_check" type="text" id="email_check" required></input>
			</div>
			<p><input name="button" type="submit" class="mdui-center mdui-btn mdui-btn-raised mdui-ripple mdui-color-theme-accent" id="email" value="提交">
			</p>
		</form>
		<div class="mdui-typo mdui-text-right">
			<a  href="./plugins/register-email.php">未收到邮件？</a>
		</div>
        <div class="mdui-typo mdui-text-right">
			<a  href="?lg=login">已有账号，点击登录</a>
		</div>
	</div>
</div>
<?PHP
        } 
    }
} else {
    echo <<<EOF
            <script language="javascript">
                alert( "您已经登录" )
                window.location.href = "../teacherbasic.php"
            </script>
            EOF;
}
?>
<!-- 页脚 -->
<?PHP include('./foot.php'); ?>
</body>
<!-- JavaScript -->
<script src="https://cdn.jsdelivr.net/npm/mdui@1.0.1/dist/js/mdui.min.js" integrity="sha384-gCMZcshYKOGRX9r6wbDrvF+TcCCswSHFucUzUPwka+Gr+uHgjlYvkABr95TCOz3A" crossorigin="anonymous"></script>
</html>