<?php

namespace Compucie\Congressus;

use Compucie\Congressus\Model;
use Compucie\Congressus\Page;
use Compucie\Congressus\Request\Parameters;
use Compucie\Congressus\Request\ParameterType\Path;
use Compucie\Congressus\Request\ParameterType\Query;
use Compucie\Congressus\Request\Request;

trait RequestingMethodsTrait
{
    /*
        -------------------- Members --------------------
    */

    public function listMembers(Parameters $parameters = new Parameters()): Page
    {
        $request = new Request("GET", "/v30/members", $parameters);
        $request->allowParameters([
            Query::status_id,
            Query::socie_app_id,
            Query::page,
            Query::page_size,
            Query::order,
            Query::context,
        ]);
        return $this->submit($request, new Model\MemberPagination);
    }

    public function retrieveMember(Parameters $parameters): Model\Member
    {
        $request = new Request("GET", "/v30/members/{obj_id}", $parameters);
        $request->allowParameters([
            Path::obj_id,
            Query::context,
        ]);
        return $this->submit($request, new Model\Member);
    }

    public function searchMembers(Parameters $parameters): Page
    {
        $request = new Request("GET", "/v30/members/search", $parameters);
        $request->allowParameters([
            Query::term
        ]);
        return $this->submit($request, new Model\ElasticMemberPagination);
    }


    /*
        -------------------- Member statuses --------------------
    */

    // Generated method
    public function listMemberStatuses(Parameters $parameters = new Parameters()): Page
    {
        $request = new Request("GET", "/v30/member-statuses", $parameters);
        $request->allowParameters([
            Query::archived,
            Query::hidden,
            Query::deceased,
            Query::page,
            Query::page_size,
            Query::order,
        ]);
        return $this->submit($request, new Model\MemberStatusListPagination);
    }

    // Generated method
    public function retrieveMemberStatus(Parameters $parameters): Model\MemberStatusWithFieldSettings
    {
        $request = new Request("GET", "/v30/member-statuses/{obj_id}", $parameters);
        $request->allowParameters([
            Path::obj_id,
        ]);
        return $this->submit($request, new Model\MemberStatusWithFieldSettings);
    }


    /*
        -------------------- Groups --------------------
    */

    // Generated method
    public function listGroups(Parameters $parameters = new Parameters()): Page
    {
        $request = new Request("GET", "/v30/groups", $parameters);
        $request->allowParameters([
            Query::published,
            Query::folder_id,
            Query::member_id,
            Query::socie_app_id,
            Query::page,
            Query::page_size,
            Query::order,
        ]);
        return $this->submit($request, new Model\GroupPagination);
    }

    // Generated method
    public function retrieveGroup(Parameters $parameters): Model\GroupWithMemberships
    {
        $request = new Request("GET", "/v30/groups/{obj_id}", $parameters);
        $request->allowParameters([
            Path::obj_id,
        ]);
        return $this->submit($request, new Model\GroupWithMemberships);
    }

    // Generated method
    public function listGroupMemberships(Parameters $parameters = new Parameters()): Page
    {
        $request = new Request("GET", "/v30/groups/memberships", $parameters);
        $request->allowParameters([
            Query::group_id,
            Query::member_id,
            Query::page,
            Query::page_size,
            Query::order,
        ]);
        return $this->submit($request, new Model\GroupMembershipPagination);
    }

    // Generated method
    public function retrieveGroupMembership(Parameters $parameters): Model\GroupMembership
    {
        $request = new Request("GET", "/v30/groups/memberships/{obj_id}", $parameters);
        $request->allowParameters([
            Path::obj_id,
        ]);
        return $this->submit($request, new Model\GroupMembership);
    }


    /*
        -------------------- Group folders --------------------
    */

    // Generated method
    public function listGroupFoldersRecursive(Parameters $parameters = new Parameters()): Page
    {
        $request = new Request("GET", "/v30/group-folders/recursive", $parameters);
        $request->allowParameters([
            Query::page,
            Query::page_size,
            Query::order,
        ]);
        return $this->submit($request, new Model\GroupFolderListRecursivePagination);
    }

