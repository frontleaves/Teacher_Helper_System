<?php
// 配置链接
include('../config.inc.php');
// 邮件配置
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require './PHPMailer/src/Exception.php';
require './PHPMailer/src/PHPMailer.php';
require './PHPMailer/src/SMTP.php';

$mail = new PHPMailer(true);                              // Passing `true` enables exceptions
try {
    //服务器配置
    $mail->CharSet ="UTF-8";                     //设定邮件编码
    $mail->SMTPDebug = 0;                        // 调试模式输出
    $mail->isSMTP();                             // 使用SMTP
    $mail->Host = $setting["SMTP"]["host"];                // SMTP服务器
    $mail->SMTPAuth = $setting["SMTP"]["SMTPAuth"];                      // 允许 SMTP 认证
    $mail->Username = $setting["SMTP"]["Username"];                // SMTP 用户名  即邮箱的用户名
    $mail->Password = $setting["SMTP"]["Passwd"];             // SMTP 密码  部分邮箱是授权码(例如163邮箱)
    $mail->SMTPSecure = $setting["SMTP"]["Secure"];                    // 允许 TLS 或者ssl协议
    $mail->Port = $setting["SMTP"]["Port"];                            // 服务器端口 25 或者465 具体要看邮箱服务器支持

    $mail->setFrom($setting["SMTP"]["SendName"], $setting["SMTP"]["Nick"]);  //发件人
    $mail->addAddress($mailaddress,$mailaddress);  // 收件人
    $mail->addReplyTo($setting["SMTP"]["SendName"], $setting["SMTP"]["Nick"]); //回复的时候回复给哪个邮箱 建议和发件人一致

    // 发送内容
    // 是否以HTML文档格式发送  发送后客户端可直接显示对应HTML内容
    //$mail->isHTML(true);
    //$mail->Subject = '这里是邮件标题';
    //$mail->Body    = '<h1>这里是邮件内容</h1>' . date('Y-m-d H:i:s');
    //$mail->AltBody = '如果邮件客户端不支持HTML则显示此内容';

    //$mail->send();
    if ($setting["Debug"] == TRUE) {
        echo '邮件发送成功';
    }
} catch (Exception $e) {
    if ($setting["Debug"] == TRUE) {
        echo '邮件发送失败: ', $mail->ErrorInfo;
    }
}