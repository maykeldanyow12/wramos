<?php
session_start();
error_reporting(0);
include('include/config.php');
include('include/checklogin.php');
check_login();


if (!isset($_GET["track_id"])) {
    navigate("./appointment-history.php");
}
$appointment_id = $_GET["track_id"];
$appointment_id = mysqli_escape_string($con,$appointment_id);
$LoadAppointment = mysqli_query($con, "
    SELECT 
        users.fullName,
        users.address,
        users.gender,
        appointment.*
    FROM
    `appointment`
    INNER JOIN users ON users.id = appointment.userId
    WHERE
    appointment.payment_id = '$appointment_id'
");
if (mysqli_num_rows($LoadAppointment) < 1) {
    navigate("./appointment-history.php");
}
$appointment = mysqli_fetch_array($LoadAppointment);
$selectedServices = explode(',', $appointment['services_id']);
$selectedServiceRecommendation = json_decode($appointment['service_recommendation'],true);
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <title>Patient | Appointment Details</title>

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
</head>

<body>
    <div id="app">
        <?php include('include/sidebar.php'); ?>
        <div class="
        app-content">


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
                                <h1 class="mainTitle">Patient | Appointment Details</h1>
                            </div>
                        </div>
                    </section>
                    <!-- end: PAGE TITLE -->
                    <!-- start: BASIC EXAMPLE -->
                    <div class="container-fluid container-fullw bg-white">
                        <fieldset>
                            <legend>Patient Details</legend>
                            <div>
                                <strong>Name : </strong>
                                <span>
                                    <?= $appointment['fullName'] ?>
                                </span>
                            </div>
                            <br>
                            <div>
                                <strong>Address : </strong>
                                <span>
                                    <?= $appointment['address'] ?>
                                </span>
                            </div>
                            <br>
                            <div>
                                <strong>Gender : </strong>
                                <span>
                                    <?= strtoupper($appointment['gender']) ?>
                                </span>
                            </div>
                        </fieldset>
                        <fieldset>
                            <legend>
                                Appointment Details
                            </legend>
                            <div>
                                <strong>
                                    Services :
                                </strong>
                                <ul>
                                    <?php foreach ($selectedServices as $service) { ?>
                                        <?php
                                        $serviceInfo = mysqli_query($con, "SELECT * FROM services WHERE id = $service");
                                        $serviceInfo = mysqli_fetch_array($serviceInfo);
                                        ?>
                                        <li>
                                            <?= $serviceInfo["name"] ?>
                                            -
                                            ₱
                                            <?= number_format($serviceInfo["fee"], 2) ?>

                                            <?php if ($serviceInfo["requireRecommendation"] == "yes") { ?>
                                                <span style="color: red;">(Requires Doctor's Recommendation)</span>
                                            <?php } ?>
                                        </li>
                                    <?php } ?>
                                </ul>
                            </div>
                            <div>
                                <strong>Appointment Date :</strong>
                                <?= formatdate($appointment['appointmentDate'], "M d, Y") ?>
                            </div>
                            <br>
                            <div>
                                <strong>Date of Creation:</strong>
                                <?= formatdate($appointment['creationDate']) ?>
                            </div>
                        </fieldset>
                        <?php if (count($selectedServiceRecommendation) > 0) { ?>
                            <fieldset>
                                <legend>
                                    Previous Consulation/Doctor's Recommendation:'
                                </legend>
                                <div>
                                    <?php foreach ($selectedServiceRecommendation as $service) { ?>
                                        <hr>
                                        <div>
                                            <?php
                                            $serviceInfo = mysqli_query($con, "SELECT * FROM services WHERE id = {$service["service_id"]}");
                                            $serviceInfo = mysqli_fetch_array($serviceInfo);
                                            ?>
                                                <h4>
                                                    Recommendation for <b><?= $serviceInfo["name"] ?></b>
                                                </h4>
                                                <img src="../../images/recommendation/<?= $service["path"] ?>" alt="">
                                        </div>
                                        <br>
                                    <?php } ?>
                                </div>
                            </fieldset>
                        <?php } ?>
                        <fieldset>
                            <legend>
                                Payment Details
                            </legend>
                            <div>
                                <strong>
                                    Payment Status :
                                </strong>
                                <span>
                                    <?= strtoupper($appointment["payment_status"]) ?>
                                </span>
                            </div>
                            <br>
                            <div>
                                <strong>Payment Method : </strong>
                                <span>
                                    <?= strtoupper(str_replace("_", " ", $appointment["payment_method"])) ?>
                                </span>
                            </div>
                            <br>
                            <div>
                                <strong>Amount : </strong>
                                <span>
                                    ₱
                                    <?= number_format($appointment["amount"], 2) ?>
                                </span>
                            </div>
                        </fieldset>
                    </div>
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