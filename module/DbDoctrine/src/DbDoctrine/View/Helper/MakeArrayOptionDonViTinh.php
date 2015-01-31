<?php
namespace DbDoctrine\View\Helper;

use Zend\View\Helper\AbstractHelper;

class MakeArrayOptionDonViTinh extends AbstractHelper{
	public function __invoke($mangs){
		$dvt=array();
		if(!$mangs)
		{
			return $dvt;
		}
		foreach ($mangs as $mang) 
		{			
			$dvt[$mang->getIdDonViTinh()]=$mang->getTenDonViTinh();
		}	
		return $dvt;
	}
}
?>