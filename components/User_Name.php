
<script src="https://code.jquery.com/jquery-latest.js"></script>
<div class='container-fluid' id='user_name'>
  <div class='row'>
    <div class='col-8'>
      <h3>Welcome ! <span><?php echo $_SESSION['USER_NAME']; ?></span></h3>
    </div>
    <div class='col-4 notify-container'>
      <div class='notify-header'>
        <div>
          Notify
        </div>
        <ion-icon style='font-size: 1.6rem;' name='notifications-outline'></ion-icon>
      </div>
      <div class='notify-inner-container'>
        <div style='position: relative; width: 5px; height:20px'>
          <button class='button-close'>X</button>
        </div>
        <ul class='notify-content'>
          <?php 
          
      $role= $_SESSION['ROLE_INFOR'];
      
      // =============Get Record with descending order of id ========================
          $sql_full_command = "SELECT * FROM notify WHERE role='$role'";
          $result2 = $con->query($sql_full_command);
          
          $sql_command = "SELECT * FROM notify WHERE role='$role' ORDER BY id DESC LIMIT 3";
          $result = $con->query($sql_command);

            if ($_COOKIE[$role]==$result2->num_rows) {
              setcookie('bell', true, time() + (86400 * 30), "/");
            }
            else setcookie('bell', false, time()  + (86400 * 30), "/");
          
          setcookie($role, $result2->num_rows, time() + (86400 * 30), "/");
          // $_SESSION[$role] = $result->num_rows;

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

<script> 
function getCookie(cname) {
    var name = cname + "=";
    var ca = document.cookie.split(';');
    for(var i=0; i<ca.length; i++) {
        var c = ca[i];
        while (c.charAt(0)==' ') c = c.substring(1);
        if (c.indexOf(name) == 0) return c.substring(name.length,c.length);
    }
    return "";
}
$(function(){
  var cookie = getCookie('bell');
  if(cookie == false) $('ion-icon').addClass('bell-icon');
});
</script>
