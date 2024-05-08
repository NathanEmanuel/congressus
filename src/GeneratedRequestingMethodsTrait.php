<?php

namespace Compucie\Congressus;

use Compucie\Congressus\Model;
use Compucie\Congressus\Page;
use Compucie\Congressus\Request;

trait GeneratedRequestingMethodsTrait
{

    /**
     * @generated
     */
    public function listBackgroundProcesses(array $state = null, string $created = null, string $modified = null, int $page = null, int $page_size = null, string $order = null): Page
    {
        $args = get_defined_vars(); // MUST be the first line in the method
        $request = new Request("GET", "/v30/background-processes", $args);
        $request->enablePathParameters();
        $request->enableQueryParameters("state", "created", "modified", "page", "page_size", "order");
        $request->enableBodyFields();
        return $this->submit($request, new Model\BackgroundProcessPagination);
    }

    /**
     * @generated
     */
    public function retrieveBackgroundProcess(int $obj_id): Model\BackgroundProcess
    {
        $args = get_defined_vars(); // MUST be the first line in the method
        $request = new Request("GET", "/v30/background-processes/{obj_id}", $args);
        $request->enablePathParameters("obj_id");
        $request->enableQueryParameters();
        $request->enableBodyFields();
        return $this->submit($request, new Model\BackgroundProcess);
    }

    /**
     * @generated
     */
    public function retrieveBackgroundProcessResult(int $obj_id): Model\BackgroundProcessResult
    {
        $args = get_defined_vars(); // MUST be the first line in the method
        $request = new Request("GET", "/v30/background-processes/results/{obj_id}", $args);
        $request->enablePathParameters("obj_id");
        $request->enableQueryParameters();
        $request->enableBodyFields();
        return $this->submit($request, new Model\BackgroundProcessResult);
    }

    /**
     * @generated
     */
    public function listBankMutations(string $period_filter = null, string $status = null, string $mutation_type = null, int $bank_import_id = null, int $bank_statement_id = null, int $bank_mutation_id = null, int $page = null, int $page_size = null, string $order = null): Page
    {
        $args = get_defined_vars(); // MUST be the first line in the method
        $request = new Request("GET", "/v30/bank", $args);
        $request->enablePathParameters();
        $request->enableQueryParameters("period_filter", "status", "mutation_type", "bank_import_id", "bank_statement_id", "bank_mutation_id", "page", "page_size", "order");
        $request->enableBodyFields();
        return $this->submit($request, new Model\BankMutationPagination);
    }

    /**
     * @generated
     */
    public function retrieveBankMutation(int $obj_id): Model\BankMutation
    {
        $args = get_defined_vars(); // MUST be the first line in the method
        $request = new Request("GET", "/v30/bank/{obj_id}", $args);
        $request->enablePathParameters("obj_id");
        $request->enableQueryParameters();
        $request->enableBodyFields();
        return $this->submit($request, new Model\BankMutation);
    }

    /**
     * @generated
     */
    public function deleteBankMutation(int $obj_id): void
    {
        $args = get_defined_vars(); // MUST be the first line in the method
        $request = new Request("DELETE", "/v30/bank/{obj_id}", $args);
        $request->enablePathParameters("obj_id");
        $request->enableQueryParameters();
        $request->enableBodyFields();
        $this->submit($request);
    }

    /**
     * @generated
     */
    public function matchMutationWithASaleInvoice(int $obj_id, int $sale_invoice_id = null, float $amount = null): void
    {
        $args = get_defined_vars(); // MUST be the first line in the method
        $request = new Request("POST", "/v30/bank/{obj_id}/match", $args);
        $request->enablePathParameters("obj_id");
        $request->enableQueryParameters();
        $request->enableBodyFields("sale_invoice_id", "amount");
        $this->submit($request);
    }

    /**
     * @generated
     */
    public function removeMatchWithASaleInvoice(int $obj_id, int $sale_invoice_id = null, float $amount = null): void
    {
        $args = get_defined_vars(); // MUST be the first line in the method
        $request = new Request("POST", "/v30/bank/{obj_id}/unmatch", $args);
        $request->enablePathParameters("obj_id");
        $request->enableQueryParameters();
        $request->enableBodyFields("sale_invoice_id", "amount");
        $this->submit($request);
    }

    /**
     * @generated
     */
    public function listBlogAuthors(int $page = null, int $page_size = null, string $order = null): Page
    {
        $args = get_defined_vars(); // MUST be the first line in the method
        $request = new Request("GET", "/v30/blogs/authors", $args);
        $request->enablePathParameters();
        $request->enableQueryParameters("page", "page_size", "order");
        $request->enableBodyFields();
        return $this->submit($request, new Model\BlogAuthorPagination);
    }

    /**
     * @generated
     */
    public function createBlogAuthor(int $id = null, string $name, object $description = null, object $image = null): void
    {
        $args = get_defined_vars(); // MUST be the first line in the method
        $request = new Request("POST", "/v30/blogs/authors", $args);
        $request->enablePathParameters();
        $request->enableQueryParameters();
        $request->enableBodyFields("id", "name", "description", "image");
        $this->submit($request);
    }

    /**
     * @generated
     */
    public function retrieveBlogAuthor(int $obj_id): Model\BlogAuthor
    {
        $args = get_defined_vars(); // MUST be the first line in the method
        $request = new Request("GET", "/v30/blogs/authors/{obj_id}", $args);
        $request->enablePathParameters("obj_id");
        $request->enableQueryParameters();
        $request->enableBodyFields();
        return $this->submit($request, new Model\BlogAuthor);
    }

    /**
     * @generated
     */
    public function updateBlogAuthor(int $obj_id, int $id = null, string $name, object $description = null, object $image = null): void
    {
        $args = get_defined_vars(); // MUST be the first line in the method
        $request = new Request("PUT", "/v30/blogs/authors/{obj_id}", $args);
        $request->enablePathParameters("obj_id");
        $request->enableQueryParameters();
        $request->enableBodyFields("id", "name", "description", "image");
        $this->submit($request);
    }

    /**
     * @generated
     */
    public function deleteBlogAuthor(int $obj_id): void
    {
        $args = get_defined_vars(); // MUST be the first line in the method
        $request = new Request("DELETE", "/v30/blogs/authors/{obj_id}", $args);
        $request->enablePathParameters("obj_id");
        $request->enableQueryParameters();
        $request->enableBodyFields();
        $this->submit($request);
    }

    /**
     * @generated
     */
    public function listBlogs(string $period_filter = null, int $author_id = null, int $issue_id = null, int $category_id = null, int $published = null, array $visibility = null, int $page = null, int $page_size = null, string $order = null): Page
    {
        $args = get_defined_vars(); // MUST be the first line in the method
        $request = new Request("GET", "/v30/blogs", $args);
        $request->enablePathParameters();
        $request->enableQueryParameters("period_filter", "author_id", "issue_id", "category_id", "published", "visibility", "page", "page_size", "order");
        $request->enableBodyFields();
        return $this->submit($request, new Model\BlogPagination);
    }

    /**
     * @generated
     */
    public function createBlog(int $id = null, string $title, int $category_id, int $author_id = null, int $issue_id = null, bool $published = null, string $published_from = null, string $visibility = null, bool $authentication_required = null, string $memo = null): void
    {
        $args = get_defined_vars(); // MUST be the first line in the method
        $request = new Request("POST", "/v30/blogs", $args);
        $request->enablePathParameters();
        $request->enableQueryParameters();
        $request->enableBodyFields("id", "title", "category_id", "author_id", "issue_id", "published", "published_from", "visibility", "authentication_required", "memo");
        $this->submit($request);
    }

    /**
     * @generated
     */
    public function retrieveBlog(int $obj_id): Model\BlogWithParagraph
    {
        $args = get_defined_vars(); // MUST be the first line in the method
        $request = new Request("GET", "/v30/blogs/{obj_id}", $args);
        $request->enablePathParameters("obj_id");
        $request->enableQueryParameters();
        $request->enableBodyFields();
        return $this->submit($request, new Model\BlogWithParagraph);
    }

    /**
     * @generated
     */
    public function updateBlog(int $obj_id, int $id = null, string $title, int $category_id, int $author_id = null, int $issue_id = null, bool $published = null, string $published_from = null, string $visibility = null, bool $authentication_required = null, string $memo = null, array $paragraphs = null): void
    {
        $args = get_defined_vars(); // MUST be the first line in the method
        $request = new Request("PUT", "/v30/blogs/{obj_id}", $args);
        $request->enablePathParameters("obj_id");
        $request->enableQueryParameters();
        $request->enableBodyFields("id", "title", "category_id", "author_id", "issue_id", "published", "published_from", "visibility", "authentication_required", "memo", "paragraphs");
        $this->submit($request);
    }

    /**
     * @generated
     */
    public function deleteBlog(int $obj_id): void
    {
        $args = get_defined_vars(); // MUST be the first line in the method
        $request = new Request("DELETE", "/v30/blogs/{obj_id}", $args);
        $request->enablePathParameters("obj_id");
        $request->enableQueryParameters();
        $request->enableBodyFields();
        $this->submit($request);
    }

    /**
     * @generated
     */
    public function createBlogTextParagraph(int $obj_id, int $id = null, string $template = null, string $content, int $order = null, string $type = null, string $created = null, string $modified = null): void
    {
        $args = get_defined_vars(); // MUST be the first line in the method
        $request = new Request("POST", "/v30/blogs/{obj_id}/paragraphs/text", $args);
        $request->enablePathParameters("obj_id");
        $request->enableQueryParameters();
        $request->enableBodyFields("id", "template", "content", "order", "type", "created", "modified");
        $this->submit($request);
    }

    /**
     * @generated
     */
    public function createBlogImageParagraph(int $obj_id, int $id = null, string $template = null, string $caption = null, int $order = null, string $type = null, string $created = null, string $modified = null, object $image = null, int $image_id = null): void
    {
        $args = get_defined_vars(); // MUST be the first line in the method
        $request = new Request("POST", "/v30/blogs/{obj_id}/paragraphs/image", $args);
        $request->enablePathParameters("obj_id");
        $request->enableQueryParameters();
        $request->enableBodyFields("id", "template", "caption", "order", "type", "created", "modified", "image", "image_id");
        $this->submit($request);
    }

    /**
     * @generated
     */
    public function retrieveBlogTextParagraph(int $obj_id): Model\BlogTextParagraph
    {
        $args = get_defined_vars(); // MUST be the first line in the method
        $request = new Request("GET", "/v30/blogs/paragraphs/text/{obj_id}", $args);
        $request->enablePathParameters("obj_id");
        $request->enableQueryParameters();
        $request->enableBodyFields();
        return $this->submit($request, new Model\BlogTextParagraph);
    }

    /**
     * @generated
     */
    public function updateBlogTextParagraph(int $obj_id, int $id = null, string $template = null, string $content, int $order = null, string $type = null, string $created = null, string $modified = null): void
    {
        $args = get_defined_vars(); // MUST be the first line in the method
        $request = new Request("PUT", "/v30/blogs/paragraphs/text/{obj_id}", $args);
        $request->enablePathParameters("obj_id");
        $request->enableQueryParameters();
        $request->enableBodyFields("id", "template", "content", "order", "type", "created", "modified");
        $this->submit($request);
    }

    /**
     * @generated
     */
    public function deleteBlogTextParagraph(int $obj_id): void
    {
        $args = get_defined_vars(); // MUST be the first line in the method
        $request = new Request("DELETE", "/v30/blogs/paragraphs/text/{obj_id}", $args);
        $request->enablePathParameters("obj_id");
        $request->enableQueryParameters();
        $request->enableBodyFields();
        $this->submit($request);
    }

    /**
     * @generated
     */
    public function retrieveBlogImageParagraph(int $obj_id): Model\BlogImageParagraph
    {
        $args = get_defined_vars(); // MUST be the first line in the method
        $request = new Request("GET", "/v30/blogs/paragraphs/image/{obj_id}", $args);
        $request->enablePathParameters("obj_id");
        $request->enableQueryParameters();
        $request->enableBodyFields();
        return $this->submit($request, new Model\BlogImageParagraph);
    }

