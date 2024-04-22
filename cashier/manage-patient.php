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
	<title>Admin | View Patients</title>

	<link
		href="http://fonts.googleapis.com/css?family=Lato:300,400,400italic,600,700|Raleway:300,400,500,600,700|Crete+Round:400italic"
		rel="stylesheet" type="text/css" />
	<link rel="stylesheet" href="vendor/bootstrap/css/bootstrap.min.css">
	<link rel="stylesheet" href="vendor/fontawesome/css/font-awesome.min.css">
	<link rel="stylesheet" href="path/to/font-awesome/css/font-awesome.min.css">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">
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
								<h1 class="mainTitle">Admin | View Patients</h1>
							</div>
							<ol class="breadcrumb">
								<li>
									<span>Admin</span>
								</li>
								<li class="active">
									<span>View Patients</span>
								</li>
							</ol>
						</div>
					</section>

					<div class="container-fluid container-fullw bg-white">
						<div class="row">
							<div class="col-md-12">
								<div class="card">
									<div class="card-header">

									</div>
								</div>
								<form class="text-right" method="POST">
									<input type="text" name="search" placeholder="Search" size="35" autocomplete="on">
									<button class="seach-button">
										<i class="fa fa-search"></i>
									</button>
								</form>
								<p style="color:red;"><?php echo htmlentities($_SESSION['msg']); ?>
									<?php echo htmlentities($_SESSION['msg'] = ""); ?>
								</p>
								<form action="" method="POST">
									<div class="row">
										<div class="col-md-1">
											<div class="input-group mb-3">
												<select name="pat_type" class="form-control" id="pat_type">
													<option value="all">All</option>
													<option value="online" <?php if ($pat_type == 'online')
														echo 'selected'; ?>>Online</option>
													<option value="walkin" <?php if ($pat_type == 'walkin')
														echo 'selected'; ?>>Walk-in</option>
												</select>
											</div>
										</div>
									</div>
								</form>
								<div class="table-responsive">
									<table id="demo-foo-filtering" class="table table-bordered toggle-circle mb-0"
										data-page-size="7">
										<thead>
											<tr>
												<th class="center" style="background-color:LightGray">#</th>
												<th scope="col" style="background-color:LightGray">Full Name</th>
												<th scope="col" style="background-color:LightGray">Reference number</th>
												<th scope="col" style="background-color:LightGray">Services</th>
												<th scope="col" style="background-color:LightGray">Type of Service</th>
												<th scope="col" style="background-color:LightGray">Payment Status</th>
												<th scope="col" style="background-color:LightGray">Appointment Date
												</th>
												<th scope="col" style="background-color:LightGray">Action</th>
											</tr>
										</thead>
										<tbody>
											<?php
											$search = isset($_POST['search']) ? $_POST['search'] : '';
											$pat_type = isset($_POST['pat_type']) ? $_POST['pat_type'] : '';
											$sql = mysqli_query($con, "SELECT * FROM tblpatient WHERE pat_fname LIKE '%$search%' OR pat_lname LIKE '%$search%' OR pat_refnum LIKE '%$search%'");
											$cnt = 1;
											while ($row = mysqli_fetch_array($sql)) {
												?>
												<tr>
													<td class="center"><?php echo $cnt; ?></td>
													<td class="hidden-xs"><?php echo $row['pat_lname']; ?>,
														<?php echo $row['pat_fname']; ?></td>
													<td><?php echo $row['pat_refnum']; ?></td>
													<td><?php echo $row['pat_services']; ?></td>
													<td><?php echo $row['pat_type']; ?></td>
													<td><?php echo $row['pat_paymentstatus']; ?></td>
													<td><?php echo $row['CreationDate']; ?></td>
													</td>
													<td>
														<a href="view-patient.php?viewid=<?php echo $row['ID']; ?>"
															class="badge badge-primary  "><i class="fa fa-eye"></i> VIEW</a>
														<a href="manage-patient.php?ID=<?php echo $row['ID']; ?>&del-delete"
															onclick="return confirm('Are your sure you want to delete?')"
															class="badge badge-danger" tooltip-placement="center"
															tooltip="Remove"><i class="fa fa-trash"></i> DELETE</a>

													</td>
												</tr>
												<?php
												$cnt = $cnt + 1;
											} ?>
										</tbody>
									</table>
								</div>
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