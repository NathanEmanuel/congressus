<?php

namespace Compucie\Congressus;

use Compucie\Congressus\Model;
use Compucie\Congressus\Page;
use Compucie\Congressus\Request;

trait CustomRequestingMethodsTrait
{
    /**
     * Submit request to the Congressus API and return the response as a page or as a data model object.
     * @param   Request $request        The request to submit
     * @param   mixed   $responseType   The data type of the response
     * @return  mixed                   The response as a page or data model object
     */
    abstract private function submit(Request $request, mixed $responseType = null): mixed;

    /**
     * Download a file to the given file system location.
     * @param   Request $request    The request to submit.
     * @param   string  $filePath   The location where to save the file.
     */
    abstract private function download(Request $request, string $filePath): void;

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
     * Mistake in Congressus's OpenAPI spec.
     */
    public function createSaleInvoice(array $items, int $entity_id = null, string $invoice_date = null, string $invoice_reference = null, int $member_id = null, int $collection_id = null, string $contribution_start = null, string $contribution_end = null, bool $use_direct_debit = null, int $invoice_workflow_id = null, string $addressee = null, string $addressee_attention = null, string $email = null, object $address = null): Model\SaleInvoice
    {
        $args = get_defined_vars(); // MUST be the first line in the method
        $request = new Request("POST", "/v30/sale-invoices", $args);
        $request->enablePathParameters();
        $request->enableQueryParameters();
        $request->enableBodyFields("items", "entity_id", "invoice_date", "invoice_reference", "member_id", "collection_id", "contribution_start", "contribution_end", "use_direct_debit", "invoice_workflow_id", "addressee", "addressee_attention", "email", "address");
        return $this->submit($request, new Model\SaleInvoice);
    }

    /**
     * Mistake in Congressus's OpenAPI spec.
     */
    public function updateSaleInvoice(int $obj_id, array $items, int $entity_id = null, string $invoice_date = null, string $invoice_reference = null, int $member_id = null, int $collection_id = null, string $contribution_start = null, string $contribution_end = null, bool $use_direct_debit = null, int $invoice_workflow_id = null, string $addressee = null, string $addressee_attention = null, string $email = null, object $address = null): Model\SaleInvoice
    {
        $args = get_defined_vars(); // MUST be the first line in the method
        $request = new Request("PUT", "/v30/sale-invoices/{obj_id}", $args);
        $request->enablePathParameters("obj_id");
        $request->enableQueryParameters();
        $request->enableBodyFields("items", "entity_id", "invoice_date", "invoice_reference", "member_id", "collection_id", "contribution_start", "contribution_end", "use_direct_debit", "invoice_workflow_id", "addressee", "addressee_attention", "email", "address");
        return $this->submit($request, new Model\SaleInvoice);
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

    /**
     * This method needs at least one of the optional argument for some stupid reason. This seems to be a bug in Congressus's API.
     * I "fixed" this by always setting a delivery method, with the API's default value as this method's default value.
     */
    public function sendASaleInvoice(int $obj_id, string $delivery_method = "according_workflow", string $email_subject = null, string $email_text = null): void
    {
        $args = get_defined_vars(); // MUST be the first line in the method
        $request = new Request("POST", "/v30/sale-invoices/{obj_id}/send", $args);
        $request->enablePathParameters("obj_id");
        $request->enableQueryParameters();
        $request->enableBodyFields("delivery_method", "email_subject", "email_text");
        $this->submit($request);
    }

    /**
     * Mistake in Congressus's OpenAPI spec.
     */
    public function createSaleInvoiceItem(int $obj_id, int $product_offer_id, int $quantity = null, float $price = null, object $sort_order = null): Model\SaleInvoiceItem
    {
        $args = get_defined_vars(); // MUST be the first line in the method
        $request = new Request("POST", "/v30/sale-invoices/{obj_id}/items", $args);
        $request->enablePathParameters("obj_id");
        $request->enableQueryParameters();
        $request->enableBodyFields("product_offer_id", "quantity", "price", "sort_order");
        return $this->submit($request, new Model\SaleInvoiceItem);
    }
}
