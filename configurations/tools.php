<?php

class FormHandler
{
    private $request_value = "";
    private $has_error = false;
    private $key_name = "";
    public $DB_CONNECTION = false;
    protected $rules = [];
    protected $errors = [];
    protected $alias = null;

    public static function method()
    {
        return $_SERVER['REQUEST_METHOD'];
    }

    public function __construct($db = false)
    {
        $this->DB_CONNECTION = $db;
    }

    public function input(string $key, $type = null, string $seperator = null)
    {
        if ($type == "array") {
            $request_value_array = $_REQUEST[$key];
            if ($seperator != null) {
                return implode($seperator, $request_value_array);
            } else {
                return $request_value_array;
            }
        } else if ($type == "json") {
            $request_value_array = json_decode($_REQUEST[$key], true);
            return  $request_value_array;
        } else {
            return $this->DB_CONNECTION->real_escape_string($_REQUEST[$key]);
        }
    }
    public function params($method = "GET")
    {
        if ($method == "GET") {
            return $_GET;
        }
    }
    public function name($key)
    {
        $this->key_name = $key;
        return $this;
    }

    public function rules(string $rules)
    {
        $this->rules = explode('|', $rules);

        foreach ($this->rules as $rule) {
            if (strpos($rule, ':') !== false) {
                $ruleArr = explode(":", $rule);
                $this->applyRule($ruleArr[0], $ruleArr[1]);
            }
            $this->applyRule($rule);
        }
        $db = $this->DB_CONNECTION;
        $value = $_REQUEST[$this->key_name];
        return $db->real_escape_string($value);
    }
    public function alias(string $alias)
    {
        $this->alias = $alias;
        return $this;
    }

    public function as (string $alias)
    {
        $this->alias = $alias;
        return $this;
    }

    protected function applyRule($rule, $dellimeter = 0)
    {
        switch ($rule) {
            case 'required':
                $this->required();
                break;
            case 'min':
                $this->min($dellimeter);
                break;
            case 'max':
                $this->max($dellimeter);
                break;
            case 'email':
                $this->email();
                break;
            case 'number':
                $this->number();
                break;
            case 'unique':
                $this->unique($dellimeter);
                break;
            case 'match':
                $this->match($dellimeter);
                break;
            case 'gtoe':
                $this->gtoe($dellimeter);
        }
    }

    protected function required()
    {
        $value = $_REQUEST[$this->key_name];
        $alias = is_null($this->alias) ? "Field" : ucfirst($this->alias);

        if (empty($value)) {
            response(false, "$alias is required");
        }
    }

    protected function min($minLength)
    {
        $value = $_REQUEST[$this->key_name];
        $alias = is_null($this->alias) ? "Field" : strtolower($this->alias);

        if (strlen($value) < $minLength) {
            response(false, "Minimum length of the $alias should be {$minLength} characters.");
        }
    }

    protected function max($maxLength)
    {
        $value = $_REQUEST[$this->key_name];
        $alias = is_null($this->alias) ? "Field" : strtolower($this->alias);

        if (strlen($value) > $maxLength) {
            response(false, "Maximum length of the $alias should be {$maxLength} characters.");
        }
    }

    protected function email()
    {
        $value = $_REQUEST[$this->key_name];
        $alias = is_null($this->alias) ? "Field" : ucfirst($this->alias);

        if (!filter_var($value, FILTER_VALIDATE_EMAIL)) {
            response(false, "$alias is not valid email");
        }
    }
    protected function number()
    {
        $value = $_REQUEST[$this->key_name];
        $alias = is_null($this->alias) ? "Field" : ucfirst($this->alias);
        if (!is_numeric($value)) {
            response(false, "$alias is not a number");
        }
    }
    protected function unique($dellimeter)
    {
        $db = $this->DB_CONNECTION;
        $value = $_REQUEST[$this->key_name];
        $alias = is_null($this->alias) ? "Field" : ucfirst($this->alias);

        $uniqueProp = explode(">", $dellimeter);
        $tblName = $uniqueProp[0];
        $columnName = $uniqueProp[1];

        $checkUniqueQry = $db->query("SELECT * FROM $tblName WHERE $columnName LIKE '%$value%'");
        if ($checkUniqueQry->num_rows > 0) {
            response(false, "$alias is already in use by other user");
        }
    }
    protected function match($dellimeter)
    {
        $value = $_REQUEST[$this->key_name];
        $alias = is_null($this->alias) ? "Field" : ucfirst($this->alias);

        $matchValue = $_REQUEST[$dellimeter];

        if ($value != $matchValue) {
            response(false, "$alias is not match");
        }
    }

