<?php

namespace Obii\Slider\Tables;

use Illuminate\Support\Facades\Auth;
use BaseHelper;
use Obii\Base\Enums\BaseStatusEnum;
use Obii\Slider\Repositories\Interfaces\SliderInterface;
use Obii\Table\Abstracts\TableAbstract;
use Illuminate\Contracts\Routing\UrlGenerator;
use Yajra\DataTables\DataTables;
use Html;

class SliderTable extends TableAbstract
{

    /**
     * @var bool
     */
    protected $hasActions = true;

    /**
     * @var bool
     */
    protected $hasFilter = true;

    /**
     * SliderTable constructor.
     * @param DataTables $table
     * @param UrlGenerator $urlGenerator
     * @param SliderInterface $sliderRepository
     */
    public function __construct(DataTables $table, UrlGenerator $urlGenerator, SliderInterface $sliderRepository)
    {
        parent::__construct($table, $urlGenerator);

        $this->repository = $sliderRepository;

        if (!Auth::user()->hasAnyPermission(['slider.edit', 'slider.destroy'])) {
            $this->hasOperations = false;
            $this->hasActions = false;
        }
    }

    /**
     * {@inheritDoc}
     */
    public function ajax()
    {
        $data = $this->table
            ->eloquent($this->query())
            ->editColumn('title', function ($item) {
                if (!Auth::user()->hasPermission('slider.edit')) {
                    return strip_tags($item->title);
                }
                return Html::link(route('slider.edit', $item->id), strip_tags($item->title));
            })
            ->editColumn('image', function ($item) {
                return $this->displayThumbnail($item->image, ['width' => 70]);
            })
            ->editColumn('checkbox', function ($item) {
                return $this->getCheckbox($item->id);
            })
            ->editColumn('order', function ($item) {
                return $item->order;
            })
            ->editColumn('status', function ($item) {
                return $item->status->toHtml();
            })
            ->addColumn('operations', function ($item) {
                return $this->getOperations('slider.edit', 'slider.destroy', $item);
            });

        return $this->toJson($data);
    }

    /**
     * {@inheritDoc}
     */
    public function query()
    {
        $query = $this->repository->getModel()
            ->orderBy('order')
            ->select([
                'id',
                'title',
                'image',
                'order',
                'status',
            ]);

        return $this->applyScopes($query);
    }

    /**
     * {@inheritDoc}
     */
    public function columns()
    {
        return [
            'id' => [
                'title' => trans('core/base::tables.id'),
                'width' => '20px',
            ],
            'title' => [
                'title' => trans('core/base::tables.title'),
                'class' => 'text-left',
            ],
            'image' => [
                'title' => trans('core/base::tables.image'),
                'class' => 'text-left',
            ],
            'order' => [
                'title' => trans('core/base::tables.order'),
                'width' => '100px',
            ],
            'status' => [
                'title' => trans('core/base::tables.status'),
                'width' => '100px',
            ],
        ];
    }

    /**
     * {@inheritDoc}
     */
    public function buttons()
    {
        return $this->addCreateButton(route('slider.create'), 'slider.create');
    }

    /**
     * {@inheritDoc}
     */
    public function bulkActions(): array
    {
        return $this->addDeleteAction(route('slider.deletes'), 'slider.destroy', parent::bulkActions());
    }

    /**
     * {@inheritDoc}
     */
    public function getBulkChanges(): array
    {
        return [
            'title' => [
                'title'    => trans('core/base::tables.title'),
                'type'     => 'text',
                'validate' => 'required|max:120',
            ],
            'status' => [
                'title'    => trans('core/base::tables.status'),
                'type'     => 'select',
                'choices'  => BaseStatusEnum::labels(),
                'validate' => 'required|in:' . implode(',', BaseStatusEnum::values()),
            ],
            'order' => [
                'title' => trans('core/base::tables.order'),
                'type'  => 'number',
            ],
        ];
    }

    /**
     * @return array
     */
    public function getFilters(): array
    {
        return $this->getBulkChanges();
    }
}
