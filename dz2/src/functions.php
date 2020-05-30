<?php

function task1(array $arrStrings, $inOneLine = false)
{
    $glue = $inOneLine === true ? "" : "</p><p>";
    $concStrings = "<p>" . implode($glue, $arrStrings) . "</p>";
    echo $concStrings;
}

function task2($operation)
{
    // У меня версия PHP 5.6 (с 7.0 OpenServer не запускается, видимо из-за ОС Windows 7,
    // поэтому strict type для string не работает.
    if (!is_string($operation)) {
        return 'Ошибка. Первый аргумент должен быть строкой!';
    }
    // Берем из переданной строки первый символ и проверяем на соответствие допустимой операции
    $operation = substr($operation, 0, 1);
    if (strpos('+-*/', $operation) === false) {
        return 'Ошибка. Недопустимая операция над аргументами!';
    }

    $args = func_get_args();

    // Создаем новый массив, состоящий только из аргументов, которые являются числами
    $num = [];
    foreach ($args as $arg) {
        if (is_integer($arg) || is_float($arg)) {
            $num[] = $arg;
        }
    }
    if (empty($num)) {
        return 'Ошибка. Отсутствуют аргменты для вычисления!';
    }

    // Извлекаем из числового массива первый элемент для инициализации переменных
    $result = array_shift($num);
    $strResult = "$result $operation ";

    $skipArg = false; // Флаг об исключении элемента из операции
    foreach ($num as $arg) {
        if ($operation == '+') {
            $result += $arg;
        } elseif ($operation == '-') {
            $result -= $arg;
        } elseif ($operation == '*') {
            $result *= $arg;
        } elseif ($operation == '/') {
            // Пропускаем нулевой элемент, так как на 0 делить нельзя
            if ($arg != 0) {
                $result /= $arg;
            } else {
                $skipArg = true;
            }
        }
        if (!$skipArg) {
            $strResult .= $arg . " $operation ";
        } else {
            $skipArg = false;
        }
    }
    if (empty($strResult)) {
        $return = 'Нет данных для вычислений';
    } else {
        // Удаляем из конца строки пробел и знак операции
        $strResult = rtrim($strResult, "$operation ");
        $return = $strResult . " = $result";
    }
    return $return;
}

function task3($rowCount, $colCount)
{
    if (!is_int($colCount) || !is_int($rowCount)) {
        echo 'Ошибка. Передаваемые аргументы должны быть целыми числами!';
    } elseif ($colCount <= 0 || $rowCount <= 0) {
        echo 'Ошибка. Передаваемые аргументы должны быть больше 0!';
    } else {
        echo '<table border="1">';
        for ($row = 1; $row <= $rowCount; $row++) {
            echo '<tr>';
            for ($col = 1; $col <= $colCount; $col++) {
                echo '<td>' . $col * $row . '</td>';
            }
            echo '</tr>';
        }
        echo '</table>';
    }
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
