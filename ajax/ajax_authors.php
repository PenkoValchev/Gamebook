<?php
include '../db.php';
    $db= new DB();
    $sql = "SELECT DISTINCT * FROM user WHERE role=1 ORDER BY name";
    $result = $db->query($sql);
    $stream="";
    /*echo "<pre>";
    echo $sql;
    print_r($result);*/
    foreach ($result as $author) {
        $stream .= "<tr><td>"
                 ."<p class='paragraf-border'><span class='font14 lightgrey'>"
                ."<b><a class='story_link' href='profile.php?id=".$author['id']."'>"
                .$author['name']."</b></a></span><br>"
                ."<span class='font07 lightgrey'><i>"
                ."Регистриран на ".$author['timeofregistration']
                ."</i></span><br>"
                ."<span class='font07 lightgrey'><i>"
                ."Последно видян на: ".$author['lastlogin']."</i></span>"
                ."<br><span class='font102'><b>"
        ."</p></td></tr>";
 
}
echo $stream;