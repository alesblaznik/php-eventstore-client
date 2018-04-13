<?php

namespace EventStore\StreamFeed;

/**
 * Class Event
 * @package EventStore\StreamFeed
 */
final class Event
{
    /**
     * @var string
     */
    private $eventId;

    /**
     * @var string
     */
    private $type;

    /**
     * @var integer
     */
    private $version;

    /**
     * @var array
     */
    private $data;

    /**
     * @var array
     */
    private $metadata;

    /**
     * @var integer
     */
    private $positionEventNumber;

    /**
     * @param string $eventId
     * @param string  $type
     * @param integer $version
     * @param array   $data
     * @param array   $metadata
     * @param integer $positionEventNumber
     */
    public function __construct($eventId, $type, $version, array $data, array $metadata = null, $positionEventNumber)
    {
        $this->eventId = $eventId;
        $this->type = $type;
        $this->version = (integer) $version;
        $this->data = $data;
        $this->metadata = $metadata;
        $this->positionEventNumber = $positionEventNumber;
    }

    /**
     * @return string
     */
    public function getEventId()
    {
        return $this->eventId;
    }

    /**
     * @return string
     */
    public function getType()
    {
        return $this->type;
    }

    /**
     * @return integer
     */
    public function getVersion()
    {
        return $this->version;
    }

    /**
     * @return array
     */
    public function getData()
    {
        return $this->data;
    }

    /**
     * @return array
     */
    public function getMetadata()
    {
        return $this->metadata;
    }

    /**
     * @return int
     */
    public function getPositionEventNumber()
    {
        return $this->positionEventNumber;
    }
}
