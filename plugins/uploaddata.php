<?php
//引入插件
$listOnL = 4;

if ($_FILES["file"]["error"] > 0)
    {
        echo "错误：" . $_FILES["file"]["error"] . "<br/>";
    } else {
        echo "上传文件名: " . $_FILES["file"]["name"] . "<br/>";
        echo "文件类型: " . $_FILES["file"]["type"] . "<br/>";
        echo "文件大小: " . ($_FILES["file"]["size"] / 1024) . " kB<br/>";
        echo "文件临时存储的位置: " . $_FILES["file"]["tmp_name"] . "<br/>";
    }

if (file_exists("../upload/" . $_FILES["file"]["name"]))
    {
        echo <<<EOF
        <script language="javascript">
            alert( "已有该文件，请重命名！" )
            window.location.href = "../upload.php"
        </script>
        EOF;
    } else {
        move_uploaded_file($_FILES["file"]["tmp_name"], "../upload/" . $_FILES["file"]["name"]);
        echo "  文件存储在: " . "../upload/" . $_FILES["file"]["name"];
        echo <<<EOF
            <script language="javascript">
                alert( "上传成功！" )
                window.location.href = "../upload.php"
            </script>
            EOF;
    }
?>