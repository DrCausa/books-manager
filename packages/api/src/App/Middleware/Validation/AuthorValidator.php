<?php

declare(strict_types=1);

namespace App\Middleware\Validation;

use App\Database\Tables\AuthorTable;
use Psr\Http\Message\ServerRequestInterface as Request;
use Psr\Http\Server\RequestHandlerInterface as RequestHandler;
use Psr\Http\Message\ResponseInterface as Response;
use Slim\Psr7\Factory\ResponseFactory;
use Valitron\Validator;

class AuthorValidator
{
  public function __construct(private Validator $validator) {}

  public function __invoke(Request $req, RequestHandler $handler): Response
  {
    $this->validator->mapFieldsRules([
      AuthorTable::COL_NAME => ['required', ['lengthMax', 255]]
    ]);

    $this->validator = $this->validator->withData($req->getParsedBody());

    if (!$this->validator->validate()) {
      $response = (new ResponseFactory())->createResponse();
      $response->getBody()->write(json_encode($this->validator->errors()));
      return $response->withStatus(422);
    }

    return $handler->handle($req);
  }
}
