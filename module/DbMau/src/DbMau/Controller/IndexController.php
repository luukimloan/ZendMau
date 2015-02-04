<?php
namespace DbMau\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;
use DbMau\Model\SanPham; 
use DbMau\Model\SanPhamTable;           
use DbMau\Form\SanPhamForm;   
use Zend\Db\Sql\Sql; 

use DbMau\Model\DonViTinh;
use DbMau\Model\DonViTinhTable;
use DbMau\Model\Loai;
use DbMau\Model\LoaiTable;
use Zend\Db\ResultSet\ResultSet;
use Zend\Db\TableGateway\TableGateway;
use Zend\Db\Sql\Select;

class IndexController extends AbstractActionController
{

    protected $sanPhamTable;
    protected $donViTinhTable;

    protected $dbAdapter;
    
    public function getDbAdapter(){
        if (!$this->dbAdapter){
            $sm = $this->getServiceLocator();
            $adapter = $sm->get('ZendDbAdapter');
            $this->dbAdapter = $adapter;
        }
        return $this->dbAdapter;
    }

    public function indexAction()
    {
        /*$select = new \Zend\Db\Sql\Select;
        $select->from('san_pham');
        $select->columns(array());
        $select->join('san_pham', "san_pham.id_don_vi_tinh = don_vi_tinh.id_don_vi_tinh");
         
        echo $select->getSqlString();
        $resultSet = $this->tableGateway->selectWith($select);
       die(var_dump($resultSet));
        return $resultSet; 

foreach ($resultset as $row) {
}       */
        return new ViewModel(array(
            'sanPhams' => $this->getSanPhamTable()->fetchAll(),
        ));
    }

    public function addAction()
    {
        $dbAdapter=$this->getServiceLocator()->get('Zend\Db\Adapter\Adapter');
        $resultSetPrototype= new ResultSet();

        $resultSetPrototype->setArrayObjectPrototype(new DonViTinh());
        $tableGateway= new TableGateway('don_vi_tinh', $dbAdapter, null, $resultSetPrototype);
        $donViTinhTable= new DonViTinhTable($tableGateway);

        $resultSetPrototypeLoai= new ResultSet();
        $resultSetPrototypeLoai->setArrayObjectPrototype(new Loai());
        $tableGatewayLoai= new TableGateway('loai', $dbAdapter, null, $resultSetPrototypeLoai);
        $loaiTable= new LoaiTable($tableGatewayLoai);

        $form = new SanPhamForm();
        $request = $this->getRequest();
        if ($request->isPost()) {
            $sanPham = new SanPham();
            $form->setData($request->getPost());
            if ($form->isValid()) {
                $sanPham->exchangeArray($form->getData());
                $this->getSanPhamTable()->saveSanPham($sanPham);
                $this->flashMessenger()->addSuccessMessage('Thêm sản phẩm thành công!');
                return $this->redirect()->toRoute('db_mau');
            }
        }
        return array(
            'form' => $form,
            'donViTinhs'=>$donViTinhTable->fetchAll(),
            'loais'=>$loaiTable->fetchAll(),
        );
    }

    public function editAction()
    {
        $id = (int) $this->params()->fromRoute('id', 0);
        if(!$id) {
            return $this->redirect()->toRoute('db_mau', array(
                'action' => 'add'
            ));
        }
        $dbAdapter=$this->getServiceLocator()->get('Zend\Db\Adapter\Adapter');
        $resultSetPrototype= new ResultSet();

        $resultSetPrototype->setArrayObjectPrototype(new DonViTinh());
        $tableGateway= new TableGateway('don_vi_tinh', $dbAdapter, null, $resultSetPrototype);
        $donViTinhTable= new DonViTinhTable($tableGateway);

        $resultSetPrototypeLoai= new ResultSet();
        $resultSetPrototypeLoai->setArrayObjectPrototype(new Loai());
        $tableGatewayLoai= new TableGateway('loai', $dbAdapter, null, $resultSetPrototypeLoai);
        $loaiTable= new LoaiTable($tableGatewayLoai);


        $sanPham = $this->getSanPhamTable()->getSanPham($id);

        $form  = new SanPhamForm();
        $form->bind($sanPham);
        $form->get('submit')->setAttribute('value', 'Lưu');

        $request = $this->getRequest();
        if ($request->isPost()) {
            $form->setData($request->getPost());
            if ($form->isValid()) {
                $this->getSanPhamTable()->saveSanPham($form->getData());
                $this->flashMessenger()->addSuccessMessage('Cập nhật sản phẩm thành công!');
                return $this->redirect()->toRoute('db_mau');
            }
        }
        return array(
            'id' => $id,
            'form' => $form,
            'donViTinhs'=>$donViTinhTable->fetchAll(),
            'loais'=>$loaiTable->fetchAll(),
        );
    }
	
    public function deleteAction()
    {
        $id = (int) $this->params()->fromRoute('id', 0);
        if (!$id) {
            return $this->redirect()->toRoute('db_mau');
        }
        $this->getSanPhamTable()->deleteSanPham($id);
        $this->flashMessenger()->addSuccessMessage('Xóa sản phẩm thành công!');
        return $this->redirect()->toRoute('db_mau');
    }

    public function getSanPhamTable()
    {
        if (!$this->sanPhamTable) {
            $sm = $this->getServiceLocator();
            $this->sanPhamTable = $sm->get('DbMau\Model\SanPhamTable');
        }
        return $this->sanPhamTable;
    }
}
