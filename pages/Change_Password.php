<?php
    include '../components/Navigation__Bar.php';
    // ===========Condition==============
        if(!isset($_SESSION['IS_LOGGIN'])){
            echo "<script>window.location='Login.php?type=n'</script>";
        }
        // ========X===Condition===x=========
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
                $res['password'] = $newpassword;
                echo "<script>window.location='../components/Logout.php'</script>";
            }
            else{
                $msg = "<div class='alert alert-warning alert-dismissible fade show' role='alert'>
                    The confirmation is not correct.
                    <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
                </div>";
            }
            /*$_SESSION['IS_LOGGIN']='yes';
            $_SESSION['USER_ID']=$res['id'];
            $_SESSION['USER_NAME']=$res['usename'];
            $_SESSION['ROLE']=$res['type'];
          
            /*if($_SESSION['ROLE'] == 0){
                echo "<script>window.location='Dashboard.php?type=n'</script>";
            }else{
                echo "<script>window.location='Customers.php?type=n'</script>";
            }*/
          
           
        
        }else{
           $msg = "<div class='alert alert-warning alert-dismissible fade show' role='alert'>
                    Please provide the correct previous password
                    <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
                </div>";
        }
    }
    // ========X===Condition===x=========
    $msg = '';

    // ============Get Massege Here===========
        if(isset($_GET["msg"])){
            $msg_get = mysqli_escape_string($con,$_GET["msg"]);
            if($msg_get == "msg"){
                $msg = "<div class='alert alert-success alert-dismissible fade show' role='alert'>
                    <h4 class='alert-heading'>Well done!</h4>
                    <strong>Employe Detailes Edited Successfully</strong>
                    <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
                </div>";
            }
        }
    // =========X===Get Massege Here===X=======

    // ==========Delete Functionality=========
        if(isset($_GET['id']) && $_GET['id'] != "" && isset($_GET['option']) && $_GET['option']!=""){
            $id = mysqli_escape_string($con,$_GET['id']);
            $option = mysqli_escape_string($con,$_GET['option']);

            if($option == 'delete'){
                mysqli_query($con,"DELETE FROM employe WHERE employe_id = '$id'");
                mysqli_query($con,"DELETE FROM users WHERE usename = '$id'");
                echo "<script>window.location='Employes_Detailes.php?type=n'</script>";
            }
        }
    // =======X===Delete Functionality===X======

    // =============Get Record==============
        $sql = mysqli_query($con,"SELECT * FROM employe ORDER BY id DESC");
    // =============Get Record==============
?>
    <!-- Display Customer Table -->
        <?php include '../components/User_Name.php' ?>
        <?php echo $msg;?>
        <div class="container" id="display_record">
            <div class="row text-center">
                <h2>Change Password</h2>
            </div>
            <div class="row justify-content-center">
                <div class="col-xl-6">
                    <form method="post" action="">
                        <div class="mb-3">
                            <label for="exampleFormControlInput1" class="form-label">Previous Password</label>
                            <input type="text" name="prepass" class="form-control" placeholder="Enter Your Previous Password" required>
                        </div>
                        <div class="mb-3">
                            <label for="exampleFormControlInput1" class="form-label">New Password</label>
                            <input type="newpassword" name="newpassword" class="form-control" placeholder="Enter Your New Password" required>
                        </div>
                        <div class="mb-3">
                            <label for="exampleFormControlInput1" class="form-label">Password Confirmation</label>
                            <input type="conpassword" name="conpassword" class="form-control" placeholder="Please Confirm Your New Password" required>
                        </div>
                        <div class="mb-3">
                            <Button type="submit" name="submit" class = "btn btn-primary">Change Password</Button>
                        </div>
                    </form>
                </div>
            </div>
            <div class="table-responsive mt-2">
                <table class="table table-striped table-hover table-bordered">
                    <thead>
                        <tr>
                            <th width="15%" scope="col">Employe Id</th>
                            <th width="15%" scope="col">Designation</th>
                            <th width="10%" scope="col">Salary</th>
                            <th width="20%" scope="col">Name</th>
                            <th width="10%" scope="col">Gender</th>
                            <th width="10%" scope="col">Joined</th>
                            <th width="20%" scope="col">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                            while ($row = mysqli_fetch_assoc($sql)){
                        ?>
                            <tr>
                                <th scope="row" class="text-primary"><?php echo $row['employe_id']; ?></th>
                                <th scope="row" class="text-success"><?php echo  $row['designation']; ?></th>
                                <td><?php echo $row['salary']?></td>
                                <td><?php echo $row['name']?></td>
                                <td><?php echo $row['gender']?></td>
                                <td><?php 
                                        $dateStr=strtotime($row['join_date']);
                                        echo date('d-m-Y',$dateStr);
                                    ?></td>
                                <td class="d-flex justify-content-around">
                                    <a href="New__Employe.php?type=n&id=<?php echo $row['id']?>&option=view"><i class="far fa-eye text-primary"></i></a>
                                    <a href="New__Employe.php?type=n&id=<?php echo $row['id']?>&option=edit"><i class="fas fa-pen text-success"></i></a>
                                    <a href="?type=n&id=<?php echo $row['employe_id']?>&option=delete"><i class="fas fa-trash text-danger"></i></a>
                                </td>
                            </tr>
                        <?php } ?>
                    </tbody>
                </table>
            </div>
        </div>
    <!--X- Display Customer Table -X-->
<?php
    include '../components/Footer.php';
?>