<?php
// Задание #3.1
$names = ['Рома', 'Гриша', 'Маша', 'Света', 'Паша'];
$users = [];
for ($i = 1; $i <= 50; $i++) {
    $users[] = [
        'id' => $i,
        'name' => $names[mt_rand(0, 4)],
        'age' => mt_rand(18, 45)
    ];
}

$fn = 'users.json';
$result = file_put_contents($fn, json_encode($users));
if ($result === false) {
    die('Ошибка формирования файла');
}
$return = file_get_contents($fn);
if ($return === false) {
    die('Ошибка чтения строки из файла');
}
$jsonUsers = [];
$jsonUsers = json_decode($return, true);

$columnName = array_column($jsonUsers, 'name');
$columnAge = array_column($jsonUsers, 'age');

$oftenNames = array_count_values($columnName);
foreach ($oftenNames as $key => $value) {
    echo "Пользователей с именем \"$key\": $value<br>";
}
echo "Средний возраст пользователей: " . intval(array_sum($columnAge) / 50);
