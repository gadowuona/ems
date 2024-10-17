<?php
include('includes/config.php');

if (!isset($_SESSION['user_id'])) {
    header("Location: index.php");
    exit();
}

$response['success'] = false;
#$response['message'] = 'Member added successfully!';


/* $membershipTypesQuery = "SELECT id, type, amount FROM membership_types";
$membershipTypesResult = $conn->query($membershipTypesQuery);

function generateUniqueFileName($originalName) {
    $timestamp = time();
    $extension = pathinfo($originalName, PATHINFO_EXTENSION);
    $uniqueName = $timestamp . '_' . uniqid() . '.' . $extension;
    return $uniqueName;
} */


if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $voters_id = $_POST['voters_id'];
    $fullname = $_POST['fullname'];
    $father_name = $_POST['father_name'];
    $mother_name = $_POST['mother_name'];
    $religion = $_POST['religion'];
    $contact = $_POST['contact'];
    $age = $_POST['age'];
    $dob = $_POST['dob'];
    $gender = $_POST['gender'];
    $town = $_POST['town'];
    $region = $_POST['region'];
    $district = $_POST['district'];
    $psc = $_POST['psc'];
    $psn = $_POST['psn'];
    $affiliation = $_POST['affiliation'];
    $living_status = $_POST['living_status'];
    $created_at = date("Y-m-d");
    #$created_at = $_POST['created_at'];
    print_r($_POST);

    /*  if (!empty($_FILES['photo']['name'])) {
        $uploadedPhoto = $_FILES['photo'];
        $uniquePhotoName = generateUniqueFileName($uploadedPhoto['name']);

        move_uploaded_file($uploadedPhoto['tmp_name'], 'uploads/member_photos/' . $uniquePhotoName);
        } else {
            $uniquePhotoName = 'default.jpg';
        }
 */

        $stmt = $conn->query(sprintf("INSERT INTO members (voters_id,fullname,father_name,mother_name,religion,contact,age,dob,gender,town,region,district,psc,psn,affiliation,living_status,created_at) VALUES('%s', '%s', '%s', '%s', '%s', '%s', '%s', '%s', '%s', '%s', '%s', '%s', '%s', '%s', '%s', '%s');", 
                $conn->real_escape_string($voters_id),
                $conn->real_escape_string($fullname),
                $conn->real_escape_string($father_name),
                $conn->real_escape_string($mother_name),
                $conn->real_escape_string($religion),
                $conn->real_escape_string($contact),
                $conn->real_escape_string($age),
                $conn->real_escape_string($dob),
                $conn->real_escape_string($gender),
                $conn->real_escape_string($town),
                $conn->real_escape_string($region),
                $conn->real_escape_string($district),
                $conn->real_escape_string($psc),
                $conn->real_escape_string($psn),
                $conn->real_escape_string($affiliation),
                $conn->real_escape_string($living_status),
                $conn->real_escape_string($created_at)
        ));

        if($conn->insert_id > 0) header("Location: manage_members.php?success=true");

    }   
    
    
?>



