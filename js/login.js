$(".FrmLogin").on("submit", function (e) {
    e.preventDefault();
    var form = e.target;

    var FormData = $(form).serializeArray();
    $(".FrmBoxError").addClass("d-none");
    $(".FrmBoxLoad").removeClass("d-none").addClass("d-flex");
    $(".FrmLogin fieldset").prop("disabled", true);

    setTimeout(() => {
        $.ajax({
            type: "POST",
            url: "./php/login.php",
            data: FormData,
            success: function (data) {
                console.log(data);
                var response = JSON.parse(data);
                if (response.success) {
                } else {
                    $(".FrmLogin fieldset").removeProp("disabled");
                    $(".FrmBoxLoad").removeClass("d-flex").addClass("d-none");
                    $(".FrmBoxError").removeClass("d-none").text(`${response.message}`);
                }
            },
        });
    }, 1000);
});

$(".BtnCloseModal").on("click", function (e) {
    e.preventDefault();
    $(".FrmBoxError").addClass("d-none");
    $(".FrmBoxLoad").removeClass("d-flex").addClass("d-none");

    $(".FrmLogin input").each((idx, input) => {
        $(input).val("");
    });
});

$(".btnBookAppointment").on("click", function (e) {
    var service_id = $(e.target).attr("data-id");
    $(".FrmLogin input[name='service_id']").val(service_id);
});
