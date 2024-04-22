<?php
function check_login()
{
	if (strlen($_SESSION['login']) == 0) {
		$host = $_SERVER['HTTP_HOST'];
		$uri = rtrim(dirname($_SERVER['PHP_SELF']), '/\\');
		$extra = "./login.php";
		header("Location: http://$host$uri/$extra");
	}
}

function navigate($path)
{
	echo "<script>window.location.href='$path'</script>";
	exit();
}


class Paymongo
{
	private $paymongo_api_key = null;
	private $paymongo_attributes = ["data" => null];
	private $paymongo_response = null;
	private $payment_details_type = null;
	public function setApiKey($paymongo_api_key)
	{
		$this->paymongo_api_key = $paymongo_api_key;
		return $this;
	}
	public function setAttributes($data)
	{
		$this->paymongo_attributes["data"]["attributes"] = $data;
		return $this;
	}
	public function setResourceMethod($method)
	{
		$this->paymongo_attributes["data"]["attributes"]["type"] = $method;
		return $this;

	}
	public function setResourceAmount($amount, $int32 = false)
	{
		if (!$int32) {
			$amount = (int) ($amount * 100);
		}
		$this->paymongo_attributes["data"]["attributes"]["amount"] = $amount;
		return $this;
	}
	public function setResourceCurrency($currency = "PHP")
	{
		$this->paymongo_attributes["data"]["attributes"]["currency"] = $currency;
		return $this;
	}
	public function setResourceSuccessUrl($url)
	{
		$this->paymongo_attributes["data"]["attributes"]["redirect"]["success"] = $url;
		return $this;
	}
	public function setResourceReturnUrl($url)
	{
		$this->paymongo_attributes["data"]["attributes"]["redirect"]["failed"] = $url;
		return $this;
	}

	public function createResource()
	{
		$payload = $this->paymongo_attributes;
		return $this->paymongo_response = $this->MakeWebRequest("https://api.paymongo.com/v1/sources", $payload);
	}
	public function loadResource($id)
	{
		$this->paymongo_response = $this->MakeWebRequest("https://api.paymongo.com/v1/sources/$id");
		return $this;
	}
	public function page($type = "resource")
	{
		$this->payment_details_type = $type;
		return $this;
	}
	public function type($type = "resource")
	{
		$this->payment_details_type = $type;
	}
	public function getPaymentId()
	{
		return $this->paymongo_response["data"]["id"];
	}
	public function getAttributes()
	{
		return $this->paymongo_response["data"]["attributes"];
	}
	public function getPaymentUrl()
	{
		$type = $this->payment_details_type;
		if ($type == "resource") {
			return $this->paymongo_response["data"]["attributes"]["redirect"]["checkout_url"];
		} elseif ($type == "checkout_session") {

		} else {
			return $this->paymongo_response["data"]["attributes"]["redirect"]["checkout_url"];
		}
	}
	public function getPaymentStatus()
	{
		$type = $this->payment_details_type;
		if ($type == "resource") {
			return $this->paymongo_response["data"]["attributes"]["status"];
		} elseif ($type == "checkout_session") {
			return $this->paymongo_response["data"]["attributes"]["payment_intent"]["attributes"]["status"];
		} else {
			return $this->paymongo_response["data"]["attributes"]["status"];
		}
	}

	private function MakeWebRequest($apiEndpoint, $payload = null)
	{
		$jsonPayload = json_encode($payload);

		$ch = curl_init($apiEndpoint);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		curl_setopt($ch, CURLOPT_HTTPHEADER, [
			'Content-Type: application/json',
			'Authorization: Basic ' . $this->paymongo_api_key
		]);

		if ($payload != null) {
			curl_setopt($ch, CURLOPT_POST, true);
			curl_setopt($ch, CURLOPT_POSTFIELDS, $jsonPayload);
		}


		$response = curl_exec($ch);

		curl_close($ch);

		return json_decode($response, true) ?? false;
	}
}
function formatdate($date, $format = "M d,Y h:i A")
{
	$date = strtotime($date);
	return date($format, $date);
}