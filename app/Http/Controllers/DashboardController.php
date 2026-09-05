<?php
namespace App\Http\Controllers;
use App\Models\{Journal,SalesInvoice,PurchaseBill,AccountingPeriod};
class DashboardController {public function __invoke(){ $c=auth()->user()->company_id;return view('dashboard.index',['postedJournals'=>Journal::forCompany($c)->where('status','posted')->count(),'openPeriods'=>AccountingPeriod::forCompany($c)->where('status','open')->count(),'sales'=>SalesInvoice::forCompany($c)->where('status','posted')->sum('base_total'),'purchases'=>PurchaseBill::forCompany($c)->where('status','posted')->sum('base_total')]);}}
