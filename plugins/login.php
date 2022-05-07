<?PHP
// 启动session
session_start();
// 引入配置文件
include('../config.inc.php');

// 注册二 || 配置文件

// 变量导入
$email = $_POST[ "email" ];
$passwd = $_POST[ "passwd" ];
$sevenmian = $_POST[ "sevenmian" ];
//数据整合
$mailaddress = $email;

// Debug
if ($setting["Debug"] == True) {
    echo $mailaddress . "," .$passwd. "," .$sevenmian. "<br/>";
}

// 登录数据库
// 链接数据库
$conn=new MySQLi($setting["sql"]["host"],$setting["sql"]["username"],$setting["sql"]["password"],$setting["sql"]["sqlname"]);
if ($setting["Debug"] == TRUE) {
    if($conn->connect_error){
        die("数据库连接失败！<br/>".$conn->connect_error);
    }
}
$result = $conn->query( "SELECT * FROM members WHERE email='$mailaddress'" )->fetch_assoc();

// 登陆验证
if (password_verify($passwd, $result["password"])) {
    // 判断七日免登
    if (empty($sevenmian)) {
        if ($setting["Debug"] == TRUE) {
            echo "未勾选7日免登<br/>";
        }
        setcookie( "uid",$mailaddress,time()+86400 , "/" );
    } else {
        if ($setting["Debug"] == TRUE) {
            echo "勾选7日免登<br/>";
        }
        setcookie( "uid",$mailaddress,time()+604800 , "/" );
    }
    // 转出数据
    if ($setting["Debug"] == TRUE) {
        echo "密码验证成功<br/>";
    } else {
        // 跳转数据
        header('location:../teacherbasic.php');
    }
} else {
    if ($setting["Debug"] == TRUE) {
        if ($setting["Debug"] == TRUE) {
            echo "密码验证失败<br/>";
        }
    } else {
        echo <<<EOF
            <script language="javascript">
                alert( "密码错误！" )
                window.location.href = "../auth.php?lg=login"
            </script>
            EOF;
    }
} 

// 关闭数据库释放内存
mysqli_close($conn);