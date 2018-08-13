<?php

namespace app\modules\api\v2\events;

use yii\base\Component;

class EventDispatcher extends Component
{
    public function dispatch($event)
    {
        $this->trigger(get_class($event), $event);
    }
}