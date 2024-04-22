<?php
session_start();
//error_reporting(0);
include('include/config.php');
include('include/checklogin.php');
include('include/calendar.php');

include "../vendor/autoload.php";

$pusher = new Pusher\Pusher(
    '5a00f0d723077865b510',
    '811a187e0c5b97c0dfae',
    '1748724',
    $options = array(
        'cluster' => 'eu',
        'useTLS' => true
    )
);

$paymongo = new Paymongo();

check_login();

if (!isset($_GET["id"])) {
    navigate("./book-appointment.php");
}
$trackid = $_GET['id'];
$query = mysqli_query($con, "SELECT * FROM appointment WHERE payment_id = '$trackid'");
if (mysqli_num_rows($query) < 1) {
    navigate("./book-appointment.php");
}
$appointment = mysqli_fetch_array($query);

$payment_status = $appointment['payment_status'];
$selectedServices = explode(',', $appointment['services_id']);
$PaymentRef = $appointment["payment_ref"];

if ($appointment["payment_gateway"] == "paymongo") {
    $paymentPaymongoStatus = $paymongo
        ->setApiKey("c2tfdGVzdF9KOWR5R1F6cUNKeWlSN0xLREJzYXZtdm46cGtfdGVzdF9LNGdTZGZmd1ZTYjdTem9WWGpaVFh4Q3U=")
        ->loadResource($PaymentRef)
        ->getAttributes();
    if ($paymentPaymongoStatus["status"] == "chargeable") {
        $query = mysqli_query($con, "UPDATE appointment SET payment_status = 'success' WHERE payment_id = '$trackid'");
        $payment_status = "SUCCESS";
    } elseif ($paymentPaymongoStatus["status"] == "cancelled") {
        $query = mysqli_query($con, "UPDATE appointment SET payment_status = 'cancelled' WHERE payment_id = '$trackid'");
        $payment_status = "CANCELLED";
    } else {
        $payment_status = "PENDING";
    }
}
$title = "Appointment";
$description = "New appointment created";
$button_more_details_url = "appointment-details.php?track_id=" . $trackid;
mysqli_query($con,"INSERT INTO notifications (title, description, button_more_details_url) VALUES ('$title', '$description', '$button_more_details_url')");

$pusher->trigger('notification_channel', 'notification_event', []);
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <title>Patient | Payment Handle</title>

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
        href="assets/css/grid.css"
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
    <link
        rel="stylesheet"
        href="https://cdn.jsdelivr.net/npm/bs-stepper/dist/css/bs-stepper.min.css"
    >


    <script>
        function getdoctor(val) {
            $.ajax({
                type: "POST",
                url: "get_doctor.php",
                data: 'specilizationid=' + val,
                success: function (data) {
                    $("#doctor").html(data);
                }
            });
        }
    </script>


    <script>
        function getfee(val) {
            $.ajax({
                type: "POST",
                url: "get_doctor.php",
                data: 'doctor=' + val,
                success: function (data) {
                    $("#fees").html(data);
                }
            });
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
                                <h1 class="mainTitle">
                                    Patient | Payment Details
                                </h1>
                            </div>
                        </div>
                    </section>
                    <div class="container-fluid container-fullw bg-white">
                        <h1>
                            PAYMENT REFERENCE #
                            <b><?= $trackid ?></b>
                        </h1>
                        <h4>
                            Keep the reference number to proof that you are paying!
                        </h4>
                        <fieldset>
                        <h4>
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
                                            = ₱<?= number_format($serviceInfo["fee"], 2) ?>
                                        </li>
                                    <?php } ?>
                                </ul>
                            </div>
                            <div>
                                <strong>
                                    Payment Method :
                                </strong>
                                <span>
                                    <?= strtoupper(str_replace("_", " ", $appointment["payment_method"])) ?>
                                </span>
                            </div>
                            <br>
                            <div>
                                <strong>
                                    Amount :
                                </strong>
                                <span>
                                    ₱<?= number_format($appointment["amount"], 2) ?>
                                </span>
                            </div>
                            <br>
                            <div>
                                <strong>
                                    Payment Status
                                </strong>
                                <span>
                                    <?= $payment_status ?>
                                </span>
                            </div>
                        </h4>
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
    <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.8.0/jquery.min.js"></script>

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
    <script src="vendor/fullcalendar/index.global.js"></script>
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bs-stepper/dist/js/bs-stepper.min.js"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/jasny-bootstrap/4.0.0/js/jasny-bootstrap.min.js"></script>

    <!-- end: JAVASCRIPTS REQUIRED FOR THIS PAGE ONLY -->
    <!-- start: CLIP-TWO JAVASCRIPTS -->
    <script src="assets/js/main.js"></script>
    <!-- start: JavaScript Event Handlers for this page -->
    <script src="assets/js/form-elements.js"></script>
    <script>
        jQuery(document).ready(
            function () {
                Main.init();
                FormElements.init();
                $('.fileinput').fileinput()
            });

        $('.datepicker').datepicker({
            format: 'yyyy-mm-dd',
            startDate: '-3d'
        });
    </script>
    <script type="text/javascript">
        $('#timepicker1').timepicker();
    </script>
    <script src="./js/appointment.js"></script>
    <!-- end: JavaScript Event Handlers for this page -->
    <!-- end: CLIP-TWO JAVASCRIPTS -->


</body>

</html>