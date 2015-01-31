<?php
return array(    
    'controllers' => array(
        'invokables' => array(
            'DbDoctrine\Controller\Index' => 'DbDoctrine\Controller\IndexController',            
        ),
    ),     
    'router' => array(
        'routes' => array(
            'db_doctrine' => array(
                'type'    => 'literal', 
                'options' => array(
                    'route'    => '/db-doctrine',                     
                    'defaults' => array(
                       '__NAMESPACE__'=>'DbDoctrine\Controller',
                        'controller' => 'Index',
                        'action'     => 'index',
                    ),
                ),
                'may_terminate' => true,
                'child_routes' => array(                    
                    'crud' => array(
                        'type'    => 'Segment',
                        'options' => array(
                            'route'    => '[/][:action][/:id]',
                            'constraints' => array(                            
                                'action'     => '[a-zA-Z][a-zA-Z0-9_-]*',
                                'id'=>'[0-9]+',
                            ),                            
                        ),
                    ),            
                ),
             ),
         ),
     ),
    'view_manager' => array(
        'template_path_stack' => array(
            'db_doctrine' => __DIR__ . '/../view',
        ), 
    ),

    'view_helpers'=>array(
        'invokables'=>array(
            'make_array_option_don_vi_tinh'=>'DbDoctrine\View\Helper\MakeArrayOptionDonViTinh',
            'make_array_option_loai'=>'DbDoctrine\View\Helper\MakeArrayOptionLoai',
        ),
    ),    

    'doctrine' => array(
        'driver' => array(
            'db_doctrine_annotation_driver' => array(
                'class' => 'Doctrine\ORM\Mapping\Driver\AnnotationDriver',
                'cache' => 'array',
                'paths' => array(
                    __DIR__.'/../src/DbDoctrine/Entity',
                ),
            ),

            'orm_default' => array(
                'drivers' => array(
                    'DbDoctrine\Entity' => 'db_doctrine_annotation_driver'
                )
            )
        )
    ),
); 