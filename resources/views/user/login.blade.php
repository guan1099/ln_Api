<h1 align="center">登录</h1>
<input type="hidden" value="{{$url}}" id="url">
    <table align="center">
        <tr>
            <td><input type="text" class="form-control" style="width:200px;" id="username" placeholder="账号"></td>
        </tr>
        <tr>
            <td><input type="password" class="form-control" style="width:200px;" id="pwd" placeholder="密码"></td>
        </tr>
        <tr>
            <td>
                <button type="text" id="btn" style="width:98px;">登录</button>
                <button type="text" id="btn2" style="width:98px;">注册</button>
            </td>
        </tr>
    </table>
<script src="../js/jquery-1.12.4.min.js"></script>
<script>
    $(function(){
        $('#btn').click(function(){
            var username=$('#username').val();
            var pwd=$('#pwd').val();
            var url=$('#url').val();
            console.log(username);
            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                url     :   '/user/login',
                type    :   'post',
                data    :   {username:username,pwd:pwd},
                dataType:   'json',
                success :   function(d){
                    if(d.error==0){
                        alert(d.msg);
                        window.location= + url;
                    }else{
                        alert(d.msg);
                        //window.location.href='';
                    }
                }
            });
        });
        $('#btn2').click(function(){
            location.href='/user/register';
        });
    });
</script>