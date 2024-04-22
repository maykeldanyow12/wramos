<?php
session_start();
error_reporting(0);
include('include/config.php');
include('include/checklogin.php');
check_login();


?>
<!DOCTYPE html>
<html lang="en">

<head>
    <title>Admin | Add Service</title>
    <link
        rel="stylesheet"
        href="//cdnjs.cloudflare.com/ajax/libs/jasny-bootstrap/4.0.0/css/jasny-bootstrap.min.css"
    >

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
        href="vendor/sweetalert/sweet-alert.css"
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

    <script type="text/javascript">
        function valid() {
            if (document.adddoc.npass.value != document.adddoc.cfpass.value) {
                alert("Password and Confirm Password Field do not match  !!");
                document.adddoc.cfpass.focus();
                return false;
            }
            return true;
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
                                <h1 class="mainTitle">Admin | Service | New Service</h1>
                            </div>
                            <ol class="breadcrumb">
                                <li>
                                    <span>Admin</span>
                                </li>
                                <li>
                                    <span>Service</span>
                                </li>
                                <li class="active">
                                    <span>New Service</span>
                                </li>
                            </ol>
                        </div>
                    </section>
                    <!-- end: PAGE TITLE -->
                    <!-- start: BASIC EXAMPLE -->
                    <div class="container-fluid container-fullw bg-white">
                        <a
                            href="services.php"
                            class="btn btn-primary"
                        >
                            <i class="ti-angle-left"></i>
                            BACK
                        </a>
                        <br><br>
                        <form
                            role="form"
                            id="FrmAddService"
                            method="post"
                            enctype="multipart/form-data"
                        >
                            <div class="form-group">
                                <label for="name">
                                    <b>
                                        Name
                                    </b>
                                </label>
                                <input
                                    type="text"
                                    id="name"
                                    name="name"
                                    class="form-control"
                                    placeholder="Enter Service Name"
                                >
                            </div>

                            <label for="Image"><b>Image</b></label>
                            <div
                                class="fileinput fileinput-new"
                                data-provides="fileinput"
                                data-max-size="3"
                            >
                                <div
                                    class="fileinput-preview img-thumbnail"
                                    data-trigger="fileinput"
                                    style="width: 200px; height: 150px;"
                                ></div>
                                <div>
                                    <span class="btn btn btn-primary btn-file">
                                        <span class="fileinput-new ">Select image</span>
                                        <span class="fileinput-exists">Change</span>
                                        <input
                                            type="file"
                                            name="image"
                                        >
                                    </span>
                                    <a
                                        href="#"
                                        class="btn btn-outline-secondary fileinput-exists"
                                        data-dismiss="fileinput"
                                    >Remove</a>
                                </div>
                            </div>


                            <div class="form-group">
                                <label for="address">
                                    <b>Description</b>
                                </label>
                                <textarea
                                    name="description"
                                    class="form-control"
                                    placeholder="Enter service description"
                                ></textarea>
                            </div>
                            <div class="form-group">
                                <label for="fess">
                                    <b>Fee</b>
                                </label>
                                <input
                                    type="number"
                                    id="fee"
                                    name="fee"
                                    class="form-control"
                                    placeholder="Enter service fee"
                                >
                            </div>

                            <div class="form-group">
                                <label for="fess">
                                    <b>No. of Available Servation Per Day</b>
                                </label>
                                <input
                                    type="number"
                                    name="availablePerDay"
                                    class="form-control"
                                    placeholder="No. of Available Servation Per Day"
                                >
                            </div>

                            <div class="form-group" style="display:none">
                                <label for="availableDay">Available Every:</label> <br>
                                <div
                                    class="btn-group btn-group-justified"
                                    data-toggle="buttons"
                                >
                                    <label class="btn btn-default">
                                        <input
                                            type="checkbox"
                                            name="availableDay[]"
                                            value="Sunday"
                                            checked
                                        >
                                        Sunday
                                        </input>
                                    </label>

                                    <label class="btn btn-default">
                                        <input
                                            type="checkbox"
                                            name="availableDay[]"
                                            value="Monday"
                                            checked
                                        >
                                        Monday
                                        </input>
                                    </label>

                                    <label class="btn btn-default">
                                        <input
                                            type="checkbox"
                                            name="availableDay[]"
                                            value="Tuesday"
                                            checked
                                        >
                                        Tuesday
                                        </input>
                                    </label>

                                    <label class="btn btn-default">
                                        <input
                                            type="checkbox"
                                            name="availableDay[]"
                                            value="Wednesday"
                                            checked
                                        >
                                        Wednesday
                                        </input>
                                    </label>

                                    <label class="btn btn-default">
                                        <input
                                            type="checkbox"
                                            name="availableDay[]"
                                            value="Thursday"
                                            checked
                                        >
                                        Thursday
                                        </input>
                                    </label>

                                    <label class="btn btn-default">
                                        <input
                                            type="checkbox"
                                            name="availableDay[]"
                                            value="Friday"
                                            checked
                                        >
                                        Friday
                                        </input>
                                    </label>

                                    <label class="btn btn-default">
                                        <input
                                            type="checkbox"
                                            name="availableDay[]"
                                            value="Saturday"
                                            checked
                                        >
                                        Saturday
                                        </input>
                                    </label>
                                </div>
                            </div>

                            <div class="form-group">
                                <p><b>Require Recommendation (Optional)</b></p>
                                <input type="checkbox" name="requireRecommendation" id="requireRecommendation">
                                <label  for="requireRecommendation">Require the patients to submit a recommendation (in image format) from their previous consulation or doctor.</label>
                            </div>

                            <div
                                class="btn-group btn-group-justified"
                                role="group"
                                aria-label="..."
                            >
                                <div
                                    class="btn-group"
                                    role="group"
                                >
                                    <button
                                        type="submit"
                                        name="submit"
                                        id="submit"
                                        class="btn btn-primary"
                                    >
                                        Save
                                    </button>
                                </div>
                            </div>

                        </form>
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
    <script src="vendor/sweetalert/sweet-alert.min.js"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/jasny-bootstrap/4.0.0/js/jasny-bootstrap.min.js"></script>
    <!-- end: JAVASCRIPTS REQUIRED FOR THIS PAGE ONLY -->
    <!-- start: CLIP-TWO JAVASCRIPTS -->
    <script src="assets/js/main.js"></script>
    <!-- start: JavaScript Event Handlers for this page -->
    <script src="assets/js/form-elements.js"></script>
    <script>
        jQuery(document).ready(function () {
            Main.init();
            FormElements.init();

            $('.fileinput').fileinput()
        });
    </script>

    <script
        src="./js/service.js"
        defer
    ></script>
    <!-- end: JavaScript Event Handlers for this page -->
    <!-- end: CLIP-TWO JAVASCRIPTS -->
</body>

</html>