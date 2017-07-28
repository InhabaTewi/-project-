<?php

// Enable display of PHP errors
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

// gsdb is the primary object used to call all PHP functions for the project
$gsdb = new GSDB_Main();
//$gsdb->doTest();






// GSDB_Main class will provide the implementation of the interface between
// PHP and SQL, in additional to many PHP helper functions
class GSDB_Main {

    // $conn - holds the connection pointer.  Only the db* functions should use this.
    private $conn;

    // contains the user info of the currently logged on user.
    public $session_user = "";
    public $session_user_id = "";
    public $session_user_role = "";

    // $page_error_message contains any error message result to be displayed on the web page from PHP
    public $page_error_message = "";


    // for debug purposes
    private $debug_log = array();
    private $debug_file;
    private $debug = true;

    function log($logstr = "") {
        $this->debug_log []= $logstr;
    }

    function logStart() {
        $this->debug_file = fopen("gsdb_debug.txt", "a+");
        $this->log("Log started");
    }

    function logWrite() {
        if (!$this->debug_file && $this->debug)
            return false;

        foreach ($this->debug_log as $logstr) {
            $logstr = date("d-m-y H:i:s", time() - (60*60*7)) . " $logstr";
            fwrite($this->debug_file, $logstr . "\r\n");
        }

        return true;
    }

    function logClose() {
        if (!$this->debug_file)
            return false;

        $this->log("Log closing");
        $this->logWrite();
        fclose($this->debug_file);

        return true;
    }


    function getLoggedOnUser() {
        return $this->session_user;
    }

    function startUserSession($session_user, $password) {

        $query = "SELECT cname, customer_id "
            . "FROM view_customer c "
            . "WHERE (cname='$session_user' AND password='$password')";

        //debug
        //print $query;


        $query_result = $this->doSQLQuery($query);

        //print_r($query_result);

        if (isset($query_result['CNAME'][0])) {

            $this->session_user = $query_result['CNAME'][0];
            $this->session_user_id = $query_result['CUSTOMER_ID'][0];
            $this->session_user_role = "customer";
        } else {

            $query = "SELECT sname, staff_id "
                . "FROM view_staff s "
                . "WHERE (sname='$session_user' AND password='$password')";

            $query_result = $this->doSQLQuery($query);

            //debug
            //print_r($query);
            //print_r($query_result);
            if (isset($query_result['SNAME'][0])) {
                //debug
                //print_r($query);
                //print_r($query_result);
                //print "result: " . print_r($query_result, true);
                $this->session_user = $query_result['SNAME'][0];
                $this->session_user_id = $query_result['STAFF_ID'][0];
                $this->session_user_role = "staff";
            }
        }

        if ($this->getLoggedOnUser()) {
            $this->resumeUserSession();
            return true;
        } else {
            return false;
        }

    }


    function endUserSession() {

        if (!$this->getLoggedOnUser()) {
            return false;
        }

        setcookie("gsdb[session_user]", '', time());
        setcookie("gsdb[session_user_id]", '', time());
        setcookie("gsdb[session_user_role]", '', time());
        $this->session_user = "";
        $this->session_user_id = "";
        $this->session_user_role = "";

        return true;
    }



    function resumeUserSession() {

        //debug
        //print_r($_COOKIE);

        if ($this->getLoggedOnUser()) {
            // cookie life time is 30 minutes
            setcookie("gsdb[session_user]", $this->session_user, time()+60*30);
            setcookie("gsdb[session_user_id]", $this->session_user_id, time()+60*30);
            setcookie("gsdb[session_user_role]", $this->session_user_role, time()+60*30);

            //debug
            //print_r($_COOKIE);
        } else if (isset($_COOKIE['gsdb'])) {

            $this->session_user = $_COOKIE["gsdb"]["session_user"];
            $this->session_user_id = $_COOKIE["gsdb"]["session_user_id"];
            $this->session_user_role = $_COOKIE["gsdb"]["session_user_role"];

        } /* else if (isset($_COOKIE['session_user'])){
            $this->session_user = $_COOKIE['session_user'];
        } else if (isset($_SESSION['session_user'])){
            $this->session_user = $_SESSION['session_user'];
        }*/

    }




    function getUserInfo($user_id = "", $type = "") {
        if ($user_id === "" || $type === "") {
            return "";
        }

        $result_arry = array();

        if ($type == "customer")
            $query = "SELECT * FROM view_customer WHERE customer_id = $user_id";
        else if ($type == "staff")
            $query = "SELECT * FROM view_staff WHERE staff_id = $user_id";
        else
            return "";

        $result_arr = $this->doSQLQuery($query);

        return $result_arr;
    }



