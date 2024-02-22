<?php

namespace Compucie\Congressus;

use Compucie\Congressus\RawClient;
use Compucie\Congressus\Model\Member;
use Compucie\Congressus\Request\Parameters;
use Compucie\Congressus\Request\ParameterType\Path;
use Compucie\Congressus\Request\ParameterType\Query;
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

    public function retrieveMemberById(int|string $id): ?Member
    {
        $parameters = new Parameters();
        $parameters->add(Path::obj_id, $id);
        return $this->retrieveMember($parameters);
    }

    public function retrieveMemberByUsername(string $username): ?Member
    {
        $parameters = new Parameters();
        $parameters->add(Query::term, $username);
        $member_page = $this->searchMembers($parameters);
        foreach ($member_page as $member) {
            if ($member->username === $username) {
                return $this->retrieveMemberById($member->id);
            }
        }
        return null;
    }


    // Events

    public function listUpcomingEvents(int|string $max): array
    {
        $parameters = new Parameters();
        $parameters->add(Query::page_size, min($max, 100));
        $parameters->add(Query::published, true);
        $parameters->add(Query::period_filter, [time(), null]);
        $parameters->add(Query::order, "start:asc");

        // request (first) page
        $page = $this->listEvents($parameters);
        $data = $page->getData();

        // request subsequent pages if $max > 100
        // for maintainability, all subsequent pages are of size 100
        // this means that it is likely that more data is requested than necessary
        $data = $this->nextPagesAsData($page, intdiv($max, 100), $data);

        return array_slice($data, 0, $max);
    }


    // Products

    public function listProductsInFolder(int|string|array $folder_id): Page
    {
        $parameters = new Parameters();
        $parameters->add(Query::folder_id, $folder_id);
        return $this->listProducts($parameters);
    }
}
