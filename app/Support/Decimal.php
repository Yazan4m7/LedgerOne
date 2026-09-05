<?php
namespace App\Support;
use Brick\Math\BigDecimal;
use Brick\Math\RoundingMode;
use InvalidArgumentException;
final class Decimal {
 public static function of(string|int $v): BigDecimal {if(is_float($v)) throw new InvalidArgumentException('Float input is forbidden for accounting amounts.'); return BigDecimal::of((string)$v);}
 public static function money(string|int $v, int $scale=3): string {return self::of($v)->toScale($scale,RoundingMode::HALF_UP)->__toString();}
 public static function mul(string|int $a,string|int $b,int $scale=3): string {return self::of($a)->multipliedBy(self::of($b))->toScale($scale,RoundingMode::HALF_UP)->__toString();}
 public static function add(string ...$v): string {$x=BigDecimal::zero(); foreach($v as $n)$x=$x->plus($n); return $x->toScale(3,RoundingMode::HALF_UP)->__toString();}
 public static function sub(string $a,string $b): string {return self::of($a)->minus($b)->toScale(3,RoundingMode::HALF_UP)->__toString();}
 public static function cmp(string $a,string $b):int{return self::of($a)->compareTo($b);} public static function abs(string $a):string{return self::of($a)->abs()->toScale(3,RoundingMode::HALF_UP)->__toString();}
}