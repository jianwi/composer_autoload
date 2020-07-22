> 不会吧，不会吧。都21世纪了，还有不会用 composer 的 phper？
## 1. 创建composer.json文件

```json
{
    "autoload":{
        "psr4":{},
        "psr0":{},
        "files":[],
        "classmap":[]
    }
}
```
自动加载文件的大致架构如上。
## 2.psr4加载
遵循psr4规范加载，不用在文件目录中体现命名空间。composer.json 格式如下

```json
{
    "autoload": {
    "psr-4": {
      "App\\": "app"
    }
}
```
> app\DemoPsr4

```php
<?php

namespace App;
class DemoPsr4
{
    public function __construct()
    {
        echo "psr4加载";
    }

}
```

> public/index.php

```php
<?php
require "../vendor/autoload.php";

// psr4 加载。
$p4 = new App\TestPsr4();
```

## 3. 生成自动加载文件
 在运行测试前，要使用composer命令生成自动加载文件

```shell
composer dumpautoload
```
 
现在运行 index.php 。即可输出 “psr4加载” 字样

## 4. psr0 加载
当使用psr0规范时，需要在文件目录中创建一个和‘命名空间’名称相同的目录
> composer.json

```json
{
  "autoload": {
    "psr-4": {
      "App\\": "app"
    },
    "psr-0": {
      "Bpp\\": "bpp"
    }
  }
}
```

> bpp/Bpp/DemoPsr0.php

```php
<?php

namespace Bpp;
class DemoPsr0
{
    public function __construct()
    {
        echo "psr0自动加载。";
    }
}
```

> public/index.php

```php
<?php
require "../vendor/autoload.php";

$p4 = new App\TestPsr4();
$p0 = new Bpp\TestPsr0();
```
运行` composer dumpautoload` 生成自动加载文件。
然后运行public/index.php,会发现 psr0 类中的输出语句执行了

## 5.classmap
classmap 后面是个数组，写一个目录进去。会扫描这个目录下所有的文件。生成一个 类与文件名对应的数组。可以不用遵循任何标准，可以不写命名空间，甚至类名和文件名不相同都行。

具体文件见文件 “classmap”文件夹下

## 6.files
上面方法都是加载‘类文件’，如果需要加载一个php文件，这个php文件里写的是函数。就要使用 files 字段了。

详细代码见文件，'helper.php'