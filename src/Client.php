<?php

namespace Compucie\Congressus;

use Compucie\Congressus\RawClient;
use Compucie\Congressus\Model;
use Compucie\Congressus\Exception\UserNotFoundException;
use Compucie\Congressus\Model\Event;
use Compucie\Congressus\Model\Member;
use Compucie\Congressus\Model\MemberWithCustomFields;
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


    /***************************************************************
     * MEMBERS
     ***************************************************************/

    /**
     * Retrieve the user by its username. This function performs a search based on
     * the given username and checks the returned users for the correct username.
     * Throw a UserNotFoundException when no user with the correct username is found.
     * @param   string $username                The username to search for.
     * @return  Model\MemberWithCustomFields    The user with the given username.
     * @throws  UserNotFoundException
     */
    public function retrieveMemberByUsername(string $username): ?Model\MemberWithCustomFields
    {
        $page = $this->searchMembers(term: $username);
        foreach ($page->getData() as $member) {
            if ($member["username"] === $username) {
                return $this->retrieveMember(obj_id: $member["id"]);
            }
        }
        throw new UserNotFoundException();
    }


    /***************************************************************
     * EVENTS
     ***************************************************************/

    /**
     * Return the upcoming events.
     * @param   int|string    $max  The maximum amount of events to return.
     * @return  array               An array containting the upcoming events as Event objects.
     */
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
        $this->addDataFromNextPages($data, $page, intdiv($max, 100));

        return array_slice($data, 0, $max);
    }

    /**
     * Return whether the given member is a participant of the given event.
     * @param   Member  $member
     * @param   Event   $event
     */
    public function isMemberEventParticipant(Member|MemberWithCustomFields $member, Event $event): bool
    {
        $participations = $this->listEventParticipations(obj_id: $event->getId(), member_id: $member->getId())->getData();
        return count($participations) > 0;
    }
}
