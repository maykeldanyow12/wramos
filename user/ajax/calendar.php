<?php
include "../../configurations/include.php";
header('Content-Type: application/json; charset=utf-8');
$appointment_date = [];
$selected_services = [];

$selectedServices = $form->input("selectedServices", "array");
foreach ($selectedServices as $service) {
    $selected_services[] = $service["id"];
}
foreach ($selected_services as $service_id) {
    $service = $db->query("SELECT * FROM services WHERE id = $service_id LIMIT 1")->fetch_object();
    $service_name = $service->name;
    $service_price = $service->fee;
    $service_slot = $service->availableReservationsPerDay;
    $service_id = $service->id;

    //check appointment availability based on service id
    $appointment_availability = $db->query("SELECT *,count(*) as 'count' FROM appointment WHERE FIND_IN_SET('$service_id', services_id) > 0 GROUP BY appointmentDate");
    $services = [];
    while ($row = $appointment_availability->fetch_assoc()) {
        $left_slots = max(0, $service_slot - $row["count"]);
        $appointment_date[] = [
            "title" => "$service_name Slots: $left_slots",
            "start" => $row["appointmentDate"],
            "service_id" => $service_id,
            "count" => $row["count"],
            "name" => $service_name,
            "available_slots" => $left_slots,
            "date" => formatdate($row["appointmentDate"],"M d,Y")
        ];
    }
}

echo arraytojson($appointment_date);