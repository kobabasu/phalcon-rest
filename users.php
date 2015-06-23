<?php
use Phalcon\Http\Response;


/* READ INDEX */

$uri = '/users';
$app->get($uri, function() use ($app) {

  $phql = "SELECT * FROM Users";
  $rows = $app->modelsManager->executeQuery($phql);

  $data = array();
  foreach ($rows as $row) {
    $data[] = array(
      'id'    => $row->id,
      'name'  => $row->name,
      'email' => $row->email
    );
  }

  return res('INDEX', $data);
});


/* READ VIEW */

$uri = '/users/{id:[0-9]+}';
$app->get($uri, function($id) use ($app) {

  $phql = "SELECT * FROM Users WHERE id=:id:";
  $row = $app->modelsManager->executeQuery($phql, array(
    'id' => $id
  ))->getFirst();

  return res('READ', $row);
});


/* CREATE */

$uri = '/users';
$app->post($uri, function() use ($app) {

  $row = $app->request->getJsonRawBody();

  $phql = "INSERT INTO Users (
    name,
    email
  ) VALUES (
    :name:,
    :email:
  )";

  $status = $app->modelsManager->executeQuery($phql, array(
    'name'  => $row->name,
    'email' => $row->email
  ));

  return res('CREATE', $status);
});


/* UPDATE */

$uri = '/users/{id:[0-9]+}';
$app->put($uri, function($id) use ($app) {

  $row = $app->request->getJsonRawBody();

  $phql = "UPDATE Users SET
    name = :name:,
    email = :email:
  WHERE id = :id:";

  $status = $app->modelsManager->executeQuery($phql, array(
    'id'    => $id,
    'name'  => $row->name,
    'email' => $row->email
  ));

  return res('UPDATE', $status);
});


/* DELETE */

$uri = '/users/{id:[0-9]+}';
$app->delete($uri, function($id) use ($app) {

  $phql = "DELETE FROM Users WHERE id = :id:";
  $status = $app->modelsManager->executeQuery($phql, array(
    'id' => $id
  ));

  return res('DELETE', $status);
});


/* response */

function res($req, $res) {
  $response = new Response();
  $response->setContentType('application/json');

  switch($req) {
  case 'INDEX':
    if ($res == false) {
      $response->setJsonContent(array('status' => 'NOT-FOUND'));
    } else {
      $response->setJsonContent(array(
        'status' => 'FOUND',
        'data' => $res
      ));
    }
    break;

  case 'READ':
    if ($res == false) {
      $response->setJsonContent(array('status' => 'NOT-FOUND'));
    } else {
      $response->setJsonContent(array(
        'status' => 'FOUND',
        'data' => $res
      ));
    }
    break;

  default:
    if ($res->success() == true) {
      switch($req) {
      case 'CREATE':
        $response->setStatusCode(201, 'Created');
        break;
      case 'UPDATE':
        $response->setStatusCode(200, 'Update Successfully');
        break;
      case 'DELETE':
        $response->setStatusCode(205, 'Delete Successfully');
        break;
      }

      $response->setJsonContent(array('status' => 'OK'));
    } else {
      $response->setStatusCode(409, 'Conflict');

      $errors = array();
      foreach($res->getMessages() as $message) {
        $errors[] = $message->getMEssage();
      }

      $response->setJsonContent(array(
        'status' => 'ERROR',
        'messages' => $errors
      ));
    }
    break;
  }

  return $response;
}