    // doSQLQuery - Execute any SQL statement and return the result as a 2-D array
    // If successful, returns an array, empty array in the case of insert.
    // If failed, returns a string with a possible error message
    function doSQLQuery($sql, $transaction = false) {

        $num_rows = 0;
        $result_arr = array();

        if (!$this->dbIsConnected())
            return "Not connected";

        //debug
        //$sql = "SELECT * FROM view_staff";
        //print_r($sql);

        $statement = @oci_parse($this->conn, $sql);

        if (!$statement) {
            $e = oci_error($$this->conn);
            $this->log("Invalid statement: " . print_r($e, true));
            return "Invalid statement: " . $e['message'];
        }

        //debug
        //print_r($statement);

        if ($transaction)
            $exec_result = @oci_execute($statement, OCI_NO_AUTO_COMMIT);
        else
            $exec_result = @oci_execute($statement);

        if (!$exec_result) {
            $e = oci_error($statement);
            $this->log("Statement error: " . print_r($e, true));
            return "Statement error: " . $e['message'];
        }


        $clause = strtolower(explode(' ', $sql)[0]);

        if ($clause != "insert" && $clause != "update" && $clause != "delete") {
            $num_rows = oci_fetch_all($statement, $result_arr);
        }


        oci_free_statement($statement);

        //debug
        //print "numrows: $num_rows ";
        //print_r($result_arr);

        if ($clause == "insert" || $clause == "update" || $clause == "delete")
            return $result_arr;

        if (!$num_rows)
            return "";
        else {

            //debug
            //print_r($result_arr);

            return $result_arr;
        }
    }




    /* getNextID() - Auto Increment function for primary keys of the table
    */
    function getNextID($table = "") {
/*
GSDB_ADDRESS
GSDB_CREDITCARD
GSDB_CUSTOMER
GSDB_NUTRITION_OR_ALCOHOL
GSDB_ORDER
GSDB_ORDERPRODUCTS
GSDB_PRODUCT
GSDB_STAFF
GSDB_STATE_PRODUCT_PRICES
GSDB_STOCK
GSDB_SUPPLIER
GSDB_SUPPLIER_PRODUCTS
GSDB_WAREHOUSE
*/
        $table = strtolower($table);
        $which_id = $table . "_id";
        $table = "view_" . $table;

        $query = "SELECT MAX($which_id) as max FROM $table";

        //debug
        //print $query;

        $result = $this->doSQLQuery($query);
        if (!isset($result['MAX'][0]))
            return 0;


        //debug
        //print_r($result);

        $next_id = $result['MAX'][0] + 1;

        return $next_id;
    }



    function updateUserPassword($user_id = "", $user_role = "", $password = "") {

        $query = "";
        $result_arr = "";

        if (!$user_id || !$user_role || !$password)
            return "";

        if ($user_role == "staff") {
            $query = "UPDATE gsdb_staff SET password = '$password' WHERE staff_id = $user_id";
        } else if ($user_role == "customer") {
            $query = "UPDATE gsdb_customer SET password = '$password' WHERE customer_id = $user_id";
        } else {
            return "";
        }

        $result_arr = $this->doSQLQuery($query);

        return is_array($result_arr);
    }




    function createUser($username, $password, $type = "customer") {

        if (!$username || !$password) {
            return false;
        }

        $next_user_id = $this->getNextID($type);
        $next_address_id = $this->getNextID("address");
        $result = "";

        if ($type == "customer") {
            $query = "INSERT INTO gsdb_address (address_id, addrowner_id) "
                . "VALUES ($next_address_id, $next_user_id)";

            $result = $this->doSQLQuery($query, true);

            if (!is_array($result)) {
                oci_rollback($this->conn);
                return false;
            }

            $query = "INSERT INTO gsdb_customer (customer_id, cname, password, preferred_address, balance) "
                . "VALUES ($next_user_id, '$username', '$password', $next_address_id, 0)";

            $result = $this->doSQLQuery($query, true);

            if (!is_array($result)) {
                oci_rollback($this->conn);
                return false;
            }

            oci_commit($this->conn);
            return true;

        } else {
            $query = "INSERT INTO gsdb_staff (staff_id, sname, password) "
                . "VALUES ($next_user_id, '$username', '$password')";

            $result = $this->doSQLQuery($query);

            if (!is_array($result)) {
                //oci_rollback($this->conn);
                return false;
            } else
                return true;
        }

    }




    function createOrder($customer_id = "") {
        if ($customer_id === "") {
            return "";
        }

        $nextorder = $this->getNextID("order");

        $result = "";
        $query = "INSERT INTO gsdb_order (order_id, customer_id, status, timestamp, total, delivery_address) "
            . "VALUES ($nextorder, $customer_id, 'open', sysdate, 0, '')";

        $result = $this->doSQLQuery($query);

        if (!is_array($result))
            return "";

        return $nextorder;
    }




