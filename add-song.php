<?php


use \Itp\Music;
use \Itp\base;
use Symfony\Component\HttpFoundation\Session\Session;

require_once $_SERVER['DOCUMENT_ROOT'] . '/vendor/autoload.php';


 $session = new \Symfony\Component\HttpFoundation\Session\Session();
 $session->start();
 $artistQuery = new \Itp\Music\ArtistQuery();
 $genreQuery = new \Itp\Music\GenreQuery();
 $genresList = $genreQuery->getAll();
 $artistsList = $artistQuery->getAll();


if(isset($_POST['submit']))
  {
      $song = new \Itp\Music\Song($_POST["title"],$_POST["artist"],$_POST["genre"],$_POST["price"]);
      $song->save();

	  $session->getFlashBag()->add('successfulInsert', "The song " . $song->getTitle() . " with an ID of " . $song->getId() . " was inserted successfully!");
	  header('Location: add-song.php');

     exit();
  }

?>


<html>
	<head>
		<title>Song Insert</title>
		<link href="css/bootstrap.min.css" rel="stylesheet">
		<link href="js/bootstrap.min.js" rel="stylesheet">
	</head>

	<body>
		<div class="container">
			<h2>Song Insert</h2>
			<form role="form" method="post">
				<div class="form-group">
      				<label for="title">Title:</label>
      				<input class="form-control" name="title" id="title" placeholder="Title">
    			</div>

    			<div>
      				<label for="artist">Artist:</label>
      				<select class="form-control" name="artist" id="artist" placeholder="Artist">
      					<?php foreach($artistsList as $artist) : ?>
      					<div>
      						<option value = "<?php $artistQuery->getArtistId($artist->artist_name) ?>"> <?php echo $artist->artist_name ?> </option>
      					</div>
      					<?php endforeach; ?>
   					</select>
   					
    			</div>

    			<div class="form-group">
      				<label for="genre">Genre:</label>
      				<select class="form-control" name="genre" id="genre" placeholder="Genre">
      					<?php foreach($genresList as $genre) : ?>
      					<option value = "<?php $genreQuery->getGenreId($genre->genre) ?>"> <?php echo $genre->genre ?> </option>
      					<?php endforeach; ?>
					</select>
					
    			</div>

    			<div class="form-group">
      				<label for="title">Price:</label>
      				<input class="form-control" name="price" id="price" placeholder="Price">
    			</div>

    			

    			<div class="form-group">
      				<button type="submit" name="submit" class="btn">Submit</button>
    			</div>
				<div>
					<?php foreach($session->getFlashBag()->get("successfulInsert") as $flashMessage) : ?>
						<?php echo $flashMessage ?>
					<?php endforeach; ?>
				</div>

    			
    	</div>

    	<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
    	<script src="js/bootstrap.min.js"></script>

    </body>
</html>