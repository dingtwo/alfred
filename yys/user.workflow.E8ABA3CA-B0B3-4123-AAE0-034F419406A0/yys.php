<?php
require_once 'workflows.php';
$w = new Workflows();
$query = "{query}";
$json = file_get_contents("yaoguai.json");
$result = json_decode($json, true);
//print_r($result["table"]["tr"]);
//解析数组
if (strlen($query) > 0){
    foreach ($result["table"]["tr"] as $item){
        $td = $item["td"];
        //妖怪名
        $name = $td[1]["a"]["text"];
        //位置
        $position = @is_array($td[2]) ? $td[2]["text"][0].$td[2]["text"][1] : $td[2];
        if (mb_strrpos($name, $query, 0, 'UTF8')){
            $w->result( 'alfred', 'alfredapp', "$name", "$position", "{$imgSrc}", 'yes', 'Alfredapp' );
        }
    }
    echo $w->toXml();
}else {
//默认显示所有
    foreach ($result["table"]["tr"] as $item) {
        $td = $item["td"];
//    print_r($td);
//妖怪名
        $name = $td[1]["a"]["text"];
//位置
        $position = @is_array($td[2]) ? $td[2]["text"][0] . $td[2]["text"][1] : $td[2];
        $w->result('alfred', 'alfredapp', "$name", "$position", "{$imgSrc}", 'yes', 'Alfredapp');

        echo $w->toXml();
    }
}