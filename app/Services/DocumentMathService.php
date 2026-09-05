<?php
namespace App\Services;
use App\Models\TaxCode;
use App\Support\Decimal;
use Brick\Math\BigDecimal;
use Brick\Math\RoundingMode;
use Illuminate\Validation\ValidationException;
class DocumentMathService {public function calculate(int $companyId,array $lines):array{$subtotal=BigDecimal::zero();$tax=BigDecimal::zero();$out=[];foreach(array_values($lines) as $i=>$l){$qty=BigDecimal::of((string)$l['quantity']);$price=BigDecimal::of((string)$l['unit_price']);if($qty->isLessThanOrEqualTo(0)||$price->isNegative())throw ValidationException::withMessages(['lines'=>'Quantity must be positive and price non-negative.']);$sub=$qty->multipliedBy($price)->toScale(3,RoundingMode::HALF_UP);$taxAmt=BigDecimal::zero();if(!empty($l['tax_code_id'])){$tc=TaxCode::where('company_id',$companyId)->whereKey($l['tax_code_id'])->where('active',true)->firstOrFail();$taxAmt=$sub->multipliedBy($tc->rate)->dividedBy(100,3,RoundingMode::HALF_UP);}$subtotal=$subtotal->plus($sub);$tax=$tax->plus($taxAmt);$out[]=array_merge($l,['line_no'=>$i+1,'line_subtotal'=>(string)$sub,'tax_amount'=>(string)$taxAmt]);}return ['lines'=>$out,'subtotal'=>(string)$subtotal->toScale(3,RoundingMode::HALF_UP),'tax_total'=>(string)$tax->toScale(3,RoundingMode::HALF_UP),'total'=>(string)$subtotal->plus($tax)->toScale(3,RoundingMode::HALF_UP)];}}
