<!DOCTYPE html>
<html>
<head>
	<title></title>
</head>
<body>
    <?php
  include "conf/info.php";
  $title="Welcome to";
  include_once "header.php";
?>
    <h1>~ Details ~</h1>
    <hr>
    <!--perintah untuk menampilkan data API-->
      
      <?php
      include_once "api/tv_det.php";
        $p = $popular;
        $v = $vid;
        $arr = $vid->results;
        $chunks = array_chunk($arr, 1);
        $yutub = '<iframe width="460" height="315" src="https://www.youtube.com/embed/';
        $yutub2 = '"frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe></p>';

       echo'<b>
            <table class="demo">
  <thead>
  <tr>
    <th><h1><b>'. $p->original_name .'('. substr($p->first_air_date, 0, 4) .')<h1></b></th>
    <th><h1>Details Of Movie</h1></th>
  </tr>
  </thead>
  <tbody>
  <tr>
    <td><img src="http://image.tmdb.org/t/p/w500'. $p->poster_path . '"></td>
    <td> '.$p->overview.'
    <p>Popularity Rate= '.$p->popularity.'</p>
    <p>'.$v->id.'</p>
    <p>
    ';
    foreach ($chunks as $chunk) {
      foreach ($chunk as $bs) {
       echo $yutub.$bs->key.$yutub2.'</p>';
      }
    }
    echo'</td>
  </tr>
  <tr>
    <td><h3><b><em>Rate : "' . $p->vote_average . " |  Vote : " . $p->vote_count . '"</em></b></h3></td>
    
    <td>  s
    </td>
  
  </tr>
  </tbody>
</table></b>
       ';
      ?>


<?php
  include_once "footer.php";
?>
</body>
</html>