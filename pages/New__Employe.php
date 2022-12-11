<?php
    include '../components/Navigation__Bar.php';
    // ===========Condition==============
        if(!isset($_SESSION['IS_LOGGIN'])){
            echo "<script>window.location='Login.php?type=n'</script>";
        }
    // ========X===Condition===x=========

    //=========== Variable Declreation ==========
        $name = "";
        $gender = "";
        $birthday = "";
        $email = "";
        $phone_no = "";
        $district = "";
        $city = "";
        $designation = "";
        $salary = "";
        $rolee = "";

        $checked_id = "";
        $employe_id	 = "";

        $msg = "";
        $msg_get ="";

        $option = "";
        $id = "";

        $disabled = "";
    //======X=== Variable Declreation ===X========

    //============For Other Functionality=========
        if(isset($_GET['id']) && $_GET['id'] != "" && isset($_GET['option']) && $_GET['option']!=""){
            $id = mysqli_escape_string($con,$_GET['id']);
            $option = mysqli_escape_string($con,$_GET['option']);
        }

        //==========View Profile Functionality===============
            if($option == 'view'){
                $disabled = "disabled";
            }else{
                $disabled = "";
            }

            if($option == 'view' || $option == 'edit'){
                $res = mysqli_fetch_assoc(mysqli_query($con,"SELECT * FROM employe WHERE id = $id"));
                $employe_id	 = $res["employe_id"];
                $name = $res["name"];
                $gender = $res["gender"];
                $birthday = $res["birthday"];
                $email = $res["email_id"];
                $phone_no = $res["phone_no"];
                $district = $res["district"];
                $city = $res["city"];
                $designation = $res["designation"];
                $salary = $res["salary"];
                $u = mysqli_fetch_assoc(mysqli_query($con,"SELECT * FROM `users` WHERE `usename`='$employe_id'"));

                $rolee = $u['role'];
            }else{
                // ==========Genrate Id Number===========
                    $sql_id = mysqli_query($con,"SELECT employe_id FROM employe ORDER BY id DESC LIMIT 1");
                    $checked_id = mysqli_fetch_assoc($sql_id);

                    if(mysqli_num_rows($sql_id)>0){
                        $prives_id = $checked_id['employe_id'];
                        $get_id = str_replace("EM", "", $prives_id);
                        $id_incrase = $get_id+1;
                        $get_id_string = str_pad($id_incrase, 5,0, STR_PAD_LEFT);

                        $employe_id = "EM".$get_id_string;
                    }else{
                        $employe_id = "EM00001";
                    }
            }

    // ============Get Massege Here===========
        if(isset($_GET["msg"]) && $_GET["msg"] != ""){
            $msg_get = mysqli_escape_string($con,$_GET["msg"]);
            if($msg_get == "msg"){
                $msg = "<div class='alert alert-success alert-dismissible fade show' role='alert'>
                    <h4 class='alert-heading'>Well done!</h4>
                    <strong>Employe Detailes Added Successfully</strong>
                    <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
                </div>";
            }
        }
    // =========X===Get Massege Here===X=======

    // ========= Send Records Functionality ========
        if(isset($_POST['add_employe'])){
            $name = mysqli_escape_string($con,$_POST['name']);
            $gender = mysqli_escape_string($con,$_POST['gender']);
            $birthday = mysqli_escape_string($con,$_POST['birthday']);
            $email = mysqli_escape_string($con,$_POST['email']);
            $phone_no = mysqli_escape_string($con,$_POST['number']);
            $district = mysqli_escape_string($con,$_POST['district']);
            $city = mysqli_escape_string($con,$_POST['city']);
            $designation = mysqli_escape_string($con,$_POST['designation']);
            $salary = mysqli_escape_string($con,$_POST['salary']);
            $rolee = mysqli_escape_string($con,$_POST['role']);

            if($option == ''){
                $hash_pass = md5($phone_no);
                mysqli_query($con,"INSERT  INTO employe (employe_id,name,gender,email_id,birthday,phone_no,district,city,designation,salary) VALUES ('$employe_id','$name','$gender','$email','$birthday','$phone_no','$district','$city','$designation','$salary')");

                if($rolee == "admin"){
                    mysqli_query($con,"INSERT INTO users (usename,password,type,role) VALUES ('$employe_id','$hash_pass',0,'admin')");
                }else{
                    mysqli_query($con,"INSERT INTO users (usename,password,type,role) VALUES ('$employe_id','$hash_pass',1,'employee')");
                }
    
                echo "<script>window.location='New__Employe.php?type=n&msg=msg'</script>";
            }else{
                mysqli_query($con,"UPDATE employe SET employe_id='$employe_id',name='$name',gender='$gender',email_id='$email',birthday='$birthday',phone_no='$phone_no',district='$district',city='$city',designation='$designation',salary='$salary' WHERE id = $id");
                
                if($rolee == 'admin'){
                    mysqli_query($con,"UPDATE users SET type='0', role='admin' WHERE usename = '$employe_id'");
                }else{
                    mysqli_query($con,"UPDATE users SET type='1', role='employee' WHERE usename = '$employe_id'");
                }
                
                echo "<script>window.location='Employes_Detailes.php?type=n&msg=msg".$rolee."'</script>";
            }
        }
    // ======X=== Send Records Functionality ===X===
