<?PHP
// 配置函数
// 主菜单颜色配置
function check($lists){
    // 引入全局变量
    global $listfor;
    // 条件判断
    if ($listfor == $lists) {
        echo 'mdui-text-color-'; //MDUI颜色代码
        check_night_time_accent();
    }
}
// 父菜单颜色配置
function listOnL($listOn) {
    // 引入全局变量
    global $listOnL;
    // 条件判断
    if ($listOnL == $listOn) {
        echo 'mdui-text-color-'; //MDUI颜色代码
        check_night_time_accent();
    }
}
// 子菜单颜色配置
function listOn($listO) {
    // 引入全局变量
    global $listOn;
    // 条件判断
    if ($listOn == $listO) {
        echo 'mdui-text-color-'; //MDUI颜色代码
        check_night_time_accent();
    }
}
?>
<div class="mdui-drawer mdui-shadow-6 <?PHP if ($listfor == 1) {echo "mdui-drawer-close";}?> <?PHP echo check_night_black() ?>" id="menus">
    <ul class="mdui-list" mdui-collapse="{Behavior: true}">
        <a href="../teacherbasic.php">
            <li class="mdui-list-item mdui-ripple">
                <i class="mdui-list-item-icon mdui-icon material-icons <?php check(1) ?>">home</i>
                <div class="mdui-list-item-content <?php check(1) ?>">首页</div>
            </li>
        </a>
        <a href="../core-teacher.php">
            <li class="mdui-list-item mdui-ripple">
                <i class="mdui-list-item-icon mdui-icon material-icons <?php check(2) ?>">book</i>
                <div class="mdui-list-item-content <?php check(2) ?>">课程表</div>
            </li>
        </a>
        <a href="../community.php">
            <li class="mdui-list-item mdui-ripple">
                <i class="mdui-list-item-icon mdui-icon material-icons <?php check(3) ?>">tag_faces</i>
                <div class="mdui-list-item-content <?php check(3) ?>">作业布置及讨论</div>
            </li>
        </a>
        <a href="../upload.php">
            <li class="mdui-list-item mdui-ripple">
                <i class="mdui-list-item-icon mdui-icon material-icons <?php check(4) ?>">file_upload</i>
                <div class="mdui-list-item-content <?php check(4) ?>">课程资源上传</div>
            </li>
        </a>
        <a href="../info.php">
            <li class="mdui-list-item mdui-ripple">
                <i class="mdui-list-item-icon mdui-icon material-icons <?php check(100) ?>">settings</i>
                <div class="mdui-list-item-content <?php check(100) ?>">个人信息</div>
            </li>
        </a>
    </ul>
</div>