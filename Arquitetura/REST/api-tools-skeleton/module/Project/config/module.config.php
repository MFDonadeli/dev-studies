<?php
return [
    'router' => [
        'routes' => [
            'project.rest.funcionarios' => [
                'type' => 'Segment',
                'options' => [
                    'route' => '/funcionarios[/:funcionarios_id]',
                    'defaults' => [
                        'controller' => 'Project\\V1\\Rest\\Funcionarios\\Controller',
                    ],
                ],
            ],
            'project.rest.categorias' => [
                'type' => 'Segment',
                'options' => [
                    'route' => '/categorias[/:categorias_id]',
                    'defaults' => [
                        'controller' => 'Project\\V1\\Rest\\Categorias\\Controller',
                    ],
                ],
            ],
        ],
    ],
    'api-tools-versioning' => [
        'uri' => [
            0 => 'project.rest.funcionarios',
            1 => 'project.rest.categorias',
        ],
    ],
    'api-tools-rest' => [
        'Project\\V1\\Rest\\Funcionarios\\Controller' => [
            'listener' => 'Project\\V1\\Rest\\Funcionarios\\FuncionariosResource',
            'route_name' => 'project.rest.funcionarios',
            'route_identifier_name' => 'funcionarios_id',
            'collection_name' => 'funcionarios',
            'entity_http_methods' => [
                0 => 'GET',
                1 => 'PATCH',
                2 => 'PUT',
                3 => 'DELETE',
            ],
            'collection_http_methods' => [
                0 => 'GET',
                1 => 'POST',
            ],
            'collection_query_whitelist' => [],
            'page_size' => 25,
            'page_size_param' => null,
            'entity_class' => \Project\V1\Rest\Funcionarios\FuncionariosEntity::class,
            'collection_class' => \Project\V1\Rest\Funcionarios\FuncionariosCollection::class,
            'service_name' => 'funcionarios',
        ],
        'Project\\V1\\Rest\\Categorias\\Controller' => [
            'listener' => 'Project\\V1\\Rest\\Categorias\\CategoriasResource',
            'route_name' => 'project.rest.categorias',
            'route_identifier_name' => 'categorias_id',
            'collection_name' => 'categorias',
            'entity_http_methods' => [
                0 => 'GET',
                1 => 'PATCH',
                2 => 'PUT',
                3 => 'DELETE',
            ],
            'collection_http_methods' => [
                0 => 'GET',
                1 => 'POST',
            ],
            'collection_query_whitelist' => [],
            'page_size' => 25,
            'page_size_param' => null,
            'entity_class' => \Project\V1\Rest\Categorias\CategoriasEntity::class,
            'collection_class' => \Project\V1\Rest\Categorias\CategoriasCollection::class,
            'service_name' => 'categorias',
        ],
    ],
    'api-tools-content-negotiation' => [
        'controllers' => [
            'Project\\V1\\Rest\\Funcionarios\\Controller' => 'HalJson',
            'Project\\V1\\Rest\\Categorias\\Controller' => 'HalJson',
        ],
        'accept_whitelist' => [
            'Project\\V1\\Rest\\Funcionarios\\Controller' => [
                0 => 'application/vnd.project.v1+json',
                1 => 'application/hal+json',
                2 => 'application/json',
            ],
            'Project\\V1\\Rest\\Categorias\\Controller' => [
                0 => 'application/vnd.project.v1+json',
                1 => 'application/hal+json',
                2 => 'application/json',
            ],
        ],
        'content_type_whitelist' => [
            'Project\\V1\\Rest\\Funcionarios\\Controller' => [
                0 => 'application/vnd.project.v1+json',
                1 => 'application/json',
            ],
            'Project\\V1\\Rest\\Categorias\\Controller' => [
                0 => 'application/vnd.project.v1+json',
                1 => 'application/json',
            ],
        ],
    ],
    'api-tools-hal' => [
        'metadata_map' => [
            \Project\V1\Rest\Funcionarios\FuncionariosEntity::class => [
                'entity_identifier_name' => 'id',
                'route_name' => 'project.rest.funcionarios',
                'route_identifier_name' => 'funcionarios_id',
                'hydrator' => \Laminas\Hydrator\ArraySerializable::class,
            ],
            \Project\V1\Rest\Funcionarios\FuncionariosCollection::class => [
                'entity_identifier_name' => 'id',
                'route_name' => 'project.rest.funcionarios',
                'route_identifier_name' => 'funcionarios_id',
                'is_collection' => true,
            ],
            \Project\V1\Rest\Categorias\CategoriasEntity::class => [
                'entity_identifier_name' => 'id',
                'route_name' => 'project.rest.categorias',
                'route_identifier_name' => 'categorias_id',
                'hydrator' => \Laminas\Hydrator\ArraySerializable::class,
            ],
            \Project\V1\Rest\Categorias\CategoriasCollection::class => [
                'entity_identifier_name' => 'id',
                'route_name' => 'project.rest.categorias',
                'route_identifier_name' => 'categorias_id',
                'is_collection' => true,
            ],
        ],
    ],
    'api-tools' => [
        'db-connected' => [
            'Project\\V1\\Rest\\Funcionarios\\FuncionariosResource' => [
                'adapter_name' => 'API',
                'table_name' => 'funcionarios',
                'hydrator_name' => \Laminas\Hydrator\ArraySerializable::class,
                'controller_service_name' => 'Project\\V1\\Rest\\Funcionarios\\Controller',
                'entity_identifier_name' => 'id',
            ],
            'Project\\V1\\Rest\\Categorias\\CategoriasResource' => [
                'adapter_name' => 'API',
                'table_name' => 'categorias',
                'hydrator_name' => \Laminas\Hydrator\ArraySerializable::class,
                'controller_service_name' => 'Project\\V1\\Rest\\Categorias\\Controller',
                'entity_identifier_name' => 'id',
            ],
        ],
    ],
    'api-tools-content-validation' => [
        'Project\\V1\\Rest\\Funcionarios\\Controller' => [
            'input_filter' => 'Project\\V1\\Rest\\Funcionarios\\Validator',
        ],
    ],
    'input_filter_specs' => [
        'Project\\V1\\Rest\\Funcionarios\\Validator' => [
            0 => [
                'required' => true,
                'validators' => [],
                'filters' => [],
                'name' => 'cpf',
                'field_type' => 'cpf',
            ],
        ],
    ],
];
