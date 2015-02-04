<?php 
namespace DbMau\Model;

use Zend\InputFilter\InputFilter;
use Zend\InputFilter\InputFilterAwareInterface;
use Zend\InputFilter\InputFilterInterface;

 class DonViTinh
 {
    public $id_don_vi_tinh;
    public $ten_don_vi_tinh;
    protected $inputFilter;

     public function exchangeArray($data)
     {
         $this->id_don_vi_tinh = (!empty($data['id_don_vi_tinh'])) ? $data['id_don_vi_tinh'] : null;
         $this->ten_don_vi_tinh  = (!empty($data['ten_don_vi_tinh'])) ? $data['ten_don_vi_tinh'] : null;         
     }

     public function setInputFilter(InputFilterInterface $inputFilter)
     {
         throw new \Exception("Not used");
     }

     public function getInputFilter()
     {
         if (!$this->inputFilter) {
             $inputFilter = new InputFilter();

             $inputFilter->add(array(
                 'name'     => 'id_don_vi_tinh',
                 'required' => true,
                 'filters'  => array(
                     array('name' => 'Int'),
                 ),
             ));

             $inputFilter->add(array(
                 'name'     => 'ten_don_vi_tinh',
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

             $this->inputFilter = $inputFilter;
         }

         return $this->inputFilter;
     }
 
     public function getArrayCopy()
     {
         return get_object_vars($this);
     }

 }