    /**
     * @generated
     */
    public function updateBlogImageParagraph(int $obj_id, int $id = null, string $template = null, string $caption = null, int $order = null, string $type = null, string $created = null, string $modified = null, object $image = null, int $image_id = null): void
    {
        $args = get_defined_vars(); // MUST be the first line in the method
        $request = new Request("PUT", "/v30/blogs/paragraphs/image/{obj_id}", $args);
        $request->enablePathParameters("obj_id");
        $request->enableQueryParameters();
        $request->enableBodyFields("id", "template", "caption", "order", "type", "created", "modified", "image", "image_id");
        $this->submit($request);
    }

    /**
     * @generated
     */
    public function deleteBlogImageParagraph(int $obj_id): void
    {
        $args = get_defined_vars(); // MUST be the first line in the method
        $request = new Request("DELETE", "/v30/blogs/paragraphs/image/{obj_id}", $args);
        $request->enablePathParameters("obj_id");
        $request->enableQueryParameters();
        $request->enableBodyFields();
        $this->submit($request);
    }

    /**
     * @generated
     */
    public function listBlogCategories(int $page = null, int $page_size = null, string $order = null): Page
    {
        $args = get_defined_vars(); // MUST be the first line in the method
        $request = new Request("GET", "/v30/blogs/categories", $args);
        $request->enablePathParameters();
        $request->enableQueryParameters("page", "page_size", "order");
        $request->enableBodyFields();
        return $this->submit($request, new Model\BlogCategoryPagination);
    }

    /**
     * @generated
     */
    public function createBlogCategory(int $id = null, string $name, string $color = null, string $slug = null, bool $published = null, object $visibility = null, array $websites = null): void
    {
        $args = get_defined_vars(); // MUST be the first line in the method
        $request = new Request("POST", "/v30/blogs/categories", $args);
        $request->enablePathParameters();
        $request->enableQueryParameters();
        $request->enableBodyFields("id", "name", "color", "slug", "published", "visibility", "websites");
        $this->submit($request);
    }

    /**
     * @generated
     */
    public function retrieveBlogCategory(int $obj_id): Model\BlogCategory
    {
        $args = get_defined_vars(); // MUST be the first line in the method
        $request = new Request("GET", "/v30/blogs/categories/{obj_id}", $args);
        $request->enablePathParameters("obj_id");
        $request->enableQueryParameters();
        $request->enableBodyFields();
        return $this->submit($request, new Model\BlogCategory);
    }

    /**
     * @generated
     */
    public function updateBlogCategory(int $obj_id, int $id = null, string $name, string $color = null, string $slug = null, bool $published = null, object $visibility = null, array $websites = null): void
    {
        $args = get_defined_vars(); // MUST be the first line in the method
        $request = new Request("PUT", "/v30/blogs/categories/{obj_id}", $args);
        $request->enablePathParameters("obj_id");
        $request->enableQueryParameters();
        $request->enableBodyFields("id", "name", "color", "slug", "published", "visibility", "websites");
        $this->submit($request);
    }

    /**
     * @generated
     */
    public function deleteBlogCategory(int $obj_id): void
    {
        $args = get_defined_vars(); // MUST be the first line in the method
        $request = new Request("DELETE", "/v30/blogs/categories/{obj_id}", $args);
        $request->enablePathParameters("obj_id");
        $request->enableQueryParameters();
        $request->enableBodyFields();
        $this->submit($request);
    }

    /**
     * @generated
     */
    public function listBlogIssues(int $page = null, int $page_size = null, string $order = null): Page
    {
        $args = get_defined_vars(); // MUST be the first line in the method
        $request = new Request("GET", "/v30/blogs/issues", $args);
        $request->enablePathParameters();
        $request->enableQueryParameters("page", "page_size", "order");
        $request->enableBodyFields();
        return $this->submit($request, new Model\BlogIssuePagination);
    }

    /**
     * @generated
     */
    public function createBlogIssue(int $id = null, string $name, object $description = null, object $image = null): void
    {
        $args = get_defined_vars(); // MUST be the first line in the method
        $request = new Request("POST", "/v30/blogs/issues", $args);
        $request->enablePathParameters();
        $request->enableQueryParameters();
        $request->enableBodyFields("id", "name", "description", "image");
        $this->submit($request);
    }

    /**
     * @generated
     */
    public function retrieveBlogIssue(int $obj_id): Model\BlogIssue
    {
        $args = get_defined_vars(); // MUST be the first line in the method
        $request = new Request("GET", "/v30/blogs/issues/{obj_id}", $args);
        $request->enablePathParameters("obj_id");
        $request->enableQueryParameters();
        $request->enableBodyFields();
        return $this->submit($request, new Model\BlogIssue);
    }

    /**
     * @generated
     */
    public function updateBlogIssue(int $obj_id, int $id = null, string $name, object $description = null, object $image = null): void
    {
        $args = get_defined_vars(); // MUST be the first line in the method
        $request = new Request("PUT", "/v30/blogs/issues/{obj_id}", $args);
        $request->enablePathParameters("obj_id");
        $request->enableQueryParameters();
        $request->enableBodyFields("id", "name", "description", "image");
        $this->submit($request);
    }

    /**
     * @generated
     */
    public function deleteBlogIssue(int $obj_id): void
    {
        $args = get_defined_vars(); // MUST be the first line in the method
        $request = new Request("DELETE", "/v30/blogs/issues/{obj_id}", $args);
        $request->enablePathParameters("obj_id");
        $request->enableQueryParameters();
        $request->enableBodyFields();
        $this->submit($request);
    }

    /**
     * @generated
     */
    public function listCareerPartnerCategories(int $page = null, int $page_size = null, string $order = null): Page
    {
        $args = get_defined_vars(); // MUST be the first line in the method
        $request = new Request("GET", "/v30/career/partners/categories", $args);
        $request->enablePathParameters();
        $request->enableQueryParameters("page", "page_size", "order");
        $request->enableBodyFields();
        return $this->submit($request, new Model\CareerPartnerCategoryPagination);
    }

    /**
     * @generated
     */
    public function createCareerPartnerCategory(int $id = null, string $name, string $color = null, string $slug = null, bool $published = null, object $visibility = null, array $websites = null): void
    {
        $args = get_defined_vars(); // MUST be the first line in the method
        $request = new Request("POST", "/v30/career/partners/categories", $args);
        $request->enablePathParameters();
        $request->enableQueryParameters();
        $request->enableBodyFields("id", "name", "color", "slug", "published", "visibility", "websites");
        $this->submit($request);
    }

    /**
     * @generated
     */
    public function retrieveCareerPartnerCategory(int $obj_id): Model\CareerPartnerCategory
    {
        $args = get_defined_vars(); // MUST be the first line in the method
        $request = new Request("GET", "/v30/career/partners/categories/{obj_id}", $args);
        $request->enablePathParameters("obj_id");
        $request->enableQueryParameters();
        $request->enableBodyFields();
        return $this->submit($request, new Model\CareerPartnerCategory);
    }

    /**
     * @generated
     */
    public function updateCareerPartnerCategory(int $obj_id, int $id = null, string $name, string $color = null, string $slug = null, bool $published = null, object $visibility = null, array $websites = null): void
    {
        $args = get_defined_vars(); // MUST be the first line in the method
        $request = new Request("PUT", "/v30/career/partners/categories/{obj_id}", $args);
        $request->enablePathParameters("obj_id");
        $request->enableQueryParameters();
        $request->enableBodyFields("id", "name", "color", "slug", "published", "visibility", "websites");
        $this->submit($request);
    }

    /**
     * @generated
     */
    public function deleteCareerPartnerCategory(int $obj_id): void
    {
        $args = get_defined_vars(); // MUST be the first line in the method
        $request = new Request("DELETE", "/v30/career/partners/categories/{obj_id}", $args);
        $request->enablePathParameters("obj_id");
        $request->enableQueryParameters();
        $request->enableBodyFields();
        $this->submit($request);
    }

    /**
     * @generated
     */
    public function listCareerPartners(int $career_partner_category_id = null, int $page = null, int $page_size = null, string $order = null): Page
    {
        $args = get_defined_vars(); // MUST be the first line in the method
        $request = new Request("GET", "/v30/career/partners", $args);
        $request->enablePathParameters();
        $request->enableQueryParameters("career_partner_category_id", "page", "page_size", "order");
        $request->enableBodyFields();
        return $this->submit($request, new Model\CareerPartnerPagination);
    }

    /**
     * @generated
     */
    public function createCareerPartner(int $id, string $name = null, string $slug, int $category_id, object $category = null, object $address = null, object $postal_address = null, string $description = null, string $description_short = null, string $email = null, string $url = null, object $logo = null, string $memo = null, string $invoice_reference = null, string $invoice_addressee_attention = null, string $invoice_address_field, string $invoice_email = null, array $events = null): void
    {
        $args = get_defined_vars(); // MUST be the first line in the method
        $request = new Request("POST", "/v30/career/partners", $args);
        $request->enablePathParameters();
        $request->enableQueryParameters();
        $request->enableBodyFields("id", "name", "slug", "category_id", "category", "address", "postal_address", "description", "description_short", "email", "url", "logo", "memo", "invoice_reference", "invoice_addressee_attention", "invoice_address_field", "invoice_email", "events");
        $this->submit($request);
    }

    /**
     * @generated
     */
    public function retrieveCareerPartner(int $obj_id): Model\CareerPartner
    {
        $args = get_defined_vars(); // MUST be the first line in the method
        $request = new Request("GET", "/v30/career/partners/{obj_id}", $args);
        $request->enablePathParameters("obj_id");
        $request->enableQueryParameters();
        $request->enableBodyFields();
        return $this->submit($request, new Model\CareerPartner);
    }

    /**
     * @generated
     */
    public function updateCareerPartner(int $obj_id, int $id, string $name = null, string $slug, int $category_id, object $category = null, object $address = null, object $postal_address = null, string $description = null, string $description_short = null, string $email = null, string $url = null, object $logo = null, string $memo = null, string $invoice_reference = null, string $invoice_addressee_attention = null, string $invoice_address_field, string $invoice_email = null, array $events = null): void
    {
        $args = get_defined_vars(); // MUST be the first line in the method
        $request = new Request("PUT", "/v30/career/partners/{obj_id}", $args);
        $request->enablePathParameters("obj_id");
        $request->enableQueryParameters();
        $request->enableBodyFields("id", "name", "slug", "category_id", "category", "address", "postal_address", "description", "description_short", "email", "url", "logo", "memo", "invoice_reference", "invoice_addressee_attention", "invoice_address_field", "invoice_email", "events");
        $this->submit($request);
    }

    /**
     * @generated
     */
    public function deleteCareerPartner(int $obj_id): void
    {
        $args = get_defined_vars(); // MUST be the first line in the method
        $request = new Request("DELETE", "/v30/career/partners/{obj_id}", $args);
        $request->enablePathParameters("obj_id");
        $request->enableQueryParameters();
        $request->enableBodyFields();
        $this->submit($request);
    }

    /**
     * @generated
     */
    public function listSavedReplies(int $page = null, int $page_size = null, string $order = null): Page
    {
        $args = get_defined_vars(); // MUST be the first line in the method
        $request = new Request("GET", "/v30/communication/saved-replies", $args);
        $request->enablePathParameters();
        $request->enableQueryParameters("page", "page_size", "order");
        $request->enableBodyFields();
        return $this->submit($request, new Model\SavedReplyPagination);
    }

    /**
     * @generated
     */
    public function createSavedReply(int $id = null, string $name, int $category_id, string $subject = null, object $message_json = null): void
    {
        $args = get_defined_vars(); // MUST be the first line in the method
        $request = new Request("POST", "/v30/communication/saved-replies", $args);
        $request->enablePathParameters();
        $request->enableQueryParameters();
        $request->enableBodyFields("id", "name", "category_id", "subject", "message_json");
        $this->submit($request);
    }

    /**
     * @generated
     */
    public function retrieveSavedReply(int $obj_id): Model\SavedReply
    {
        $args = get_defined_vars(); // MUST be the first line in the method
        $request = new Request("GET", "/v30/communication/saved-replies/{obj_id}", $args);
        $request->enablePathParameters("obj_id");
        $request->enableQueryParameters();
        $request->enableBodyFields();
        return $this->submit($request, new Model\SavedReply);
    }

