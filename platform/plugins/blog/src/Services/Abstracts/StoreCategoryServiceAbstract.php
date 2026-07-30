<?php

namespace Obii\Blog\Services\Abstracts;

use Obii\Blog\Models\Post;
use Obii\Blog\Repositories\Interfaces\CategoryInterface;
use Illuminate\Http\Request;

abstract class StoreCategoryServiceAbstract
{
    /**
     * @var CategoryInterface
     */
    protected $categoryRepository;

    /**
     * StoreCategoryServiceAbstract constructor.
     * @param CategoryInterface $categoryRepository
     */
    public function __construct(CategoryInterface $categoryRepository)
    {
        $this->categoryRepository = $categoryRepository;
    }

    /**
     * @param Request $request
     * @param Post $post
     * @return mixed
     */
    abstract public function execute(Request $request, Post $post);
}
