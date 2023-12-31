<?php

declare(strict_types=1);

namespace Modules\Xot\Actions\Filament;

use Filament\Facades\Filament;
use Spatie\QueueableAction\QueueableAction;

class PrepareDefaultNavigation
{
    use QueueableAction;

    /**
     * Undocumented function.
     */
    public function execute(string $module, string $context): void
    {
        Filament::serving(
            static function () use ($module, $context): void {
                Filament::forContext(
                    'filament',
                    static function () use ($module, $context): void {
                        app(RegisterFilamentNavigationItem::class)->execute($module, $context);
                    }
                );
                Filament::forContext(
                    $context,
                    static function () use ($module, $context): void {
                        app(RenderContextNavigation::class)->execute($module, $context);
                    }
                );
            }
        );
    }
}
