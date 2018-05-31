<?php namespace App;

use Illuminate\Database\Eloquent\Model;
use DB;
class Products extends Model {

	//
    
    
    public static function getProducts($search=array())
    {
        $subSql="p.deleted=0";
        if(isset($search['key']))
        {
            $subSql.=" and u.key='".$search['key']."'";
        }
        
        if(isset($search['type']))
        {
            $subSql.=" and p.type='".$search['type']."'";
        }
        
        $sql="select p.id as id,p.sku as sku,p.name as name,p.image,p.teaser as teaser,p.price,p.salePrice,p.sale,p.description,p.keywords as keywords,u.key"
                . " from products as `p` left join urls as u on u.type_id=p.id "
                . "where "
                . $subSql;
        
        return DB::select($sql);
    } 

}