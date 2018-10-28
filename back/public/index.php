<?php
header("Content-Type:application/json");

require_once '../vendor/autoload.php';
require_once __DIR__ . '/keyword.php';
require_once __DIR__ . '/login.php';

use \Router\Router;

$pdo = \Database\DatabaseSingleton::getInstance();
$barHydrator = new \Bar\BarHydrator();
$barRepository = new \Bar\BarRepository($pdo, $barHydrator);

// get all bars


Router::get('/api/bars\?keywords\=(.+)', function($request) use($barRepository, $barHydrator) {

    $keywords =rawurldecode($request->params[0]);


    #Quoi mettre du coup dans le if?
    if(!is_string($keywords) && $keywords!='')
    {
        http_response_code(400);
		echo json_encode(array('error' => 'Parameters are not correct.'));

    }
    $kwTab=explode(',',$keywords);

    $bars = $barRepository->fetchByKeyWords($kwTab);
    if($bars !=NULL)
    {
        echo json_encode($barHydrator->extractAll($bars), JSON_UNESCAPED_UNICODE);
    }
    else
    {
        http_response_code(404);
			echo json_encode(array('error' => 'No such bar with those keywords'));
    }


});

// get a bar per id
Router::get('/api/bars/{}', function($request) use($barRepository, $barHydrator) {

    if(isset($request->params[0]))
    {
    	// Equivalent of JavaScript's parseInt function
    	// set $id to '' if any character is not a digit of request->params[0]
    	$id = (int) preg_replace('/\D/', '', $request->params[0]);
    }
    else
    {
    	http_response_code(400);
		echo json_encode(array('error' => 'Parameters are not correct.'));
    }

    if($id != '' and is_int($id))
	{
		// Get the bar
    	$bar = $barRepository->fetchById($id);
    	if($bar != NULL)
    	{
    		echo json_encode($barHydrator->extract($bar), JSON_UNESCAPED_UNICODE);
    	}
    	else
    	{
    		http_response_code(404);
			echo json_encode(array('error' => 'No such bar with this id.'));
    	}
	}
	else
	{
		http_response_code(400);
		echo json_encode(array('error' => 'Parameters are not correct.'));
	}
});

Router::execute();


// simple route

// get the user 1
// Router::get('/api/users/1, function() {});

// create a new user with a request body
// Router::post('/api/users', function() {});

// update the user 1 with a request body
// Router::put('/api/users/1', function() {});

// delete all users
// Router::delete('/api/users', function() {});

// delete the user 1
// Router::delete('/api/users/1', function() {});

// for create and delete, if id 1 does not exist return 404

// nested route

// get all messages of the user 1
// Router::get('/api/users/1/messages, function() {})

// create a message of the user 1 with the request body
// Router::post('/api/users/1/messages, function() {})

// update the message 2 of the user 1 with the request body
// Router::put('/api/users/1/messages/2, function() {})

// delete the message 2 of the user 1
// Router::delete('/api/users/1/messages/2, function() {})