<?php include('includes/header.php'); ?>

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
                            <!-- Visit codeastro.com for more projects -->
                            <!-- general form elements -->
                            <div class="card card-primary">
                                <div class="card-header">
                                    <h3 class="card-title"><i class="fas fa-keyboard"></i> Add Members Form</h3>
                                </div>
                                <!-- /.card-header -->
                                <!-- form start -->
                                <form method="post" action="" enctype="multipart/form-data">
                                    <!--  < class="card-body">
                                    < class="row"> -->
                                    <div class="col-sm-6">
                                        <label for="voters_id">Voter's ID </label>
                                        <input type="text" class="form-control" id="voters_id" name="voters_id"
                                            placeholder="Enter Voter's ID" required>
                                    </div>
                                    <div class="col-sm-6">
                                        <label for="fullname">Full Name</label>
                                        <input type="text" class="form-control" id="fullname" name="fullname"
                                            placeholder="Enter full name" required>
                                    </div>

                                    <div class="col-sm-6">
                                        <label for="father_name">Father's Name</label>
                                        <input type="text" class="form-control" id="father_name" name="father_name"
                                            placeholder="Enter father's name" required>
                                    </div>

                                    <div class="col-sm-6">
                                        <label for="mother_name">Mother's Name</label>
                                        <input type="text" class="form-control" id="mother_name" name="mother_name"
                                            placeholder="Enter mother's name" required>
                                    </div>

                                    <!-- <div class="row mt-6"> -->
                                    <div class="col-sm-6">
                                        <label for="contact">Contact Number</label>
                                        <input type="tel" class="form-control" id="contact"
                                            name="contact" placeholder="Enter contact number" required>

                                        <!-- <div class="row mt-3"> -->
                                        <div class="col-sm-6">
                                            <label for="age">Age</label>
                                            <input type="age" class="form-control" id="age"
                                                name="age" placeholder="Enter Age" required>

                                            <div class="col-md-9">
                                            <label for="age">Religion</label>
                                            <input type="religion" class="form-control" id="religion"
                                                name="religion" placeholder="Enter Religion" required>

                                            <div class="col-md-14">
                                                <label for="dob">Date of Birth</label>
                                                <input type="date" class="form-control" id="dob" name="dob" required>
                                            </div>
                                            <div class="col-md-9">
                                                <label for="gender">Gender</label>
                                                <select class="form-control" id="gender" name="gender" required>
                                                    <option value="Male">Male</option>
                                                    <option value="Female">Female</option>
                                                    <option value="Other">Other</option>
                                                </select>
                                            </div>
                                        </div>

                                    </div>
                                    <div class="col-sm-6">
                                    <label for="region">Region</label>
                                                <select class="form-control" id="region" name="region" required>
                                                    <option value="select">select a region</option>
                                                    <option value="ashanti">Ashanti</option>
                                                    <option value="brongAhafo">Brong Ahafo</option>
                                                    <option value="central">Central</option>
                                                    <option value="eastern">Eastern</option>
                                                    <option value="northern">Northern</option>
                                                    <option value="uppereast">Upper East</option>
                                                    <option value="upperwest">Upper West</option>
                                                    <option value="volta">Volta</option>
                                                    <option value="western">Western</option>
                                                    <option value="savannah">Savannah</option>
                                                    <option value="bnoeast">Bono East</option>
                                                    <option value="Oti">Oti</option>
                                                    <option value="ahafo">Ahafo</option>
                                                    <option value="westernnorth">Western North</option>
                                                    <option value="northeast">North East</option>
                                                </select>
                                    </div>


                                    <!-- <div class="row mt-3"> -->
                                    
                                    <div class="col-sm-6">
                                        <label for="district">District</label>
                                        <input type="text" class="form-control" id="district" name="district"
                                            placeholder="Enter District" required>
                                    </div>



                                    <!-- <div class="row mt-3"> -->
                                    <div class="col-sm-6">
                                        <label for="postcode">Polling Station Code</label>
                                        <input type="text" class="form-control" id="psc" name="psc"
                                            placeholder="Enter Polling Station Code" required>
                                    </div>
                                    <div class="col-sm-6">
                                        <label for="occupation">Polling Station Name</label>
                                        <input type="text" class="form-control" id="psn" name="psn"
                                            placeholder="Enter Polling Station Name" required>
                                    </div>

                                    <div class="col-sm-6">
                                        <label for="occupation">Affiliation</label>
                                        <input type="text" class="form-control" id="affiliation" name="affiliation"
                                            placeholder="Enter Affiliation" required>
                                    </div>

                                    <div class="col-sm-6">
                                        <label for="living_status">Living Status</label>
                                        <select class="form-control" id="living_status" name="living_status" required>
                                            <option value="">Select</option>
                                            <option value="Alive">Alive</option>
                                            <option value="Dead">Dead</option>

                                        </select>
                                    </div>


                                    <!-- /.card-body -->

                                    <div class="card-footer">
                                        <button type="submit" class="btn btn-primary">Submit</button>
                                    </div>
                                </form>
                            </div>
                            <!-- /.card -->

                        </div>
                        <!--/.col (left) -->

                    </div>
                    <!-- /.row -->
                    <!-- Visit codeastro.com for more projects -->

                </div><!--/. container-fluid -->
            </section>
            <!-- /.content -->
        </div>
        <!-- /.content-wrapper -->

        <!-- Control Sidebar -->
        <aside class="control-sidebar control-sidebar-dark">
            <!-- Control sidebar content goes here -->
        </aside>

        <!-- Main Footer -->
        <footer class="main-footer">
            <strong> &copy; <?php echo date('Y'); ?> annand.vercel.app</a> -</strong>
            All rights reserved.
            <div class="float-right d-none d-sm-inline-block">
                <b>Developed By</b> <a href="https://annand.vercel.app">AnnanD Consult</a>
            </div>
        </footer>
    </div>
    
    <!-- ./wrapper -->
    <?php include('includes/footer.php'); ?>

</body>

</html>