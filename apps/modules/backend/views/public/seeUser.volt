<!--个人信息模态框-->
<div class="modal fade" id="seeUserInfo" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
        <form action="{{ url('account/saveprofile') }}" method="post" id="saveprofile">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" >个人信息</h4>
                </div>
                <div class="modal-body">
                    <table class="table" style="margin-bottom:0px;">
                        <thead>
                        <tr> </tr>
                        </thead>
                        <tbody>
                        <tr>
                            <td wdith="20%">姓名:</td>
                            <td width="80%"><input type="text" value="{% if userinfo is not empty %}{{ userinfo['realname'] }}{% endif %}" class="form-control" name="realname" id="realname" maxlength="10" autocomplete="off" /></td>
                        </tr>
                        <tr>
                            <td wdith="20%">用户名:</td>
                            <td width="80%"><input type="text" value="{% if userinfo is not empty %}{{ userinfo['username'] }}{% endif %}" class="form-control" name="username" id="username" maxlength="10" autocomplete="off" /></td>
                        </tr>
                        <tr>
                            <td wdith="20%">电话:</td>
                            <td width="80%"><input type="text" value="{% if userinfo is not empty %}{{ userinfo['phone_number'] }}{% endif %}" class="form-control" name="phone_number" id="phone_number" maxlength="13" autocomplete="off" /></td>
                        </tr>
                        <tr>
                            <td wdith="20%">旧密码:</td>
                            <td width="80%"><input type="password" class="form-control" name="old_password" id="old_password" maxlength="18" autocomplete="off" placeholder="输入当前密码" /></td>
                        </tr>
                        <tr>
                            <td wdith="20%">新密码:</td>
                            <td width="80%"><input type="password" class="form-control" name="password" id="password" maxlength="18" autocomplete="off" placeholder="若不修改密码,请保持当前空白" /></td>
                        </tr>
                        <tr>
                            <td wdith="20%">确认密码:</td>
                            <td width="80%"><input type="password" class="form-control" name="new_password" id="new_password" maxlength="18" autocomplete="off" /></td>
                        </tr>
                        </tbody>
                        <tfoot>
                        <tr>
                            <td colspan="2" align="right"  style="color:#F00" id="notice_message">*注意:修改信息需要输入当前密码</td>
                        </tr>
                        </tfoot>
                    </table>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">取消</button>
                    <button type="submit" class="btn btn-primary" id="saveprofile-button">提交</button>
                </div>
            </div>
        </form>
    </div>
</div>
<!--个人登录记录模态框-->
<div class="modal fade" id="seeUserLoginlog" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" >登录记录</h4>
            </div>
            <div class="modal-body">
                <table class="table" style="margin-bottom:0px;">
                    <thead>
                    <tr>
                        <th>登录IP</th>
                        <th>登录时间</th>
                        <th>状态</th>
                    </tr>
                    </thead>
                    <tbody>
                    <tr>
                        <td>::1:55570</td>
                        <td>2016-01-08 15:50:28</td>
                        <td>成功</td>
                    </tr>
                    <tr>
                        <td>::1:64377</td>
                        <td>2016-01-08 10:27:44</td>
                        <td>成功</td>
                    </tr>
                    <tr>
                        <td>::1:64027</td>
                        <td>2016-01-08 10:19:25</td>
                        <td>成功</td>
                    </tr>
                    <tr>
                        <td>::1:57081</td>
                        <td>2016-01-06 10:35:12</td>
                        <td>成功</td>
                    </tr>
                    </tbody>
                </table>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">朕已阅</button>
            </div>
        </div>
    </div>
</div>
<!--微信二维码模态框-->
<div class="modal fade user-select" id="WeChat" tabindex="-1" role="dialog" aria-labelledby="WeChatModalLabel">
    <div class="modal-dialog" role="document" style="margin-top:120px;max-width:280px;">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="WeChatModalLabel" style="cursor:default;">微信扫一扫</h4>
            </div>
            <div class="modal-body" style="text-align:center"> <img src="images/weixin.jpg" alt="" style="cursor:pointer"/> </div>
        </div>
    </div>
</div>
<!--提示模态框-->
<div class="modal fade user-select" id="areDeveloping" tabindex="-1" role="dialog" aria-labelledby="areDevelopingModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="areDevelopingModalLabel" style="cursor:default;">该功能正在日以继夜的开发中…</h4>
            </div>
            <div class="modal-body"> <img src="images/baoman/baoman_01.gif" alt="深思熟虑" />
                <p style="padding:15px 15px 15px 100px; position:absolute; top:15px; cursor:default;">很抱歉，程序猿正在日以继夜的开发此功能，本程序将会在以后的版本中持续完善！</p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-primary" data-dismiss="modal">朕已阅</button>
            </div>
        </div>
    </div>
</div>
<script>
    $('#saveprofile-button').on('click', function(){
        var noticeMessage = $("#notice_message"); //获取信息提示框

        var username = $.trim($('#username').val());
        var usernamePattern = /^[\u4e00-\u9fa5\w-]{2,20}$/i;
        if(!usernamePattern.test(username)){
            noticeMessage.html('昵称由2-20个中英文字符、数字、下划线和横杠组成');
            return false;
        }

        var phone = $.trim($('#phone_number').val());
        var phonePattern = /^((13[0-9])|(14[5|7])|(15([0-3]|[5-9]))|(18[0,5-9]))\d{8}$/;
        if(!phonePattern.test(phone)){

            return false;
        }

        /** 若用户填写了密码, 则判断新旧密码都需要验证是否填写 */
        var oldpwd = $.trim($('#old_password').val());
        if(oldpwd == '' || oldpwd == false){
            noticeMessage.html('请填写原始密码');
            return false;
        }
        if(oldpwd.length < 6 || oldpwd.length > 20){
            noticeMessage.html('密码有误!密码由6-20个字符组成!');
            return false;
        }
        var newpwd = $.trim($('#password').val());
        var confirmpwd = $.trim($('#new_password').val());
        if((newpwd == '' || newpwd == false) && (confirmpwd == '' || confirmpwd == false)){
            noticeMessage.html('*注意:修改信息需要输入当前密码');
            $('#saveprofile').submit();
        } else {
            //如果新密码不为空,则进行判断
            if(newpwd != '' && newpwd != ''){
                if(newpwd.length < 6 || newpwd.length > 20){
                    noticeMessage.html('密码由6-20个字符组成');
                    return false;
                }
                if(newpwd != confirmpwd){
                    noticeMessage.html('两次输入的新密码不一致');
                    return false;
                }
                if(oldpwd == newpwd){
                    noticeMessage.html('新密码不能与原始密码相同');
                    return false;
                }
            }
            noticeMessage.html('新密码不能与原始密码相同');
            $('#saveprofile').submit('*注意:修改信息需要输入当前密码');
        }
    });
</script>