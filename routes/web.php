<?php

use App\Http\Controllers\AcademicYearController;
use App\Http\Controllers\CityController;
use App\Http\Controllers\EducationController;
use App\Http\Controllers\BatchesController;
use App\Http\Controllers\CategoriesController;
use App\Http\Controllers\CoursesController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\StudentsController;
use App\Http\Controllers\GradeSystemController;
use App\Http\Controllers\ApplicantsController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ShiftsController;
use App\Http\Controllers\SessionsController;
use App\Http\Controllers\EmployeesController;
use App\Http\Controllers\FeeTypesController;
use App\Http\Controllers\FeeController;
use App\Http\Controllers\PDFController;
use App\Http\Controllers\DesignationsController;
use App\Http\Controllers\ExamTypesController;
use App\Http\Controllers\ExamsController;
use App\Http\Controllers\CourseNamesController;
use App\Http\Controllers\ForStudentController;
use App\Http\Controllers\CertificatesController;
use App\Http\Controllers\CertTypeController;
use App\Http\Controllers\ExpenseTypeController;
use App\Http\Controllers\ExpenseController;
use App\Http\Controllers\SalaryController;
use App\Http\Controllers\EventsController;
use Illuminate\Support\Facades\Auth;


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

// default route
Route::get('/', function () {
    return view('auth.login');
});

Auth::routes();

Route::group(['middleware' => ['auth', 'is_student', 'preventBackHistory']],function () {
    Route::get('/student/dashboard/{id}', [ForStudentController::class, 'Dashboard'])
        ->name('std_dashboard');
    Route::get('/student/feeDetails/{id}', [ForStudentController::class, 'FeeDetails'])
        ->name('std_feeDetails');
    Route::get('/student/stdPaymentsHistory/{id}', [ForStudentController::class, 'stdPaymentsHistory'])
        ->name('stdPaymentsHistory');
        
});

