var stepper = null;
var hasRequiredRecommendation = false;
var selectedDate = null;
var today = new Date();
var selectedServices = null;
var allEvents = [];
var allowedExtensions = ["jpeg", "gif", "png", "jpg", "bmp"];

var calendarElement = document.querySelector(".appointmentCalendar");
var calendar = new FullCalendar.Calendar(calendarElement, {
    initialView: "dayGridMonth",
    selectable: true,
    validRange: {
        start: new Date(today.getTime() + 3 * 24 * 60 * 60 * 1000),
        end: "2050-01-01", // current date
    },
    eventClick: (info) => {
        info.jsEvent.preventDefault();
    },
    select: (start, end, allDay) => {
        selectedDate = start.startStr;
        $("#appointment-date").text(selectedDate);
    },
    dateClick: (info) => {
        var dateClick = info.dateStr;
    },
  /*   dayCellContent: function (arg) {
        var button = document.createElement("button");
        button.textContent = "More";
        button.className = "date-button";

        button.addEventListener("click", function () {
            var dateObj = new Date(arg.date);

            var year = dateObj.getFullYear();
            var month = ("0" + (dateObj.getMonth() + 1)).slice(-2); // Adding 1 to month since it is zero-indexed
            var day = ("0" + dateObj.getDate()).slice(-2);

            var formattedDate = year + "-" + month + "-" + day;


            var filteredEvents = allEvents.filter(function (event) {
                return event.start === formattedDate;
            });
                console.log(filteredEvents);

        });

        var wrapper = document.createElement("div");
        wrapper.appendChild(button);

        return { domNodes: [wrapper] };
    } */
});

setInterval(() => {
    calendar.render();
}, 500);

const stepperNext = () => {
    stepper.next();
};
const stepperPrev = () => {
    stepper.previous();
};
const ViewSummary = () => {
    $("#appointment-date").text(selectedDate);
    $("#payment-appointment-date").text(selectedDate);

    var selectedServicesHtml = "";
    var selectedServicesAmount = 0;
    $("#services").empty();
    $("#payment-services").empty();
    selectedServices.forEach((service, idx) => {
        selectedServicesHtml += `<li>${service.name} - ₱ ${service.fee}</li>`;
        selectedServicesAmount = selectedServicesAmount + Number(service.fee);
    });
    $("#services").append(selectedServicesHtml);
    $("#total-amount").html(`₱ ${selectedServicesAmount.toFixed(2)}`);
    $("#payment-services").append(selectedServicesHtml);
    $("#payment-total-amount").html(`₱ ${selectedServicesAmount.toFixed(2)}`);
};

stepper = new Stepper(document.querySelector(".bs-stepper"), {
    animation: true,
});

$(".BtnToggleSelectService").each((idx, button) => {
    $(button).on("click", () => {
        $(button).text("Processing");
        $(".BoxFieldsetSelectedServices").prop("disabled", true);
        var service_id = $(button).attr("data-id");
        var isSelected = $(button).attr("data-selected");

        setTimeout(() => {
            $.ajax({
                type: "POST",
                url: "./ajax/appointment.php",
                data: {
                    id: service_id,
                    action: "toggleSelectService",
                    isSelected: isSelected,
                },
                success: function (data) {
                    $(".BoxFieldsetSelectedServices").removeProp("disabled");
                    if (isSelected == "true") {
                        $(button)
                            .removeClass("btn-success")
                            .addClass("btn-primary")
                            .attr("data-selected", "false")
                            .text("Select");
                    } else {
                        $(button)
                            .removeClass("btn-primary")
                            .addClass("btn-success")
                            .attr("data-selected", "true")
                            .text("Selected");
                    }
                },
            });
        }, 1000);
    });
});

$(".btnSubmitServices").on("click", function () {
    selectedServices = [];
    calendar.removeAllEvents();

    $(".BtnToggleSelectService").each((idx, button) => {
        if ($(button).attr("data-selected") == "true") {
            selectedServices.push({
                id: $(button).attr("data-id"),
                requiredRecommendation: $(button).attr("data-required-recommendation"),
                name: $(button).attr("data-name"),
                fee: $(button).attr("data-fee"),
            });
        }
    });

    if (selectedServices.length < 1) {
        swal({
            title: "ERROR",
            text: "Please choose at least one service before proceeding.",
            icon: "error",
        });
    }

    $.ajax({
        type: "POST",
        url: "./ajax/calendar.php",
        data: {
            action: "submitServices",
            selectedServices: selectedServices,
        },
        success: function (data) {
            allEvents = data;
            console.log(data);
            var NewDates = data;
            if (selectedServices.length == 0) {
                console.log("empty");
                swal({
                    title: "ERROR",
                    text: "Please choose at least one service before proceeding.",
                    icon: "error",
                });
                return;
            } else {
                hasRequiredRecommendation = selectedServices.some((service) => {
                    return service.requiredRecommendation === "yes";
                });
            }
            NewDates.forEach((date) => {
                calendar.addEvent(date);
            });

            stepperNext();
        },
    });
});

