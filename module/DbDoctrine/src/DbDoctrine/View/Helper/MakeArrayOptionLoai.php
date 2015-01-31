<?php
namespace DbDoctrine\View\Helper;

use Zend\View\Helper\AbstractHelper;

class MakeArrayOptionLoai extends AbstractHelper{
	public function __invoke($mangs){
		$dvt=array();
		if(!$mangs)
		{
			return $dvt;
		}
		foreach ($mangs as $mang) 
		{			
			$dvt[$mang->getIdLoai()]=$mang->getTenLoai();
		}	
		return $dvt;
	}
}
?>