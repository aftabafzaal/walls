<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Validator,
    Input,
    Redirect;
use Auth;
use App\User;
use Illuminate\Http\Request;
use App\Orders;
use App\OrdersResults;
use App\Quest\Api;
use App\OrdersDocuments;
use DB;
use Config;

class TestController extends Controller {

    private $username;
    private $password;
    private $documentEndpoint;
    private $version;
    private $receivingApp;
    private $receivingFacility;
    private $sendingFacility;
    private $sendingApp;

    public function __construct() {
        //$this->middleware('auth');
        $this->username = env('QUEST_USERNAME');
        $this->password = env('QUEST_PASSWORD');
        // $this->documentEndpoint = env('QUEST_END_POINT');
        $this->documentEndpoint = 'https://cert.hub.care360.com';
        $this->version = env('QUEST_VERSION');

        $this->receivingApp = env('QUEST_RECEIVING_APPLICATION');
        $this->receivingFacility = env('QUEST_RECEIVING_FACILITY');
        $this->sendingFacility = env('QUEST_SENDING_FACILITY');
        $this->sendingApp = env('QUEST_SENDING_APPLICATION');
    }

    ///80000000000001085263

    public function acknowledgement($requestId, $controlId) {
        $path = public_path();
        $username = $this->username;
        $password = $this->password;
        $documentEndpoint = $this->documentEndpoint . "/rest/results/v1/retrieval/acknowledgeResults/";
        //$controlId="80000000000001099382";
        $request[] = "MSH|^~\&|" . $this->sendingApp . "|" . $this->sendingFacility . "|" . $this->receivingApp . "|" . $this->receivingFacility . "|" . date('YmdHi') . "||ACK|" . $controlId . "|P|" . $this->version;
        $request[] = "MSA|AA|" . $controlId;

        $message = implode("\r", $request);
        d($message);
        $json = '{"resultServiceType":"hl7","requestId":"' . $requestId . '","ackMessages":[{"message":"' . base64_encode($message) . '","controlId":"' . $controlId . '"}]}';
        $authorization = base64_encode($username . ":" . $password);
        $headers = array('Content-type: application/json', 'Authorization: Basic ' . $authorization);
        return $res = self::makeCurlRequest($documentEndpoint, $headers, 1, $json);
    }

    public function results() {

        $path = public_path();
        $username = $this->username;
        $password = $this->password;
        $documentEndpoint = $this->documentEndpoint . "/rest/results/v1/retrieval/getResults/";
        $request = '{"resultServiceType": "HL7","providerAccounts": [{"providerAccountName": "' . $this->sendingFacility . '","providerName": "' . $this->receivingFacility . '"}],"requestParameters": [{"parameterName": "maxMessages","parameterValue": "50"}]}';
        $authorization = base64_encode($username . ":" . $password);
        $headers = array('Content-type: application/json', 'Authorization: Basic ' . $authorization);
        $res = self::makeCurlRequest($documentEndpoint, $headers, 1, $request);
        $obj = json_decode($res);
        d($obj,1);
        $requestId = $obj->requestId;
        foreach ($obj->results as $key => $row) {
            $message = base64_decode($row->hl7Message->message);
            $ackResponse = $this->acknowledgement($requestId, $row->hl7Message->controlId);
            $arr = explode("\r", $message);
            $pid = explode("|", $arr[1]);
            $pid2 = str_replace('PID', '', $pid[2]);
            $pid2 = str_replace('P', '', $pid2);
            $order_id = $pid2;

            $order = Orders::find($order_id);
            //d($order);
            //continue;
            if (count($order) == 1) {
                $obxCount = count($arr) - 2;
                $obx = explode("|", $arr[$obxCount]);
                $obx5 = explode("^", $obx[5]);
                $pdf = base64_decode($obx5[4]);
                $fileName = $order_id . '.pdf';
                $fp = fopen($path . '/uploads/orders/results/' . $fileName, 'w+');
                fwrite($fp, $pdf);
                fclose($fp);

                $modelResult = new OrdersResults();
                $modelResult->file = $fileName;
                $modelResult->response = $message;
                $modelResult->order_id = $order_id;
                $modelResult->created_at = date('Y-m-d H:i:s');
                $modelResult->save();
            }
        }
        //die();
        //d($obj, 1);
//        $sql = "select * from orders_documents where order_id not in (select order_id from orders_results);";
//        $orders = DB::select($sql);
        // d($orders, 1);
    }

    public function index() {

        $username = $this->username;
        $password = $this->password;
        $documentEndpoint = $this->documentEndpoint . '/rest/orders/v1/document';

        //$orders = Orders::get();
        // $orders = DB::select("select id from orders where id not in (select order_id from orders_documents)");
        //SEA  248,249,250
        $orders = DB::select("select id from orders where id in (357,358)");

        $i = 0;
        foreach ($orders as $order) {

            $path = public_path();

            $file = $path . '/uploads/quest/orders/' . $order->id . '.hl7';

            if (file_exists($file) == 1) {

                $message = file_get_contents($file, 'r');

                $array = explode("\r", $message);
                // d($array);
                $orderPrefix = Config::get('params.order_prefix');
                // $array[0] = "MSH|^~\&||97513297|PSC|MET|" . date('YmdHi') . "||ORM^O01|" . $orderPrefix . $order->id . "|P|2.3";
                $message = implode("\r", $array);
                $message = base64_encode($message);
                $request = '{
                            "orderHl7": "' . $message . '"
                        }';

                $authorization = base64_encode($username . ":" . $password);
                $headers = array('Content-type: application/json', 'Authorization: Basic ' . $authorization);
                $res = self::makeCurlRequest($documentEndpoint, $headers, 1, $request);
                $responseArray = json_decode($res);
                $documentData = $responseArray->orderSupportDocuments[0]->documentData;
                $decoded = base64_decode($documentData);
                $decoded = base64_decode($decoded);

                $fp = fopen($path . '/uploads/quest/orders/documents/' . $order->id . '.pdf', 'w+');
                fwrite($fp, $decoded);
                fclose($fp);

                $model = new OrdersDocuments();
                $model->order_id = $order->id;
                $model->created_at = date('Y-m-d H:i:s');
                $model->response = $res;
                $model->save();
            }
            $i++;
        }
    }

    public static function makeCurlRequest($documentEndpoint, $headers, $post = 0, $encodeMessage) {

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $documentEndpoint);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);

        if ($post == 1) {
            curl_setopt($ch, CURLOPT_POST, 1);
            curl_setopt($ch, CURLOPT_POSTFIELDS, $encodeMessage);
        }
        $output = curl_exec($ch);
        curl_close($ch);
        return $output;
    }

}
