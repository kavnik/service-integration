<?php
namespace Vda\ServiceIntegration\Event;

abstract class AbstractEvent
{
    private static $transientFields = [
        'persistent',
        'priority',
        'message'
    ];

    const CHANNEL_TYPE_EVENT = 'event';
    const CHANNEL_TYPE_TASK = 'task';

    private $channel;
    private $channelType;
    private $type;
    private $data;
    private $persistent;
    private $priority;

    /**
     * @param string $channel Event destination
     * @param string $type Type of this event
     * @param mixed $data Either array or object containing the event data
     * @param bool $persistent
     * @param null $priority
     * @throws \InvalidArgumentException
     */
    public function __construct($channel, $type, $data, $persistent = false, $priority = null)
    {
        if (!is_array($data) && !is_object($data)) {
            throw new \InvalidArgumentException('$data must be either array or object');
        }

        $this->channel = $channel;
        $this->channelType = $this->getChannelType();
        $this->type = $type;
        $this->data = $data;
        $this->persistent = $persistent;
        $this->priority = $priority;
    }

    abstract public function getChannelType();

    public function getChannel()
    {
        return $this->channel;
    }

    public function getType()
    {
        return $this->type;
    }

    public function getData()
    {
        return $this->data;
    }

    public function isPersistent()
    {
        return $this->persistent;
    }

    public function getPriority()
    {
        return $this->priority;
    }

    public static function getTransientFields()
    {
        return self::$transientFields;
    }
}
