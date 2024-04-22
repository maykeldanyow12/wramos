<?php
include "../../../configurations/include.php";
$action = $form->input("action");

if ($action == "create") {
    $name = $form->name("name")->as("name")->rules("required");
    $description = $form->name("description")->as("description")->rules("required");

    if ($form->isNotUsed("services")) {
        response(false, "Please select atleast one service.");
    }
    $services = $form->input("services", true);

    $services_id = [];
    $services_name = [];

    foreach ($services as $service) {
        $service = explode("|", $service);
        $serviceId = $service[0];
        $serviceName = $service[1];

        $services_id[] = $serviceId;
        $services_name[] = $serviceName;
    }

    $servicesId = implode(", ", $services_id);
    $servicesName = implode(", ", $services_name);

    $fee = $form->name("fee")->as("fee")->rules("required|number");


    $nosql
        ->table("packages")
        ->store([
            "name" => $name,
            "description" => $description,
            "services_id" => $servicesId,
            "services" => $servicesName,
            "fee" => $fee
        ]);

    response(true, "");
}

if ($action == "update") {
    $id = $form->name("id")->as("id")->rules("required");
    $name = $form->name("name")->as("name")->rules("required");
    $description = $form->name("description")->as("description")->rules("required");

    if ($form->isNotUsed("services")) {
        response(false, "Please select atleast one service.");
    }
    $services = $form->input("services", true);

    $services_id = [];
    $services_name = [];

    foreach ($services as $service) {
        $service = explode("|", $service);
        $serviceId = $service[0];
        $serviceName = $service[1];

        $services_id[] = $serviceId;
        $services_name[] = $serviceName;
    }

    $servicesId = implode(", ", $services_id);
    $servicesName = implode(", ", $services_name);

    $fee = $form->name("fee")->as("fee")->rules("required|number");

    $nosql
        ->table("packages")
        ->where("id = {$id}")
        ->update([
            "name" => "'$name'",
            "description" => "'$description'",
            "services" => "'$servicesName'",
            "services_id" => "'$servicesId'",
            "fee" => "$fee"
        ]);

    response(true, "");
}

if ($action == "delete") {
    $id = $form->name("id")->as("id")->rules("required");

    $nosql
        ->table("packages")
        ->where("id = {$id}")
        ->delete();

    response(true, "");
}