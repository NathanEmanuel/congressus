<?php

namespace Compucie\Congressus;

use Compucie\Congressus\Exceptions\UserNotFoundException;
use Compucie\Congressus\Model\Event;
use Compucie\Congressus\Model\Member;
use Compucie\Congressus\Model\MemberWithCustomFields;
use Compucie\Congressus\Model\ProductFolder;
use Compucie\Congressus\Model\ProductFolderWithChildren;
use GuzzleHttp\Exception\RequestException;

class ExtendedClient extends Client
{
    /***************************************************************
     * MEMBERS
     ***************************************************************/

    /**
     * Retrieve one or multiple members.
     * @param   int[]   $ids    The IDs of the members to retrieve.
     * @return  array           Array of members with the given IDs.
     */
    public function retrieveMembers(array $ids): array
    {
        $members = array();
        foreach ($ids as $id) {
            $members[] = $this->retrieveMember($id);
        }
        return $members;
    }

    /**
     * Retrieve the member by their username. This function performs a member search based on
     * the given username and checks the returned members for the correct username. Throw
     * a UserNotFoundException when no member with the correct username is found.
     * @param   string $username                The username to search for.
     * @return  Model\MemberWithCustomFields    The member with the given username.
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

    /**
     * Retrieve the member by their name. This function performs a member search based on
     * the given name and checks the returned members for the correct name. Throw
     * a UserNotFoundException when no member with the correct name is found.
     * @param   string $name                    The name to search for.
     * @return  array<Model\MemberWithCustomFields>    The member with the given name.
     */
    public function retrieveTopMembersByName(string $name, int $count = null): array
    {
        $members = $this->searchMembers(limit: null, term: $name);
        $counter = $count ?? count($members);
        $returnMembers = array();
        foreach ($members as $member) {
            if ($counter > 0) {
                try {
                    $resultMember = $this->retrieveMember(obj_id: $member->getId()); // don't return ElasticMember
                    $returnMembers[] = $resultMember;
                } catch (RequestException $e) {
                    error_log($e->getMessage());
                    continue;
                }
                $counter--;
            }
        }

        return $returnMembers;
    }


    /***************************************************************
     * EVENTS
     ***************************************************************/

    /**
     * Retrieve one or multiple events.
     * @param   int[]   $ids    The IDs of the events to retrieve.
     * @return  array           Array of events with the given IDs.
     */
    public function retrieveEvents(array $ids): array
    {
        $events = array();
        foreach ($ids as $id) {
            $events[] = $this->retrieveEvent($id);
        }
        return $events;
    }

    /**
     * Return the upcoming events. The amount of events is limited by the argument.
     * @param   ?int            $limit      The maximum amount of events to return.
     * @return  Model\Event[]               An array containing the upcoming events as Event objects.
     */
    public function listUpcomingEvents(int $limit = null): array
    {
        $events = $this->listEvents(
            $limit,
            period_filter: self::formatPeriod(time()),
            published: true,
            order: "start:asc",
        );
        return array_slice($events, 0, $limit);
    }

    /**
     * Return whether the given member is a participant of the given event.
     * @param Member|MemberWithCustomFields $member The member to check for.
     * @param Event $event The event to check for.
     * @return  bool                    Whether the member is a participant in the event.
     */
    public function isMemberEventParticipant(Member|MemberWithCustomFields $member, Event $event): bool
    {
        $participations = $this->listEventParticipations(
            limit: null,
            obj_id: $event->getId(),
            status: ["approved", "waiting list", "payment pending"],
            member_id: $member->getId(),
        );
        return count($participations) > 0;
    }


    /***************************************************************
     * PRODUCTS
     ***************************************************************/

    /**
     * Return an array of product folders whose slugs match the ones given. The
     * array is in order as the slugs are given. Watch out for folders with
     * differing paths but identical slugs.
     * @param   string                  ...$slugs       The slugs of the folders to retrieve.
     * @return  Model\ProductFolder[]                   An array of folders with the given slugs.
     */
    public function retrieveProductFoldersBySlug(...$slugs): array
    {
        $allProductFolders = $this->listProductFoldersRecursive(null);

        // Flatten
        /** @var ProductFolder[] $allProductFoldersFlattened */
        $allProductFoldersFlattened = array();
        foreach ($allProductFolders as $folder) {
            $allProductFoldersFlattened = array_merge($allProductFoldersFlattened, self::flattenProductFolderWithChildren($folder));
        }

        // Filter on argument slugs
        $productFoldersAlphabetical = array();
        foreach ($allProductFoldersFlattened as $folder) {
            if (in_array($folder->getSlug(), $slugs)) {
                $productFoldersAlphabetical[$folder->getSlug()] = $folder;
            }
        }

        // Reorder from alphabetical order to custom order
        $productFolders = array();
        foreach ($slugs as $slug) {
            $productFolders[$slug] = $productFoldersAlphabetical[$slug];
        }

        return $productFolders;
    }

    /**
     * Return a flattened product folder array based on a given product folder with children object.
     * @param   Model\ProductFolderWithChildren   $folderWithChildren
     * @return  Model\ProductFolder[]
     */
    protected static function flattenProductFolderWithChildren(ProductFolderWithChildren $folderWithChildren): array
    {
        /** @var ProductFolder[] $flattenedChildren */
        $flattenedChildren = array();
        foreach ($folderWithChildren->getChildren() as $child) {
            $flattenedChildren = array_merge($flattenedChildren, self::flattenProductFolderWithChildren($child));
        }

        $folder = ModelProcessor::typecast($folderWithChildren, Model\ProductFolder::class);
        return array_merge(array($folder), $flattenedChildren);
    }
}

