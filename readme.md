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
php artisan vendor:publish --provider="Lambq\GeeTest\GeeTestProvider"
```

### 配置geetest极验
> 请把申请好的极验ID和KEY填写到 config/lamb.php 文件里面
```php
return [
    'id'    => 'xxxxx',
    'key'   => 'xxxxx',
];
```

### 前端配置
> 请把下面的内容分别放到表单和js两个部分
```html
<div class="form-group">
    <div class="col-md-6 col-md-offset-4">
        <div id="embed-captcha"></div>
        <p id="wait" class="show">正在加载验证码......</p>
        <span id="notice" class="help-block hide">
            <strong>请先完成验证</strong>
        </span>
    </div>
</div>
                            
<script src="{{ asset('js/jquery.js') }}"></script>
<script src="{{ asset('js/gt.js') }}"></script>
    <script>
        var handlerEmbed = function (captchaObj) {
            $("#embed-submit").click(function (e) {
                var validate = captchaObj.getValidate();
                if (!validate) {
                    $("#notice")[0].className = "help-block show";
                    setTimeout(function () {
                        $("#notice")[0].className = "help-block hide";
                    }, 2000);
                    e.preventDefault();
                }
            });
            // 将验证码加到id为captcha的元素里，同时会有三个input的值：geetest_challenge, geetest_validate, geetest_seccode
            captchaObj.appendTo("#embed-captcha");
            captchaObj.onReady(function () {
                $("#wait")[0].className = "hide";
            });
            // 更多接口参考：http://www.geetest.com/install/sections/idx-client-sdk.html
        };
        $.ajax({
            // 获取id，challenge，success（是否启用failback）
            url: "{{ url('captcha') }}?t=" + (new Date()).getTime(), // 加随机数防止缓存
            type: "get",
            dataType: "json",
            success: function (data) {
                //console.log(data);
                // 使用initGeetest接口
                // 参数1：配置参数
                // 参数2：回调，回调的第一个参数验证码对象，之后可以使用它做appendTo之类的事件
                initGeetest({
                    gt: data.gt,
                    challenge: data.challenge,
                    new_captcha: data.new_captcha,
                    product: "embed", // 产品形式，包括：float，embed，popup。注意只对PC版验证码有效
                    offline: !data.success, // 表示用户后台检测极验服务器是否宕机，一般不需要关注
                    width: '100%'
                    // 更多配置参数请参见：http://www.geetest.com/install/sections/idx-client-sdk.html#config
                }, handlerEmbed);
            }
        });
    </script>
```