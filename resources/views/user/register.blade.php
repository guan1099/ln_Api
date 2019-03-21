<h1 align="center">注册</h1>
    <table width="300px" align="center">
        <tr>
            <td>账号：</td>
            <td><input type="text" class="" style="width:200px;" id="username" placeholder="账号"></td>
        </tr>
        <tr>
            <td>邮箱：</td>
            <td><input type="text" class="" style="width:200px;" id="email" placeholder="邮箱"></td>
        </tr>
        <tr>
            <td>年龄：</td>
            <td><input type="text" class="" style="width:200px;" id="age" placeholder="年龄"></td>
        </tr>
        <tr>
            <td>密码：</td>
            <td><input type="password" class="" style="width:200px;" id="pwd" placeholder="密码"></td>
        </tr>
        <tr>
            <td>确认密码：</td>
            <td><input type="password" class="" style="width:200px;" id="pwd1" name="pwd1" placeholder="确认密码"></td>
        </tr>
        <tr>
            <td><button type="text" id="btn" style="width:98px;">注册</button></td>
            <td><button type="text" id="btn2" style="width:98px;">登录</button></td>
        </tr>
    </table>
<script src="../js/jquery-1.12.4.min.js"></script>
<script>
    $(function(){
        $('#btn').click(function(){
            var username=$('#username').val();
            var pwd=$('#pwd').val();
            var age=$('#age').val();
            var email=$('#email').val();
            var pwd1=$('#pwd1').val();
            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                url     :   '/user/register',
                type    :   'post',
                data    :   {username:username,pwd:pwd,pwd1:pwd1,email:email,age:age},
                dataType:   'json',
                success :   function(d){
                    if(d.error==0){
                        alert(d.msg);
                        window.location.href = "/good/list";
                    }else{
                        alert(d.msg);
                        //window.location.href='';
                    }
                }
            });
        });
        $('#btn2').click(function(){
            location.href='/user/login';
        });
    });
</script>