    // Generated method
    public function listGroupFolders(Parameters $parameters = new Parameters()): Page
    {
        $request = new Request("GET", "/v30/group-folders", $parameters);
        $request->allowParameters([
            Query::published,
            Query::parent_id,
            Query::page,
            Query::page_size,
            Query::order,
        ]);
        return $this->submit($request, new Model\GroupFolderPagination);
    }

    // Generated method
    public function retrieveGroupFolder(Parameters $parameters): Model\GroupFolder
    {
        $request = new Request("GET", "/v30/group-folders/{obj_id}", $parameters);
        $request->allowParameters([
            Path::obj_id,
        ]);
        return $this->submit($request, new Model\GroupFolder);
    }


    /*
        -------------------- Organisations --------------------
    */

    // Generated method
    public function listOrganisationCategories(Parameters $parameters = new Parameters()): Page
    {
        $request = new Request("GET", "/v30/organisations/categories", $parameters);
        $request->allowParameters([
            Query::page,
            Query::page_size,
            Query::order,
        ]);
        return $this->submit($request, new Model\OrganisationCategoryPagination);
    }

    // Generated method
    public function retrieveOrganisationCategory(Parameters $parameters): Model\OrganisationCategory
    {
        $request = new Request("GET", "/v30/organisations/categories/{obj_id}", $parameters);
        $request->allowParameters([
            Path::obj_id,
        ]);
        return $this->submit($request, new Model\OrganisationCategory);
    }

    // Generated method
    public function listOrganisations(Parameters $parameters = new Parameters()): Page
    {
        $request = new Request("GET", "/v30/organisations", $parameters);
        $request->allowParameters([
            Query::category_id,
            Query::sbi_code,
            Query::legal_form,
            Query::member_id,
            Query::page,
            Query::page_size,
            Query::order,
        ]);
        return $this->submit($request, new Model\OrganisationPagination);
    }

    // Generated method
    public function retrieveOrganisation(Parameters $parameters): Model\Organisation
    {
        $request = new Request("GET", "/v30/organisations/{obj_id}", $parameters);
        $request->allowParameters([
            Path::obj_id,
        ]);
        return $this->submit($request, new Model\Organisation);
    }

    // Generated method
    public function listOrganisationMemberships(Parameters $parameters = new Parameters()): Page
    {
        $request = new Request("GET", "/v30/organisations/memberships", $parameters);
        $request->allowParameters([
            Query::organisation_id,
            Query::member_id,
            Query::page,
            Query::page_size,
            Query::order,
        ]);
        return $this->submit($request, new Model\OrganisationMembershipPagination);
    }

    // Generated method
    public function retrieveOrganisationMembership(Parameters $parameters): Model\OrganisationMembership
    {
        $request = new Request("GET", "/v30/organisations/memberships/{obj_id}", $parameters);
        $request->allowParameters([
            Path::obj_id,
        ]);
        return $this->submit($request, new Model\OrganisationMembership);
    }


    /*
        -------------------- Websites --------------------
    */

    // Generated method
    public function listWebsites(Parameters $parameters = new Parameters()): Page
    {
        $request = new Request("GET", "/v30/websites", $parameters);
        $request->allowParameters([
            Query::published,
            Query::template_id,
            Query::page,
            Query::page_size,
            Query::order,
        ]);
        return $this->submit($request, new Model\WebsitePagination);
    }

    // Generated method
    public function retrieveWebsite(Parameters $parameters): Model\Website
    {
        $request = new Request("GET", "/v30/websites/{obj_id}", $parameters);
        $request->allowParameters([
            Path::obj_id,
        ]);
        return $this->submit($request, new Model\Website);
    }

    public function listWebsiteWebpages(Parameters $parameters = new Parameters()): Page
    {
        $request = new Request("GET", "/v30/websites/{obj_id}/webpages", $parameters);
        $request->allowParameters([
            Path::obj_id,
            Query::published,
            Query::website_id,
            Query::template_id,
            Query::page,
            Query::page_size,
            Query::order,
        ]);
        return $this->submit($request, new Model\WebpagePagination);
    }


