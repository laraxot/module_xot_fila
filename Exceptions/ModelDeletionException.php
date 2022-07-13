<?php
/**
 * @see https://dev.to/jackmiras/laravel-delete-actions-simplified-4h8b
 */

declare(strict_types=1);

namespace Modules\Xot\Exceptions;

use Illuminate\Http\Response;
use Illuminate\Support\Str;

class ModelDeletionException extends ApplicationException {
    private int $id;
    private string $model;

    public function __construct(int $id, string $model) {
        $this->id = $id;
        $this->model = Str::afterLast($model, '\\');
    }

    public function status(): int {
        return Response::HTTP_BAD_REQUEST;
    }

    public function help(): string {
        return trans('exception.model_not_deleted.help');
    }

    public function error(): string {
        return trans('exception.model_not_deleted.error', [
            'id' => $this->id,
            'model' => $this->model,
        ]);
    }
}
