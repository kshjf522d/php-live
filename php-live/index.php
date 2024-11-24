<?php
error_reporting(0);

$liveSources = [
    "CCTV1" => "http://123.166.61.70:8003/hls/11/index.m3u8",
    "CCTV2" => "http://123.166.61.70:8003/hls/12/index.m3u8",
    "CCTV4" => "http://123.166.61.70:8003/hls/41/index.m3u8",
    "CCTV7" => "http://123.166.61.70:8003/hls/42/index.m3u8",
    "CCTV11" => "http://123.166.61.70:8003/hls/43/index.m3u8"
];

$id = $_GET['id'];

if (isset($liveSources[$id])) {
    $url = $liveSources[$id];
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_HEADER, false);
    curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
    curl_setopt($ch, CURLOPT_USERAGENT, "Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/87.0.4280.88 Safari/537.36");
    
    $response = curl_exec($ch);
    $http_code = curl_getinfo($ch, CURLINFO_HTTP_CODE);
    curl_close($ch);

    if ($http_code == 200) {
        header("Content-Type: application/vnd.apple.mpegurl");
        echo $response;
    } else {
        echo "Error fetching stream.";
    }
} else {
    echo "Channel not found.";
}
?>