    /*
        -------------------- Webpages --------------------
    */

    // Generated method
    public function listWebpages(Parameters $parameters = new Parameters()): Page
    {
        $request = new Request("GET", "/v30/webpages", $parameters);
        $request->allowParameters([
            Query::published,
            Query::website_id,
            Query::template_id,
            Query::page,
            Query::page_size,
            Query::order,
        ]);
        return $this->submit($request, new Model\WebpagePagination);
    }

    // Generated method
    public function retrieveWebpage(Parameters $parameters): Model\WebpageWithContent
    {
        $request = new Request("GET", "/v30/webpages/{obj_id}", $parameters);
        $request->allowParameters([
            Path::obj_id,
        ]);
        return $this->submit($request, new Model\WebpageWithContent);
    }


    /*
        -------------------- Events --------------------
    */

    /**
     * @param   array   period_filter   Array containing the start and end of the period
     */
    public function listEvents(Parameters $parameters = new Parameters()): Page
    {
        // hook into the given parameters to format the period_filter correctly
        $formatPeriodFilter = function (Parameters $parameters) {
            $period = $parameters->get(Query::period_filter);
            if (is_null($period)) {
                return $parameters; // filter_period parameter not set
            }

            $period_start = $period[0] ?? null;
            $period_end = $period[1] ?? null;
            if (!is_null($period_start) && !is_null($period_end)) {
                $value = date("Ymd", $period_start) . ".." . date("Ymd", $period_end);
            } elseif (is_null($period_start) && !is_null($period_end)) {
                $value = date("Ymd", 0) . ".." . date("Ymd", $period_end);
            } elseif (!is_null($period_start) && is_null($period_end)) {
                $value = date("Ymd", time()) . ".." . date("Ymd", 2147483647);
            } else {
                throw new \InvalidArgumentException("period_filter needs to be a (partially null) array containing the start and end of the period");
            }
            $parameters->add(Query::period_filter, $value);
            return $parameters;
        };

        $parameters = $formatPeriodFilter($parameters);

        // submit request
        $request = new Request("GET", "/v30/events", $parameters);
        $request->allowParameters([
            Query::category_id,
            Query::period_filter,
            Query::published,
            Query::participation_billing_enabled,
            Query::participating_member_id,
            Query::socie_app_id,
            Query::member_id,
            Query::page,
            Query::page_size,
            Query::order,
        ]);
        return $this->submit($request, new Model\EventPagination);
    }

    // Generated method
    public function retrieveEvent(Parameters $parameters): Model\Event
    {
        $request = new Request("GET", "/v30/events/{obj_id}", $parameters);
        $request->allowParameters([
            Path::obj_id,
        ]);
        return $this->submit($request, new Model\Event);
    }

    // Generated method
    public function listEventParticipations(Parameters $parameters = new Parameters()): Page
    {
        $request = new Request("GET", "/v30/events/{obj_id}/participations", $parameters);
        $request->allowParameters([
            Path::obj_id,
            Query::event_id,
            Query::status,
            Query::has_invoice,
            Query::sale_invoice_status,
            Query::member_id,
            Query::page,
            Query::page_size,
            Query::order,
        ]);
        return $this->submit($request, new Model\EventParticipationPagination);
    }

    // Generated method
    public function retrieveEventParticipation(Parameters $parameters): Model\EventParticipationWithRelations
    {
        $request = new Request("GET", "/v30/events/{event_id}/participations/{obj_id}", $parameters);
        $request->allowParameters([
            Path::event_id,
            Path::obj_id,
        ]);
        return $this->submit($request, new Model\EventParticipationWithRelations);
    }

