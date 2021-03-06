<?php
namespace DbMau;

// Add these import statements:
use DbMau\Model\SanPham;
use DbMau\Model\SanPhamTable;
use DbMau\Model\DonViTinh;
use DbMau\Model\DonViTinhTable;
use Zend\Db\ResultSet\ResultSet;
use Zend\Db\TableGateway\TableGateway;

use Zend\ModuleManager\ModuleManager; // added for module specific layouts. ericp

// added for Acl  ###################################

use Zend\Mvc\MvcEvent,
    Zend\ModuleManager\Feature\AutoloaderProviderInterface,
    Zend\ModuleManager\Feature\ConfigProviderInterface;

// end: added for Acl   ###################################

//class Module
class Module implements 
    AutoloaderProviderInterface,
    ConfigProviderInterface

{
	
    public function getConfig()
    {
        return include __DIR__ . '/config/module.config.php';
    }	
	
	
	// added for Acl   ###################################
	

    public function onBootstrap(MvcEvent $e)
    {
        $eventManager = $e->getApplication()->getEventManager();
        $eventManager->attach('route', array($this, 'loadConfiguration'), 2);
        //you can attach other function need here...
    }
	
	
    public function loadConfiguration(MvcEvent $e)
    {
        $application   = $e->getApplication();
	$sm            = $application->getServiceManager();
	$sharedManager = $application->getEventManager()->getSharedManager();
	
    $router = $sm->get('router');
	$request = $sm->get('request');
	
	$matchedRoute = $router->match($request);
	if (null !== $matchedRoute) { 
/*
           $sharedManager->attach('Zend\Mvc\Controller\AbstractActionController','dispatch', 
                function($e) use ($sm) {
		   $sm->get('ControllerPluginManager')->get('Myplugin')
                      ->doAuthorization($e); //pass to the plugin...    
	       },2
           );*/

        }
    }
	

	// end: added for Acl   ###################################
	
	
	/*
	 *  // added init() func for module specific layouts. ericp
	 * http://blog.evan.pro/module-specific-layouts-in-zend-framework-2
	 */
    public function init(ModuleManager $moduleManager)
    {
        $sharedEvents = $moduleManager->getEventManager()->getSharedManager();
        $sharedEvents->attach(__NAMESPACE__, 'dispatch', function($e) {
            // This event will only be fired when an ActionController under the MyModule namespace is dispatched.
            $controller = $e->getTarget();
            $controller->layout('layout/db_mau');
        }, 100);
    }
	
	
    public function getAutoloaderConfig()
    {
        return array(
            'Zend\Loader\ClassMapAutoloader' => array(
                __DIR__ . '/autoload_classmap.php',
            ),
            'Zend\Loader\StandardAutoloader' => array(
                'namespaces' => array(
                    __NAMESPACE__ => __DIR__ . '/src/' . __NAMESPACE__,
                ),
            ),
        );
    }

    public function getServiceConfig()
    {
       return array(
          'factories' => array(
             'SanPhamTableGateway' => function ($sm) {
                 //Goi doi tuong ket noi voi Database
                 $dbAdapter = $sm->get('Zend\Db\Adapter\Adapter');
                       
                 //Goi doi tuong giup chung ta chuyen 1 doi tuong mảng thanh mot doi tuong
                 $resultSetPrototype = new ResultSet();
                 $resultSetPrototype->setArrayObjectPrototype(new SanPham());
                 //$resultSetPrototype = null;
                 //Dua cac gia tri 'users', $dbAdapter, $resultSetPrototype
                 //vao doi tuong Zend\Db\TableGateway
                 return new TableGateway('san_pham', $dbAdapter, null, $resultSetPrototype);
             },
             
             'DbMau\Model\SanPhamTable' =>  function($sm) {
                 //Luc nao SanPhamTableGateway la mot doi tuong cua Zend\Db\TableGateway
                 //chua cac gia tri ket noi den database va bang chung ta muon truy van
                 $tableGateway = $sm->get('SanPhamTableGateway');
                          
                 //Truyen doi tuong Zend\Db\TableGateway vao trong ham __construct()
                 //cua doi tuong DbMau\Model\SanPhamTable
                 $table = new SanPhamTable($tableGateway);
                 return $table;
             },

             'ZendDbAdapter' => function($sm){
                $adapter = $sm->get('Zend\Db\Adapter\Adapter');
                return $adapter;
             },
/*
             'DonViTinhTableGateway' => function ($sm) {                 
                 $dbAdapter = $sm->get('Zend\Db\Adapter\Adapter');
                 $resultSetPrototype = new ResultSet();
                 $resultSetPrototype->setArrayObjectPrototype(new DonViTinh());
                 return new TableGateway('don_vi_tinh', $dbAdapter, null, $resultSetPrototype);
             },
             
             'DbMau\Model\DonViTinhTable' =>  function($sm) {
                 $tableGateway = $sm->get('DonViTinhTableGateway');
                 $table = new DonViTinhTable($tableGateway);
                 return $table;
             },*/
          ),
       );
    }

} 

