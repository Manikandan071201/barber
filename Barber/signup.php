<!DOCTYPE html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
    <link rel="stylesheet" href="./login.css">
    <title>signup</title>
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
          <?php
          if(isset($_POST["submit"])){
            $username = $_POST["username"];
            $email = $_POST["email"];
            $password = $_POST["password"];
            $passwordreenter = $_POST["repassword"];

            $passwordHash = password_hash($password, PASSWORD_DEFAULT);

            $errors = array();

            if(empty($username) OR empty($email) OR empty($password) OR empty($passwordreenter)) {
              array_push($errors,"All fields are required");
            }
            if(!filter_var($email, FILTER_VALIDATE_EMAIL)){
              array_push($errors, "Email is not vaild");
            }
            if(strlen($password)<8) {
              array_push($errors, "password must be at least 8 charactes long"); 
            }
            if($password!==$passwordreenter) {
              array_push($errors, "password does not match");
            }
            require_once "database.php";
            $sql ="SELECT *FROM users WHERE email = '$email'";
            $result = mysqli_query($conn, $sql);
            $rowCount = mysqli_num_rows($result);
            if($rowCount>0) {
              array_push($errors,"email already exists!");
            }
            if(count($errors)>0) {
              foreach($errors as $error) {
                echo"<div class='alert alert-danger'>$error</div>";
              }
            }else{
            
              $sql ="INSERT INTO users(name,email, password) values ( ?, ?, ? )";
              $stmt = mysqli_stmt_init($conn);
              $preparestmt = mysqli_stmt_prepare($stmt,$sql);
              if($preparestmt) {
                mysqli_stmt_bind_param($stmt,"sss",$username,$email,$passwordHash);
                mysqli_stmt_execute($stmt);
                echo "<div class='alert alert-success'>You are registered successfully</div>";
                header("location: login.php");
              }else{
                die("something went wrong");
              }
            }
          }
          ?>
            <h2 class="form-head text-center">SIGN UP</h2>
        <form action="signup.php" method="post">
            <div class="form-group">
                <label class="form-text" for="username">Username:</label>
                <input type="text" class="form-control"name="username" id="username">
              </div>
              <div class="form-group">
                <label class="form-text" for="username">gmail:</label>
                <input type="text" class="form-control" name="email" id="username">
              </div>
              <div class="form-group">
                <label class="form-text" for="password">Password:</label>
                <input type="password" class="form-control" name="password" id="password">
              </div>
              <div class="form-group">
                <label class="form-text" for="password"> re enter Password:</label>
                <input type="password" class="form-control" name="repassword" id="password">
              </div>
              <button type="submit" class="btn btn-primary btn-block" name="submit">SIGNUP</button>
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