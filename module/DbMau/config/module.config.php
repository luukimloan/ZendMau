<?php
return array(
    'controllers' => array(
        'invokables' => array(
            'DbMau\Controller\Index' => 'DbMau\Controller\IndexController',
        ),
    ),    
    'router' => array(
        'routes' => array(        
            'db_mau' => array(
                 'type'    => 'segment', 
                 'options' => array(
                     'route'    => '/db-mau[/][:action][/:id]',
                     'constraints' => array(
                         'action' => '[a-zA-Z][a-zA-Z0-9_-]*',
                         'id'     => '[0-9]+',
                     ),
                     'defaults' => array(
                         'controller' => 'DbMau\Controller\Index',
                         'action'     => 'index',
                     ),
                 ),
             ),
        ),
    ),
    'view_manager' => array(
        'template_path_stack' => array(
            'db_mau' => __DIR__ . '/../view',
        ), 
    ),

    'view_helpers'=>array(
        'invokables'=>array(
            'make_array_option_don_vi_tinh'=>'DbMau\View\Helper\MakeArrayOptionDonViTinh',
            'make_array_option_loai'=>'DbMau\View\Helper\MakeArrayOptionLoai',
        ),
    ),
); 