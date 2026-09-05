<?php
namespace App\Http\Controllers;
use App\Models\AuditLog;
class AuditController {public function index(){return view('audit.index',['logs'=>AuditLog::forCompany(auth()->user()->company_id)->with('user')->latest()->paginate(100)]);}}
