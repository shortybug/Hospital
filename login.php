<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width,initial-scale=1,maximum-scale=1,user-scalable=no">
    <title>注册/登陆</title>

    <meta name="keywords" content=""/>
    <meta name="description" content=""/>
    <link rel="shortcut icon" href="http://www.zhaotexiao.com/favicon.ico" type="image/x-icon"/>
    <link rel="stylesheet" href="css/login.css">
    <link rel="stylesheet" href="css/loginfont.css">
    <script src="http://www.zhaotexiao.com/common/js/jquery-1.7.2.min.js"></script>
</head>
<body>
<div class="login-nav fix">
    <a>欢迎来到全国统一挂号平台</a>
    <ul class="f-r">
        <li><a href="home.html">返回首页</a></li>
    </ul>
</div>
<div class="login-banner"></div>
<div class="login-box">
    <div class="box-con tran">
        <form action="land.url" method="post">
            <div class="login-con f-l">
                <div class="form-group">
                    <input type="text" name="user" placeholder="用户名"/>
                </div>
                <div class="form-group">
                    <input type="password" name="password" placeholder="密码">
                    <span class="error-notic">密码不正确</span>
                </div>
                <div class="form-group">
                    <button type="submit" class="tran pr">
                        <a href="javascript:;" class="tran">登录</a>
                    </button>
                </div>
                <div class="from-line"></div>
                <div class="form-group">
                    <a href="javascript:;" class="move-signup a-tag tran blue-border">还没有帐号？免费注册<i class="iconfont tran">&#xe606;</i></a>
                </div>
            </div>
        </form>
        <!-- 登录 -->

        <form name="register" action="register.php" method="post">
            <div class="signup f-l">
                <div class="form-group">
                    <div class="signup-form">
                        <input type="text" name="email" placeholder="邮箱" class="email-mobile" onBlur="verify.verifyName(this)">
                    </div>
                    <span class="error-notic">邮箱格式不正确</span>
                </div>
                <div class="form-group">
                    <input type="text" name="name" placeholder="姓名">
                </div>
                <div class="form-group">
                    <input type="text" name="tel" placeholder="手机号码"  class="email-mobile" onBlur="verify.verifyTel(this)">
                    <span class="error-notic">手机号码不正确</span>
                </div>
                <div class="form-group">
                    <input type="text" name="card" placeholder="身份证号码" class="email-mobile" onBlur="verify.verifyCard(this)">
                    <span class="error-notic">身份证号码不正确</span>
                </div>
                <div class="signup-email">
                    <div class="form-group">
                        <input type="password" name="password" placeholder="密码（字母、数字，至少6位）" onBlur="verify.PasswordLenght(this)">
                        <span class="error-notic">密码长度不够</span>
                    </div>
                    <div class="form-group">
                        <button type="submit" class="tran pr">
                            <a href="javascript:;" class="tran">注册</a>
                        </button>
                    </div>
                </div>
        </form>
        <!-- 注册 -->
        <div class="from-line"></div>
        <div class="form-group">
            <a href="javascript:;" class="move-login a-tag tran blue-border">已有帐号？登录<i class="iconfont tran">&#xe606;</i></a>
        </div>
    </div>
    <!-- 注册 -->
</div>
</div>

<div style="height:80px;"></div>


<script>
    $(function(){
        $(".signup-select").on("click",function(){
            var _text=$(this).text();
            var $_input=$(this).prev();
            $_input.val('');
            $_input.attr("placeholder","邮箱");
            $_input.attr("onblur","verify.verifyName(this)");
            $(this).parents(".form-group").find(".error-notic").text("邮箱格式不正确")
        });
        //步骤切换
        var _boxCon=$(".box-con");
        $(".move-login").on("click",function(){
            $(_boxCon).css({
                'marginLeft':0
            })
        });
        $(".move-signup").on("click",function(){
            $(_boxCon).css({
                'marginLeft':-320
            })
        });
    });

    //表单验证
    function showNotic(_this){
        $(_this).parents(".form-group").find(".error-notic").fadeIn(100);
        $(_this).focus();
    }//错误提示显示
    function hideNotic(_this){
        $(_this).parents(".form-group").find(".error-notic").fadeOut(100);
    }//错误提示隐藏
    var verify={
        verifyName:function(_this){
            var validateReg =  /^([a-zA-Z0-9_\.\-])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/;
            var _value=$(_this).val();
            var _length=$(_this).val().length;
            if(!validateReg.test(_value)){
                showNotic(_this)
            }else{
                hideNotic(_this)
            }
        },//验证邮箱格式

        verifyTel:function(_this){
            var telnotice=  /^([0-9])+$/;
            var _value=$(_this).val();
            var _length=$(_this).val().length;
            if(!telnotice.test(_value) || _length!=11){
                showNotic(_this)
            }else{
                hideNotic(_this)
            }
        },//验证手机号码格式

        verifyCard:function(_this){
            var cardnotice=  /^([0-9])+$/;
            var _value=$(_this).val();
            var _length=$(_this).val().length;
            if(!cardnotice.test(_value) || _length!=18){
                showNotic(_this)
            }else{
                hideNotic(_this)
            }
        },//验证身份证号码格式
        PasswordLenght:function(_this){
            var _length=$(_this).val().length;
            if(_length<6){
                showNotic(_this)
            }else{
                hideNotic(_this)
            }
        },//验证设置密码长度
    }
</script>
</body>
</html>
<?php
//登录
require_once '../database.php';

$username = $_POST['username'];
$password = $_POST['password'];

$errmsg='';
if(!empty($errmsg))  //yan zheng shu ju wei kong
{
    if(empty($username))
        $errmsg="数据输入不完整";
}

if(empty($errmsg))
{
    $db=new database();
    $db->connect_to_db();
    if(mysqli_connect_errno())
    {
        $errmsg="shu ju ku lian jie shi bai!<br>\n";
    }
    else
    {
        $realusername=$db->get_field_from_table('users','name','id_card');
        $realpassword=$db->get_field_from_table('users','password','id_card');
        if($username==$realusername && $password==$realpassword)
        {
            $errmsg="deng lu cheng gong";

            session_start();
            $_SESSION['uid']=$username;
            if(empty($_SESSION['uid']))
            {
                echo"你还没有登录";
            }
        }
        else
        {
            $errmsg="deng lu shi bai!";
        }
    }
}
?>
