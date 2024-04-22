$("#FrmAddService").on("submit", (e) => {
    e.preventDefault();
    var formData = new FormData($("#FrmAddService")[0]);
    formData.append("action", "create");
    $.ajax({
        type: "POST",
        url: "./ajax/service.php",
        data: formData,
        processData: false,
        contentType: false,
        success: function (response) {
            console.log(response);
            var data = JSON.parse(response);
            if (data.success) {
                swal("Good job!", "Successfully saved!", "success");

                setTimeout(() => {
                    window.location.href = "./services.php";
                }, 1000);
            } else {
                swal("Failed", data.message, "error");
            }
        },
    });
});
$(".BtnDeleteService").each((index, btn) => {
    var serviceId = $(btn).attr("data-id");

    $(btn).on("click", (e) => {
        e.preventDefault();

        swal({
            title: "Are you sure?",
            text: "Do you want to remove this service?",
            icon: "info",
            buttons: true,
            dangerMode: true,
        }).then((willDelete) => {
            if (willDelete) {
                $.ajax({
                    type: "POST",
                    url: "./ajax/service.php",
                    data: {
                        id: serviceId,
                        action: "delete",
                    },
                    success: function (response) {
                        console.log(response);
                        var data = JSON.parse(response);
                        if (data.success) {
                            swal("Good job!", "Successfully deleted the service", "success");
                            setTimeout(() => {
                                window.location.href = "./services.php";
                            }, 1000);
                        } else {
                            swal("Failed", data.message, "error");
                        }
                    },
                });
            }
        });
    });
});

$("#FrmUpdateServiceGeneral").on("submit", (e) => {
    e.preventDefault();
    var formData = new FormData($("#FrmUpdateServiceGeneral")[0]);
    formData.append("action", "update_general");
    $.ajax({
        type: "POST",
        url: "./ajax/service.php",
        data: formData,
        processData: false,
        contentType: false,
        success: function (response) {
            console.log(response);
            var data = JSON.parse(response);
            if (data.success) {
                swal("Good job!", "Successfully saved!", "success");

                setTimeout(() => {
                    window.location.href = "./services.php";
                }, 1000);
            } else {
                swal("Failed", data.message, "error");
            }
        },
    });
});

$("#FrmUpdateServiceImage").on("submit", (e) => {
    e.preventDefault();
    var formData = new FormData($("#FrmUpdateServiceImage")[0]);
    formData.append("action", "update_image");

    $.ajax({
        type: "POST",
        url: "./ajax/service.php",
        data: formData,
        processData: false,
        contentType: false,
        success: function (response) {
            console.log(response);
            var data = JSON.parse(response);
            if (data.success) {
                swal("Good job!", "Successfully saved!", "success");

                setTimeout(() => {
                    window.location.href = "./services.php";
                }, 1000);
            } else {
                swal("Failed", data.message, "error");
            }
        },
    });
});
