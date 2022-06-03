<?php

$age = $_POST['age'];
$gender = $_POST['gender'];
$symptom = $_POST['symptom'];
$weight = $_POST['weight'];

if (
    $age === '未選択' || $gender === '未選択' ||
    $symptom === '未選択' || $weight === '未選択'
) {
    exit('データが入力されていません！！');
}

$scale = 1; //初期値

//ageでscale調整
//valueは文字列なので条件は（==）
if ($age == 20) {
    $scale = $scale * 1;
} elseif ($age == 30) {
    $scale = $scale * 1;
} elseif ($age == 40) {
    $scale = $scale * 1;
} elseif ($age == 50) {
    $scale = $scale * 0.8;
} elseif ($age == 60) {
    $scale = $scale * 0.7;
} elseif ($age == 70) {
    $scale = $scale * 0.6;
} elseif ($age == 80) {
    $scale = $scale * 0.5;
};

//genderでscale調整
if ($gender === 'man') {
    $scale = $scale * 1;
} elseif ($gender === 'woman') {
    $scale =  $scale * 0.8;
};

//symptomでscale調整
if ($symptom === 'have') {
    $scale = $scale * 2;
} elseif ($symptom === 'not_have') {
    $scale =  $scale * 1;
};

//weight
if ($weight == 30) {
    $scale = $scale * 0.8;
} elseif ($weight == 40) {
    $scale = $scale * 1;
} elseif ($weight == 50) {
    $scale = $scale * 1.2;
} elseif ($weight == 60) {
    $scale = $scale * 1.4;
} elseif ($weight == 70) {
    $scale = $scale * 1.6;
} elseif ($weight == 80) {
    $scale = $scale * 1.8;
} elseif ($weight == 90) {
    $scale = $scale * 2;
};

//個人の初期推奨量の算出
$basicDose = 10;
$personalDose =  $basicDose * $scale;
$ceilPersonalDose = ceil($personalDose); //切り上げ
// $strDose = strval($ceilDose); //string typeへ変換

$file = fopen('./data/data.txt', 'w+');
flock($file, LOCK_EX);
fwrite($file, $ceilPersonalDose);
flock($file, LOCK_UN);
fclose($file);

header('Location:input.php#recommend_text');
