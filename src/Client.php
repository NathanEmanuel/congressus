<?php

namespace Compucie\Congressus;

use Compucie\Congressus\RawClient;
use Compucie\Congressus\Model\Member;
use Compucie\Congressus\Request\Arguments;
use Compucie\Congressus\Request\PathParameter;
use Compucie\Congressus\Request\QueryParameter;
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
        $arguments = new Arguments();
        $arguments->add(PathParameter::obj_id, $id);
        return $this->retrieve_member($arguments);
    }

    public function retrieve_member_by_username(string $username): ?Member
    {
        $arguments = new Arguments();
        $arguments->add(QueryParameter::term, $username);
        $member_page = $this->search_members($arguments);
        foreach ($member_page as $member) {
            if ($member->username === $username) {
                return $this->retrieve_member_by_id($member->id);
            }
        }
        return null;
    }
}
