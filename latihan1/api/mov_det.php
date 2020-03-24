<?php

$ch = curl_init();
$url1 = "http://api.themoviedb.org/3/movie/";
$url2 = "?api_key=";
$id = $_GET['id'];
curl_setopt($ch, CURLOPT_URL,  $url1.$id.$url2.$apikey);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
curl_setopt($ch, CURLOPT_HEADER, FALSE);
curl_setopt($ch, CURLOPT_HTTPHEADER, array("Accept: application/json"));
$response2 = curl_exec($ch);
curl_close($ch);
$popular = json_decode($response2);
?>

<?php
$chs = curl_init();
$urlx1 = "https://api.themoviedb.org/3/movie/";
$urlx2 = "/videos?api_key=";
$id = $_GET['id'];
curl_setopt($chs, CURLOPT_URL,  $urlx1.$id.$urlx2.$apikey);
curl_setopt($chs, CURLOPT_RETURNTRANSFER, TRUE);
curl_setopt($chs, CURLOPT_HEADER, FALSE);
curl_setopt($chs, CURLOPT_HTTPHEADER, array("Accept: application/json"));
$responses2 = curl_exec($chs);
curl_close($chs);
$vid = json_decode($responses2);
?>