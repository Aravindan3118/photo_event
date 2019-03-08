<?php 
    include_once './session.php';
    if($_SESSION['user_type'] != 'superadmin'){
      header('location:index.php');
    }
  	include 'inc/header.php';
    include 'inc/sidebar.php';
    include 'inc/services/class.user.php';
    $user = new User();
    if(isset($_POST['submit'])){
      $event_name = $_POST['event_name'];
      $event_des = $_POST['event_des'];
      $event_date = $_POST['event_date'];
      $end_date = $_POST['end_date'];
      $age = $_POST['age'];
      $fare = $_POST['fare'];
      
      $table1= 'event_master';
      $row='date,booking_close_at,event_des,min_age,amount,event_title';
      $insert = $user->insert($table1,array($event_date,$end_date,$event_des,$age,$fare,$event_name),$row);
      
      if($insert){
        echo '<script>alert("Event Added")</script>';
      }
      else{
        echo '<script>alert("something went wrong")</script>';
      }
  

    }
 ?>
   <div class="content-wrapper">
    <section class="content-header">
       
    </section>

    <!-- Main content -->
    <section class="content container-fluid">
    <div class="container">
  
  <section class="content ">
  <div class="register-box-body col-md-4 col-md-offset-3">
  <p class="login-box-msg">Add College</p>

  <form action="" method="post">
    <div class="form-group has-feedback">
      <input type="text" class="form-control" name='event_name' placeholder="Event Name">
      <span class="glyphicon glyphicon-user form-control-feedback"></span>
    </div>
    
    <div class="form-group">
      <label>Event Description</label>
      <textarea name="event_des" class="form-control" rows="3" placeholder="Enter ..."></textarea>
    </div>

    <div class="form-group has-feedback">
      <label for="event_date">Event Date</label>
      <input id="event_date" type="date" class="form-control" name='event_date'>
      <span class="glyphicon glyphicon-calendar form-control-feedback"></span>
    </div>
    <div class="form-group has-feedback">
      <label for="end_date">Register End date</label>
      <input id="end_date" type="date" class="form-control" name='end_date'>
      <span class="glyphicon glyphicon-calendar form-control-feedback"></span>
    </div>
    <div class="form-group has-feedback">
      <input type="number" class="form-control" name='age' placeholder="Min Age">
      <span class="glyphicon glyphicon-calendar form-control-feedback"></span>
    </div>
    <div class="form-group has-feedback">
      <input type="text" class="form-control" name='fare' placeholder="fare">
      <!-- <span class="glyphicon glyphicon-dollar form-control-feedback"></span> -->
    </div>
    <div class="row">
   
      <!-- /.col -->
      <div class="col-xs-4">
        <button type="submit" name='submit' class="btn btn-primary btn-block btn-flat">Add Event</button>
      </div>
      <!-- /.col -->
    </div>
  </form>
 
</div>

  </section>
</div>
    </section>
  </div>

  <?php 
  include 'inc/footer.php';
   ?>