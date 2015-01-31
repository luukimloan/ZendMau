<?php
namespace DbDoctrine\Form;

use Doctrine\Common\Persistence\ObjectManager;
use DoctrineModule\Stdlib\Hydrator\DoctrineObject as DoctrineHydrator;
use Zend\Form\Form;
use DbDoctrine\Form\SanPhamFieldset;

use Zend\InputFilter\InputFilterProviderInterface;
use Zend\Form\Element;
use Zend\InputFilter\InputFilter;


class CreateSanPhamForm extends Form
{
    public function __construct(ObjectManager $objectManager)
    {
        parent::__construct('create-san-pham');
        
        $this->setHydrator(new DoctrineHydrator($objectManager));
        $sanPhamFieldset = new SanPhamFieldset($objectManager);
        $sanPhamFieldset->setUseAsBaseFieldset(true);
        $this->add($sanPhamFieldset);        

        $this->add(array(
             'name' => 'submit',
             'type' => 'Submit',
             'attributes' => array(
                 'value' => 'Thêm',
                 'id' => 'submitbutton',
             ),
         ));        
    }
        
}
?>