<?php


function file_get_contents_curl($url) {

    $ch = curl_init();

    curl_setopt($ch, CURLOPT_AUTOREFERER, TRUE);

    curl_setopt($ch, CURLOPT_HEADER, 0);

    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);

    curl_setopt($ch, CURLOPT_URL, $url);

    curl_setopt($ch, CURLOPT_FOLLOWLOCATION, TRUE);

    curl_setopt($ch, CURLOPT_HTTPHEADER, array(

        'Client-ID: yuta03h54wk5b5ytl17vnar5ajiphc',

        'Authorization: Bearer '.$_GET['code'],

        'Accept: application/vnd.twitchtv.v5+json'



    ));

    $data = curl_exec($ch);

    curl_close($ch);

    return $data;

}

$url = "https://api.twitch.tv/helix/search/channels?query=lostpurplewolf";

$json_array = json_decode(file_get_contents_curl($url), true);

echo '<pre>';

print_r($json_array);

echo '</pre>';

?>
<a href="https://id.twitch.tv/oauth2/authorize
?client_id=yuta03h54wk5b5ytl17vnar5ajiphc
&redirect_uri=http://localhost/Github/D11-Socal-Video-Site/livestream.php
&response_type=code">login</a>
<html>
<body>
<!-- Add a placeholder for the Twitch embed -->
<div id="twitch-embed"></div>

<!-- Load the Twitch embed script -->
<script src="https://embed.twitch.tv/embed/v1.js"></script>

<!-- Create a Twitch.Embed object that will render within the "twitch-embed" root element. -->
<script type="text/javascript">
    new Twitch.Embed("twitch-embed", {
        width: 854,
        height: 480,
        channel: "",
    });
</script>
</body>
</html>