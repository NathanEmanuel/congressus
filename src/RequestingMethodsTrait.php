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
}
