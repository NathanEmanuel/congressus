<?php

namespace Compucie\Congressus;

use Compucie\Congressus\Model;
use Compucie\Congressus\Page;
use Compucie\Congressus\Request;
use stdClass;

trait RequestingMethodsTrait
{
    /**
     * [Generated method]
     */
    public function listBackgroundProcesses(
        array|string $state = null,
        string $created = null,
        string $modified = null,
        int $page = null,
        int $page_size = null,
        string $order = null,
    ): Page {
        $parameters = get_defined_vars();
        $request = new Request("GET", "/v30/background-processes", $parameters);
        return $this->submit($request, new Model\BackgroundProcessPagination);
    }

    /**
     * [Generated method]
     */
    public function retrieveBackgroundProcess(
        int $obj_id,
    ): Model\BackgroundProcess {
        $parameters = get_defined_vars();
        $request = new Request("GET", "/v30/background-processes/{obj_id}", $parameters);
        return $this->submit($request, new Model\BackgroundProcess);
    }

    /**
     * [Generated method]
     */
    public function retrieveBackgroundProcessResult(
        int $obj_id,
    ): Model\BackgroundProcessResult {
        $parameters = get_defined_vars();
        $request = new Request("GET", "/v30/background-processes/results/{obj_id}", $parameters);
        return $this->submit($request, new Model\BackgroundProcessResult);
    }

    /**
     * [Generated method]
     */
    public function listBankMutations(
        string $period_filter = null,
        string $status = null,
        string $mutation_type = null,
        array|int $bank_import_id = null,
        array|int $bank_statement_id = null,
        array|int $bank_mutation_id = null,
        int $page = null,
        int $page_size = null,
        string $order = null,
    ): Page {
        $parameters = get_defined_vars();
        $request = new Request("GET", "/v30/bank", $parameters);
        return $this->submit($request, new Model\BankMutationPagination);
    }

    /**
     * [Generated method]
     */
    public function retrieveBankMutation(
        int $obj_id,
    ): Model\BankMutation {
        $parameters = get_defined_vars();
        $request = new Request("GET", "/v30/bank/{obj_id}", $parameters);
        return $this->submit($request, new Model\BankMutation);
    }

    /**
     * [Generated method]
     */
    public function listBlogAuthors(
        int $page = null,
        int $page_size = null,
        string $order = null,
    ): Page {
        $parameters = get_defined_vars();
        $request = new Request("GET", "/v30/blogs/authors", $parameters);
        return $this->submit($request, new Model\BlogAuthorPagination);
    }

    /**
     * [Generated method]
     */
    public function retrieveBlogAuthor(
        int $obj_id,
    ): Model\BlogAuthor {
        $parameters = get_defined_vars();
        $request = new Request("GET", "/v30/blogs/authors/{obj_id}", $parameters);
        return $this->submit($request, new Model\BlogAuthor);
    }

    /**
     * [Generated method]
     */
    public function listBlogs(
        string $period_filter = null,
        array|int $author_id = null,
        array|int $issue_id = null,
        array|int $category_id = null,
        bool $published = null,
        array|string $visibility = null,
        int $page = null,
        int $page_size = null,
        string $order = null,
    ): Page {
        $parameters = get_defined_vars();
        $request = new Request("GET", "/v30/blogs", $parameters);
        return $this->submit($request, new Model\BlogPagination);
    }

    /**
     * [Generated method]
     */
    public function retrieveBlog(
        int $obj_id,
    ): Model\BlogWithParagraph {
        $parameters = get_defined_vars();
        $request = new Request("GET", "/v30/blogs/{obj_id}", $parameters);
        return $this->submit($request, new Model\BlogWithParagraph);
    }

    /**
     * [Generated method]
     */
    public function retrieveBlogTextParagraph(
        int $obj_id,
    ): Model\BlogTextParagraph {
        $parameters = get_defined_vars();
        $request = new Request("GET", "/v30/blogs/paragraphs/text/{obj_id}", $parameters);
        return $this->submit($request, new Model\BlogTextParagraph);
    }

