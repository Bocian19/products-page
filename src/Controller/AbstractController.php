<?php

namespace App\Controller;

use App\Service\EmService;
use Symfony\Component\HttpFoundation\Request;
use Twig\Environment;
use Twig\Loader\FilesystemLoader;

abstract class AbstractController
{
    protected $twig;
    protected $loader;
    protected $request;
    protected $emService;

    public function __construct(){
        $this->loader = new FilesystemLoader(dirname(__DIR__).'/templates/');
        $this->twig = new Environment($this->loader);
        $this->request = Request::createFromGlobals();
        $this->emService = new EmService();
    }
}