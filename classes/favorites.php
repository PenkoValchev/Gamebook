<?php

class Favorites {
    //put your code here
    private $db;
    public function __construct() {
        include '../db.php';
        $this->db= new DB();
    }
    function createTable(){
        $sql="CREATE TABLE `game`.`favorites` ( `id` INT NOT NULL AUTO_INCREMENT , `storyid` INT NOT NULL , `userid` INT NOT NULL , PRIMARY KEY (`id`)) ENGINE = InnoDB;";
    }
    public function fakeData(){
        $sql = "INSERT INTO favorites(`storyid`,`userid`) VALUES(1,2),(1,3),(4,1),(4,2)";
        $this->db->query($sql);
        
    }
    public function getData(){
         $sql = "SELECT * FROM favorites f  inner JOIN story s on  s.id = f.storyid  where f.userid = 4";
         $result = $this->db->query($sql);
         echo "<pre>";
         echo $sql;
         print_r($result);
    }
}
$fv = new Favorites();
$fv->getData();
 