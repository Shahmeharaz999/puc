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

    <title>Assign group-supervisor</title>
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
                            <div class="card-header">Create Group</div>
                            <div class="card-body">
                                <form method="post" action="assignGroup.php">
                                    <div class="form-group">
                                        <label class="form-label" for="name">Choose Supervisor</label>
                                        <select name="supervisor" id="" class="form-control">
                                            <option value="">- Choose supervisor -</option>
                                            <?php  
                                                include '../connection.php';
                                                $query = "SELECT * FROM `users` WHERE role = 'teacher'";
                                                $sql = mysqli_query($conn, $query);
                                                while($row = mysqli_fetch_array($sql))
                                                { ?>
                                                    <option value="<?php echo $row['id']; ?>"> <?php echo $row['name']; ?> </option>
                                                <?php
                                                }
                                            ?>
                                        </select>
                                    </div>
                                    <div class="form-group">
                                    <label class="form-label" for="name">Choose Group</label>
                                        <select name="group" id="" class="form-control">
                                            <option value="">- Choose group -</option>
                                            <?php  
                                                $query = "SELECT * FROM `groups` WHERE status = 0";
                                                $sql = mysqli_query($conn, $query);
                                                while($row = mysqli_fetch_array($sql))
                                                {
                                                    $grpId = $row['id'];
                                                    $query1 = "SELECT users.name FROM `groupMembers`, `users` WHERE groupId = $grpId AND groupMembers.stdId = users.id";
                                                    $sql1 = mysqli_query($conn, $query1);
                                                    
                                                    ?>
                                                    <option value="<?php echo $row['id']; ?>"> 
                                                    <?php 
                                                        echo $row['projectName']; 
                                                        while($row1 = mysqli_fetch_array($sql1))
                                                        {
                                                            ?>
                                                            <p>[<?php echo $row1['name']; ?>]</p>
                                                            <?php
                                                        }
                                                    ?> 
                                                    </option>
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
      $supervisorId = $_POST['supervisor'];
      $groupId = $_POST['group'];
      //db query
      $query = "UPDATE `groups` SET `status`=1 WHERE id = $groupId";
      mysqli_query($conn, $query);

      $query = "INSERT INTO `groupSupervision`(`groupId`, `teacher_id`, `status`) VALUES ($groupId, $supervisorId, 0)";
      if(mysqli_query($conn, $query))
      {
          echo "<script> alert('successfully assigned!!');</script>";
      }
    }
?>