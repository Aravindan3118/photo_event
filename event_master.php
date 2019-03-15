<?php 
  include_once './session.php';
  if($_SESSION['user_type'] != 'superadmin'){
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
    <a href="add_event.php"><button class="btn btn-primary">Add Event</button></a>
    <div class="box">
            <div class="box-header text-center">
              <h3 class="box-title">Event list</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
            <h1>Lorem</h1>
              <table id="example1" class="table table-bordered table-striped">
                <thead>
                <tr>
                  <th>Event Name</th>
                  <th>Event Date</th>
                  <th>Register end date</th>
                  <th>amount</th>
                </tr>
                </thead>
                <tbody>
                <?php 
                    
                    $table='event_master';												
                    $details = $user->select($table); 
                    if($details){
					foreach($details as $d)
					{
				?>
                <tr>
                  <td><?php echo $d['event_title'];?></td>
                  <td><?php echo $d['date'];?>
                  </td>
                  <td><?php echo $d['booking_close_at'];?></td>
                  <td><?php echo $d['amount'];?></td>
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
                  <th>Event Name</th>
                  <th>Event Date</th>
                  <th>Register end date</th>
                  <th>amount</th>
                </tr>
                </tfoot>
              </table>
            </div>
            <!-- /.box-body -->
          </div>
    </section>
  </div>

  <?php 
  include './inc/footer.php';
   ?>