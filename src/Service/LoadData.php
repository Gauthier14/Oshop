<?php

namespace App\Service;

use App\Repository\BrandRepository;
use App\Repository\CategoryRepository;
use App\Repository\TypeRepository;

class LoadData {

    private $data = [];

    private $categoryRepository;
    private $typeRepository;
    private $brandRepository;

    public function __construct(CategoryRepository $categoryRepository, BrandRepository $brandRepository, TypeRepository $typeRepository)
    {
        $this->categoryRepository = $categoryRepository;
        $this->brandRepository = $brandRepository;
        $this->typeRepository = $typeRepository;
    }

    public function loadData()
    {
        $this->data['categories'] = $this->categoryRepository->findAll();
        $this->data['brands'] = $this->brandRepository->findAll();
        $this->data['types'] = $this->typeRepository->findAll();

        return $this->data;
    }
}