    public function gtoe($dellimeter)
    {
        $value = $_REQUEST[$this->key_name];
        $alias = is_null($this->alias) ? "Field" : ucfirst($this->alias);

        if ($value < $dellimeter) {
            response(false, "$alias must be $dellimeter+");
        }
    }

    public function isUsed($key)
    {
        if (isset($_REQUEST[$key])) {
            return true;
        } else {
            return false;
        }
    }
    public function isNotUsed($key)
    {
        if (!isset($_REQUEST[$key])) {
            return true;
        } else {
            return false;
        }
    }

    public function data()
    {
        return $_REQUEST;
    }
}
class NoSql
{
    public $DB_CONNECTION = false;
    public $DB_RESULT = false;
    public $TBL_NAME = "";
    public $DB_WHERE = false;
    public $DB_SELECTED_COLUMNS = false;

    //Joins
    public $DB_JOINT_TABLE = null;
    public $DB_JOINT_CONDITION = null;
    public $DB_JOINT_TYPE = null;
    public $DB_JOINS_STRUCTURE = [];
    public $DB_LIMIT = NULL;
    //Sorting
    public $DB_SORT_ORDER = null;

    public function table($name)
    {
        $this->TBL_NAME = $name;

        return $this;
    }
    public function except_column(array $columns)
    {
        $db = $this->DB_CONNECTION;
        $tblName = $this->TBL_NAME;
        $columns = "'" . implode("', '", $columns) . "'";
        $getColumns = $db->query("SHOW COLUMNS FROM $tblName WHERE Field NOT IN ($columns);");
        $selectedColumn = [];
        while ($table = $getColumns->fetch_assoc()) {
            $selectedColumn[] = $table["Field"];
        }
        $this->DB_SELECTED_COLUMNS = implode(",", $selectedColumn);
        return $this;
    }
    public function column(array $columns)
    {
        $this->DB_SELECTED_COLUMNS = implode(",", $columns);

        return $this;
    }
    public function where($condition)
    {
        if (is_string($condition)) {
            $this->DB_WHERE = $condition;
        }
        if (is_array($condition)) {

        }
        return $this;
    }
    public function innerJoin(string $table)
    {
        $this->DB_JOINT_TABLE = $table;
        $this->DB_JOINT_TYPE = "INNER JOIN";
        return $this;
    }
    public function on(string $condition)
    {
        $this->DB_JOINT_CONDITION = $condition;

        $table = $this->DB_JOINT_TABLE;
        $type = $this->DB_JOINT_TYPE;

        $structure = "$type $table ON $condition";
        array_push($this->DB_JOINS_STRUCTURE, $structure);
        return $this;
    }
    public function asc(string $column)
    {
        $this->DB_SORT_ORDER = "ORDER BY $column ASC";
        return $this;
    }
    public function desc(string $column)
    {
        $this->DB_SORT_ORDER = "ORDER BY $column DESC";
        return $this;
    }
    public function limit(int $limit)
    {
        $this->DB_LIMIT = "LIMIT $limit";
        return $this;
    }
    public function load($isMany = true): array
    {
        $db = $this->DB_CONNECTION;

        $name = $this->TBL_NAME;
        $columns = $this->DB_SELECTED_COLUMNS == false ? "*" : $this->DB_SELECTED_COLUMNS;
        $where = $this->DB_WHERE == false ? "" : "WHERE " . $this->DB_WHERE;
        $joint = $this->DB_JOINS_STRUCTURE == [] ? "" : implode(" ", $this->DB_JOINS_STRUCTURE);
        $orderby = $this->DB_SORT_ORDER == null ? "" : $this->DB_SORT_ORDER;
        $limit = $this->DB_LIMIT == null ? "" : $this->DB_LIMIT;


        $result = $db->query("SELECT $columns  FROM `$name` $joint $where $orderby $limit");
        if ($isMany) {
            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    $resultArr[] = $row;
                }
                return $resultArr;
            }
            return [];
        }

        return $result->fetch_assoc();
    }
    public function store(array $data)
    {
        $db = $this->DB_CONNECTION;
        $tbl_name = $this->TBL_NAME;
        $columns = implode(", ", array_keys($data));
        $values = implode("', '", $data);
        $sql = "INSERT INTO `$tbl_name` ($columns) VALUES ('$values')";
        return $db->query($sql);
    }
    public function update(array $data)
    {
        $db = $this->DB_CONNECTION;
        $tbl_name = $this->TBL_NAME;
        $condition = $this->DB_WHERE;

        $updateData = [];
        foreach ($data as $key => $value) {
            $updateData[] = "$key = $value";
        }
        $sql = "UPDATE $tbl_name  SET " . implode(", ", $updateData) . " WHERE $condition";
        return $db->query($sql);
    }
    public function delete()
    {
        $db = $this->DB_CONNECTION;
        $tbl_name = $this->TBL_NAME;
        $condition = $this->DB_WHERE;
        $sql = "DELETE FROM $tbl_name WHERE $condition";
        return $db->query($sql);

    }
    public function auth(array $credentials)
    {
        if (!is_array($credentials)) {
            return false;
        }
        $db = $this->DB_CONNECTION;


        $columnStructure = "";
        end($credentials);
        $lastKey = key($credentials);

        foreach ($credentials as $column => $value) {
            if ($column == $lastKey) {
                $columnStructure .= " AND $column = '$value'";
            } else {
                $columnStructure .= " $column = '$value'";
            }
        }

        $name = $this->TBL_NAME;
        $columns = $this->DB_SELECTED_COLUMNS == false ? "*" : $this->DB_SELECTED_COLUMNS;

        $loginQry = $db->query("SELECT $columns FROM $name WHERE $columnStructure LIMIT 1");
        if ($loginQry->num_rows > 0) {
            return $loginQry->fetch_assoc();
        } else {
            return false;
        }
    }
    public function validateEmail(string $email, string $exception = null)
    {
        $db = $this->DB_CONNECTION;
        $table = $this->TBL_NAME;

        $checkQry = $db->query("SELECT * FROM $table WHERE email = '$email'");
        if ($checkQry->num_rows > 0) {
            $info = $checkQry->fetch_assoc();
            if ($info["id"] == $exception) {
                return true;
            }
            return "Email is already use by other user";
        }
        return true;
    }

    public function validateOldPassword(string $email, string $password)
    {
        $db = $this->DB_CONNECTION;
        $table = $this->TBL_NAME;

        $checkQry = $db->query("SELECT * FROM $table WHERE email = '$email'");
        if ($checkQry->num_rows > 0) {
            $info = $checkQry->fetch_assoc();

            if ($info["password"] == $password) {
                return true;
            } else {
                return "The old password is invalid.";
            }
        } else {
            return "Email not found!";
        }

    }
}
class Session
{
    private $_session_key = NULL;

