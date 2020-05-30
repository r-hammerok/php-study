<?php

require('src/functions.php');

task1(['111', '222', '000'], false);
echo '<br><br>';

echo task2("/5566", 5, [1,2,3], 1, 5);
echo '<br><br>';

task3(20,15);
echo '<br><br>';

echo task4();
echo "<br>";
echo task5();
echo '<br><br>';

echo task6('Карл у Клары украл Кораллы', 'К');
echo "<br>";
echo task7('Две бутылки лимонада', 'Две', 'Три');
echo '<br><br>';

task8();
task9('test2.txt');