<?PHP
function kebiao($KB) {
    global $result;
    echo '<select class="mdui-select" id="'.$KB.'" name="'.$KB.'" mdui-select>';
    echo '<option value="语文" ';
        if ($result[$KB] == "语文") {
            echo "selected";
        }
    echo '>语文</option>';
    echo '<option value="数学" ';
        if ($result[$KB] == "数学") {
            echo "selected";
        }
    echo '>数学</option>';
    echo '<option value="英语" ';
        if ($result[$KB] == "英语") {
            echo "selected";
        }
    echo '>英语</option>';
    echo '<option value="物理" ';
        if ($result[$KB] == "物理") {
            echo "selected";
        }
    echo '>物理</option>';
    echo '<option value="化学" ';
        if ($result[$KB] == "化学") {
            echo "selected";
        }
    echo '>化学</option>';
    echo '<option value="生物" ';
        if ($result[$KB] == "生物") {
            echo "selected";
        }
    echo '>生物</option>';
    echo '<option value="地理" ';
        if ($result[$KB] == "地理") {
            echo "selected";
        }
    echo '>地理</option>';
    echo '<option value="政治" ';
        if ($result[$KB] == "政治") {
            echo "selected";
        }
    echo '>政治</option>';
    echo '<option value="班会" ';
        if ($result[$KB] == "班会") {
            echo "selected";
        }
    echo '>班会</option>';
    echo '<option value="自习" ';
        if ($result[$KB] == "自习") {
            echo "selected";
        }
    echo '>自习</option>';
    echo '<option value="未选科" ';
        if ($result[$KB] == "未选科" or $result[$KB] == NULL) {
            echo "selected";
        }
    echo '>未选科</option>';
    echo '</select>';
}