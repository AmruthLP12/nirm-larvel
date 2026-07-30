<?php

namespace Obii\TermsConditions\Tables;

use Illuminate\Support\Facades\Auth;
use BaseHelper;
use Obii\Base\Enums\BaseStatusEnum;
use Obii\TermsConditions\Repositories\Interfaces\TermsConditionsInterface;
use Obii\Table\Abstracts\TableAbstract;
use Illuminate\Contracts\Routing\UrlGenerator;
use Yajra\DataTables\DataTables;
use Html;

class TermsConditionsTable extends TableAbstract
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
     * TermsConditionsTable constructor.
     * @param DataTables $table
     * @param UrlGenerator $urlGenerator
     * @param TermsConditionsInterface $termsConditionsRepository
     */
    public function __construct(DataTables $table, UrlGenerator $urlGenerator, TermsConditionsInterface $termsConditionsRepository)
    {
        parent::__construct($table, $urlGenerator);

        $this->repository = $termsConditionsRepository;

        if (!Auth::user()->hasAnyPermission(['terms-conditions.edit', 'terms-conditions.destroy'])) {
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
            ->editColumn('application_no', function ($item) {
                if (!Auth::user()->hasPermission('terms-conditions.edit')) {
                    return $item->application_no;
                }
                return Html::link(route('terms-conditions.edit', $item->id), $item->application_no);
            })
            ->editColumn('full_name', function ($item) {
                return $item->full_name;
            })
            ->editColumn('checkbox', function ($item) {
                return $this->getCheckbox($item->id);
            })
            ->editColumn('created_at', function ($item) {
                return BaseHelper::formatDate($item->created_at);
            })
            ->addColumn('operations', function ($item) {
                return $this->getOperations('terms-conditions.edit', 'terms-conditions.destroy', $item);
            });

        return $this->toJson($data);
    }

    /**
     * {@inheritDoc}
     */
    public function query()
    {
        $query = $this->repository->getModel()
            ->select([
               'id',
               'full_name',
               'application_no',
               'created_at',
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
                'title' => 'ID',
                'width' => '20px',
            ],
            
            'application_no' => [
                'title' => 'Application No',
                'class' => 'text-left',
            ],
            'full_name' => [
                'title' => 'Full Name',
                'class' => 'text-left',
            ],
            'created_at' => [
                'title' => 'Created At',
                'width' => '100px',
            ],
        ];
    }

    /**
     * {@inheritDoc}
     */
    public function buttons()
    {
        return [];
    }

    /**
     * {@inheritDoc}
     */
    public function bulkActions(): array
    {
        return $this->addDeleteAction(route('terms-conditions.deletes'), 'terms-conditions.destroy', parent::bulkActions());
    }

    /**
     * {@inheritDoc}
     */
    public function getBulkChanges(): array
    {
        return [
            'full_name' => [
                'title'    => 'Full Name',
                'type'     => 'text',
                'validate' => 'required|max:120',
            ],
            'application_no' => [
                'title'    => 'Application No',
                'type'     => 'text',
                'validate' => 'required|max:120',
            ],
            'created_at' => [
                'title' => 'Created At',
                'type'  => 'date',
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
