<?php

class Story {

    private $db;

    public function __construct() {
        include_once '../DB.php';
        $this->db = new DB();
    }
    
    public function getFavorites($userid){
        $sql = "SELECT * FROM favorites f  inner JOIN story s on  s.id = f.storyid  where f.userid = " . $userid;
        $result = $this->db->query($sql);
        return $result;
    }

    public static function createTable() {
        include_once '../DB.php';

        $db = new DB();
        $sql = "CREATE TABLE IF NOT EXISTS story (
  id INT(11) NOT NULL AUTO_INCREMENT,
  storyname VARCHAR(100) NOT NULL,
  description TEXT DEFAULT NULL,
  storyauthorid INT(11) NOT NULL,
  datecreated TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
  dateupdated TIMESTAMP NULL DEFAULT NULL,
  status TINYINT(4) NOT NULL DEFAULT 1,
  PRIMARY KEY (id)
)
ENGINE = INNODB,
AUTO_INCREMENT = 4,
AVG_ROW_LENGTH = 5461,
CHARACTER SET utf8,
COLLATE utf8_general_ci;";
        $db->query($sql);
    }

}
