<?php
include('includes/config.php');

if (!isset($_SESSION['user_id'])) {
    header("Location: index.php");
    exit();
}

$response = array('success' => false, 'message' => '');

/* var_dump($_GET['id']); */
$fetchMemberResult ="";
if (isset($_GET['id'])) {
    $Id = $_GET['id'];

    $fetchMemberQuery = "SELECT * FROM members WHERE id = $Id";
    $fetchMemberResult = $conn->query($fetchMemberQuery);

    if ($fetchMemberResult->num_rows > 0) {
        $memberDetails = $fetchMemberResult->fetch_assoc();
    } else {
        header("Location: members_list.php");
        exit();
    }
}

function generateUniqueFileName($filename)
{
    $ext = pathinfo($filename, PATHINFO_EXTENSION);
    $basename = pathinfo($filename, PATHINFO_FILENAME);
    $uniqueName = $basename . '_' . time() . '.' . $ext;
    return $uniqueName;
}

if (isset($_POST['id'])) {
    $id = $_POST['id'];
    $fullname = $_POST['fullname'];
    $dob = $_POST['dob'];
    $gender = $_POST['gender'];
    $contact = $_POST['contact'];
    $town = $_POST['town'];
    $district = $_POST['district'];
    $psc = $_POST['psc'];
    $psn = $_POST['psn'];
    $affiliation = $_POST['affiliation'];
    $living_status = $_POST['living_status'];

    /* $photoUpdate = "";
    $uploadedPhoto = $_FILES['photo']; */

   /*  if (!empty($uploadedPhoto['name'])) {
        $uniquePhotoName = generateUniqueFileName($uploadedPhoto['name']);
        move_uploaded_file($uploadedPhoto['tmp_name'], 'uploads/member_photos/' . $uniquePhotoName);
        $photoUpdate = ", photo='$uniquePhotoName'"; */
    

    $updateQuery = "UPDATE members SET fullname='".$fullname."', dob='".$dob."', gender='".$gender."', 
                    contact='".$contact."', town='".$town."', district='".$district."', psc='".$psc."',affiliation='".$affiliation."', 
                     living_status='".$living_status."' 
                    WHERE id = '".$id."'";


    $update = $conn->query($updateQuery);
    if  ( $update) {
        $response['success'] = true;
        $response['message'] = 'Member updated successfully!';
        
        header("Location: manage_members.php");
        exit();
    } else {
        $response['message'] = 'Error: ' . $conn->error;
    }
}

?>


<?php include('includes/header.php');?>

