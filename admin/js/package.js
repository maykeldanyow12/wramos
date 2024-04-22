$("#FrmAddPackage").on("submit", (e) => {
    e.preventDefault();
    var formData = new FormData($("#FrmAddPackage")[0]);
    formData.append("action", "create");
    $.ajax({
        type: "POST",
        url: "./ajax/package.php",
        data: formData,
        processData: false,
        contentType: false,
        success: function (response) {
            console.log(response);
            var data = JSON.parse(response);
            if (data.success) {
                swal("Good job!", "Successfully saved!", "success");

                setTimeout(() => {
                    window.location.href = "./packages-services.php";
                }, 1000);
            } else {
                swal("Failed", data.message, "error");
            }
        },
    });
});
$("#FrmUpdatePackage").on("submit", (e) => {
    e.preventDefault();
    var formData = new FormData($("#FrmUpdatePackage")[0]);
    formData.append("action", "update");
    $.ajax({
        type: "POST",
        url: "./ajax/package.php",
        data: formData,
        processData: false,
        contentType: false,
        success: function (response) {
            console.log(response);
            var data = JSON.parse(response);
            if (data.success) {
                swal("Good job!", "Successfully saved!", "success");

                setTimeout(() => {
                    window.location.href = "./packages-services.php";
                }, 1000);
            } else {
                swal("Failed", data.message, "error");
            }
        },
    });
});
$(".BtnDelete").each((index, button) => {
    $(button).on("click", (e) => {
        e.preventDefault();
        var id = $(button).attr("data-id");
        swal({
            title: "Are you sure?",
            text: "Once deleted, you will not be able to recover this package!",
            icon: "warning",
            buttons: true,
            dangerMode: true,
        }).then((willDelete) => {
            if (willDelete) {
                $.ajax({
                    type: "POST",
                    url: "./ajax/package.php",
                    data: {
                        id: id,
                        action: "delete",
                    },
                    success: function (response) {
                        console.log(response);
                        var data = JSON.parse(response);
                        if (data.success) {
                            swal("Good job!", "Successfully deleted!", "success");

                            setTimeout(() => {
                                window.location.href = "./packages-services.php";
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
