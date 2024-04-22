<?php
session_start();
//error_reporting(0);
include('include/config.php');
include('include/checklogin.php');
include('include/calendar.php');

check_login();


$services = mysqli_query($con, "SELECT * FROM services");
$already_selected_services = isset($_SESSION["book_services_id"]) ? $_SESSION["book_services_id"] : [];
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <title>User | Book Appointment</title>

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
                                <h1 class="mainTitle">Patient | Book Appointment</h1>
                            </div>
                            <ol class="breadcrumb">
                                <li>
                                    <span>Patient</span>
                                </li>
                                <li class="active">
                                    <span>Book Appointment</span>
                                </li>
                            </ol>
                    </section>
                    <div class="container-fluid container-fullw bg-white">
                        <a class="appointment" href="#">
                        <div class="bs-stepper">
                            <!-- NAV -->
                            <div
                                class="bs-stepper-header"
                                role="tablist"
                            >
                                <div
                                    class="step"
                                    data-target="#services-part"
                                >
                                    <button
                                        type="button"
                                        class="step-trigger"
                                        role="tab"
                                        aria-controls="services-part"
                                        id="services-part-trigger"
                                    >
                                        <span class="bs-stepper-circle">1</span>
                                        <span class="bs-stepper-label">Services</span>
                                    </button>
                                </div>
                                <div class="line"></div>
                                <div
                                    class="step"
                                    data-target="#date-part"
                                >
                                    <button
                                        type="button"
                                        class="step-trigger"
                                        role="tab"
                                        aria-controls="date-part"
                                        id="date-part-trigger"
                                    >
                                        <span class="bs-stepper-circle">2</span>
                                        <span class="bs-stepper-label">Pick a Date</span>
                                    </button>
                                </div>
                                <div class="line"></div>
                                <div
                                    class="step"
                                    data-target="#recommendation-part"
                                >
                                    <button
                                        type="button"
                                        class="step-trigger"
                                        role="tab"
                                        aria-controls="recommendation-part"
                                        id="recommendation-part-trigger"
                                    >
                                        <span class="bs-stepper-circle">3</span>
                                        <span class="bs-stepper-label">Recommendation</span>
                                    </button>
                                </div>
                                <div class="line"></div>
                                <div
                                    class="step"
                                    data-target="#summary-part"
                                >
                                    <button
                                        type="button"
                                        class="step-trigger"
                                        role="tab"
                                        aria-controls="summary-part"
                                        id="summary-part-trigger"
                                    >
                                        <span class="bs-stepper-circle">4</span>
                                        <span class="bs-stepper-label">Summary</span>
                                    </button>
                                </div>
                                <div class="line"></div>
                                <div
                                    class="step"
                                    data-target="#payment-part"
                                >
                                    <button
                                        type="button"
                                        class="step-trigger"
                                        role="tab"
                                        aria-controls="payment-part"
                                        id="payment-part-trigger"
                                    >
                                        <span class="bs-stepper-circle">5</span>
                                        <span class="bs-stepper-label">Payment</span>
                                    </button>
                                </div>
                            </div>
                            <!-- END OF NAV -->
                            <!-- !!!CONTENT!!! -->
                            <div class="bs-stepper-content">
                                <div
                                    id="services-part"
                                    class="content"
                                    role="tabpanel"
                                    aria-labelledby="services-part-trigger"
                                >
                                    <fieldset class="BoxFieldsetSelectedServices">
                                        <h1>Services</h1>
                                        <p>Select the service you need:</p>
                                        <br>
                                        <div class="grid">
                                            <?php while ($row = mysqli_fetch_assoc($services)) { ?>
                                                <div class="item thumbnail">
                                                    <img src="../images/services/<?= $row["image"] ?>">
                                                    <div class="caption">
                                                        <b
                                                            class="text-primary"
                                                            style="font-size: 1.5rem"
                                                        >
                                                            <?= $row["name"] ?>
                                                        </b>
                                                        <p>
                                                            ₱
                                                            <?= number_format($row["fee"], 2) ?>
                                                        </p>
                                                        <?php if($row["requireRecommendation"] == "yes") {?>
                                                            <p class="text-danger">Require recommendations</p>
                                                        <?php } ?>

                                                        <?php if (in_array($row["id"], $already_selected_services)) { ?>
                                                            <button
                                                                class="btn btn-primary BtnToggleSelectService"
                                                                role="button"
                                                                style="width: 100%"
                                                                data-id="<?= $row["id"] ?>"
                                                                data-selected="true"
                                                                data-required-recommendation="<?= $row["requireRecommendation"] ?>"
                                                                data-name="<?= $row["name"] ?>"
                                                                data-fee="<?= $row["fee"] ?>"
                                                            >
                                                                Selected
                                                            </button>
                                                        <?php } else { ?>
                                                            <button
                                                                class="btn btn-primary BtnToggleSelectService"
                                                                role="button"
                                                                style="width: 100%"
                                                                data-id="<?= $row["id"] ?>"
                                                                data-selected="false"
                                                                data-required-recommendation="<?= $row["requireRecommendation"] ?>"
                                                                data-name="<?= $row["name"] ?>"
                                                                data-fee="<?= $row["fee"] ?>"
                                                            >
                                                                Select
                                                            </button>
                                                        <?php } ?>
                                                    </div>
                                                </div>
                                            <?php } ?>
                                        </div>
                                        <div>
                                            <button class="btn btn-primary btnSubmitServices">
                                                NEXT
                                            </button>
                                        </div>

                                    </fieldset>
                                </div>
                                <div
                                    id="date-part"
                                    class="content"
                                    role="tabpanel"
                                    aria-labelledby="date-part-trigger"
                                >
                                    <h1>Pick a Date</h1>
                                    <p>
                                        Please choose a date that suits you best. Once selected, you can proceed
                                        to pick the service you need.
                                    </p>
                                    <br>
                                    <div class="appointmentCalendar">
                                    </div>
                                    <div style="margin-top: 1rem;">
                                        <button
                                            class="btn btn-primary"
                                            onclick="stepperPrev();"
                                        >
                                            PREVIOUS
                                        </button>
                                        <button class="btn btn-primary BtnSubmitSelectedDate">
                                            NEXT
                                        </button>
                                    </div>
                                </div>
                                <div
                                    id="recommendation-part"
                                    class="content"
                                    role="tabpanel"
                                    aria-labelledby="recommendation-part-trigger"
                                >
                                    <h1>Recommendations</h1>
                                    <p>
                                        The following selected services is requiring you to submit a recommendation copy
                                        (picture) from your previous consultation/doctor.
                                    </p>
                                    <fieldset class="boxRecommendation">
                                        <form
                                            class="form"
                                            id="FrmBookAppointment"
                                        >

                                        </form>
                                        <br>
                                        <div>
                                            <button
                                                class="btn btn-danger"
                                                onclick="stepperPrev();"
                                            >
                                                PREVIOUS
                                            </button>
                                            <button class="btn btn-danger BtnSubmitRecommendation">
                                                NEXT
                                            </button>
                                        </div>
                                    </fieldset>

                                </div>
                                <div
                                    id="summary-part"
                                    class="content"
                                    role="tabpanel"
                                    aria-labelledby="summary-part-trigger"
                                >
                                    <h1>Summary</h1>
                                    <p>Check your appoinment details</p>
                                    <fieldset>
                                        <div>
                                            <strong>Appointment Date:</strong>
                                            <span id="appointment-date"></span>
                                        </div>
                                        <div>
                                            <strong>Services : </strong>
                                            <ul id="services"></ul>
                                        </div>
                                        <p>
                                            <strong>Total Amount:</strong>
                                            <span id="total-amount"></span>
                                        </p>
                                    </fieldset>
                                    <div
                                        class="card bg-warning"
                                        style="padding: 1rem"
                                    >
                                        Once you click the "NEXT" button, you will never be able to edit anything.
                                    </div>
                                    <br>
                                    <div>
                                        <button class="btn btn-primary BtnSummaryBack">
                                            PREVIOUS
                                        </button>
                                        <button class="btn btn-primary BtnSummaryNext">
                                            NEXT
                                        </button>
                                    </div>
                                </div>
                                <div
                                    id="payment-part"
                                    class="content"
                                    role="tabpanel"
                                    aria-labelledby="payment-part-trigger"
                                >
                                    <h1>Payment</h1>
                                    <hr />
                                    <fieldset>
                                        <div>
                                            <strong>Appointment Date:</strong>
                                            <span id="payment-appointment-date"></span>
                                        </div>
                                        <div>
                                            <strong>Services : </strong>
                                            <ul id="payment-services"></ul>
                                        </div>
                                        <p>
                                            <strong>Total Amount:</strong>
                                            <span id="payment-total-amount"></span>
                                        </p>
                                    </fieldset>
                                    <p>
                                        Payment Method:
                                    </p>
                                    <fieldset>
                                        <div class="BoxPaymentMethods">
                                            <button
                                                class="btn btn-primary BtnPayment"
                                                data-payment-method="gcash"
                                                data-payment-method-label="GCASH"
                                                data-payment-gateway="paymongo"
                                            >
                                                GCASH
                                            </button>

                                            <button
                                                class="btn btn-primary BtnPayment"
                                                data-payment-method="grab_pay"
                                                data-payment-method-label="GRAB PAY"
                                                data-payment-gateway="paymongo"
                                            >
                                                GRAB PAY
                                            </button>
                                        </div>
                                        <div
                                            class="BoxPaymentProcessing"
                                            style="display:none"
                                        >
                                            Please wait you will redirect to payment page shortly.
                                        </div>
                                    </fieldset>
                                </div>
                            </div>
                            <!-- END OF CONTENT -->
                        </div>
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
    </script>
    <script type="text/javascript">
        $('#timepicker1').timepicker();
    </script>
    <script src="./js/appointment.js"></script>
    <!-- end: JavaScript Event Handlers for this page -->
    <!-- end: CLIP-TWO JAVASCRIPTS -->


</body>

</html>     