    // Generated method
    public function listTicketTypes(Parameters $parameters = new Parameters()): Page
    {
        $request = new Request("GET", "/v30/events/{obj_id}/ticket-types", $parameters);
        $request->allowParameters([
            Path::obj_id,
            Query::is_available_for_members,
            Query::is_available_for_external,
            Query::availability_status,
            Query::page,
            Query::page_size,
            Query::order,
        ]);
        return $this->submit($request, new Model\TicketTypePagination);
    }

    // Generated method
    public function retrieveTicketType(Parameters $parameters): Model\EventTicketType
    {
        $request = new Request("GET", "/v30/events/{event_id}/ticket-types/{obj_id}", $parameters);
        $request->allowParameters([
            Path::event_id,
            Path::obj_id,
        ]);
        return $this->submit($request, new Model\EventTicketType);
    }


    /*
        -------------------- Event categories --------------------
    */

    // Generated method
    public function listEventCategories(Parameters $parameters = new Parameters()): Page
    {
        $request = new Request("GET", "/v30/event-categories", $parameters);
        $request->allowParameters([
            Query::page,
            Query::page_size,
            Query::order,
        ]);
        return $this->submit($request, new Model\EventCategoryPagination);
    }


    /*
        -------------------- Blogs --------------------
    */

    // Generated method
    public function listBlogAuthors(Parameters $parameters = new Parameters()): Page
    {
        $request = new Request("GET", "/v30/blogs/authors", $parameters);
        $request->allowParameters([
            Query::page,
            Query::page_size,
            Query::order,
        ]);
        return $this->submit($request, new Model\BlogAuthorPagination);
    }

    // Generated method
    public function retrieveBlogAuthor(Parameters $parameters): Model\BlogAuthor
    {
        $request = new Request("GET", "/v30/blogs/authors/{obj_id}", $parameters);
        $request->allowParameters([
            Path::obj_id,
        ]);
        return $this->submit($request, new Model\BlogAuthor);
    }

    // Generated method
    public function listBlogs(Parameters $parameters = new Parameters()): Page
    {
        $request = new Request("GET", "/v30/blogs", $parameters);
        $request->allowParameters([
            Query::period_filter,
            Query::author_id,
            Query::issue_id,
            Query::category_id,
            Query::published,
            Query::visibility,
            Query::page,
            Query::page_size,
            Query::order,
        ]);
        return $this->submit($request, new Model\BlogPagination);
    }

    // Generated method
    public function retrieveBlog(Parameters $parameters): Model\BlogWithParagraph
    {
        $request = new Request("GET", "/v30/blogs/{obj_id}", $parameters);
        $request->allowParameters([
            Path::obj_id,
        ]);
        return $this->submit($request, new Model\BlogWithParagraph);
    }

    // Generated method
    public function retrieveBlogTextParagraph(Parameters $parameters): Model\BlogTextParagraph
    {
        $request = new Request("GET", "/v30/blogs/paragraphs/text/{obj_id}", $parameters);
        $request->allowParameters([
            Path::obj_id,
        ]);
        return $this->submit($request, new Model\BlogTextParagraph);
    }

    // Generated method
    public function retrieveBlogImageParagraph(Parameters $parameters): Model\BlogImageParagraph
    {
        $request = new Request("GET", "/v30/blogs/paragraphs/image/{obj_id}", $parameters);
        $request->allowParameters([
            Path::obj_id,
        ]);
        return $this->submit($request, new Model\BlogImageParagraph);
    }

    // Generated method
    public function listBlogCategories(Parameters $parameters = new Parameters()): Page
    {
        $request = new Request("GET", "/v30/blogs/categories", $parameters);
        $request->allowParameters([
            Query::page,
            Query::page_size,
            Query::order,
        ]);
        return $this->submit($request, new Model\BlogCategoryPagination);
    }

    // Generated method
    public function retrieveBlogCategory(Parameters $parameters): Model\BlogCategory
    {
        $request = new Request("GET", "/v30/blogs/categories/{obj_id}", $parameters);
        $request->allowParameters([
            Path::obj_id,
        ]);
        return $this->submit($request, new Model\BlogCategory);
    }

