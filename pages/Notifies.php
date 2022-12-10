<?php
    include '../components/Navigation__Bar.php';
     // ===========Condition==============
        if(!isset($_SESSION['IS_LOGGIN'])){
            echo "<script>window.location='Login.php?type=n'</script>";
        }
    // ========X===Condition===x=========
    $msg = '';
    // ============Get Massege Here===========
        if(isset($_GET["msg"])){
            $msg_get = mysqli_escape_string($con,$_GET["msg"]);
            if($msg_get == "msg"){
                $msg = "<div class='alert alert-success alert-dismissible fade show' role='alert'>
                    <h4 class='alert-heading'>Well done!</h4>
                    <strong>Customer Detailes Edited Successfully</strong>
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
                mysqli_query($con,"DELETE FROM notify WHERE id = '$id'");
                echo "<script>window.location='Notifies.php?type=n'</script>";
            }
        }
    // =======X===Delete Functionality===X======

    // =============Get Record==============
        $sql = mysqli_query($con,"SELECT * FROM notify ORDER BY id DESC");
    // =============Get Record==============
?>
    <!-- Display Customer Table -->
        <?php include '../components/User_Name.php' ?>
        <?php echo $msg;?>
        <div class="container" id="display_record">
            <div class="row text-center">
                <h2>All Customers</h2>
                <p>All Customers Details Here</p>
            </div>
            <div class="table-responsive mt-2">
                <table class="table table-striped table-hover table-bordered">
                    <thead>
                        <tr>
                            <th width="2%" scope="col">ID</th>
                            <th width="15%" scope="col">Title</th>
                            <th width="30%" scope="col">Content</th>
                            <th width="5%" scope="col">Role</th>
                            <th width="6%" scope="col">Created At </th>
                            <th width="6%" scope="col">Options</th>
                            
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                            while ($row = mysqli_fetch_assoc($sql)){
                        ?>
                            <tr>
                                <th scope="row" class="text-primary"><?php echo $row['id']?></th>
                                <th scope="row" class="text-success"><?php echo  $row['title']?></th>
                                <td><?php echo $row['content']?></td>
                                <td><?php echo $row['role']?></td>
                                <td>
                                    <?php 
                                        $dateStr=strtotime($row['created_At']);
                                        echo date('d-m-Y',$dateStr);
                                    ?>
                                </td>
                                
                                <td class="d-flex justify-content-around">
                                    <a href="New__Customer.php?type=n&id=<?php echo $row['id']?>&option=view"><i class="far fa-eye text-primary"></i></a>
                                    <a href="New__Customer.php?type=n&id=<?php echo $row['id']?>&option=edit"><i class="fas fa-pen text-success"></i></a>
                                    <a href="?type=n&id=<?php echo $row['id']?>&option=delete"><i class="fas fa-trash text-danger"></i></a>
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