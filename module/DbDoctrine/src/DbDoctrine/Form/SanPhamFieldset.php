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
           'type' => 'DoctrineModule\Form\Element\ObjectSelect',
           'options' => array(
                'object_manager'     => $objectManager,
                'target_class'       => 'DbDoctrine\Entity\Loai',
                'label' => 'Loại',
                'value_options' => $this->getLoaiOptions($objectManager)
            ),
            'attributes' => array(
                'required' => 'required'
            )
        ));
    
         $this->add(array(
           'name' => 'idDonViTinh',
           'type' => 'DoctrineModule\Form\Element\ObjectSelect',
           'options' => array(
                'object_manager'     => $objectManager,
                'target_class'       => 'DbDoctrine\Entity\DonViTinh',
                'label' => 'Đơn Vị Tính',
                'value_options' => $this->getDonViTinhOptions($objectManager)
            ),
            'attributes' => array(
                'required' => 'required'
            )
        ));
    }

    public function getInputFilterSpecification()
    {
        return array(          
        );
    }

    public function getLoaiOptions($objectManager)
    {
        $options = array();
        $query = $objectManager->createQuery('select l from DbDoctrine\Entity\Loai l');
        $mangs = $query->getResult();
        foreach($mangs as $mang){
            $options[$mang->getIdLoai()]=$mang->getTenLoai();
        }
        return $options;
    }

    public function getDonViTinhOptions($objectManager)
    {
        $options = array();
        $query = $objectManager->createQuery('select dvt from DbDoctrine\Entity\DonViTinh dvt');
        $mangs = $query->getResult();
        foreach($mangs as $mang){
            $options[$mang->getIdDonViTinh()]=$mang->getTenDonViTinh();
        }
        return $options;
    }
}