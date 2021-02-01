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
    var email=$("#email").val();
    if(user!="" && pass!="" && email!="")
    {

        $.ajax
        ({
            type:'post',
            url:'php/register_process.php',
            data:{
                Username:user,
                Password:pass,
                Email:email
            },
            success:function(response) {
                if(response=="success")
                {
                    window.location.href="../index.php";
                }
                else if(response=="usernametaken")
                {
                    document.getElementById("result").innerHTML = "Username or email already taken";
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