    function getOrderProduct($order_id = "", $product_id = "") {

        if ($order_id === "" || $product_id === "")
            return "";

        $result ="";
        $query = "SELECT * FROM view_orderproducts WHERE (order_id = $order_id AND product_id = $product_id)";

        $result = $this->doSQLQuery($query);

        if (!is_array($result))
            return "";

        return $result;
    }





    function listOrderProducts($order_id = "") {

        if ($order_id === "")
            return "";

        $result ="";
        $query = "SELECT * FROM view_orderproducts o "
            . "JOIN view_product p ON (o.product_id = p.product_id)"
            . "WHERE order_id = $order_id";

        $result = $this->doSQLQuery($query);

        if (!is_array($result))
            return "";

        return $result;
    }




    function getOrderTotal($order_id = "") {

        if ($order_id === "")
            return "";

        $order_products = $this->listOrderProducts($order_id);

        if (!is_array($order_products) || count($order_products["ORDER_ID"]) == 0)
            return "";


        $total = 0;
        for ($i = 0; $i < count($order_products["ORDER_ID"]); $i++) {
            $total += (floatval($order_products["QUANTITY"][$i]) * floatval($order_products["PRICE"][$i]));
        }

        return $total;

    }





    function updateBalance($customer_id = "", $balance = "") {
        if ($customer_id === "" || $balance === "")
            return false;

        $query = "UPDATE gsdb_customer SET balance = balance + $balance WHERE customer_id = $customer_id";

        $result = $this->doSQLQuery($query);

        return is_array($result);
    }





    function updateOrderStatus($order_id = "", $status = "") {
        if ($order_id === "" || $status === "")
            return false;

        $query = "UPDATE gsdb_order SET status = '$status' WHERE order_id = $order_id";
        $result = $this->doSQLQuery($query);

        return is_array($result);
    }





    function removeOrderProduct($order_id = "", $product_id = "") {

        if ($order_id === "" || $product_id === "")
            return "";


        $result = "";
        $query = "DELETE FROM gsdb_orderproducts WHERE (order_id = $order_id AND product_id = $product_id)";

        $result = $this->doSQLQuery($query);

        return is_array($result);
    }




    /*
    add payment card plus billing address
    */
    function addPayment($customer_id, $creditcard_id, $cc_name, $cc_num, $cc_ccv, $cc_exp, $billing_address_id) {

        if ($creditcard_id === "") {
            $creditcard_id = $this->getNextID("creditcard");
            $query = "INSERT INTO gsdb_creditcard (customer_id, creditcard_id, cc_name, cc_num, cc_ccv, cc_exp) VALUES ("
                . "$customer_id, $creditcard_id, '$cc_name', '$cc_num', $cc_ccv, to_date('$cc_exp','dd-mm-yy hh24:mi:ss')"
                . ")";

        } else {
            $query = "UPDATE gsdb_creditcard SET "
            . "cc_name = '$cc_name', "
            . "cc_num = $cc_num, "
            . "cc_ccv = $cc_ccv, "
            . "cc_exp = to_date('$cc_exp','dd-mm-yy hh24:mi:ss') "
            ." WHERE creditcard_id = $creditcard_id";
        }

        $result = $this->doSQLQuery($query, true);

        if (!is_array($result)) {
            oci_rollback($this->conn);
            return "";
        }

        $billing_address = $this->getAddress($billing_address_id);
        $result = $this->addAddress($creditcard_id,
            $billing_address["ADDRESS_ID"][0],
            $billing_address["STREET"][0],
            $billing_address["CITY"][0],
            $billing_address["STATE"][0],
            $billing_address["ZIP"][0]);

        if ($result === "") {
            oci_rollback($this->conn);
            return "";
        }

        oci_commit($this->conn);
        return true;
    }



    /*
    if address_id is blank, create a new address id
    else update existing address
    */
    function addAddress($user_id, $address_id, $street, $city, $state, $zip) {
        if ($address_id === "") {
            $address_id = $this->getNextID("address");
            $query = "INSERT INTO gsdb_address (addrowner_id, address_id, street, city, state, zip) VALUES ("
                . "$user_id, "
                . "$address_id, "
                . "'$street', "
                . "'$city', "
                . "'$state', "
                . intval($zip) . " "
                . ")";
        } else {
            $query = "UPDATE gsdb_address SET "
                . "street = '$street', "
                . "city = '$city', "
                . "state = '$state', "
                . "zip = ". intval($zip) . " "
                . " WHERE address_id = $address_id";
        }

        $result = $this->doSQLQuery($query);

        if (is_array($result)) {
            return $address_id;
        } else {
            return "";
        }
    }





