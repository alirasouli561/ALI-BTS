<?php
     @include("base.php");
 ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>FlexiBuro</title>
</head>
<body>
    <div class="full-page">

    <div class="navbar">
            <div>
                <a href='index.php'>FlexiBuro</a>
            </div>
            <nav>
                <ul id='MenuItems'>
                    <li><button class='loginbtn' onclick="document.getElementById('login-form').style.display='block'" style="width:auto;">LOGIN</button></li>
                </ul>
            </nav>
        </div>

        <div id='login-form' class='login-page'>
            <div class="form-box">
                <div class='button-box'>
                    <div id='btn'></div>
                    <button type='button' onclick='login()' class='toggle-btn'>Se connecter</button>
                    <button type='button' onclick='register()' class='toggle-btn'>S'enregistrer</button>
                </div>

                <form action="login.php" method="post" id='login' class='input-group-login'>
                    <input type='text' name="login" class='input-field' placeholder='login' required>
                    <input type='password' name="mdp" class='input-field' placeholder='mot de passe' required>
                    <input type='checkbox' class='check-box'><span>se souvenir du mot de passe</span>
                    <button type='submit' value="Identifiez vous" class='submit-btn'>Login</button>
                </form>


             <form action="enregistre.php" method="post" id='register' class='input-group-register'>
            <input type='text' name="nom" class='input-field' placeholder='nom' required>
            <input type='text' name="prenom" class='input-field' placeholder='prenom' required>
              <input type='text' name="login" class='input-field' placeholder='login' required>
              <input type='password' name="mdp" class='input-field' placeholder='mot de passe' required>
              <input type='checkbox' class='check-box'><span>J'accepte les termes et conditions</span>
              <button type='submit' value="S'enregistrer" class='submit-btn'>S'enregistrer</button>
     </form>
            </div>
        </div>
    </div>

<script>
        var x = document.getElementById('login');
        var y = document.getElementById('register');
        var z = document.getElementById('btn');

        function register() {
            x.style.left = '-400px';
            y.style.left = '50px';
            z.style.left = '110px';
        }

        function login() {
            x.style.left = '50px';
            y.style.left = '450px';
            z.style.left = '0px';
        }
    </script>

<script>
        var modal = document.getElementById('login-form');
        window.onclick = function(event) {
            if (event.target == modal) {
                modal.style.display = "none";
            }
        }
    </script>
</body>
</html>

    <style>*

body {
  background-image: url("image.jpg");
}
        {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }
        .full-page
        {
            height: 100%;
            width: 100%;
            background-image: linear-gradient(rgba(0,0,0,0.4),rgba(0,0,0,0.4)),url(image.jpg);
            background-position: center;
            background-size: cover;
            position: absolute;
        }
        .navbar
        {
            display: flex;
            align-items: center;
            padding: 20px;
            padding-left: 50px;
            padding-right: 30px;
            padding-top: 40px;
        }
        nav
        {
            flex: 1;
            text-align: center;
        
        }
        nav ul 
        {
            display: inline-block;
            list-style: none;
        }
        nav ul li
        {
            display: inline-block;
            margin-right: 70px;
        }
        nav ul li a
        {
            text-decoration: none;
            font-size: 20px;
            color: white;
            font-family: sans-serif;
        }
        nav ul li button
        {
            color: darken(#8c7569, 5%);
            font-family: "Nunito", sans-serif;
            font-size: 18px;
            cursor: pointer;
            border: 0;
            outline: 0;
            padding: 10px 40px;
            border-radius: 30px;
            background: rgb(255, 255, 255);
            box-shadow: 0 10px 40px rgba(0, 0, 0, 0.16);
            transition: 0.3s;
            margin-top: 0.5 px;
            
        }
        nav ul li button:hover
        {
            color: rgb(168, 50, 3);
        }
        nav ul li a:hover
        {
            color: rgb(173, 38, 0);
        }
        a
        {
            text-decoration: none;
            color: rgb(250, 250, 250);
            font-size: 28px;
        }
        #login-form
        {
            display: none;
        }
        .form-box
        {
            width:380px;
            height:480px;
            position:relative;
            margin:2% auto;
            background:rgba(0,0,0,0.3);
            padding:10px;
            overflow: hidden;
        }
        .button-box
        {
            width:281px;
            margin:35px auto;
            position:relative;
            box-shadow: 0 0 20px 9px #ff61241f;
            border-radius: 30px;
        }
        .toggle-btn
        {
            padding:10px 30px;
            cursor:pointer;
            background:transparent;
            border:0;
            outline: none;
            position: relative;
        }
        #btn
        {
            top: 0;
            left:0;
            position: absolute;
            width: 167px;
            height: 110%;
            background: #F3C693;
            border-radius: 30px;
            transition: .5s;
        }
        .input-group-login
        {
            top: 150px;
            position:absolute;
            width:280px;
            transition:.5s;
        }
        .input-group-register
        {
            top: 120px;
            position:absolute;
            width:280px;
            transition:.5s;
        }
        .input-field
        {
            width: 100%;
            padding:10px 0;
            margin:5px 0;
            border-left:0;
            border-top:0;
            border-right:0;
            border-bottom: 1px solid #999;
            outline:none;
            background: transparent;
        }
        .submit-btn
        {
            width: 85%;
            padding: 10px 30px;
            cursor: pointer;
            display: block;
            margin: auto;
            background: #F3C693;
            border: 0;
            outline: none;
            border-radius: 30px;
        }
        .check-box
        {
            margin: 30px 10px 34px 0;
        }
        span
        {
            color:#777;
            font-size:12px;
            bottom:68px;
            position:absolute;
        }
        #login
        {
            left:50px;
        }
        #login input
        {
            color:white;
            font-size:15;
        }
        #register
        {
            left:450px;
        }
        #register input
        {
            color:white;
            font-size: 15;
        }
    </style>
</body>
</html>
