<?php
  
namespace DbMau\Model\Entity;
 
class DonViTinh {
 
    protected $id_don_vi_tinh;
    protected $ten_don_vi_tinh;
 
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

    public function setIdDonViTinh($id_don_vi_tinh)
    {
        $this->id_don_vi_tinh=$id_don_vi_tinh;
    }
    public function getIdDonViTinh()
    {
        return $this->id_don_vi_tinh;
    }

    public function setTenDonViTinh($ten_don_vi_tinh)
    {
        $this->ten_don_vi_tinh=$ten_don_vi_tinh;
    }
    public function getTenDonViTinh()
    {
        return $this->ten_don_vi_tinh;
    }
 
}
 
?>