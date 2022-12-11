<?php
    include 'Top.php';
    // Coding For Navigation Bar Background Color
        $nav_id = 'navbar';
        if(isset($_GET['type'])){
            $type = $_GET['type'];
            if($type == 'n'){
                $nav_id = 'navbar_home';
            }
        }
        ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
?>

<!-- ------------------Navigation Bar--------------------- -->
<div class="container-fluid" style="z-index: 200;" id="<?php echo $nav_id; ?>">
  <nav class="d-flex">
    <div class="nav__brand">
      <a href="<?php echo SITE__PATH; ?>/index.php?type=home"><img src="<?php echo SITE__PATH; ?>/assets/BK-logo.webp"
          alt="logo" />
        <span>BK Bank </span></a>
    </div>
    <div class="toggle">
      <i class="fas fa-bars"></i>
    </div>
    <div class="nav__menu">
      <ul class="d-flex" >
        <?php 
                       if(!isset($_SESSION['IS_LOGGIN'])){
                    ?>
        <li>
          <a href="<?php echo SITE__PATH; ?>/index.php">Home</a>
        </li>
        <li>
          <a href="<?php echo SITE__PATH; ?>/pages/Login.php?type=n">Login</a>
        </li>
        <?php }else {?>
        <?php if($_SESSION['ROLE'] == 0){ ?>
        <li>
          <a href="<?php echo SITE__PATH; ?>/pages/Dashboard.php?type=n">Dashboard</a>
        </li>
        <li>
          <a href="<?php echo SITE__PATH; ?>/pages/New__Notify.php?type=n">Add Notify</a>
        </li>
        <li>
          <a href="<?php echo SITE__PATH; ?>/pages/New__Employe.php?type=n">Add Employee</a>
        </li>
        <li>
          <a href="<?php echo SITE__PATH; ?>/pages/Notifies.php?type=n">All Notifies</a>
        </li>
        <li>
          <a href="<?php echo SITE__PATH; ?>/pages/Employes_Detailes.php?type=n">All Employees</a>
        </li>
        <li>
            <a href="<?php echo SITE__PATH; ?>/pages/Change_Password.php?type=n">Change Password</a>
        </li>
        <li>
          <a href="<?php echo SITE__PATH; ?>/components/Logout.php">Logout</a>
        </li>
        <?php }else{ ?>
        <li>
          <a href="<?php echo SITE__PATH; ?>/pages/New__Notify.php?type=n">Add Notify</a>
        </li>
        <li>
            <a href="<?php echo SITE__PATH; ?>/pages/Change_Password.php?type=n">Change Password</a>
        </li>
        <li>
          <a href="<?php echo SITE__PATH; ?>/pages/Notifies.php?type=n">All Notifies</a>
        </li>
        
        <?php  
                                $euser = $_SESSION['USER_NAME'];
                                $employe_id = mysqli_fetch_assoc(mysqli_query($con,"SELECT * FROM employe WHERE employe_id = '$euser'"));
                            ?>
        <li>
          <a
            href="<?php echo SITE__PATH; ?>/pages/New__Employe.php?type=n&id=<?php echo $employe_id['id']?>&option=view">Profile</a>
        </li>
        <li>
            <a href="<?php echo SITE__PATH; ?>/pages/Change_Password.php?type=n">Change Password</a>
        </li>
        <li>
          <a href="<?php echo SITE__PATH; ?>/components/Logout.php">Logout</a>
        </li>
        <?php } ?>
        <?php } ?>
      </ul>
    </div>
  </nav>
</div>

<script>
const toggle = document.querySelector('nav .toggle');
const nav_bar = document.querySelector('nav .nav__menu');
toggle.addEventListener('click', () => {
  nav_bar.classList.toggle('nav__menu__show');
})
</script>
<!-- --------------X----Navigation Bar---X------------------ -->