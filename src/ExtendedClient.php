<?php

namespace Compucie\Congressus;

use Compucie\Congressus\Client;
use Compucie\Congressus\Model;
use Compucie\Congressus\Model\Event;
use Compucie\Congressus\Model\Member;
use Compucie\Congressus\Model\MemberWithCustomFields;

class ExtendedClient extends Client
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
     * the given username and checks the returned users for the correct username. Throw
     * a UserNotFoundException when no user with the correct username is found.
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
     * Return the upcoming events. The amount of events is limited by the argument.
     * @param   int|string      $limit      The maximum amount of events to return.
     * @return  array                       An array containing the upcoming events as Event objects.
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
     * @param   Member      $member     The member to check for.
     * @param   Event       $event      The event to check for.
     * @return  bool                    Whether the member is a participant in the event.
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
     * Return an array of product folder whose slugs match the ones given. The
     * array is in order as the slugs are given.
     * @param   string[]                $slugs      The slugs of the folders to retrieve.
     * @return  Model\ProductFolder[]               Array of the folders with the given slugs.
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

class UserNotFoundException extends \Exception
{
}
