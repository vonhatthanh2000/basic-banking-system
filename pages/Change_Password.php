<?php
    include '../components/Navigation__Bar.php';
    if(!isset($_SESSION['IS_LOGGIN'])){
        echo "<script>window.location='Login.php?type=n'</script>";
    }
    
    $username="";
    $oldpassword="";
    $newpassword="";
    $conpassword="";
    $msg = '';
    if(isset($_POST['submit'])){
        $username = $_SESSION['USER_NAME'];
        $oldpassword = mysqli_escape_string($con,$_POST['prepass']);
        $newpassword = mysqli_escape_string($con,$_POST['newpassword']);
        $conpassword = mysqli_escape_string($con,$_POST['conpassword']);
        $sql = mysqli_query($con,"SELECT * FROM users WHERE usename = '$username' AND password = '$oldpassword'");
        if(mysqli_num_rows($sql)>0){
            $res=mysqli_fetch_assoc($sql);
            if($newpassword == $conpassword){
                mysqli_query($con,"UPDATE users SET password = '$newpassword' WHERE usename = '$username' AND password = '$oldpassword'");
                echo "<script>window.location='/basic-banking-system/pages/Dashboard.php?type=n'</script>";
            }
            else{
                $msg = "<div class='alert alert-warning alert-dismissible fade show' role='alert'>
                    The confirmation is not correct.
                    <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
                </div>";
            }
        }else{
           $msg = "<div class='alert alert-warning alert-dismissible fade show' role='alert'>
                    Please provide the correct previous password
                    <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
                </div>";
        }
    }
    // ========X===Condition===x=========
?>
    <!-- Display Customer Table -->
        <?php include '../components/User_Name.php' ?>
        <?php echo $msg ?>
        <div class="container" id="display_record">
            <div class="row text-center">
                <h2>Change Password</h2>
            </div>
            <div class="row justify-content-center">
                <div class="col-xl-6">
                    <form method="post" action="">
                        <div class="mb-3">
                            <label for="exampleFormControlInput1" class="form-label">Currennt Password</label>
                            <input type="password" name="prepass" class="form-control" placeholder="Enter Your Previous Password" required>
                        </div>
                        <div class="mb-3">
                            <label for="exampleFormControlInput1" class="form-label">New Password</label>
                            <input type="password" name="newpassword" class="form-control" placeholder="Enter Your New Password" required>
                        </div>
                        <div class="mb-3">
                            <label for="exampleFormControlInput1" class="form-label">Password Confirmation</label>
                            <input type="password" name="conpassword" class="form-control" placeholder="Please Confirm Your New Password" required>
                        </div>
                        <div class="mb-3">
                            <Button type="submit" name="submit" class = "btn btn-primary">Change Password</Button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    <!--X- Display Customer Table -X-->
<?php
    include '../components/Footer.php';
?>