    /**
     * @generated
     */
    public function updateSavedReply(int $obj_id, int $id = null, string $name, int $category_id, string $subject = null, object $message_json = null): void
    {
        $args = get_defined_vars(); // MUST be the first line in the method
        $request = new Request("PUT", "/v30/communication/saved-replies/{obj_id}", $args);
        $request->enablePathParameters("obj_id");
        $request->enableQueryParameters();
        $request->enableBodyFields("id", "name", "category_id", "subject", "message_json");
        $this->submit($request);
    }

    /**
     * @generated
     */
    public function deleteSavedReply(int $obj_id): void
    {
        $args = get_defined_vars(); // MUST be the first line in the method
        $request = new Request("DELETE", "/v30/communication/saved-replies/{obj_id}", $args);
        $request->enablePathParameters("obj_id");
        $request->enableQueryParameters();
        $request->enableBodyFields();
        $this->submit($request);
    }

    /**
     * @generated
     */
    public function listCountries(int $page = null, int $page_size = null, string $order = null): Page
    {
        $args = get_defined_vars(); // MUST be the first line in the method
        $request = new Request("GET", "/v30/countries", $args);
        $request->enablePathParameters();
        $request->enableQueryParameters("page", "page_size", "order");
        $request->enableBodyFields();
        return $this->submit($request, new Model\CountryPagination);
    }

    /**
     * @generated
     */
    public function retrieveCountry(int $obj_id): Model\Country
    {
        $args = get_defined_vars(); // MUST be the first line in the method
        $request = new Request("GET", "/v30/countries/{obj_id}", $args);
        $request->enablePathParameters("obj_id");
        $request->enableQueryParameters();
        $request->enableBodyFields();
        return $this->submit($request, new Model\Country);
    }

    /**
     * @generated
     */
    public function listEventCategories(int $page = null, int $page_size = null, string $order = null): Page
    {
        $args = get_defined_vars(); // MUST be the first line in the method
        $request = new Request("GET", "/v30/event-categories", $args);
        $request->enablePathParameters();
        $request->enableQueryParameters("page", "page_size", "order");
        $request->enableBodyFields();
        return $this->submit($request, new Model\EventCategoryPagination);
    }

    /**
     * @generated
     */
    public function createEvent(int $id = null, int $category_id, object $category = null, string $status = null, string $slug = null, string $name, string $description = null, bool $published = null, string $visibility = null, bool $authentication_required = null, string $start = null, string $end = null, bool $whole_day = null, string $location = null, bool $show_participants = null, bool $show_waiting_list = null, bool $show_rented_items = null, bool $participation_enabled = null, string $participation_mode = null, bool $participation_billing_enabled = null, string $participation_billing_type = null, bool $participation_payment_ideal = null, bool $participation_payment_direct_debit = null, bool $participation_payment_on_invoice = null, string $participation_information_collection_type = null, bool $qr_ticketing_enabled = null, array $ticket_types = null, int $num_tickets = null, int $num_tickets_sold = null, int $num_tickets_max_per_order = null, bool $participant_remarks_enabled = null, string $participant_remarks_placeholder = null, bool $rental_enabled = null, array $rental_categories = null, float $rental_max_price = null, array $career_partners = null, string $website_url = null, string $website_subscribe_url = null, bool $comments_open = null, array $comments = null, array $media = null, string $memo = null): void
    {
        $args = get_defined_vars(); // MUST be the first line in the method
        $request = new Request("POST", "/v30/events", $args);
        $request->enablePathParameters();
        $request->enableQueryParameters();
        $request->enableBodyFields("id", "category_id", "category", "status", "slug", "name", "description", "published", "visibility", "authentication_required", "start", "end", "whole_day", "location", "show_participants", "show_waiting_list", "show_rented_items", "participation_enabled", "participation_mode", "participation_billing_enabled", "participation_billing_type", "participation_payment_ideal", "participation_payment_direct_debit", "participation_payment_on_invoice", "participation_information_collection_type", "qr_ticketing_enabled", "ticket_types", "num_tickets", "num_tickets_sold", "num_tickets_max_per_order", "participant_remarks_enabled", "participant_remarks_placeholder", "rental_enabled", "rental_categories", "rental_max_price", "career_partners", "website_url", "website_subscribe_url", "comments_open", "comments", "media", "memo");
        $this->submit($request);
    }

    /**
     * @generated
     */
    public function retrieveEvent(int $obj_id): Model\Event
    {
        $args = get_defined_vars(); // MUST be the first line in the method
        $request = new Request("GET", "/v30/events/{obj_id}", $args);
        $request->enablePathParameters("obj_id");
        $request->enableQueryParameters();
        $request->enableBodyFields();
        return $this->submit($request, new Model\Event);
    }

    /**
     * @generated
     */
    public function updateEvent(int $obj_id, int $id = null, int $category_id, object $category = null, string $status = null, string $slug = null, string $name, string $description = null, bool $published = null, string $visibility = null, bool $authentication_required = null, string $start = null, string $end = null, bool $whole_day = null, string $location = null, bool $show_participants = null, bool $show_waiting_list = null, bool $show_rented_items = null, bool $participation_enabled = null, string $participation_mode = null, bool $participation_billing_enabled = null, string $participation_billing_type = null, bool $participation_payment_ideal = null, bool $participation_payment_direct_debit = null, bool $participation_payment_on_invoice = null, string $participation_information_collection_type = null, bool $qr_ticketing_enabled = null, array $ticket_types = null, int $num_tickets = null, int $num_tickets_sold = null, int $num_tickets_max_per_order = null, bool $participant_remarks_enabled = null, string $participant_remarks_placeholder = null, bool $rental_enabled = null, array $rental_categories = null, float $rental_max_price = null, array $career_partners = null, string $website_url = null, string $website_subscribe_url = null, bool $comments_open = null, array $comments = null, array $media = null, string $memo = null): void
    {
        $args = get_defined_vars(); // MUST be the first line in the method
        $request = new Request("PUT", "/v30/events/{obj_id}", $args);
        $request->enablePathParameters("obj_id");
        $request->enableQueryParameters();
        $request->enableBodyFields("id", "category_id", "category", "status", "slug", "name", "description", "published", "visibility", "authentication_required", "start", "end", "whole_day", "location", "show_participants", "show_waiting_list", "show_rented_items", "participation_enabled", "participation_mode", "participation_billing_enabled", "participation_billing_type", "participation_payment_ideal", "participation_payment_direct_debit", "participation_payment_on_invoice", "participation_information_collection_type", "qr_ticketing_enabled", "ticket_types", "num_tickets", "num_tickets_sold", "num_tickets_max_per_order", "participant_remarks_enabled", "participant_remarks_placeholder", "rental_enabled", "rental_categories", "rental_max_price", "career_partners", "website_url", "website_subscribe_url", "comments_open", "comments", "media", "memo");
        $this->submit($request);
    }

    /**
     * @generated
     */
    public function deleteEvent(int $obj_id): void
    {
        $args = get_defined_vars(); // MUST be the first line in the method
        $request = new Request("DELETE", "/v30/events/{obj_id}", $args);
        $request->enablePathParameters("obj_id");
        $request->enableQueryParameters();
        $request->enableBodyFields();
        $this->submit($request);
    }

    /**
     * @generated
     */
    public function listEventParticipations(int $obj_id, int $event_id = null, array $status = null, string $has_invoice = null, array $sale_invoice_status = null, int $member_id = null, int $page = null, int $page_size = null, string $order = null): Page
    {
        $args = get_defined_vars(); // MUST be the first line in the method
        $request = new Request("GET", "/v30/events/{obj_id}/participations", $args);
        $request->enablePathParameters("obj_id");
        $request->enableQueryParameters("event_id", "status", "has_invoice", "sale_invoice_status", "member_id", "page", "page_size", "order");
        $request->enableBodyFields();
        return $this->submit($request, new Model\EventParticipationPagination);
    }

    /**
     * @generated
     */
    public function retrieveEventParticipation(int $obj_id, int $event_id): Model\EventParticipationWithRelations
    {
        $args = get_defined_vars(); // MUST be the first line in the method
        $request = new Request("GET", "/v30/events/{event_id}/participations/{obj_id}", $args);
        $request->enablePathParameters("obj_id", "event_id");
        $request->enableQueryParameters();
        $request->enableBodyFields();
        return $this->submit($request, new Model\EventParticipationWithRelations);
    }

    /**
     * @generated
     */
    public function setPresenceOnAllTicketsWithinParticipation(int $obj_id, int $event_id, string $status_presence, float $participation_certificates_credits_override = null, string $participation_certificates_date_override = null): void
    {
        $args = get_defined_vars(); // MUST be the first line in the method
        $request = new Request("POST", "/v30/events/{event_id}/participations/{obj_id}/set-presence", $args);
        $request->enablePathParameters("obj_id", "event_id");
        $request->enableQueryParameters();
        $request->enableBodyFields("status_presence", "participation_certificates_credits_override", "participation_certificates_date_override");
        $this->submit($request);
    }

    /**
     * @generated
     */
    public function createEventParticipation(int $obj_id, string $addressee = null, string $email = null, array $tickets, int $member_id = null, string $remarks = null, string $invoice_addressee = null, string $invoice_email = null, string $invoice_invoice_reference = null, array $invoice_address = null): void
    {
        $args = get_defined_vars(); // MUST be the first line in the method
        $request = new Request("POST", "/v30/events/{obj_id}/sign-up", $args);
        $request->enablePathParameters("obj_id");
        $request->enableQueryParameters();
        $request->enableBodyFields("addressee", "email", "tickets", "member_id", "remarks", "invoice_addressee", "invoice_email", "invoice_invoice_reference", "invoice_address");
        $this->submit($request);
    }

    /**
     * @generated
     */
    public function listTicketTypes(int $obj_id, string $is_available_for_members = null, string $is_available_for_external = null, array $availability_status = null, int $page = null, int $page_size = null, string $order = null): Page
    {
        $args = get_defined_vars(); // MUST be the first line in the method
        $request = new Request("GET", "/v30/events/{obj_id}/ticket-types", $args);
        $request->enablePathParameters("obj_id");
        $request->enableQueryParameters("is_available_for_members", "is_available_for_external", "availability_status", "page", "page_size", "order");
        $request->enableBodyFields();
        return $this->submit($request, new Model\TicketTypePagination);
    }

    /**
     * @generated
     */
    public function createTicketType(int $obj_id, string $availability_status = null, string $available_from = null, string $available_to = null, string $cancel_to = null, string $confirmation_email_text = null, bool $confirmation_email_text_enabled = null, string $description = null, int $event_id = null, int $filter_id = null, int $id = null, string $modified = null, string $name, int $num_tickets = null, object $num_tickets_available = null, int $num_tickets_max = null, string $num_tickets_max_per = null, int $num_tickets_sold = null, float $price = null, bool $pricing_enabled = null, object $vat_category = null, int $vat_category_id, string $visibility_level = null, bool $waiting_list_enabled = null, float $participation_certificate_credits = null): void
    {
        $args = get_defined_vars(); // MUST be the first line in the method
        $request = new Request("POST", "/v30/events/{obj_id}/ticket-types", $args);
        $request->enablePathParameters("obj_id");
        $request->enableQueryParameters();
        $request->enableBodyFields("availability_status", "available_from", "available_to", "cancel_to", "confirmation_email_text", "confirmation_email_text_enabled", "description", "event_id", "filter_id", "id", "modified", "name", "num_tickets", "num_tickets_available", "num_tickets_max", "num_tickets_max_per", "num_tickets_sold", "price", "pricing_enabled", "vat_category", "vat_category_id", "visibility_level", "waiting_list_enabled", "participation_certificate_credits");
        $this->submit($request);
    }

    /**
     * @generated
     */
    public function retrieveTicketType(int $obj_id, int $event_id): Model\EventTicketType
    {
        $args = get_defined_vars(); // MUST be the first line in the method
        $request = new Request("GET", "/v30/events/{event_id}/ticket-types/{obj_id}", $args);
        $request->enablePathParameters("obj_id", "event_id");
        $request->enableQueryParameters();
        $request->enableBodyFields();
        return $this->submit($request, new Model\EventTicketType);
    }