?>
    <!-- ------------Employe Form---------------- -->
        <?php include '../components/User_Name.php' ?>
        <?php echo $msg;?>
        <div class="container" id="add_page">
            <div class="row text-center">
                <?php 
                    if($option == 'view'){
                        echo "
                            <h2>View Employee Detailes</h2>
                            <p><span class='text-primary'>$name</span> Detailes Here...</p>
                        ";
                    }else if ($option == 'edit'){
                        echo "
                            <h2>Edit Employee Details</h2>
                            <p><span class='text-primary'>$name</span> Edit Detailes Here...</p>
                        ";
                    }else{
                        echo "
                            <h2>Add Employee</h2>
                            <p>Add Employee Details Here</p>
                        ";
                    }
                ?>
            </div>
            <form method="post" action="" class="row g-3 mt-2 mb-2">
                <div class="col-md-4">
                    <label for="inputAddress" class="form-label">Employee Id</label>
                    <input type="text" disabled value="<?php echo $employe_id; ?>" class="form-control text-primary" id="inputAddress" name="employe_id" required>
                </div>
                <div class="col-md-4">
                    <label for="inputAddress" class="form-label">Designation</label>
                    <input <?php echo $disabled; ?> type="text" class="form-control" value="<?php echo $designation ?>" id="inputAddress" name="designation" required>
                </div>
                <div class="col-md-4">
                    <label for="inputAddress" class="form-label">Salary</label>
                    <input <?php echo $disabled; ?> type="text" value="<?php echo $salary ?>" class="form-control" id="inputAddress" name="salary" required>
                </div>
                <div class="col-md-6">
                    <label for="inputEmail4" class="form-label">Employee Name</label>
                    <input <?php echo $disabled; ?> type="text" value="<?php echo $name ?>" name="name" class="form-control" id="inputEmail4" required>
                </div>
                <div class="col-md-6">
                    <label for="inputPassword4" class="form-label">Email Id</label>
                    <input <?php echo $disabled; ?> type="email" value="<?php echo $email ?>" class="form-control" name="email" id="inputPassword4" required>
                </div>
                <div class="col-md-4">
                    <label for="inputEmail4" class="form-label">Gender</label>
                    <select <?php echo $disabled; ?> name="gender" id="inputState" class="form-select" required>
                            <?php 
                                if($option == 'view'){
                                    echo "<option value= '$gender' selected>$gender</option>";
                                }else if($option == 'edit'){
                                    echo "
                                    <option value= '$gender' selected>$gender</option>
                                    <option value='Male'>Male</option>
                                    <option value='Female'>Femail</option>";
                                }else{
                                    echo "
                                        <option value= '' selected>Select Gender</option>
                                        <option value='Male'>Male</option>
                                        <option value='Female'>Femail</option>
                                    ";
                                }   
                            ?>
                    </select>
                </div>
                <div class="col-md-4">
                    <label for="role" class="form-label">Role</label>
                    <select <?php echo $disabled; ?> name="role" id="role" class="form-select" required>
                            <?php 
                                if($option == 'view'){
                                    echo "<option value= '$gender' selected>$rolee</option>";
                                }else if($option == 'edit' || $option == 'view'){
                                        $select_admin = "";
                                        $select_employee = "";
                                        if ($rolee == "admin") {
                                            $select_admin = "selected";
                                        }else{
                                            $select_employee = "selected";
                                        }
                                    echo "
                                    <option value= '' >Select Role</option>
                                    <option value='admin' ".$select_admin.">Admin</option>
                                    <option value='employee' ".$select_employee.">Employee</option>";
                                }else{
                                    echo "
                                    <option value= '' selected>Select Role</option>
                                    <option value='admin'>Admin</option>
                                    <option value='employee'>Employee</option>";
                                }   
                            ?>
                    </select>
                </div>
                <div class="col-md-4">
                    <label for="inputEmail4" class="form-label">Phone Number</label>
                    <input <?php echo $disabled; ?> type="text" value="<?php echo $phone_no ?>" class="form-control" name="number" id="inputPassword4" required>
                </div>
                <div class="col-md-4">
                    <label for="inputEmail4" class="form-label">Birth Date</label>
                    <input <?php echo $disabled; ?>
                        <?php if($option == 'view' || $option == 'edit'){
                                echo 'type=text';
                            }else{
                                echo 'type=date';
                            } 
                        ?> value="<?php echo $birthday ?>"  class="form-control" name="birthday" id="inputPassword4" required>
                </div>
                
                <div class="col-md-6">
                    <label for="inputPassword4" class="form-label">District</label>
                    <input <?php echo $disabled; ?> type="text" value="<?php echo $district ?>" class="form-control" name="district" id="inputPassword4" required>
                </div>
                <div class="col-md-6">
                    <label for="inputAddress" class="form-label">City</label>
                    <input <?php echo $disabled; ?> type="text" value="<?php echo $city ?>" class="form-control" id="inputAddress" name="city" required>
                </div>
                
                <?php if($option == 'view'){ ?>

                <?php }else{ ?>
                    <div class="col-12 text-center">
                        <button type="submit" name="add_employe" class="btn btn-primary">
                            <?php
                                if($option == 'edit'){
                                    echo 'Edit Employee Detailes';
                                }else{
                                    echo 'Add Employee';
                                }
                            ?>
                        </button>
                    </div>
                <?php } ?>
            </form>
        </div>
    <!-- ---------X---Employe Form---X------------- -->
<?php
    include '../components/Footer.php';
?>