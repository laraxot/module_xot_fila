<?php

declare(strict_types=1);

namespace Modules\Xot\Services;

use Illuminate\Database\Eloquent\Model;

/**
 * Class SqlService.
 */
class SqlService
{
    public static function getCoalesceDateRange(
        Model $model,
        ?int $date_min = null,
        ?int $date_max = null,
        ?string $from_field = null,
        ?string $to_field = null
    ): string {
        if ($from_field === null) {
            $from_field = $model->getAttributeValue('from_field');
        }
        if ($to_field === null) {
            $to_field = $model->getAttributeValue('to_field');
        }
        if ($date_min !== null) {
            $dal = 'if('.$from_field.'=0 or '.$from_field.'<'.$date_min.' ,'.$date_min.','.$from_field.')';
        } else {
            $dal = $from_field;
        }
        if ($date_max !== null) {
            $al = 'if('.$to_field.'=0 or '.$to_field.'>'.$date_max.' ,'.$date_max.','.$to_field.')';
        } else {
            $al = $from_field;
        }
        return 'COALESCE(sum(greatest(datediff('.$al.','.$dal.')+1,0)),0)';
    }
}