    /**
     * @generated
     */
    public function deleteTicketType(int $obj_id, int $event_id): void
    {
        $args = get_defined_vars(); // MUST be the first line in the method
        $request = new Request("DELETE", "/v30/events/{event_id}/ticket-types/{obj_id}", $args);
        $request->enablePathParameters("obj_id", "event_id");
        $request->enableQueryParameters();
        $request->enableBodyFields();
        $this->submit($request);
    }

    /**
     * @generated
     */
    public function listGalleryAlbums(string $published = null, int $page = null, int $page_size = null, string $order = null): Page
    {
        $args = get_defined_vars(); // MUST be the first line in the method
        $request = new Request("GET", "/v30/galleries/albums", $args);
        $request->enablePathParameters();
        $request->enableQueryParameters("published", "page", "page_size", "order");
        $request->enableBodyFields();
        return $this->submit($request, new Model\GalleryAlbumPagination);
    }

    /**
     * @generated
     */
    public function retrieveGalleryAlbum(int $obj_id): Model\GalleryAlbum
    {
        $args = get_defined_vars(); // MUST be the first line in the method
        $request = new Request("GET", "/v30/galleries/albums/{obj_id}", $args);
        $request->enablePathParameters("obj_id");
        $request->enableQueryParameters();
        $request->enableBodyFields();
        return $this->submit($request, new Model\GalleryAlbum);
    }

    /**
     * @generated
     */
    public function listGalleryPhotos(int $album_id, int $page = null, int $page_size = null, string $order = null): Page
    {
        $args = get_defined_vars(); // MUST be the first line in the method
        $request = new Request("GET", "/v30/galleries/albums/{album_id}/photos", $args);
        $request->enablePathParameters("album_id");
        $request->enableQueryParameters("page", "page_size", "order");
        $request->enableBodyFields();
        return $this->submit($request, new Model\GalleryPhotoPagination);
    }

    /**
     * @generated
     */
    public function retrieveGalleryPhoto(int $album_id, int $obj_id): Model\GalleryPhoto
    {
        $args = get_defined_vars(); // MUST be the first line in the method
        $request = new Request("GET", "/v30/galleries/albums/{album_id}/photos/{obj_id}", $args);
        $request->enablePathParameters("album_id", "obj_id");
        $request->enableQueryParameters();
        $request->enableBodyFields();
        return $this->submit($request, new Model\GalleryPhoto);
    }

    /**
     * @generated
     */
    public function listGroupFoldersRecursive(int $page = null, int $page_size = null, string $order = null): Page
    {
        $args = get_defined_vars(); // MUST be the first line in the method
        $request = new Request("GET", "/v30/group-folders/recursive", $args);
        $request->enablePathParameters();
        $request->enableQueryParameters("page", "page_size", "order");
        $request->enableBodyFields();
        return $this->submit($request, new Model\GroupFolderListRecursivePagination);
    }

    /**
     * @generated
     */
    public function listGroupFolders(string $published = null, int $parent_id = null, int $page = null, int $page_size = null, string $order = null): Page
    {
        $args = get_defined_vars(); // MUST be the first line in the method
        $request = new Request("GET", "/v30/group-folders", $args);
        $request->enablePathParameters();
        $request->enableQueryParameters("published", "parent_id", "page", "page_size", "order");
        $request->enableBodyFields();
        return $this->submit($request, new Model\GroupFolderPagination);
    }

    /**
     * @generated
     */
    public function createGroupFolder(int $id = null, int $parent_id = null, string $name, string $slug, string $path = null, bool $published = null, string $order_type = null): void
    {
        $args = get_defined_vars(); // MUST be the first line in the method
        $request = new Request("POST", "/v30/group-folders", $args);
        $request->enablePathParameters();
        $request->enableQueryParameters();
        $request->enableBodyFields("id", "parent_id", "name", "slug", "path", "published", "order_type");
        $this->submit($request);
    }

    /**
     * @generated
     */
    public function retrieveGroupFolder(int $obj_id): Model\GroupFolder
    {
        $args = get_defined_vars(); // MUST be the first line in the method
        $request = new Request("GET", "/v30/group-folders/{obj_id}", $args);
        $request->enablePathParameters("obj_id");
        $request->enableQueryParameters();
        $request->enableBodyFields();
        return $this->submit($request, new Model\GroupFolder);
    }

    /**
     * @generated
     */
    public function updateGroupFolder(int $obj_id, int $id = null, int $parent_id = null, string $name, string $slug, string $path = null, bool $published = null, string $order_type = null): void
    {
        $args = get_defined_vars(); // MUST be the first line in the method
        $request = new Request("PUT", "/v30/group-folders/{obj_id}", $args);
        $request->enablePathParameters("obj_id");
        $request->enableQueryParameters();
        $request->enableBodyFields("id", "parent_id", "name", "slug", "path", "published", "order_type");
        $this->submit($request);
    }

    /**
     * @generated
     */
    public function deleteGroupFolder(int $obj_id): void
    {
        $args = get_defined_vars(); // MUST be the first line in the method
        $request = new Request("DELETE", "/v30/group-folders/{obj_id}", $args);
        $request->enablePathParameters("obj_id");
        $request->enableQueryParameters();
        $request->enableBodyFields();
        $this->submit($request);
    }

    /**
     * @generated
     */
    public function listGroups(string $published = null, int $folder_id = null, int $member_id = null, int $socie_app_id = null, int $page = null, int $page_size = null, string $order = null): Page
    {
        $args = get_defined_vars(); // MUST be the first line in the method
        $request = new Request("GET", "/v30/groups", $args);
        $request->enablePathParameters();
        $request->enableQueryParameters("published", "folder_id", "member_id", "socie_app_id", "page", "page_size", "order");
        $request->enableBodyFields();
        return $this->submit($request, new Model\GroupPagination);
    }

    /**
     * @generated
     */
    public function retrieveGroup(int $obj_id): Model\GroupWithMemberships
    {
        $args = get_defined_vars(); // MUST be the first line in the method
        $request = new Request("GET", "/v30/groups/{obj_id}", $args);
        $request->enablePathParameters("obj_id");
        $request->enableQueryParameters();
        $request->enableBodyFields();
        return $this->submit($request, new Model\GroupWithMemberships);
    }

    /**
     * @generated
     */
    public function updateGroup(int $obj_id, int $id, int $folder_id = null, object $folder = null, string $name = null, object $address = null, object $postal_address = null, string $description = null, string $description_short = null, string $email = null, string $url = null, object $logo = null, string $slug, string $path = null, bool $published = null, string $start, string $end = null, string $memo = null, array $memberships = null): void
    {
        $args = get_defined_vars(); // MUST be the first line in the method
        $request = new Request("PUT", "/v30/groups/{obj_id}", $args);
        $request->enablePathParameters("obj_id");
        $request->enableQueryParameters();
        $request->enableBodyFields("id", "folder_id", "folder", "name", "address", "postal_address", "description", "description_short", "email", "url", "logo", "slug", "path", "published", "start", "end", "memo", "memberships");
        $this->submit($request);
    }

    /**
     * @generated
     */
    public function deleteGroup(int $obj_id): void
    {
        $args = get_defined_vars(); // MUST be the first line in the method
        $request = new Request("DELETE", "/v30/groups/{obj_id}", $args);
        $request->enablePathParameters("obj_id");
        $request->enableQueryParameters();
        $request->enableBodyFields();
        $this->submit($request);
    }

    /**
     * @generated
     */
    public function listGroupMemberships(int $group_id = null, int $member_id = null, int $page = null, int $page_size = null, string $order = null): Page
    {
        $args = get_defined_vars(); // MUST be the first line in the method
        $request = new Request("GET", "/v30/groups/memberships", $args);
        $request->enablePathParameters();
        $request->enableQueryParameters("group_id", "member_id", "page", "page_size", "order");
        $request->enableBodyFields();
        return $this->submit($request, new Model\GroupMembershipPagination);
    }

    /**
     * @generated
     */
    public function createGroupMembership(int $id = null, int $member_id, string $start, string $end = null, string $function = null, bool $may_edit_profile = null, bool $may_manage_memberships = null, bool $may_manage_storage_objects = null, bool $is_self_enroll = null, string $order_type = null, int $order = null, int $group_id, object $group = null): void
    {
        $args = get_defined_vars(); // MUST be the first line in the method
        $request = new Request("POST", "/v30/groups/memberships", $args);
        $request->enablePathParameters();
        $request->enableQueryParameters();
        $request->enableBodyFields("id", "member_id", "start", "end", "function", "may_edit_profile", "may_manage_memberships", "may_manage_storage_objects", "is_self_enroll", "order_type", "order", "group_id", "group");
        $this->submit($request);
    }

    /**
     * @generated
     */
    public function retrieveGroupMembership(int $obj_id): Model\GroupMembership
    {
        $args = get_defined_vars(); // MUST be the first line in the method
        $request = new Request("GET", "/v30/groups/memberships/{obj_id}", $args);
        $request->enablePathParameters("obj_id");
        $request->enableQueryParameters();
        $request->enableBodyFields();
        return $this->submit($request, new Model\GroupMembership);
    }

    /**
     * @generated
     */
    public function updateGroupMembership(int $obj_id, int $id = null, int $member_id, string $start, string $end = null, string $function = null, bool $may_edit_profile = null, bool $may_manage_memberships = null, bool $may_manage_storage_objects = null, bool $is_self_enroll = null, string $order_type = null, int $order = null, int $group_id, object $group = null): void
    {
        $args = get_defined_vars(); // MUST be the first line in the method
        $request = new Request("PUT", "/v30/groups/memberships/{obj_id}", $args);
        $request->enablePathParameters("obj_id");
        $request->enableQueryParameters();
        $request->enableBodyFields("id", "member_id", "start", "end", "function", "may_edit_profile", "may_manage_memberships", "may_manage_storage_objects", "is_self_enroll", "order_type", "order", "group_id", "group");
        $this->submit($request);
    }

    /**
     * @generated
     */
    public function deleteGroupMembership(int $obj_id): void
    {
        $args = get_defined_vars(); // MUST be the first line in the method
        $request = new Request("DELETE", "/v30/groups/memberships/{obj_id}", $args);
        $request->enablePathParameters("obj_id");
        $request->enableQueryParameters();
        $request->enableBodyFields();
        $this->submit($request);
    }

    /**
     * @generated
     */
    public function listTasks(int $author_id = null, int $assignee_id = null, array $subject_type = null, string $is_completed = null, int $page = null, int $page_size = null, string $order = null): Page
    {
        $args = get_defined_vars(); // MUST be the first line in the method
        $request = new Request("GET", "/v30/tasks", $args);
        $request->enablePathParameters();
        $request->enableQueryParameters("author_id", "assignee_id", "subject_type", "is_completed", "page", "page_size", "order");
        $request->enableBodyFields();
        return $this->submit($request, new Model\TaskPagination);
    }

    /**
     * @generated
     */
    public function updateTask(int $obj_id, int $id = null, string $type, string $text = null, string $subject_type, int $subject_id, int $author_id = null, string $created = null, string $modified = null, object $author = null, object $subject = null, string $assignee_type = null, int $assignee_id = null, object $assignee = null, bool $is_completed = null, string $completed = null, int $completed_by_id = null, object $completed_by = null): void
    {
        $args = get_defined_vars(); // MUST be the first line in the method
        $request = new Request("PUT", "/v30/tasks/{obj_id}", $args);
        $request->enablePathParameters("obj_id");
        $request->enableQueryParameters();
        $request->enableBodyFields("id", "type", "text", "subject_type", "subject_id", "author_id", "created", "modified", "author", "subject", "assignee_type", "assignee_id", "assignee", "is_completed", "completed", "completed_by_id", "completed_by");
        $this->submit($request);
    }

    /**
     * @generated
     */
    public function listMemberStatuses(string $archived = null, string $hidden = null, string $deceased = null, int $page = null, int $page_size = null, string $order = null): Page
    {
        $args = get_defined_vars(); // MUST be the first line in the method
        $request = new Request("GET", "/v30/member-statuses", $args);
        $request->enablePathParameters();
        $request->enableQueryParameters("archived", "hidden", "deceased", "page", "page_size", "order");
        $request->enableBodyFields();
        return $this->submit($request, new Model\MemberStatusListPagination);
    }