<body class="hold-transition sidebar-mini layout-fixed layout-navbar-fixed layout-footer-fixed">
<div class="wrapper">
    <?php include('includes/nav.php'); ?>

    <?php include('includes/sidebar.php'); ?>

    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <?php include('includes/pagetitle.php'); ?>

        <!-- Main content -->
        <section class="content">
            <div class="container-fluid">
                <!-- Info boxes -->
                <div class="row">
                    <!-- left column -->
                    <div class="col-md-12">

                        <?php if ($response['success']): ?>
                            <div class="alert alert-success alert-dismissible">
                                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                                <h5><i class="icon fas fa-check"></i> Success</h5>
                                <?php echo $response['message']; ?>
                            </div>
                        <?php elseif (!empty($response['message'])): ?>
                            <div class="alert alert-danger alert-dismissible">
                                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                                <h5><i class="icon fas fa-ban"></i> Error</h5>
                                <?php echo $response['message']; ?>
                            </div>
                        <?php endif; ?>

                        <!-- general form elements -->
                        <div class="card card-primary">
                            <div class="card-header">
                                <h3 class="card-title"><i class="fas fa-keyboard"></i> Edit Member Details</h3>
                            </div>
                            <!-- /.card-header -->
                            <!-- form start -->
                            
                            <form method="post" action="" enctype="multipart/form-data">
                            <input type="hidden" name="id" value="<?php echo $memberDetails['id']; ?>">
                                <div class="card-body">
                                    <div class="row">
                                    <div class="col-sm-6">
                                    <label for="fullname">Full Name</label>
                                    <input type="text" class="form-control" id="fullname" name="fullname"
                                        placeholder="Enter full name" required value="<?php echo $memberDetails['fullname']; ?>">
                                </div>
                                        <div class="col-sm-3">
                                            <label for="dob">Date of Birth</label>
                                            <input type="date" class="form-control" id="dob" name="dob" value="<?php echo $memberDetails['dob']; ?>" required>
                                        </div>
                                        
                                        <div class="col-sm-3">
                                        <label for="gender">Gender</label>
                                        <select class="form-control" id="gender" name="gender" required>
                                            <option value="Male" <?php echo ($memberDetails['gender'] == 'Male') ? 'selected' : ''; ?>>Male</option>
                                            <option value="Female" <?php echo ($memberDetails['gender'] == 'Female') ? 'selected' : ''; ?>>Female</option>
                                            <option value="Other" <?php echo ($memberDetails['gender'] == 'Other') ? 'selected' : ''; ?>>Other</option>
                                        </select>
                                    </div>

                                    </div>


                                    <div class="row mt-3">
                                        <div class="col-sm-6">
                                            <label for="contactNumber">Contact Number</label>
                                            <input type="tel" class="form-control" id="contact"
                                                   name="contact" placeholder="Enter contact number" value="<?php echo $memberDetails['contact']; ?>" required>
                                        </div>
                                        <div class="col-sm-6">
                                            <label for="town">Town</label>
                                            <input type="town" class="form-control" id="town" name="town"
                                                   placeholder="Enter town" value="<?php echo $memberDetails['town']; ?>" required>
                                        </div>
                                    </div>

                                    <div class="row mt-3">
                                        <div class="col-sm-6">
                                            <label for="address">Region</label>
                                            <input type="text" class="form-control" id="region" name="region"
                                                   placeholder="Enter address" value="<?php echo $memberDetails['region']; ?>" required>
                                        </div>
                                        <div class="col-sm-6">
                                            <label for="district">District</label>
                                            <input type="text" class="form-control" id="district" name="district"
                                                   placeholder="Enter district" value="<?php echo $memberDetails['district']; ?>" required>
                                        </div>
                                    </div>

                                    <div class="row mt-3">
                                        <div class="col-sm-6">
                                            <label for="psc">Polling Station Code</label>
                                            <input type="text" class="form-control" id="psc" name="psc"
                                                   placeholder="Enter polling station code" value="<?php echo $memberDetails['psc']; ?>" required>
                                        </div>
                                        <div class="col-sm-6">
                                            <label for="psn">Polling Station Name</label>
                                            <input type="text" class="form-control" id="psn" name="psn"
                                                   placeholder="Enter polling station name" value="<?php echo $memberDetails['psn']; ?>" required>
                                        </div>
                                        <div class="col-sm-6">
                                            <label for="psn">Affiliation</label>
                                            <select class="form-control" id="affiliation" name="affiliation" required>
                                            <option value="" <?php echo ($memberDetails['affiliation'] == 'NPP') ? 'selected' : ''; ?>>select an affiliation</option>
                                            <option value="NPP" <?php echo ($memberDetails['affiliation'] == 'NPP') ? 'selected' : ''; ?>>NPP</option>
                                            <option value="NDC" <?php echo ($memberDetails['affiliation'] == 'NDC') ? 'selected' : ''; ?>>NDC</option>
                                            <option value="Other" <?php echo ($memberDetails['affiliation'] == 'Other') ? 'selected' : ''; ?>>Other</option>
                                        </select>  </div>

                                        <div class="col-sm-6">
                                            <label for="living_status">Living Status</label>
                                            <select class="form-control" id="living_status" name="living_status" required>
                                            <option value="" <?php echo ($memberDetails['living_status'] == 'Alive') ? 'selected' : ''; ?>>select a status</option>
                                            <option value="Alive" <?php echo ($memberDetails['living_status'] == 'Alive') ? 'selected' : ''; ?>>Alive</option>
                                            <option value="Dead" <?php echo ($memberDetails['living_status'] == 'Dead') ? 'selected' : ''; ?>>Dead</option>
                                            
                                        </select>  </div>
                                    </div>
                                    
                                    

                                </div>
                                <!-- /.card-body -->

                                <div class="card-footer">
                                    <button type="submit" class="btn btn-primary">Update</button>
                                </div>
                            </form>
                        </div>
                        <!-- /.card -->

                    </div>
                    <!--/.col (left) -->

                </div>
                <!-- /.row -->


            </div><!--/. container-fluid -->
        </section>
        <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->

    <!-- Control Sidebar -->
    <aside class="control-sidebar control-sidebar-dark">
        <!-- Control sidebar content goes here -->
    </aside>
    <!-- /.control-sidebar -->

    <!-- Main Footer -->
    <footer class="main-footer">
    <strong> &copy; <?php echo date('Y');?> annandowuona.com</a> -</strong>
    All rights reserved.
    <div class="float-right d-none d-sm-inline-block">
      <b>Developed By</b> <a href="https://annand.vercel.app/">AnnanD Consult</a>
    </div>
  </footer>
</div>
<!-- ./wrapper -->

<?php include('includes/footer.php'); ?>
</body>
</html>
