<?php
    include '../db.php';
    $db= new DB();
    $sql = "SELECT DISTINCT s.id, s.storyname, s.description,s.dateupdated,u.id as userid, u.name as username FROM story s LEFT JOIN user u ON u.id = s.storyauthorid ORDER BY dateupdated DESC LIMIT 10";
    $result = $db->query($sql);
    $stream="";
    
    foreach ($result as $book) {
        $stream .= "<tr><td><p class='paragraf-border'><span class='font08 lightgrey'><i>"
                .$book['dateupdated']
                ."</i></span>"
                ."<br><span class='font102'><b>"
                ."<a class='story_link' href='story.php?id=".$book['id']."'>"
                .$book['storyname']."</b></a></span><br>"
                ."<span class='font1' style='font-size:1em;'>"
                .$book['description']."</span><br>"
                ."<span class='font08'><i>от </i><a href='profile.php?id=".$book['userid']."'><b>".$book['username']."</b></a></span><br>"
        ."</p></td></tr>";
 
}
echo $stream;