<?php 
    session_start();
    //authorization
    if(!$_SESSION['username']){
      session_destroy();
      header('Location: ../index.php');
    }
    else if($_SESSION['username'] && $_SESSION['role'] != 'admin'){
      session_destroy();
      header('Location: ./dashboard.php');
    }
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="style.css">
        <link href="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
        <script src="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js"></script>
        <script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>

        <title>Teacher Creation</title>
    </head>
    <style>
        @import url(https://fonts.googleapis.com/css?family=Raleway:300,400,600);
        body{
            margin: 0;
            font-size: .9rem;
            font-weight: 400;
            line-height: 1.6;
            color: #212529;
            text-align: left;
            background-color: #f5f8fa;
        }
        .navbar-laravel
        {
            box-shadow: 0 2px 4px rgba(0,0,0,.04);
        }
        .navbar-brand , .nav-link, .my-form, .login-form
        {
            font-family: Raleway, sans-serif;
        }
        .my-form
        {
            padding-top: 1.5rem;
            padding-bottom: 1.5rem;
        }
        .my-form .row
        {
            margin-left: 0;
            margin-right: 0;
        }
        .login-form
        {
            padding-top: 1.5rem;
            padding-bottom: 1.5rem;
        }
        .login-form .row
        {
            margin-left: 0;
            margin-right: 0;
        }
    </style>
    <body>
        <nav class="navbar navbar-expand-lg navbar-light navbar-laravel">
            <div class="container">
                <a class="navbar-brand" href="dashboard.php">Dashborad</a>
                <a class="navbar-brand" href="studentCreation.php">Create-Student</a>
                <a class="navbar-brand" href="teacherCreation.php">Create-Teacher</a>
                <a class="navbar-brand" href="assignGroup.php">Assign-Group</a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav ml-auto">
                        <li class="nav-item">
                            <a class="nav-link" href="../logout.php">Logout</a>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>
        <div class="container">
            <div class="col-9">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="card border-secondary mt-5 mb-3" style="max-width: 32rem;">
                            <div class="card-header">Create Teacher</div>
                            <div class="card-body">
                                <form method="post" action="teacherCreation.php">
                                    <div class="form-group">
                                        <label class="form-label" for="name">Name</label>
                                        <input type="text" name = "name" class="form-control">
                                    </div>
                                    <div class="form-group">
                                        <label class="form-label" for="email">Email</label>
                                            <input type="text" name = "email" class="form-control">
                                    </div>
                                    <div class="form-group">
                                        <label class="form-label" for="password">Password</label>
                                        <input type="text" name = "password" class="form-control">
                                    </div>
                                    <br>
                                    <div class="form-group">
                                        <button type="submit" name = "submit" class="btn btn-primary">Create</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </body> 
</html>

<?php 
    include '../connection.php';
    if(isset($_POST['submit']))
    {
      //recvd data from input/control
      $name = $_POST['name'];
      $email = $_POST['email'];
      $pass = $_POST['password'];
      $role = "teacher";
      //db query
      $query = "INSERT INTO `users`(`name`, `email`, `password`, `role`) VALUES ('$name','$email','$pass','$role')";
      if(mysqli_query($conn, $query))
      {
          echo "<script> alert('successfully created!!');</script>";
      }
    }
?>