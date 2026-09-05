<?php
namespace Tests\Unit;
use App\Support\Decimal;use PHPUnit\Framework\TestCase;use InvalidArgumentException;
class DecimalTest extends TestCase {public function test_money_rounding_is_decimal_and_deterministic():void{$this->assertSame('0.100',Decimal::money('0.1'));$this->assertSame('0.300',Decimal::add('0.100','0.200'));$this->assertSame('0.071',Decimal::mul('0.100','0.709'));}public function test_float_input_is_rejected():void{$this->expectException(InvalidArgumentException::class);Decimal::of(0.1);}}
