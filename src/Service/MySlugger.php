<?php 

namespace App\Service;

use Symfony\Component\String\Slugger\SluggerInterface;

class MySlugger {

    private $slugger;


    public function __construct(SluggerInterface $SluggerInterface )
    {
        $this->slugger = $SluggerInterface;

    }

    public function slugify(string $var)
    {

        $slug = $this->slugger->slug($var)->lower();
        return $slug ; 
    }
}