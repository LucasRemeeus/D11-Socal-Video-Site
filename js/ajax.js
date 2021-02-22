function Login() {
    var user = $("#username").val();
    var pass = $("#password").val();
    if (user != "" && pass != "") {

        $.ajax({
            type: 'post',
            url: 'php/login_process.php',
            data: {
                Username: user,
                Password: pass
            },
            success: function (response) {
                if (response == "success") {
                    history.back();
                } else if (response == "usernamefail") {
                    document.getElementById("result").innerHTML = "Wrong Username";
                } else if (response == "fail") {
                    document.getElementById("result").innerHTML = "Wrong Details";
                }
            }
        });
    } else {
        document.getElementById("result").innerHTML = "Please Fill All The Details";
    }

    return false;
}

function Register() {
    var user = $("#username").val();
    var pass = $("#password").val();
    var passc = $("#password_confirm").val();
    var email = $("#email").val();
    if (user != "" && pass != "" && passc != "" && email != "") {

        $.ajax({
            type: 'post',
            url: 'php/register_process.php',
            data: {
                Username: user,
                Password: pass,
                Password_confirm: passc,
                Email: email
            },
            success: function (response) {
                if (response == "success") {
                    document.getElementById("result").innerHTML = "success";
                    window.location.href = "index.php";
                } else if (response == "usernametaken") {
                    document.getElementById("result").innerHTML = "Username or email already taken";
                } else if (response == "fail") {
                    document.getElementById("result").innerHTML = "Wrong Details";
                } else if (response == "wrongpassword") {
                    document.getElementById("result").innerHTML = "Password must consist out of: Minimal eight characters, at least one uppercase letter, one lowercase letter, one number and one special character:";
                }
            }
        });
    } else {
        document.getElementById("result").innerHTML = "Please Fill All The Details";
    }

    return false;
}

function DashboardVids() {

    $.ajax({
        type: 'post',
        url: 'php/Dashboard_VideoList.php',
        success: function (response) {
            document.getElementById("resultaat").innerHTML = response;
        }
    });
}



function DeleteVideo(ID_Video) {

    if (ID_Video !== "") {

        $.ajax({
            type: 'post',
            url: 'php/Video_Delete.php',
            data: {
                ID_Video: ID_Video
            },
            success: function (response) {
                if (response == "success") {
                    DashboardVids();
                    document.getElementById("error").innerHTML = "Success";
                } else if (response == "ErrorDelete") {
                    document.getElementById("error").innerHTML = "Error deleting";
                } else if (response == "ErrorNumber") {
                    document.getElementById("error").innerHTML = "Error no ID";
                } else {
                    document.getElementById("error").innerHTML = "Other error";
                }
            }
        });
    } else

        return false;
}

function RenameVideo(ID_Video, Title) {

    if (ID_Video !== "" || Title !== "") {

        $.ajax({
            type: 'post',
            url: 'php/Video_Rename.php',
            data: {
                ID_Video: ID_Video,
                Title: Title
            },
            success: function (response) {
                if (response == "success") {
                    DashboardVids();
                    document.getElementById("error").innerHTML = "Success";
                } else if (response == "ErrorRename") {
                    document.getElementById("error").innerHTML = "Error renaming";
                } else {
                    document.getElementById("error").innerHTML = "Other error";
                }
            }
        });
    } else

        return false;
}

function getVideo(Catagory) {
    if (Catagory == null) {
        Catagory = "*";
    }

    $.ajax({
        type: 'post',
        url: 'php/getVideo.php',
        data: {
            Catagory: Catagory
        },
        success: function (response) {
            document.getElementById("Result").innerHTML = response;
        }
    });
}