<?php

namespace Obii\InformationSection\Http\Controllers;

use Obii\Base\Events\BeforeEditContentEvent;
use Obii\InformationSection\Http\Requests\InformationSectionRequest;
use Obii\InformationSection\Repositories\Interfaces\InformationSectionInterface;
use Obii\Base\Http\Controllers\BaseController;
use Illuminate\Http\Request;
use Exception;
use Obii\InformationSection\Tables\InformationSectionTable;
use Obii\Base\Events\CreatedContentEvent;
use Obii\Base\Events\DeletedContentEvent;
use Obii\Base\Events\UpdatedContentEvent;
use Obii\Base\Http\Responses\BaseHttpResponse;
use Obii\InformationSection\Forms\InformationSectionForm;
use Obii\Base\Forms\FormBuilder;

class InformationSectionController extends BaseController
{
    /**
     * @var InformationSectionInterface
     */
    protected $informationSectionRepository;

    /**
     * @param InformationSectionInterface $informationSectionRepository
     */
    public function __construct(InformationSectionInterface $informationSectionRepository)
    {
        $this->informationSectionRepository = $informationSectionRepository;
    }

    /**
     * @param InformationSectionTable $table
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index(InformationSectionTable $table)
    {
        page_title()->setTitle(trans('plugins/information-section::information-section.name'));

        return $table->renderTable();
    }

    /**
     * @param FormBuilder $formBuilder
     * @return string
     */
    public function create(FormBuilder $formBuilder)
    {
        page_title()->setTitle(trans('plugins/information-section::information-section.create'));

        return $formBuilder->create(InformationSectionForm::class)->renderForm();
    }

    /**
     * @param InformationSectionRequest $request
     * @param BaseHttpResponse $response
     * @return BaseHttpResponse
     */
    public function store(InformationSectionRequest $request, BaseHttpResponse $response)
    {
        $informationSection = $this->informationSectionRepository->createOrUpdate($request->input());

        event(new CreatedContentEvent(INFORMATION_SECTION_MODULE_SCREEN_NAME, $request, $informationSection));

        return $response
            ->setPreviousUrl(route('information-section.index'))
            ->setNextUrl(route('information-section.edit', $informationSection->id))
            ->setMessage(trans('core/base::notices.create_success_message'));
    }

    /**
     * @param int $id
     * @param Request $request
     * @param FormBuilder $formBuilder
     * @return string
     */
    public function edit($id, FormBuilder $formBuilder, Request $request)
    {
        $informationSection = $this->informationSectionRepository->getInformationSectionByType($id);
        event(new BeforeEditContentEvent($request, $informationSection));

        page_title()->setTitle(trans('plugins/information-section::information-section.edit') . ' "' . $informationSection->name . '"');

        return $formBuilder->create(InformationSectionForm::class, ['model' => $informationSection])->renderForm();
    }

    /**
     * @param int $id
     * @param InformationSectionRequest $request
     * @param BaseHttpResponse $response
     * @return BaseHttpResponse
     */
    public function update($id, InformationSectionRequest $request, BaseHttpResponse $response)
    {
        $informationSection = $this->informationSectionRepository->getInformationSectionByType($id);

        $informationSection->fill($request->input());

        $informationSection = $this->informationSectionRepository->createOrUpdate($informationSection);

        event(new UpdatedContentEvent(INFORMATION_SECTION_MODULE_SCREEN_NAME, $request, $informationSection));

        return $response
            ->setPreviousUrl(route('information-section.index'))
            ->setMessage(trans('core/base::notices.update_success_message'));
    }

    /**
     * @param int $id
     * @param Request $request
     * @param BaseHttpResponse $response
     * @return BaseHttpResponse
     */
    public function destroy(Request $request, $id, BaseHttpResponse $response)
    {
        try {
            $informationSection = $this->informationSectionRepository->findOrFail($id);

            $this->informationSectionRepository->delete($informationSection);

            event(new DeletedContentEvent(INFORMATION_SECTION_MODULE_SCREEN_NAME, $request, $informationSection));

            return $response->setMessage(trans('core/base::notices.delete_success_message'));
        } catch (Exception $exception) {
            return $response
                ->setError()
                ->setMessage($exception->getMessage());
        }
    }

    /**
     * @param Request $request
     * @param BaseHttpResponse $response
     * @return BaseHttpResponse
     * @throws Exception
     */
    public function deletes(Request $request, BaseHttpResponse $response)
    {
        $ids = $request->input('ids');
        if (empty($ids)) {
            return $response
                ->setError()
                ->setMessage(trans('core/base::notices.no_select'));
        }

        foreach ($ids as $id) {
            $informationSection = $this->informationSectionRepository->findOrFail($id);
            $this->informationSectionRepository->delete($informationSection);
            event(new DeletedContentEvent(INFORMATION_SECTION_MODULE_SCREEN_NAME, $request, $informationSection));
        }

        return $response->setMessage(trans('core/base::notices.delete_success_message'));
    }
}
