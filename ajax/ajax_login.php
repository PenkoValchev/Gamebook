<?php
session_start();
    $link = mysqli_connect("127.0.0.1", "root", "", "game");
   
      //Verbindung überprüfen
  
    if(!isset($_POST['username'])||!isset($_POST['password'])){
        echo "sss0";
    }else {
        $md5=md5($_POST['password']); 
        $query = "SELECT * FROM user WHERE name='".$_POST['username']."' AND password='".$md5."'";
        
        $result = mysqli_query($link, $query);
        
        if($result->num_rows>0){
            $_SESSION['username']=$_POST['username'];
            echo "1";
        }else {
            echo '0';
        }
            
        
//echo json_encode(["username"=>$_POST['username'],"password"=>$_POST['password']]);
    }
    