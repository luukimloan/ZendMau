<?php
namespace DbMau\Model;
 
use Zend\Db\Adapter\Adapter;
use Zend\Db\TableGateway\AbstractTableGateway;
use Zend\Db\Sql\Select;
 
class DonViTinhTable extends AbstractTableGateway {
    protected $table = "don_vi_tinh";
    public function __construct(Adapter $adapter) {
        $this->adapter = $adapter;
    }

    public function fetchAll() {
        $resultSet = $this->select(function (Select $select) {
            $select->order('ten_don_vi_tinh ASC');
        });
 
        $entities = array();
        foreach ($resultSet as $row) {
            $entity = new Entity\DonViTinh();
            $entity->setIdDonViTinh($row->id_don_vi_tinh);
            $entity->setTenDonViTinh($row->ten_don_vi_tinh);
            $entities[] = $entity;
        }
        return $entities;
    }
 
    public function getDonViTinh($id) {
        $row = $this->select(array('id' => (int) $id))->current();
 
        if (!$row) {
            return false;
        }
 
        $donViTinhs = new Entity\DonViTinh(array(
            'idDonViTinh' => $row->id_don_vi_tinh,
            'tenDonViTinh' => $row->ten_don_vi_tinh,
        ));
 
        return $donViTinh;
    }
 
    public function saveDonViTinh(Entity\DonViTinh $donViTinh) {
        $data = array(
            'donViTinh' => $donViTinh->getIdDonViTinh(),
            'tenDonViTinh' => $donViTinh->getTenDonViTinh(),
        );
 
        $id = (int) $donViTinh->getIdDonViTinh();
 
        if ($id == 0) {
            $data['tenDonViTinh'] = 'DVT';
            if (!$this->insert($data)) {
                return false;
            }
            return $this->getLastInsertValue();

        } elseif ($this->getDonViTinh($id)) {
            if (!$this->update($data, array('id' => $id))) {
                return false;
            }
            return true;
        } else {
            return false;
        }
    }
 
    public function deleteDonViTinh($id) {
        return $this->delete(array('id' => (int) $id));
    }
}
?>