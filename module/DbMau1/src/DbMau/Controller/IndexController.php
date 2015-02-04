<?php
namespace DbMau\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;
use DbMau\Model\SanPhamTable;
//use DbMau\Model\Entity\SanPham;

use Zend\Db\Sql\Select;
use Zend\Db\Adapter\Driver\ResultInterface;
use Zend\Db\ResultSet\ResultSet;
use Zend\Db\Adapter\Adapter;
use Zend\Db\TableGateway\AbstractTableGateway;

use DbMau\Model\SanPham;
use DbMau\Form\SanPhamForm; 

class IndexController extends AbstractActionController
{
    protected $sanPhamTable;

    public function getSanPhamTable() {
        if (!$this->sanPhamTable) {
            $sm = $this->getServiceLocator();
            $this->sanPhamTable = $sm->get('DbMau\Model\SanPhamTable');
        }
 
        return $this->sanPhamTable;
    }

    /*protected $adapter;
    public function getAdapter()
    {
       if (!$this->adapter) {
          $sm = $this->getServiceLocator();
          $this->adapter = $sm->get('Zend\Db\Adapter\Adapter');
       }
       return $this->adapter;
    }*/

    public function indexAction() 
    {
        return new ViewModel(array(
            'sanPhams' => $this->getSanPhamTable()->fetchAll(),
        ));
    }

    public function addAction()
    {
        $form = new SanPhamForm();
        $form->get('submit')->setValue('Add');
        $request = $this->getRequest();
        if ($request->isPost()) {
            $sanPham = new SanPham();
            $form->setInputFilter($sanPham->getInputFilter());
            $form->setData($request->getPost());

            if ($form->isValid()) {
                $sanPham->setOptions($form->getData());
                $this->getSanPhamTable()->saveSanPham($sanPham);

                $this->flashMessenger()->addSuccessMessage('Thêm sản phẩm thành công!');
                return $this->redirect()->toRoute('db_mau');
            }
        }
        return array('form' => $form);
    }



    public function editAction()
    {
    }
	
    public function deleteAction()
    {
    }
}
