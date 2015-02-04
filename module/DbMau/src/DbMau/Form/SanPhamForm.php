<?php
namespace DbMau\Form;

use Zend\Form\Form;

 class SanPhamForm extends Form
 {
     public function __construct($name = null) {
        parent::__construct('san-pham');
 
        $this->add(array(
             'name' => 'id_san_pham',
             'type' => 'Hidden',
         ));
 
        $this->add(array(
             'name' => 'ten_san_pham',
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
             'name' => 'id_loai',
             'type' => '\Zend\Form\Element\Select',
             'options' => array(
                 'label' => 'Loại',
                 'empty_option'=>'----------Chọn Loại Sản Phẩm----------',
                 'disable_inarray_validator' => true,
             ),
             'attributes'=>array('required'=>'required'),
        ));

        $this->add(array(
             'name' => 'id_don_vi_tinh',
             'type' => '\Zend\Form\Element\Select',
             'options' => array(
                 'label' => 'Đơn Vị Tính',
                 'empty_option'=>'----------Chọn Đơn Vị Tính----------',
                 'disable_inarray_validator' => true,
             ),
             'attributes'=>array('required'=>'required'),
        ));
 
        $this->add(array(
            'name' => 'submit',
            'type' => 'Submit',
            'attributes' => array(
                'value' => 'Thêm sản phẩm',
                'id' => 'submitbutton',
            ),
        ));
    }
 }