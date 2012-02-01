<?php

require '../bandcamp.php';

$discography = getDiscography();
foreach($discography as $album)
{
  echo $album['image'].'<br />'."\n";
  echo 'title: <b>'.$album['title'].'</b><br />'."\n";
  echo 'artist: <b>'.$album['artist'].'</b><br />'."\n";
  echo 'released: <b>'.$album['released'].'</b><br /><br /><br />'."\n";
}

?>