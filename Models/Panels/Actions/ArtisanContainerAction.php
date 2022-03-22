<?php

declare(strict_types=1);

namespace Modules\Xot\Models\Panels\Actions;

//-------- models -----------

//-------- services --------
//-------- bases -----------
use Modules\Xot\Services\ArtisanService;

/**
 * Class ArtisanAction.
 */
class ArtisanContainerAction extends XotBasePanelAction {
    public bool $onContainer = true; //onlyContainer

    public bool $onItem = false; //onlyContainer

    public string $icon = '<i class="far fa-file-excel fa-1x"></i>';

    protected string $cmd;

    protected array $cmd_params;

    /**
     * ArtisanAction constructor.
     */
    public function __construct(string $cmd, array $cmd_params = []) {
        $this->cmd = $cmd;
        $this->cmd_params = $cmd_params;
    }

    /**
     * @return mixed
     */
    public function handle() {
        $out = ArtisanService::act($this->cmd);

        return $out.'<h3>+Done</h3>';
    }

    //end handle
}