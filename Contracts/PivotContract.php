<?php

declare(strict_types=1);

namespace Modules\Xot\Contracts;

use Illuminate\Database\Eloquent\Collection;

/**
 * Modules\Xot\Contracts\PivotContract.
 *
 * @property string|null                    $title
 * @property string|null                    $subtitle
 * @property string|null                    $price
 * @property string|null                    $price_currency
 * @property int|null                       $status
 * @property Collection|array<ProductContract>   $products
 * @property Collection|array<ChangeCatContract> $changeCats
 *
 * @method mixed update($params)
 *
 * @mixin \Eloquent
 */
interface PivotContract
{
}
