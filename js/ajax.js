function Login()
{
    var user=$("#username").val();
    var pass=$("#password").val();
    if(user!="" && pass!="")
    {

        $.ajax
        ({
            type:'post',
            url:'../php/login_process.php',
            data:{
                Username:user,
                Password:pass
            },
            success:function(response) {
                if(response=="success")
                {
                    window.location.href="../index.php";
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