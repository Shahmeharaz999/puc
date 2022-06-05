<?php 
    session_start();
    //authorization
    if(!$_SESSION['username']){
      session_destroy();
      header('Location: ../index.php');
    }
    else if($_SESSION['username'] && $_SESSION['role'] != 'student'){
      session_destroy();
      header('Location: ./dashboard.php');
    }

    include("../connection.php");
    $id = $_SESSION['id'];
    $query = "SELECT groups.progress FROM groups, groupMembers WHERE groupMembers.stdId = $id AND groupMembers.groupId = groups.id";
    $sql = mysqli_query($conn, $query);
    $row = mysqli_fetch_array($sql);
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

    <title>Student Progress</title>
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
                <a class="navbar-brand" href="dashboard.php">Dashboard</a>
                <a class="navbar-brand" href="groupCreation.php">Create-Group</a>
                <a class="navbar-brand" href="thesisProgress.php">Progress</a>
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
            <div class="mt-3 mb-5">
                <h4 class="text-center text-secondary">My Progress</h4>
                <h5 class="text-center text-secondary">[Present state - <?php echo $row['progress']; ?>]</h5>
            </div>
            <div class="row">
                <div class="col-3">
                    <div class="card border-secondary mb-3" style="max-width: 18rem;">
                        <div class="card-header">25%</div>
                        <div class="card-body text-secondary">
                            <h5 class="card-title">25% Progress</h5>
                            <p class="card-text">Some paper has been observed and being presented</p>
                            <!-- <a href="" class="btn btn-secondary">25% Proceed</a> -->
                            <form method="post" action="">
                                <input hidden type="text" name="data" value="25%" id="">
                                <button type="submit" name = "submit1" class="btn btn-secondary">25% Proceed</button>
                            </form>
                        </div>
                    </div>
                </div>
                <div class="col-3">
                    <div class="card text-white bg-secondary mb-3" style="max-width: 18rem;">
                        <div class="card-header">50%</div>
                        <div class="card-body">
                            <h5 class="card-title">50% Progress</h5>
                            <p class="card-text">Dataset Being Collected and testified by the group memebers</p>
                            <!-- <a href="" class="btn btn-dark">50% Proceed</a> -->
                            <form method="post" action="">
                                <input hidden type="text" name="data" value="50%" id="">
                                <button type="submit" name = "submit2" class="btn btn-dark">50% Proceed</button>
                            </form>
                        </div>
                    </div>
                </div>
                <div class="col-3">
                    <div class="card text-white bg-dark mb-3" style="max-width: 18rem;">
                        <div class="card-header">75%</div>
                        <div class="card-body">
                            <h5 class="card-title">75% Progress</h5>
                            <p class="card-text">Code is being implemented and tested for the dataset</p>
                            <!-- <a href="" class="btn btn-secondary">75% Proceed</a> -->
                            <form method="post" action="">
                                <input hidden type="text" name="data" value="75%" id="">
                                <button type="submit" name = "submit3" class="btn btn-secondary">75% Proceed</button>
                            </form>
                        </div>
                    </div>
                </div>
                <div class="col-3">
                    <div class="card text-white bg-success mb-3" style="max-width: 18rem;">
                        <div class="card-header">100%</div>
                        <div class="card-body">
                            <h5 class="card-title">100% Progress</h5>
                            <p class="card-text">Benchmark result has been published &the research is done</p>
                            <!-- <a href="" class="btn btn-dark">100% Proceed</a> -->
                            <form method="post" action="">
                                <input hidden type="text" name="data" value="100%" id="">
                                <button type="submit" name = "submit4" class="btn btn-dark">100% Proceed</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </body> 
</html>

<?php 
    if(isset($_POST['submit1']) || isset($_POST['submit2']) || isset($_POST['submit3']) || isset($_POST['submit4']))
    {
        $id = $_SESSION['id'];
        $data = $_POST['data'];
        
        $query = "UPDATE groups, groupMembers SET groups.progress='$data' WHERE groupMembers.stdId = $id AND groupMembers.groupId = groups.id";
        if(mysqli_query($conn, $query)){
            echo "<script> location.href='./thesisProgress.php'; </script>";
        }
    }
?>