<?php

namespace Theme\Nirm\Http\Controllers;

use Illuminate\Http\Request;
use Obii\Media\Models\MediaFile;
use Obii\Page\Repositories\Interfaces\PageInterface;
use Obii\Blog\Repositories\Interfaces\PostInterface;
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
    public function getSearch(
        Request $request,
        PageInterface $pageRepository,
        PostInterface $postRepository
    )
    {
        $query = trim((string) $request->input('q'));

        $title = __('Search result for: ":query"', compact('query'));
        SeoHelper::setTitle($title)
            ->setDescription($title);

        $pages = $query !== '' ? $pageRepository->getSearch($query, 12) : collect();
        $posts = $query !== '' ? $postRepository->getSearch($query, 0, 12) : collect();
        $media = $query !== '' ? MediaFile::query()
            ->where(function ($builder) use ($query) {
                foreach (preg_split('/\s+/', $query) as $term) {
                    $like = '%' . $term . '%';

                    $builder->where(function ($termQuery) use ($like) {
                        $termQuery->where('name', 'LIKE', $like)
                            ->orWhere('options', 'LIKE', $like);
                    });
                }
            })
            ->where(function ($builder) {
                $builder->where('mime_type', 'application/pdf')
                    ->orWhere('mime_type', 'LIKE', 'image/%');
            })
            ->orderByDesc('created_at')
            ->limit(12)
            ->get() : collect();

        Theme::breadcrumb()
            ->add(__('Home'), route('public.index'))
            ->add($title, route('public.search'));

        return Theme::scope('search', compact('pages', 'posts', 'media', 'query'))
            ->render();
    }
}
