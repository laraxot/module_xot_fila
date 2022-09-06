<?php
/**
 * @see https://www.itsolutionstuff.com/post/laravel-9-import-export-excel-and-csv-file-tutorialexample.html
 */

declare(strict_types=1);

namespace Modules\Xot\Models\Panels\Actions;

use Modules\Theme\Services\ThemeService;

/**
 * Class ModelGeneratorAction.
 */
class ModelGeneratorAction extends XotBasePanelAction {
    public bool $onItem = true;

    public string $icon = '<i class="fa fa-table"></i>';

    /**
     * @return mixed
     */
    public function handle() {
        /*
        $view = ThemeService::getView(); // xot::admin.home.acts.xls_import
        $view_params = [
            'view' => $view,
        ];

        return view()->make($view, $view_params);
        */
        return $this->panel->out();
    }

    /**
     * Undocumented function.
     *
     * @return mixed
     */
    public function postHandle() {
    }
}