    /**
     * [Generated method]
     */
    public function retrieveBlogImageParagraph(
        int $obj_id,
    ): Model\BlogImageParagraph {
        $parameters = get_defined_vars();
        $request = new Request("GET", "/v30/blogs/paragraphs/image/{obj_id}", $parameters);
        return $this->submit($request, new Model\BlogImageParagraph);
    }

    /**
     * [Generated method]
     */
    public function listBlogCategories(
        int $page = null,
        int $page_size = null,
        string $order = null,
    ): Page {
        $parameters = get_defined_vars();
        $request = new Request("GET", "/v30/blogs/categories", $parameters);
        return $this->submit($request, new Model\BlogCategoryPagination);
    }

    /**
     * [Generated method]
     */
    public function retrieveBlogCategory(
        int $obj_id,
    ): Model\BlogCategory {
        $parameters = get_defined_vars();
        $request = new Request("GET", "/v30/blogs/categories/{obj_id}", $parameters);
        return $this->submit($request, new Model\BlogCategory);
    }

    /**
     * [Generated method]
     */
    public function listBlogIssues(
        int $page = null,
        int $page_size = null,
        string $order = null,
    ): Page {
        $parameters = get_defined_vars();
        $request = new Request("GET", "/v30/blogs/issues", $parameters);
        return $this->submit($request, new Model\BlogIssuePagination);
    }

    /**
     * [Generated method]
     */
    public function retrieveBlogIssue(
        int $obj_id,
    ): Model\BlogIssue {
        $parameters = get_defined_vars();
        $request = new Request("GET", "/v30/blogs/issues/{obj_id}", $parameters);
        return $this->submit($request, new Model\BlogIssue);
    }

    /**
     * [Generated method]
     */
    public function listCareerPartnerCategories(
        int $page = null,
        int $page_size = null,
        string $order = null,
    ): Page {
        $parameters = get_defined_vars();
        $request = new Request("GET", "/v30/career/partners/categories", $parameters);
        return $this->submit($request, new Model\CareerPartnerCategoryPagination);
    }

    /**
     * [Generated method]
     */
    public function retrieveCareerPartnerCategory(
        int $obj_id,
    ): Model\CareerPartnerCategory {
        $parameters = get_defined_vars();
        $request = new Request("GET", "/v30/career/partners/categories/{obj_id}", $parameters);
        return $this->submit($request, new Model\CareerPartnerCategory);
    }

    /**
     * [Generated method]
     */
    public function listCareerPartners(
        array|int $career_partner_category_id = null,
        int $page = null,
        int $page_size = null,
        string $order = null,
    ): Page {
        $parameters = get_defined_vars();
        $request = new Request("GET", "/v30/career/partners", $parameters);
        return $this->submit($request, new Model\CareerPartnerPagination);
    }

    /**
     * [Generated method]
     */
    public function retrieveCareerPartner(
        int $obj_id,
    ): Model\CareerPartner {
        $parameters = get_defined_vars();
        $request = new Request("GET", "/v30/career/partners/{obj_id}", $parameters);
        return $this->submit($request, new Model\CareerPartner);
    }

    /**
     * [Generated method]
     */
    public function listSavedReplies(
        int $page = null,
        int $page_size = null,
        string $order = null,
    ): Page {
        $parameters = get_defined_vars();
        $request = new Request("GET", "/v30/communication/saved-replies", $parameters);
        return $this->submit($request, new Model\SavedReplyPagination);
    }

    /**
     * [Generated method]
     */
    public function retrieveSavedReply(
        int $obj_id,
    ): Model\SavedReply {
        $parameters = get_defined_vars();
        $request = new Request("GET", "/v30/communication/saved-replies/{obj_id}", $parameters);
        return $this->submit($request, new Model\SavedReply);
    }

    /**
     * [Generated method]
     */
    public function listCountries(
        int $page = null,
        int $page_size = null,
        string $order = null,
    ): Page {
        $parameters = get_defined_vars();
        $request = new Request("GET", "/v30/countries", $parameters);
        return $this->submit($request, new Model\CountryPagination);
    }