Route::group(['middleware' => ['auth', 'is_admin', 'preventBackHistory']], function () {
    Route::resource('designations', DesignationsController::class);
    Route::resource('roles', RoleController::class);
    Route::resource('users', UserController::class);
    
    Route::resource('sessions', SessionsController::class);
    Route::resource('events', EventsController::class);
    Route::resource('cities', CityController::class);
    Route::resource('education', EducationController::class);
    Route::resource('examTypes', ExamTypesController::class);
    Route::resource('exams', ExamsController::class);
    Route::resource('shifts', ShiftsController::class);
    Route::resource('employees', EmployeesController::class);
    Route::resource('fees', FeeController::class);
    Route::resource('fee_types', FeeTypesController::class);
    Route::resource('expense_types', ExpenseTypeController::class);
    Route::resource('expenses', ExpenseController::class);
    Route::resource('salaries', SalaryController::class);
    Route::resource('students', StudentsController::class);
    Route::resource('applicants', ApplicantsController::class);
    Route::resource('batches', BatchesController::class);
    Route::resource('courseNames', CourseNamesController::class);
    Route::resource('categories', CategoriesController::class);
    Route::resource('academic_years', AcademicYearController::class);
    Route::resource('gradeSystems', GradeSystemController::class);
    Route::resource('certTypes', certTypeController::class);
    Route::get('/dashboard', [HomeController::class, 'index'])->name('home');
    Route::get('getBatches/{id}', [StudentsController::class, 'getBatches']);
    Route::get('getSessions/{id}', [StudentsController::class, 'getSessions']);
    Route::get('getEmployee/{id}', [EmployeesController::class, 'getEmployee']);
    Route::get('getFeetypeFee/{id}', [StudentsController::class, 'getFeetypeFee']);
    Route::get('getStudentsViaSessionShift/{id}', [StudentsController::class, 'getStudentsViaSessionShift']);
    Route::get('getStudentsViaCourse/{id}', [StudentsController::class, 'getStudentsViaCourse']);
    Route::get('getBatchStudents/{id}', [StudentsController::class, 'getBatchStudents']);
    Route::get('students/createParent/{id}', [StudentsController::class, 'createParent'])
        ->name('students.createParent');
    Route::post('students/storeParent/{id}', [StudentsController::class, 'storeParent'])
        ->name('students.storeParent');
    Route::get('students/viewParents/{id}', [StudentsController::class, 'viewParents'])
        ->name('students.viewParents');
    Route::get('students/emergencyContact/{id}', [StudentsController::class, 'emergencyContact'])
        ->name('students.emergencyContact');
    Route::post('students/storeEmergencyContact/{id}', [StudentsController::class, 'storeEmergencyContact'])
        ->name('students.storeEmergencyContact');
    Route::get('students/previousData/{id}', [StudentsController::class, 'previousData'])
        ->name('students.previousData');
    Route::post('/students/storePreviousData/{id}', [StudentsController::class, 'storePreviousData'])
        ->name('students.storePreviousData');
    Route::get('/students/showParents/{id}', [StudentsController::class, 'showParents'])
        ->name('students.showParents');
    Route::put('/students/updateEmergencyContact/{id}', [StudentsController::class, 'updateEmergencyContact'])
        ->name('students.updateEmergencyContact');
    Route::get('/students/editPreviousData/{id}', [StudentsController::class, 'editPreviousData'])
        ->name('students.editPreviousData');
    Route::put('/students/updatePreviousData/{id}', [StudentsController::class, 'updatePreviousData'])
        ->name('students.updatePreviousData');
    Route::put('/students/update/{id}', [StudentsController::class, 'update'])
        ->name('students.update');
    Route::get('/students/editParent/{id}', [StudentsController::class, 'editParent'])
        ->name('students.editParent');
    Route::put('/students/updateParent/{id}', [StudentsController::class, 'updateParent'])
        ->name('students.updateParent');
    Route::get('/students/studentDetailsPDF/{id}', [StudentsController::class, 'studentDetailsPDF'])
        ->name('students.studentDetailsPDF');
    Route::get('/students/fees/feeSlipPDF/{id}', [FeeController::class, 'studentFeeSlipPDF'])
        ->name('students.fees.studentFeeSlipPDF');
        Route::post('/fees/feeSearch', [FeeController::class, 'feeSearch'])
        ->name('fees.feeSearch');
        Route::post('/fees/feeSearchBySlipNo', [FeeController::class, 'feeSearchBySlipNo'])
         ->name('fees.feeSearchBySlipNo');
         Route::get('/fees/showDetails/{id}', [FeeController::class, 'showDetails'])
         ->name('fees.showDetails');
         Route::get('/fees/createFee/{id}', [FeeController::class, 'createFee'])
         ->name('fees.createFee');
         Route::get('/fees_types/addfee', [FeeTypesController::class, 'add_fee'])
         ->name('feetypes.addfee');
         Route::post('/fees_types/storeAddFee', [FeeTypesController::class, 'store_add_fee'])
         ->name('feetypes.storeAddFee');
         Route::get('/fees_types/editaddfee/{id}', [FeeTypesController::class, 'edit_add_fee'])
         ->name('feetypes.editaddfee');
         Route::put('/fees_types/updateaddfee/{id}', [FeeTypesController::class, 'update_add_fee'])
         ->name('feetypes.updateaddfee');
         Route::delete('/fees_types/deleteaddfee/{id}', [FeeTypesController::class, 'delete_add_fee'])
         ->name('feetypes.deleteaddfee');
         
         Route::get('/exams/showStudentExams/{id}', [ExamsController::class, 'showStudentExams'])
         ->name('exams.showStudentExams');



        // Student Fee Routes
        Route::get('students/createFee/{id}', [StudentsController::class, 'createFee'])
        ->name('students.createFee');
        Route::post('students/storeFee/{id}', [StudentsController::class, 'storeFee'])
        ->name('students.storeFee');
        Route::get('students/viewFees/{id}', [StudentsController::class, 'viewFees'])
        ->name('students.viewFees');
        Route::get('students/viewFeeslip/{id}', [StudentsController::class, 'viewFeeslip'])
        ->name('students.viewFeeslip');

        Route::get('students/createNewFee/{id}', [StudentsController::class, 'createNewFee'])
        ->name('students.createNewFee');
        Route::post('students/storeNewFee/{id}', [StudentsController::class, 'storeNewFee'])
        ->name('students.storeNewFee');

        // Student certificates routes
        Route::resource('certificates', CertificatesController::class);
        Route::get('certificates/issue/{id}', [CertificatesController::class, 'issue'])
        ->name('certificates.issue');
        Route::post('certificates/saveIssue/{id}', [CertificatesController::class, 'saveIssue'])
        ->name('certificates.saveIssue');


    // Courses related routes

    Route::resource('/courses', CoursesController::class);
    Route::get('/courses/createBatch/{id}', [CoursesController::class, 'createBatch'])
        ->name('courses.createBatch');
    Route::post('/courses/storeBatch/{id}', [CoursesController::class, 'storeBatch'])
        ->name('courses.storeBatch');
    Route::get('/courses/editBatch/{id}', [CoursesController::class, 'editBatch'])
        ->name('courses.editBatch');
    Route::put('/courses/updateBatch/{id}', [CoursesController::class, 'updateBatch'])
        ->name('courses.updateBatch');
    Route::delete('/courses/deleteBatch/{id}', [CoursesController::class, 'deleteBatch'])
        ->name('courses.deleteBatch');
    Route::get('/configuration', function () {
        return view('configuration');
    });

    Route::get('generate-pdf', [PDFController::class, 'generatePDF']);

});

// Users change password related routes
Route::get('/users/changePassword/{id}', [UserController::class, 'createChangePassword'])
->name('users.changePassword');
Route::put('/users/updatePassword/{id}', [UserController::class, 'updateChangePassword'])
->name('users.updatePassword');