    /**
     * @generated
     */
    public function retrieveMemberStatus(int $obj_id): Model\MemberStatusWithFieldSettings
    {
        $args = get_defined_vars(); // MUST be the first line in the method
        $request = new Request("GET", "/v30/member-statuses/{obj_id}", $args);
        $request->enablePathParameters("obj_id");
        $request->enableQueryParameters();
        $request->enableBodyFields();
        return $this->submit($request, new Model\MemberStatusWithFieldSettings);
    }

    /**
     * @generated
     */
    public function updateMemberStatus(int $obj_id, int $id = null, string $name, string $description = null, bool $archived = null, bool $hidden = null, bool $deceased = null, int $order = null, bool $is_available_for_online_sign_up = null, int $registration_product_offer_id = null, object $registration_product_offer = null, int $membership_fee_product_offer_id = null, object $membership_fee_product_offer = null, array $websites = null, array $websites_member_list = null): void
    {
        $args = get_defined_vars(); // MUST be the first line in the method
        $request = new Request("PUT", "/v30/member-statuses/{obj_id}", $args);
        $request->enablePathParameters("obj_id");
        $request->enableQueryParameters();
        $request->enableBodyFields("id", "name", "description", "archived", "hidden", "deceased", "order", "is_available_for_online_sign_up", "registration_product_offer_id", "registration_product_offer", "membership_fee_product_offer_id", "membership_fee_product_offer", "websites", "websites_member_list");
        $this->submit($request);
    }

    /**
     * @generated
     */
    public function deleteMemberStatus(int $obj_id): void
    {
        $args = get_defined_vars(); // MUST be the first line in the method
        $request = new Request("DELETE", "/v30/member-statuses/{obj_id}", $args);
        $request->enablePathParameters("obj_id");
        $request->enableQueryParameters();
        $request->enableBodyFields();
        $this->submit($request);
    }

    /**
     * @generated
     */
    public function listMemberLogEntries(int $member_id, int $author_id = null, array $type = null, int $page = null, int $page_size = null, string $order = null): Page
    {
        $args = get_defined_vars(); // MUST be the first line in the method
        $request = new Request("GET", "/v30/members/{member_id}/logs", $args);
        $request->enablePathParameters("member_id");
        $request->enableQueryParameters("author_id", "type", "page", "page_size", "order");
        $request->enableBodyFields();
        return $this->submit($request, new Model\LogEntryPagination);
    }

    /**
     * @generated
     */
    public function retrieveMemberLogEntry(int $log_entry_id, int $member_id): Model\LogEntry
    {
        $args = get_defined_vars(); // MUST be the first line in the method
        $request = new Request("GET", "/v30/members/{member_id}/logs/{log_entry_id}", $args);
        $request->enablePathParameters("log_entry_id", "member_id");
        $request->enableQueryParameters();
        $request->enableBodyFields();
        return $this->submit($request, new Model\LogEntry);
    }

    /**
     * @generated
     */
    public function deleteMemberLogEntry(int $log_entry_id, int $member_id): void
    {
        $args = get_defined_vars(); // MUST be the first line in the method
        $request = new Request("DELETE", "/v30/members/{member_id}/logs/{log_entry_id}", $args);
        $request->enablePathParameters("log_entry_id", "member_id");
        $request->enableQueryParameters();
        $request->enableBodyFields();
        $this->submit($request);
    }

    /**
     * @generated
     */
    public function listMembers(int $status_id = null, int $socie_app_id = null, int $page = null, int $page_size = null, string $order = null, array $context = null): Page
    {
        $args = get_defined_vars(); // MUST be the first line in the method
        $request = new Request("GET", "/v30/members", $args);
        $request->enablePathParameters();
        $request->enableQueryParameters("status_id", "socie_app_id", "page", "page_size", "order", "context");
        $request->enableBodyFields();
        return $this->submit($request, new Model\MemberPagination);
    }

    /**
     * @generated
     */
    public function createMember(array $context = null, int $status_id, string $member_from = null, string $member_to = null, int $id, string $username = null, object $status = null, array $statuses = null, object $gender = null, string $prefix = null, string $initials = null, string $nickname = null, string $given_name = null, string $first_name = null, string $primary_last_name_main, string $primary_last_name_prefix = null, string $primary_last_name = null, string $secondary_last_name_main = null, string $secondary_last_name_prefix = null, string $secondary_last_name = null, string $last_name_display = null, string $last_name = null, string $search_name = null, string $suffix = null, string $date_of_birth = null, string $email = null, object $phone_mobile = null, object $phone_home = null, object $address = null, int $profile_picture_id = null, object $profile_picture = null, int $formal_picture_id = null, object $formal_picture = null, bool $deleted = null, bool $receive_sms = null, bool $receive_mailings = null, bool $show_almanac = null, bool $show_almanac_addresses = null, bool $show_almanac_phonenumbers = null, bool $show_almanac_email = null, bool $show_almanac_date_of_birth = null, bool $show_almanac_custom_fields = null, string $modified = null, string $memo = null, object $bank_account = null): void
    {
        $args = get_defined_vars(); // MUST be the first line in the method
        $request = new Request("POST", "/v30/members", $args);
        $request->enablePathParameters();
        $request->enableQueryParameters("context");
        $request->enableBodyFields("status_id", "member_from", "member_to", "id", "username", "status", "statuses", "gender", "prefix", "initials", "nickname", "given_name", "first_name", "primary_last_name_main", "primary_last_name_prefix", "primary_last_name", "secondary_last_name_main", "secondary_last_name_prefix", "secondary_last_name", "last_name_display", "last_name", "search_name", "suffix", "date_of_birth", "email", "phone_mobile", "phone_home", "address", "profile_picture_id", "profile_picture", "formal_picture_id", "formal_picture", "deleted", "receive_sms", "receive_mailings", "show_almanac", "show_almanac_addresses", "show_almanac_phonenumbers", "show_almanac_email", "show_almanac_date_of_birth", "show_almanac_custom_fields", "modified", "memo", "bank_account");
        $this->submit($request);
    }

    /**
     * @generated
     */
    public function retrieveMember(int $obj_id, array $context = null): Model\MemberWithCustomFields
    {
        $args = get_defined_vars(); // MUST be the first line in the method
        $request = new Request("GET", "/v30/members/{obj_id}", $args);
        $request->enablePathParameters("obj_id");
        $request->enableQueryParameters("context");
        $request->enableBodyFields();
        return $this->submit($request, new Model\MemberWithCustomFields);
    }

    /**
     * @generated
     */
    public function updateMember(int $obj_id, array $context = null, int $id, string $username = null, object $status = null, array $statuses = null, object $gender = null, string $prefix = null, string $initials = null, string $nickname = null, string $given_name = null, string $first_name = null, string $primary_last_name_main = null, string $primary_last_name_prefix = null, string $primary_last_name = null, string $secondary_last_name_main = null, string $secondary_last_name_prefix = null, string $secondary_last_name = null, string $last_name_display = null, string $last_name = null, string $search_name = null, string $suffix = null, string $date_of_birth = null, string $email = null, object $phone_mobile = null, object $phone_home = null, object $address = null, int $profile_picture_id = null, object $profile_picture = null, int $formal_picture_id = null, object $formal_picture = null, bool $deleted = null, bool $receive_sms = null, bool $receive_mailings = null, bool $show_almanac = null, bool $show_almanac_addresses = null, bool $show_almanac_phonenumbers = null, bool $show_almanac_email = null, bool $show_almanac_date_of_birth = null, bool $show_almanac_custom_fields = null, string $modified = null, string $memo = null, object $bank_account = null, object $custom_fields = null): void
    {
        $args = get_defined_vars(); // MUST be the first line in the method
        $request = new Request("PUT", "/v30/members/{obj_id}", $args);
        $request->enablePathParameters("obj_id");
        $request->enableQueryParameters();
        $request->enableBodyFields("id", "username", "status", "statuses", "gender", "prefix", "initials", "nickname", "given_name", "first_name", "primary_last_name_main", "primary_last_name_prefix", "primary_last_name", "secondary_last_name_main", "secondary_last_name_prefix", "secondary_last_name", "last_name_display", "last_name", "search_name", "suffix", "date_of_birth", "email", "phone_mobile", "phone_home", "address", "profile_picture_id", "profile_picture", "formal_picture_id", "formal_picture", "deleted", "receive_sms", "receive_mailings", "show_almanac", "show_almanac_addresses", "show_almanac_phonenumbers", "show_almanac_email", "show_almanac_date_of_birth", "show_almanac_custom_fields", "modified", "memo", "bank_account", "custom_fields");
        $this->submit($request);
    }

    /**
     * @generated
     */
    public function deleteMember(int $obj_id): void
    {
        $args = get_defined_vars(); // MUST be the first line in the method
        $request = new Request("DELETE", "/v30/members/{obj_id}", $args);
        $request->enablePathParameters("obj_id");
        $request->enableQueryParameters();
        $request->enableBodyFields();
        $this->submit($request);
    }

    /**
     * @generated
     */
    public function listMembershipStatuses(int $obj_id, int $page = null, int $page_size = null, string $order = null): Page
    {
        $args = get_defined_vars(); // MUST be the first line in the method
        $request = new Request("GET", "/v30/members/{obj_id}/statuses", $args);
        $request->enablePathParameters("obj_id");
        $request->enableQueryParameters("page", "page_size", "order");
        $request->enableBodyFields();
        return $this->submit($request, new Model\MembershipStatusPagination);
    }

    /**
     * @generated
     */
    public function createMembershipStatus(int $obj_id, int $id = null, string $name = null, int $status_id, string $member_from = null, string $member_to = null, bool $archived = null, bool $deceased = null): void
    {
        $args = get_defined_vars(); // MUST be the first line in the method
        $request = new Request("POST", "/v30/members/{obj_id}/statuses", $args);
        $request->enablePathParameters("obj_id");
        $request->enableQueryParameters();
        $request->enableBodyFields("id", "name", "status_id", "member_from", "member_to", "archived", "deceased");
        $this->submit($request);
    }

    /**
     * @generated
     */
    public function retrieveMembershipStatus(int $obj_id, int $membership_status_id): Model\MembershipStatus
    {
        $args = get_defined_vars(); // MUST be the first line in the method
        $request = new Request("GET", "/v30/members/{obj_id}/statuses/{membership_status_id}", $args);
        $request->enablePathParameters("obj_id", "membership_status_id");
        $request->enableQueryParameters();
        $request->enableBodyFields();
        return $this->submit($request, new Model\MembershipStatus);
    }

    /**
     * @generated
     */
    public function updateMembershipStatus(int $obj_id, int $membership_status_id, int $id = null, string $name = null, int $status_id, string $member_from = null, string $member_to = null, bool $archived = null, bool $deceased = null): void
    {
        $args = get_defined_vars(); // MUST be the first line in the method
        $request = new Request("PUT", "/v30/members/{obj_id}/statuses/{membership_status_id}", $args);
        $request->enablePathParameters("obj_id", "membership_status_id");
        $request->enableQueryParameters();
        $request->enableBodyFields("id", "name", "status_id", "member_from", "member_to", "archived", "deceased");
        $this->submit($request);
    }

    /**
     * @generated
     */
    public function deleteMembershipStatus(int $obj_id, int $membership_status_id): void
    {
        $args = get_defined_vars(); // MUST be the first line in the method
        $request = new Request("DELETE", "/v30/members/{obj_id}/statuses/{membership_status_id}", $args);
        $request->enablePathParameters("obj_id", "membership_status_id");
        $request->enableQueryParameters();
        $request->enableBodyFields();
        $this->submit($request);
    }

    /**
     * @generated
     */
    public function searchMembers(string $term, int $page = null, int $page_size = null, string $order = null): Page
    {
        $args = get_defined_vars(); // MUST be the first line in the method
        $request = new Request("GET", "/v30/members/search", $args);
        $request->enablePathParameters();
        $request->enableQueryParameters("term", "page", "page_size", "order");
        $request->enableBodyFields();
        return $this->submit($request, new Model\ElasticMemberPagination);
    }

