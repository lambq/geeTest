# geeTest for Laravel5.3

## Installation/安装
```shell
composer require lambq/gee-test
```

### providers
> 在laravel config/app.php里面的providers添加下面的代码

```php
Lambq\GeeTest\GeeTestProvider::class
```

### 发布配置
> 在命令行输入下面代码
```shell
php artisan vendor:publish
```