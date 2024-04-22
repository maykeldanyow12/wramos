<?php
session_start();
error_reporting(0);
include ('include/config.php');
include ('include/checklogin.php');
check_login();

if (isset($_POST['add'])) {
	$pat_fname = $_POST['pat_fname'];
	$pat_lname = $_POST['pat_lname'];
	$pat_bod = $_POST['pat_bod'];
	$pat_age = $_POST['pat_age'];
	$pat_contactnum = $_POST['pat_contactnum'];
	$pat_email = $_POST['pat_email'];
	$pat_gender = $_POST['pat_gender'];
	$pat_status = $_POST['pat_status'];
	$pat_add = $_POST['pat_add'];
	$pat_type = $_POST['pat_type'];
	$pat_services = $_POST['pat_services'];
	$CreationDate = $_POST['CreationDate'];

	$sql = mysqli_query($con, "insert into tblpatient (pat_fname, pat_lname, pat_bod, pat_age, pat_contactnum, pat_email, pat_gender,pat_status, pat_add, pat_type, pat_services, CreationDate) values ('$pat_fname','$pat_lname','$pat_bod','$pat_age','$pat_contactnum','$pat_email', '$pat_gender','$pat_status', '$pat_add','$pat_type','$pat_services','$CreationDate')");
	if ($sql) {
		echo "<script>alert('Add Patient Successfully');</script>";
		header('location:add-patient.php');

	}
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
	<title>Admin | Add Patient</title>

	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/css/bootstrap.min.css" rel="stylesheet">
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
		integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
		integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
		crossorigin="anonymous"></script>

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
	<script>
		function checkemailAvailability() {
			$("#loaderIcon").show();
			jQuery.ajax({
				url: "check_availability.php",
				data: 'emailid=' + $("#patemail").val(),
				type: "POST",
				success: function (data) {
					$("#email-availability-status").html(data);
					$("#loaderIcon").hide();
				},
				error: function () { }
			});
		}
	</script>
</head>

<body>
	<div id="app">
		<?php include ('include/sidebar.php'); ?>
		<div class="app-content">

			<?php include ('include/header.php'); ?>
			<div class="main-content"></div>

			<!-- end: TOP NAVBAR -->
			<div class="main-content">
				<div class="wrap-content container" id="container">
					<!-- start: PAGE TITLE -->
					<section id="page-title">
						<div class="row">
							<div class="col-sm-8">
								<h1 class="mainTitle">Admin | Add Patient</h1>
							</div>
							<ol class="breadcrumb">
								<li>
									<span>Admin</span>
								</li>
								<li class="active">
									<span>Add Patient</span>
								</li>
							</ol>
						</div>
					</section>
					<!-- end: PAGE TITLE -->
					<!-- start: BASIC EXAMPLE -->
					<div class="container-fluid container-fullw bg-white">
						<div class="row">
							<div class="col-md-11">

								<div class="row margin-top-30">
									<div class="col-lg-20 col-md-15">
										<div class="panel panel-white">
											<div class="panel-heading">
												<h6 class="panel-title text-bold text-center">PATIENT DETAILS</h6>
											</div>


											<div class="panel-body">
												<form role="form" name="" method="post">
													<div class="row">
														<div class="col-md-2">
															<div class="form-group">
																<label for="pat_type">Appointment Type:</label><br>
																<select type="text" name="pat_type"
																				class="form-control" required="true">
																				<option selected value="Walkin"> Walkin</option>
																				<option value="Online"> Online</option>
																			</select>
															</div>
														</div>
														<div class="col-md-3">
															<div class="form-group">
																<label for="CreationDate">
																	Appointment Date:
																</label>
																<input type="datetime-local" id="datetime"
																	name="CreationDate" class="form-control"
																	required="true">
															</div>
														</div>

														<div class="panel-body">
															<form role="form" name="" method="post">
																<div class="row">
																	<div class="col">
																		<div class="form-group">
																			<label for="pat_fname">
																				First Name:
																			</label>
																			<input type="text-bold" name="pat_fname"
																				class="form-control"
																				placeholder="Enter Patient First Name"
																				required="true">
																		</div>
																	</div>

																	<div class="col">
																		<div class="form-group">
																			<label for="pat_lname">
																				Last Name:
																			</label>
																			<input type="text-bold" name="pat_lname"
																				class="form-control"
																				placeholder="Enter Patient Last Name"
																				required="true">
																		</div>
																	</div>
																</div>

																<div class="row">
																	<div class="col">
																		<div class="form-group">
																			<label for="pat_bod"
																				class="form-label">Select Birth
																				Date:</label>
																			<input type="date" id="date" name="pat_bod"
																				class="form-control" required>
																		</div>
																	</div>

																	<div class="col">
																		<div class="form-group">
																			<label for="pat_age"
																				class="form-label">Age:</label>
																			<input type="text" class="form-control"
																				id="pat_age" name="pat_age" required>
																		</div>
																	</div>


																	<div class="col">
																		<div class="form-group">
																			<label for="pat_gender"
																				class="control-label">
																				Gender
																			</label>
																			<select type="text" name="pat_gender"
																				class="form-control" required="true">
																				<option value=""> --Select Gender--
																				</option>
																				<option value="Male"> Male</option>
																				<option value="Female"> Female</option>
																				<option value="Other"> Other</option>
																			</select>
																		</div>
																	</div>

																	<div class="col">
																		<div class="form-group">
																			<label for="pat_status">
																				Marital Status
																			</label>
																			<select type="text-bold" name="pat_status"
																				class="form-control" required="true">
																				<option value=""> --Select Status--
																				</option>
																				<option value="Male"> Single</option>
																				<option value="Female"> Married</option>
																				<option value="Female"> Divorced
																				</option>
																				<option value="Female"> Legally
																					Seperated</option>
																				<option value="Female"> Widowed</option>

																			</select>
																		</div>
																	</div>
																</div>

																<div class="row">
																	<div class="col">
																		<div class="form-group">
																			<label for="pat_add">
																				Complete Address
																			</label>
																			<textarea type="text-bold" name="pat_add"
																				class="form-control"
																				placeholder="Enter Patient Name"
																				required="true"></textarea>
																		</div>
																	</div>
																</div>

																<div class="row">
																	<div class="col">
																		<div class="form-group">
																			<label for="pat_contactnum">
																				Mobile Number
																			</label>
																			<input type="text" name="pat_contactnum"
																				class="form-control"
																				placeholder="(63+) 000-0000"
																				required="true" maxlength="10"
																				pattern="[0-9]+">
																		</div>
																	</div>

																	<div class="col">
																		<div class="form-group">
																			<label for="pat_email">
																				Email Address
																			</label>
																			<input type="text-bold" name="pat_email"
																				class="form-control"
																				placeholder="example@example.com"
																				required="true"
																				onBlur="userAvailability()">

																		</div>
																	</div>


																</div>

																<div class="row">
																	<div class="col">
																		<div class="form-group">
																			<label for="pat_services">
																				 Services
																			</label>
																			<input type="text" name="pat_contactnum"
																				class="form-control"
																				placeholder="Select Services"
																				required="true">
																		</div>
																	</div>

																	<div class="col">
																		<div class="form-group">
																			<label for="pat_paymentstatus">
																				Services Fee
																			</label>
																			<input type="text-bold" name="pat_email"
																				class="form-control"
																				placeholder="example@example.com"
																				required="true"
																				onBlur="userAvailability()">

																		</div>
																	</div>


																</div>



																<div class="row margin-top-30">
																	<div class="col-lg-20 col-md-15">
																		<div class="panel panel-white">
																			<div class="panel-heading">
																				<h6
																					class="panel-title text-bold text-center">
																					PATIENT DETAILS</h6>
																			</div>


																			<button type="add" name="add" id="add"
																				class="btn btn-o btn-primary">
																				Add Patient
																			</button>
															</form>
														</div>
													</div>
											</div>

										</div>
									</div>
									<div class="col-lg-12 col-md-12">
										<div class="panel panel-white">


										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>

				<!-- end: BASIC EXAMPLE -->

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