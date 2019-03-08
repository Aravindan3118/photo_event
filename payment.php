<?php 
   include_once './session.php';
    include_once './inc/services/class.user.php';
    $user = new User();

 
   
 ?>
<!DOCTYPE html>
<html>
<head>
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css"
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap.min.css">
<style>
body {
  font-family: Arial;
  font-size: 17px;
  padding: 8px;
}

* {
  box-sizing: border-box;
}
 

 

input[type=text] {
  width: 100%;
  margin-bottom: 20px;
  padding: 12px;
  border: 1px solid #ccc;
  border-radius: 3px;
}

label {
  margin-bottom: 10px;
  display: block;
}

.icon-container {
  margin-bottom: 20px;
  padding: 7px 0;
  font-size: 24px;
}

.btn {
  background-color: #4CAF50;
  color: white;
  padding: 12px;
  margin: 10px 0;
  border: none;
  width: 100%;
  border-radius: 3px;
  cursor: pointer;
  font-size: 17px;
}

.btn:hover {
  background-color: #45a049;
}

a {
  color: #2196F3;
}

hr {
  border: 1px solid lightgrey;
}

span.price {
  float: right;
  color: grey;
}

 
</style>
</head>
<body>
  
    <div class="container">
      <form action="" method="post">
        <input type="hidden" name="depid" value="<?php echo $_GET['depid']; ?>">
        <input type="hidden" id="collegeemailval" name="collegeemail" value="<?php echo $_GET['collegeemail']; ?>">
      
        <div class="row">


          <div class="col-md-4 col-md-offset-4">
            <h3>Payment</h3>
            <label for="fname">Accepted Cards</label>
            <div class="icon-container">
              <i class="fa fa-cc-visa" style="color:navy;"></i>
              <i class="fa fa-cc-amex" style="color:blue;"></i>
              <i class="fa fa-cc-mastercard" style="color:red;"></i>
              <i class="fa fa-cc-discover" style="color:orange;"></i>
            </div>
            <label for="cname">Name on Card</label>
            <input type="text" id="cname" name="cardname" value="John More Doe" required="">
            <label for="ccnum">Credit card number</label>
            <input type="text" id="ccnum" name="cardnumber" value="1111-2222-3333-4444" required="">
            <label for="expmonth">Exp Month</label>
            <input type="text" id="expmonth" name="expmonth" value="September" required="">
            <div class="row">
              <div class="col-50">
                <label for="expyear">Exp Year</label>
                <input type="text" id="expyear" name="expyear" value="2018" required="">
              </div>
              <div class="col-50">
                <label for="cvv">CVV</label>
                <input type="text" id="cvv" name="cvv" value="352" required="">
              </div>
            </div>
          </div>
          
        </div>
        <label>
          <input type="checkbox" checked="checked" name="sameadr"> Shipping address same as billing
        </label>
        <input type="submit" name="final_book" value="Continue to checkout" class="btn">
      </form>
    </div>
  <?php 

  include './top_inc/top_footer.php';
   ?>

  <script>
    function send_email () {
       $.ajax({
    url: "ajax_mailer.php",
    method: "POST",
    data: {collegeemail: $('#collegeemailval').val()},
    success: function(data) {
      console.log('data',data);
      data = JSON.parse(data);      
       
    },
    error: function(data) {
      console.log(data);
    }
  });
    }
  </script>
  <?php 

      if (isset($_POST['final_book'])) {
      $table= 'book_details';
    $row='student_id,department_id';
    $insert = $user->insert($table,array($_SESSION['user_id'],$_POST['depid']),$row);
    // update seat count
    $table = "department_master";
    // $booked_seats= 1 + booked_seats; 
    $where='id = '.$_POST['depid'].'';
    // $update=$user->update($table,array('booked_seats'=>'booked_seats' + 1),array($where));
    $sql = 'update department_master set booked_seats = booked_seats + 1 where id = '.$_POST['depid'];
    $cone = mysqli_connect(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_DATABASE);
    $result = mysqli_query($cone, $sql);
    // Mail start
    $send_to = $_POST['collegeemail'];
    $subject = 'Student Seat booking';
    $body = 'New Student Has booked the seats in Your college';
    // $sendmail = $user->mailer($send_to,$subject,$body);

    echo "<script>send_email();</script>";

    echo '<script>alert("Submitted Successfully");
    window.location.href="index.php";</script>';    
  }

   ?>
</body>
</html>