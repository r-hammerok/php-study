<?php

spl_autoload_register('mainAutoload');
function mainAutoload($className)
{
    $classPaths = [
        'Base' => 'base',
        'App\Controllers' => 'controllers',
        'App\Models' => 'models'
    ];

    $namespacePaths = explode('\\', $className);
    $classFileName = array_pop($namespacePaths) . '.php';

    $namespacePath = implode('\\', $namespacePaths);

    if (array_key_exists($namespacePath, $classPaths)) {
        $namespacePath = $classPaths[$namespacePath];
    }
    if (!empty($namespacePath)) {
        $namespacePath .= '\\';
    }

    include_once __DIR__ . '\\' .  $namespacePath . $classFileName;
}