    // Generated method
    public function listBlogIssues(Parameters $parameters = new Parameters()): Page
    {
        $request = new Request("GET", "/v30/blogs/issues", $parameters);
        $request->allowParameters([
            Query::page,
            Query::page_size,
            Query::order,
        ]);
        return $this->submit($request, new Model\BlogIssuePagination);
    }

    // Generated method
    public function retrieveBlogIssue(Parameters $parameters): Model\BlogIssue
    {
        $request = new Request("GET", "/v30/blogs/issues/{obj_id}", $parameters);
        $request->allowParameters([
            Path::obj_id,
        ]);
        return $this->submit($request, new Model\BlogIssue);
    }


    /*
        -------------------- News --------------------
    */

    // Generated method
    public function listNews(Parameters $parameters = new Parameters()): Page
    {
        $request = new Request("GET", "/v30/news", $parameters);
        $request->allowParameters([
            Query::period_filter,
            Query::actual,
            Query::comments_open,
            Query::visibility,
            Query::page,
            Query::page_size,
            Query::order,
        ]);
        return $this->submit($request, new Model\NewsPagination);
    }

    // Generated method
    public function retrieveNews(Parameters $parameters): Model\News
    {
        $request = new Request("GET", "/v30/news/{obj_id}", $parameters);
        $request->allowParameters([
            Path::obj_id,
        ]);
        return $this->submit($request, new Model\News);
    }


    /*
        -------------------- Career partners  --------------------
    */

    // Generated method
    public function listCareerPartnerCategories(Parameters $parameters = new Parameters()): Page
    {
        $request = new Request("GET", "/v30/career/partners/categories", $parameters);
        $request->allowParameters([
            Query::page,
            Query::page_size,
            Query::order,
        ]);
        return $this->submit($request, new Model\CareerPartnerCategoryPagination);
    }

    // Generated method
    public function retrieveCareerPartnerCategory(Parameters $parameters): Model\CareerPartnerCategory
    {
        $request = new Request("GET", "/v30/career/partners/categories/{obj_id}", $parameters);
        $request->allowParameters([
            Path::obj_id,
        ]);
        return $this->submit($request, new Model\CareerPartnerCategory);
    }

    // Generated method
    public function listCareerPartners(Parameters $parameters = new Parameters()): Page
    {
        $request = new Request("GET", "/v30/career/partners", $parameters);
        $request->allowParameters([
            Query::career_partner_category_id,
            Query::page,
            Query::page_size,
            Query::order,
        ]);
        return $this->submit($request, new Model\CareerPartnerPagination);
    }

    // Generated method
    public function retrieveCareerPartner(Parameters $parameters): Model\CareerPartner
    {
        $request = new Request("GET", "/v30/career/partners/{obj_id}", $parameters);
        $request->allowParameters([
            Path::obj_id,
        ]);
        return $this->submit($request, new Model\CareerPartner);
    }


    /*
        -------------------- Products --------------------
    */

    // Generated method
    public function listProducts(Parameters $parameters = new Parameters()): Page
    {
        $request = new Request("GET", "/v30/products", $parameters);
        $request->allowParameters([
            Query::published,
            Query::status,
            Query::folder_id,
            Query::page,
            Query::page_size,
            Query::order,
        ]);
        return $this->submit($request, new Model\ProductPagination);
    }

    // Generated method
    public function retrieveProduct(Parameters $parameters): Model\Product
    {
        $request = new Request("GET", "/v30/products/{obj_id}", $parameters);
        $request->allowParameters([
            Path::obj_id,
        ]);
        return $this->submit($request, new Model\Product);
    }


    /*
        -------------------- Product folders --------------------
    */

    // Generated method
    public function listProductFoldersRecursive(Parameters $parameters = new Parameters()): Page
    {
        $request = new Request("GET", "/v30/product-folders/recursive", $parameters);
        $request->allowParameters([
            Query::published,
            Query::parent_id,
            Query::page,
            Query::page_size,
            Query::order,
        ]);
        return $this->submit($request, new Model\ProductFolderListRecursivePagination);
    }

