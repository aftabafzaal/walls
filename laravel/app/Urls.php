<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Urls extends Model {

    //
    protected $table = 'urls';

    public static function saveUrl($input) {
        //d($input,1);
        $id = $input['type_id'];
        $type = $input['type'];
        
        if (Urls::where('type', '=', $type)->where('type_id', '=', $id)->exists()) {
            $urls = Urls::where('type_id', $id)->first();
            Urls::where('id', $urls->id)->update(['key' => $input['key']]);
        } else {
            $url = new Urls;
            $url->type = $input['type'];
            $url->type_id = $input['type_id'];
            $url->key = $input['key'];
            $url->save();
            return $url->id;
        }
    }

    public static function deleteUrl($type, $id) {
        Urls::where('type', '=', $type)->where('type_id', '=', $id)->delete();
    }

}
