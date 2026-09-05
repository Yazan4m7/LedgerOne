<?php
namespace App\Services;
use App\Models\SalesInvoice;
use LogicException;
final class JofotaraService {public function submit(SalesInvoice $invoice):never{throw new LogicException('JoFotara live submission is disabled until authorized credentials and live validation are available.');}}