    /**
     * [Generated method]
     */
    public function retrieveCountry(
        int $obj_id,
    ): Model\Country {
        $parameters = get_defined_vars();
        $request = new Request("GET", "/v30/countries/{obj_id}", $parameters);
        return $this->submit($request, new Model\Country);
    }

    /**
     * [Generated method]
     */
    public function listEventCategories(
        int $page = null,
        int $page_size = null,
        string $order = null,
    ): Page {
        $parameters = get_defined_vars();
        $request = new Request("GET", "/v30/event-categories", $parameters);
        return $this->submit($request, new Model\EventCategoryPagination);
    }

    /**
     * @param   int $period_start   The start of the filter period in Unix time
     * @param   int $period_end     The end of the filter period in Unix time
     */
    public function listEvents(
        array|int $category_id = null,
        int $period_start = null,
        int $period_end = null,
        string $period_filter = null,
        bool $published = null,
        array|string $participation_billing_enabled = null,
        array|int $participating_member_id = null,
        int $socie_app_id = null,
        int $member_id = null,
        int $page = null,
        int $page_size = null,
        string $order = null,
    ): Page {
        $parameters = get_defined_vars(); // this MUST be first

        $set_period_filter = function (int $period_start = null, int $period_end = null) {
            return match (true) {
                !is_null($period_start) && !is_null($period_end) => date("Ymd", $period_start) . ".." . date("Ymd", $period_end),
                !is_null($period_start) && is_null($period_end) => date("Ymd", time()) . ".." . date("Ymd", 2147483647),
                is_null($period_start) && !is_null($period_end) => date("Ymd", 0) . ".." . date("Ymd", $period_end),
            };
        };
        $parameters["period_filter"] = $set_period_filter($parameters["period_start"], $parameters["period_end"]);

        $request = new Request("GET", "/v30/events", $parameters);
        $request->setQueryParameters($parameters);
        return $this->submit($request, new Model\EventPagination);
    }

    /**
     * [Generated method]
     */
    public function retrieveEvent(
        int $obj_id,
    ): Model\Event {
        $parameters = get_defined_vars();
        $request = new Request("GET", "/v30/events/{obj_id}", $parameters);
        return $this->submit($request, new Model\Event);
    }

    /**
     * [Generated method]
     */
    public function listEventParticipations(
        int $obj_id,
        array|int $event_id = null,
        array|string $status = null,
        bool $has_invoice = null,
        array|string $sale_invoice_status = null,
        array|int $member_id = null,
        int $page = null,
        int $page_size = null,
        string $order = null,
    ): Page {
        $parameters = get_defined_vars();
        $request = new Request("GET", "/v30/events/{obj_id}/participations", $parameters);
        return $this->submit($request, new Model\EventParticipationPagination);
    }

    /**
     * [Generated method]
     */
    public function retrieveEventParticipation(
        int $obj_id,
        int $event_id,
    ): Model\EventParticipationWithRelations {
        $parameters = get_defined_vars();
        $request = new Request("GET", "/v30/events/{event_id}/participations/{obj_id}", $parameters);
        return $this->submit($request, new Model\EventParticipationWithRelations);
    }

    /**
     * [Generated method]
     */
    public function listTicketTypes(
        int $obj_id,
        bool $is_available_for_members = null,
        bool $is_available_for_external = null,
        array|string $availability_status = null,
        int $page = null,
        int $page_size = null,
        string $order = null,
    ): Page {
        $parameters = get_defined_vars();
        $request = new Request("GET", "/v30/events/{obj_id}/ticket-types", $parameters);
        return $this->submit($request, new Model\TicketTypePagination);
    }

    /**
     * [Generated method]
     */
    public function retrieveTicketType(
        int $obj_id,
        int $event_id,
    ): Model\EventTicketType {
        $parameters = get_defined_vars();
        $request = new Request("GET", "/v30/events/{event_id}/ticket-types/{obj_id}", $parameters);
        return $this->submit($request, new Model\EventTicketType);
    }

