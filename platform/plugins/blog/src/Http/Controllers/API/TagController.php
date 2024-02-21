<?php

namespace Obii\Blog\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Obii\Base\Enums\BaseStatusEnum;
use Obii\Base\Http\Responses\BaseHttpResponse;
use Obii\Blog\Http\Resources\TagResource;
use Obii\Blog\Repositories\Interfaces\TagInterface;
use Illuminate\Http\Request;

class TagController extends Controller
{
    /**
     * @var TagInterface
     */
    protected $tagRepository;

    /**
     * AuthenticationController constructor.
     *
     * @param TagInterface $tagRepository
     */
    public function __construct(TagInterface $tagRepository)
    {
        $this->tagRepository = $tagRepository;
    }

    /**
     * List tags
     *
     * @group Blog
     *
     * @param Request $request
     * @param BaseHttpResponse $response
     * @return BaseHttpResponse
     */
    public function index(Request $request, BaseHttpResponse $response)
    {
        $data = $this->tagRepository
            ->advancedGet([
                'with'      => ['slugable'],
                'condition' => ['status' => BaseStatusEnum::PUBLISHED],
                'paginate'  => [
                    'per_page'      => (int)$request->input('per_page', 10),
                    'current_paged' => (int)$request->input('page', 1),
                ],
            ]);

        return $response
            ->setData(TagResource::collection($data))
            ->toApiResponse();
    }
}
