<?php

namespace Compucie\Congressus\Request\ParameterType;

use Compucie\Congressus\Request\ParameterType\ParameterTypeInterface;

enum Query: string implements ParameterTypeInterface
{
    case actual = "actual";
    case archived = "archived";
    case assignee_id = "assignee_id";
    case author_id = "author_id";
    case availability_status = "availability_status";
    case bank_import_id = "bank_import_id";
    case bank_mutation_id = "bank_mutation_id";
    case bank_statement_id = "bank_statement_id";
    case career_partner_category_id = "career_partner_category_id";
    case category = "category";
    case category_id = "category_id";
    case collection_id = "collection_id";
    case comments_open = "comments_open";
    case context = "context";
    case contribution_end = "contribution_end";
    case contribution_start = "contribution_start";
    case deceased = "deceased";
    case event_id = "event_id";
    case folder_id = "folder_id";
    case group_id = "group_id";
    case has_invoice = "has_invoice";
    case hidden = "hidden";
    case invoice_num_reminders_send = "invoice_num_reminders_send";
    case invoice_status = "invoice_status";
    case invoice_type = "invoice_type";
    case is_available_for_external = "is_available_for_external";
    case is_available_for_members = "is_available_for_members";
    case is_completed = "is_completed";
    case issue_id = "issue_id";
    case legal_form = "legal_form";
    case member_id = "member_id";
    case mutation_type = "mutation_type";
    case order = "order";
    case organisation_id = "organisation_id";
    case page = "page";
    case page_size = "page_size";
    case parent_id = "parent_id";
    case participating_member_id = "participating_member_id";
    case participation_billing_enabled = "participation_billing_enabled";
    case period_filter = "period_filter";
    case product_offer_id = "product_offer_id";
    case published = "published";
    case sale_invoice_status = "sale_invoice_status";
    case sbi_code = "sbi_code";
    case socie_app_id = "socie_app_id";
    case status = "status";
    case status_code = "status_code";
    case status_id = "status_id";
    case subject_type = "subject_type";
    case template_id = "template_id";
    case term = "term";
    case type = "type";
    case use_direct_debit = "use_direct_debit";
    case visibility = "visibility";
    case website_id = "website_id";

    public function get_value(): string
    {
        return $this->value;
    }
}