    /**
     * @generated
     */
    public function listNews(string $period_filter = null, string $actual = null, string $comments_open = null, array $visibility = null, int $page = null, int $page_size = null, string $order = null): Page
    {
        $args = get_defined_vars(); // MUST be the first line in the method
        $request = new Request("GET", "/v30/news", $args);
        $request->enablePathParameters();
        $request->enableQueryParameters("period_filter", "actual", "comments_open", "visibility", "page", "page_size", "order");
        $request->enableBodyFields();
        return $this->submit($request, new Model\NewsPagination);
    }

    /**
     * @generated
     */
    public function createNews(int $id = null, string $title, object $content = null, string $published_from, string $actual_to, bool $is_published = null, bool $is_actual = null, array $media = null, array $comments = null, string $memo = null, array $websites = null): void
    {
        $args = get_defined_vars(); // MUST be the first line in the method
        $request = new Request("POST", "/v30/news", $args);
        $request->enablePathParameters();
        $request->enableQueryParameters();
        $request->enableBodyFields("id", "title", "content", "published_from", "actual_to", "is_published", "is_actual", "media", "comments", "memo", "websites");
        $this->submit($request);
    }

    /**
     * @generated
     */
    public function retrieveNews(int $obj_id): Model\News
    {
        $args = get_defined_vars(); // MUST be the first line in the method
        $request = new Request("GET", "/v30/news/{obj_id}", $args);
        $request->enablePathParameters("obj_id");
        $request->enableQueryParameters();
        $request->enableBodyFields();
        return $this->submit($request, new Model\News);
    }

    /**
     * @generated
     */
    public function updateNews(int $obj_id, int $id = null, string $title, object $content = null, string $published_from, string $actual_to, bool $is_published = null, bool $is_actual = null, array $media = null, array $comments = null, string $memo = null, array $websites = null): void
    {
        $args = get_defined_vars(); // MUST be the first line in the method
        $request = new Request("PUT", "/v30/news/{obj_id}", $args);
        $request->enablePathParameters("obj_id");
        $request->enableQueryParameters();
        $request->enableBodyFields("id", "title", "content", "published_from", "actual_to", "is_published", "is_actual", "media", "comments", "memo", "websites");
        $this->submit($request);
    }

    /**
     * @generated
     */
    public function deleteNews(int $obj_id): void
    {
        $args = get_defined_vars(); // MUST be the first line in the method
        $request = new Request("DELETE", "/v30/news/{obj_id}", $args);
        $request->enablePathParameters("obj_id");
        $request->enableQueryParameters();
        $request->enableBodyFields();
        $this->submit($request);
    }

    /**
     * @generated
     */
    public function listNotifications(int $page = null, int $page_size = null, string $order = null): Page
    {
        $args = get_defined_vars(); // MUST be the first line in the method
        $request = new Request("GET", "/v30/notifications", $args);
        $request->enablePathParameters();
        $request->enableQueryParameters("page", "page_size", "order");
        $request->enableBodyFields();
        return $this->submit($request, new Model\NotificationPagination);
    }

    /**
     * @generated
     */
    public function listOrganisationCategories(int $page = null, int $page_size = null, string $order = null): Page
    {
        $args = get_defined_vars(); // MUST be the first line in the method
        $request = new Request("GET", "/v30/organisations/categories", $args);
        $request->enablePathParameters();
        $request->enableQueryParameters("page", "page_size", "order");
        $request->enableBodyFields();
        return $this->submit($request, new Model\OrganisationCategoryPagination);
    }

    /**
     * @generated
     */
    public function createOrganisationCategory(int $id = null, string $name, string $color = null, object $slug = null, bool $published = null, object $visibility = null, array $websites = null, string $order_type = null): void
    {
        $args = get_defined_vars(); // MUST be the first line in the method
        $request = new Request("POST", "/v30/organisations/categories", $args);
        $request->enablePathParameters();
        $request->enableQueryParameters();
        $request->enableBodyFields("id", "name", "color", "slug", "published", "visibility", "websites", "order_type");
        $this->submit($request);
    }

    /**
     * @generated
     */
    public function retrieveOrganisationCategory(int $obj_id): Model\OrganisationCategory
    {
        $args = get_defined_vars(); // MUST be the first line in the method
        $request = new Request("GET", "/v30/organisations/categories/{obj_id}", $args);
        $request->enablePathParameters("obj_id");
        $request->enableQueryParameters();
        $request->enableBodyFields();
        return $this->submit($request, new Model\OrganisationCategory);
    }

    /**
     * @generated
     */
    public function updateOrganisationCategory(int $obj_id, int $id = null, string $name, string $color = null, object $slug = null, bool $published = null, object $visibility = null, array $websites = null, string $order_type = null): void
    {
        $args = get_defined_vars(); // MUST be the first line in the method
        $request = new Request("PUT", "/v30/organisations/categories/{obj_id}", $args);
        $request->enablePathParameters("obj_id");
        $request->enableQueryParameters();
        $request->enableBodyFields("id", "name", "color", "slug", "published", "visibility", "websites", "order_type");
        $this->submit($request);
    }

    /**
     * @generated
     */
    public function deleteOrganisationCategory(int $obj_id): void
    {
        $args = get_defined_vars(); // MUST be the first line in the method
        $request = new Request("DELETE", "/v30/organisations/categories/{obj_id}", $args);
        $request->enablePathParameters("obj_id");
        $request->enableQueryParameters();
        $request->enableBodyFields();
        $this->submit($request);
    }

    /**
     * @generated
     */
    public function listOrganisations(int $category_id = null, array $sbi_code = null, array $legal_form = null, int $member_id = null, int $page = null, int $page_size = null, string $order = null): Page
    {
        $args = get_defined_vars(); // MUST be the first line in the method
        $request = new Request("GET", "/v30/organisations", $args);
        $request->enablePathParameters();
        $request->enableQueryParameters("category_id", "sbi_code", "legal_form", "member_id", "page", "page_size", "order");
        $request->enableBodyFields();
        return $this->submit($request, new Model\OrganisationPagination);
    }

    /**
     * @generated
     */
    public function createOrganisation(int $id, string $name = null, string $slug, int $category_id, object $category = null, object $address = null, object $postal_address = null, string $description = null, string $description_short = null, string $email = null, string $url = null, object $logo = null, string $memo = null, string $invoice_reference = null, string $invoice_addressee_attention = null, string $invoice_address_field, string $invoice_email = null): void
    {
        $args = get_defined_vars(); // MUST be the first line in the method
        $request = new Request("POST", "/v30/organisations", $args);
        $request->enablePathParameters();
        $request->enableQueryParameters();
        $request->enableBodyFields("id", "name", "slug", "category_id", "category", "address", "postal_address", "description", "description_short", "email", "url", "logo", "memo", "invoice_reference", "invoice_addressee_attention", "invoice_address_field", "invoice_email");
        $this->submit($request);
    }

    /**
     * @generated
     */
    public function retrieveOrganisation(int $obj_id): Model\Organisation
    {
        $args = get_defined_vars(); // MUST be the first line in the method
        $request = new Request("GET", "/v30/organisations/{obj_id}", $args);
        $request->enablePathParameters("obj_id");
        $request->enableQueryParameters();
        $request->enableBodyFields();
        return $this->submit($request, new Model\Organisation);
    }

    /**
     * @generated
     */
    public function updateOrganisation(int $obj_id, int $id, string $name = null, string $slug, int $category_id, object $category = null, object $address = null, object $postal_address = null, string $description = null, string $description_short = null, string $email = null, string $url = null, object $logo = null, string $memo = null, string $invoice_reference = null, string $invoice_addressee_attention = null, string $invoice_address_field, string $invoice_email = null): void
    {
        $args = get_defined_vars(); // MUST be the first line in the method
        $request = new Request("PUT", "/v30/organisations/{obj_id}", $args);
        $request->enablePathParameters("obj_id");
        $request->enableQueryParameters();
        $request->enableBodyFields("id", "name", "slug", "category_id", "category", "address", "postal_address", "description", "description_short", "email", "url", "logo", "memo", "invoice_reference", "invoice_addressee_attention", "invoice_address_field", "invoice_email");
        $this->submit($request);
    }

    /**
     * @generated
     */
    public function deleteOrganisation(int $obj_id): void
    {
        $args = get_defined_vars(); // MUST be the first line in the method
        $request = new Request("DELETE", "/v30/organisations/{obj_id}", $args);
        $request->enablePathParameters("obj_id");
        $request->enableQueryParameters();
        $request->enableBodyFields();
        $this->submit($request);
    }

    /**
     * @generated
     */
    public function listOrganisationMemberships(int $organisation_id = null, int $member_id = null, int $page = null, int $page_size = null, string $order = null): Page
    {
        $args = get_defined_vars(); // MUST be the first line in the method
        $request = new Request("GET", "/v30/organisations/memberships", $args);
        $request->enablePathParameters();
        $request->enableQueryParameters("organisation_id", "member_id", "page", "page_size", "order");
        $request->enableBodyFields();
        return $this->submit($request, new Model\OrganisationMembershipPagination);
    }

    /**
     * @generated
     */
    public function createOrganisationMembership(int $id = null, int $member_id, string $start, string $end = null, string $function = null, bool $may_edit_profile = null, bool $may_manage_memberships = null, bool $may_manage_storage_objects = null, bool $is_self_enroll = null, string $order_type = null, int $order = null, int $organisation_id, object $organisation = null): void
    {
        $args = get_defined_vars(); // MUST be the first line in the method
        $request = new Request("POST", "/v30/organisations/memberships", $args);
        $request->enablePathParameters();
        $request->enableQueryParameters();
        $request->enableBodyFields("id", "member_id", "start", "end", "function", "may_edit_profile", "may_manage_memberships", "may_manage_storage_objects", "is_self_enroll", "order_type", "order", "organisation_id", "organisation");
        $this->submit($request);
    }

    /**
     * @generated
     */
    public function retrieveOrganisationMembership(int $obj_id): Model\OrganisationMembership
    {
        $args = get_defined_vars(); // MUST be the first line in the method
        $request = new Request("GET", "/v30/organisations/memberships/{obj_id}", $args);
        $request->enablePathParameters("obj_id");
        $request->enableQueryParameters();
        $request->enableBodyFields();
        return $this->submit($request, new Model\OrganisationMembership);
    }

    /**
     * @generated
     */
    public function updateOrganisationMembership(int $obj_id, int $id = null, int $member_id, string $start, string $end = null, string $function = null, bool $may_edit_profile = null, bool $may_manage_memberships = null, bool $may_manage_storage_objects = null, bool $is_self_enroll = null, string $order_type = null, int $order = null, int $organisation_id, object $organisation = null): void
    {
        $args = get_defined_vars(); // MUST be the first line in the method
        $request = new Request("PUT", "/v30/organisations/memberships/{obj_id}", $args);
        $request->enablePathParameters("obj_id");
        $request->enableQueryParameters();
        $request->enableBodyFields("id", "member_id", "start", "end", "function", "may_edit_profile", "may_manage_memberships", "may_manage_storage_objects", "is_self_enroll", "order_type", "order", "organisation_id", "organisation");
        $this->submit($request);
    }

    /**
     * @generated
     */
    public function deleteOrganisationMembership(int $obj_id): void
    {
        $args = get_defined_vars(); // MUST be the first line in the method
        $request = new Request("DELETE", "/v30/organisations/memberships/{obj_id}", $args);
        $request->enablePathParameters("obj_id");
        $request->enableQueryParameters();
        $request->enableBodyFields();
        $this->submit($request);
    }

    /**
     * @generated
     */
    public function returnAJSONFileWithTheDefaultPricingStrategyForAllOurPlans(int $members = null, string $plan = null): Model\PricingResponse
    {
        $args = get_defined_vars(); // MUST be the first line in the method
        $request = new Request("GET", "/v30/pricing", $args);
        $request->enablePathParameters();
        $request->enableQueryParameters("members", "plan");
        $request->enableBodyFields();
        return $this->submit($request, new Model\PricingResponse);
    }

