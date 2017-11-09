<!doctype html>
<html lang="zh-CN">
<head>
    <meta charset="utf-8">
    <meta name="renderer" content="webkit">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ title }}</title>
    <link rel="stylesheet" type="text/css" href="{{ static_url('css/bootstrap.min.css?_v=')~assetsVersion }}">
    <link rel="stylesheet" type="text/css" href="{{ static_url('css/style.css?_v=')~assetsVersion }}">
    <link rel="stylesheet" type="text/css" href="{{ static_url('css/login.css?_v=')~assetsVersion }}">
    <link rel="apple-touch-icon-precomposed" href="{{ static_url('images/icon/icon.png') }}">
    <link rel="shortcut icon" href="{{ static_url('images/icon/favicon.ico')~assetsVersion }}">
    <script src="{{ static_url('js/jquery-2.1.4.min.js?_v=') }}"></script>
    <!--[if gte IE 9]>
    <script src="{{ static_url('js/jquery-1.11.1.min.js?_v=')~assetsVersion }}" type="text/javascript"></script>
    <script src="{{ static_url('js/html5shiv.min.js?_v=')~assetsVersion }}" type="text/javascript"></script>
    <script src="{{ static_url('js/respond.min.js?_v=')~assetsVersion }}" type="text/javascript"></script>
    <script src="{{ static_url('js/selectivizr-min.js?_v=')~assetsVersion }}" type="text/javascript"></script>
    <![endif]-->
    <!--[if lt IE 9]>
    <script>window.location.href='upgrade-browser.html';</script>
    <![endif]-->
</head>

<body class="user-select">
<div class="container">
    <div class="siteIcon">
        <img src="{{ static_url('images/icon/icon.png') }}" alt="" data-toggle="tooltip" data-placement="top" title="欢迎使用Wuxc博客管理系统" draggable="false" />
    </div>
    <form action="{{ url('passport/login') }}" method="post" autocomplete="off" class="form-signin">
        <h2 class="form-signin-heading">管理员登录</h2>
        <label for="userName" class="sr-only">用户名</label>
        <input type="text" id="userName" name="username" class="form-control" placeholder="请输入用户名" required autofocus autocomplete="off" maxlength="10">
        <label for="userPwd" class="sr-only">密码</label>
        <input type="password" id="userPwd" name="userpwd" class="form-control" placeholder="请输入密码" required autocomplete="off" maxlength="18">
        <button class="btn btn-lg btn-primary btn-block" type="submit" id="signinSubmit">登录</button>
    </form>
    <div class="footer">
        <p><a href="/Home/index.html" data-toggle="tooltip" data-placement="left" title="不知道自己在哪?">回到Wuxc博客 →</a></p>
    </div>
</div>
<script src="{{ static_url('js/bootstrap.min.js') }}"></script>
<script>
    $('[data-toggle="tooltip"]').tooltip();
    window.oncontextmenu = function(){
        //return false;
    };
    $('.siteIcon img').click(function(){
        window.location.reload();
    });
    $('#signinSubmit').click(function(){
        if($('#userName').val() === ''){
            $(this).text('用户名不能为空');
        }else if($('#userPwd').val() === ''){
            $(this).text('密码不能为空');
        }else{
            $(this).text('请稍后...');
        }
    });
</script>
</body>
</html>
