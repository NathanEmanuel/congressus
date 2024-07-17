<?php

namespace Compucie\Congressus;

use Compucie\Congressus\Client;
use Compucie\Congressus\Model;
use Compucie\Congressus\Exception\UserNotFoundException;
use Compucie\Congressus\Model\Event;
use Compucie\Congressus\Model\Member;
use Compucie\Congressus\Model\MemberWithCustomFields;

class NewtonClient extends Client
{
    public function __construct(string $token)
    {
        parent::__construct($token);
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
    public function retrieveMemberByUsername(string $username): Model\MemberWithCustomFields
    {
        $members = $this->searchMembers(limit: null, term: $username);
        foreach ($members as $member) {
            if ($member->getUsername() == $username) {
                return $this->retrieveMember(obj_id: $member->getId()); // don't return ElasticMember
            }
        }
        throw new UserNotFoundException();
    }


    /***************************************************************
     * EVENTS
     ***************************************************************/

    /**
     * Return the upcoming events.
     * @param   int|string      $limit      The maximum amount of events to return.
     * @return  array                       An array containting the upcoming events as Event objects.
     */
    public function listUpcomingEvents(int|string $limit): array
    {
        $events = $this->listEvents(
            $limit,
            published: true,
            period_filter: self::formatPeriod(time()),
            order: "start:asc",
        );
        return array_slice($events, 0, $limit);
    }

    /**
     * Return whether the given member is a participant of the given event.
     * @param   Member  $member
     * @param   Event   $event
     */
    public function isMemberEventParticipant(Member|MemberWithCustomFields $member, Event $event): bool
    {
        $participations = $this->listEventParticipations(
            limit: null,
            obj_id: $event->getId(),
            member_id: $member->getId(),
            status: ["approved", "waiting list", "payment pending"],
        );
        return count($participations) > 0;
    }

    /***************************************************************
     * PRODUCTS
     ***************************************************************/

    /**
     * @return  ProductFolder[]
     */
    public function retrieveProductFoldersBySlug(...$slugs): array
    {
        $productFolders = $this->listProductFolders(null);

        // Filter on argument slugs
        foreach ($productFolders as $folder) {
            if (in_array($folder->getSlug(), $slugs)) {
                $productFoldersAlphabetical[$folder->getSlug()] = $folder;
            }
        }

        // Reorder from alphabetical order to custom order
        foreach ($slugs as $slug) {
            $productFolders[$slug] = $productFoldersAlphabetical[$slug];
        }

        return $productFolders;
    }
}
