<?php namespace CTP\Http\Controllers\Site;

use Request;
use View;
use Input;
use CTP\Data\Event as EventData;

abstract class SiteController extends \CTP\Http\Controllers\Controller {

    protected $event = null;

    public function __construct() {
        $this->event = EventData::whereActive(true)->first();
    }

    public function viewMake($template){
        $template = View::make($template);

        $template->with("_event", $this->event);

        return $template;
    }
}
