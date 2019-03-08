<?php
  include_once './session.php';
  if($_SESSION['user_type'] != 'college'){
    header('location:index.php');
  }
  include './inc/services/class.user.php';
  $user = new User();
	include './inc/header.php';
	include './inc/sidebar.php';
 ?>
   <div class="content-wrapper">
    <section class="content-header">
       
    </section>

    <!-- Main content -->
    <section class="content container-fluid">
    <a href="manage_departments.php"><button class="btn btn-primary">Add departments</button></a>

    <div calss="row">
    <div class="col-md-12">
      <br>
          <!-- Custom Tabs -->
          <div class="nav-tabs-custom">
            <ul class="nav nav-tabs">
              <li class="active"><a href="#tab_1" data-toggle="tab">List</a></li>
              <li><a href="#tab_2" data-toggle="tab">Booked Status</a></li>
            </ul>
            <div class="tab-content">
              <div class="tab-pane active" id="tab_1">
                <div class="box">
                        <div class="box-header text-center">
                          <h3 class="box-title">Departments list</h3>
                        </div>
                        <!-- /.box-header -->
                        <div class="box-body">
                          <table id="example1" class="table table-bordered table-striped">
                            <thead>
                            <tr>
                              <th>Course Name</th>
                              <th>Total seats</th>
                              <th>booked seats</th>
                              <th>Available seats</th>
                              <th>10th average needed</th>
                              <th>12th average needed</th>
                              <th>Action</th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php

                                $table='department_master';

                                $where='college_id ="'.$_SESSION['college_id'].'"';
                                $details = $user->select($table,$rows='*',$where);
                                if($details){
            					foreach($details as $d)
            					{
            				?>
                            <tr>
                              <td><?php echo $d['course_name'];?></td>
                              <td><?php echo $d['total_seats'];?>
                              </td>
                              <td><?php echo $d['booked_seats'];?></td>
                              <td><?php echo $d['total_seats'] - $d['booked_seats'];?></td>
                              <td><?php echo $d['10avg_needed'];?></td>
                              <td><?php echo $d['12avg_needed'];?></td>
                              <td>
                              <a href="manage_departments.php?id=<?php echo $d['id'];?>"><button class="btn btn-primary"><i class="fa fa-edit "></i></button></a>
                              <a href="delete_department.php"><button class="btn btn-primary"><i class="fa fa-trash "></i></button></a>
                              </td>
                            </tr>
                                <?php }} else{
                                    ?>
                            <tr >
                              <td colspan='4' class='text-center'>No Data</td>

                            </tr>
                                <?php
                                }?>

                            </tbody>
                            <tfoot>
                            <tr>
                            <th>Course Name</th>
                              <th>Total seats</th>
                              <th>booked seats</th>
                              <th>Available seats</th>
                              <th>10th average needed</th>
                              <th>12th average needed</th>
                              <th>Action</th>
                            </tr>
                            </tfoot>
                          </table>
                        </div>
                        <!-- /.box-body -->
                      </div>
              </div>
              <!-- /.tab-pane -->
              <div class="tab-pane" id="tab_2">
                <div class="box">
                        <div class="box-header text-center">
                          <h3 class="box-title">Departments list</h3>
                        </div>
                        <!-- /.box-header -->
                        <div class="box-body">
                          <table id="example2" class="table table-bordered table-striped">
                            <thead>
                            <tr>
                              <th>Student Name</th>
                              <th>department</th>
                              <th>Booked Date</th>
                              <th>Phone Number</th>
                              <th>10th average</th>
                              <th>12th average</th>
                              <!-- <th>Action</th> -->
                            </tr>
                            </thead>
                            <tbody>
                            <?php

                                $table=' book_details bd join users u on u.id = bd.student_id join department_master d on bd.department_id = d.id';

                                $where='college_id ="'.$_SESSION['college_id'].'"';
                                $details = $user->select($table,$rows=' bd.*,u.*,d.*',$where);
                                if($details){
            					foreach($details as $d)
            					{
            				?>
                            <tr>
                              <td><?php echo $d['firstname'];?>
                              </td>
                              <td><?php echo $d['course_name'];?></td>
                              <td><?php echo $d['booked_date'];?></td>
                              <td><?php echo $d['mobile'] - $d['booked_seats'];?></td>
                              <td><?php echo $d['10avg_needed'];?></td>
                              <td><?php echo $d['12avg_needed'];?></td>
                              <!-- <td> -->
                              <!-- <a href="manage_departments.php?id=<?php //echo $d['id'];?>"><button class="btn btn-primary"><i class="fa fa-edit "></i></button></a>
                              <a href="delete_department.php"><button class="btn btn-primary"><i class="fa fa-trash "></i></button></a> -->
                              <!-- </td> -->
                            </tr>
                                <?php }} else{
                                    ?>
                            <tr >
                              <td colspan='4' class='text-center'>No Data</td>

                            </tr>
                                <?php
                                }?>

                            </tbody>
                            <tfoot>
                            <tr>
                              <th>Student Name</th>
                              <th>department</th>
                              <th>Booked Date</th>
                              <th>Phone Number</th>
                              <th>10th average</th>
                              <th>12th average</th>
                              <!-- <th>Action</th> -->
                            </tr>
                            </tfoot>
                          </table>
                        </div>
                        <!-- /.box-body -->
                      </div>
              </div>

              <!-- /.tab-pane -->
            </div>
            <!-- /.tab-content -->
          </div>
          <!-- nav-tabs-custom -->
        </div>
      </div>

    </section>
  </div>

  <?php
  include './inc/footer.php';
   ?>
