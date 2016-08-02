<?php
class Model_Base_Page extends Model_Base_Abstract
{
	public function find($req){		
		try{
			$debug='';
			if(isset($_GET['debug']) && 'none'==$_GET['debug']){
				$debug='_debug';
			}
			$stmt = $this->_db->prepare("CALL sp_site_page_find{$debug}(:p_brand, :p_productId, :p_categoryId)");
			$stmt->bindParam('p_brand', $req['brand_name'], PDO::PARAM_STR);
			$stmt->bindParam('p_productId', $req['product_id'], PDO::PARAM_INT);
			$stmt->bindParam('p_categoryId', $req['category_id'], PDO::PARAM_INT);
            $stmt->execute();
			
			return $stmt->fetch();
		}
		catch(Exception $e){
			Model_Redis::getInstance()->monitorDaily(array('type'=>'fe_db_exception','code'=>-1,'info'=>array('store'=>'sp_site_page_find','err'=>$e->getMessage(),'date'=>date("Y-m-d H:i:s"))));
			throw new Zend_Exception($e);
		}
	}
}
?>