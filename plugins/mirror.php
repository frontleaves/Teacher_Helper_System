<?PHP
// 镜像站
function mirror() {
    global $setting;
    if ($setting["Info"]["MirrorG"] == true) {
        if ($_SERVER['SERVER_NAME'] == "127.0.0.1" or $_SERVER['SERVER_NAME'] == "localhost") {
            echo $setting["Info"]["MirrorD"];
        } else {
            echo $setting["Info"]["MirrorZ"];
        }
    } else {
        echo $setting["Info"]["MirrorZ"];
    }
}