    /**
     * [Generated method]
     */
    public function listGalleryAlbums(
        bool $published = null,
        int $page = null,
        int $page_size = null,
        string $order = null,
    ): Page {
        $parameters = get_defined_vars();
        $request = new Request("GET", "/v30/galleries/albums", $parameters);
        return $this->submit($request, new Model\GalleryAlbumPagination);
    }

    /**
     * [Generated method]
     */
    public function retrieveGalleryAlbum(
        int $obj_id,
    ): Model\GalleryAlbum {
        $parameters = get_defined_vars();
        $request = new Request("GET", "/v30/galleries/albums/{obj_id}", $parameters);
        return $this->submit($request, new Model\GalleryAlbum);
    }

    /**
     * [Generated method]
     */
    public function listGalleryPhotos(
        int $album_id,
        int $page = null,
        int $page_size = null,
        string $order = null,
    ): Page {
        $parameters = get_defined_vars();
        $request = new Request("GET", "/v30/galleries/albums/{album_id}/photos", $parameters);
        return $this->submit($request, new Model\GalleryPhotoPagination);
    }

    /**
     * [Generated method]
     */
    public function retrieveGalleryPhoto(
        int $album_id,
        int $obj_id,
    ): Model\GalleryPhoto {
        $parameters = get_defined_vars();
        $request = new Request("GET", "/v30/galleries/albums/{album_id}/photos/{obj_id}", $parameters);
        return $this->submit($request, new Model\GalleryPhoto);
    }

    /**
     * [Generated method]
     */
    public function listGroupFoldersRecursive(
        int $page = null,
        int $page_size = null,
        string $order = null,
    ): Page {
        $parameters = get_defined_vars();
        $request = new Request("GET", "/v30/group-folders/recursive", $parameters);
        return $this->submit($request, new Model\GroupFolderListRecursivePagination);
    }

    /**
     * [Generated method]
     */
    public function listGroupFolders(
        bool $published = null,
        int $parent_id = null,
        int $page = null,
        int $page_size = null,
        string $order = null,
    ): Page {
        $parameters = get_defined_vars();
        $request = new Request("GET", "/v30/group-folders", $parameters);
        return $this->submit($request, new Model\GroupFolderPagination);
    }

    /**
     * [Generated method]
     */
    public function retrieveGroupFolder(
        int $obj_id,
    ): Model\GroupFolder {
        $parameters = get_defined_vars();
        $request = new Request("GET", "/v30/group-folders/{obj_id}", $parameters);
        return $this->submit($request, new Model\GroupFolder);
    }

    /**
     * [Generated method]
     */
    public function listGroups(
        bool $published = null,
        array|int $folder_id = null,
        array|int $member_id = null,
        array|int $socie_app_id = null,
        int $page = null,
        int $page_size = null,
        string $order = null,
    ): Page {
        $parameters = get_defined_vars();
        $request = new Request("GET", "/v30/groups", $parameters);
        return $this->submit($request, new Model\GroupPagination);
    }

    /**
     * [Generated method]
     */
    public function retrieveGroup(
        int $obj_id,
    ): Model\GroupWithMemberships {
        $parameters = get_defined_vars();
        $request = new Request("GET", "/v30/groups/{obj_id}", $parameters);
        return $this->submit($request, new Model\GroupWithMemberships);
    }

    /**
     * [Generated method]
     */
    public function listGroupMemberships(
        array|int $group_id = null,
        array|int $member_id = null,
        int $page = null,
        int $page_size = null,
        string $order = null,
    ): Page {
        $parameters = get_defined_vars();
        $request = new Request("GET", "/v30/groups/memberships", $parameters);
        return $this->submit($request, new Model\GroupMembershipPagination);
    }

    /**
     * [Generated method]
     */
    public function retrieveGroupMembership(
        int $obj_id,
    ): Model\GroupMembership {
        $parameters = get_defined_vars();
        $request = new Request("GET", "/v30/groups/memberships/{obj_id}", $parameters);
        return $this->submit($request, new Model\GroupMembership);
    }

