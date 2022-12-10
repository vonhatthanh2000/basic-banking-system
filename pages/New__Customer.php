<?php
    include '../components/Navigation__Bar.php';
    // ===========Condition==============
        if(!isset($_SESSION['IS_LOGGIN'])){
            echo "<script>window.location='Login.php?type=n'</script>";
        }
    // ========X===Condition===x=========

    //=========== Variable Declreation ==========
        $title = "";
        $content = "";
        $rolee = "";
        
        $checked_ac = "";
        $noti_id = "";

        $msg = "";
        $msg_get ="";

        $id = "";
        $option = "";

        $disabled = "";
    //======X=== Variable Declreation ===X========

    //============For Other Functionality=========
        if(isset($_GET['id']) && $_GET['id'] != "" && isset($_GET['option']) && $_GET['option']!=""){
            $id = mysqli_escape_string($con,$_GET['id']);
            $option = mysqli_escape_string($con,$_GET['option']);
        }
        //==========View Profile Functionality===============
            $disabled = "";
            if($option == 'view' || $option == 'edit'){
                $res = mysqli_fetch_assoc(mysqli_query($con,"SELECT * FROM notify WHERE id = '$id'"));
                $title = $res["title"];
                $content = $res["content"];
                $rolee = $res["role"];
                $noti_id = $res["id"];
            }else{
                // ==========Genrate Account Number===========
                    $sql_ac = mysqli_query($con,"SELECT id FROM notify ORDER BY id DESC LIMIT 1");
                    $checked_ac = mysqli_fetch_assoc($sql_ac);

                    if(mysqli_num_rows($sql_ac)>0){
                        $prives_ac = $checked_ac['id'];
                        $noti_id = $prives_ac+1;
                        // $noti_id = str_pad($ac_incrase, 12,0, STR_PAD_LEFT);
                    }else{
                        $noti_id = "9";
                    }
                // ======X===Genrate Account Number===X=======
            }
        //========X==View Profile Functionality==X=============
    //=========X===For Other Functionality===X======

    // ============Get Massege Here===========
        if(isset($_GET["msg"]) && $_GET["msg"] != ""){
            $msg_get = mysqli_escape_string($con,$_GET["msg"]);
            if($msg_get == "msg"){
                $msg = "<div class='alert alert-success alert-dismissible fade show' role='alert'>
                    <h4 class='alert-heading'>Well done!</h4>
                    <strong>Customer Detailes Added Successfully</strong>
                    <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
                </div>";
            }
        }
    // =========X===Get Massege Here===X=======

    // ========= Send Records Functionality ========
        if(isset($_POST['add_customer'])){
            $title = mysqli_escape_string($con,$_POST['title']);
            $content = mysqli_escape_string($con,$_POST['content']);
            $rolee = mysqli_escape_string($con,$_POST['role']);
            
            $account_no = $noti_id;

            // $sql_fetch = mysqli_query($con,"SELECT * FROM notify WHERE aadhar_number = '$aadhar_number'");
            if($option == ''){
                // if(mysqli_num_rows($sql_fetch)>0){
                //     $msg = "<div class='alert alert-warning alert-dismissible fade show' role='alert'>
                //         <strong>Ooop!</strong> Cusstomer Account Alrady Exist! Because Addhar Number is Alrady Linked.
                //         <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
                //     </div>";
                // }else{
                    mysqli_query($con,"INSERT INTO `notify` (`title`, `content`, `role`) VALUES ('$title', '$content', '$rolee')");

                    echo "<script>window.location='New__Customer.php?type=n&msg=msg'</script>";
                // }
            }else{
                mysqli_query($con,"UPDATE `notify` SET title = '$title', role = '$rolee', content = '$content' WHERE id = '$noti_id'");
           
                echo "<script>window.location='Customers.php?type=n&msg=msg'</script>";
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
                            <h2>View Customer Detailes</h2>
                            <p><span class='text-primary'>$title</span> Detailes Here...</p>
                        ";
                    }else if ($option == 'edit'){
                        echo "
                            <h2>Edit Customer Details</h2>
                            <p><span class='text-primary'>$title</span> Edit Detailes Here...</p>
                        ";
                    }else{
                        echo "
                            <h2>Add Customer</h2>
                            <p>Add Customer Details Here</p>
                        ";
                    }
                ?>
            </div>
            <form method="post" action="" class="row g-3 mt-2 mb-2">
                <div class="col-xl-6">
                    <label for="id" class="form-label">Account Number</label>
                    <input type="text" disabled value="<?php echo  $noti_id; ?>" class="form-control text-primary" id="id" name="id" required>
                </div>
                <div class="col-md-6">
                    <label for="role" class="form-label">Role</label>
                    <input <?php echo $disabled; ?> type="text" class="form-control" value="<?php echo $rolee ?>" id="role" name="role" required>
                </div>
                <div class="col-md-6">
                    <label for="content" class="form-label">Content</label>
                    <input <?php echo $disabled; ?> type="text" value="<?php echo $content ?>" class="form-control" id="content" name="content" required>
                </div>
                <div class="col-md-6">
                    <label for="title" class="form-label">Title</label>
                    <input <?php echo $disabled; ?> type="text" value="<?php echo $title ?>" name="title" class="form-control" id="title" required>
                </div>
                <?php if($option == 'view'){ ?>

                <?php }else{ ?>
                    <div class="col-12 text-center">
                        <button type="submit" name="add_customer" class="btn btn-primary">
                            <?php
                                if($option == 'edit'){
                                    echo 'Edit Customer Detailes';
                                }else{
                                    echo 'Add Customer';
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