<?php namespace App;
use DB;
use Illuminate\Database\Eloquent\Model;



class Attributesvalues extends Model 
{
    
    protected $table = 'attributes_values';
    
    
    
    public static function getAttributesValues($id){
        $sql="select * from attributes_values where attribute_id = ".$id;
        return $result=DB::select($sql);
    }
    
    public static function getImagesAndColors($product_id){
       $sql="SELECT * FROM products_images AS `pi`
LEFT JOIN attributes_values a ON a.id=`pi`.attribute_value_id
WHERE 
`pi`.attribute_value_id!=0 and
`pi`.product_id=".$product_id;
        return $result=DB::select($sql);
    }
    
        
	//
}