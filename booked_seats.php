<?php
include_once './session.php';
include_once './inc/services/class.user.php';
$user = new User();
  if($_SESSION['user_type']=='student'){
    include './top_inc/top_head_ass.php';
    include './top_inc/top_header.php';
  }
  ?>

  <?php
    if($_SESSION['user_type']=='student'){
      ?>
  <div class="content-wrapper">
      <div class="container">
        <!-- student Content Header (Page header) -->


        <!-- Main content -->
        <section class="content">
          <?php
            if(isset($_POST['insert_mark'])){
              $table= 'student_mark';
              $row='student_id,10th_avg,12th_avg';
              $insert = $user->insert($table,array($_SESSION['user_id'],$_POST['10avg'],$_POST['12avg']),$row);
              echo '<script>alert("Mark Submitted Successfully")</script>';
            }
            $table='student_mark';
            $where='student_id ="'.$_SESSION['user_id'].'"';
            $details = $user->select($table,$rows='*',$where);

            if($details){
                $_SESSION['student_10_avg'] = $details[0]['10th_avg'];
                $_SESSION['student_12_avg'] = $details[0]['12th_avg'];
                ?>
                 <div class="box">
              <div class="box-header">
                <h3 class="box-title">Booked Seats</h3>
              </div>
              <!-- /.box-header -->
              <div class="box-body">
                <table id="example1" class="table table-bordered table-striped">
                  <thead>
                  <tr>
                     <th>College Name</th>
                    <th>Department</th>
                    <th>College Email</th>
                    <th>Booked Date</th>
                    <!-- <th>Action</th> -->
                  </tr>
                  </thead>
                  <tbody>
                  <?php

                      $table='book_details bd join users u on u.id = bd.student_id join department_master d on bd.department_id = d.id join college_master c on d.college_id = c.id';
                      $where='bd.student_id = "'.$_SESSION['user_id'].'" ';
                      $details = $user->select($table,$rows='bd.*,u.*,d.*,c.*',$where);
                      if($details){
  					foreach($details as $d)
  					{
  				?>
                  <tr>
                  <td><?php echo $d['college_name'];?></td>
                  <td><?php echo $d['course_name'];?></td>
                  <td><?php echo $d['college_email'];?></td>
                  <td><?php echo $d['booked_date'];?></td>

                     <!-- <td>
                     <a href="book_college.php?id=<?php echo $d['id'];?>"><button class="btn btn-primary"><i class="fa fa-edit "></i></button></a>
                     </td> -->
                  </tr>
            <?php }}
            ?>
                  </tbody>
                  <tfoot>
                  <tr>
                    <th>College Name</th>
                   <th>Department</th>
                   <th>College Email</th>
                   <th>Booked Date</th>
                    <!-- <th>Action</th> -->
                  </tr>
                  </tfoot>
                </table>
              </div>
              <!-- /.box-body -->
            </div>

                <?php
            }
            else{
              // echo 'Please Provide Mark';
              ?>
               <div class="col-md-6 col-md-offset-2 ">
               <h1>Enter The mark</h1>
               <form action="" method="post">
                <div class="form-group has-feedback">
                  <input type="number" class="form-control" name='10avg' placeholder="10th Avg">
                  <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
                </div>
                <div class="form-group has-feedback">
                  <input type="number" class="form-control" name='12avg' placeholder="12th Avg">
                  <span class="glyphicon glyphicon-lock form-control-feedback"></span>
                </div>
                <div class="row">
                  <!-- /.col -->
                  <div class="col-xs-4">
                    <button type="submit" name='insert_mark' class="btn btn-primary btn-block btn-flat">Submit</button>
                  </div>
                  <!-- /.col -->
                </div>
              </form>
              </div>
              <?php
            }

          ?>

        </section>
        <!-- /.content -->
      </div>
      <!-- /.container -->
    </div>
    <?php } ?>



    <?php
    if($_SESSION['user_type']=='student'){
      include './top_inc/top_footer.php';
    }
    ?>