    /**
     * [Generated method]
     */
    public function listTasks(
        array|int $author_id = null,
        array|int $assignee_id = null,
        array|string $subject_type = null,
        bool $is_completed = null,
        int $page = null,
        int $page_size = null,
        string $order = null,
    ): Page {
        $parameters = get_defined_vars();
        $request = new Request("GET", "/v30/tasks", $parameters);
        return $this->submit($request, new Model\TaskPagination);
    }

    /**
     * [Generated method]
     */
    public function listMemberStatuses(
        bool $archived = null,
        bool $hidden = null,
        bool $deceased = null,
        int $page = null,
        int $page_size = null,
        string $order = null,
    ): Page {
        $parameters = get_defined_vars();
        $request = new Request("GET", "/v30/member-statuses", $parameters);
        return $this->submit($request, new Model\MemberStatusListPagination);
    }

    /**
     * [Generated method]
     */
    public function retrieveMemberStatus(
        int $obj_id,
    ): Model\MemberStatusWithFieldSettings {
        $parameters = get_defined_vars();
        $request = new Request("GET", "/v30/member-statuses/{obj_id}", $parameters);
        return $this->submit($request, new Model\MemberStatusWithFieldSettings);
    }

    /**
     * [Generated method]
     */
    public function listMemberLogEntries(
        int $member_id,
        array|int $author_id = null,
        array|string $type = null,
        int $page = null,
        int $page_size = null,
        string $order = null,
    ): Page {
        $parameters = get_defined_vars();
        $request = new Request("GET", "/v30/members/{member_id}/logs", $parameters);
        return $this->submit($request, new Model\LogEntryPagination);
    }

    /**
     * [Generated method]
     */
    public function retrieveMemberLogEntry(
        int $log_entry_id,
        int $member_id,
    ): Model\LogEntry {
        $parameters = get_defined_vars();
        $request = new Request("GET", "/v30/members/{member_id}/logs/{log_entry_id}", $parameters);
        return $this->submit($request, new Model\LogEntry);
    }

    /**
     * [Generated method]
     */
    public function listMembers(
        array|int $status_id = null,
        array|int $socie_app_id = null,
        int $page = null,
        int $page_size = null,
        string $order = null,
        array|string $context = null,
    ): Page {
        $parameters = get_defined_vars();
        $request = new Request("GET", "/v30/members", $parameters);
        return $this->submit($request, new Model\MemberPagination);
    }

    /**
     * [Generated method]
     */
    public function retrieveMember(
        int $obj_id,
        array|string $context = null,
    ): Model\MemberWithCustomFields {
        $parameters = get_defined_vars();
        $request = new Request("GET", "/v30/members/{obj_id}", $parameters);
        return $this->submit($request, new Model\MemberWithCustomFields);
    }

    /**
     * [Generated method]
     */
    public function listMembershipStatuses(
        int $obj_id,
        int $page = null,
        int $page_size = null,
        string $order = null,
    ): Page {
        $parameters = get_defined_vars();
        $request = new Request("GET", "/v30/members/{obj_id}/statuses", $parameters);
        return $this->submit($request, new Model\MembershipStatusPagination);
    }

    /**
     * [Generated method]
     */
    public function retrieveMembershipStatus(
        int $obj_id,
        int $membership_status_id,
    ): Model\MembershipStatus {
        $parameters = get_defined_vars();
        $request = new Request("GET", "/v30/members/{obj_id}/statuses/{membership_status_id}", $parameters);
        return $this->submit($request, new Model\MembershipStatus);
    }

    /**
     * [Generated method]
     */
    public function searchMembers(
        string $term,
        int $page = null,
        int $page_size = null,
        string $order = null,
    ): Page {
        $parameters = get_defined_vars();
        $request = new Request("GET", "/v30/members/search", $parameters);
        return $this->submit($request, new Model\ElasticMemberPagination);
    }

