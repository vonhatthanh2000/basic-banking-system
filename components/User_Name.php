<div class="container-fluid" id="user_name">
    <div class="row">
        <div class="col-12">
            <h3>Welcome ! <span><?php echo $_SESSION['USER_NAME']; echo ' - '; 
            if($_SESSION['ROLE'] == 0){echo "Admin";} 
            else if($_SESSION['ROLE'] == 1) {echo "Leader";}
            else{
                echo "Employee";
            } ?></span></h3>
        </div>
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
                <p style='color: black !important;'><?php echo $row['content']; ?></p>
              </div>
            </a>
          </li>
          <?php } ?>
          <?php } ?>
        </ul>
        <a href="<?php echo SITE__PATH; ?>/pages/notify.php?type=n" class='seemore'>See More...</a>
      </div>
    </div>
  </div>
</div>