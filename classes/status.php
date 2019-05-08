<?php

class status {
   public function __construct() {
       
   }
   
   public static function createTable(){
       $sql="CREATE TABLE `game`.`status` ( `status_id` INT NOT NULL AUTO_INCREMENT , `status_code` VARCHAR(100) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL , PRIMARY KEY (`status_id`)) ENGINE = InnoDB;";
       include '../db.php';
       $db = new DB();
       $db->query($sql);
       $db=new DB();
       $sql = "INSERT INTO status (`status`) VALUES ('<span style=\"color:red;\">пише се</span>'), ('<span style=\"color:blue;\">замразен</span>'),('<span style=\"color:green;\">завършен</span>');";
       $db->query($sql);
               
   }
   public static function showTable(){
       include '../db.php';
       $sql = "SELECT * FROM status";
       $db = new DB();
       $result = $db->query($sql);
       print_r($result);
       foreach ($result as $v){
           echo $v['status'];
       }
   }
}

status::createTable();