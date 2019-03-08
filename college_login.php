<?php 
  session_start();
    include './inc/services/class.user.php';
    include './inc/head_ass.php';
    $user = new User();
    if(isset($_POST['submit'])){

      $email = $_POST['email'];
      $password = $_POST['password'];
      $table='college_master';
	  $rows='*';
	  $where='college_email="'.$_POST['email'].'"  and college_password="'.$password.'"';
      $login = $user->select($table,$rows,$where);
      if($login)
	{
        $_SESSION['login_user'] = $email;
        $_SESSION['user_type'] = $login[0]['user_type'];
        $_SESSION['college_id'] = $login[0]['id'];
        $_SESSION['firstname'] = $login[0]['college_name'];
        // echo 'user_type: '.$_SESSION['user_type'];
        if ($_SESSION['user_type']=='college') {
          header("location:index.php");
        }
    }
    else{

        echo '<script>alert("Invalid User")</script>';
    }

    }
 ?>
   <div class="container">
  
    <section class="content ">
    <div class="register-box-body col-md-4 col-md-offset-4">
    <p class="login-box-msg">College Login</p>

    <form action="" method="post">
      <div class="form-group has-feedback">
        <input type="email" class="form-control" name='email' placeholder="Email">
        <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
      </div>
      <div class="form-group has-feedback">
        <input type="password" class="form-control" name='password' placeholder="Password">
        <span class="glyphicon glyphicon-lock form-control-feedback"></span>
      </div>
      <div class="row">
        <!-- /.col -->
        <div class="col-xs-4">
          <button type="submit" name='submit' class="btn btn-primary btn-block btn-flat">Login</button>
        </div>
        <!-- /.col -->
      </div>
    </form>

   

    </section>
  </div>

  <?php 
//   include './inc/footer.php';
   ?>