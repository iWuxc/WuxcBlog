<!DOCTYPE html>
<html>
<head>
    {{ partial('public/header') }}
</head>
<body class="fixed-sidebar full-height-layout gray-bg" style="overflow:hidden">
    <div id="wrapper">

        <!--左侧导航开始-->
        {{ partial('public/left_sidebar') }}
        <!--左侧导航结束-->

        <!--右侧部分开始-->
        {{ content() }}
        <!--右侧部分结束-->

        <!--右侧边栏开始-->
        {{ partial('public/right_sidebar') }}
        <!--右侧边栏结束-->

        <!--mini聊天窗口开始-->
        {{ partial('public/small_chat') }}

    </div>
    {{ partial('public/footer') }}
</body>
</html>