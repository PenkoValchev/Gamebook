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
    $id = filter_input($_GET['id'], FILTER_VALIDATE_INT);
}

$where = " WHERE 1 ";
if ($id != null) {
    $where = "AND WHERE id=" . $id;
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
        $output .= "<br><i>" . $value['datecreated'] . "</i>";
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