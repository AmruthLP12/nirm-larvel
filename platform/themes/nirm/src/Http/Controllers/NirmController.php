<?php

namespace Theme\Nirm\Http\Controllers;

use Illuminate\Http\Request;
use Obii\Page\Repositories\Interfaces\PageInterface;
use Obii\Theme\Http\Controllers\PublicController;
use SeoHelper;
use Theme;

class NirmController extends PublicController
{
    /**
     * {@inheritDoc}
     */
    public function getIndex()
    {
        return parent::getIndex();
    }

    /**
     * {@inheritDoc}
     */
    public function getView($key = null)
    {
        return parent::getView($key);
    }

    /**
     * {@inheritDoc}
     */
    public function getSiteMap()
    {
        return parent::getSiteMap();
    }

    /**
     * @param Request $request
     * @param PageInterface $pageRepository
     * @return Response
     */
    public function getSearch(Request $request, PageInterface $pageRepository)
    {
        $query = $request->input('q');

        $title = __('Search result for: ":query"', compact('query'));
        SeoHelper::setTitle($title)
            ->setDescription($title);

        $pages = $pageRepository->getSearch($query, 12);

        Theme::breadcrumb()
            ->add(__('Home'), route('public.index'))
            ->add($title, route('public.search'));

        return Theme::scope('search', compact('pages'))
        ->render();
    }
}
