<?php

namespace App\Enums;

use BenSampo\Enum\Enum;

/**
 * @method static static OptionOne()
 * @method static static OptionTwo()
 * @method static static OptionThree()
 */
final class Typediscount extends Enum
{
    const BYUSER =   1;
    const BYPRODUCT =   2;
    const  BYSHIP = 3;
    public static function getTypesOfDiscount($type)
    {
        if ($type == 1) {
            return 'Khuyến mãi theo người dùng';
        } else if ($type == 2) return 'Khuyến mãi sản phẩm';
        else return 'Khuyến mãi phí vận chuyển';
    }
}
