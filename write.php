<?php
$date = $_POST['date'];
$emotionOption = $_POST['emotionOption'];
$emotionScale = $_POST['emotionScale'];
$inputColor = $_POST['inputColor'];
$lifeArea = $_POST['lifeArea'];
$trigger = $_POST['trigger'];
$situation = $_POST['situation'];

$color = substr($inputColor, 1);
$red = hexdec(substr($color, 0, 2));
$green = hexdec(substr($color, 2, 2));
$blue = hexdec(substr($color, 4, 2));

// 既存のデータを読み込む
$existingData = file_get_contents('data/data.json');
$existingDataArray = json_decode($existingData, true);

// 新しいデータを連想配列として保存
$newData = array(
    "日付" => $date,
    "感情" => $emotionOption,
    "スケール" => $emotionScale,
    "色" => array($red, $green, $blue),
    "人生の領域" => $lifeArea,
    "トリガー" => $trigger,
    "状況" => $situation
);

if ( !isset($existingDataArray) ) {
    $existingDataArray = [];
}

// 既存のデータと新しいデータをマージ
$mergedDataArray = array_merge($existingDataArray, array($newData));

// 連想配列をJSON形式に変換して保存
$jsonData = json_encode($mergedDataArray, JSON_UNESCAPED_UNICODE);
file_put_contents('data/data.json', $jsonData);

header("Location: read.php");
exit();

ini_set('display_errors', 1);

?>
