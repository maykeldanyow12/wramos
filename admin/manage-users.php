<?php
session_start();
error_reporting(0);
include('include/config.php');
include('include/checklogin.php');
check_login();

if(isset($_GET['del'])){
	mysqli_query($con,"delete from users where id = '".$_GET['id']."'");
	$_SESSION['msg']="data deleted !!";
}
?>
<!DOCTYPE html>
<html lang="en">
	<head>
		<title>Admin | Manage Users</title>
		
		<link href="http://fonts.googleapis.com/css?family=Lato:300,400,400italic,600,700|Raleway:300,400,500,600,700|Crete+Round:400italic" rel="stylesheet" type="text/css" />
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
			<?php include('include/sidebar.php');?>
			<div class="app-content">
				<?php include('include/header.php');?>
				<div class="main-content" >
					<div class="wrap-content container" id="container">
						<section id="page-title">
							<div class="row">
								<div class="col-sm-8">
									<h1 class="mainTitle">Admin | Manage Users</h1>
								</div>
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
												<option value="all" data-icon="fas fa-chevron-down" >All</option>
												<option value="online" <?php if($pat_type == 'online') echo 'selected'; ?>>Online</option>
												<option value="walkin" <?php if($pat_type == 'walkin') echo 'selected'; ?>>Walk-in</option>
										</select>
									</div>
								</div>
							</div>
						</form>
							<div class="table-responsive">
                                <table id="demo-foo-filtering" class="table table-bordered toggle-circle mb-0" data-page-size="7">
                                    <thead>
									<tr>
										<th class="center">#</th>
										<th>First Name</th>
										<th>Last Name</th>
										<th class="hidden-xs">Adress</th>
										<th>City</th>
										<th>Gender </th>
										<th>Email </th>
										<th>Creation Date </th>
										<th>Updation Date </th>
										<th>Action</th>
									</tr>
								</thead>
								<tbody>
									<?php
									$search = isset($_POST['search']) ? $_POST['search'] : '';
									$sql = mysqli_query($con, "SELECT * FROM users WHERE firstName LIKE '%$search%' OR lastName LIKE '%$search%' OR address LIKE '%$search%' OR city LIKE '%$search%' OR gender LIKE '%$search%' OR email LIKE '%$search%'");
									$cnt = 1;
									while ($row = mysqli_fetch_array($sql)) {
										?>
										<tr>
											<td class="center">
												<?php echo $cnt; ?>
											</td>
											<td class="hidden-xs">
												<?php echo $row['firstName']; ?>
											</td>
											<td class="hidden-xs">
												<?php echo $row['lastName']; ?>
											</td>
											<td>
												<?php echo $row['address']; ?>
											</td>
											<td>
												<?php echo $row['city']; ?>
											</td>
											<td>
												<?php echo $row['gender']; ?>
											</td>
											<td>
												<?php echo $row['email']; ?>
											</td>
											<td>
												<?php echo $row['regDate']; ?>
											</td>
											<td>
												<?php echo $row['updationDate']; ?>
											</td>
											<td>
												<div class="visible-md visible-lg hidden-sm hidden-xs">
													<a 
														href="view-patient.php?viewid=<?php echo $row['id'];?>"
														class="badge badge-primary  "
													><i class="fa fa-eye"></i> VIEW</a>
													<a
														href="manage-users.php?id=<?php echo $row['id'] ?>&del=delete"
														onClick="return confirm('Are you sure you want to delete?')"
														class="badge badge-danger"
														tooltip-placement="top"
														tooltip="Remove"
														class="badge badge-danger"
													><i class="fa fa-trash fa fa-white"></i> DELETE</a>
													<a
														href="manage-patient.php?id=<?php echo $row['id'] ?>add=add"
														onClick="return confirm('Are you sure you want to add to your patient?')"
														class="badge badge-primary"
														tooltip-placement="top"
														tooltip="Add"
													><i class="fa fa-plus fa fa-white"></i> ADD</a>
												</div>
												<div class="visible-xs visible-sm hidden-md hidden-lg">
													<div
														class="btn-group"
														dropdown
														is-open="status.isopen"
													>
														<button
															type="button"
															class="btn btn-primary btn-o btn-sm dropdown-toggle"
															dropdown-toggle
														>
															<i class="fa fa-cog"></i>&nbsp;<span class="caret"></span>
														</button>
														<ul
															class="dropdown-menu pull-right dropdown-light"
															role="menu"
														>
															<li>
																<a href="#">
																	Edit
																</a>
															</li>
															<li>
																<a href="#">
																	Share
																</a>
															</li>
															<li>
																<a href="#">
																	Remove
																</a>
															</li>
														</ul>
													</div>
												</div>
											</td>
										</tr>
										<?php
										$cnt = $cnt + 1;
									} ?>
							</div>
								</div>
							
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
	<?php include('include/footer.php');?>
			<!-- end: FOOTER -->
		
			<!-- start: SETTINGS -->
	<?php include('include/setting.php');?>
			
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
			jQuery(document).ready(function() {
				Main.init();
				FormElements.init();
			});
		</script>
		<!-- end: JavaScript Event Handlers for this page -->
		<!-- end: CLIP-TWO JAVASCRIPTS -->
	</body>
</html>
