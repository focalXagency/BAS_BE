<?php


use App\Http\Controllers\Api\AdminController;

use App\Http\Controllers\Api\CaseStudyController;
use App\Http\Controllers\Api\CaseStudyCategoryController;
use App\Http\Controllers\Api\CompanyProfileController;
use App\Http\Controllers\Api\FileController;




use App\Http\Controllers\Api\ReviewController;

use App\Http\Controllers\Api\FAQsController;
use App\Http\Controllers\Api\InboxMessagesController;
use App\Http\Controllers\Api\LatestProjectController;
use App\Http\Controllers\Api\ProjectLogoController;
use App\Http\Controllers\Api\ServiceController;


use App\Http\Controllers\Api\FolderController;
use App\Http\Controllers\Api\FooterController;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\TeamController;
use App\Http\Controllers\Api\UserController;


use App\Http\Controllers\Api\PermissionController;

use Illuminate\Support\Facades\Route;


/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::controller(AuthController::class)->group(function () {
    Route::post('login', 'login');
    Route::post('register', 'register');
    Route::post('logout', 'logout');
    Route::post('refresh', 'refresh');
    Route::post('forgetPassword', 'forgotPassword');
    Route::post('resetPassword' , 'resetPassword');

});

Route::prefix('admin')->group(function () {
    Route::get('/dashboard', [AdminController::class, 'index']);
    Route::post('dashboard/{id}', [AdminController::class, 'store']);
});


//------------------------------Review Routes--------------------------------------//
Route::group(['prefix'=>'home'],function(){

    //show all Reviews
    Route::get('/review',[ReviewController::class,'index']);
    //show a specific review
    Route::get('/review/{review_id}',[ReviewController::class,'show']);
    //insert new review
    Route::post('/review',[ReviewController::class,'store']);
    //update existing review
    Route::post('/review/{review_id}',[ReviewController::class,'update']);
    //remove existing review
    Route::delete('/review/{review_id}',[ReviewController::class,'destroy']);
    //remove all reviews
    Route::get('/destroyall',[ReviewController::class,'destroy_all']);


//------------------------------FAQs Routes--------------------------------------//

    //show most frequent questions
    Route::get('/questions',[FAQsController::class,'index']);
    //show a specific question
    Route::get('/question/{question_id}',[FAQsController::class,'show']);
    //insert new question
    Route::post('/question',[FAQsController::class,'store']);
    //update existing question
    Route::post('/question/{question_id}',[FAQsController::class,'update']);
    //remove existing review
    Route::delete('/question/{question_id}',[FAQsController::class,'destroy']);
    //remove all reviews
    Route::get('/destroyall',[FAQsController::class,'destroy_all']);


//------------------------------Our Team Routes--------------------------------------//

    //show all team members
    Route::get('/members',[TeamController::class,'index']);
    //show a specific member
    Route::get('/member/{member_id}',[TeamController::class,'show']);


//------------------------------Inbox Messages(contact us) Routes--------------------------------------//

    //show all the inbox messages
    Route::get('/messages',[InboxMessagesController::class,'index']);
    //show a specific message
    Route::get('/messages/{message_id}',[InboxMessagesController::class,'show']);
    //fill the contact us form
    Route::post('/message',[InboxMessagesController::class,'store']);
    //update existing message
    Route::post('/message/{message_id}',[InboxMessagesController::class,'update']);
    //remove existing message
    Route::delete('/message/{message_id}',[InboxMessagesController::class,'destroy']);
    //remove all messages
    Route::get('/destroyall',[InboxMessagesController::class,'destroy_all']);


//------------------------------latest projects Routes--------------------------------------//

    //show all the latest projects
    Route::get('/projects',[LatestProjectController::class,'index']);
    //show a specific project
    Route::get('/project/{project_id}',[LatestProjectController::class,'show']);
    //add a new project
    Route::post('/project',[LatestProjectController::class,'store']);
    //update existing project
    Route::post('/project/{project_id}',[LatestProjectController::class,'update']);
    //remove existing project
    Route::delete('/project/{project_id}',[LatestProjectController::class,'destroy']);
    //remove all messages
    Route::get('/destroyall',[LatestProjectController::class,'destroy_all']);


//------------------------------latest projects logos Routes--------------------------------------//
    //show all the latest project logos
    Route::get('/logos',[ProjectLogoController::class,'index']);
    //show a specific logo
    Route::get('/logo/{logo_id}',[ProjectLogoController::class,'show']);


//------------------------------Services Routes--------------------------------------//

    //show all the services
    Route::get('/services',[ServiceController::class,'index']);
    //show a specific service
    Route::get('/service/{service_id}',[ServiceController::class,'show']);
    //add a new service
    Route::post('/service',[ServiceController::class,'store']);
    //update existing service
    Route::post('/service/{service_id}',[ServiceController::class,'update']);
    //remove existing service
    Route::delete('/service/{servivce_id}',[ServiceController::class,'destroy']);
    //remove all services
    Route::get('/destroyall',[ServiceController::class,'destroy_all']);

//------------------------------view project--------------------------------------//
    Route::group(['prefix'=>'view_project'],function(){
    //show a specific company profile
    Route::get('/companyprofile/{companyprofile_id}' , [CompanyProfileController::class,'show' ]);
    });
    });

    Route::group(['prefix'=>'case'],function(){

//------------------------------Case Study Category--------------------------------------//


     //show all case studies categories with paginate
     Route::get('/categories' , [CaseStudyCategoryController::class , 'index']);
     //show a specific category
     Route::get('/category/{catrgory_id}' , [CaseStudyCategoryController::class , 'show']);


//------------------------------Case Study Routes--------------------------------------//

    //show all case studies
    Route::get('/casestudy' , [CaseStudyController::class , 'index']);
    //add a new case study
    Route::post('/casestudy' , [CaseStudyController::class , 'store']);
    //show a specific case study
    Route::get('/casestudy/{category_id}' , [CaseStudyController::class,'show' ]);
    //update exisiting case study
    Route::post('casestudy/{casestudy_id}', [CaseStudyController::class, 'update']);
    //delete exisiting case study
    Route::delete('casestudy/{id}', [CaseStudyController::class, 'destroy']);

    });