$(".BtnSubmitSelectedDate").on("click", function () {
    if (selectedDate == null) {
        swal({
            title: "ERROR",
            text: "Please choose a date before proceeding.",
            icon: "error",
        });
        return;
    }
    var SelectedDateInfo = allEvents.find((event) => {
        return event.start === selectedDate && event.available_slots === 0;
    });

    if ((SelectedDateInfo || false) != false) {
        swal({
            title: "",
            text: `No available slots found for ${SelectedDateInfo.name} on ${SelectedDateInfo.date}. Please choose a different date.`,
            icon: "error",
        });
        return;
    }


    ViewSummary();
    if (hasRequiredRecommendation) {
        $("#FrmBookAppointment").empty();
        selectedServices.forEach((service) => {
            console.log(service);
            if (service.requiredRecommendation == "yes") {
                $("#FrmBookAppointment").append(`
                    <fieldset>
                        <h3>
                            <strong>${service.name}</strong>
                        </h3>
                        <input
                            type="file"
                            name="service_name_${service.id}"
                            id="service_id_${service.id}"
                            data-id="${service.id}"
                            data-name="${service.name}"
                        >
                        <br>
                        <p class="service-${service.id}-error-message" style="color:red"></p>
                    </fieldset>
                `);
            }
        });

        stepperNext();
    } else {
        stepper.to(4);
    }
});

$(".BtnSubmitRecommendation").on("click", () => {
    $(`#FrmBookAppointment input[type="file"]`).each((idx, fileInput) => {
        var fileInputId = $(fileInput).attr("data-id");
        $(`.service-${fileInputId}-error-message`).empty();

        if (fileInput.files.length > 0) {
            const file = fileInput.files[0];
            const fileName = file.name;
            const fileExtension = fileName.split(".").pop();
            const fileSizeInBytes = file.size;
            const fileSizeInKB = fileSizeInBytes / 1024;
            const fileSizeInMB = fileSizeInKB / 1024;

            if (fileSizeInMB.toFixed(2) > 2) {
                $(`.service-${fileInputId}-error-message`).text(
                    "The maximum file size allowed is 2MB."
                );
                return;
            }
            if (!allowedExtensions.includes(fileExtension)) {
                $(`.service-${fileInputId}-error-message`).text("Invalid image type.");
                return;
            }
            stepperNext();
        } else {
            $(`.service-${fileInputId}-error-message`).text("No file selected.");
        }
    });
});

$(".BtnSummaryBack").on("click", function () {
    if (hasRequiredRecommendation) {
        stepperPrev();
    } else {
        stepper.to(2);
    }
});

$(".BtnSummaryNext").on("click", function () {
    stepperNext();
});

$(".BtnPayment").each(function (idx, button) {
    var PaymentMethod = $(button).attr("data-payment-method");
    var PaymentMethodLabel = $(button).attr("data-payment-method-label");
    var PaymentGateway = $(button).attr("data-payment-gateway");

    $(button).on("click", function () {
        $(".BoxPaymentMethods").hide();
        $(".BoxPaymentProcessing").show();
        $(button).text("Processing");

        var formData = new FormData($("#FrmBookAppointment")[0]);
        formData.append("action", "submitPayment");
        formData.append("selectedDate", selectedDate);
        formData.append("selectedServices", JSON.stringify(selectedServices));
        formData.append("PaymentMethod", PaymentMethod);
        formData.append("PaymentGateway", PaymentGateway);

        console.log($("#FrmBookAppointment")[0]);

        setTimeout(() => {
            $.ajax({
                type: "POST",
                url: "./ajax/appointment.php",
                data: formData,
                processData: false,
                contentType: false,
                success: function (data) {
                    console.log(data);
                    var response = JSON.parse(data);

                    $(button).text(PaymentMethodLabel);

                    if (response.success) {
                        window.location.href = response.checkout;
                    } else {
                        swal({
                            title: "Something Went Wrong",
                            text: response.message,
                            icon: "error",
                        });
                    }
                },
            });

            $(".BoxPaymentMethods").show();
            $(".BoxPaymentProcessing").hide();
        }, 1000);
    });
});