<?php
/**
 * 多应用路由定义在应用内部route文件夹下
 */
use Webman\Route;

// 遍历所有应用
$dir_iterator = new \RecursiveDirectoryIterator(app_path());
$iterator = new \RecursiveIteratorIterator($dir_iterator);

foreach ($iterator as $file) {
    // 忽略目录和非php文件
    if (is_dir($file) || $file->getExtension() != 'php') {
        continue;
    }

    $file_path = str_replace('\\', '/',$file->getPathname());
    // 文件路径里不带route的文件忽略
    if (strpos(strtolower($file_path), '/route/') === false) {
        continue;
    }
    
    //使用路由
    Route::group('', function () use ($file) {
        include($file);
    });
}