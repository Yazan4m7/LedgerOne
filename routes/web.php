<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\{AuthController,DashboardController,AccountController,JournalController,PeriodController,ContactController,TaxCodeController,FxController,SalesController,PurchaseController,PaymentController,ReportController,SettingsController,UserController,AuditController};

Route::middleware('guest')->group(function(){Route::get('/login',[AuthController::class,'show'])->name('login');Route::post('/login',[AuthController::class,'login'])->middleware('throttle:10,1')->name('login.attempt');});
Route::post('/logout',[AuthController::class,'logout'])->middleware('auth')->name('logout');

Route::middleware(['auth','company'])->group(function(){
 Route::get('/',DashboardController::class)->middleware('permission:dashboard.view')->name('dashboard');
 Route::get('/accounts',[AccountController::class,'index'])->middleware('permission:accounts.manage')->name('accounts.index');
 Route::post('/accounts',[AccountController::class,'store'])->middleware('permission:accounts.manage')->name('accounts.store');
 Route::put('/accounts/{account}',[AccountController::class,'update'])->middleware('permission:accounts.manage')->name('accounts.update');

 Route::get('/journals',[JournalController::class,'index'])->middleware('permission:journals.view')->name('journals.index');
 Route::get('/journals/create',[JournalController::class,'create'])->middleware('permission:journals.create')->name('journals.create');
 Route::post('/journals',[JournalController::class,'store'])->middleware('permission:journals.create')->name('journals.store');
 Route::get('/journals/{journal}',[JournalController::class,'show'])->middleware('permission:journals.view')->name('journals.show');
 Route::post('/journals/{journal}/post',[JournalController::class,'post'])->middleware('permission:journals.post')->name('journals.post');
 Route::post('/journals/{journal}/reverse',[JournalController::class,'reverse'])->middleware('permission:journals.reverse')->name('journals.reverse');

 Route::get('/periods',[PeriodController::class,'index'])->middleware('permission:periods.manage')->name('periods.index');
 Route::post('/periods/{period}/close',[PeriodController::class,'close'])->middleware('permission:periods.close')->name('periods.close');
 Route::post('/periods/{period}/reopen',[PeriodController::class,'reopen'])->middleware('permission:periods.reopen')->name('periods.reopen');
 Route::post('/fiscal-years/{year}/close',[PeriodController::class,'closeYear'])->middleware('permission:fiscal_year.close')->name('years.close');
 Route::post('/fiscal-years/{year}/reopen',[PeriodController::class,'reopenYear'])->middleware('permission:fiscal_year.reopen')->name('years.reopen');

 Route::get('/contacts',[ContactController::class,'index'])->middleware('permission:contacts.manage')->name('contacts.index');
 Route::post('/contacts',[ContactController::class,'store'])->middleware('permission:contacts.manage')->name('contacts.store');
 Route::put('/contacts/{contact}',[ContactController::class,'update'])->middleware('permission:contacts.manage')->name('contacts.update');

 Route::get('/tax-codes',[TaxCodeController::class,'index'])->middleware('permission:taxes.manage')->name('taxes.index');
 Route::post('/tax-codes',[TaxCodeController::class,'store'])->middleware('permission:taxes.manage')->name('taxes.store');
 Route::put('/tax-codes/{taxCode}',[TaxCodeController::class,'update'])->middleware('permission:taxes.manage')->name('taxes.update');

 Route::get('/fx',[FxController::class,'index'])->middleware('permission:fx.manage')->name('fx.index');
 Route::post('/fx/rates',[FxController::class,'store'])->middleware('permission:fx.manage')->name('fx.store');
 Route::post('/fx/revalue',[FxController::class,'revalue'])->middleware('permission:fx.revalue')->name('fx.revalue');

 Route::get('/sales',[SalesController::class,'index'])->middleware('permission:sales.manage')->name('sales.index');
 Route::get('/sales/create',[SalesController::class,'create'])->middleware('permission:sales.manage')->name('sales.create');
 Route::post('/sales',[SalesController::class,'store'])->middleware('permission:sales.manage')->name('sales.store');
 Route::get('/sales/{invoice}',[SalesController::class,'show'])->middleware('permission:sales.manage')->name('sales.show');
 Route::post('/sales/{invoice}/post',[SalesController::class,'post'])->middleware('permission:sales.post')->name('sales.post');
 Route::post('/sales/{invoice}/credit',[SalesController::class,'credit'])->middleware('permission:sales.manage')->name('sales.credit');

 Route::get('/purchases',[PurchaseController::class,'index'])->middleware('permission:purchases.manage')->name('purchases.index');
 Route::get('/purchases/create',[PurchaseController::class,'create'])->middleware('permission:purchases.manage')->name('purchases.create');
 Route::post('/purchases',[PurchaseController::class,'store'])->middleware('permission:purchases.manage')->name('purchases.store');
 Route::get('/purchases/{bill}',[PurchaseController::class,'show'])->middleware('permission:purchases.manage')->name('purchases.show');
 Route::post('/purchases/{bill}/post',[PurchaseController::class,'post'])->middleware('permission:purchases.post')->name('purchases.post');
 Route::post('/purchases/{bill}/credit',[PurchaseController::class,'credit'])->middleware('permission:purchases.manage')->name('purchases.credit');

 Route::get('/payments',[PaymentController::class,'index'])->middleware('permission:payments.manage')->name('payments.index');
 Route::get('/payments/create',[PaymentController::class,'create'])->middleware('permission:payments.manage')->name('payments.create');
 Route::post('/payments',[PaymentController::class,'store'])->middleware('permission:payments.manage')->name('payments.store');
 Route::post('/payments/{payment}/void',[PaymentController::class,'void'])->middleware('permission:payments.void')->name('payments.void');

 Route::get('/reports',[ReportController::class,'index'])->middleware('permission:reports.view')->name('reports.index');
 Route::get('/reports/trial-balance',[ReportController::class,'trial'])->middleware('permission:reports.view')->name('reports.trial');
 Route::get('/reports/general-ledger',[ReportController::class,'ledger'])->middleware('permission:reports.view')->name('reports.ledger');
 Route::get('/reports/profit-loss',[ReportController::class,'pnl'])->middleware('permission:reports.view')->name('reports.pnl');
 Route::get('/reports/balance-sheet',[ReportController::class,'balance'])->middleware('permission:reports.view')->name('reports.balance');
 Route::get('/reports/ar-aging',[ReportController::class,'ar'])->middleware('permission:reports.view')->name('reports.ar');
 Route::get('/reports/ap-aging',[ReportController::class,'ap'])->middleware('permission:reports.view')->name('reports.ap');
 Route::get('/reports/tax-summary',[ReportController::class,'tax'])->middleware('permission:reports.view')->name('reports.tax');

 Route::get('/settings',[SettingsController::class,'edit'])->middleware('permission:settings.manage')->name('settings.index');
 Route::put('/settings',[SettingsController::class,'update'])->middleware('permission:settings.manage')->name('settings.update');
 Route::get('/users',[UserController::class,'index'])->middleware('permission:users.manage')->name('users.index');
 Route::post('/users',[UserController::class,'store'])->middleware('permission:users.manage')->name('users.store');
 Route::put('/users/{user}',[UserController::class,'update'])->middleware('permission:users.manage')->name('users.update');
 Route::get('/audit',[AuditController::class,'index'])->middleware('permission:audit.view')->name('audit.index');
});
