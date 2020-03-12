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