<?php

namespace App\controller;

use App\form\auth\Validate;
use App\http\Request;
use App\http\Response;
use App\pagination\JobListingPagination;
use App\session\Session;
use Exception;

class HomeController
{
    use Request;
    use ListingController;
    use Session;

    public function index(): Response
    {
        try {

            $stmt = $this->db()->query('SELECT * FROM job_listings ORDER BY created_at DESC LIMIT 6');
            $jobs = $stmt->fetchAll();

        } catch (\Exception $exception) {
            throw new Exception($exception->getMessage());
        }

        $pagination = new JobListingPagination();
        $jobs = $pagination->getPageNumber($jobs);

        return new Response('index', data: ['jobs' => $jobs]);
    }

    public function store(): Response
    {

        $form = new Validate();
        $post = $this->getPost();
        $post['user_id'] = $_SESSION['user']->id;
        $form->loadData($post);

        if(!$form->validate($form->createRules())) {
            $errors = $form->errors;
            return new Response('create', 302, ['validateErrors' => $errors, 'oldValues' => $post]);
        }

        $this->insert($post);
        $this->setFlash('success', 'New Job listing successfully created');

        return Response::redirect('/');
    }

    public function show($params): Response
    {
        $id = (int) $params['jobId'];
        $pagination = new JobListingPagination();
        $job = $this->find($id);
        $arrayJob = [];
        $arrayJob[] = $job;
        $arrayJob = $pagination->getPageNumber($arrayJob);

        return new Response('listing', data: ['job' => $arrayJob[0]]);
    }

    public function create(): Response
    {
        return new Response('create');
    }

    public function login(): Response
    {
        return new Response('login');
    }

    public function register(): Response
    {
        return new Response('register');
    }

    public function handleRegister(): Response
    {
        $inputData = $this->getPost();
        $validate = new Validate();
        $validate->loadData($inputData);
        if (!$validate->validate($validate->createUser())) {
            $errors = $validate->errors;
            return new Response('register', data: ['validateErrors' => $errors]);
        }
        $inputData['password'] = password_hash($inputData['password'], PASSWORD_BCRYPT);
        unset($inputData['confirmPassword']);
        $this->setTable('users')->setFillable(['name', 'email', 'city', 'state', 'password'])->insert($inputData);

        return Response::redirect('/');
    }

    public function listings($id): Response
    {
        $index = (int) $id['id'];
        $pagination = new JobListingPagination();
        $cardPerPage = $pagination->cardPerPage;
        $paginationRow = $pagination->paginationRow; // how much pagination page display
        $paginationRowLength = $pagination->getMaxRowLenth();
        $jobs = $pagination->getJobsPerPage($index);
        $paginationRange = $pagination->getRange($index);
        $isMax = $pagination->isMax($paginationRange);
        $isMin = $pagination->isMin($paginationRange);

        return new Response(
            'listings',
            data: [
            'maxPage' => $paginationRowLength,
            'jobs' => $jobs,
            'page' => $index,
            'pageLimit' => $paginationRow,
            'displayPage' => $paginationRange,
            'isMax' => $isMax,
            'isMin' => $isMin,
            ]
        );
    }

    public function edit($id): Response
    {
        $id = $id['id'];

        $job = $this->find($id);

        return new Response('edit', data: ['oldValues' => $job]);
    }

    public function update($id)
    {
        $id = $id['id'];
        $job = $this->getPost();
        $validate = new Validate();
        $job['id'] = $id;
        $validate->loadData($job);
        $validate->setTable('job_listings');
        if (!$validate->validate($validate->updateRules())) {
            $errors = $validate->errors;
            $obj = (object) $job;
            return new Response('edit', data: ['validateErrors' => $errors, 'oldValues' => $obj]);
        }

        $this->handleUpdate($id, data: $job);
        $this->setFlash('success', 'Job successfully updated');

        return Response::redirect('/');
    }

    public function destroy($id): Response
    {
        $id = $id['id'];
        $this->handleDestroy($id);

        return Response::redirect('/');
    }

    public function handleLogin(): Response
    {
        $email = $this->getPost()['email'];
        $password = $this->getPost()['password'];
        $user = $this->find($email, column: 'email', table: 'users');
        if (empty($password) || empty($email)) {
            $this->setFlash('error', 'you need to fill in your credentials');
            return Response::redirect('/login') ;
        }

        if(!empty($password)) {
            if(!password_verify($password, $user->password)) {
                $this->setFlash('error', 'sorry wrong credentials');
                return new Response('login', 401);
            }
        }
        unset($user->password);
        $_SESSION['user'] = $user;
        $this->setFlash('success', 'You have successfully loged in');
        return Response::redirect('/');
    }

    public function logout(): Response
    {
        if(isset($_SESSION['user'])) {
            unset($_SESSION['user']);
        }

        $this->setFlash('success', 'You have successfully logout');
        return Response::redirect('/');
    }

    public function searchJob(): Response
    {
        $searValue = $this->getPost()['searchValue'] ?? '';
        $location = $this->getPost()['location'] ?? '';
        $jobs = $this->searchLike($location, $searValue);
        $pagination = new JobListingPagination();
        $pagination->getPageNumber($jobs);
        return new Response('index', data: ['jobs' => $jobs]);
    }
}
