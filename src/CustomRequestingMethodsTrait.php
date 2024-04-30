<?php

namespace Compucie\Congressus;

use Compucie\Congressus\Model;
use Compucie\Congressus\Page;
use Compucie\Congressus\Request;

trait CustomRequestingMethodsTrait
{
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
        $args = get_defined_vars(); // this MUST be first

        $set_period_filter = function (int $period_start = null, int $period_end = null) {
            return match (true) {
                !is_null($period_start) && !is_null($period_end) => date("Ymd", $period_start) . ".." . date("Ymd", $period_end),
                !is_null($period_start) && is_null($period_end) => date("Ymd", time()) . ".." . date("Ymd", 2147483647),
                is_null($period_start) && !is_null($period_end) => date("Ymd", 0) . ".." . date("Ymd", $period_end),
            };
        };
        $args["period_filter"] = $set_period_filter($args["period_start"], $args["period_end"]);

        $request = new Request("GET", "/v30/events", $args);
        $request->enableQueryParameters("category_id", "period_filter", "published", "participation_billing_enabled", "participating_member_id", "socie_app_id", "member_id", "page", "page_size", "order");
        return $this->submit($request, new Model\EventPagination);
    }

    public function createMemberNote(
        int $member_id,
        ?string $text = null,
    ) {
        $type = "Note";
        $args = get_defined_vars();
        $request = new Request("POST", "/v30/members/{member_id}/logs", $args);
        $request->enablePathParameters("member_id");
        $request->enableBodyFields("text", "type");
        return $this->submit($request, new Model\CreateNote);
    }

    public function createSaleInvoiceNote(
        int $obj_id,
        ?string $text = null,
    ) {
        $type = "Note";
        $args = get_defined_vars();
        $request = new Request("POST", "/v30/sale-invoices/{obj_id}/logs", $args);
        $request->enablePathParameters("obj_id");
        $request->enableBodyFields("text", "type");
        return $this->submit($request, new Model\CreateNote);
    }

    public function createMemberTask(
        int $member_id,
        ?string $text = null,
        ?string $assignee_type = null,
        ?int $assignee_id = null,
    ) {
        $type = "Task";
        $args = get_defined_vars();
        $request = new Request("POST", "/v30/members/{member_id}/logs", $args);
        $request->enablePathParameters("member_id");
        $request->enableBodyFields("text", "assignee_type", "assignee_id", "type");
        return $this->submit($request, new Model\CreateTask);
    }

    public function createSaleInvoiceTask(
        int $obj_id,
        ?string $text = null,
        ?string $assignee_type = null,
        ?int $assignee_id = null,
    ) {
        $type = "Task";
        $args = get_defined_vars();
        $request = new Request("POST", "/v30/sale-invoices/{obj_id}/logs", $args);
        $request->enablePathParameters("obj_id");
        $request->enableBodyFields("text", "assignee_type", "assignee_id", "type");
        return $this->submit($request, new Model\CreateTask);
    }

    public function updateMemberNote(
        int $member_id,
        int $log_entry_id,
        ?string $text = null,
    ) {
        $type = "Note";
        $args = get_defined_vars();
        $request = new Request("PUT", "/v30/members/{member_id}/logs/{log_entry_id}", $args);
        $request->enablePathParameters("member_id", "log_entry_id");
        $request->enableBodyFields("text", "type");
        return $this->submit($request, new Model\UpdateNote);
    }

    public function updateSaleInvoiceNote(
        int $obj_id,
        int $log_entry_id,
        ?string $text = null,
    ) {
        $type = "Note";
        $args = get_defined_vars();
        $request = new Request("PUT", "/v30/sale-invoices/{obj_id}/logs/{log_entry_id}", $args);
        $request->enablePathParameters("obj_id", "log_entry_id");
        $request->enableBodyFields("text", "type");
        return $this->submit($request, new Model\UpdateNote);
    }

    public function updateMemberTask(
        int $member_id,
        int $log_entry_id,
        ?string $assignee_type = null,
        ?int $assignee_id = null,
        ?bool $is_completed = null,
        ?int $completed_by_id = null,
    ) {
        $type = "Task";
        $args = get_defined_vars();
        $request = new Request("PUT", "/v30/members/{member_id}/logs/{log_entry_id}", $args);
        $request->enablePathParameters("member_id", "log_entry_id");
        $request->enableBodyFields("text", "assignee_type", "assignee_id", "is_completed", "completed_by_id", "type");
        return $this->submit($request, new Model\UpdateTask);
    }

    public function updateSaleInvoiceTask(
        int $obj_id,
        int $log_entry_id,
        ?string $assignee_type = null,
        ?int $assignee_id = null,
        ?bool $is_completed = null,
        ?int $completed_by_id = null,
    ) {
        $type = "Task";
        $args = get_defined_vars();
        $request = new Request("PUT", "/v30/sale-invoices/{obj_id}/logs/{log_entry_id}", $args);
        $request->enablePathParameters("obj_id", "log_entry_id");
        $request->enableBodyFields("text", "assignee_type", "assignee_id", "is_completed", "completed_by_id", "type");
        return $this->submit($request, new Model\UpdateTask);
    }

    public function updateEventParticipation(int $obj_id, int $event_id, ?string $remarks = null, ?int $participation_certificates_credits_override = null, ?string $participation_certificates_date_override = null): void
    {
        $args = get_defined_vars(); // MUST be the first line in the method
        $request = new Request("PUT", "/v30/events/{event_id}/participations/{obj_id}", $args);
        $request->enablePathParameters("obj_id", "event_id");
        $request->enableBodyFields("remarks", "participation_certificates_credits_override", "participation_certificates_date_override");
        $this->submit($request);
    }

    public function approveParticipation(int $event_id, int $obj_id, bool $check_conditions = true)
    {
        $args = get_defined_vars(); // MUST be the first line in the method
        $request = new Request("POST", "/v30/events/{event_id}/participations/{obj_id}/approve", $args);
        $request->enablePathParameters("obj_id", "event_id");
        $request->enableBodyFields("check_conditions");
        $this->submit($request);
    }

    public function moveParticipationToWaitingList(int $event_id, int $obj_id, bool $check_conditions = true)
    {
        $args = get_defined_vars(); // MUST be the first line in the method
        $request = new Request("POST", "/v30/events/{event_id}/participations/{obj_id}/wait", $args);
        $request->enablePathParameters("obj_id", "event_id");
        $request->enableBodyFields("check_conditions");
        $this->submit($request);
    }

    public function unsubscribeParticipation(int $event_id, int $obj_id, int $fine_percentage = 0)
    {
        $args = get_defined_vars(); // MUST be the first line in the method
        $request = new Request("POST", "/v30/events/{event_id}/participations/{obj_id}/unsubscribe", $args);
        $request->enablePathParameters("obj_id", "event_id");
        $request->enableBodyFields("fine_percentage");
        $this->submit($request);
    }

    public function declineParticipation(int $event_id, int $obj_id, int $fine_percentage = 0)
    {
        $args = get_defined_vars(); // MUST be the first line in the method
        $request = new Request("POST", "/v30/events/{event_id}/participations/{obj_id}/decline", $args);
        $request->enablePathParameters("obj_id", "event_id");
        $request->enableBodyFields("fine_percentage");
        $this->submit($request);
    }

    public function updateTicketType(int $obj_id, int $event_id, string $availability_status = null, string $available_from = null, string $available_to = null, string $cancel_to = null, string $confirmation_email_text = null, bool $confirmation_email_text_enabled = null, string $description = null, int $filter_id = null, int $id = null, string $modified = null, string $name, int $num_tickets = null, object $num_tickets_available = null, int $num_tickets_max = null, string $num_tickets_max_per = null, int $num_tickets_sold = null, float $price = null, bool $pricing_enabled = null, object $vat_category = null, int $vat_category_id, string $visibility_level = null, bool $waiting_list_enabled = null, float $participation_certificate_credits = null): void
    {
        $args = get_defined_vars(); // MUST be the first line in the method
        $request = new Request("PUT", "/v30/events/{event_id}/ticket-types/{obj_id}", $args);
        $request->enablePathParameters("obj_id", "event_id");
        $request->enableBodyFields("availability_status", "available_from", "available_to", "cancel_to", "confirmation_email_text", "confirmation_email_text_enabled", "description", "event_id", "filter_id", "id", "modified", "name", "num_tickets", "num_tickets_available", "num_tickets_max", "num_tickets_max_per", "num_tickets_sold", "price", "pricing_enabled", "vat_category", "vat_category_id", "visibility_level", "waiting_list_enabled", "participation_certificate_credits");
        $this->submit($request);
    }

    /**
     * @param   int $obj_id     The ID of the invoice to download.
     * @param   int $filePath   The file system location where to save the file.
     */
    public function downloadASaleInvoiceAsPdfFile(int $obj_id, string $filePath): void
    {
        $args = get_defined_vars(); // MUST be the first line in the method
        $request = new Request("GET", "/v30/sale-invoices/{obj_id}/download", $args);
        $request->enablePathParameters("obj_id");
        $this->download($request, $filePath);
    }
}
