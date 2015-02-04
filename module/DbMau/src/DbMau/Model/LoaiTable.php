<?php
namespace DbMau\Model;

 use Zend\Db\TableGateway\TableGateway;

 class LoaiTable
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
     public function getLoai($id)
     {
         /*$id  = (int) $id;
         $rowset = $this->tableGateway->select(array('id_san_pham' => $id));
         $row = $rowset->current();
         if (!$row) {
             throw new \Exception("Could not find row $id");
         }
         return $row;*/
     }

     public function saveLoai(SanPham $sanPham)
     {/*
         $data = array(
             'ten_san_pham'  => $sanPham->ten_san_pham,
             'id_don_vi_tinh'=>$sanPham->id_don_vi_tinh,
             'id_loai'=>$sanPham->id_loai,
         );

         $id = (int) $sanPham->id_san_pham;
         if ($id == 0) {
             $this->tableGateway->insert($data);
         } else {
             if ($this->getSanPham($id)) {
                 $this->tableGateway->update($data, array('id_san_pham' => $id));
             } else {
                 throw new \Exception('Album id does not exist');
             }
         }*/
     }

     public function deleteLoai($id)
     {
        // $this->tableGateway->delete(array('id_san_pham' => (int) $id));
     }
}