    // Generated method
    public function listProductFolders(Parameters $parameters = new Parameters()): Page
    {
        $request = new Request("GET", "/v30/product-folders", $parameters);
        $request->allowParameters([
            Query::published,
            Query::parent_id,
            Query::page,
            Query::page_size,
            Query::order,
        ]);
        return $this->submit($request, new Model\ProductFolderPagination);
    }

    // Generated method
    public function retrieveProductFolder(Parameters $parameters): Model\ProductFolder
    {
        $request = new Request("GET", "/v30/product-folders/{obj_id}", $parameters);
        $request->allowParameters([
            Path::obj_id,
        ]);
        return $this->submit($request, new Model\ProductFolder);
    }


    /*
        -------------------- Bank mutations --------------------
    */

    // Generated method
    public function listBankMutations(Parameters $parameters = new Parameters()): Page
    {
        $request = new Request("GET", "/v30/bank", $parameters);
        $request->allowParameters([
            Query::period_filter,
            Query::status,
            Query::mutation_type,
            Query::bank_import_id,
            Query::bank_statement_id,
            Query::bank_mutation_id,
            Query::page,
            Query::page_size,
            Query::order,
        ]);
        return $this->submit($request, new Model\BankMutationPagination);
    }

    // Generated method
    public function retrieveBankMutation(Parameters $parameters): Model\BankMutation
    {
        $request = new Request("GET", "/v30/bank/{obj_id}", $parameters);
        $request->allowParameters([
            Path::obj_id,
        ]);
        return $this->submit($request, new Model\BankMutation);
    }


    /*
        -------------------- Webhooks --------------------
    */

    // Generated method
    public function listWebhooks(Parameters $parameters = new Parameters()): Page
    {
        $request = new Request("GET", "/v30/webhooks", $parameters);
        $request->allowParameters([
            Query::page,
            Query::page_size,
            Query::order,
        ]);
        return $this->submit($request, new Model\WebhookPagination);
    }

    // Generated method
    public function retrieveWebhook(Parameters $parameters): Model\Webhook
    {
        $request = new Request("GET", "/v30/webhooks/{obj_id}", $parameters);
        $request->allowParameters([
            Path::obj_id,
        ]);
        return $this->submit($request, new Model\Webhook);
    }

    // Generated method
    public function listWebhookCalls(Parameters $parameters = new Parameters()): Page
    {
        $request = new Request("GET", "/v30/webhooks/{obj_id}/calls", $parameters);
        $request->allowParameters([
            Path::obj_id,
            Query::period_filter,
            Query::status_code,
            Query::page,
            Query::page_size,
            Query::order,
        ]);
        return $this->submit($request, new Model\WebhookCallPagination);
    }


    /*
        -------------------- Storage --------------------
    */

    // Generated method
    public function listStorageObjects(Parameters $parameters = new Parameters()): Page
    {
        $request = new Request("GET", "/v30/storage", $parameters);
        $request->allowParameters([
            Query::page,
            Query::page_size,
            Query::order,
        ]);
        return $this->submit($request, new Model\StorageObjectPagination);
    }

    // Generated method
    public function retrieveStorageObject(Parameters $parameters): Model\StorageObject
    {
        $request = new Request("GET", "/v30/storage/{obj_id}", $parameters);
        $request->allowParameters([
            Path::obj_id,
        ]);
        return $this->submit($request, new Model\StorageObject);
    }


    /*
        -------------------- Countries --------------------
    */

    // Generated method
    public function listCountries(Parameters $parameters = new Parameters()): Page
    {
        $request = new Request("GET", "/v30/countries", $parameters);
        $request->allowParameters([
            Query::page,
            Query::page_size,
            Query::order,
        ]);
        return $this->submit($request, new Model\CountryPagination);
    }

    // Generated method
    public function retrieveCountry(Parameters $parameters): Model\Country
    {
        $request = new Request("GET", "/v30/countries/{obj_id}", $parameters);
        $request->allowParameters([
            Path::obj_id,
        ]);
        return $this->submit($request, new Model\Country);
    }
}
