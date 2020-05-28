<?php
$name = "Роман";
$age = "42";

echo "<strong>Задание #1</strong><br>";
echo "Меня зовут: $name" . "<br>";
echo "Мне $age года" . "<br>";
echo "!|/'\"\\";
echo "<br><br><br>";

const PICTURE_COUNT=80;
const PICTURE_FELT=23;
const PICTURE_PEN=40;
$picturePaint = PICTURE_COUNT-PICTURE_FELT-PICTURE_PEN;

echo "<strong>Задание #2</strong><br>";
echo "На школьной выставке " . PICTURE_COUNT . " рисунков.";
echo "Из них фломастерами выполнены " . PICTURE_FELT . ", карандашами - " . PICTURE_PEN . ",";
echo " а остальные - красками.<br>";
echo "Сколько рисунков выполненны красками?<br>";
echo "<em>Ответ: </em>$picturePaint";
echo "<br><br><br>";

$age = mt_rand(-100, 100);
echo "<strong>Задание #3</strong><br>";
echo "Возраст: $age<br>";
if ($age>=18 && $age<=65) {
    echo "Вам еще работать и работать!";
} elseif ($age>65) {
    echo "Вам пора на пенсию!";
} elseif ($age>=1 && $age<=17) {
    echo "Вам ещё рано работать!";
} else {
    echo "Неизвестный возраст!";
}
echo "<br><br><br>";

$day = mt_rand(1, 10);
echo "<strong>Задание #4</strong><br>";
echo "День недели: $day<br>";
switch ($day) {
    case 1:
    case 2:
    case 3:
    case 4:
    case 5:
        echo "Это рабочий день.";
        break;
    case 6:
    case 7:
        echo "Это выходной день.";
        break;
    default:
        echo "Неизвестный день.";
        break;
}
echo "<br><br><br>";

$bmw = [
    "model" => "X5",
    "speed" => 120,
    "doors" => 5,
    "year" => "2015"
];
$toyota = $bmw;
$opel = $bmw;

$toyota["model"] = "Camry";
$toyota["speed"] = 210;
$toyota["doors"] = 4;
$toyota["year"] = "2017";

$opel["model"] = "Corsa";
$opel["speed"] = 185;
$opel["doors"] = 3;
$opel["year"] = "2015";

$cars = [
    "bmw" => $bmw,
    "toyota" => $toyota,
    "opel" => $opel
];

echo "<strong>Задание #5</strong><br>";
foreach ($cars as $brand => $car) {
    echo "CAR $brand<br>";
    foreach ($car as $value) {
        echo "$value ";
    }
    echo "<br><br><br>";
}

echo "<strong>Задание #6</strong><br>";
echo '<table border="1" cellspacing="0">';
for ($row=1; $row<=10; $row++) {
    echo "<tr>";
    for ($col=1; $col<=10; $col++) {
        echo '<td style="padding: 5px;">';
        $mult = $col * $row;
        if (($row % 2 == 0) && ($col % 2 == 0)) {
            $val = "($mult)";
        } elseif (($row % 2 != 0) && ($col % 2 != 0)) {
            $val = "[$mult]";
        } else {
            $val = "$mult";
        }
        $val = "<pre>" . str_pad($val, 5, " ", STR_PAD_LEFT) . "</pre>";
        echo $val . "</td>";
    }
    echo "</tr>";
}
echo "</table>";
