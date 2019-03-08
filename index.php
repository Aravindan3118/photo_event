<?php 
    include_once './session.php';
    include_once './inc/services/class.user.php';
    $user = new User();
?>
<?php 
  if($_SESSION['user_type']=='student'){
    include './top_inc/top_head_ass.php';
    include './top_inc/top_header.php';
  }
  if($_SESSION['user_type']=='superadmin' || $_SESSION['user_type']=='college' ){
    include './inc/head_ass.php';
    include './inc/header.php';
    include './inc/sidebar.php';
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
              <h3 class="box-title">Colleges For You</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <table id="example1" class="table table-bordered table-striped">
                <thead>
                <tr>
                   <th>College Name</th>
                  <th>Department</th>
                  <th>Available seats</th>
                  <th>Action</th>
                </tr>
                </thead>
                <tbody>
                <?php 
                    
                    $table='department_master d join college_master c on d.college_id = c.id';                   
                    $where='d.10avg_needed <="'.$_SESSION['student_10_avg'].'" and d.12avg_needed <="'.$_SESSION['student_12_avg'].'" and d.id <> all(select department_id from book_details where student_id = "'.$_SESSION['user_id'].'")   ';											
                    $details = $user->select($table,$rows='c.college_name,d.*',$where); 
                    if($details){
					foreach($details as $d)
					{
				?>
                <tr>
                <td><?php echo $d['college_name'];?></td>
                <td><?php echo $d['course_name'];?></td>
                   
                   <td><?php echo $d['total_seats'] - $d['booked_seats'];?></td>
                  
                   <td>
                   <a href="book_college.php?id=<?php echo $d['id'];?>"><button class="btn btn-primary"><i class="fa fa-edit "></i></button></a>
                   </td>
                </tr>
          <?php }}
          ?>
                </tbody>
                <tfoot>
                <tr>
                   <th>College Name</th>
                  <th>Department</th>
                  <th>Available seats</th>
                  <th>Action</th>
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
  if($_SESSION['user_type']=='superadmin' || $_SESSION['user_type']=='college' ){
    ?>
  <div class="content-wrapper">
    <section class="content-header">
    
  
           <div class="row">        
        <div class="col-md-12">
             <div class="box box-primary">
            <div class="box-header with-border">
              <h3 class="box-title">Chart</h3>

              <div class="box-tools pull-right">
                <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                </button>
                <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
              </div>
            </div>
            <div class="box-body">
              <div class="chart">
                <canvas id="areaChart" style="height:250px"></canvas>
              </div>
            </div>
            <!-- /.box-body -->
          </div>           
        </div>
      </div>

    
    </section>

    <!-- Main content -->
    <section class="content container-fluid">


    </section>
  </div>
  <?php } ?>
  <?php 
  if($_SESSION['user_type']=='student'){
    include './top_inc/top_footer.php';
  }
  if($_SESSION['user_type']=='superadmin' || $_SESSION['user_type']=='college' ){
    
    include './inc/footer.php';
    ?>
      <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.7.2/Chart.min.js"></script>
    
  <?php if ($_SESSION['user_type'] == 'superadmin'): ?>
    <script type="text/javascript">
 
  
  $(document).ready(function(){
  $.ajax({
    url: "ajaxdata.php",
    method: "GET",   
    success: function(data) {
      console.log(data);
      data = JSON.parse(data)
      var month = [];
      var count = [];
      for(var i in data) {
        month.push(data[i].MONTHNAME);
        count.push(data[i].cnt);
      }
      var chartdata = {
        labels: month,
        
        datasets : [
          {
            label: 'College',
            backgroundColor: '#2196f3',
            borderColor: 'rgba(200, 200, 200, 0.75)',
            hoverBackgroundColor: '#90caf9',
            hoverBorderColor: 'rgba(200, 200, 200, 1)',
            data: count
          }
        ]
      };
      var ctx = $("#areaChart");

      var barGraph = new Chart(ctx, {
        type: 'bar',
        data: chartdata
      });
    },
    error: function(data) {
      console.log(data);
    }
  });
});
</script>
  <?php endif ?>

  <?php if ($_SESSION['user_type'] == 'college'): ?>
    <script type="text/javascript">
  
  
  $(document).ready(function(){
  $.ajax({
    url: "ajaxdata_college.php",
    method: "GET",   
    success: function(data) {
      console.log(data);
      data = JSON.parse(data)
      var month = [];
      var count = [];
      for(var i in data) {
        month.push(data[i].MONTHNAME);
        count.push(data[i].cnt);
      }
      var chartdata = {
        labels: month,
        
        datasets : [
          {
            label: 'student',
            backgroundColor: '#2196f3',
            borderColor: 'rgba(200, 200, 200, 0.75)',
            hoverBackgroundColor: '#90caf9',
            hoverBorderColor: 'rgba(200, 200, 200, 1)',
            data: count
          }
        ]
      };
      var ctx = $("#areaChart");

      var barGraph = new Chart(ctx, {
        type: 'bar',
        data: chartdata
      });
    },
    error: function(data) {
      console.log(data);
    }
  });
});
</script>
  <?php endif ?>
    <?php 

     
  }
    
    
?>
