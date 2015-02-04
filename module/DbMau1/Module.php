<?php
namespace DbMau;

use Zend\Mvc\ModuleRouteListener;
use Zend\Mvc\MvcEvent;

use DbMau\Model\SanPham;
use DbMau\Model\SanPhamTable;
use Zend\Db\ResultSet\ResultSet;
use Zend\Db\TableGateway\TableGateway;

class Module
{
    public function onBootstrap(MvcEvent $e)
    {
        $eventManager        = $e->getApplication()->getEventManager();
        $moduleRouteListener = new ModuleRouteListener();
        $moduleRouteListener->attach($eventManager);
    }

    public function getConfig()
    {
        return include __DIR__ . '/config/module.config.php';
    }

    public function getAutoloaderConfig()
    {
        return array(
            'Zend\Loader\StandardAutoloader' => array(
                'namespaces' => array(
                    __NAMESPACE__ => __DIR__ . '/src/' . __NAMESPACE__,
                ),
            ),
        );
    }

    public function getServiceConfig() {
        return array(
            'factories' => array(
                'DbMau\Model\SanPhamTable' => function ($sm) {
                    $dbAdapter = $sm->get('Zend\Db\Adapter\Adapter');
                    $table = new SanPhamTable($dbAdapter); 
                    return $table;
                },
            ),
        );
    }

    /*public function getServiceConfig()
    {
        return array(
            'factories' => array(
                'DbMau\Model\SanPhamTable' =>  function($sm) {
                    $tableGateway = $sm->get('SanPhamTableGateway');
                    $table = new SanPhamTable($tableGateway);
                    return $table;
                },
                'SanPhamTableGateway' => function ($sm) {
                    $dbAdapter = $sm->get('Zend\Db\Adapter\Adapter');
                    $resultSetPrototype = new ResultSet();
                    $resultSetPrototype->setArrayObjectPrototype(new SanPham());
                    return new TableGateway('sanPham', $dbAdapter, null, $resultSetPrototype);
                },
            ),
        );
    }*/
}
