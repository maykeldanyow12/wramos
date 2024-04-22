<?php
$id = $_SESSION["id"];
$loadUser = mysqli_query($con, "SELECT * FROM admin WHERE id= $id");

$user = mysqli_fetch_object($loadUser);


$LoadNotification = mysqli_query($con, "SELECT * FROM notifications ORDER BY id DESC LIMIT 3"); 
?>
<script src="https://js.pusher.com/8.2.0/pusher.min.js"></script>
<script>
    // Enable pusher logging - don't include this in production
    Pusher.logToConsole = true;

    var pusher = new Pusher('5a00f0d723077865b510', {
    	cluster: 'eu'
    });

	var channel = pusher.subscribe('notification_channel');
	channel.bind('notification_event', function(data) {
		$.ajax({
			type: 'POST',
			url: "./ajax/notification.php",
			success: function(data){
				$(".NotificationList").html(data)

				var length = $(".NotificationList li").length;
				$(".NotificationCount").text(length)

				let counter = 0;
				const maxIterations = 5;

				const intervalId = setInterval(() => {
					if(counter <= maxIterations){
						$(".NotificationCount").text("!");
						setTimeout(() => {
							$(".NotificationCount").text(length);
						}, 500);
					}
					counter++;
				}, 1000);

			}
		});
	});

</script>
<header class="navbar navbar-default navbar-static-top">
	<!-- start: NAVBAR HEADER -->
	<div class="navbar-header">
		<a
			href="#"
			class="sidebar-mobile-toggler pull-left hidden-md hidden-lg"
			class="btn btn-navbar sidebar-toggle"
			data-toggle-class="app-slide-off"
			data-toggle-target="#app"
			data-toggle-click-outside="#sidebar" 
			
		>
			<i class="ti-align-justify text-red"></i>
		</a>
		<a
			class="navbar-brand"
			href="#"
		>
			<img
				src="assets/images/logo-inline.jpg"
				width="100px"
				alt="Logo"
			/>
		</a>
		<a
			href="#"
			class="sidebar-toggler pull-right visible-md visible-lg"
			data-toggle-class="app-sidebar-closed"
			data-toggle-target="#app"
		>
			<i class="ti-align-justify"></i>
		</a>
		<a
			class="pull-right menu-toggler visible-xs-block"
			id="menu-toggler"
			data-toggle="collapse"
			href=".navbar-collapse"
		>
			<span class="sr-only">Toggle navigation</span>
			<i class="ti-view-grid"></i>
		</a>
	</div>
	<!-- end: NAVBAR HEADER -->
	<!-- start: NAVBAR COLLAPSE -->
	<div class="navbar-collapse collapse">
		<ul class="nav navbar-right">
			<!-- start: MESSAGES DROPDOWN -->
			<li class="dropdown current-user">
				<a class="dropdown-toggle" data-toggle="dropdown" style="font-size: 1rem">
					<i class="ti-bell" style="font-size: 1.2rem"></i>
					<div class="NotificationCount">
						<?= mysqli_num_rows($LoadNotification) ?>
					</div>
				</a>
				<ul class="dropdown-menu NotificationList" style="width: 300px; padding: 5px;">
					<?php while($notification = mysqli_fetch_assoc($LoadNotification)) {?>
						<li>
							<div style="padding: 5px;">
								<strong>New Appointment</strong>
								<p>Patients book an appointment <br> <b><?= $notification["creationDate"] ?></b></p>
								<p></p>
								<a href="<?= $notification["button_more_details_url"] ?>"
									class="btn btn-primary btn-block btn-sm"
								>
									View Appointment
								</a>
								<hr>
							</div>
						</li>
					<?php } ?>
				</ul>
			</li>
			<li class="dropdown current-user">
				<a
					class="dropdown-toggle"
					data-toggle="dropdown"
				>
					<img
						src="assets/images/images.jpg"
						width="20px"
						height="40px"
					>
					<span class="username">
						ADMIN
					</span>
					<i class="ti-angle-down"></i>
				</a>
				<ul class="dropdown-menu dropdown-dark">
					<li>
						<a href="change-password.php">
							Change Password
						</a>
					</li>
					<li>
						<a href="logout.php">
							Log Out
						</a>
					</li>
				</ul>
			</li>
			<!-- end: USER OPTIONS DROPDOWN -->
		</ul>
		<!-- start: MENU TOGGLER FOR MOBILE DEVICES -->
		<div
			class="close-handle visible-xs-block menu-toggler"
			data-toggle="collapse"
			href=".navbar-collapse"
		>
			<div class="arrow-left"></div>
			<div class="arrow-right"></div>
		</div>
		<!-- end: MENU TOGGLER FOR MOBILE DEVICES -->
	</div>


	<!-- end: NAVBAR COLLAPSE -->
</header>