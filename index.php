<?php include "./configurations/include.php" ?>
<!DOCTYPE HTML>
<html>

<head>
    <?php include "./partials/head.php"; ?>

    <?php
    $services = $db->query("SELECT * FROM services");
    ?>
</head>

<body>

    <!--start-header-->
    <?php include "./partials/header.php"; ?>
    <!--start-image-slider---->
    <div class="image-slider">
        <!-- Slideshow 1 -->
        <ul
            class="rslides"
            id="home"
        >
            <li><img
                    src="images/img1.jpg"
                    alt=""
                ></li>
            <li><img
                    src="images/img2.jpg"
                    alt=""
                ></li>
            <li><img
                    src="images/img1.jpg"
                    alt=""
                ></li>
        </ul>
        <!-- Slideshow 2 -->
    </div>
    <!--End-image-slider---->
    <div class="container-fluid bg-danger p-3">
        <div class="container">
            <h1 class="display-1 fw-bold text-white">3 EASY STEPS</h1>
            <h2 class=" text-white">Select Services, Set an Appointment & Action</h2>
            <div
                class="mt-5 d-flex"
                style="gap: 1rem;"
            >
                <a
                    href="#services"
                    class="btn btn btn-warning"
                >GET STARTED</a>
                <a
                    href=""
                    class="btn text-white border rounded"
                >LEARN MORE</a>
            </div>
        </div>
    </div>


    <div
        class="anchor"
        id="services"
    ></div>
    <div class="py-5 text-center container">
        <div class="row ">
            <div class="col-lg-6 col-md-8 mx-auto">
                <h1 class="fw-bold">SERVICES</h1>
                <p class="lead text-body-secondary">Something short and leading about the collection below—its contents,
                    the creator, etc. Make it short and sweet, but not too short so folks dont simply skip over it
                    entirely.</p>
            </div>
        </div>
    </div>
        <div class="py-5 bg-body-tertiary">
        <div class="container">
            <div class="row mb-2">
                <?php while ($row = $services->fetch_assoc()) { ?>
                    <div class="col-md-6">
                        <div
                            class="row g-0 border rounded overflow-hidden flex-md-row mb-4 shadow-sm h-md-250 position-relative bg-white">
                            <div class="col-auto d-none d-sm-block">
                                <img
                                    src="./images/services/<?= $row["image"] ?>"
                                    alt=""
                                    width="auto"
                                    height="100%"
                                    style="height: 300px"
                                >
                            </div>
                            <div class="col p-4 d-flex flex-column position-static">
                                <h3 class="mb-0"><?= $row["name"] ?></h3>
                                <div class="mb-1 text-body-secondary">₱<?= number_format($row["fee"], 2) ?></div>
                                <p class="card-text mt-1 mb-auto">
                                    This is a wider card with supporting text below as a natural
                                    lead-in to additional content.
                                </p>
                                <button
                                    class="btnBookAppointment btn btn-danger mt-3"
                                    data-bs-toggle="modal"
                                    data-bs-target="#exampleModal"
                                    data-id="<?= $row["id"] ?>"
                                >
                                    BOOK
                                </button>
                            </div>

                        </div>
                    </div>
                <?php } ?>
            </div>
        </div>
    </div>
    
    <div
        class="anchor"
        id="contactus"
    ></div>

    <div class="py-5 text-center container">
        <div class="row ">
            <div class="col-lg-6 col-md-8 mx-auto">
                <h1 class="fw-bold">CONTACT US</h1>
                <p class="lead text-body-secondary">Something short and leading about the collection below—its contents,
                    the creator, etc. Make it short and sweet, but not too short so folks dont simply skip over it
                    entirely.</p>
            </div>
        </div>
    </div>
    <div class="py-5 bg-body-tertiary">
        <div class="container">

            <form>
                <div class="mb-3">
                    <label
                        for="tbName"
                        class="form-label"
                    >Name</label>
                    <input
                        type="text"
                        class="form-control"
                        id="tbName"
                        name="tbName"
                        placeholder="eg: John Doe"
                    >
                </div>
                <div class="mb-3">
                    <label
                        for="tbEmail"
                        class="form-label"
                    >Email address</label>
                    <input
                        type="text"
                        class="form-control"
                        id="tbEmail"
                        name="email"
                        placeholder="eg: johndoe@domain.com"
                    >
                </div>
                <div class="mb-3">
                    <label
                        for="tbMobile"
                        class="form-label"
                    >Mobile No.</label>
                    <input
                        type="phone"
                        class="form-control"
                        id="tbMobile"
                        name="mnum"
                        placeholder="eg: (+63) 932-539-7973"
                    >
                </div>
                <div class="mb-3">
                    <label
                        for="tbDescription"
                        class="form-label"
                    >Description</label>
                    <textarea
                        class="form-control"
                        id="tbDescription"
                        name="description"
                        placeholder="Short description"
                    ></textarea>
                </div>
                <button
                    type="submit"
                    class="btn btn-danger w-100"
                >Submit</button>
            </form>
        </div>
    </div>

    
    <div class="footer">
        <div class="container">
            <div class="row">
                <div class="col">
                    <div class="fw-bold fs-4">Get in Touch</div>
                    <p>Lot 194 G. Lazaro St. Dalandanan, Valenzuela City</p>
                    <p>Phone:(+63) 932-539-7973</p>
                    <p>Office Hour: Monday to Saturday</p>
                    <p>8:00 AM to 4:30PM</p>
                    <p>Email: <span>wramosdiagnosticlaboratory@gmail.com</span></p>
                </div>
                <div class="col">
                    <div class="fw-bold">Copyright &copy; 2014, All rights reserved.</div>

                </div>
            </div>

        </div>
    </div>


    <div
        class="modal fade"
        id="exampleModal"
        tabindex="-1"
        aria-labelledby="exampleModalLabel"
        aria-hidden="true"
    >
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header bg-danger text-white">
                    <h1
                        class="modal-title fs-5"
                        id="exampleModalLabel"
                    >Login to Your Account</h1>
                    <button
                        type="button"
                        class="btn-close BtnCloseModal"
                        data-bs-dismiss="modal"
                        aria-label="Close"
                    ></button>
                </div>
                <div class="modal-body">
                    <div
                        class="FrmBoxError alert alert-danger d-none"
                        role="alert"
                    >
                        Invalid username or password. Please try again.
                    </div>
                    <div class="FrmBoxLoad d-none direction-column justify-content-center">
                        <div
                            class="spinner-border text-primary"
                            role="status"
                        >
                            <span class="visually-hidden">Loading...</span>

                        </div>
                    </div>
                    <form class="form FrmLogin" method="post">
                        <input
                            type="hidden"
                            name="service_id"
                            class="service_id"
                        >
                        <fieldset>
                            <div class="form-group mb-3">
                                <label class="form-label">
                                    Email
                                </label>
                                <input
                                    type="text"
                                    class="form-control readonly"
                                    placeholder="Email"
                                    aria-label="Email"
                                    name="email"
                                >
                            </div>
                            <div class="form-group mb-3">
                                <label class="form-label">
                                    Password
                                </label>
                                <input
                                    type="password"
                                    class="form-control"
                                    placeholder="Password"
                                    aria-label="Password"
                                    name="password"
                                >
                            </div>
                            <button
                                type="submit"
                                name="submit1"
                                class="btn btn-danger w-100"
                            >
                            <a href="./user/book-appointment.php">Login</a>
                            </button>
                        </fieldset>
                    </form>
                </div>
                <div class="modal-footer">
                    <p>
                        Don't have account?
                        <a href="./user/registration.php">Register Here</a>
                    </p>
                </div>
            </div>
        </div>
    </div>
</body>

</html>