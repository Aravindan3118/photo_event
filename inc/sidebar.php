 <!-- Left side column. contains the logo and sidebar -->
  <aside class="main-sidebar">

    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">

      <!-- Sidebar user panel (optional) -->
      <div class="user-panel">
        <div class="pull-left image">
          <img src="inc/includes/dist/img/user2-160x160.jpg" class="img-circle" alt="User Image">
        </div>
        <div class="pull-left info">
          <p><?php echo $_SESSION['firstname']; ?></p>
          <!-- Status -->
          <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
        </div>
      </div>

      <!-- search form (Optional) -->
  
      <!-- /.search form -->

      <!-- Sidebar Menu -->
      <ul class="sidebar-menu" data-widget="tree">
       
        <!-- Optionally, you can add icons to the links -->
        <li class=""><a href="index.php"><i class="fa fa-dashboard"></i> <span>Dashboard</span></a></li>
        <?php
        if($_SESSION['user_type'] == 'superadmin'){
          ?>
            <li><a href="event_master.php"><i class="fa fa-link"></i> <span>Manage Events</span></a></li>
          <?php
        }
        ?>
        <?php
        if($_SESSION['user_type'] == 'college'){
          ?>
            <li><a href="departments_master.php"><i class="fa fa-link"></i> <span>Manage Departments</span></a></li>
          <?php
        }
        ?>
        <!-- <li class="treeview">
          <a href="#"><i class="fa fa-link"></i> <span>Multilevel</span>
            <span class="pull-right-container">
                <i class="fa fa-angle-left pull-right"></i>
              </span>
          </a>
          <ul class="treeview-menu">
            <li><a href="#">Link in level 2</a></li>
            <li><a href="#">Link in level 2</a></li>
          </ul>
        </li> -->
      </ul>
      <!-- /.sidebar-menu -->
    </section>
    <!-- /.sidebar -->
  </aside>
