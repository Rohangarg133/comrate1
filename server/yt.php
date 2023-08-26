<?php
$q = $_GET['q'];
$api_key = 'AIzaSyAafor6qoIc-B8SmoAz2MwGaMFRRAUtre8';
$channel_id = $q;
$channel_list;

$api_url = 'https://www.googleapis.com/youtube/v3/search?part=snippet&channelId=' . $channel_id . '&maxResults=3&key=' . $api_key;


$youtube_videos = file_get_contents($api_url);

if (!empty($youtube_videos)) {
    $youtube_videos_arr = json_decode($youtube_videos, true);
    if (!empty($youtube_videos_arr['items'])) {
        $array = array();
        foreach ($youtube_videos_arr['items'] as $ytvideo) {
            if ($ytvideo['id']['kind'] == 'youtube#video') {
                $array[] = $ytvideo['id']['videoId'];               
            }
        }
        $array1["enlish"] = 10;
        $array1["english"] = 20;
        // $out = array_values($array);
        $channel_list = json_encode($array, JSON_FORCE_OBJECT);
        // $channel = json_decode($channel_list);
        echo $channel_list;
    }
}

?>



