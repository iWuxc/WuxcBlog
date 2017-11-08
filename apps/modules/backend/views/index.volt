<!doctype html>
<html lang="zh-CN">
<head>
    {{ partial('public/header') }}
</head>

<body class="user-select">
<section class="container-fluid">
    {{ partial('public/top') }}
    <div class="row">
        {{ partial('public/left_sidebar') }}
        {{ content() }}
    </div>
</section>
{{ partial('public/seeUser') }}
{{ partial('public/footer') }}
</body>
</html>