    public function key($key)
    {
        $this->_session_key = $key;
        return $this;
    }
    public function get()
    {
        return $_SESSION[$this->_session_key];
    }
    public function set($value)
    {
        $_SESSION[$this->_session_key] = $value;
    }
    public function value($value = "")
    {
        if ($value == "") {
            return $_SESSION[$this->_session_key];
        } else {
            $_SESSION[$this->_session_key] = $value;
        }
    }
    public function push($value)
    {
        $_SESSION[$this->_session_key][] = $value;
    }
    public function isUsed($key)
    {
        return isset($_SESSION[$key]);
    }
    public function delete()
    {
        unset($_SESSION[$this->_session_key]);
    }
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

class Auth
{
    public function isAuthorize()
    {
        if (isset($_SESSION["isLogin"])) {
            if ($_SESSION["isLogin"]) {
                return true;
            }
        }
        return false;
    }

    public function level()
    {

    }
}

class FileHandler
{
    private $file = null;
    private $extra = [];
    //File Attributes
    public $name, $tmp, $size, $type, $error, $extension;
    //Upload Options
    public $usePrefix = false, $useSuffix = false, $prefix, $suffix, $useRandomName = false, $randomName, $useDestination = false, $destination;
    //Settings
    public $allowedExtensions;

    public function isNotUsed($name)
    {
        return !isset($_FILES[$name]);
    }
    public function multiple($LoopThroughFile)
    {
        $files = $_FILES;
        $UploadedStatus = [];
        foreach ($files as $fileInput => $fileDetails) {
            $UploadedStatus[] = $LoopThroughFile($this, $fileInput, $fileDetails);
        }
        return $UploadedStatus;
    }
    public function input($name)
    {
        $this->file = $_FILES[$name];
        $this->getAttributes();
        return $this;
    }
    public function hasInvalidExt()
    {
        if (in_array($this->extension, $this->allowedExtensions)) {
            return false;
        }
        return true;
    }
    public function extra($extra){
        $this->extra = $extra;
        return $this;
    }
    public function getAttributes()
    {
        $file = $this->file;
        $this->name = $file["name"];
        $this->tmp = $file["tmp_name"];
        $this->size = $file["size"];
        $this->type = $file["type"];
        $this->error = $file["error"];
        $fileExt = explode('.', $this->name);
        $this->extension = strtolower(end($fileExt));
    }