    /**
     * [Generated method]
     */
    public function listNews(
        string $period_filter = null,
        bool $actual = null,
        bool $comments_open = null,
        array|string $visibility = null,
        int $page = null,
        int $page_size = null,
        string $order = null,
    ): Page {
        $parameters = get_defined_vars();
        $request = new Request("GET", "/v30/news", $parameters);
        return $this->submit($request, new Model\NewsPagination);
    }

    /**
     * [Generated method]
     */
    public function retrieveNews(
        int $obj_id,
    ): Model\News {
        $parameters = get_defined_vars();
        $request = new Request("GET", "/v30/news/{obj_id}", $parameters);
        return $this->submit($request, new Model\News);
    }

    /**
     * [Generated method]
     */
    public function listNotifications(
        int $page = null,
        int $page_size = null,
        string $order = null,
    ): Page {
        $parameters = get_defined_vars();
        $request = new Request("GET", "/v30/notifications", $parameters);
        return $this->submit($request, new Model\NotificationPagination);
    }

    /**
     * [Generated method]
     */
    public function listOrganisationCategories(
        int $page = null,
        int $page_size = null,
        string $order = null,
    ): Page {
        $parameters = get_defined_vars();
        $request = new Request("GET", "/v30/organisations/categories", $parameters);
        return $this->submit($request, new Model\OrganisationCategoryPagination);
    }

    /**
     * [Generated method]
     */
    public function retrieveOrganisationCategory(
        int $obj_id,
    ): Model\OrganisationCategory {
        $parameters = get_defined_vars();
        $request = new Request("GET", "/v30/organisations/categories/{obj_id}", $parameters);
        return $this->submit($request, new Model\OrganisationCategory);
    }

    /**
     * [Generated method]
     */
    public function listOrganisations(
        array|int $category_id = null,
        array|string $sbi_code = null,
        array|string $legal_form = null,
        array|int $member_id = null,
        int $page = null,
        int $page_size = null,
        string $order = null,
    ): Page {
        $parameters = get_defined_vars();
        $request = new Request("GET", "/v30/organisations", $parameters);
        return $this->submit($request, new Model\OrganisationPagination);
    }

    /**
     * [Generated method]
     */
    public function retrieveOrganisation(
        int $obj_id,
    ): Model\Organisation {
        $parameters = get_defined_vars();
        $request = new Request("GET", "/v30/organisations/{obj_id}", $parameters);
        return $this->submit($request, new Model\Organisation);
    }

    /**
     * [Generated method]
     */
    public function listOrganisationMemberships(
        array|int $organisation_id = null,
        array|int $member_id = null,
        int $page = null,
        int $page_size = null,
        string $order = null,
    ): Page {
        $parameters = get_defined_vars();
        $request = new Request("GET", "/v30/organisations/memberships", $parameters);
        return $this->submit($request, new Model\OrganisationMembershipPagination);
    }

    /**
     * [Generated method]
     */
    public function retrieveOrganisationMembership(
        int $obj_id,
    ): Model\OrganisationMembership {
        $parameters = get_defined_vars();
        $request = new Request("GET", "/v30/organisations/memberships/{obj_id}", $parameters);
        return $this->submit($request, new Model\OrganisationMembership);
    }

    /**
     * [Generated method]
     */
    public function returnAJSONFileWithTheDefaultPricingStrategyForAllOurPlans(
        int $members = null,
        string $plan = null,
    ): Model\PricingResponse {
        $parameters = get_defined_vars();
        $request = new Request("GET", "/v30/pricing", $parameters);
        return $this->submit($request, new Model\PricingResponse);
    }

    /**
     * [Generated method]
     */
    public function listProductFoldersRecursive(
        bool $published = null,
        int $parent_id = null,
        int $page = null,
        int $page_size = null,
        string $order = null,
    ): Page {
        $parameters = get_defined_vars();
        $request = new Request("GET", "/v30/product-folders/recursive", $parameters);
        return $this->submit($request, new Model\ProductFolderListRecursivePagination);
    }

