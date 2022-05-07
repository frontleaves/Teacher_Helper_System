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
$listfor = 4;
?>
<!DOCTYPE html>
<html lang="zh-cn">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="full-screen" content="yes"><!--UC强制全屏-->
    <meta name="browsermode" content="application"><!--UC应用模式-->
    <meta name="x5-fullscreen" content="true"><!--QQ强制全屏-->
    <meta name="x5-page-mode" content="app"><!--QQ应用模式-->
    <!-- QQ标签识别 -->
    <meta itemprop="name" content="<?php echo $setting["Info"]["name"] ?>">
    <meta name="description" itemprop="description" content="<?php echo $setting["INFO"]["subname"] ?>">
    <meta itemprop="image" content="<?php echo $setting["Web"]["Icon"] ?>">
    <!-- 主要 -->
    <title><?PHP echo $setting["Info"]["name"] ?> &mdash; <?PHP echo $setting["Info"]["subname"] ?></title>
    <link rel="shortcut icon" href="<?php echo $setting["Web"]["Icon"] ?>" type="image/x-icon">
    <!-- MDUI CSS -->
    <link
  rel="stylesheet"
  href="https://cdn.jsdelivr.net/npm/mdui@1.0.1/dist/css/mdui.min.css"
  integrity="sha384-cLRrMq39HOZdvE0j6yBojO4+1PrHfB7a9l5qLcmRm/fiWXYY+CndJPmyu5FV/9Tw"
  crossorigin="anonymous"
/>
</head>
<body class="mdui-theme-primary-light-green mdui-theme-accent-blue padding-top mdui-appbar-with-toolbar mdui-drawer-body-left mdui-valign ">
<div class="mdui-valign">
  <p class="mdui-center"></p>
</div>
<!-- 页眉 -->
<?PHP include('./header.php') ?>
<?PHP include('./menu.php') ?>
<!-- 正文 -->
<!-- 将标题和上传组件放在一组 -->
<div class="mdui-col-xs-12"> <!-- 设置其 12 列网格布局系统 -->
    <div class="mdui-container">
        <div class="mdui-col-xs-12 mdui-valign"> <!-- 当一次性占满12列自动换行 -->
            <div class="mdui-typo mdui-center mdui-m-y-4">
                <h1><?PHP echo $setting["Info"]["name"] ?> <?PHP echo $setting["Info"]["subname"] ?></h1>
            </div>
        </div>
    </div>
    <!-- 表单 -->
    <div class="mdui-container">
        <div class="mdui-col-xs-12 mdui-valign"> <!-- 当一次性占满12列自动换行 -->
            <div class="mdui-typo mdui-center mdui-m-y-4">
                <form action="./plugins/uploaddata.php" method="post" enctype="multipart/form-data">
                    <div class="mdui-m-a-1">
                        <div class="mdui-card"> <!-- 以卡片形式展示 -->
                            <div class="mdui-card-content mdui-typo"> <!-- 分组 -->
                                <div class="mdui-container mdui-col-xs-12 mdui-m-a-1"> <!-- 分别归一组 -->
                                    <h3 class="mdui-col-xs-6">文件名：</h3>
                                </div>
                                <div class="mdui-container mdui-col-xs-12 mdui-m-a-1 mdui-m-y-4"> <!-- 分别归一组 -->
                                    <input class="mdui-col-xs-6" type="file" name="file" id="file">
                                </div>
                                <div class="mdui-container mdui-m-a-1"> <!-- 分别归一组 -->
                                    <button class="mdui-btn mdui-color-theme-accent mdui-ripple">提交</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>


<div class="mdui-container">
<div class="mdui-col-xs-12 mdui-valign"> <!-- 当一次性占满12列自动换行 -->
    <div class="mdui-typo mdui-center mdui-m-y-4">
        <form action="./plugins/uploaddata.php" method="post" enctype="multipart/form-data">
            <div class="mdui-m-a-1">
                <div class="mdui-card"> <!-- 以卡片形式展示 -->
                    <div class="mdui-card-content mdui-typo"> <!-- 分组 -->
<?php
    $handle=opendir('./upload');
    while($dir = readdir($handle))
    {
        ?>
        <tr>
            <?PHP
            //过滤当前文件夹和父文件
            if($dir == '.' || $dir == '..' )
            {
                continue;
            }
            $str = str_replace('.8','',$dir);
            ?>
            <td><strong><?PHP echo " ".$str." "; ?></strong></td>
            <td><?PHP $a=file('./upload/'.$str.'.*');$strs = str_replace('#### 作者: ','',$a[2]);echo $strs?></td>
            <td class="mdui-hidden-sm-down"><?PHP $b=file('./upload/'.$str.'.*');$strss = str_replace('#### 学习时期: ','',$b[6]);echo $strss?></td>
            <td><a href="<?PHP echo $str ?>"><button class="mdui-btn mdui-btn-raised mdui-btn-dense mdui-color-theme-accent mdui-ripple">下载</button></a></td>
        </tr>
    <?PHP
    }
    ?>
            </tbody>
        </table>
    </div>
</div>
<!-- 页脚版权内容 -->
<?PHP include("./footer.html") ?>
</body>
<!-- MDUI JavaScript -->
<script
    src="https://cdn.jsdelivr.net/npm/mdui@1.0.1/dist/js/mdui.min.js"
    integrity="sha384-gCMZcshYKOGRX9r6wbDrvF+TcCCswSHFucUzUPwka+Gr+uHgjlYvkABr95TCOz3A"
    crossorigin="anonymous"
></script>
</html>