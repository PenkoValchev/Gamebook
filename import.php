<?php
  $link = mysqli_connect("127.0.0.1", "root", "", "game");
  $username = "pesho";
  $password='1';
  $query = "INSERT INTO user (name, password) VALUES( '".$username."','".md5($password)."')";
        $result = mysqli_query($link, $query);
            
         