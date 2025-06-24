<?php

use App\Http\Controllers\AdvertisementController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\LocationAdsController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\TabletsController;
use App\Http\Controllers\QuizController;
use App\Http\Controllers\FrontendController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\PlanController;
use App\Http\Controllers\PlanItemController;
use App\Http\Controllers\SubCategoryController;
use App\Models\Advertisement;
use Illuminate\Support\Facades\Route;

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
Route::get('/createstoragelink', function () {

    $targetFolder = base_path() . '/storage/app/public';

    // $linkFolder = $_SERVER['DOCUMENT_ROOT'] . '/storage';
    $linkFolder = $_SERVER['DOCUMENT_ROOT'] . '/storage';

    symlink($targetFolder, $linkFolder);
});
require __DIR__ . '/tablet.php';
Route::get('/', function () {

    if (auth()->user()) {

        if (auth()->user()->hasRole('admin')) {
            return redirect()->route('dashboard');
        }
        if (auth()->user()->hasRole('tablet')) {
            return redirect()->route('index');
        }
    } else {
        return view('auth.login');
    }
})->name('landingpage');


Route::get('how-do-you-want-to-start' , [FrontendController::class , 'start'])->name('start');
Route::get('advertising/advertising-video' , [FrontendController::class, 'advertisingVideo'])->name('advertising.advertisingVideo');
Route::get('payments' , [PaymentController::class , 'index'])->name('payment.index');
Route::get('logins' , [FrontendController::class , 'logins'])->name('logins.index');
Route::get('summary' , [FrontendController::class , 'summary'])->name('summary.index');
Route::get('customer-data' , [FrontendController::class , 'customerData'])->name('customerData.index');
Route::post('/customer-data/store', [FrontendController::class,'store'])->name('customerData.store');
// Add this route to handle checkout with parameters
Route::get('/payment/checkout', [PaymentController::class, 'checkout'])->name('payment.checkout');
Route::get('my-advertising' , [FrontendController::class , 'myAdvertising'])->name('myAdvertising.index');
Route::post('/payment/upload', [FrontendController::class, 'upload'])->name('payment.upload');
Route::get('/payment/get-file', [FrontendController::class, 'getUploadedFile'])->name('payment.get.file');
Route::delete('/payment/clear-file', [FrontendController::class, 'clearUploadedFile'])
     ->name('payment.clear.file');
Route::get('/select-package', [FrontendController::class, 'selectPackage'])
     ->name('package.select');
Route::post('/checkout', [PaymentController::class,'checkout'])->name('checkout');
Route::get('/payment/success', [PaymentController::class,'success'])->name('payment.success');
Route::get('/payment/cancel',  [PaymentController::class,'cancel'])->name('payment.cancel');



//
Route::middleware([ 'adminuser','auth', 'verified'])->group(function () {


 //Tablets
    Route::get('/dashboard', [TabletsController::class, 'index'])
    ->name('dashboard');

    Route::get('/dashboard/add-tabs', function () {
        return view('add-tabs');
    })->name('tablet.add');

    Route::post('/dashboard/add-tabs', [TabletsController::class, 'addTab'])
    ->name('tablet.addTabs');

    Route::get('/dashboard/{id}/edit-tabs', [TabletsController::class, 'edit'])
    ->name('tablet.edit');
    Route::put('/dashboard/{id}/edit-tabs', [TabletsController::class, 'editTab'])
    ->name('tablet.update');

    Route::get('/dashboard/{id}/delete', [TabletsController::class, 'delete'])
    ->name('tablet.delete');




    // Ads Management
    Route::get('/ads-management', [AdvertisementController::class, 'index'])
    ->name('adsmanagement');

    Route::get('/ads-management/add', [AdvertisementController::class, 'add'])
    ->name('adsmanagement.add');
    Route::post('/ads-management/add', [AdvertisementController::class, 'addAds'])
    ->name('adsmanagement.addAds');

    Route::get('/ads-management/{id}/edit-ads', [AdvertisementController::class, 'edit'])
    ->name('adsmanagement.edit');
    Route::put('/ads-management/{id}/edit-ads', [AdvertisementController::class, 'editAds'])
    ->name('adsmanagement.update');

    Route::get('/ads-management/{id}/delete', [AdvertisementController::class, 'delete'])
    ->name('adsmanagement.delete');

    Route::get('/abc/{id}', [AdvertisementController::class, 'myedit'])
    ->name('adsmanagement.deletePic');


// Geo Targeted Ads
    Route::get('/geo-target-ads', [LocationAdsController::class, 'index'])
    ->name('geotargetads');

    Route::get('/geo-target-ads/add', [LocationAdsController::class, 'add'])
    ->name('geotargetads.add');
    Route::post('/geo-target-ads/add', [LocationAdsController::class, 'addAds'])
    ->name('geotargetads.addAds');

    Route::get('/geo-target-ads/{id}/edit-ads', [LocationAdsController::class, 'edit'])
    ->name('geotargetads.edit');
    Route::put('/geo-target-ads/{id}/edit-ads', [LocationAdsController::class, 'editAds'])
    ->name('geotargetads.update');

    Route::get('/geo-target-ads/{id}/delete', [LocationAdsController::class, 'delete'])
    ->name('geotargetads.delete');



    ///Quiz Route

    Route::get('/quiz',[QuizController::class,'index'])->name('quiz.add');
    Route::get('/quiz/create',[QuizController::class,'create'])->name('quiz.create');
    Route::post('/quiz/store',[QuizController::class,'store'])->name('quiz.store');
    Route::get('/quiz/{id}/edit',[QuizController::class,'edit'])->name('quiz.edit');
    Route::post('/quiz/{id}/update',[QuizController::class,'update'])->name('quiz.update');
    Route::get('/quiz/{id}/delete',[QuizController::class,'delete'])->name('quiz.delete');
    Route::post('/total-quiz', [QuizController::class, 'totalQuiz'])->name('total.quiz');

    Route::resource('category' , CategoryController::class);
    Route::resource('sub-category' , SubCategoryController::class);
    Route::resource('plan' , PlanController::class);
    Route::resource('plan-item' , PlanItemController::class);

});






Route::middleware('auth')->group(function () {
    Route::view('about', 'about')->name('about');

    Route::get('users', [UserController::class, 'index'])->name('users.index');

    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__ . '/auth.php';
