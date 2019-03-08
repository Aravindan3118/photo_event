<?php 
	// include './admin/inc/header.php';
    // include './inc/sidebar.php';

    include './inc/services/class.user.php';
    include './inc/head_ass.php';
    $user = new User();
    if(isset($_POST['submit'])){
      $firstname = $_POST['student_name'];
      $email = $_POST['email'];
      $password = $_POST['password'];
      $mobile_num = $_POST['mobile_num'];
      $dob = $_POST['dob'];

      $table1= 'users';
      $row='firstname,email,password,mobile,dob';
      $insert = $user->insert($table1,array($firstname,$email,$password,$mobile_num,$dob),$row);
      
      if($insert){
        echo '<script>alert("User Registered")</script>';
      }
      else{
        echo '<script>alert("something went wrong")</script>';
      }

    }
 ?>
   <div class="container">
  
    <section class="content ">
    <div class="register-box-body col-md-4 col-md-offset-4">
    <p class="login-box-msg">Register</p>

    <form action="" method="post">
      <div class="form-group has-feedback">
        <input type="text" class="form-control" name='student_name' pattern="[A-Za-z]+" placeholder="Name" required>
        <span class="glyphicon glyphicon-user form-control-feedback"></span>
        <span style="color: red;">letters only, no punctuation or special characters or numbers</span>
      </div>
      <div class="form-group has-feedback">
        <input type="email" class="form-control" name='email' placeholder="Email" required>
        <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
      </div>
      <div class="form-group has-feedback">
        <input type="password" class="form-control" pattern="^(?=.*\d)(?=.*[a-z])(?=.*[A-Z])(?!.*\s).*$" name='password' placeholder="Password" required>
        <span class="glyphicon glyphicon-lock form-control-feedback"></span>
        <span style="color: red;">Password (UpperCase, LowerCase and Number)</span>
      </div>
      <div class="form-group has-feedback">
        <input type="text" class="form-control" pattern="[0-9]{10}" name='mobile_num' placeholder="Mobile Number required">
        <span class="glyphicon glyphicon-earphone form-control-feedback"></span>
        <span style="color: red;">Mobile number should have 10 numeric values</span>
      </div>
      <div class="form-group has-feedback">
        <label for="dob">DATE OF BIRTH</label>
        <input id="dob" type="date" class="form-control" name='dob' placeholder="" required>
        <span class="glyphicon glyphicon-calendar form-control-feedback"></span>
      </div>
      <div class="row">
      
        <!-- /.col -->
        <div class="col-xs-4">
          <button type="submit" name='submit' class="btn btn-primary btn-block btn-flat">Register</button>
        </div>
        <!-- /.col -->
      </div>
    </form>

    <div class="social-auth-links text-center">
      <p>- OR -</p>
    </div>

    <a href="login.php" class="text-center">I already have a account</a>
  </div>

    </section>
  </div>

  <?php 
//   include './inc/footer.php';
   ?>