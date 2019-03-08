<?php 
    include_once './session.php';
    include_once './inc/services/class.user.php';
    $user = new User();
    if($_SESSION['user_type'] != 'student'){
        header('location:index.php');
    }
?>
<?php 
  if($_SESSION['user_type']=='student'){
    include './top_inc/top_head_ass.php';
    include './top_inc/top_header.php';
  }

  if(isset($_POST['book_seat'])){
    $table= 'book_details';
    $row='student_id,department_id';
    $insert = $user->insert($table,array($_SESSION['user_id'],$_POST['depid']),$row);
    $send_to = $_POST['collegeemail'];
    $subject = 'Student Seat booking';
    $body = 'New Student Has booked the seats in Your college';
    $sendmail = $user->mailer($send_to,$subject,$body);
    echo '<script>alert("Submitted Successfully");
    window.location.href="index.php";</script>';
    
  }
  if (isset($_GET['id'])) {
      $dep_id = $_GET['id'];
  }
  $table='department_master d join college_master c on d.college_id = c.id';
  $where='d.id ="'.$dep_id.'"';
  $details = $user->select($table,$rows='d.*,c.*',$where); 
  
  $college_name = $details[0]['college_name'];
  $course_name = $details[0]['course_name'];
  $college_email = $details[0]['college_email'];
//   $college_id = $details[0]['college_id'];
?>

 
<div class="content-wrapper">
    <div class="container">
      <section class="content">          
        <h3>College Name : <?php echo $college_name; ?></h3>
        <h3>course Name : <?php echo $course_name; ?></h3>
        <h3>College mail address : <?php echo $college_email; ?></h3>
        <p>The Seat will be booked Only for 2 days please visit college within 2 days</p>
        <form action="payment.php" method='get'>
        <input type="hidden" name="depid" value="<?php echo $dep_id; ?>">
        <input type="hidden" name="collegeemail" value="<?php echo $college_email; ?>">
           <button type='submit' name='book_seat' class='btn btn-info'>Confirm Seat</button>
        </form>
      </section>
      <!-- /.content -->
    </div>
    <!-- /.container -->
  </div>
  

 
  <?php 
  if($_SESSION['user_type']=='student'){
    include './top_inc/top_footer.php';
  }
 
    
    
?>