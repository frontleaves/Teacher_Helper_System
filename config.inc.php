<?php


//初始化
$setting = array();

/* ----------------------------  WEB控制  ----------------------------- */
// 网站DeBUG模式
$setting["Debug"] = false;
// 闭站
$setting["STOP"] = false;
// 禁止接入管理员后台
$setting["Admin"] = false;

/* ----------------------------  WEB页面信息  ----------------------------- */
// ICO
$setting["Web"]["Icon"] = "../sources/img/favicon.png";
// 主题颜色（主颜色）
$setting["Web"]["color"] = "light-green";
// 主题颜色（次颜色）
$setting["Web"]["subcolor"] = "blue";

/* ----------------------------  网站信息  ----------------------------- */
// 网站名字
$setting["Info"]["name"] = "教师辅助管理系统";
// 网站描述
$setting["Info"]["subname"] = "教师辅助管理系统";
// 主网站地址
$setting["Info"]["Web"] = "http://127.0.0.1:1000/";

// 是否开启镜像站双配置
$setting["Info"]["MirrorG"] = true;
// 源码镜像站（公开）
$setting["Info"]["MirrorZ"] = "https://m.cdn.chs.pub/";
// 源码镜像站（开发,测试）
$setting["Info"]["MirrorD"] = "https://tc.cdn.chs.pub/";

/* ----------------------------  数据库连接  ----------------------------- */
// 数据库地址
$setting["sql"]["host"] = "127.0.0.1";
// 数据库用户名
$setting["sql"]["username"] = "root";
// 数据库连接密码
$setting["sql"]["password"] = "123456";
// 数据库名
$setting["sql"]["sqlname"] = "test";
// 数据库端口（不填写默认3306）
$setting["sql"]["port"] = "3306";
// 数据表相关
// 用户注册/登录/查询数据表
$setting["sql"]["members"] = "members";

/* ----------------------------  SMTP数据信息  ----------------------------- */
// SMTP服务器地址
$setting["SMTP"]["host"] = "";
// 允许 SMTP 认证
$setting["SMTP"]["SMTPAuth"] = TRUE;
// smtp登录的账号
$setting["SMTP"]["Username"] = "";
// 输入密码或者（腾讯等）授权码
$setting["SMTP"]["Passwd"] = "";
// 发件名称
$setting["SMTP"]["SendName"] = "";
// 发件昵称
$setting["SMTP"]["Nick"] = "X-LF技术部";
// 加密模式（允许TLS或者SSL）
$setting["SMTP"]["Secure"] = "tls";
// 端口25或465
$setting["SMTP"]["Port"] = 25;
