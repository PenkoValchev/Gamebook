<?php
include 'header.php';
include 'db.php';
$db = new DB();
if (isset($_REQUEST['id'])) {
    $id = $_REQUEST['id'];
} else {
    die("Няма такъв автор!");
}
$sql = "SELECT * FROM user WHERE user.id =" . $id;
$author = $db->query($sql)[0];
$sql = "SELECT * FROM story WHERE storyauthorid =" . $id;
$db = new DB();
$story = $db->query($sql);
//echo "<pre>";
//echo $sql;
//print_r($story);
 
?>
<link href="style/content.css" rel="stylesheet" type="text/css"/>

<fieldset class="content" style=""><legend style=";">Профил на автора <?= $author['name']; ?></legend><h2><?= $author['name']; ?></h2><span  style="float:left; display:block; font-style: italic;">Регистриран на <?= $author['timeofregistration'];
?></span><br><span style="float:left; display:block;font-style: italic">Последно видян на: <?= $author['lastlogin']; ?></span>
<br><p><h4>Произведения</h4>
<?php if(!$story) {
   echo "Няма произведения" ;
}else{
    echo "<ul style='padding-left:20px;'>";
   
    foreach ($story as $key => $value) {
        $id=$value['id'];
        echo "<li><b><a href='story.php?id=".$id."'>".$value['storyname']."</a></b></li>";
    }
    echo "</ul>";
}

?>
</p>
</fieldset>