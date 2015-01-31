<?php
namespace DbDoctrine\Form;

use Doctrine\Common\Persistence\ObjectManager;
use DoctrineModule\Stdlib\Hydrator\DoctrineObject as DoctrineHydrator;
use Zend\Form\Form;

use DbDoctrine\Form\SanPhamFieldset;

class UpdateSanPhamForm extends Form
{

    public function __construct(ObjectManager $objectManager)
    {
        parent::__construct('update-san-pham-form');

        $this
            ->setAttribute('method', 'post')
            ->setHydrator(new DoctrineHydrator($objectManager))
        ;

        $sanPhamFieldset = new SanPhamFieldset($objectManager);
        $sanPhamFieldset->setUseAsBaseFieldset(true);
        $this->add($sanPhamFieldset);

        $this->add(array(
            'name' => 'submit',
            'attributes' => array(
                'type'  => 'submit',
                'value' => 'Lưu',
                'class' => 'ui blue button',
            ),
        ));
    }
}