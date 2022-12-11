<?php
    include '../components/Navigation__Bar.php';
    // ===========Condition==============
        if(!isset($_SESSION['IS_LOGGIN'])){
            header('Location:Login.php?type=n');
        }
        if($_SESSION['ROLE'] != 0){
            header('Location:Notifies.php?type=n');
        }

    // ===========All Dashboard==========
        $sql = mysqli_query($con,"SELECT * FROM users WHERE role='employee'");
        $total_employes = mysqli_num_rows($sql);
        if($total_employes < 10){
            $total_employes = '0'.$total_employes;
        }

        $sql = mysqli_query($con,"SELECT * FROM users WHERE role='admin'");
        $total_admin = mysqli_num_rows($sql);
        if($total_admin < 10){
            $total_admin = '0'.$total_admin;
        }
    // =========X==All Dashboard==X========
   
?>
    <!-- -----------Dashboard------------ -->
        <?php include '../components/User_Name.php' ?>
        <div class="container mt-5">
            <div class="container mt-5">
            <div class="d-flex justify-content-around">
                <div class="col-xl-6 d-flex justify-content-around" >
                    <div class="card text-dark bg-light mb-3" style="max-width: 27rem;width:235px;"">
                        <div class="card-body text-center">
                            <h4 class="card-title text-uppercase text-primary">Total Employee</h4>
                            <h1 class="card-text text-success"><?php echo $total_employes; ?></h1>
                        </div>
                    </div>
                </div>
                <div class="col-xl-6 d-flex justify-content-around">
                    <div class="card text-dark bg-light mb-3" style="max-width: 27rem; width:235px;">
                        <div class="card-body text-center">
                            <h4 class="card-title text-uppercase text-primary">Total Admin</h4>
                            <h1 class="card-text text-success"><?php echo $total_admin; ?></h1>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        </div>
    <!-- -----------Dashboard------------ -->
<?php
    include '../components/Footer.php';
?>