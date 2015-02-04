<?php
namespace DbMau\Model;

 use Zend\Db\TableGateway\TableGateway;
 use Zend\Db\Sql\Select;

 class SanPhamTable
 {
     protected $tableGateway;
     protected $select;

     public function __construct(TableGateway $tableGateway)
     {
         $this->tableGateway = $tableGateway;
         $this->select = new Select();
     }

     public function fetchAll()
     {
        /*$resultSet = $this->tableGateway->select(function(Select $select) {
            $select->join('don_vi_tinh', 'san_pham.id_don_vi_tinh = don_vi_tinh.id_don_vi_tinh');
            //$select->join('don_vi_tinh', 'san_pham.id_don_vi_tinh = don_vi_tinh.id_don_vi_tinh', array('id_don_vi_tinh'));
        });
        return $resultSet;*/

        $sqlSelect = $this->tableGateway->getSql()->select();
        $sqlSelect->join('don_vi_tinh', 'san_pham.id_don_vi_tinh = don_vi_tinh.id_don_vi_tinh', array('id_don_vi_tinh','ten_don_vi_tinh'), 'left');
        $sqlSelect->join('loai', 'san_pham.id_loai = loai.id_loai', array('id_loai','ten_loai'), 'left');
        //$resultSet = $this->tableGateway->selectWith($sqlSelect);
        $statement = $this->tableGateway->getSql()->prepareStatementForSqlObject($sqlSelect);
        $resultSet = $statement->execute();
        return $resultSet;

         /*$resultSet = $this->tableGateway->select();
         return $resultSet;*/
     }

     public function getSanPham($id)
     {
         $id  = (int) $id;
         $rowset = $this->tableGateway->select(array('id_san_pham' => $id));
         $row = $rowset->current();
         if (!$row) {
             throw new \Exception("Could not find row $id");
         }
         return $row;
     }

     public function saveSanPham(SanPham $sanPham)
     {
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
         }
     }

     public function deleteSanPham($id)
     {
         $this->tableGateway->delete(array('id_san_pham' => (int) $id));
     }
 }