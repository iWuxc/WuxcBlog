<div class="col-sm-9 col-sm-offset-3 col-md-10 col-lg-10 col-md-offset-2 main" id="main">
    <h1 class="page-header">信息总览</h1>
    <div class="row placeholders">
        <div class="col-xs-6 col-sm-3 placeholder">
            <h4>文章</h4>
            <span class="text-muted">0 条</span> </div>
        <div class="col-xs-6 col-sm-3 placeholder">
            <h4>评论</h4>
            <span class="text-muted">0 条</span> </div>
        <div class="col-xs-6 col-sm-3 placeholder">
            <h4>友链</h4>
            <span class="text-muted">0 条</span> </div>
        <div class="col-xs-6 col-sm-3 placeholder">
            <h4>访问量</h4>
            <span class="text-muted">0</span> </div>
    </div>
    <h1 class="page-header">状态</h1>
    <div class="table-responsive">
        <table class="table table-striped table-hover">
            <tbody>
            <tr>
                <td>登录者: <span>admin</span>，这是您第 <span>13</span> 次登录</td>
            </tr>
            <tr>
                <td>上次登录时间: 2016-01-08 15:50:28 , 上次登录IP: ::1:55570</td>
            </tr>
            </tbody>
        </table>
    </div>
    <h1 class="page-header">系统信息</h1>
    <div class="table-responsive">
        <table class="table table-striped table-hover">
            <thead>
            <tr> </tr>
            </thead>
            <tbody>
            <tr>
                <td>团队成员:</td>
                <td><a href="http://www.wuxc.com" target="_blank">Wuxc</a></td>
                <td>服务器软件:</td>
                <td>{{ systemInfo['serverSoftware'] }}</td>
            </tr>
            <tr>
                <td>浏览器:</td>
                <td>{{ systemInfo['getBroswer'] }}</td>
                <td>PHP版本:</td>
                <td>{{ systemInfo['phpVersion'] }}</td>
            </tr>
            <tr>
                <td>操作系统:</td>
                <td>{{ systemInfo['osName'] }} 内核版本: {{ systemInfo['osVersion'] }}</td>
                <td>PHP运行方式:</td>
                <td>{{ systemInfo['phpSapi'] }}</td>
            </tr>
            <tr>
                <td>域名/IP地址:</td>
                <td>{{ systemInfo['serverName'] }}({{ systemInfo['serverIp'] }})</td>
                <td>服务器语言:</td>
                <td>{{ systemInfo['serverLanguage'] }}</td>
            </tr>
            <tr>
                <td>程序版本:</td>
                <td class="version">WuxcBlog v {{ appVersion }} <font size="-6" color="#BBB">(20160108160215)</font></td>
                <td>上传文件:</td>
                <td>{{ systemInfo['isUpload'] }} <font size="-6" color="#BBB">(最大文件：{{ systemInfo['maxUploadSize'] }} ，表单：{{  systemInfo['postMaxSize'] }} )</font></td>
            </tr>
            <tr>
                <td>程序编码:</td>
                <td>{{ systemInfo['getCode'] }}</td>
                <td>当前时间:</td>
                <td id="startTime"></td>
            </tr>
            </tbody>
            <tfoot>
            <tr></tr>
            </tfoot>
        </table>
    </div>
    <footer>
        <h1 class="page-header">程序信息</h1>
        <div class="table-responsive">
            <table class="table table-striped table-hover">
                <tbody>
                <tr>
                    <td><span style="display:inline-block; width:8em">版权所有</span> POWERED BY WY ALL RIGHTS RESERVED</td>
                </tr>
                <tr>
                    <td><span style="display:inline-block;width:8em">页面加载时间</span> PROCESSED IN 1.0835s  SECONDS</td>
                </tr>
                </tbody>
            </table>
        </div>
    </footer>
</div>
<script>
    window.onload = function(){
        setInterval(timeStart, 1000);
    }
    function timeStart(){
        var today = new Date();
        var year = today.getFullYear();
        var month = today.getMonth()+1;
        var day = today.getDate();
        var hours = today.getHours();
        var minutes = today.getMinutes();
        var seconds = today.getSeconds();
        month = month < 10 ? "0"+month : month;
        day = day < 10 ? "0"+day : day;
        hours = hours < 10 ? "0"+hours : hours;
        minutes = minutes < 10 ? "0"+minutes : minutes;
        seconds = seconds < 10 ? "0"+seconds : seconds;
        //将时间变成字符串
        var str = year+"年"+month+"月"+day+"日 "+hours+":"+minutes+":"+seconds;
        var obj = document.getElementById("startTime");
        obj.innerHTML = str;
    }
</script>