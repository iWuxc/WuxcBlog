<!doctype html>
<html lang="zh-CN">
<head>
    {{ partial('public/header') }}
</head>

<body class="user-select">
<section class="container-fluid">
    {{ partial('public/top') }}
    {{ content() }}
</section>
{{ partial('public/seeUser') }}
{{ partial('public/footer') }}
</body>
</html>
