<?php

declare(strict_types=1);

namespace Modules\Xot\Models\Panels;

use Modules\Xot\Contracts\PanelTreeContract;

class XotBaseTreePanel extends XotBasePanel implements PanelTreeContract {
    /**
     * @return bool
     */
    public function treeSonsCount() {
        $count = 0;
        foreach ($this->treeSons() as $treeSon) {
            $count += count($treeSon);
        }

        return $count > 0;
    }

    /**
     * @return array
     */
    public function treeSons() {
        return [];
    }

    /**
     * @return array
     */
    public function treeSonsIndexOrder() {
        return [];
    }

    /**
     * @return string
     */
    public function treeLabel() {
        return $this->row->title;
    }
}