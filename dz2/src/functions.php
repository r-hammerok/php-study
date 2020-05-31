<?php

function task1(array $arrStrings, $inOneLine = false)
{
    // Первый пунк задания
    echo "<p>" . implode("</p><p>", $arrStrings) . "</p>";
    // Второй пункт задания
    if ($inOneLine) {
        return implode("", $arrStrings);
    }

}

function task2()
{
    $args = func_get_args();
    $operation = $args[0];
    unset($args[0]);

    $result = $args[1];
    unset($args[1]);

    switch ($operation) {
        case '+':
            foreach ($args as $value) {
                $result += $value;
            }
            break;
        case '-':
            foreach ($args as $value) {
                $result -= $value;
            }
            break;
        case '*':
            foreach ($args as $value) {
                $result *= $value;
            }
            break;
        case '/':
            foreach ($args as $value) {
                if ($value == 0) {
                    return 'Ошибка. На ноль делить нельзя!';
                }
                $result /= $value;
            }
            break;
        default:
            return 'Ошибка. Недопустимая операция над аргументами!';
    }
    return $result;
}

// task3(1, 1);
// task3(0, 0);
// task3(0, 1);
// task3(1.1, 1);
function task3($rows, $cols)
{
    if ($cols < 1 || $rows < 1) {
        echo 'Ошибка. Передаваемые аргументы должны быть больше 0!';
        return null;
    }

    echo '<table border="1">';
    for ($row = 1; $row <= $rows; $row++) {
        echo '<tr>';
        for ($col = 1; $col <= $cols; $col++) {
            echo '<td>' . $col * $row . '</td>';
        }
        echo '</tr>';
    }
    echo '</table>';
}

function task4()
{
    date_default_timezone_set('Asia/Krasnoyarsk');
    return date('d:m:Y H:i');
}

function task5()
{
    return mktime(0, 0, 0, 2, 24, 2016);
}

function task6($originalString, $deletedChar)
{
    if (!is_string($originalString) || !is_string($deletedChar)) {
        return '';
    }
    return str_replace($deletedChar, '', $originalString);
}

function task7($originalString, $searchedString, $replacedString)
{
    if (!is_string($originalString) || !is_string($searchedString) || !is_string($replacedString)) {
        return '';
    }
    return str_replace($searchedString, $replacedString, $originalString);
}

function task8()
{
    $fp = fopen('test.txt', 'w');
    fwrite($fp, 'Hello again!');
    fclose($fp);
}

function task9($fileName)
{
    if (!is_string($fileName) || !file_exists($fileName)) {
        echo 'Ошибка. Файл не указан или не существует!';
        return;
    }
    echo '<pre>';
    echo file_get_contents($fileName);
    echo '</pre>';
}
