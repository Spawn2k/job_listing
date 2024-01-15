<?php

use App\controller\HomeController;
use App\controller\Sanbox;
use App\controller\TaskController;
use App\http\Kernel;
use App\model\CreateData;
use App\session\SessionClass;

define('BASE_PATH', dirname(__DIR__));
require BASE_PATH . '/vendor/autoload.php';

require BASE_PATH . '/App/util/helper.php';

$session = new SessionClass();
$session->start();
$init = new CreateData();

$userStructur = [
        'id' => 'BIGINT UNSIGNED primary key AUTO_INCREMENT',
        'name' => 'VARCHAR(60) NOT NULL',
        'email' => 'VARCHAR(100) UNIQUE NOT NULL',
        'state' => 'VARCHAR(30) NOT NULL',
        'city' => 'VARCHAR(50) NOT NULL',
        'password' => 'VARCHAR(255) NOT NULL',
        'role' => 'VARCHAR(20) DEFAULT "guest"',
        'created_at' => 'TIMESTAMP DEFAULT NOW()'
];



$jobListinStructur = [
        'id' => 'BIGINT UNSIGNED primary key AUTO_INCREMENT',
        'user_id' => 'BIGINT UNSIGNED',
        'title' => 'VARCHAR(100) NOT NULL',
        'description' => 'LONGTEXT NOT NULL',
        'salary' => 'DECIMAL NOT NULL',
        'company' => 'VARCHAR(50) NOT NULL',
        'address' => 'VARCHAR(70) NOT NULL',
        'city' => 'VARCHAR(50) NOT NULL',
        'state' => 'VARCHAR(40) NOT NULL',
        'phone' => 'VARCHAR(70) NOT NULL',
        'email' => 'VARCHAR(100) NOT NULL',
        'requirements' => 'VARCHAR(255)',
        'benefits' => 'VARCHAR(255)  NOT NULL',
        'tags' => 'VARCHAR(255)',
        'created_at' => 'TIMESTAMP DEFAULT NOW()'
];
$jobData = [
        'user_id' => ['numberBetween', [1,10]],
        'title' => ['jobTitle'],
        'description' => ['sentence', [15]],
        'salary' => ['randomNumber', [5, true]],
        'company' => 'company',
        'address' => 'streetAddress',
        'city' => 'city',
        'state' => 'state',
        'phone' => 'phoneNumber',
        'email' => 'email',
        'requirements' => ['words', [5]],
        'benefits' => ['sentence', [8]],
        'tags' => ['words', [3]]
];

$userData = [
    'name' => ['name'],
    'email' => ['email'],
    'state' => ['state'],
    'city' => ['city'],
    'password' => ['password', [8, 20]],
];
// $init->setTable('users')->setTableStructure($userStructur)->init()->insertData(10, $userData);
// $init->setTable('users')->setTableStructure($jobListinStructur)->init()->insertData(10, $jobData);
// $init->setTable('job_listings')->insertData(80, $jobData);
$kernel = new Kernel();
$kernel->get('/nolis', [TaskController::class, 'index'] );
$kernel->post('/nolis',[TaskController::class, 'handleGet'] );
$kernel->get('/sandbox', [Sanbox::class, 'index']);
$kernel->post('/upload', [Sanbox::class, 'upload']);
// $kernel->get('/sandbox/posts', [Sanbox::class, 'api']);
// $kernel->get('/', [HomeController::class, 'index']);
// $kernel->post('/listings/create', [HomeController::class, 'store'], ['user']);
// $kernel->post('/listings/find', [HomeController::class, 'searchJob']);
// $kernel->get('/listings/page/{id}', [HomeController::class, 'listings']);
// $kernel->get('/listings/page/{pageId}/listing/{jobId}', [HomeController::class, 'show']);
// $kernel->get('/listings/create', [HomeController::class, 'create'], ['user']);
// $kernel->get('/listings/edit/{id}', [HomeController::class, 'edit'], ['user']);
// $kernel->post('/listings/edit/{id}', [HomeController::class, 'update'], ['user']);
// $kernel->get('/listings/{id}', [HomeController::class, 'show']);
// $kernel->post('/listings/{id}', [HomeController::class, 'show']);
// $kernel->get('/login', [HomeController::class, 'login']);
// $kernel->post('/login', [HomeController::class, 'handleLogin']);
// $kernel->get('/logout', [HomeController::class, 'logout']);
// $kernel->get('/register', [HomeController::class, 'register']);
// $kernel->post('/register', [HomeController::class, 'handleRegister']);
// $kernel->delete('/delete/{id}', [HomeController::class, 'destroy'], ['author']);

$uri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
$kernel->resolve($uri);
