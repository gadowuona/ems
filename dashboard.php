<?php
include('includes/config.php');

if (!isset($_SESSION['user_id'])) {
    header("Location: index.php");
    exit();
}

// $pageTitle = 'Dashboard';

//counter parts
function getTotalMembersCount()
{
    global $conn;

    $totalMembersQuery = "SELECT COUNT(*) AS totalMembers FROM members";
    $totalMembersResult = $conn->query($totalMembersQuery);

    if ($totalMembersResult->num_rows > 0) {
        $totalMembersRow = $totalMembersResult->fetch_assoc();
        return $totalMembersRow['totalMembers'];
    } else {
        return 0;
    }
}

function getTotalDeadMembersCount()
{
    global $conn;

    $totalDeadMembersQuery = "SELECT COUNT(*) AS totalDeadMembers FROM members where living_status='Dead'";
    $totalDeadMembersResult = $conn->query($totalDeadMembersQuery);

    if ($totalDeadMembersResult->num_rows > 0) {
        $totalDeadMembersRow = $totalDeadMembersResult->fetch_assoc();
        return $totalDeadMembersRow['totalDeadMembers'];
    } else {
        return 0;
    }
}

function gettotalAliveMembersCount()
{
    global $conn;

    $totalAliveMembersQuery = "SELECT COUNT(*) AS totalAliveMembers FROM members where living_status='Alive'";
    $totalAliveMembersResult = $conn->query($totalAliveMembersQuery);

    if ($totalAliveMembersResult->num_rows > 0) {
        $totalAliveMembersRow = $totalAliveMembersResult->fetch_assoc();
        return $totalAliveMembersRow['totalAliveMembers'];
    } else {
        return 0;
    }
}
function gettotalNppMembersCount()
{
    global $conn;

    $totalNppMembersQuery = "SELECT COUNT(*) AS totalNppMembers FROM members where affiliation='NPP'";
    $totalNppMembersResult = $conn->query($totalNppMembersQuery);

    if ($totalNppMembersResult->num_rows > 0) {
        $totalNppMembersRow = $totalNppMembersResult->fetch_assoc();
        return $totalNppMembersRow['totalNppMembers'];
    } else {
        return 0;
    }
}
function gettotalNdcMembersCount()
{
    global $conn;

    $totalNdcMembersQuery = "SELECT COUNT(*) AS totalNdcMembers FROM members where affiliation='NDC'";
    $totalNdcMembersResult = $conn->query($totalNdcMembersQuery);

    if ($totalNdcMembersResult->num_rows > 0) {
        $totalNdcMembersRow = $totalNdcMembersResult->fetch_assoc();
        return $totalNdcMembersRow['totalNdcMembers'];
    } else {
        return 0;
    }
}


function getNewMembersCount() {
  global $conn;
  // Visit codeastro.com for more projects
  $twentyFourHoursAgo = time() - (24 * 60 * 60);

  $newMembersQuery = "SELECT COUNT(*) AS newMembersCount FROM members WHERE created_at >= FROM_UNIXTIME($twentyFourHoursAgo)";
  $newMembersResult = $conn->query($newMembersQuery);

  if ($newMembersResult) {
      $row = $newMembersResult->fetch_assoc();
      return $row['newMembersCount'];
  } else {
      return 0;
  }
}

// Function to display the total count of new members with HTML markup
function displayNewMembersCount() {
  $newMembersCount = getNewMembersCount();
  echo "<span class='info-box-number'>$newMembersCount</span>";
}


$fetchLogoQuery = "SELECT logo FROM settings WHERE id = 1";
$fetchLogoResult = $conn->query($fetchLogoQuery);

if ($fetchLogoResult->num_rows > 0) {
    $settings = $fetchLogoResult->fetch_assoc();
    $logoPath = $settings['logo'];
} else {
    $logoPath = 'dist/img/default-logo.png';
}
// Visit codeastro.com for more projects
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
          <div class="col-12 col-sm-6 col-md-3">
            <div class="info-box">
              <span class="info-box-icon bg-primary elevation-1"><i class="fas fa-users"></i></span>
              <div class="info-box-content">
                <span class="info-box-text">Total Members</span>
                <span class="info-box-number"><?php echo getTotalMembersCount(); ?></span>
              </div>
            </div>
          </div>
              <!-- /.info-box-content -->  
          <div class="col-12 col-sm-6 col-md-3">
              <div class="info-box">
                <span class="info-box-icon bg-danger elevation-1"><i class="fas fa-bed"></i></span>
                <div class="info-box-content">
                  <span class="info-box-text">Total Dead Members</span>
                  <span class="info-box-number"><?php echo getTotalDeadMembersCount(); ?></span>
              </div>
            </div>
          </div>
            
            <!-- /.info-box -->
        
          <div class="col-12 col-sm-6 col-md-3">
            <div class="info-box">
              <span class="info-box-icon bg-primary elevation-1"><i class="fas fa-bed"></i></span>
                <div class="info-box-content">
                 <span class="info-box-text">Total Alive Members</span>
                 <span class="info-box-number"><?php echo getTotalAliveMembersCount(); ?></span>
              </div> <!-- /.info-box -->
             </div>
          </div>
          
        <div class="col-12 col-sm-6 col-md-3">
            <div class="info-box">
              <span class="info-box-icon bg-primary elevation-1"><i class="fas fa-bed"></i></span>
                <div class="info-box-content">
                  <span class="info-box-text">Total NPP Members</span>
                  <span class="info-box-number"><?php echo getTotalNppMembersCount(); ?></span>
              </div> <!-- /.info-box -->
             </div>
          </div>
          
          <div class="col-12 col-sm-6 col-md-3">
            <div class="info-box">
              <span class="info-box-icon bg-primary elevation-1"><i class="fas fa-bed"></i></span>
                <div class="info-box-content">
                 <span class="info-box-text">Total NDC Members</span>
                 <span class="info-box-number"><?php echo getTotalNdcMembersCount(); ?></span>
                </div> <!-- /.info-box -->
             </div>
          </div>

      
         
          
          
          

          <!-- fix for small devices only -->
          <div class="clearfix hidden-md-up">
         
              <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
          </div>
          <!-- /.col -->
          
          <!-- /.col -->
        </div>
        <!-- /.row -->
        <!-- Visit codeastro.com for more projects -->
        

        <!-- Main row -->
        



            <!-- /.card -->
          </div>
          <!-- /.col -->
        </div>
        <!-- /.row -->
      </div><!--/. container-fluid -->
    </section>
    <!-- /.content -->
  </>
  <!-- /.content-wrapper -->

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
</body>
</html>

