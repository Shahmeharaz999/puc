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

    <title>Group Creation</title>
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
            <div class="col-9">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="card border-secondary mt-5 mb-3" style="max-width: 32rem;">
                            <div class="card-header">Create Group</div>
                            <div class="card-body">
                                <form method="post" action="groupCreation.php">
                                    <div class="form-group">
                                        <label class="form-label" for="name">Group Name</label>
                                        <input type="text" name = "name" class="form-control">
                                    </div>
                                    <div class="form-group">
                                        <label class="form-label" for="grpmembers">Group member</label>
                                        <select name="member1" id="" class="form-control">
                                            <option value="">- Choose member 1 -</option>
                                            <?php  
                                                include("../connection.php");
                                                $query = "SELECT * FROM `users` WHERE role = 'student'";
                                                $sql = mysqli_query($conn, $query);
                                                while($row = mysqli_fetch_array($sql))
                                                {?>
                                                    <option value="<?php echo $row['id']; ?>"> <?php echo $row['name']; ?> </option>
                                                    <?php
                                                }
                                                ?>
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <select name="member2" id="" class="form-control">
                                            <option value="">- Choose member 2 -</option>
                                            <?php  
                                                $query = "SELECT * FROM `users` WHERE role = 'student'";
                                                $sql = mysqli_query($conn, $query);
                                                while($row = mysqli_fetch_array($sql))
                                                {?>
                                                    <option value="<?php echo $row['id']; ?>"> <?php echo $row['name']; ?> </option>
                                                <?php
                                                }
                                            ?>
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <select name="member3" id="" class="form-control">
                                            <option value="">- Choose member 3 -</option>
                                            <?php  
                                                $query = "SELECT * FROM `users` WHERE role = 'student'";
                                                $sql = mysqli_query($conn, $query);
                                                while($row = mysqli_fetch_array($sql))
                                                {?>
                                                    <option value="<?php echo $row['id']; ?>"> <?php echo $row['name']; ?> </option>
                                                <?php
                                                }
                                            ?>
                                        </select>
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
    if(isset($_POST['submit']))
    {
        //recvd data from input/control
        $name = $_POST['name'];
        $m1 = $_POST['member1'];
        $m2 = $_POST['member2'];
        $m3 = $_POST['member3'];
        
        $query = "INSERT INTO `groups`(`projectName`, `status`) VALUES ('$name', 0)";
        $sql = mysqli_query($conn, $query);

        $query = "SELECT `id` FROM `groups` WHERE projectName='$name'";
        $sql = mysqli_query($conn, $query);
        $row = mysqli_fetch_assoc($sql);
        $grpId = $row['id'];
        
        $query ="INSERT INTO `groupMembers`(`groupId`, `stdId`) VALUES ($grpId, $m1)";
        $sql = mysqli_query($conn, $query);
        $query = "INSERT INTO `groupMembers`(`groupId`, `stdId`) VALUES ($grpId, $m2)";
        $sql = mysqli_query($conn, $query);
        $query = "INSERT INTO `groupMembers`(`groupId`, `stdId`) VALUES ($grpId, $m3)";
        $sql = mysqli_query($conn, $query);
    }
?>