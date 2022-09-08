<?php

declare(strict_types=1);

namespace Modules\Xot\Services;

use Illuminate\Support\Collection;
use Illuminate\Database\Eloquent\Model;
use Modules\Xot\Contracts\PanelContract;
use Modules\Xot\Models\Panels\Actions\XotBasePanelAction;


/**
 * Undocumented class
 *

 */
class TreeService {

    /**
     * @param \Illuminate\Database\Eloquent\Collection|Model[] $coll
     */
    public static function mapItems(Collection $coll, ?PanelContract $parent, /* bool $in_admin, */ array $route_params): Collection {
        return $coll->map(
            function ($item) use ($parent, $route_params) {
                $panel = PanelService::make()->get($item)->setParent($parent);
                $panel->setInAdmin(true);
                $panel->setRouteParams($route_params);
                // dddx($panel->getXotModelName());

                if (method_exists($panel, 'getActs')) {
                    $acts = $panel->getActs();
                } else {
                    $acts = [
                        [
                            'title' => 'modifica '.$panel->getXotModelName(),
                            'url' => $panel->url('edit'),
                        ],
                        [
                            'title' => 'crea '.$panel->getXotModelName(),
                            'url' => $panel->url('create'),
                        ],
                    ];
                }
                // *
                /**
                 * @var  Collection<XotBasePanelAction>
                 */
                $itemActions=$panel->itemActions();
                foreach ($itemActions as $action) {
                    // $action->btnHtml(['title' => true, 'class' => 'dropdown-item','in_admin'=>$in_admin])
                    $act = [
                        'title' => $action->getTitle(),
                        'url' => $action->getUrl(),
                    ];
                    $acts[] = $act;
                }
                // */
                // dddx($panel);
                if (! method_exists($panel, 'subsIconMenuAdmin')) {
                    throw new \Exception('in ['.\get_class($panel).'] not exist [subsIconMenuAdmin] method');
                }

                return [
                    'id' => $panel->id(),
                    'title' => $panel->title(),
                    'acts' => $acts,
                    'open' => false,
                    'subsIconMenuAdmin' => $panel->subsIconMenuAdmin(), // mi dice se ha figli oppure no, per visualizzare (o no) l'icona freccetta delle sottovoci
                ];
            }
        );
    }
}
