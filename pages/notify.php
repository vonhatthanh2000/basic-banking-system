<?php
    include '../components/Navigation__Bar.php';
    // ===========Condition==============
        if(!isset($_SESSION['IS_LOGGIN'])){
            echo "<script>window.location='Login.php?type=n'</script>";
        };
    // ========X===Condition===x=========

    ?>
<?php include '../components/User_Name.php' ?>

<div class="container" id="add_page">
  <div class="row text-center">
    <?php 

    echo "
             <h2>Notifications</h2>
      ";
                    
      ?>
  </div>
  <div>
    <ul class='notify-content'>
      <?php 
                // ==============Get Data============
      $role= $_SESSION['ROLE_INFOR'];
      
      // ============X==Get Data===X=========
      
      // =============Get Record==============
          $sql_command = "SELECT * FROM notify WHERE role='$role'";
          $result = $con->query($sql_command);
          if ($result->num_rows > 0) {
            // output data of each row
            while($row = $result->fetch_assoc()) {
              ?>
      <li>
        <a href='https://www.udemy.com/course/microservices-with-node-js-and-react' target="_blank"
          class='content-link'>

          <div class='title-notification'>
            <p><?php echo $row['title']; ?> </p>
          </div>
          <div class='content-notification'>
            <p style='color: black !important;font-weight:normal !important; text-transform:none; font-size:0.8rem'>
              <?php echo $row['content']; ?></p>
          </div>
        </a>
      </li>
      <?php } ?>
      <?php } ?>
    </ul>
  </div>
</div>

<?php
    include '../components/Footer.php';
?>