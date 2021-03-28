<?php
require 'php/config.php';

if(isset($_GET['token'])){
    $tokencheck = $mysqli->prepare("SELECT * FROM passwordreset WHERE Token = ?");
    $tokencheck->bind_param('s', $_GET['token']);
    $tokencheck->execute();
    $tokencheckResult = $tokencheck -> get_result();
    $curDate = date("Y-m-d H:i:s");

    if ($tokencheckResult->num_rows !== 0 || $tokencheckResult->num_rows >! 1)
    {
        while ($reset = $tokencheckResult -> fetch_assoc()){
            if ($reset['Exp_date'] > $curDate){
    ?>
<form method="post" action="php/reset_process.php">
    please enter new password<br>
    <input type="hidden" name="token" value="<?php echo $_GET['token']; ?>" ><br>
    <input type="password" name="password"><br>
    <input type="password" name="password2"><br>
    <input type="submit" name="submit">
</form>
<?php
            }else{
                echo "your token has expired";
            }
        }
    }else{
        echo "your token is invalid";
    }
}else{
    echo "you need a token";
}