    public function availableFormats()
    {
        $formats = implode(", ", $this->allowedExtensions);
        $formats = explode(',', $formats);
        $formats[count($formats) - 1] = 'and ' . $formats[count($formats) - 1];
        return implode(", ", $formats);
    }
    public function size($unit = "kb")
    {
        $unit = strtolower($unit);
        $size = $this->size;

        switch ($unit) {
            case "kb":
                $size = $size / 1024;
                break;
            case "mb":
                $size = $size / (1024 * 1024);
                break;
            case "gb":
                $size = $size / (1024 * 1024 * 1024);
                break;
        }

        return $size;
    }
    public function prefix($prefix)
    {
        $this->usePrefix = true;
        $this->prefix = $prefix;
        return $this;
    }
    public function suffix($suffix)
    {
        $this->useSuffix = true;
        $this->suffix = $suffix;
        return $this;

    }
    public function randomName($length = 8)
    {
        $this->useRandomName = true;
        $this->randomName = generateUniqueCode($length);
        return $this;
    }
    public function destination($path)
    {
        $this->useDestination = true;
        $this->destination = $path;
        return $this;
    }
    public function upload()
    {
        $usePrefix = $this->usePrefix;
        $useSuffix = $this->useSuffix;
        $useRandomName = $this->useRandomName;
        $useDestination = $this->useDestination;
        $prefix = $this->prefix;
        $suffix = $this->suffix;
        $randomName = $this->randomName;
        $destination = $this->destination;
        $extra = $this->extra;

        $name = $this->name;

        if (!$useDestination) {
            echo "You must specify a destination";
            return false;
        }
        if ($useRandomName) {
            $name = $randomName;
        }
        if ($usePrefix) {
            $name = $prefix . $name;
        }
        if ($useSuffix) {
            $name = $name . $suffix;
        }
        $name = $name . "." . $this->extension;

        $upload_status = move_uploaded_file($this->tmp, $destination . "/" . $name);
        return [
            "name" => $name,
            "status" => $upload_status,
            "extension" => $this->extension,
            "extra" => $extra
        ];
    }

    public function delete($destination)
    {
        return unlink($destination);
    }
}