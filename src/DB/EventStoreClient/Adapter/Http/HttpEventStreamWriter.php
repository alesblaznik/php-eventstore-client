<?php

namespace DB\EventStoreClient\Adapter\Http;

use DB\EventStoreClient\Adapter\EventStreamWriterInterface;
use DB\EventStoreClient\Command\AppendEventCommand;
use DB\EventStoreClient\Model\EventReference;
use DB\EventStoreClient\Model\StreamReference;

/**
 * Class HttpEventStreamWriter
 * @package DB\EventStoreClient\Adapter
 */
class HttpEventStreamWriter extends HttpEventStreamAdapter implements EventStreamWriterInterface
{
    /**
     * @param  AppendEventCommand  $command
     * @return EventReference|null
     */
    public function applyAppend(AppendEventCommand $command)
    {
        $response = $this->sendAppendRequest($command);

        return $this->locationToEventReference($response->getHeader('Location'));
    }

    /**
     * @param  AppendEventCommand $command
     * @return array
     */
    private function commandToArray(AppendEventCommand $command)
    {
        return [
            'eventId' => $command->getEventId(),
            'eventType' => $command->getEventType(),
            'data' => $command->getData(),
        ];
    }

    /**
     * @param  AppendEventCommand $command
     * @return array
     */
    private function buildHeaders(AppendEventCommand $command)
    {
        $headers = [
            'Content-type' => 'application/json'
        ];

        if ($command->getExpectedVersion() !== -2) {
            $headers['ES-ExpectedVersion'] = $command->getExpectedVersion();
        }

        return $headers;
    }

    /**
     * @param  AppendEventCommand $command
     * @return string
     */
    private function buildBody(AppendEventCommand $command)
    {
        return json_encode([$this->commandToArray($command)]);
    }

    /**
     * @param $location
     * @return EventReference|null
     */
    private function locationToEventReference($location)
    {
        $locationExploded = explode('/', $location);

        if (count($locationExploded) < 6) {
            return null;
        }

        $streamReference = $locationExploded[4];
        $streamVersion = (int) $locationExploded[5];

        return EventReference::fromStreamReferenceAndVersion(StreamReference::fromName($streamReference), $streamVersion);
    }

    /**
     * @param  AppendEventCommand                    $command
     * @return \GuzzleHttp\Message\ResponseInterface
     */
    private function sendAppendRequest(AppendEventCommand $command)
    {
        return $this
            ->getClient()
            ->post('/streams/' . $this->getStreamReference()->getStreamName(), [
                'headers' => $this->buildHeaders($command),
                'body' => $this->buildBody($command)
            ])
        ;
    }
}
