<?php
session_start();
$logged = null;
if (isset($_SESSION['username'])):$logged = $_SESSION['username'];
endif;
?>
<!DOCTYPE html>

<html>
    <head>
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap.min.css">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/js/bootstrap.min.js"></script>
        <link href="style/header.css" rel="stylesheet" type="text/css"/>
        <script src="js/header.js" type="text/javascript"></script>
        <meta charset="UTF-8">
        <title>Game Book's</title>
    </head>
    <body style="background-color: none;">

        <nav class="navbar navbar-inverse">
            <div class="container-fluid">
                <div class="navbar-header">
                    <a class="navbar-brand" href="#">GameBook</a>
                </div>
                <ul class="nav navbar-nav">
                    <li id="begin"><a onclick="go();" href="index.php">Начало</a></li>
                    <li class="dropdown">
                        <a class="dropdown-toggle" data-toggle="dropdown" href="#" >Произведения <span class="caret"></span></a>
                        <ul class="dropdown-menu">
                            <li><a href="story.php">Всички произведения</a></li>
                            <li><a href="story.php?authorid=<?=md5($_SESSION['userid']);?>">Моите произведения</a></li>
                            <li><a href="story.php?favorites=<?=$_SESSION['userid'];?>">Абонаменти</a></li>
                        </ul>
                    </li> 
                    <li id="authors"><a href="authors.php">Автори</a></li>
                    <!--<li id="story"><a href="story.php">Произведения</a></li>-->
                </ul>
                <ul class="nav navbar-nav navbar-right">
                    <?php if (!$logged) { ?>
                        <li><a href="#"  ><span class="glyphicon glyphicon-user"></span> Регистрация</a></li>
                        <li><a href="#" onclick="login();"><span class="glyphicon glyphicon-log-in"></span> Вход</a></li>
                    <?php } else { ?>
                        <li><a href="#"><span class="glyphicon glyphicon-user"></span> Влязъл сте като :<?=$logged;?></a></li>
                        <li><a href="logout.php"><span class="glyphicon glyphicon-log-in"></span> Изход</a></li>
<?php } ?>
                </ul>
            </div>
        </nav>


        <!--<div class="top-line">
            <ul class="top-menu">
                <li onclick="location.href='index.php';">Начало</li>
                <li>Последни качени</li>
                <li onclick="location.href='authors.php';">Автори</li>
        <?php //if(!$logged){?>
                    <li id="register" style="float:right;">Register</li>
                    <li id="login" style="float:right;">Login</li>
        <?php //} if($logged){?>
                    <li id="logout"   style="float:right;"> Изход</li>
                    <li id="login_as"   style="float:right;"><?php //echo "Влязъл сте като ".$logged; ?></li>
<?php //}  ?>
             </ul>
        </div>
        <div class="banner-image">
            <img src="img/banner1.jpg" id="top-banner" class="cover">
        </div> -->

        <!--oninput="up2.setCustomValidity(up2.value != up.value ? 'Passwords do not match.' : '')">
         <p> -->

        <div id="sign_up" 
             style="display: none; 
             left: 50%; margin-left: -223px; 
             z-index: 1002; position: fixed; 
             top: 40%; margin-top: -159px;
             background-color: black;
             padding:20px;
             border-radius: 10px;
             color:white;">
            <!--<h3 id="see_id" class="sprited">Annon edhellen, edro hi ammen</h3>-->
            <img src="https://fontmeme.com/permalink/190503/e4031d1c174b66faa366745b4a95ffa0.png" style="width: 350px;">
            <br><br>
            <form id="sign_up_form" method="post" action="login.php">
                <p><label><strong style="
                                  display: inline-table;
                                  width:45px;margin-right: 30px;">Email:</strong>
                                  <input type="email" 
                                         id="login_email" 
                                         name="login_email" 
                                         required="true"    
                                         placeholder="Въведете email">
                    </label></p>
                <label><strong style="display: inline-table;margin-right: 5px;">Password:</strong>
                    <input type="password" 
                           name="login_password" 
                           id="login_password" 
                           required="true" 
                           placeholder="Въведете парола" ></label>
                <div id="actions">
                    <a class="close form_button sprited" id="cancel" href="#">Cancel</a>
                    <button id="log_in" type="submit" >Sign in</a>
                </div>
            </form>
            <h3 id="left_out" class="sprited">Feeling left out?</h3>
            <span>Don't be sad, just <a href="#">click here</a> to sign up!</span>
            <a id="close_x" class="close sprited" href="#">close</a>
        </div>

        <div id="register" style="display: none;">    
            <p>
                <label >Username: </label>
                <input name="username" id = "username" type="text" required >
            </p>
            <p>
                <label>Password: </label>
                <input name="password" id = "password" type="password" required>
            </p>
            <p>
                <label>Email: </label>
                <input name="email" id = "email" type="email" required>
            </p>
            <input type="button" value="Submit" onclick="login_click()">
            <input type="button" value="Close" onclick="close_login_form();">
        </div>
        <div class="lb_overlay js_lb_overlay" style="display:none;height: 2924px; position: absolute; width: 100%; top: 0px; left: 0px; right: 0px; bottom: 0px; z-index: 1001; background: black; opacity: 0.3;"></div>
        <script>


            function close_login_form() {
                $("#username").val("");
                $("#password").val("");
            }
            
            function go(){
              var c = document.getElementById("begin"); 
              console.log(c+"sdss");
            }
            function login(){
                $("#sign_up").show();
                $("#login_email").val('')
               $("#login_email").focus();
                $("#login_password").val("");
            }
        </script>
        <style>
            
            * {
                margin: 0;
                padding: 0;
                font-size: 1em;
                text-decoration: none;
                border: none;
                list-style: none;
                outline: none;
            }
            #lean_overlay {
                position: fixed;
                z-index:100;
                top: 0px;
                left: 0px;
                height:100%;
                width:100%;
                background: #000;
                display: none;
            }
            input{
                color:black;
            }

        </style>
