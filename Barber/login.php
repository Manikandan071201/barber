<!DOCTYPE html>
<html>
<head>
    <title> Barber Shop </title>
    <link rel = "stylesheet" href="login.css">
    <link rel = "stylesheet"
    href=https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.css>
    <meta name="viewport" content="width =device-wiidth, initial-scale =1">
    <link href="https://fonts.googleapis.com/css2?family=Kaushan+Script&family=Poppins&display=swap" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/gh/cferdinandi/smooth-scroll/dist/smooth-scroll.polyfills.min.js"></script>


    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
    <link rel="stylesheet" href="./login.css">
    <title>Login</title>
    <script>
      function myFunction()
      {
        var x = document.getElementById("password");  
                              
        if (x.type === "password") 
        {
          x.type = "text";
        }
         else
          {
          x.type = "password";
        }
      }
      </script>
  </head>
  <body>
  <img src= "images/logo.png" class="logo">
  <div id="sideNav">
    <nav>
        <ul>
            <li> <a href="index.php">HOME</a></li>
            <li> <a href="#feature">FEATURES</a></li>
            <li> <a href="#service">SERVICES</a></li>
            <li> <a href="#testimonial">TESTIMONIALS</a></li>
            <li> <a href="#footer">MEET US</a></li>
            <li> <a href="login.php">LOG IN</a></li>
            <li> <a href="signup.php">SIGN UP</a></li>
        </ul>
    </nav>
</div>
<div id="menuBtn">
    <img src="images/menu.png" id="menu">
</div>

    <main>
        <div class="form-container">
            <h2 class="form-head text-center">LOGIN</h2>
        <form method="post" action="login.php">
        <?php
      if(isset($_POST["login"])){
        $gmail=$_POST["gmail"];
        $password=$_POST["password"];
        require_once "database.php";
        $sql="SELECT * FROM users WHERE email='$gmail'";
        $result= mysqli_query($conn,$sql);
        $user=mysqli_fetch_array($result,MYSQLI_ASSOC);
        if($user){
          if(password_verify($password, $user["password"])){
            session_start();
            $_SESSION["user"]="yes";
            header("location: index.php");
            die();
          }
          else{
            echo"<div class='alert alert-danger'>password dose not match </div>";
          }
        }else{
          echo"<div class='alert alert-danger'>gmail dose not match </div>";
        }
          }
           ?>
            <div class="form-group">
                <label class="form-text" for="username">gmail:</label>
                <input type="text" name="gmail" class="form-control" id="username" >
              </div>
              <div class="form-group">
                <label class="form-text" for="password">Password:</label>
                <input type="password" class="form-control" name="password" id="password">
                <input type="checkbox"  style=margin-left:90px;margin-top:15px; onclick="myFunction()"><b class="col" style=color:white;>Show Password</b>
              </div>
              <button type="submit" name="login" class="btn btn-primary btn-block">LOGIN</button>
          </form>
        </div>
    </main>
    <script>
    var menuBtn = document.getElementById("menuBtn")
    var sideNav = document.getElementById("sideNav")
    var menu = document.getElementById("menu")

    menuBtn.onclick = function(){
        if(sideNav.style.right =="-250px"){
            sideNav.style.right = "0";
            menu.src = "images/close.png";
        }
        else{
            sideNav.style.right = "-250px";
            menu.src = "images/menu.png";
        }
    }
    </script>

    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
  </body>
</html>