<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/*
| -------------------------------------------------------------------------
| URI ROUTING
| -------------------------------------------------------------------------
| This file lets you re-map URI requests to specific controller functions.
|
| Typically there is a one-to-one relationship between a URL string
| and its corresponding controller class/method. The segments in a
| URL normally follow this pattern:
|
|	example.com/class/method/id/
|
| In some instances, however, you may want to remap this relationship
| so that a different class/function is called than the one
| corresponding to the URL.
|
| Please see the user guide for complete details:
|
|	https://codeigniter.com/user_guide/general/routing.html
|
| -------------------------------------------------------------------------
| RESERVED ROUTES
| -------------------------------------------------------------------------
|
| There are three reserved routes:
|
|	$route['default_controller'] = 'welcome';
|
| This route indicates which controller class should be loaded if the
| URI contains no data. In the above example, the "welcome" class
| would be loaded.
|
|	$route['404_override'] = 'errors/page_missing';
|
| This route will tell the Router which controller/method to use if those
| provided in the URL cannot be matched to a valid route.
|
|	$route['translate_uri_dashes'] = FALSE;
|
| This is not exactly a route, but allows you to automatically route
| controller and method names that contain dashes. '-' isn't a valid
| class or method name character, so it requires translation.
| When you set this option to TRUE, it will replace ALL dashes in the
| controller and method URI segments.
|
| Examples:	my-controller/index	-> my_controller/index
|		my-controller/my-method	-> my_controller/my_method
*/
$route['default_controller'] = 'pages/view';
// usuario
$route['login'] = 'usuario/login';
$route['logout'] = 'usuario/logout';
$route['cadastro'] = 'usuario/cadastro';
$route['home'] = 'usuario/index';
$route['enviarsolicitacao/(:num)'] = 'usuario/solicitaentrada/$1';
$route['editar-perfil'] = "usuario/editarusuario";

// grupos
$route['primeiros-passos'] = 'grupos/primeirospassos';
$route['entre-em-um-grupo'] = 'grupos/primeirospassos';
$route['grupos'] = 'grupos/index';
$route['procurar-grupos'] = 'grupos/procurargrupos';
$route['grupo/(:any)'] = 'grupos/grupo/$1';
$route['grupo/(:any)/participantes'] = 'grupos/participantes/$1';
$route['grupo/(:any)/sobre'] = 'grupos/sobre/$1';
$route['grupo/(:any)/contato'] = 'grupos/contato/$1';
$route['grupo/(:any)/enviar-email-contato'] = 'grupos/enviarEmail/$1';

// posts
$route['grupo/(:any)/post/(:num)'] = 'posts/index/$1/$2';
$route['grupo/(:any)/editar-post/(:num)'] = 'posts/editar/$1/$2';

// administração do grupo
$route['gerenciar-grupos'] = 'grupos/gerenciargrupos';

$route['grupo/(:any)/gerenciar-posts'] = 'posts/gerenciar/$1';
$route['grupo/(:any)/criar-post'] = 'posts/criar/$1';

$route['grupo/(:any)/editar-grupo'] = 'grupos/gerenciar/$1';

$route['grupo/(:any)/solicitacoes-pendentes'] = 'grupos/solicitacoes/$1';
$route['grupo/(:any)/gerenciar-participantes'] = 'grupos/gerenciarparticipantes/$1';

// pages
$route['sobre'] = 'pages/view/sobre';

// prototipação
$route['news/create'] = 'news/create';
$route['news/(:any)'] = 'news/view/$1';
$route['news'] = 'news';

$route['404_override'] = '';
$route['translate_uri_dashes'] = FALSE;
