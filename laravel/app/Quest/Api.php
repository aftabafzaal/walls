<?php

namespace App\Quest;

class Api {

    public static function submitOrder($replaces, $order_id) {


        $username = env('QUEST_USERNAME');
        $password = env('QUEST_PASSWORD');
        $documentEndpoint = env('QUEST_END_POINT');

        $replaces['SENDING_APPICATION'] = env('QUEST_SENDING_APPICATION');
        $replaces['SENDING_FACILITY'] = env('QUEST_SENDING_FACILITY');
        $replaces['RECEIVING_APPLICATION'] = env('QUEST_RECEIVING_APPLICATION');
        $replaces['RECEIVING_FACILITY'] = env('QUEST_RECEIVING_FACILITY');
        $replaces['TIME'] = date('YmdHi');
        $replaces['PROCESSING_ID'] = 'P';
        $replaces['VERSION'] = env('QUEST_VERSION');

        $authorization = base64_encode($username . ":" . $password);
        $headers = array(
            'Content-type: text/plain',
            'Authorization: Basic ' . $authorization,
        );

        $message = file_get_contents(public_path() . '/uploads/quest/sample/order.hl7', 'r');
        $message = self::setTemplate($message, $replaces);
        
        $fp = fopen(public_path() . '/uploads/quest/orders/' . $order_id . '.hl7', 'w');
        fwrite($fp, $message);
        fclose($fp);

        $encodeMessage = base64_encode($message);

        return $response = self::makeCurlRequest($documentEndpoint, $headers, 1, $encodeMessage);
    }

    public static function setTemplate($body, $replaces) {
        foreach ($replaces as $key => $replace) {
            $body = str_replace("{{" . $key . "}}", $replace, $body);
        }
        return $body;
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

        return $output = curl_exec($ch);
        curl_close($ch);
        return $response = base64_decode($output);
        //$info = curl_getinfo($ch);
        //echo "<pre>";
        //
        // echo " <br/>info";
        //print_r($info);
    }

}
