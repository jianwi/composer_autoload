<?php
require "../vendor/autoload.php";

// psr4 加载。不需要在文件夹中再创建命名空间文件夹
$t = new App\TestPsr4();
$p0 = new Bpp\TestPsr0();

$abc = new Abc();

$x = new testXX();
// 这个函数写在 helper.php 里，通过 autoload 中的 files字段加载
func_help();