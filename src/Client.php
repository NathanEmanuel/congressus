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

    public function retrieve_member_by_id(int|string $id): ?Member
    {
        $parameters = new Parameters();
        $parameters->add(Path::obj_id, $id);
        return $this->retrieve_member($parameters);
    }

    public function retrieve_member_by_username(string $username): ?Member
    {
        $parameters = new Parameters();
        $parameters->add(Query::term, $username);
        $member_page = $this->search_members($parameters);
        foreach ($member_page as $member) {
            if ($member->username === $username) {
                return $this->retrieve_member_by_id($member->id);
            }
        }
        return null;
    }


    // Events

    public function list_upcoming_events(int|string $max): array
    {
        $parameters = new Parameters();
        $parameters->add(Query::published, true);
        $parameters->add(Query::period_filter, [time(), null]);
        $parameters->add(Query::order, "start:asc");
        $page = $this->list_events($parameters);
        return array_slice($page["data"], 0, $max);
    }


    // Products

    public function list_products_in_folder(int|string|array $folder_id): ProductPagination
    {
        $parameters = new Parameters();
        $parameters->add(Query::folder_id, $folder_id);
        return $this->list_products($parameters);
    }
}