    /**
     * [Generated method]
     */
    public function listProductFolders(
        bool $published = null,
        int $parent_id = null,
        int $page = null,
        int $page_size = null,
        string $order = null,
    ): Page {
        $parameters = get_defined_vars();
        $request = new Request("GET", "/v30/product-folders", $parameters);
        return $this->submit($request, new Model\ProductFolderPagination);
    }

    /**
     * [Generated method]
     */
    public function retrieveProductFolder(
        int $obj_id,
    ): Model\ProductFolder {
        $parameters = get_defined_vars();
        $request = new Request("GET", "/v30/product-folders/{obj_id}", $parameters);
        return $this->submit($request, new Model\ProductFolder);
    }

    /**
     * [Generated method]
     */
    public function listProducts(
        bool $published = null,
        string $status = null,
        array|int $folder_id = null,
        int $page = null,
        int $page_size = null,
        string $order = null,
    ): Page {
        $parameters = get_defined_vars();
        $request = new Request("GET", "/v30/products", $parameters);
        return $this->submit($request, new Model\ProductPagination);
    }

    /**
     * [Generated method]
     */
    public function retrieveProduct(
        int $obj_id,
    ): Model\Product {
        $parameters = get_defined_vars();
        $request = new Request("GET", "/v30/products/{obj_id}", $parameters);
        return $this->submit($request, new Model\Product);
    }

    /**
     * [Generated method]
     */
    public function listSaleInvoiceLogEntries(
        int $obj_id,
        array|int $author_id = null,
        array|string $type = null,
        int $page = null,
        int $page_size = null,
        string $order = null,
    ): Page {
        $parameters = get_defined_vars();
        $request = new Request("GET", "/v30/sale-invoices/{obj_id}/logs", $parameters);
        return $this->submit($request, new Model\LogEntryPagination);
    }

    /**
     * [Generated method]
     */
    public function retrieveSaleInvoiceLogEntry(
        int $log_entry_id,
        int $obj_id,
    ): Model\LogEntry {
        $parameters = get_defined_vars();
        $request = new Request("GET", "/v30/sale-invoices/{obj_id}/logs/{log_entry_id}", $parameters);
        return $this->submit($request, new Model\LogEntry);
    }

    /**
     * [Generated method]
     */
    public function listSaleInvoices(
        int $entity_id = null,
        string $period_filter = null,
        array|string $invoice_status = null,
        array|string $invoice_num_reminders_send = null,
        array|string $invoice_type = null,
        array|string $category = null,
        array|int $product_offer_id = null,
        array|int $member_id = null,
        array|int $collection_id = null,
        bool $use_direct_debit = null,
        string $contribution_start = null,
        string $contribution_end = null,
        int $page = null,
        int $page_size = null,
        string $order = null,
    ): Page {
        $parameters = get_defined_vars();
        $request = new Request("GET", "/v30/sale-invoices", $parameters);
        return $this->submit($request, new Model\SaleInvoicePagination);
    }

    /**
     * [Generated method]
     */
    public function retrieveSaleInvoice(
        int $obj_id,
    ): Model\SaleInvoice {
        $parameters = get_defined_vars();
        $request = new Request("GET", "/v30/sale-invoices/{obj_id}", $parameters);
        return $this->submit($request, new Model\SaleInvoice);
    }

    /**
     * [Generated method]
     */
    public function listSaleInvoiceItems(
        int $obj_id,
        int $page = null,
        int $page_size = null,
        string $order = null,
    ): Page {
        $parameters = get_defined_vars();
        $request = new Request("GET", "/v30/sale-invoices/{obj_id}/items", $parameters);
        return $this->submit($request, new Model\SaleInvoiceItemPagination);
    }

    /**
     * [Generated method]
     */
    public function listSaleInvoiceWorkflows(
        int $page = null,
        int $page_size = null,
        string $order = null,
    ): Page {
        $parameters = get_defined_vars();
        $request = new Request("GET", "/v30/sale-invoices/workflows", $parameters);
        return $this->submit($request, new Model\SaleInvoiceWorkflowPagination);
    }

