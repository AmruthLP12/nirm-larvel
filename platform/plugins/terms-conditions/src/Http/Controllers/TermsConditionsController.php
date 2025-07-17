<?php

namespace Obii\TermsConditions\Http\Controllers;

use Obii\Base\Events\BeforeEditContentEvent;
use Obii\TermsConditions\Repositories\Interfaces\TermsConditionsInterface;
use Obii\Base\Http\Controllers\BaseController;
use Illuminate\Http\Request;
use Exception;
use Obii\TermsConditions\Tables\TermsConditionsTable;
use Obii\Base\Http\Responses\BaseHttpResponse;
use Obii\TermsConditions\Forms\TermsConditionsForm;
use Obii\Base\Forms\FormBuilder;

class TermsConditionsController extends BaseController
{
    /**
     * @var TermsConditionsInterface
     */
    protected $termsConditionsRepository;

    /**
     * @param TermsConditionsInterface $termsConditionsRepository
     */
    public function __construct(TermsConditionsInterface $termsConditionsRepository)
    {
        $this->termsConditionsRepository = $termsConditionsRepository;
    }

    /**
     * @param TermsConditionsTable $table
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index(TermsConditionsTable $table)
    {
        page_title()->setTitle(trans('plugins/terms-conditions::terms-conditions.name'));

        return $table->renderTable();
    }

    /**
     * @param int $id
     * @param Request $request
     * @param FormBuilder $formBuilder
     * @return string
     */
    public function edit($id, FormBuilder $formBuilder, Request $request)
    {
        $termsConditions = $this->termsConditionsRepository->findOrFail($id);

        event(new BeforeEditContentEvent($request, $termsConditions));

        page_title()->setTitle(trans('plugins/terms-conditions::terms-conditions.show') . ' "' . $termsConditions->application_no . '"');

        return $formBuilder->create(TermsConditionsForm::class, ['model' => $termsConditions])
            ->renderForm();
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
            $termsConditions = $this->termsConditionsRepository->findOrFail($id);

            $this->termsConditionsRepository->delete($termsConditions);

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
            $termsConditions = $this->termsConditionsRepository->findOrFail($id);
            $this->termsConditionsRepository->delete($termsConditions);
        }

        return $response->setMessage(trans('core/base::notices.delete_success_message'));
    }
}
