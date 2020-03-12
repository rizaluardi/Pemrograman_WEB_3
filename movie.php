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
      include_once "api/mov_det.php";
        $p = $popular;
       

        echo '<table>';
            echo '<tr>';
           
       
                echo '<td><a href="movie.php?id=' . $p->id . '"><img src="http://image.tmdb.org/t/p/w500'. $p->poster_path . '"><h4>' . $p->original_title . " (" . substr($p->release_date, 0, 4) . ")</h4><h5><em>Rate : " . $p->vote_average . " |  Vote : " . $p->vote_count . "</em></h5></a>'</td>";
            echo '</tr>';
        echo '</table>';
      ?>


<?php
  include_once "footer.php";
?>
</body>
</html>