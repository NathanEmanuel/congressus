<?php

namespace Compucie\Congressus;

use Compucie\Congressus\RawClient;
use Compucie\Congressus\Model\Member;
use Compucie\Congressus\Model\ProductPagination;
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
        $parameters->add(Query::published, true);
        $parameters->add(Query::period_filter, [time(), null]);
        $parameters->add(Query::order, "start:asc");
        $page = $this->listEvents($parameters);
        return array_slice($page["data"], 0, $max);
    }


    // Products

    public function listProductsInFolder(int|string|array $folder_id): Page
    {
        $parameters = new Parameters();
        $parameters->add(Query::folder_id, $folder_id);
        return $this->listProducts($parameters);
    }
}
