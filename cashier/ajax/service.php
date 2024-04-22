<?php
include "../../../configurations/include.php";
$action = $form->input("action");
$file->allowedExtensions = ["jpg", "png", "jpeg", "gif"];

if ($action == "create") {
    $name = $form->name("name")->as("name")->rules("required");

    if ($file->isNotUsed("image")) {
        response(false, "Please select a image file for this service.");
    }

    $fileInput = $file->input("image");

    if ($fileInput->size("mb") > 5) {
        response(false, "File exceeds size limit");
    }
    if ($fileInput->hasInvalidExt()) {
        response(false, "The available format is {$fileInput->availableFormats()}");
    }

    $description = $form->name("description")->as("description")->rules("required");
    $fee = $form->name("fee")->as("fee")->rules("required|number");
    $availablePerDay = $form->name("availablePerDay")->as("")->rules("required|number");

    if ($form->isNotUsed("availableDay")) {
        response(false, "Please choose an available day.");
    }

    $availableDay = $form->input("availableDay", true, ",");

    $requireRecommendation = $form->isUsed("requireRecommendation") ? "yes" : "no";

    $FileUploadResult = $fileInput
        ->suffix(".services")
        ->randomName(8)
        ->destination("../../../images/services")
        ->upload();

    $UploadedFileName = $FileUploadResult['name'];

    $nosql
        ->table("services")
        ->store([
            "name" => $name,
            "image" => $UploadedFileName,
            "description" => $description,
            "fee" => $fee,
            "availableReservationsPerDay" => $availablePerDay,
            "availableDay" => $availableDay,
            "requireRecommendation" => $requireRecommendation
        ]);

    response(true, "Successfully created a new service.");
}

if ($action == "delete") {
    $id = $form->input("id");
    $service = $nosql
        ->table("services")
        ->column(["id", "image"])
        ->where("id = {$id}")
        ->load(false);


    $file->delete("../../../images/services/{$service['image']}");

    $nosql->table("services")->where("id = $id")->delete();

    response(true, "Successfully deleted the service.");
}

if ($action == "update_general") {
    $id = $form->input("id");
    $name = $form->name("name")->as("name")->rules("required");
    $description = $form->name("description")->as("description")->rules("required");
    $fee = $form->name("fee")->as("fee")->rules("required|number");
    $availablePerDay = $form->name("availablePerDay")->as("available reservations per day")->rules("required|number");
    $availablePerDay = $form->name("availablePerDay")->as("availablePerDay")->rules("required|number");

    if ($form->isNotUsed("availableDay")) {
        response(false, "Please choose an available day.");
    }

    $requireRecommendation = $form->isUsed("requireRecommendation") ? "yes" : "no";

    $availableDay = $form->input("availableDay", true, ",");

    $nosql
        ->table("services")
        ->where("id = $id")
        ->update([
            "name" => "'$name'",
            "description" => "'$description'",
            "fee" => "$fee",
            "availableReservationsPerDay" => "'$availablePerDay'",
            "availableDay" => "'$availableDay'",
            "requireRecommendation" => "'$requireRecommendation'"
        ]);

    response(true, "");
}

if ($action == "update_image") {
    $id = $form->input("id");
    $image = $form->input("image_name");

    if ($file->isNotUsed("image")) {
        response(false, "Please select a image file for this service.");
    }
    $fileInput = $file->input("image");

    if ($fileInput->size("mb") > 5) {
        response(false, "File exceeds size limit");
    }
    if ($fileInput->hasInvalidExt()) {
        response(false, "The available format is {$fileInput->availableFormats()}");
    }

    $file->delete("../../../images/services/{$image}");

    $FileUploadResult = $fileInput
        ->suffix(".services")
        ->randomName(8)
        ->destination("../../../images/services")
        ->upload();

    $UploadedFileName = $FileUploadResult['name'];

    $nosql
        ->table("services")
        ->where("id = $id")
        ->update([
            "image" => "'$UploadedFileName'",
        ]);

    response(true, "");
}