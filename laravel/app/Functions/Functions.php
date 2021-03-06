<?php

namespace App\Functions;

use Mail;

class Functions {

    public static function prettyJson($inputArray, $statusCode) {
        return response()->json($inputArray, $statusCode, array('Content-Type' => 'application/json'), JSON_PRETTY_PRINT);
    }

    public static function saveImage($file, $destinationPath, $destinationPathThumb = '') {
        $extension = $file->getClientOriginalExtension();
        $fileName = rand(111, 999) . time() . '.' . $extension;
        $image = $destinationPath . '/' . $fileName;
        $upload_success = $file->move($destinationPath, $fileName);
        //Functions::saveThumbImage($image,'fit',$destinationPath.$fileName);
        return $fileName;
    }

    // remove string from any length and concatinate three dots at end any string condition needle start to end 
    public static function stringTrim($string = '', $needle = 0, $start = 0, $end = 0) {
        return (strlen($string) > $needle) ? substr($string, $start, $end) . '...' : $string;
    }

    public static function makeOrderEmailTemplate($orders, $addresses) {
        //d($order,1);
        $template = "";

        return view('email.order', compact('orders', 'addresses'));
        //die('aaa');
    }

    public static function generateRandomString($length = 10) {
        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $charactersLength = strlen($characters);
        $randomString = '';
        for ($i = 0; $i < $length; $i++) {
            $randomString .= $characters[rand(0, $charactersLength - 1)];
        }
        return $randomString;
    }

    public static function setEmailTemplate($contentModel, $replaces) {
        $data['body'] = $contentModel[0]->body;
        $data['subject'] = $contentModel[0]->subject;
        $data['title'] = $contentModel[0]->title;
        foreach ($replaces as $key => $replace) {
            $data['body'] = str_replace("%%" . $key . "%%", $replace, $data['body']);
        }

        return $data;
    }

    public static function sendEmail($email, $subject, $body, $header = '', $from = "customerservice@newcenturylabs.com", $cc = "", $bcc = "") {

        if(env('APP_ENV')=='local'){
            return false;
        }
        
        
        
        
        $data['to'] = $email;
        $data['body'] = $body;
        $data['subject'] = $subject;


        $headers = "MIME-Version: 1.0" . "\r\n";
        $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
        $headers .= 'From: <' . $from . '>' . "\r\n";
        // $headers .= 'Cc: myboss@example.com' . "\r\n";
        return mail($email, $subject, $body, $headers);

        
        /* return Mail::send('emails.template', $data, function($message) use ($data) {
                    $message->SMTPOptions = array('ssl' => array('verify_peer' => false,
                            'verify_peer_name' => false,
                            'allow_self_signed' => true
                        )
                    );
                    $message->to($data['to'])->subject($data['subject']);
                });
                */


        // $body = "<title></title><style></style></head><body>" . $body . "</body></html>";
        // 
    }

    public static function makeCurlRequest($url) {
        $curl = curl_init();
        curl_setopt_array($curl, array(
            CURLOPT_RETURNTRANSFER => 1,
            CURLOPT_URL => $url,
                )
        );
        $resp = curl_exec($curl);
        curl_close($curl);
        return $resp;
    }

    public static function setTemplate($body, $replaces) {

        $replaces["asset('')"] = asset("");
        $replaces["url('')"] = url("");
        foreach ($replaces as $key => $replace) {
            // $key=str_replace(" ", "", $key);
            $body = str_replace("{{" . $key . "}}", $replace, $body);
        }
        return $body;
    }

    public static function getCategories($allCategories) {
        $categories = array();

        foreach ($allCategories as $category) {
            if ($category->parent_id == 0) {
                $categories[$category->id]['name'] = $category->name;
            } else {
                $categories[$category->parent_id]['categories'][$category->id] = $category->name;
            }
        }
        return $categories;
    }

    public static function getPrice($user, $product) {

        $price = $product->price;
        if ($product->sale == 1 && $product->price > $product->salePrice) {
            $price = $product->salePrice;
        }

        if (isset($user->id)) {
            $role = \App\Role::find($user->role_id);
            if (strtolower(trim($role->role)) == 'doctor') {
                $price = $product->priceForDoctors;
            }
        }


        return $price;
    }

    function slugify($text) {
        // replace non letter or digits by -
        $text = preg_replace('~[^\pL\d]+~u', '-', $text);

        // transliterate
        $text = iconv('utf-8', 'us-ascii//TRANSLIT', $text);

        // remove unwanted characters
        $text = preg_replace('~[^-\w]+~', '', $text);

        // trim
        $text = trim($text, '-');

        // remove duplicate -
        $text = preg_replace('~-+~', '-', $text);

        // lowercase
        $text = strtolower($text);

        if (empty($text)) {
            return 'n-a';
        }

        return $text;
    }

}
