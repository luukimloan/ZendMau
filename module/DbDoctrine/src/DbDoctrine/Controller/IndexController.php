<?php namespace DbDoctrine\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;
use DoctrineORMModule\Paginator\Adapter\DoctrinePaginator as DoctrineAdapter;
use Zend\ServiceManager\ServiceManager;
use DbDoctrine\Form\DbDoctrineForm;
use DbDoctrine\Form\CreateSanPhamForm;
use DbDoctrine\Form\UpdateSanPhamForm;
use DbDoctrine\Entity\SanPham;

class IndexController extends AbstractActionController
{
    private $entityManager;
  
    public function getEntityManager()
    {
        if(!$this->entityManager)
        {
            $this->entityManager=$this->getServiceLocator()->get('Doctrine\ORM\EntityManager');
        }
        return $this->entityManager;
    }

    public function indexAction()
    {
        $entityManager=$this->getEntityManager();
        $sanPhams=$entityManager->getRepository('DbDoctrine\Entity\SanPham')->findAll();
        return array(
          'sanPhams'=>$sanPhams,
        ); 
    }

    public function addAction()
    {
        $entityManager=$this->getEntityManager();
        $sanPham=new SanPham();
        $form= new CreateSanPhamForm($entityManager);
        $form->bind($sanPham);

        $donViTinhs=$entityManager->getRepository('DbDoctrine\Entity\DonViTinh')->findAll();
        $loais=$entityManager->getRepository('DbDoctrine\Entity\Loai')->findAll();

        $request = $this->getRequest();
        if($request->isPost()){
            $form->setData($request->getPost());
            if($form->isValid())
            {
                $entityManager->persist($sanPham);
                $entityManager->flush();
                $this->flashMessenger()->addSuccessMessage('Thêm sản phẩm thành công!');
                return $this->redirect()->toRoute('db_doctrine/crud',array('action'=>'index'));
            }
        }

        return array(
          'form' => $form,
          'donViTinhs'=>$donViTinhs,
          'loais'=>$loais,
        );
    }

    public function editAction()
    {
        $id = (int) $this->params()->fromRoute('id', 0);
        if (!$id) {
            return $this->redirect()->toRoute('db_doctrine');
        }
        $entityManager=$this->getEntityManager();
        $sanPham = $entityManager->getRepository('DbDoctrine\Entity\SanPham')->find($id);
        $form = new UpdateSanPhamForm($entityManager);
        $form->bind($sanPham);

        $donViTinhs=$entityManager->getRepository('DbDoctrine\Entity\DonViTinh')->findAll();
        $loais=$entityManager->getRepository('DbDoctrine\Entity\Loai')->findAll();

        $request = $this->getRequest();        
        if ($request->isPost()) {            
            $form->setData($request->getPost()); 
            if ($form->isValid()) 
            {
                $entityManager->flush();                
                $this->flashMessenger()->addMessage('Cập nhật thành công!');
                return $this->redirect()->toRoute('db_doctrine');
            }
        }

        return array(
            'form' => $form,            
            'donViTinhs'=>$donViTinhs,
            'loais'=>$loais,
            'id'=>$id,
            'kiemTraTenSanPham'=>0,
        );
    }
	
    public function deleteAction()
    {
        $entityManager=$this->getEntityManager();      
        $id=(int)$this->params()->fromRoute('id',0);
        if(!$id)
        {
            return $this->redirect()->toRoute('db_doctrine');
        }

        $sanPham=$entityManager->getRepository('DbDoctrine\Entity\SanPham')->find($id);
        if($sanPham)
        {
            $entityManager->remove($sanPham);      
            $entityManager->flush();             
        }
        else
        {
            $this->flashMessenger()->addMessage('Không tìm thấy sản phẩm!');
        }             
        return $this->redirect()->toRoute('db_doctrine');
    }
}
