<?php

declare(strict_types=1);

namespace Modules\Xot\Actions\Model\Update;

use Exception;
use Modules\Xot\DTOs\RelationDTO;
use Illuminate\Database\Eloquent\Model;
use Spatie\QueueableAction\QueueableAction;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class BelongsToAction {
    use QueueableAction;

    public function __construct() {
    }

    public function execute(Model $row, RelationDTO $relation): void {
        if(!$relation->rows instanceof BelongsTo){
            throw new Exception('['.__LINE__.']['.__FILE__.']');
        }
        $rows = $relation->rows;
        // $rows= $row->{$relation->name}();
        if (! \is_array($relation->data)) {
            $related = $rows->getRelated();
            $related = $related->find($relation->data);
            $res = $rows->associate($related);
            $res->save();

            return;
        }

        $fillable = collect($relation->related->getFillable())->merge($relation->related->getHidden());
        $data = collect($relation->data)->only($fillable)->all();

        if ($rows->exists()) {
            // $rows->update($data); // non passa per il mutator
            $row->{$relation->name}->update($data);

            return;
        }

        $related = $relation->related->create($data);
        $res = $rows->associate($related);
        $res->save();

        return;
    }
}
