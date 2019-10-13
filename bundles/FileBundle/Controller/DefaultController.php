<?php

namespace FileBundle\Controller;


use Symfony\Component\DependencyInjection\ContainerAwareInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Symfony\Component\HttpFoundation\Response;


class DefaultController implements ContainerAwareInterface
{
    private $container;


    public function test()
    {
        return new Response('file response');
    }

    public function setContainer(ContainerInterface $container = null)
    {
        $this->container = $container;
    }



}
