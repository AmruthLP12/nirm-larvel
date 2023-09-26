<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CrawlUrlController;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('crawl', [CrawlUrlController::class, 'index'])->name('crawl');

Route::get('/', function () {
    return view('index');
});
Route::get('/index.php', function () {
    return view('index');
});
Route::get('/publications.php', function () {
    return view('publications');
});
Route::get('/information-cell.php', function () {
    return view('information-cell');
});
Route::get('/icc-women.php', function () {
    return view('icc-women');
});
Route::get('/Tender_Notice.php', function () {
    return view('tender-notice');
});
Route::get('/contactus.php', function () {
    return view('contactus');
});
Route::get('/hi-index.php', function () {
    return view('hi-index');
});
Route::get('/history_nirm.php', function () {
    return view('history-nirm');
});
Route::get('/about.php', function () {
    return view('about');
});
Route::get('/ministry_of_mines.php', function () {
    return view('ministry-of-mines');
});
Route::get('/vision_mission.php', function () {
    return view('vision-mission');
});
Route::get('/quality_policies_objectives.php', function () {
    return view('quality-policies-objectives');
});
Route::get('/organizational_chart.php', function () {
    return view('organizational-chart');
});
Route::get('/governing_body.php', function () {
    return view('governing-body');
});
Route::get('/peer_review_committee.php', function () {
    return view('peer-review-committee');
});
Route::get('/directors_message.php', function () {
    return view('directors-message');
});
Route::get('/major_facilities.php', function () {
    return view('major-facilities');
});
Route::get('/recent_activities.php', function () {
    return view('recent-activities');
});
Route::get('/underground_mines_ares_of_involvment.php', function () {
    return view('underground-mines-ares-of-involvment');
});
Route::get('/underground_mines_work_highlights.php', function () {
    return view('underground-mines-work-highlights');
});
Route::get('/underground_mines_clients.php', function () {
    return view('underground-mines-clients');
});
Route::get('/opencast-mines-areas-of-work.php', function () {
    return view('opencast-mines-areas-of-work');
});
Route::get('/opencast-mines-work-highlights.php', function () {
    return view('opencast-mines-work-highlights');
});
Route::get('/opencast-mines-clients.php', function () {
    return view('opencast-mines-clients');
});
Route::get('/hydroelectric-projects-areas-of-involvement.php', function () {
    return view('hydroelectric-projects-areas-of-involvement');
});
Route::get('/hydroelectric-projects-works-highlights.php', function () {
    return view('hydroelectric-projects-works-highlights');
});
Route::get('/hydroelectric-projects-clients.php', function () {
    return view('hydroelectric-projects-clients');
});
Route::get('/nuclear-power-projects-areas-of-work.php', function () {
    return view('nuclear-power-projects-areas-of-work');
});
Route::get('/nuclear-power-projects-work-highlights.php', function () {
    return view('nuclear-power-projects-work-highlights');
});
Route::get('/infrastructure-areas-of-work.php', function () {
    return view('infrastructure-areas-of-work');
});
Route::get('/infrastructure-projects-work-highlights.php', function () {
    return view('infrastructure-projects-work-highlights');
});
Route::get('/infrastructure-clients.php', function () {
    return view('infrastructure-clients');
});
Route::get('/testing-services-work-highlights.php', function () {
    return view('testing-services-work-highlights');
});
Route::get('/testing-services-clients.php', function () {
    return view('testing-services-clients');
});
Route::get('/ongoing-projects.php', function () {
    return view('ongoing-projects');
});
Route::get('/completed-projects.php', function () {
    return view('completed-projects');
});
Route::get('/engg_%20geology_areas_of_activities.php', function () {
    return view('engg-20geology-areas-of-activities');
});
Route::get('/engineering_geology_manpower.php', function () {
    return view('engineering-geology-manpower');
});
Route::get('/engg_geophysics_areas_of_activities.php', function () {
    return view('engg-geophysics-areas-of-activities');
});
Route::get('/engineering_geophysics_manpower.php', function () {
    return view('engineering-geophysics-manpower');
});
Route::get('/engg_seismology_areas_of_activities.php', function () {
    return view('engg-seismology-areas-of-activities');
});
Route::get('/engg_seismology_manpower.php', function () {
    return view('engg-seismology-manpower');
});
Route::get('/geotechnical_%20engg_areas_of_activities.php', function () {
    return view('geotechnical-20engg-areas-of-activities');
});
Route::get('/geotechnical_manpower.php', function () {
    return view('geotechnical-manpower');
});
Route::get('/numerical_%20modelling_areas_of_activities.php', function () {
    return view('numerical-20modelling-areas-of-activities');
});
Route::get('/numerical_modelling_manpower.php', function () {
    return view('numerical-modelling-manpower');
});
Route::get('/mining_technology_areas_of_activities.php', function () {
    return view('mining-technology-areas-of-activities');
});
Route::get('/geomechanics_groundcontrol-manpower.php', function () {
    return view('geomechanics-groundcontrol-manpower');
});
Route::get('/rock_blasting_areas_of_activities.php', function () {
    return view('rock-blasting-areas-of-activities');
});
Route::get('/rockblasting_manpower.php', function () {
    return view('rockblasting-manpower');
});
Route::get('/testing_services_areas_of_activities.php', function () {
    return view('testing-services-areas-of-activities');
});
Route::get('/testing_services_manpower.php', function () {
    return view('testing-services-manpower');
});
Route::get('/siesmotectonics_areas_of_activities.php', function () {
    return view('siesmotectonics-areas-of-activities');
});
Route::get('/seismotectonic_manpower.php', function () {
    return view('seismotectonic-manpower');
});
Route::get('/administration_finance_manpower.php', function () {
    return view('administration-finance-manpower');
});
Route::get('/project_monitoring_manpower.php', function () {
    return view('project-monitoring-manpower');
});
Route::get('/Activities.php', function () {
    return view('activities');
});
Route::get('/news.php', function () {
    return view('news');
});
Route::get('/Temp_Interview.php', function () {
    return view('temp-interview');
});
Route::get('/training-programmes.php', function () {
    return view('training-programmes');
});
Route::get('/Contract-Rules.php', function () {
    return view('contract-rules');
});
Route::get('/technical-Info.php', function () {
    return view('technical-info');
});
Route::get('/NIRM-Academics.php', function () {
    return view('nirm-academics');
});
Route::get('/nirm_lecture.php', function () {
    return view('nirm-lecture');
});
Route::get('/our-expertise.php', function () {
    return view('our-expertise');
});
Route::get('/cio-others.php', function () {
    return view('cio-others');
});
Route::get('/services-offered.php', function () {
    return view('services-offered');
});
Route::get('/power-of-gb.php', function () {
    return view('power-of-gb');
});
Route::get('/key-responsibilities.php', function () {
    return view('key-responsibilities');
});
Route::get('/information-manuals.php', function () {
    return view('information-manuals');
});
