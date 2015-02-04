<?php
  
namespace DbMau\Model;
 
class SanPham {
 
    protected $id_san_pham;
    protected $ten_san_pham;
    protected $id_don_vi_tinh;
    protected $id_loai;
 
    public function __construct(array $options = null) {
        if (is_array($options)) {
            $this->setOptions($options);
        }
    }
 
    public function __set($name, $value) {
        $method = 'set' . $name;
        if (!method_exists($this, $method)) {
            throw new Exception('Invalid Method');
        }
        $this->$method($value);
    }
 
    public function __get($name) {
        $method = 'get' . $name;
        if (!method_exists($this, $method)) {
            throw new Exception('Invalid Method');
        }
        return $this->$method();
    }
 
    public function setOptions(array $options) {
        $methods = get_class_methods($this);
        foreach ($options as $key => $value) {
            $method = 'set' . ucfirst($key);
            if (in_array($method, $methods)) {
                $this->$method($value);
            }
        }
        return $this;
    }
 
    public function getIdSanPham() {
        return $this->id_san_pham;
    }
 
    public function setIdSanPham($id_san_pham) {
        $this->id_san_pham = $id_san_pham;
        return $this;
    }

    public function setTenSanPham($ten_san_pham)
    {
        $this->ten_san_pham=$ten_san_pham;
    }

    public function getTenSanPham()
    {
        return $this->ten_san_pham;
    }

    public function setIdDonViTinh($id_don_vi_tinh)
    {
        $this->id_don_vi_tinh=$id_don_vi_tinh;
    }
    public function getIdDonViTinh()
    {
        return $this->id_don_vi_tinh;
    }

    public function setIdLoai($id_loai)
    {
        $this->id_loai=$id_loai;
    }
    public function getIdLoai()
    {
        return $this->id_loai;
    }
 
}
 
?>



<?php 
/*namespace DbMau\Model;

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
         $this->id     = (!empty($data['id'])) ? $data['id'] : null;
         $this->ten_san_pham = (!empty($data['ten_san_pham'])) ? $data['ten_san_pham'] : null;
         $this->id_don_vi_tinh  = (!empty($data['id_don_vi_tinh'])) ? $data['id_don_vi_tinh'] : null;
         $this->id_loai  = (!empty($data['id_loai'])) ? $data['id_loai'] : null;
     }

         // Add content to these methods:
     public function setInputFilter(InputFilterInterface $inputFilter)
     {
         throw new \Exception("Not used");
     }

     public function getInputFilter()
     {
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

         return $this->inputFilter;
     }
 
     // Add the following method:
     public function getArrayCopy()
     {
         return get_object_vars($this);
     }

 }*/