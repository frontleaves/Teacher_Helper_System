<?PHP
// 启动session
session_start();
// 引入配置文件
include('../config.inc.php');

// 注册二 || 配置文件

// 变量导入
$name = $_POST[ "name" ];
$email = $_COOKIE[ "Email" ];
$email_check = $_POST[ "email_check" ];
$passwd_1 = $_POST[ "passwd-1" ];
$passwd_2 = $_POST[ "passwd-2" ];
$list = $_POST["list"];

// Debug
if ($setting["Debug"] == True) {
    echo $name . "," .$email. "," .$email_check. "," .$passwd_1. "," .$passwd_2. "," .$website;
}

// 验证注册是否符合规定
// 验证是否超时
if (!empty($_COOKIE["Email"])) {
    if ($setting["Debug"] == True) {
        echo "未超时验证成功<br/>";
    }
    // 验证邮箱验证码是否正确
    if ($_SESSION["Code"] == $email_check) {
        if ($setting["Debug"] == True) {
            echo "邮箱验证码验证成功<br/>";
        }
        // 验证密码是否一致
        if ($passwd_1 == $passwd_2) {
            if ($setting["Debug"] == True) {
                echo "密码一致验证成功<br/>";
            }
            // 默认参数
            $_SESSION['Code'] = array();
            // 链接数据库
            $conn=new MySQLi($setting["sql"]["host"],$setting["sql"]["username"],$setting["sql"]["password"],$setting["sql"]["sqlname"]);
            if ($setting["Debug"] == TRUE) {
                if($conn->connect_error){
                    die("数据库连接失败！".$conn->connect_error);
                }
            }
            $result = $conn->query( "SELECT * FROM ".$setting["sql"]["members"]." WHERE name='$name'" );

            // 密码采用hash加密
            $hash = password_hash($passwd_1, PASSWORD_DEFAULT);
            if ($setting["Debug"] == TRUE) {
                if (password_verify($passwd_1, $hash)) {
                    echo '密码正确~';
                } else {
                    echo '密码错误！';
                }
            }
            // 输入数据进入数据库
                // 如果数据成功注册
            if ($conn->query( "INSERT INTO ".$setting["sql"]["members"]."(name,email,list,password) VALUES('$name','$email','$list','$hash')" ) == True) {
                setcookie('Email', '' , time()-1 ,"/");
                $_SESSION['Code'] = array();
                setcookie( "uid", $email, time() + 86400 , "/" );
                header('location:../teacherbasic.php');
            }
        } else {
            echo <<<EOF
            <script language="javascript">
                alert( "密码不一致！" )
                window.location.href = "../auth.php?lg=register&step=2"
            </script>
            EOF;
        }
    } else {
        echo <<<EOF
        <script language="javascript">
            alert( "验证码错误！" )
            window.location.href = "../auth.php?lg=register&step=2"
        </script>
        EOF;
    }
} else {
    echo <<<EOF
    <script language="javascript">
        alert( "超时！" )
        window.location.href = "../auth.php?lg=register&step=2"
    </script>
    EOF;
}

// 关闭数据库释放内存
mysqli_free_result($result);
mysqli_close($conn);