<?php
include "../../configurations/include.php";

session_start();

$action = $form->input("action");
$selected_services = [];
if ($action == "toggleSelectService") {
    $id = $form->input("id");

    $selected_services = $session->isUsed("book_services_id") ? $session->key("book_services_id")->value() : [];

    $indexToRemove = array_search($id, $selected_services);
    if ($indexToRemove !== false) {
        $selected_services = remove_on_array($id, $selected_services);
    } else {
        $selected_services[] = $id;
    }

    $session->key("book_services_id")->value($selected_services);
}
if ($action == "submitPayment") {
    $userid = $session->key("id")->value();
    $track_id = generateUniqueCode(10);
    $selectedDate = $form->input("selectedDate");
    $payment_method = $form->input("PaymentMethod");
    $selectedServices = $form->input("selectedServices", "json");
    $PaymentGateway = $form->input("PaymentGateway");

    $FileUploadResult = $file->multiple(function($file,$input){
        return $file
            ->input($input)
            ->extra([
                "service_id" => str_replace("service_name_","",$input)
            ])
            ->suffix(".recommendation")
            ->randomName(8)
            ->destination("../../images/recommendation")
            ->upload();
    });

    $RecommendationFiles = [];
    foreach($FileUploadResult as $file){
            $RecommendationFiles[] = [
                "path" => $file["name"],
                "service_id" => $file["extra"]["service_id"],
            ];
    }
    $RecommendationFilesJson = arraytojson($RecommendationFiles);
    $amount = 0;

    foreach ($selectedServices as $service) {
        $amount += $service["fee"];
    }

    $SelectedServicesArr = array_column($selectedServices, 'id');
    $SelectedServicesStr = implode(',', $SelectedServicesArr);

    $handle_url = "http://localhost:8080/wramos/user/handle-payment.php?id=$track_id";

    if ($PaymentGateway == "paymongo") {
        $paymongo
            ->setApiKey("c2tfdGVzdF9KOWR5R1F6cUNKeWlSN0xLREJzYXZtdm46cGtfdGVzdF9LNGdTZGZmd1ZTYjdTem9WWGpaVFh4Q3U=")
            ->setResourceAmount($amount)
            ->setResourceCurrency("PHP")
            ->setResourceMethod($payment_method)
            ->setResourceSuccessUrl($handle_url)
            ->setResourceReturnUrl($handle_url)
            ->createResource();

        $CheckoutPageId = $paymongo->page()->getPaymentId();
        $CheckoutUrl = $paymongo->page()->getPaymentUrl();
    } else {
        echo arraytojson([
            "success" => false,
            "message" => "We cannot process your payment right now, because the payment gateway is not available. Try to choose a different payment method"
        ]);
    }

    $nosql
        ->table("appointment")
        ->store([
            "userId" => $userid,
            "services_id" => $SelectedServicesStr,
            "appointmentDate" => $selectedDate,
            "payment_id" => $track_id,
            "payment_ref" => $CheckoutPageId,
            "payment_gateway" => $PaymentGateway,
            "payment_method" => $payment_method,
            "service_recommendation" => $RecommendationFilesJson,
            "amount" => $amount,
        ]);




    echo arraytojson([
        "success" => true,
        "checkout" => $CheckoutUrl
    ]);
}