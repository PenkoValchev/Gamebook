<?php
include "header.php";
include_once 'db.php';
// include_once 'classes/Story.php'; --> not in use for now

if (!isset($_SESSION['userid'])) {
    ?><script>window.location.href = "index.php";</script>
    <?php
}

$id = null;
$sql = "SELECT * FROM story LEFT JOIN status on status_id = status ";
if (isset($_GET['id'])) {
    $id = $_GET['id']*1;
}
 
$where = " WHERE 1 ";
if ($id != null) {
    $where =$where. " AND id=" . $id;
}
if (isset($_GET['authorid'])) {
    $where = $where . "  AND storyauthorid = (SELECT DISTINCT storyauthorid FROM story WHERE SHA1(MD5(storyauthorid)) ='" . $_GET['authorid'] . "')";
}
$sql = $sql . $where;

if (isset($_GET['favorites'])) {
    $sql = "SELECT * FROM favorites f LEFT JOIN story s on s.id = f.storyid LEFT JOIN status on  status_id = status WHERE f.userid =" . $_SESSION['userid'];
}

$db = new DB();
$stories = $db->query($sql);
 

if ($stories == null) {
    $output = "<center><h3>Няма произведения</h3></center>";
} else {
    $output = storyList($stories);
}


function storyList($stories) {
    $output = "";
    foreach ($stories as $key => $value) {
        $output = $output . "<tr><td>";
        $output .= "<h2>" . $value['storyname'] . "</h2><sup>" . $value['status_code'] . "</sup><br>";
        $output .= $value['description'];
        $output .= "<br><small><b>&nbsp;&nbsp;&nbspсъздадено на </b><i>" . $value['datecreated'] . "</i></small>";
        $output .= "<br><small><b>&nbsp;&nbsp;&nbspизменен на </b><i>" . $value['dateupdated'] . "</i></small>";
        $output .= "</td></tr>";
        $output = $output . "<tr><td>&nbsp;";
        $output .= "</td></tr>";
        $output = $output . "<tr class='lst'><td>";
        $output = $output . "<button class ='btn-read'>Прочети</button>";
        $output .= "</td></tr>";
         
    }
  
    return $output;
}
?>
<link href="style/authors_content.css" rel="stylesheet" type="text/css"/>
<fieldset class="content"><legend>Произведения</legend>
    <table class="content_table" >  
<?= $output; ?>
    </table>
</fieldset>
<script>
    $(document).ready(function () {
        $(".active").removeClass('active');
        $("#story").addClass('active');

    });
</script>
<style>
    .btn-read{
            padding:3px 5px;border:1px solid darkgrey;
            background-color: whitesmoke;
            margin-bottom: 10px;
    }
    .btn-read:hover{
          background-color: gray;
          color:white;
          box-shadow: 5px 3px 4px lightslategrey ;
    }
    
    .content_table{
        width: 100%;
    }
    
    .lst{
        padding-bottom: 10px;
        border-bottom: 1px solid black;
    }
    
    </style>