    /**
     * @generated
     */
    public function listProductFoldersRecursive(string $published = null, int $parent_id = null, int $page = null, int $page_size = null, string $order = null): Page
    {
        $args = get_defined_vars(); // MUST be the first line in the method
        $request = new Request("GET", "/v30/product-folders/recursive", $args);
        $request->enablePathParameters();
        $request->enableQueryParameters("published", "parent_id", "page", "page_size", "order");
        $request->enableBodyFields();
        return $this->submit($request, new Model\ProductFolderListRecursivePagination);
    }

    /**
     * @generated
     */
    public function listProductFolders(string $published = null, int $parent_id = null, int $page = null, int $page_size = null, string $order = null): Page
    {
        $args = get_defined_vars(); // MUST be the first line in the method
        $request = new Request("GET", "/v30/product-folders", $args);
        $request->enablePathParameters();
        $request->enableQueryParameters("published", "parent_id", "page", "page_size", "order");
        $request->enableBodyFields();
        return $this->submit($request, new Model\ProductFolderPagination);
    }

    /**
     * @generated
     */
    public function createProductFolder(int $id = null, int $parent_id = null, string $name, string $slug, bool $published = null, string $path = null): void
    {
        $args = get_defined_vars(); // MUST be the first line in the method
        $request = new Request("POST", "/v30/product-folders", $args);
        $request->enablePathParameters();
        $request->enableQueryParameters();
        $request->enableBodyFields("id", "parent_id", "name", "slug", "published", "path");
        $this->submit($request);
    }

    /**
     * @generated
     */
    public function retrieveProductFolder(int $obj_id): Model\ProductFolder
    {
        $args = get_defined_vars(); // MUST be the first line in the method
        $request = new Request("GET", "/v30/product-folders/{obj_id}", $args);
        $request->enablePathParameters("obj_id");
        $request->enableQueryParameters();
        $request->enableBodyFields();
        return $this->submit($request, new Model\ProductFolder);
    }

    /**
     * @generated
     */
    public function updateProductFolder(int $obj_id, int $id = null, int $parent_id = null, string $name, string $slug, bool $published = null, string $path = null): void
    {
        $args = get_defined_vars(); // MUST be the first line in the method
        $request = new Request("PUT", "/v30/product-folders/{obj_id}", $args);
        $request->enablePathParameters("obj_id");
        $request->enableQueryParameters();
        $request->enableBodyFields("id", "parent_id", "name", "slug", "published", "path");
        $this->submit($request);
    }

    /**
     * @generated
     */
    public function deleteProductFolder(int $obj_id): void
    {
        $args = get_defined_vars(); // MUST be the first line in the method
        $request = new Request("DELETE", "/v30/product-folders/{obj_id}", $args);
        $request->enablePathParameters("obj_id");
        $request->enableQueryParameters();
        $request->enableBodyFields();
        $this->submit($request);
    }

    /**
     * @generated
     */
    public function listProducts(string $published = null, string $status = null, int $folder_id = null, int $page = null, int $page_size = null, string $order = null): Page
    {
        $args = get_defined_vars(); // MUST be the first line in the method
        $request = new Request("GET", "/v30/products", $args);
        $request->enablePathParameters();
        $request->enableQueryParameters("published", "status", "folder_id", "page", "page_size", "order");
        $request->enableBodyFields();
        return $this->submit($request, new Model\ProductPagination);
    }

    /**
     * @generated
     */
    public function createProduct(int $id = null, int $product_offer_id = null, object $folder = null, string $name = null, string $description = null, array $media = null, bool $published = null, float $price = null, object $vat_category = null, float $vat_percentage = null, string $type = null, bool $is_archived = null, string $created = null, string $modified = null, string $memo = null): void
    {
        $args = get_defined_vars(); // MUST be the first line in the method
        $request = new Request("POST", "/v30/products", $args);
        $request->enablePathParameters();
        $request->enableQueryParameters();
        $request->enableBodyFields("id", "product_offer_id", "folder", "name", "description", "media", "published", "price", "vat_category", "vat_percentage", "type", "is_archived", "created", "modified", "memo");
        $this->submit($request);
    }

    /**
     * @generated
     */
    public function retrieveProduct(int $obj_id): Model\Product
    {
        $args = get_defined_vars(); // MUST be the first line in the method
        $request = new Request("GET", "/v30/products/{obj_id}", $args);
        $request->enablePathParameters("obj_id");
        $request->enableQueryParameters();
        $request->enableBodyFields();
        return $this->submit($request, new Model\Product);
    }

    /**
     * @generated
     */
    public function updateProduct(int $obj_id, int $id = null, int $product_offer_id = null, object $folder = null, string $name = null, string $description = null, array $media = null, bool $published = null, float $price = null, object $vat_category = null, float $vat_percentage = null, string $type = null, bool $is_archived = null, string $created = null, string $modified = null, string $memo = null): void
    {
        $args = get_defined_vars(); // MUST be the first line in the method
        $request = new Request("PUT", "/v30/products/{obj_id}", $args);
        $request->enablePathParameters("obj_id");
        $request->enableQueryParameters();
        $request->enableBodyFields("id", "product_offer_id", "folder", "name", "description", "media", "published", "price", "vat_category", "vat_percentage", "type", "is_archived", "created", "modified", "memo");
        $this->submit($request);
    }

    /**
     * @generated
     */
    public function deleteProduct(int $obj_id): void
    {
        $args = get_defined_vars(); // MUST be the first line in the method
        $request = new Request("DELETE", "/v30/products/{obj_id}", $args);
        $request->enablePathParameters("obj_id");
        $request->enableQueryParameters();
        $request->enableBodyFields();
        $this->submit($request);
    }

    /**
     * @generated
     */
    public function listSaleInvoiceLogEntries(int $obj_id, int $author_id = null, array $type = null, int $page = null, int $page_size = null, string $order = null): Page
    {
        $args = get_defined_vars(); // MUST be the first line in the method
        $request = new Request("GET", "/v30/sale-invoices/{obj_id}/logs", $args);
        $request->enablePathParameters("obj_id");
        $request->enableQueryParameters("author_id", "type", "page", "page_size", "order");
        $request->enableBodyFields();
        return $this->submit($request, new Model\LogEntryPagination);
    }

    /**
     * @generated
     */
    public function retrieveSaleInvoiceLogEntry(int $log_entry_id, int $obj_id): Model\LogEntry
    {
        $args = get_defined_vars(); // MUST be the first line in the method
        $request = new Request("GET", "/v30/sale-invoices/{obj_id}/logs/{log_entry_id}", $args);
        $request->enablePathParameters("log_entry_id", "obj_id");
        $request->enableQueryParameters();
        $request->enableBodyFields();
        return $this->submit($request, new Model\LogEntry);
    }

    /**
     * @generated
     */
    public function deleteSaleInvoiceLogEntry(int $log_entry_id, int $obj_id): void
    {
        $args = get_defined_vars(); // MUST be the first line in the method
        $request = new Request("DELETE", "/v30/sale-invoices/{obj_id}/logs/{log_entry_id}", $args);
        $request->enablePathParameters("log_entry_id", "obj_id");
        $request->enableQueryParameters();
        $request->enableBodyFields();
        $this->submit($request);
    }

    /**
     * @generated
     */
    public function listSaleInvoices(int $entity_id = null, string $period_filter = null, array $invoice_status = null, array $invoice_num_reminders_send = null, array $invoice_type = null, array $category = null, int $product_offer_id = null, int $member_id = null, int $collection_id = null, string $use_direct_debit = null, string $contribution_start = null, string $contribution_end = null, int $page = null, int $page_size = null, string $order = null): Page
    {
        $args = get_defined_vars(); // MUST be the first line in the method
        $request = new Request("GET", "/v30/sale-invoices", $args);
        $request->enablePathParameters();
        $request->enableQueryParameters("entity_id", "period_filter", "invoice_status", "invoice_num_reminders_send", "invoice_type", "category", "product_offer_id", "member_id", "collection_id", "use_direct_debit", "contribution_start", "contribution_end", "page", "page_size", "order");
        $request->enableBodyFields();
        return $this->submit($request, new Model\SaleInvoicePagination);
    }

    /**
     * @generated
     */
    public function createSaleInvoice(int $id = null, string $uuid = null, int $entity_id = null, object $entity = null, string $invoice_date = null, string $invoice_source, string $invoice_type = null, string $delivery_method = null, string $invoice_send_date_time = null, string $invoice_due_date = null, string $invoice_reminded_date_time = null, int $invoice_num_reminders_send = null, string $invoice_next_due_date = null, string $invoice_status = null, string $invoice_reference = null, string $invoice_number = null, int $member_id = null, int $collection_id = null, string $contribution_start = null, string $contribution_end = null, bool $use_direct_debit = null, int $invoice_workflow_id = null, string $addressee = null, string $addressee_attention = null, string $email = null, object $address = null, array $items, array $payments = null, object $price_inclusive_vat = null, object $price_exclusive_vat = null, object $vat = null, object $price_paid = null, object $price_unpaid = null, object $currency = null, string $created = null, string $modified = null): void
    {
        $args = get_defined_vars(); // MUST be the first line in the method
        $request = new Request("POST", "/v30/sale-invoices", $args);
        $request->enablePathParameters();
        $request->enableQueryParameters();
        $request->enableBodyFields("id", "uuid", "entity_id", "entity", "invoice_date", "invoice_source", "invoice_type", "delivery_method", "invoice_send_date_time", "invoice_due_date", "invoice_reminded_date_time", "invoice_num_reminders_send", "invoice_next_due_date", "invoice_status", "invoice_reference", "invoice_number", "member_id", "collection_id", "contribution_start", "contribution_end", "use_direct_debit", "invoice_workflow_id", "addressee", "addressee_attention", "email", "address", "items", "payments", "price_inclusive_vat", "price_exclusive_vat", "vat", "price_paid", "price_unpaid", "currency", "created", "modified");
        $this->submit($request);
    }

    /**
     * @generated
     */
    public function retrieveSaleInvoice(int $obj_id): Model\SaleInvoice
    {
        $args = get_defined_vars(); // MUST be the first line in the method
        $request = new Request("GET", "/v30/sale-invoices/{obj_id}", $args);
        $request->enablePathParameters("obj_id");
        $request->enableQueryParameters();
        $request->enableBodyFields();
        return $this->submit($request, new Model\SaleInvoice);
    }

    /**
     * @generated
     */
    public function updateSaleInvoice(int $obj_id, int $id = null, string $uuid = null, int $entity_id = null, object $entity = null, string $invoice_date = null, string $invoice_source, string $invoice_type = null, string $delivery_method = null, string $invoice_send_date_time = null, string $invoice_due_date = null, string $invoice_reminded_date_time = null, int $invoice_num_reminders_send = null, string $invoice_next_due_date = null, string $invoice_status = null, string $invoice_reference = null, string $invoice_number = null, int $member_id = null, int $collection_id = null, string $contribution_start = null, string $contribution_end = null, bool $use_direct_debit = null, int $invoice_workflow_id = null, string $addressee = null, string $addressee_attention = null, string $email = null, object $address = null, array $items, array $payments = null, object $price_inclusive_vat = null, object $price_exclusive_vat = null, object $vat = null, object $price_paid = null, object $price_unpaid = null, object $currency = null, string $created = null, string $modified = null): void
    {
        $args = get_defined_vars(); // MUST be the first line in the method
        $request = new Request("PUT", "/v30/sale-invoices/{obj_id}", $args);
        $request->enablePathParameters("obj_id");
        $request->enableQueryParameters();
        $request->enableBodyFields("id", "uuid", "entity_id", "entity", "invoice_date", "invoice_source", "invoice_type", "delivery_method", "invoice_send_date_time", "invoice_due_date", "invoice_reminded_date_time", "invoice_num_reminders_send", "invoice_next_due_date", "invoice_status", "invoice_reference", "invoice_number", "member_id", "collection_id", "contribution_start", "contribution_end", "use_direct_debit", "invoice_workflow_id", "addressee", "addressee_attention", "email", "address", "items", "payments", "price_inclusive_vat", "price_exclusive_vat", "vat", "price_paid", "price_unpaid", "currency", "created", "modified");
        $this->submit($request);
    }

