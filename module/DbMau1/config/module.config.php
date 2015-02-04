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
                'type'    => 'literal', 
                'options' => array(
                    'route'    => '/db-mau',                     
                    'defaults' => array(
                       '__NAMESPACE__'=>'DbMau\Controller',
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
            'db_mau' => __DIR__ . '/../view',
        ), 
    ),
); 