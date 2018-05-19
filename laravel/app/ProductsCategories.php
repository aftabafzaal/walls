<?php 
namespace App;
use DB;
use Illuminate\Database\Eloquent\Model;

class ProductsCategories extends Model 
{
    protected $table = 'products_categories';
    
    
    
    public static function getBundleCategories($product_id=0){
        
        $sqlSql="";
        if($product_id>0){
            $sqlSql=" and pc.product_id=".$product_id;            
        }
        
        $sql="select p.id,pc.category_id,c.name,c.parent_id,parent.name as category from products_categories pc "
                . "left join products p on p.id=pc.product_id "
                . "left join categories c on c.id=pc.category_id "
                . "left join categories parent on c.parent_id=parent.id "
                . "where p.type='bundle'".$sqlSql;
        return DB::select($sql);
    }
}