<?php
include('includes/config.php');

 /*   $selectQuery = "SELECT * FROM members limit 100";
  $result = $conn->query($selectQuery); */ 

 
 
/* // Retrieve voter IDs using prepared statement
$selectQuery = "SELECT voters_id FROM members";
$stmt = $conn->prepare($selectQuery);
$stmt->execute();
$result = $stmt->get_result(); */

/* // Display voter IDs
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        echo $row['voters_id'] . "<br>";
    }
} else {
    echo "No voter IDs found.";
}

// Close connection
$conn->close(); */





if (!isset($_SESSION['user_id'])) {
    header("Location: index.php");
    exit();
}



   $selectQuery = "SELECT * FROM members limit 1000";
   $result = $conn->query($selectQuery);  



if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $living_status = $_POST['living_status'];
    $religion = $_POST['religion'];

    #$insertQuery = "INSERT INTO members (voters_id, contact) VALUES ('$voters_id', $contact)";
    $updateQuery = "UPDATE members SET (living_status, religion) where voters_id = '".$voters_id."'";

    if ($conn->query($updateQuery) === TRUE) {
        $successMessage = 'Membership type added successfully!';
        // header("Location: dashboard.php");
        // exit();
    } else {
        echo "Error: " . $updateQuery . "<br>" . $conn->error;
    }
}


?>

<?php include('includes/header.php');?>

<body class="hold-transition sidebar-mini layout-fixed layout-navbar-fixed layout-footer-fixed">
<div class="wrapper">
  <?php include('includes/nav.php');?>

 <?php include('includes/sidebar.php');?>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    
  <?php include('includes/pagetitle.php');?>

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <!-- Info boxes -->
        <div class="row">
        
        <div class="col-12">

        <div class="card">
    <div class="card-header">
        <h3 class="card-title">Members Data</h3>
    </div>
    
    <div class="card-body">
    <table id="example1" class="table table-bordered table-striped">
        <thead>
            <tr>
                <th>#</th>
                <th>Voters ID</th>
                <th>Fullname</th>
                <th>Contact</th>
                <th>Town</th>
                <th>District</th>
                <th>Region</th>
                <th>Affiliation</th>
                <th>Living Status</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $counter = 1;
            while ($row = $result->fetch_assoc()) {
                
                /* $expiryDate = strtotime($row['expiry_date']);
                $currentDate = time();
                $daysDifference = floor(($expiryDate - $currentDate) / (60 * 60 * 24));

                $membershipStatus = ($daysDifference < 0) ? 'Expired' : 'Active'; */
 
                //$voters_id = $row['voters_id'];
                //$votersidQuery = "SELECT type FROM members WHERE voters_id = $voters_id";
                //$voters_id = $conn->query($voters_id);
                //$votersIdRow = $votersIdResult->fetch_assoc();
                //$voters_id = ($votersIdRow) ? $votersIdRow['type'] : 'Unknown'; 

                echo "<tr>";
                echo "<td>".$row['id']."</td>";
                echo "<td>".$row['voters_id']."</td>";
                echo "<td>".$row['fullname']."</td>";
                echo "<td>".$row['contact']."</td>";
                echo "<td>".$row['town']."</td>";
                echo "<td>".$row['district']."</td>";
                echo "<td>".$row['region']."</td>";
                echo "<td>".$row['affiliation']."</td>";
                echo "<td>".$row['living_status']."</td>";
                /* echo "<td>{$membershipTypeName}</td>";
                echo "<td>{$membershipStatus}</td>"; */

                echo "<td>";

                if (!empty($row['voters_id'])) {
                    echo "<a href='memberProfile.php?id={$row['id']}' class='btn btn-info'><i class='fas fa-id-card'></i></a>";
                }

                echo "
                    <a href='edit_member.php?id={$row['id']}' class='btn btn-primary'><i class='fas fa-edit'></i></a>
                    <button class='btn btn-danger' onclick='deleteMember({$row['id']})'><i class='fas fa-trash'></i></button>
                </td>";
                echo "</tr>";

                $counter++;
            }
            ?>
        </tbody>
    </table>
</div>

    <!-- /.card-body -->
</div>
            <!-- /.card -->
          </div>
          <!-- /.col -->

        </div>
        <!-- /.row -->

        
      </div><!--/. container-fluid -->
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
  <!-- Visit codeastro.com for more projects -->
  <!-- Control Sidebar -->
  <aside class="control-sidebar control-sidebar-dark">
    <!-- Control sidebar content goes here -->
  </aside>
  <!-- /.control-sidebar -->

  <!-- Main Footer -->
  <footer class="main-footer">
    <strong> &copy; <?php echo date('Y');?> AnnandConsult</a> -</strong>
    All rights reserved.
    <div class="float-right d-none d-sm-inline-block">
      <b>Developed By</b> <a href="https://annand.vercel.app/">AnnanD Consult</a>
    </div>
  </footer>
</div>
<!-- ./wrapper -->

<?php include('includes/footer.php');?>
<script>
  $(function () {
    $("#example1").DataTable({
      "responsive": true,
      "autoWidth": false,
    });
    $('#example2').DataTable({
      "paging": true,
      "lengthChange": false,
      "searching": false,
      "ordering": true,
      "info": true,
      "autoWidth": false,
      "responsive": true,
    });
  });
</script>

<script src="search.js">
    function deleteMember(id) {
        if (confirm("Are you sure you want to delete this member?")) {
            window.location.href = 'delete_members.php?id=' + id;
        }
    }
    

</script>
<h1>Voter Search</h1>
    <input type="number" id="search-input" placeholder="Enter Voter ID">
    <button onclick="searchVoters()">Search</button>
    <div id="search"></div>

</body>
</html>