<?php
    include '../components/Navigation__Bar.php';
    // ===========Condition==============
        if(!isset($_SESSION['IS_LOGGIN'])){
            header('Location:Login.php?type=n');
        }
        if($_SESSION['ROLE'] != 0){
            header('Location:Notifies.php?type=n');
        }
    // ========X===Condition===x=========

    // ===========All Dashboard==========
        $sql = mysqli_query($con,"SELECT * FROM employe");
        $total_employes = mysqli_num_rows($sql);
        if($total_employes < 10){
            $total_employes = '0'.$total_employes;
        }
        
        $balance = mysqli_query($con,"SELECT SUM(acount_balance) AS value_sum FROM customer");
        $total = mysqli_fetch_assoc($balance);
      
    // =========X==All Dashboard==X========
   
?>
    <!-- -----------Dashboard------------ -->
        <?php include '../components/User_Name.php' ?>
        <div class="container mt-5">
            <div class="d-flex justify-content-center">
                    <div class="card text-dark bg-light mb-3" style="max-width: 27rem;">
                        <div class="card-body text-center">
                            <h4 class="card-title text-uppercase text-primary">Total Employees</h4>
                            <h1 class="card-text text-success"><?php echo $total_employes; ?></h1>
                        </div>
                </div>
            </div>
        </div>
    <!-- -----------Dashboard------------ -->
<?php
    include '../components/Footer.php';
?>