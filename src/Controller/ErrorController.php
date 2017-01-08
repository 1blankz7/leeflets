<?php

namespace Leeflets\Controller;

use Leeflets\Core\Response;
use Widi\Components\Router\Request;

/**
 * Class ErrorController
 * @package Leeflets\Controller
 */
class ErrorController extends AbstractController
{

    public function e404Action(Request $request)
    {
        return new Response('Not found', [], 404);
    }
}
