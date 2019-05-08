<?php
include '../db.php';
    $db= new DB();
    $id= filter_input(0, $_POST[id]);
    $sql = "SELECT DISTINCT * FROM user WHERE id=".$id;
    $result = $db->query($sql);
    $stream="";
    echo "<pre>";
    echo $sql;
    print_r($result);
    
 

echo $stream;