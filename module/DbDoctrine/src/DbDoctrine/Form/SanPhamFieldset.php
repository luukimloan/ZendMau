<?php

namespace DbDoctrine\Form;

use Doctrine\Common\Persistence\ObjectManager;
use DoctrineModule\Stdlib\Hydrator\DoctrineObject as DoctrineHydrator;
use Zend\Form\Fieldset;
use Zend\InputFilter\InputFilterProviderInterface;

use Zend\Form\Element;
use Zend\Form\Form;
use DbDoctrine\Entity\SanPham;

class SanPhamFieldset extends Fieldset implements InputFilterProviderInterface
{
    public function __construct(ObjectManager $objectManager)
    {
        parent::__construct('san-pham');

        $this->setHydrator(new DoctrineHydrator($objectManager))
             ->setObject(new SanPham());

         $this->add(array(
             'name' => 'idSanPham',
             'type' => 'Hidden',
         ));

         $this->add(array(
             'name' => 'tenSanPham',
             'type' => 'Text',
             'options' => array(
                 'label' => 'Tên sản phẩm',
             ),
             'attributes'=>array(
                'required'=>'required',
                //'class'   => 'h5a-input form-control input-sm',
                'placeholder'=>'Tên sản phẩm',
            ),
         ));
                  

         $this->add(array(
             'name' => 'idLoai',
             'type' => '\Zend\Form\Element\Select',
             'options' => array(
                 'label' => 'Loại',
                 'empty_option'=>'----------Chọn Loại Sản Phẩm----------',
                 'disable_inarray_validator' => true,
             ),
             'attributes'=>array('required'=>'required'),
         ));
       
         $this->add(array(
             'name' => 'idDonViTinh',
             'type' => '\Zend\Form\Element\Select',
             'options' => array(
                 'label' => 'Chọn Đơn Vị Tính',
                 'empty_option'=>'----------Chọn Đơn Vị Tính----------',
                 'disable_inarray_validator' => true,                 
             ),
             'attributes'=>array('required'=>'required'),
         ));
    }

    public function getInputFilterSpecification()
    {
        return array(
          
        );
    }
}