<!doctype html><html lang="en"><head><meta charset="utf-8"><meta name="viewport" content="width=device-width,initial-scale=1"><title>@yield('title','LedgerOne')</title><link rel="stylesheet" href="/app.css"></head><body>
<header><strong>LedgerOne</strong>@auth <span>{{ auth()->user()->company->name }}</span><nav>
<a href="{{ route('dashboard') }}">Dashboard</a>
@if(auth()->user()->hasPermission('accounts.manage'))<a href="{{ route('accounts.index') }}">Accounts</a>@endif
@if(auth()->user()->hasPermission('journals.view'))<a href="{{ route('journals.index') }}">Journals</a>@endif
@if(auth()->user()->hasPermission('sales.manage'))<a href="{{ route('sales.index') }}">Sales</a>@endif
@if(auth()->user()->hasPermission('purchases.manage'))<a href="{{ route('purchases.index') }}">Purchases</a>@endif
@if(auth()->user()->hasPermission('payments.manage'))<a href="{{ route('payments.index') }}">Payments</a>@endif
@if(auth()->user()->hasPermission('reports.view'))<a href="{{ route('reports.index') }}">Reports</a>@endif
@if(auth()->user()->hasPermission('periods.manage'))<a href="{{ route('periods.index') }}">Periods</a>@endif
@if(auth()->user()->hasPermission('contacts.manage'))<a href="{{ route('contacts.index') }}">Contacts</a>@endif
@if(auth()->user()->hasPermission('taxes.manage'))<a href="{{ route('taxes.index') }}">Taxes</a>@endif
@if(auth()->user()->hasPermission('fx.manage'))<a href="{{ route('fx.index') }}">FX</a>@endif
@if(auth()->user()->hasPermission('settings.manage'))<a href="{{ route('settings.index') }}">Settings</a>@endif
@if(auth()->user()->hasPermission('users.manage'))<a href="{{ route('users.index') }}">Users</a>@endif
@if(auth()->user()->hasPermission('audit.view'))<a href="{{ route('audit.index') }}">Audit</a>@endif
<form method="post" action="{{ route('logout') }}" class="inline">@csrf<button>Logout</button></form></nav>@endauth</header>
<main>@if(session('ok'))<div class="ok">{{ session('ok') }}</div>@endif @if($errors->any())<div class="errors"><ul>@foreach($errors->all() as $e)<li>{{ $e }}</li>@endforeach</ul></div>@endif @yield('content')</main>
<script src="/app.js" defer></script></body></html>
