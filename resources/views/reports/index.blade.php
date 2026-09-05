@extends('layouts.app') @section('title','Reports') @section('content')<h1>Reports</h1><div class="grid">
<div class="card"><h3>Trial Balance</h3><form method="get" action="{{ route('reports.trial') }}"><label>From<input type="date" name="from" required></label><label>To<input type="date" name="to" required></label><button>Run</button></form></div>
<div class="card"><h3>Profit & Loss</h3><form method="get" action="{{ route('reports.pnl') }}"><label>From<input type="date" name="from" required></label><label>To<input type="date" name="to" required></label><button>Run</button></form></div>
<div class="card"><h3>Balance Sheet</h3><form method="get" action="{{ route('reports.balance') }}"><label>As of<input type="date" name="as_of" required></label><button>Run</button></form></div>
<div class="card"><h3>AR Aging</h3><form method="get" action="{{ route('reports.ar') }}"><label>As of<input type="date" name="as_of" required></label><button>Run</button></form></div>
<div class="card"><h3>AP Aging</h3><form method="get" action="{{ route('reports.ap') }}"><label>As of<input type="date" name="as_of" required></label><button>Run</button></form></div>
<div class="card"><h3>Tax Summary</h3><form method="get" action="{{ route('reports.tax') }}"><label>From<input type="date" name="from" required></label><label>To<input type="date" name="to" required></label><button>Run</button></form></div>
</div>@endsection