    function removeAddress() {

    }





    function setPreferredAddress($user_id, $address_id) {
        if ($user_id === "" || $address_id === "")
            return false;


        $query = "UPDATE gsdb_customer SET preferred_address = $address_id WHERE customer_id = $user_id";
        $result = $this->doSQLQuery($query);

        return is_array($result);
    }






    function addOrderProduct($order_id = "", $product_id = "", $quantity = "") {
        if ($order_id === "" || $product_id === "" || $quantity === "") {
            $this->log("addOrderProduct failed: $order_id, $product_id, $quantity");
            return "";
        }

        $result = "";
        $query = "INSERT INTO gsdb_orderproducts (order_id, product_id, quantity) VALUES ($order_id, $product_id, $quantity)";
        $this->log($query);

        $result = $this->doSQLQuery($query);

        return is_array($result);
    }







    function getCart($customer_id = "") {
        if ($customer_id === "")
            return "";

        $result = "";
        $query = "SELECT * FROM view_order WHERE customer_id = $customer_id AND status = 'open'";

        $result = $this->doSQLQuery($query);

        if (!is_array($result))
            return "";

        $this->log("getCart: " . print_r($result, true));

        if (count($result) != 0)
           return $result;
       else
           return "";

    }




    function getNumOrderItems($order_id = "") {
        if ($order_id === "")
            return "";

        $result = "";
        $query = "SELECT * FROM view_orderproducts WHERE order_id = $order_id";
        $result = $this->doSQLQuery($query);

        if (is_array($result) && count($result) != 0) {
            //return count($result["ORDER_ID"]);

            $num_items = 0;
            for ($i = 0; $i < count($result["ORDER_ID"]); $i++) {
                $num_items += intval($result["QUANTITY"][$i]);
            }

            return $num_items;
        } else
            return 0;
    }




    function getAddress($address_id = "") {
        if ($address_id === "")
            return "";

        $query = "SELECT * FROM view_address WHERE address_id = $address_id";
        $result = $this->doSQLQuery($query);

        if (!is_array($result))
            return "";

        return $result;
    }






    function listAddresses($user_id = "") {
        if ($user_id === "")
            return "";

        $result ="";
        $query = "SELECT * FROM view_address a "
            . "WHERE addrowner_id = $user_id";

        $result = $this->doSQLQuery($query);

        if (!is_array($result))
            return "";

        return $result;
    }





    function listCreditcards($user_id = "") {
        if ($user_id === "")
            return "";

        $result ="";
        $query = "SELECT * FROM view_creditcard c "
            . "WHERE customer_id = $user_id";

        $result = $this->doSQLQuery($query);

        if (!is_array($result))
            return "";

        return $result;
    }






    function getAccountBalance($customer_id = "") {
        if ($customer_id === "")
            return "";

        $query = "SELECT balance FROM view_customer WHERE customer_id = $customer_id";
        $result = $this->doSQLQuery($query);

        if (is_array($result) && count($result["BALANCE"]))
            return $result["BALANCE"][0];
        else
            return "";
    }





    // dbConnect() - open a persistent connection to the oracle database. For internal use only.
    private function dbConnect() {
        $result = "";

        $this->conn = oci_pconnect('dyoung9', 'KETffQ^*T8#KKF', 'fourier.cs.iit.edu/orcl.cs.iit.edu');

        if (!$this->conn) {
            $e = oci_error($this->conn);
            $result = "There was an error: " . $e['message'];
        } else
            $result = "Connected to Oracle!";

        return $result;
    }




    function searchProducts($search = "") {
        $result = "";

        if ($search) {

        } else {
            $search = "SELECT * FROM view_product ORDER BY product_id";
            $result = $this->doSQLQuery($search);

            //debug
            //print_r($result);
        }

        return $result;

    }



    // dbClose - Close the Oracle connection
    private function dbClose() {
        oci_close($this->conn);
    }





    // dbIsConnected - Helper function
    function dbIsConnected() {
        return !(!$this->conn);
    }




    // Constructor
    function __construct() {
        $this->logStart();
        $this->dbConnect();
        $this->resumeUserSession();
        //$this->doTest();
    }




    // Destructor
    function __destruct() {
        $this->logClose();
    }




    // doTest - Helper function
    function doTest() {
        $next_id = $this->getNextID("product");
        $query = "INSERT INTO gsdb_product (product_id, pname, category, weight, price, description, image) VALUES ($next_id, 'web product', 'food', 22, 6, 'lorem ipsum lorem ipsum', '')";
        print $query;

        $result = $this->doSQLQuery($query);
        print_r($result);
    }
}
?>
