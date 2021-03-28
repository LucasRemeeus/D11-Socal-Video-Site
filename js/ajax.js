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
    var user    = $("#username").val();
    var pass    = $("#password").val();
    var passc   = $("#password_confirm").val();
    var email   = $("#email").val();

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
                } else {
                    document.getElementById("result").innerHTML = response;
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
            type:   'post',
            url:    'php/Video_Delete.php',
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

    var title = prompt("edit de title", Title);
    if(title != null){

        $.ajax({
            type: 'post',
            url: 'php/Video_Rename.php',
            data: {
                ID_Video: ID_Video,
                Title: title
            },
            success: function (response) {
                DashboardVids();
            }
        });
    } else

        return false;
}

function getVideo(Catagory,divID) {
    if (Catagory == null) {
        Catagory = "*";
    }

    $.ajax({
        type: 'post',
        url:  'php/getVideo.php',
        data: {
            Catagory: Catagory
        },
        success: function (response) {
            document.getElementById(divID).innerHTML = response;
        }
    });
}

function getVideoUser(ID) {

    $.ajax({
        type: 'post',
        url:  'php/getVideoUser.php',
        data: {
            ID: ID
        },
        success: function (response) {
            document.getElementById("Result").innerHTML = response;
        }
    });
}



function Like(like, ID_Video) {

    if (like === 0 || like === 1){

    $.ajax({
        type: 'post',
        url: 'php/like_process.php',
        data: {
            like: like,
            ID_Video: ID_Video
        },
        success: function (response) {
            GetLike(ID_Video)
        }
    });
    }
}

function GetLike(ID_Video) {

        $.ajax({
            type: 'post',
            url: 'php/Get_like.php',
            data:{
                ID_Video: ID_Video
            },
            success: function (response) {
                document.getElementById("likes").innerHTML = response;
            }
        });
}

function Subscribe(ChannelID) {
        $.ajax({
            type: 'post',
            url: 'php/Subscribe_process.php',
            data: {
                ChannelID: ChannelID
            },
            success: function (response) {
                GetSub(ChannelID)
            }
        });
}

function GetSub(ChannelID) {

    $.ajax({
        type: 'post',
        url: 'php/Get_Sub.php',
        data:{
            ChannelID: ChannelID
        },
        success: function (response) {
            document.getElementById("subscribeButton").innerHTML = response;
        }
    });
}

function GetComment(VideoID) {

    $.ajax({
        type: 'post',
        url: 'php/Get_Comment.php',
        data:{
            VideoID: VideoID
        },
        success: function (response) {
            document.getElementById("Comments").innerHTML = response;
        }
    });
}


function Comment() {
    var comment    = $("#comment").val();
    var ID_Video   = $("#ID_Video").val();

    if (comment !== "") {

        $.ajax({
            type: 'post',
            url: 'php/comment_process.php',
            data: {
                comment: comment,
                ID_Video: ID_Video
            },
            success: function (response) {
                    GetComment(ID_Video);
                    document.getElementById("comment").value = "";

            }
        });
    }

}


function DeleteComment(ID_comment) {
        var VideoID   = $("#ID_Video").val();

        $.ajax({
            type: 'post',
            url: 'php/comment_Delete.php',
            data: {
                ID_comment: ID_comment,
            },
            success: function (response) {
                GetComment(VideoID);

            }
        });

}

function EditChannel() {
    var Username   = $("#Username").val();
    var Email   = $("#Email").val();
    var Description   = $("#Description").val();
    var Firstname   = $("#Firstname").val();
    var Lastname   = $("#Lastname").val();

    $.ajax({
        type: 'post',
        url: 'php/Channel_Edit.php',
        data: {
            Username: Username,
            Email: Email,
            Description: Description,
            Firstname: Firstname,
            Lastname: Lastname
        },
        success: function (response) {
            document.getElementById("Result").value = response;

        }
    });

}

function vzoeken()
{
    var Search   = $("#search").val();
    document.getElementById("SearchResult").value = Search;


    $.ajax({
        type: 'post',
        url: 'include/search.php',
        data: {
            Search: Search
        },
        success: function (response) {
            document.getElementById("SearchResult").value = response;

        }
    });
}