<?php

declare(strict_types=1);

namespace Modules\Xot\Http\Livewire;

use Livewire\Component;

class LaravelNewsTile extends Component {
    /** @var string */
    public $position;

    /** @var string|null */
    public $title;

    /** @var int */
    public $number = 0;

    /** @var string */
    public $configurationName;

    public $refreshIntervalInSeconds;

    public function mount(string $position, ?string $title = null, string $configurationName = 'default') {
        $this->position = $position;

        $this->title = $title;

        $this->refreshIntervalInSeconds = config('dashboard.tiles.laravelnews.refresh_interval_in_seconds', 60);

        $this->configurationName = $configurationName;
    }

    public function render() {
        $xml = \Illuminate\Support\Facades\Http::get('https://feed.laravel-news.com')->body();
        $data = simplexml_load_string($xml, 'SimpleXMLElement', LIBXML_NOCDATA);
        if ($this->number == config('dashboard.tiles.laravelnews.number_of_articles', 19) - 1) {
            $this->number = 0;
        } else {
            ++$this->number;
        }
        $articleContent = (string) $data->channel->item[$this->number]->description;
        $articleTitle = (string) $data->channel->item[$this->number]->title;

        return view('xot::livewire.laravel-news-tile', compact('articleContent', 'articleTitle'));
    }
}