//------------------------------Cpmpany Profile Routes--------------------------------------//

    //show all company profiles
    Route::get('/companyprofile' , [CompanyProfileController::class , 'index']);

    //show a specific company profile
    Route::get('/companyprofile/{companyprofile_id}' , [CompanyProfileController::class,'show' ]);

    Route::group(['prefix'=>'admin'],function(){

//------------------------------Files Routes--------------------------------------//

    //show all the files
    Route::get('/files' , [FileController::class , 'index']);
    //add a new file
    Route::post('/file' , [FileController::class , 'store']);
    //show a specific file
    Route::get('/file/{file_id}' , [FileController::class,'show' ]);
    //update an exisiting file
    Route::post('file/{file_id}', [FileController::class, 'update']);
    //delete exisiting file
    Route::delete('file/{file_id}', [FileController::class, 'destroy']);


//------------------------------Folder Routes--------------------------------------//

    //show all the folders
    Route::get('/folders' , [FolderController::class , 'index']);
    //add a new folder
    Route::post('/folder' , [FolderController::class , 'store']);
    //show a specific folder
    Route::get('/folder/{folder_id}' , [FolderController::class,'show' ]);
    //upadte an exisiting folder
    Route::post('folder/{folder_id}', [FolderController::class, 'update']);
    //delete an exisiting folder
    Route::delete('folder/{folder_id}', [FolderController::class, 'destroy']);

    });

    Route::get('/roles', [PermissionController::class,'Permission']);

    // Allow the user to upload files to the server
    Route::post('/uploadFile', [UserController::class, 'uploadFile']);

    // Allow the users to download the files
    Route::get('/downloadFile/{fileName}', [UserController::class, 'downloadFile']);

    // The admin can update the total space of the users
    Route::post('/updateTotalSpace/{userId}', [AdminController::class, 'updateTotalSpace']);
