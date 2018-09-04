<?php
namespace EventStore\StreamFeed;

use EventStore\ValueObjects\Identity\UUID;

/**
 * Class Event.
 */
final class Event
{
    /**
     * @var UUID
     */
    private $eventId;

    /**
     * @var string
     */
    private $type;

    /**
     * @var int
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
     * @param UUID $eventId
     * @param string  $type
     * @param integer $version
     * @param array   $data
     * @param array   $metadata
     * @param integer $positionEventNumber
     */
    public function __construct(UUID $eventId, $type, $version, array $data, array $metadata = null, $positionEventNumber)
    {
        $this->eventId = $eventId;
        $this->type = $type;
        $this->version = (int) $version;
        $this->data = $data;
        $this->metadata = $metadata;
        $this->eventId = $eventId;
        $this->positionEventNumber = $positionEventNumber;
    }

    /**
     * @return string
     */
    public function getType()
    {
        return $this->type;
    }

    /**
     * @return int
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

    /**
     * @return UUID
     */
    public function getEventId()
    {
        return $this->eventId;
    }
}
