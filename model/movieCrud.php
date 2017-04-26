<?php

class MovieCrud {
	private $db;

	public function __construct(PDO $connection) {
		$this->db = $connection;
	}

    public function readAll() {
		$sql = 'SELECT * FROM `films`';
		$stm = $this->db->prepare($sql);
		$stm->execute();
		$stm->setFetchMode(PDO::FETCH_CLASS, 'Movies');
		return $stm->fetchAll();
	}

	public function getById($id) {
		$sql = 'SELECT * FROM `films` WHERE `id`=:id';
		$stm = $this->db->prepare($sql);
		$stm->bindparam(":id", $id);
		$stm->execute();
		$stm->setFetchMode(PDO::FETCH_CLASS, 'Movies');
		return $stm->fetch();
	}

	public function update($id, $title, $altTitle, $director, $country, $year) {
        $sql = 'UPDATE `films` SET `title`=:title, `altTitle`=:altTitle, `director`=:director, `country`=:country, `year`=:year WHERE `id`=:id';
        $stm = $this->db->prepare($sql);
        $stm->bindparam(":id", $id);
        $stm->bindparam(":title", $title);
        $stm->bindparam(":altTitle", $altTitle);
        $stm->bindparam(":director", $director);
        $stm->bindparam(":country", $country);
        $stm->bindparam(":year", $year);
        if (!empty($movies = $stm->execute())) {
            return $movies;
        }
        else
            return false; //@TODO
    }

    public function create($title, $altTitle, $director, $country, $year) {
		$sql = 'INSERT INTO `films` (`title`, `altTitle`, `director`, `country`, `year`) VALUES (:title, :altTitle, :director, :country, :year)';
		$stm = $this->db->prepare($sql);
        $stm->bindparam(":title", $title);
		$stm->bindparam(":altTitle",$altTitle);
		$stm->bindparam(":director",$director);
		$stm->bindparam(":country",$country);
		$stm->bindparam(":year",$year);
		if (!empty($movies=$stm->execute())) {
            return $movies;
        }
        else
		    return false; //@TODO
	}

	public function delete($id) {
	    $sql = 'DELETE FROM `films` WHERE `id`=:id';
	    $stm = $this->db->prepare($sql);
	    $stm->bindparam(":id", $id);
	    $stm->execute();
	    $stm->setFetchMode(PDO::FETCH_CLASS, 'Movies');
	    return $stm->fetch();
    }
}