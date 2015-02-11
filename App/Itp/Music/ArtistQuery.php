<?php

namespace Itp\Music;
require_once $_SERVER['DOCUMENT_ROOT'] . '/vendor/autoload.php';



class ArtistQuery extends \Itp\Base\Database {

	

	public function __construct()
	{
		
		parent::__construct();

	}

	public function getAll()
	{

		$sql = "
		SELECT artist_name
		FROM artists
		ORDER BY artist_name 
		";

		$statement = static::$pdo->prepare($sql);
		$statement->execute();
		$artists = $statement->fetchAll(\PDO::FETCH_OBJ);

		return $artists;
	}

	public function getArtistId($artistName)
	{
		$sql = "
		SELECT id
		FROM artists
		WHERE artist_name = ?
		LIMIT 1
		";
		$statement = static::$pdo->prepare($sql);
		$statement->bindParam(1,$artistName);
		$statement->execute();
		$artistId = $statement->fetch(\PDO::FETCH_OBJ);

		echo $artistId->id;
	}
}

?>