    /**
     * @generated
     */
    public function deleteSaleInvoice(int $obj_id): void
    {
        $args = get_defined_vars(); // MUST be the first line in the method
        $request = new Request("DELETE", "/v30/sale-invoices/{obj_id}", $args);
        $request->enablePathParameters("obj_id");
        $request->enableQueryParameters();
        $request->enableBodyFields();
        $this->submit($request);
    }

    /**
     * @generated
     */
    public function sendASaleInvoice(int $obj_id, string $delivery_method = null, string $email_subject = null, string $email_text = null): void
    {
        $args = get_defined_vars(); // MUST be the first line in the method
        $request = new Request("POST", "/v30/sale-invoices/{obj_id}/send", $args);
        $request->enablePathParameters("obj_id");
        $request->enableQueryParameters();
        $request->enableBodyFields("delivery_method", "email_subject", "email_text");
        $this->submit($request);
    }

    /**
     * @generated
     */
    public function remindASaleInvoice(int $obj_id): void
    {
        $args = get_defined_vars(); // MUST be the first line in the method
        $request = new Request("POST", "/v30/sale-invoices/{obj_id}/remind", $args);
        $request->enablePathParameters("obj_id");
        $request->enableQueryParameters();
        $request->enableBodyFields();
        $this->submit($request);
    }

    /**
     * @generated
     */
    public function markSaleInvoiceAsUncollectible(int $obj_id): void
    {
        $args = get_defined_vars(); // MUST be the first line in the method
        $request = new Request("POST", "/v30/sale-invoices/{obj_id}/mark-uncollectible", $args);
        $request->enablePathParameters("obj_id");
        $request->enableQueryParameters();
        $request->enableBodyFields();
        $this->submit($request);
    }

    /**
     * @generated
     */
    public function markSaleInvoiceAsCollectible(int $obj_id): void
    {
        $args = get_defined_vars(); // MUST be the first line in the method
        $request = new Request("POST", "/v30/sale-invoices/{obj_id}/mark-collectible", $args);
        $request->enablePathParameters("obj_id");
        $request->enableQueryParameters();
        $request->enableBodyFields();
        $this->submit($request);
    }

    /**
     * @generated
     */
    public function listSaleInvoiceItems(int $obj_id, int $page = null, int $page_size = null, string $order = null): Page
    {
        $args = get_defined_vars(); // MUST be the first line in the method
        $request = new Request("GET", "/v30/sale-invoices/{obj_id}/items", $args);
        $request->enablePathParameters("obj_id");
        $request->enableQueryParameters("page", "page_size", "order");
        $request->enableBodyFields();
        return $this->submit($request, new Model\SaleInvoiceItemPagination);
    }

    /**
     * @generated
     */
    public function createSaleInvoiceItem(int $obj_id, object $id = null, int $sale_invoice_id = null, int $product_offer_id, string $name = null, string $description = null, int $quantity = null, float $price = null, object $sort_order = null, object $vat_percentage = null, int $vat_category_id = null, string $vat_category = null, object $uuid = null): void
    {
        $args = get_defined_vars(); // MUST be the first line in the method
        $request = new Request("POST", "/v30/sale-invoices/{obj_id}/items", $args);
        $request->enablePathParameters("obj_id");
        $request->enableQueryParameters();
        $request->enableBodyFields("id", "sale_invoice_id", "product_offer_id", "name", "description", "quantity", "price", "sort_order", "vat_percentage", "vat_category_id", "vat_category", "uuid");
        $this->submit($request);
    }

    /**
     * @generated
     */
    public function listSaleInvoiceWorkflows(int $page = null, int $page_size = null, string $order = null): Page
    {
        $args = get_defined_vars(); // MUST be the first line in the method
        $request = new Request("GET", "/v30/sale-invoices/workflows", $args);
        $request->enablePathParameters();
        $request->enableQueryParameters("page", "page_size", "order");
        $request->enableBodyFields();
        return $this->submit($request, new Model\SaleInvoiceWorkflowPagination);
    }

    /**
     * @generated
     */
    public function listStorageObjects(int $page = null, int $page_size = null, string $order = null): Page
    {
        $args = get_defined_vars(); // MUST be the first line in the method
        $request = new Request("GET", "/v30/storage", $args);
        $request->enablePathParameters();
        $request->enableQueryParameters("page", "page_size", "order");
        $request->enableBodyFields();
        return $this->submit($request, new Model\StorageObjectPagination);
    }

    /**
     * @generated
     */
    public function createStorageObject(int $id = null, object $url = null, object $url_sm = null, object $url_md = null, object $url_lg = null, object $is_image = null, object $type = null): void
    {
        $args = get_defined_vars(); // MUST be the first line in the method
        $request = new Request("POST", "/v30/storage", $args);
        $request->enablePathParameters();
        $request->enableQueryParameters();
        $request->enableBodyFields("id", "url", "url_sm", "url_md", "url_lg", "is_image", "type");
        $this->submit($request);
    }

    /**
     * @generated
     */
    public function retrieveStorageObject(int $obj_id): Model\StorageObject
    {
        $args = get_defined_vars(); // MUST be the first line in the method
        $request = new Request("GET", "/v30/storage/{obj_id}", $args);
        $request->enablePathParameters("obj_id");
        $request->enableQueryParameters();
        $request->enableBodyFields();
        return $this->submit($request, new Model\StorageObject);
    }

    /**
     * @generated
     */
    public function updateStorageObject(int $obj_id, int $id = null, object $url = null, object $url_sm = null, object $url_md = null, object $url_lg = null, object $is_image = null, object $type = null): void
    {
        $args = get_defined_vars(); // MUST be the first line in the method
        $request = new Request("PUT", "/v30/storage/{obj_id}", $args);
        $request->enablePathParameters("obj_id");
        $request->enableQueryParameters();
        $request->enableBodyFields("id", "url", "url_sm", "url_md", "url_lg", "is_image", "type");
        $this->submit($request);
    }

    /**
     * @generated
     */
    public function deleteStorageObject(int $obj_id): void
    {
        $args = get_defined_vars(); // MUST be the first line in the method
        $request = new Request("DELETE", "/v30/storage/{obj_id}", $args);
        $request->enablePathParameters("obj_id");
        $request->enableQueryParameters();
        $request->enableBodyFields();
        $this->submit($request);
    }

    /**
     * @generated
     */
    public function uploadAFileToAnExistingStorageObject(int $obj_id): void
    {
        $args = get_defined_vars(); // MUST be the first line in the method
        $request = new Request("PUT", "/v30/storage/{obj_id}/file-content", $args);
        $request->enablePathParameters("obj_id");
        $request->enableQueryParameters();
        $request->enableBodyFields();
        $this->submit($request);
    }

    /**
     * @generated
     */
    public function listWebhooks(int $page = null, int $page_size = null, string $order = null): Page
    {
        $args = get_defined_vars(); // MUST be the first line in the method
        $request = new Request("GET", "/v30/webhooks", $args);
        $request->enablePathParameters();
        $request->enableQueryParameters("page", "page_size", "order");
        $request->enableBodyFields();
        return $this->submit($request, new Model\WebhookPagination);
    }

    /**
     * @generated
     */
    public function createWebhook(int $id = null, string $url = null, object $headers = null, string $version = null, string $signal = null, string $technical_contact_email = null, string $http_basic_auth_key = null, bool $http_basic_auth_enabled = null): void
    {
        $args = get_defined_vars(); // MUST be the first line in the method
        $request = new Request("POST", "/v30/webhooks", $args);
        $request->enablePathParameters();
        $request->enableQueryParameters();
        $request->enableBodyFields("id", "url", "headers", "version", "signal", "technical_contact_email", "http_basic_auth_key", "http_basic_auth_enabled");
        $this->submit($request);
    }

    /**
     * @generated
     */
    public function retrieveWebhook(int $obj_id): Model\Webhook
    {
        $args = get_defined_vars(); // MUST be the first line in the method
        $request = new Request("GET", "/v30/webhooks/{obj_id}", $args);
        $request->enablePathParameters("obj_id");
        $request->enableQueryParameters();
        $request->enableBodyFields();
        return $this->submit($request, new Model\Webhook);
    }

    /**
     * @generated
     */
    public function updateWebhook(int $obj_id, int $id = null, string $url = null, object $headers = null, string $version = null, string $signal = null, string $technical_contact_email = null, string $http_basic_auth_key = null, bool $http_basic_auth_enabled = null): void
    {
        $args = get_defined_vars(); // MUST be the first line in the method
        $request = new Request("PUT", "/v30/webhooks/{obj_id}", $args);
        $request->enablePathParameters("obj_id");
        $request->enableQueryParameters();
        $request->enableBodyFields("id", "url", "headers", "version", "signal", "technical_contact_email", "http_basic_auth_key", "http_basic_auth_enabled");
        $this->submit($request);
    }

    /**
     * @generated
     */
    public function deleteWebhook(int $obj_id): void
    {
        $args = get_defined_vars(); // MUST be the first line in the method
        $request = new Request("DELETE", "/v30/webhooks/{obj_id}", $args);
        $request->enablePathParameters("obj_id");
        $request->enableQueryParameters();
        $request->enableBodyFields();
        $this->submit($request);
    }

    /**
     * @generated
     */
    public function listWebhookCalls(int $obj_id, string $period_filter = null, array $status_code = null, int $page = null, int $page_size = null, string $order = null): Page
    {
        $args = get_defined_vars(); // MUST be the first line in the method
        $request = new Request("GET", "/v30/webhooks/{obj_id}/calls", $args);
        $request->enablePathParameters("obj_id");
        $request->enableQueryParameters("period_filter", "status_code", "page", "page_size", "order");
        $request->enableBodyFields();
        return $this->submit($request, new Model\WebhookCallPagination);
    }

    /**
     * @generated
     */
    public function listWebpages(string $published = null, int $website_id = null, int $template_id = null, int $page = null, int $page_size = null, string $order = null): Page
    {
        $args = get_defined_vars(); // MUST be the first line in the method
        $request = new Request("GET", "/v30/webpages", $args);
        $request->enablePathParameters();
        $request->enableQueryParameters("published", "website_id", "template_id", "page", "page_size", "order");
        $request->enableBodyFields();
        return $this->submit($request, new Model\WebpagePagination);
    }

    /**
     * @generated
     */
    public function retrieveWebpage(int $obj_id): Model\WebpageWithContent
    {
        $args = get_defined_vars(); // MUST be the first line in the method
        $request = new Request("GET", "/v30/webpages/{obj_id}", $args);
        $request->enablePathParameters("obj_id");
        $request->enableQueryParameters();
        $request->enableBodyFields();
        return $this->submit($request, new Model\WebpageWithContent);
    }

    /**
     * @generated
     */
    public function listWebsites(string $published = null, int $template_id = null, int $page = null, int $page_size = null, string $order = null): Page
    {
        $args = get_defined_vars(); // MUST be the first line in the method
        $request = new Request("GET", "/v30/websites", $args);
        $request->enablePathParameters();
        $request->enableQueryParameters("published", "template_id", "page", "page_size", "order");
        $request->enableBodyFields();
        return $this->submit($request, new Model\WebsitePagination);
    }

    /**
     * @generated
     */
    public function retrieveWebsite(int $obj_id): Model\Website
    {
        $args = get_defined_vars(); // MUST be the first line in the method
        $request = new Request("GET", "/v30/websites/{obj_id}", $args);
        $request->enablePathParameters("obj_id");
        $request->enableQueryParameters();
        $request->enableBodyFields();
        return $this->submit($request, new Model\Website);
    }

    /**
     * @generated
     */
    public function listWebsiteWebpages(int $obj_id, string $published = null, int $website_id = null, int $template_id = null, int $page = null, int $page_size = null, string $order = null): Page
    {
        $args = get_defined_vars(); // MUST be the first line in the method
        $request = new Request("GET", "/v30/websites/{obj_id}/webpages", $args);
        $request->enablePathParameters("obj_id");
        $request->enableQueryParameters("published", "website_id", "template_id", "page", "page_size", "order");
        $request->enableBodyFields();
        return $this->submit($request, new Model\WebpagePagination);
    }
}