    /**
     * [Generated method]
     */
    public function listStorageObjects(
        int $page = null,
        int $page_size = null,
        string $order = null,
    ): Page {
        $parameters = get_defined_vars();
        $request = new Request("GET", "/v30/storage", $parameters);
        return $this->submit($request, new Model\StorageObjectPagination);
    }

    /**
     * [Generated method]
     */
    public function retrieveStorageObject(
        int $obj_id,
    ): Model\StorageObject {
        $parameters = get_defined_vars();
        $request = new Request("GET", "/v30/storage/{obj_id}", $parameters);
        return $this->submit($request, new Model\StorageObject);
    }

    /**
     * [Generated method]
     */
    public function listWebhooks(
        int $page = null,
        int $page_size = null,
        string $order = null,
    ): Page {
        $parameters = get_defined_vars();
        $request = new Request("GET", "/v30/webhooks", $parameters);
        return $this->submit($request, new Model\WebhookPagination);
    }

    /**
     * [Generated method]
     */
    public function retrieveWebhook(
        int $obj_id,
    ): Model\Webhook {
        $parameters = get_defined_vars();
        $request = new Request("GET", "/v30/webhooks/{obj_id}", $parameters);
        return $this->submit($request, new Model\Webhook);
    }

    /**
     * [Generated method]
     */
    public function listWebhookCalls(
        int $obj_id,
        string $period_filter = null,
        array|string $status_code = null,
        int $page = null,
        int $page_size = null,
        string $order = null,
    ): Page {
        $parameters = get_defined_vars();
        $request = new Request("GET", "/v30/webhooks/{obj_id}/calls", $parameters);
        return $this->submit($request, new Model\WebhookCallPagination);
    }

    /**
     * [Generated method]
     */
    public function listWebpages(
        bool $published = null,
        array|int $website_id = null,
        array|int $template_id = null,
        int $page = null,
        int $page_size = null,
        string $order = null,
    ): Page {
        $parameters = get_defined_vars();
        $request = new Request("GET", "/v30/webpages", $parameters);
        return $this->submit($request, new Model\WebpagePagination);
    }

    /**
     * [Generated method]
     */
    public function retrieveWebpage(
        int $obj_id,
    ): Model\WebpageWithContent {
        $parameters = get_defined_vars();
        $request = new Request("GET", "/v30/webpages/{obj_id}", $parameters);
        return $this->submit($request, new Model\WebpageWithContent);
    }

    /**
     * [Generated method]
     */
    public function listWebsites(
        bool $published = null,
        array|int $template_id = null,
        int $page = null,
        int $page_size = null,
        string $order = null,
    ): Page {
        $parameters = get_defined_vars();
        $request = new Request("GET", "/v30/websites", $parameters);
        return $this->submit($request, new Model\WebsitePagination);
    }

    /**
     * [Generated method]
     */
    public function retrieveWebsite(
        int $obj_id,
    ): Model\Website {
        $parameters = get_defined_vars();
        $request = new Request("GET", "/v30/websites/{obj_id}", $parameters);
        return $this->submit($request, new Model\Website);
    }

    /**
     * [Generated method]
     */
    public function listWebsiteWebpages(
        int $obj_id,
        bool $published = null,
        array|int $website_id = null,
        array|int $template_id = null,
        int $page = null,
        int $page_size = null,
        string $order = null,
    ): Page {
        $parameters = get_defined_vars();
        $request = new Request("GET", "/v30/websites/{obj_id}/webpages", $parameters);
        return $this->submit($request, new Model\WebpagePagination);
    }

    public function createMemberLogEntry(int $member_id, string $type, ?string $text): void
    {
        $args = get_defined_vars();
        $request = new Request("POST", "/v30/members/{member_id}/logs", $args);
        $request->setPathParameters(member_id: $member_id);
        $request->setBody(type: $type, text: $text);
        $this->submit($request);
    }
}
