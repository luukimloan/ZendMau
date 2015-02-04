<?php
namespace DbMau\Model;

 use Zend\Db\TableGateway\TableGateway;

 class SanPhamTable
 {
     protected $tableGateway;

     public function __construct(TableGateway $tableGateway)
     {
         $this->tableGateway = $tableGateway;
     }

     public function fetchAll()
     {
         $resultSet = $this->tableGateway->select();
         return $resultSet;
     }

     public function getSanPham($id_san_pham)
     {
         $id_san_pham  = (int) $id_san_pham;
         $rowset = $this->tableGateway->select(array('id_san_pham' => $id_san_pham));
         $row = $rowset->current();
         if (!$row) {
             throw new \Exception("Could not find row $id_san_pham");
         }
         return $row;
     }

     public function saveSanPham(SanPham $sanPham)
     {
         $data = array(
             'ten_san_pham' => $sanPham->ten_san_pham,
             'id_don_vi_tinh'  => $sanPham->id_don_vi_tinh,
             'id_loai'=>$sanPham->id_loai,
         );

         $id_san_pham = (int) $sanPham->id_san_pham;
         if ($id_san_pham == 0) {
             $this->tableGateway->insert($data);
         } else {
             if ($this->getSanPham($id_san_pham)) {
                 $this->tableGateway->update($data, array('id_san_pham' => $id_san_pham));
             } else {
                 throw new \Exception('SanPham id does not exist');
             }
         }
     }

     public function deleteSanPham($id_san_pham)
     {
         $this->tableGateway->delete(array('id_san_pham' => (int) $id_san_pham));
     }
 }