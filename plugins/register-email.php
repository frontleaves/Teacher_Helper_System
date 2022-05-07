<?PHP
// 启动session
session_start();
    // 默认参数
    $_SESSION['Code'] = array();
    // 定义时间
    session_set_cookie_params(15*60);
// 引入配置文件
include('../config.inc.php');

// 注册一 || 配置文件
// 获取表信息
$oauth_callback = htmlspecialchars($_GET["oauth_callback="]);
// 检查COOKIE信息是否存在
if (empty($_COOKIE['Email'])) {
    // 若不存在，检查POST是否发送内容（若无）
    if (empty($_POST[ "email" ])) {
        setcookie('Email', '' , time()-1 ,"/");
        $_SESSION['Code'] = array();
        header('location:../auth.php?lg=register&step=1');
    // 否则记录变量
    } else {
        $email = $_POST[ "email" ];
        // 输出变量
        $mailaddress = $email;
    }
// 如果COOKIE存在，并且函数为@（防止因为错误保存COOKIE）
} elseif ($_COOKIE['Email'] == "@") {
    setcookie('Email', '' , time()-1 ,"/");
    $_SESSION['Code'] = array();
    header('location:../auth.php?lg=register&step=1');
// 若有正确COOKIE则重新发送邮件
} else {
    $mailaddress = $_COOKIE['Email'];
}
// 验证码，并生成SESSION
$yanzheng = rand('100000','999999');
    // 将生成的随机数载入SESSION内
    $_SESSION['Code'] = $yanzheng;
// 注册邮箱
setcookie('Email', $mailaddress , time()+15*60 ,"/");
// 邮件发送
//引入邮件配置
include('./mailer.php');
// 是否允许HTML格式发送
$mail->isHTML(true);
// 邮件标题
$mail->Subject = 'X-LF登录系统 —— 注册验证码';
// 邮件内容
$mail->Body = '<h2>您好：</h2>'. $mailaddress . ' 用户<br/>感谢您注册X-LF！<br/>您的验证码为：<h2><strong>' . $yanzheng . '</strong></h2><br/>请您在15分钟内完成注册。<br/>若您未在此申请注册，请忽略信息即可<br/><br/>筱锋xiao_lfeng技术中心 —— 致';
// 若邮件不支持显示HTML则显示该内容
$mail->AltBody = 'X-LF登录系统 —— 注册验证码';
// 发送邮件
$mail->send();
// 返回内容
if ($setting['Debug'] == false) {
    header('location:../auth.php?lg=register&step=2&'.$oauth_callback);
}
