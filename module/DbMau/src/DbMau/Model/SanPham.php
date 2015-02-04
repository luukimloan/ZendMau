<?php 
namespace DbMau\Model;

use Zend\InputFilter\InputFilter;
use Zend\InputFilter\InputFilterAwareInterface;
use Zend\InputFilter\InputFilterInterface;

 class SanPham
 {
    public $id_san_pham;
    public $ten_san_pham;
    public $id_don_vi_tinh;
    public $id_loai;
    protected $inputFilter;

     public function exchangeArray($data)
     {
         $this->id_san_pham     = (!empty($data['id_san_pham'])) ? $data['id_san_pham'] : null;
         $this->ten_san_pham = (!empty($data['ten_san_pham'])) ? $data['ten_san_pham'] : null;
         $this->id_don_vi_tinh  = (!empty($data['id_don_vi_tinh'])) ? $data['id_don_vi_tinh'] : null;
         $this->id_loai     = (!empty($data['id_loai'])) ? $data['id_loai'] : null;
     }

         
     public function setInputFilter(InputFilterInterface $inputFilter)
     {
         throw new \Exception("Not used");
     }

     public function getInputFilter()
     {/*
         if (!$this->inputFilter) {
             $inputFilter = new InputFilter();

             $inputFilter->add(array(
                 'name'     => 'id_san_pham',
                 'required' => true,
                 'filters'  => array(
                     array('name' => 'Int'),
                 ),
             ));

             $inputFilter->add(array(
                 'name'     => 'ten_san_pham',
                 'required' => true,
                 'filters'  => array(
                     array('name' => 'StripTags'),
                     array('name' => 'StringTrim'),
                 ),
                 'validators' => array(
                     array(
                         'name'    => 'StringLength',
                         'options' => array(
                             'encoding' => 'UTF-8',
                             'min'      => 1,
                             'max'      => 100,
                         ),
                     ),
                 ),
             ));

             $inputFilter->add(array(
                 'name'     => 'id_don_vi_tinh',
                 'required' => true,
                 'filters'  => array(
                     array('name' => 'Int'),
                 ),
             ));


             $inputFilter->add(array(
                 'name'     => 'id_loai',
                 'required' => true,
                 'filters'  => array(
                     array('name' => 'Int'),
                 ),
             ));

             $this->inputFilter = $inputFilter;
         }

         return $this->inputFilter;*/
     }
 
     public function getArrayCopy()
     {
         return get_object_vars($this);
     }

 }