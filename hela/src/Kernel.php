<?php

namespace App;

use Symfony\Bundle\FrameworkBundle\Kernel\MicroKernelTrait;
use Symfony\Component\HttpKernel\Kernel as BaseKernel;


use Knp\Bundle\PaginatorBundle\Definition\PaginatorAware;

class Kernel extends BaseKernel
{



    use MicroKernelTrait;

}
