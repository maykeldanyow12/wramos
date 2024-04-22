<?php
session_start();
error_reporting(0);
include('include/config.php');
include('include/checklogin.php');
check_login();

$LoadAppointments = mysqli_query($con,"SELECT * FROM appointment");
$LoadAppointmentsIncome = 0;
$MonthlyAppointmentsCurrentYear = mysqli_query($con,"
SELECT
    SUM(amount) AS total_income,
    MONTHNAME(creationDate) AS month_name,
    MONTH(creationDate) AS month
FROM
    appointment
WHERE
    YEAR(creationDate) = YEAR(CURRENT_DATE) AND MONTH(creationDate) BETWEEN 1 AND 12
    AND payment_status = 'success'
GROUP BY
    MONTH(creationDate)
ORDER BY
    MONTH(creationDate);
");

$dataPoints1 = array();
while($row = mysqli_fetch_assoc($MonthlyAppointmentsCurrentYear)){
    $dataPoints1[] = array(
        "x" => $row['month'],
        "label" => $row['month_name'],
        "y" => $row['total_income']
    );
    $LoadAppointmentsIncome += $row['total_income'];
}

$MonthlyAppointmentsLastYear = mysqli_query($con, "
SELECT
    SUM(amount) AS total_income,
    MONTHNAME(creationDate) AS month_name,
    MONTH(creationDate) AS month
FROM
    appointment
WHERE
    YEAR(creationDate) = (YEAR(CURRENT_DATE) - 1) AND MONTH(creationDate) BETWEEN 1 AND 12
    AND payment_status = 'success'
GROUP BY
    MONTH(creationDate)
ORDER BY
    MONTH(creationDate);
");

$dataPoints2 = array();
while ($row = mysqli_fetch_assoc($MonthlyAppointmentsLastYear)) {
    $dataPoints2[] = array(
        "x" => $row['month'],
        "label" => $row['month_name'],
        "y" => $row['total_income']
    );
    $LoadAppointmentsIncome += $row['total_income'];
}

$WeeklyAppointmentsCurrentYear = mysqli_query($con, "
SELECT
    DAYNAME(creationDate) AS day_name,
    SUM(amount) AS total_income
FROM
    appointment
WHERE
    YEAR(creationDate) = YEAR(CURRENT_DATE) AND MONTH(creationDate) BETWEEN 1 AND 12
GROUP BY
    DAYNAME(creationDate)
ORDER BY
    FIELD(DAYNAME(creationDate), 'Sunday', 'Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday','Saturday');
");
$WeeklyAppointmentsCurrentYearPoints = [];
while ($row = mysqli_fetch_assoc($WeeklyAppointmentsCurrentYear)) {
    $WeeklyAppointmentsCurrentYearPoints[] = [
        "y" => $row['total_income'],
        "label" => $row['day_name']
    ];
}


?>
<!DOCTYPE html>
<html lang="en">

<head>
    <title>Admin | Reports</title>

    <link
        href="http://fonts.googleapis.com/css?family=Lato:300,400,400italic,600,700|Raleway:300,400,500,600,700|Crete+Round:400italic"
        rel="stylesheet"
        type="text/css"
    />
    <link
        rel="stylesheet"
        href="vendor/bootstrap/css/bootstrap.min.css"
    >
    <link
        rel="stylesheet"
        href="vendor/fontawesome/css/font-awesome.min.css"
    >
    <link
        rel="stylesheet"
        href="vendor/themify-icons/themify-icons.min.css"
    >
    <link
        href="vendor/animate.css/animate.min.css"
        rel="stylesheet"
        media="screen"
    >
    <link
        href="vendor/perfect-scrollbar/perfect-scrollbar.min.css"
        rel="stylesheet"
        media="screen"
    >
    <link
        href="vendor/switchery/switchery.min.css"
        rel="stylesheet"
        media="screen"
    >
    <link
        href="vendor/bootstrap-touchspin/jquery.bootstrap-touchspin.min.css"
        rel="stylesheet"
        media="screen"
    >
    <link
        href="vendor/select2/select2.min.css"
        rel="stylesheet"
        media="screen"
    >
    <link
        href="vendor/bootstrap-datepicker/bootstrap-datepicker3.standalone.min.css"
        rel="stylesheet"
        media="screen"
    >
    <link
        href="vendor/bootstrap-timepicker/bootstrap-timepicker.min.css"
        rel="stylesheet"
        media="screen"
    >
    <link
        rel="stylesheet"
        href="assets/css/styles.css"
    >
    <link
        rel="stylesheet"
        href="assets/css/plugins.css"
    >
    <link
        rel="stylesheet"
        href="assets/css/themes/theme-1.css"
        id="skin_color"
    />

<script>
window.onload = function () {
    var chart = new CanvasJS.Chart("chartContainer", {
        animationEnabled: true,
        title:{
            text: "INCOME 2023 vs 2024"
        },
        axisX:{
            title: "Income"
        },
        axisY:{
            title: "Income for 2023",
            titleFontColor: "#4F81BC",
            lineColor: "#4F81BC",
            labelFontColor: "#4F81BC",
            tickColor: "#4F81BC"
        },
        axisY2:{
            title: "Income for 2024",
            titleFontColor: "#C0504E",
            lineColor: "#C0504E",
            labelFontColor: "#C0504E",
            tickColor: "#C0504E"
        },
        legend:{
            cursor: "pointer",
            dockInsidePlotArea: true,
            itemclick: toggleDataSeries
        },
        data: [{
            type: "line",
            name: "Yr. 2023",
            markerSize: 5,
            toolTipContent: "For the Month of {label} the income is ₱ {y}",
            showInLegend: true,
            dataPoints: <?php echo json_encode($dataPoints1, JSON_NUMERIC_CHECK); ?>
        },{
            type: "line",
            axisYType: "secondary",
            name: "Yr. 2024",
            markerSize: 5,
            toolTipContent: "For the Month of {label} the income is ₱ {y}",
            showInLegend: true,
            dataPoints: <?php echo json_encode($dataPoints2, JSON_NUMERIC_CHECK); ?>
        }]
    });
    chart.render();
    
    function toggleDataSeries(e){
        if (typeof(e.dataSeries.visible) === "undefined" || e.dataSeries.visible) {
            e.dataSeries.visible = false;
        }
        else{
            e.dataSeries.visible = true;
        }
        chart.render();
    }

    var chart = new CanvasJS.Chart("chartWeekly", {
	title: {
		text: "WEEKLY"
	},
	axisY: {
		title: "INCOME"
	},
	data: [{
		type: "line",
		dataPoints: <?php echo json_encode($WeeklyAppointmentsCurrentYearPoints, JSON_NUMERIC_CHECK); ?>
        }]
    });
    chart.render();
}
</script>
</head>

<body>
    <div id="app">
        <?php include('include/sidebar.php'); ?>
        <div class="app-content">

            <?php include('include/header.php'); ?>

            <!-- end: TOP NAVBAR -->
            <div class="main-content">
                <div
                    class="wrap-content container"
                    id="container"
                >
                    <!-- start: PAGE TITLE -->
                    <section id="page-title">
                        <div class="row">
                            <div class="col-sm-8">
                                <h1 class="mainTitle">Reports | Overview</h1>
                            </div>
                        </div>
                    </section>

                    <div class="container-fluid container-fullw bg-white">
                        <div class="row">
							<div class="col-sm-6">
								<div class="panel panel-white">
									<div class="panel-body">
										<h2 class="StepTitle">
                                            Appointment
                                        </h2>
										<h4 class="links cl-effect-1">
											<?= mysqli_num_rows($LoadAppointments) ?>
										</h4>
									</div>
								</div>                             
							</div>
							<div class="col-sm-6">
								<div class="panel panel-white">
									<div class="panel-body">
										<h2 class="StepTitle">
                                            Income
                                        </h2>
										<h4 class="links cl-effect-1">
											₱ <?= number_format($LoadAppointmentsIncome,2) ?>
										</h4>
									</div>
								</div>                             
							</div>
						</div>
                        <div class="row">
							<div class="col-sm-12">
								<div class="panel panel-white">
									<div class="panel-body">
										<div id="chartContainer" style="height: 370px; width: 100%;"></div>
									</div>
								</div>                             
							</div>
                            <div class="col-sm-12">
                                <div class="panel panel-white">
                                    <div class="panel-body">
										<div id="chartWeekly" style="height: 370px; width: 100%;"></div>
                                    </div>
                                </div>
                            </div>
						</div>
                    </div>
                </div>
            </div>
            <!-- end: BASIC EXAMPLE -->
            <!-- end: SELECT BOXES -->

        </div>
    </div>
    </div>
    <!-- start: FOOTER -->
    <?php include('include/footer.php'); ?>
    <!-- end: FOOTER -->

    <!-- start: SETTINGS -->
    <?php include('include/setting.php'); ?>

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
    <script src="https://cdn.canvasjs.com/canvasjs.min.js"></script>

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