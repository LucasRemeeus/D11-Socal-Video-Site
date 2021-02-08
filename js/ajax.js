function Login()
{
    var user=$("#username").val();
    var pass=$("#password").val();
    if(user!="" && pass!="")
    {

        $.ajax
        ({
            type:'post',
            url:'php/login_process.php',
            data:{
                Username:user,
                Password:pass
            },
            success:function(response) {
                if(response=="success")
                {
                    window.location.href="index.php";
                }
                else if(response=="usernamefail")
                {
                    document.getElementById("result").innerHTML = "Wrong Username";
                }else if (response=="fail"){
                    document.getElementById("result").innerHTML = "Wrong Details";
                }
            }
        });
    }

    else
    {
        document.getElementById("result").innerHTML = "Please Fill All The Details";
    }

    return false;
}

function Register()
{
    var user=$("#username").val();
    var pass=$("#password").val();
    var passc=$("#password_confirm").val();
    var email=$("#email").val();
    if(user!="" && pass!="" && passc!="" && email!="")
    {

        $.ajax
        ({
            type:'post',
            url:'php/register_process.php',
            data:{
                Username:user,
                Password:pass,
                Password_confirm:passc,
                Email:email
            },
            success:function(response) {
                if(response=="success") {
                    document.getElementById("result").innerHTML = "success";
                    window.location.href="index.php";
                }else if(response=="usernametaken"){
                    document.getElementById("result").innerHTML = "Username or email already taken";
                }else if (response=="fail"){
                    document.getElementById("result").innerHTML = "Wrong Details";
                }else if (response=="wrongpassword"){
                    document.getElementById("result").innerHTML = "Password must consist out of: Minimal eight characters, at least one uppercase letter, one lowercase letter, one number and one special character:";
                }
            }
        });
    }

    else
    {
        document.getElementById("result").innerHTML = "Please Fill All The Details";
    }

    return false;
}

function DeleteVideo()
{
    var user=$("#username").val();
    var pass=$("#password").val();
    var passc=$("#password_confirm").val();
    var email=$("#email").val();
    if(user!="" && pass!="" && passc!="" && email!="")
    {

        $.ajax
        ({
            type:'post',
            url:'php/register_process.php',
            data:{
                Username:user,
                Password:pass,
                Password_confirm:passc,
                Email:email
            },
            success:function(response) {
                if(response=="success") {
                    document.getElementById("result").innerHTML = "success";
                    window.location.href="index.php";
                }else if(response=="usernametaken"){
                    document.getElementById("result").innerHTML = "Username or email already taken";
                }else if (response=="fail"){
                    document.getElementById("result").innerHTML = "Wrong Details";
                }else if (response=="wrongpassword"){
                    document.getElementById("result").innerHTML = "Password must consist out of: Minimal eight characters, at least one uppercase letter, one lowercase letter, one number and one special character:";
                }
            }
        });
    }

    else
    {
        document.getElementById("result").innerHTML = "Please Fill All The Details";
    }

    return false;
}
