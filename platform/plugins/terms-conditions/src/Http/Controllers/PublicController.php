<?php

namespace Obii\TermsConditions\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Obii\TermsConditions\Http\Requests\TermsConditionsRequest;
use Obii\TermsConditions\Repositories\Interfaces\TermsConditionsInterface;
use Obii\Base\Http\Responses\BaseHttpResponse;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Support\Arr;
use EmailHandler;
use RvMedia;
use Exception;
use Response;
use SeoHelper;

class PublicController extends Controller
{
    /**
     * @var TermsConditionsInterface
     */
    protected $termsRepository;

    public function __construct(TermsConditionsInterface $termsRepository)
    {
        $this->termsRepository = $termsRepository;
    }
    /**
     * @param Request $request
     * @return Response
     */
    public function index(Request $request)
    {
        $title = __('Terms & Conditions');
        SeoHelper::setTitle($title)
            ->setDescription($title);

        return view('plugins/terms-conditions::terms-and-conditions');
    }

    /**
     * Handle form submission.
     *
     * @param TermsConditionsRequest $request
     * @param BaseHttpResponse $response
     * @return BaseHttpResponse
     */
    public function store(TermsConditionsRequest $request, BaseHttpResponse $response)
    {
        // Simple rate limit (1 request per minute)
        if (!RateLimiter::tooManyAttempts('terms-conditions-submit', 1)) {
            RateLimiter::hit('terms-conditions-submit', 60);
        } else {
            return $response->setError()->setMessage(__('Too many attempts, please try again later!'));
        }

        try {
            // Prepare data from request
            $data = $request->except(['_token']);

            $currentYear = now()->year;
            $yearRange = $currentYear . '-' . substr($currentYear + 1, 2);
            $prefix = 'NIRM/' . $yearRange . '/No.';

            $latest = $this->termsRepository->getModel()
                ->where('application_no', 'like', $prefix . '%')
                ->orderByDesc('id')
                ->first();

            $nextNumber = 1;
            if ($latest && preg_match('/No\.([0-9]+)/', $latest->application_no, $m)) {
                $nextNumber = (int)$m[1] + 1;
            }

            $data['application_no'] = $prefix . str_pad($nextNumber, 4, '0', STR_PAD_LEFT);

            // Handle file uploads (single & multiple)
            foreach ($request->allFiles() as $input => $file) {
                // When the input name ends with [] it comes as array
                if (is_array($file)) {
                    $urls = [];
                    foreach ($file as $idx => $single) {
                        if ($single && $single->isValid()) {
                            $result = RvMedia::handleUpload($single, 0, 'terms-conditions');
                            if (!Arr::get($result, 'error')) {
                                $urls[$idx] = Arr::get($result, 'data.url');
                            }
                        }
                    }
                    if ($urls) {
                        $data[$input] = $urls;
                    }
                } elseif ($file && $file->isValid()) {
                    $result = RvMedia::handleUpload($file, 0, 'terms-conditions');
                    if (!Arr::get($result, 'error')) {
                        $data[$input] = Arr::get($result, 'data.url');
                    }
                }
            }

            // Aggregate significant publications (detail + upload) into array
            $significantPublications = [];
            for ($i = 1; $i <= 5; $i++) {
                $detailKey = 'sig_pub_detail_' . $i;
                $uploadKey = 'sig_pub_upload_' . $i;
                $detail    = $data[$detailKey] ?? null;
                $uploadUrl = $data[$uploadKey] ?? null;
                //check file is valid
                if ($request->hasFile('sig_pub_upload_' . $i)) {
                    $uploadResult = RvMedia::handleUpload($request->file('sig_pub_upload_' . $i), 0, 'terms-conditions');
                    if (!Arr::get($uploadResult, 'error')) {
                        $uploadUrl = Arr::get($uploadResult, 'data.url');
                        $data[$uploadKey] = $uploadUrl;
                    }
                }

                if ($detail || $uploadUrl) {
                    $significantPublications[] = [
                        'detail' => $detail,
                        'file'   => $uploadUrl,
                    ];
                }

                unset($data[$detailKey], $data[$uploadKey]);
            }
            if (!empty($significantPublications)) {
                $data['significant_publications'] = $significantPublications;
            }

            // Aggregate science education details
            $scienceDetails = [];
            $scienceCount = count($request->input('science_edu_exam_passed', []));
            for ($i = 0; $i < $scienceCount; $i++) {
                if ($request->input("science_edu_exam_passed.$i")) {
                    //science_edu_certificate[$i] file upload
                    if ($request->hasFile('science_edu_certificate.' . $i)) {
                        $uploadUrl = RvMedia::handleUpload($request->file('science_edu_certificate.' . $i), 0, 'terms-conditions');
                        if (!Arr::get($uploadUrl, 'error')) {
                            $data['science_edu_certificate'][$i] = Arr::get($uploadUrl, 'data.url');
                        }
                    }
                    $scienceDetails[] = [
                        'exam_passed'   => $request->input("science_edu_exam_passed.$i"),
                        'board_uni'     => $request->input("science_edu_board_uni.$i"),
                        'duration'      => $request->input("science_edu_duration.$i"),
                        'year_passing'  => $request->input("science_edu_year_passing.$i"),
                        'major_subjects' => $request->input("science_edu_major_subjects.$i"),
                        'percent'       => $request->input("science_edu_percent.$i"),
                        'cgpa'          => $request->input("science_edu_cgpa.$i"),
                        'certificate'   => $data['science_edu_certificate'][$i] ?? null,
                    ];
                }
            }
            if ($scienceDetails) {
                $data['science_education_details'] = $scienceDetails;
            }

            // Aggregate engineering education details
            $engDetails = [];
            $engCount = count($request->input('eng_edu_board_uni', []));
            for ($i = 0; $i < $engCount; $i++) {
                if ($request->input("eng_edu_board_uni.$i") || $request->input("eng_edu_exam_passed.$i") || $request->input("eng_degree_type.$i") || $request->input("eng_post_graduate_type.$i")) {
                    //eng_edu_certificate[$i] file upload
                    if ($request->hasFile('eng_edu_certificate.' . $i)) {
                        $uploadUrl = RvMedia::handleUpload($request->file('eng_edu_certificate.' . $i), 0, 'terms-conditions');
                        if (!Arr::get($uploadUrl, 'error')) {
                            $data['eng_edu_certificate'][$i] = Arr::get($uploadUrl, 'data.url');
                        }
                    }
                    $engDetails[] = [
                        'exam_passed'   => $request->input("eng_edu_exam_passed.$i") ?? $request->input("eng_degree_type.$i") ?? $request->input("eng_post_graduate_type.$i"),
                        'board_uni'     => $request->input("eng_edu_board_uni.$i"),
                        'duration'      => $request->input("eng_edu_duration.$i"),
                        'year_passing'  => $request->input("eng_edu_year_passing.$i"),
                        'major_subjects' => $request->input("eng_edu_major_subjects.$i"),
                        'percent'       => $request->input("eng_edu_percent.$i"),
                        'cgpa'          => $request->input("eng_edu_cgpa.$i"),
                        'certificate'   => $data['eng_edu_certificate'][$i] ?? null,
                    ];
                }
            }
            if ($engDetails) {
                $data['engineering_education_details'] = $engDetails;
            }

            // Aggregate country visits
            $countryVisits = [];
            $visitCount = count($request->input('country_visited', []));
            for ($i = 0; $i < $visitCount; $i++) {
                if ($request->input("country_visited.$i") || $request->input("period_visit.$i") || $request->input("purpose_visit.$i")) {
                    $countryVisits[] = [
                        'country' => $request->input("country_visited.$i"),
                        'period'  => $request->input("period_visit.$i"),
                        'purpose' => $request->input("purpose_visit.$i"),
                    ];
                }
            }
            if ($countryVisits) {
                $data['country_visits'] = $countryVisits;
            }

            // Remove temporary raw array inputs to avoid array-to-string conversion
            $data = Arr::except($data, [
                // science education raw
                'science_edu_exam_passed', 'science_edu_board_uni', 'science_edu_duration', 'science_edu_year_passing', 'science_edu_major_subjects', 'science_edu_percent', 'science_edu_cgpa', 'science_edu_certificate',
                // engineering education raw
                'eng_edu_exam_passed', 'eng_degree_type', 'eng_post_graduate_type', 'eng_edu_board_uni', 'eng_edu_duration', 'eng_edu_year_passing', 'eng_edu_major_subjects', 'eng_edu_percent', 'eng_edu_cgpa', 'eng_edu_certificate',
                // country visit raw
                'country_visited', 'period_visit', 'purpose_visit',
            ]);
            info('Data: ', $data);
            // Encode remaining arrays to JSON except those defined with array cast
            $arrayCastAttributes = app(\Obii\TermsConditions\Models\TermsConditions::class)->getCasts();
            foreach ($data as $key => $value) {
                if ((is_array($value) || is_object($value)) && (!isset($arrayCastAttributes[$key]) || $arrayCastAttributes[$key] !== 'array')) {
                    $data[$key] = json_encode($value, JSON_UNESCAPED_UNICODE);
                }
            }

            // Persist to database
            $terms = $this->termsRepository->createOrUpdate($data);

            // Fire event / send email to admin
            EmailHandler::setModule('terms-conditions')
                ->setVariableValues([
                    'applicant_name' => $terms->full_name ?? 'N/A',
                    'post_applied'   => $terms->post_applied_for ?? 'N/A',
                    'submitted_at'   => now()->toDateTimeString(),
                    'application_no' => $terms->application_no,
                ])
                ->sendUsingTemplate(
                    'notice',            // template key
                    null,                // send tới admin mặc định
                    [],                  // extra view data
                    false,               // debug
                    'plugins',           // type
                    'New Application Submitted'   // subject tùy chỉnh
                );

            return redirect()->route('public.job-application')
                ->with('success', __('Your application has been submitted successfully!'));
        } catch (Exception $exception) {
            info($exception->getMessage(), ['exception' => $exception]);
            return redirect()->route('public.job-application')
                ->withInput()
                ->with('error', __('Unable to submit application right now, please try again later.'));
        }
    }
}
