<?php

namespace Obii\Blog\Http\Controllers;

use Obii\Blog\Models\Category;
use Obii\Blog\Models\Post;
use Obii\Blog\Models\Tag;
use Obii\Blog\Repositories\Interfaces\PostInterface;
use Obii\Blog\Services\BlogService;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Obii\Media\Models\MediaFile;
use Obii\Page\Repositories\Interfaces\PageInterface;
use Response;
use SeoHelper;
use SlugHelper;
use Theme;

class PublicController extends Controller
{
    /**
     * @param Request $request
     * @param PostInterface $postRepository
     * @return Response
     */
    public function index(Request $request, PostInterface $postRepository)
    {
        $title = __('Blogs');
        SeoHelper::setTitle($title)
            ->setDescription($title);

        $posts = $postRepository->getAllPosts(20);

        Theme::breadcrumb()
            ->add(__('Home'), route('public.index'))
            ->add($title, route('public.blogs'));

        return Theme::scope('blogs', compact('posts'))
            ->render();
    }
    /**
     * @param Request $request
     * @param PostInterface $postRepository
     * @return Response
     */
    public function getSearch(
        Request $request,
        PostInterface $postRepository,
        PageInterface $pageRepository
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

    /**
     * @param string $slug
     * @param Request $request
     * @return RedirectResponse|Response
     */
    public function getTag($slug, BlogService $blogService)
    {
        $slug = SlugHelper::getSlug($slug, SlugHelper::getPrefix(Tag::class));

        if (!$slug) {
            abort(404);
        }

        $data = $blogService->handleFrontRoutes($slug);

        if (isset($data['slug']) && $data['slug'] !== $slug->key) {
            return redirect()->to(route('public.single', SlugHelper::getPrefix(Tag::class) . '/' . $data['slug']));
        }

        return Theme::scope($data['view'], $data['data'], $data['default_view'])
            ->render();
    }

    /**
     * @param string $slug
     * @param BlogService $blogService
     * @return RedirectResponse|Response
     */
    public function getPost($slug, BlogService $blogService)
    {
        $slug = SlugHelper::getSlug($slug, SlugHelper::getPrefix(Post::class));

        if (!$slug) {
            abort(404);
        }

        $data = $blogService->handleFrontRoutes($slug);

        if (isset($data['slug']) && $data['slug'] !== $slug->key) {
            return redirect()->to(route('public.single', SlugHelper::getPrefix(Post::class) . '/' . $data['slug']));
        }

        return Theme::scope($data['view'], $data['data'], $data['default_view'])
            ->render();
    }

    /**
     * @param string $slug
     * @param BlogService $blogService
     * @return RedirectResponse|Response
     */
    public function getCategory($slug, BlogService $blogService)
    {
        $slug = SlugHelper::getSlug($slug, SlugHelper::getPrefix(Category::class));

        if (!$slug) {
            abort(404);
        }

        $data = $blogService->handleFrontRoutes($slug);

        if (isset($data['slug']) && $data['slug'] !== $slug->key) {
            return redirect()->to(route('public.single', SlugHelper::getPrefix(Category::class) . '/' . $data['slug']));
        }

        return Theme::scope($data['view'], $data['data'], $data['default_view'])
            ->render();
    }
}
