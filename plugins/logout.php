<?PHP
setcookie( "uid",'',time()-1 , "/" );
echo <<<EOF
            <script language="javascript">
                alert( "已登出！" )
                window.location.href = "../auth.php?lg=login"
            </script>
            EOF;