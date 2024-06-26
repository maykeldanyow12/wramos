<?php
session_start();
error_reporting(0);
include ('include/config.php');
include ('include/checklogin.php');
check_login();

?>
<!DOCTYPE html>
<html lang="en">

<head>
	<title>Admin | Manage Patients</title>

	<link
		href="http://fonts.googleapis.com/css?family=Lato:300,400,400italic,600,700|Raleway:300,400,500,600,700|Crete+Round:400italic"
		rel="stylesheet" type="text/css" />
	<link rel="stylesheet" href="vendor/bootstrap/css/bootstrap.min.css">
	<link rel="stylesheet" href="vendor/fontawesome/css/font-awesome.min.css">
	<link rel="stylesheet" href="vendor/themify-icons/themify-icons.min.css">
	<link href="vendor/animate.css/animate.min.css" rel="stylesheet" media="screen">
	<link href="vendor/perfect-scrollbar/perfect-scrollbar.min.css" rel="stylesheet" media="screen">
	<link href="vendor/switchery/switchery.min.css" rel="stylesheet" media="screen">
	<link href="vendor/bootstrap-touchspin/jquery.bootstrap-touchspin.min.css" rel="stylesheet" media="screen">
	<link href="vendor/select2/select2.min.css" rel="stylesheet" media="screen">
	<link href="vendor/bootstrap-datepicker/bootstrap-datepicker3.standalone.min.css" rel="stylesheet" media="screen">
	<link href="vendor/bootstrap-timepicker/bootstrap-timepicker.min.css" rel="stylesheet" media="screen">
	<link rel="stylesheet" href="assets/css/styles.css">
	<link rel="stylesheet" href="assets/css/plugins.css">
	<link rel="stylesheet" href="assets/css/themes/theme-1.css" id="skin_color" />
</head>

<body>
	<div id="app">
		<?php include ('include/sidebar.php'); ?>
		<div class="app-content">
			<?php include ('include/header.php'); ?>
			<div class="main-content">
				<div class="wrap-content container" id="container">
					<!-- start: PAGE TITLE -->
					<section id="page-title">
						<div class="row">
							<div class="col-sm-8">
								<h1 class="mainTitle">Admin | Manage Patients</h1>
							</div>
							<ol class="breadcrumb">
								<li>
									<span>Admin</span>
								</li>
								<li class="active">
									<span>Manage Patients</span>
								</li>
							</ol>
						</div>
					</section>
					<div class="container-fluid container-fullw bg-white">
						<div class="row">
							<div class="col-md-12">

								<?php
								$vid = $_GET['viewid'];
								$ret = mysqli_query($con, "select * from tblpatient where ID='$vid'");
								$cnt = 1;
								while ($row = mysqli_fetch_array($ret)) {
									?>
									<table border="1" class="table table-bordered">
										<tr align="center">
											<td colspan="4" style="font-size:30px;color:blue">
												Patient Details</td>
										</tr>

										<tr>
											<th scope>Patient Name: </th>
											<td><?php echo $row['pat_fname']; ?>, <?php echo $row['pat_lname']; ?></td>
											<th scope>Patient Email</th>
											<td><?php echo $row['pat_email']; ?></td>
										</tr>
										<tr>
											<th scope>Patient Mobile Number</th>
											<td><?php echo $row['pat_contactnum']; ?></td>
											<th>Patient Address</th>
											<td><?php echo $row['pat_add']; ?></td>
										</tr>
										<tr>
											<th>Patient Gender</th>
											<td><?php echo $row['pat_gender']; ?></td>
											<th>Patient Age</th>
											<td><?php echo $row['pat_age']; ?></td>
										</tr>
										<tr>

											<th></th>
											<td><?php echo $row['pat_services']; ?></td>
											<th>Patient Reg Date</th>
											<td><?php echo $row['CreationDate']; ?></td>
										</tr>

									<?php } ?>
								</table>
								<?php

								$ret = mysqli_query($con, "select * from tblmedicalhistory  where PatientID='$vid'");



								?>
								<table id="datatable" class="table table-bordered dt-responsive nowrap"
									style="border-collapse: collapse; border-spacing: 0; width: 100%;">
									<tr align="center">
										<th colspan="8">Medical History</th>
									</tr>
									<tr>
										<th>#</th>
										<th>Blood Pressure</th>
										<th>Weight</th>
										<th>Blood Sugar</th>
										<th>Body Temprature</th>
										<th>Medical Prescription</th>
										<th>Visit Date</th>
									</tr>
									<?php
									while ($row = mysqli_fetch_array($ret)) {
										?>
										<tr>
											<td><?php echo $cnt; ?></td>
											<td><?php echo $row['BloodPressure']; ?></td>
											<td><?php echo $row['Weight']; ?></td>
											<td><?php echo $row['BloodSugar']; ?></td>
											<td><?php echo $row['Temperature']; ?></td>
											<td><?php echo $row['MedicalPres']; ?></td>
											<td><?php echo $row['CreationDate']; ?></td>
										</tr>
										<?php $cnt = $cnt + 1;
									} ?>
								</table>

							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
		<!-- start: FOOTER -->
		<?php include ('include/footer.php'); ?>
		<!-- end: FOOTER -->

		<!-- start: SETTINGS -->
		<?php include ('include/setting.php'); ?>

		<!-- end: SETTINGS -->
	</div>
	<!-- start: MAIN JAVASCRIPTS -->
	<script src="vendor/jquery/jquery.min.js"></script>
	<script src="vendor/bootstrap/js/bootstrap.min.js"></script>
	<script src="vendor/modernizr/modernizr.js"></script>
	<script src="vendor/jquery-cookie/jquery.cookie.js"></script>
	<script src="vendor/perfect-scrollbar/perfect-scrollbar.min.js"></script>
	<script src="vendor/switchery/switchery.min.js"></script>
	<!-- end: MAIN JAVASCRIPTS -->
	<!-- start: JAVASCRIPTS REQUIRED FOR THIS PAGE ONLY -->
	<script src="vendor/maskedinput/jquery.maskedinput.min.js"></script>
	<script src="vendor/bootstrap-touchspin/jquery.bootstrap-touchspin.min.js"></script>
	<script src="vendor/autosize/autosize.min.js"></script>
	<script src="vendor/selectFx/classie.js"></script>
	<script src="vendor/selectFx/selectFx.js"></script>
	<script src="vendor/select2/select2.min.js"></script>
	<script src="vendor/bootstrap-datepicker/bootstrap-datepicker.min.js"></script>
	<script src="vendor/bootstrap-timepicker/bootstrap-timepicker.min.js"></script>
	<!-- end: JAVASCRIPTS REQUIRED FOR THIS PAGE ONLY -->
	<!-- start: CLIP-TWO JAVASCRIPTS -->
	<script src="assets/js/main.js"></script>
	<!-- start: JavaScript Event Handlers for this page -->
	<script src="assets/js/form-elements.js"></script>
	<script>
		jQuery(document).ready(function () {
			Main.init();
			FormElements.init();
		});
	</script>
	<!-- end: JavaScript Event Handlers for this page -->
	<!-- end: CLIP-TWO JAVASCRIPTS -->
</body>

</html>