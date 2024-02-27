<?php

namespace Compucie\Congressus;

use Compucie\Congressus\RawClient;
use Compucie\Congressus\Model;
use GuzzleHttp\Client as GuzzleHttpClient;

class Client extends RawClient
{
    public function __construct(string $token)
    {
        GuzzleHttpClient::__construct([
            'base_uri' => 'https://api.congressus.nl',
            'headers' => ["Authorization" => "Bearer {$token}"]
        ]);
    }


    // Members

    public function retrieveMemberByUsername(string $username): ?Model\MemberWithCustomFields
    {
        $page = $this->searchMembers(term: $username);
        foreach ($page->getData() as $member) {
            if ($member->username === $username) {
                return $this->retrieveMember(obj_id: $member->id);
            }
        }
        return null;
    }


    // Events

    public function listUpcomingEvents(int|string $max): array
    {
        // request (first) page
        $page = $this->listEvents(
            page_size: min($max, 100),
            published: true,
            period_start: time(),
            order: "start:asc",
        );
        $data = $page->getData();

        // request subsequent pages if $max > 100
        // for maintainability, all subsequent pages are of size 100
        // this means that it is likely that more data is requested than necessary
        $data = $this->nextPagesAsData($page, intdiv($max, 100), $data);

        return array_slice($data, 0, $max);
    }
}
