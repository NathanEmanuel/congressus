<?php

namespace Compucie\Congressus;

use Compucie\Congressus\Model;
use Compucie\Congressus\Request;

trait GeneratedRequestingMethodsTrait
{
    /**
     * @return  Model\BackgroundProcess[]
     * @generated
     */
    public function listBackgroundProcesses(?int $limit, array $state = null, string $created = null, string $modified = null, string $order = null): array
    {
        $pageNumber = 1;
        $page = null;
        $result = array();
        while (self::isRequestingAllowed($page, $limit)) {
            $page = $this->listBackgroundProcessesPaginated($state, $created, $modified, $order, page: $pageNumber);
            $result = array_merge($result, $page->getData());
            $pageNumber++;
        }
        return $result;
    }

    /**
     * @generated
     */
    public function listBackgroundProcessesPaginated(array $state = null, string $created = null, string $modified = null, string $order = null, int $page = null, int $page_size = null): Model\BackgroundProcessPagination
    {
        $request = new Request("GET", "/v30/background-processes", get_defined_vars());
        $request->enablePathParameters();
        $request->enableQueryParameters("state", "created", "modified", "page", "page_size", "order");
        $request->enableBodyFields();
        return $this->submit($request, Model\BackgroundProcessPagination::class);
    }

    /**
     * @generated
     */
    public function retrieveBackgroundProcess(int $obj_id): Model\BackgroundProcess
    {
        $request = new Request("GET", "/v30/background-processes/{obj_id}", get_defined_vars());
        $request->enablePathParameters("obj_id");
        $request->enableQueryParameters();
        $request->enableBodyFields();
        return $this->submit($request, Model\BackgroundProcess::class);
    }

    /**
     * @generated
     */
    public function retrieveBackgroundProcessResult(int $obj_id): Model\BackgroundProcessResult
    {
        $request = new Request("GET", "/v30/background-processes/results/{obj_id}", get_defined_vars());
        $request->enablePathParameters("obj_id");
        $request->enableQueryParameters();
        $request->enableBodyFields();
        return $this->submit($request, Model\BackgroundProcessResult::class);
    }

    /**
     * @return  Model\BankMutation[]
     * @generated
     */
    public function listBankMutations(?int $limit, string $period_filter = null, string $status = null, string $mutation_type = null, int $bank_import_id = null, int $bank_statement_id = null, int $bank_mutation_id = null, string $order = null): array
    {
        $pageNumber = 1;
        $page = null;
        $result = array();
        while (self::isRequestingAllowed($page, $limit)) {
            $page = $this->listBankMutationsPaginated($period_filter, $status, $mutation_type, $bank_import_id, $bank_statement_id, $bank_mutation_id, $order, page: $pageNumber);
            $result = array_merge($result, $page->getData());
            $pageNumber++;
        }
        return $result;
    }

    /**
     * @generated
     */
    public function listBankMutationsPaginated(string $period_filter = null, string $status = null, string $mutation_type = null, int $bank_import_id = null, int $bank_statement_id = null, int $bank_mutation_id = null, string $order = null, int $page = null, int $page_size = null): Model\BankMutationPagination
    {
        $request = new Request("GET", "/v30/bank", get_defined_vars());
        $request->enablePathParameters();
        $request->enableQueryParameters("period_filter", "status", "mutation_type", "bank_import_id", "bank_statement_id", "bank_mutation_id", "page", "page_size", "order");
        $request->enableBodyFields();
        return $this->submit($request, Model\BankMutationPagination::class);
    }

    /**
     * @generated
     */
    public function retrieveBankMutation(int $obj_id): Model\BankMutation
    {
        $request = new Request("GET", "/v30/bank/{obj_id}", get_defined_vars());
        $request->enablePathParameters("obj_id");
        $request->enableQueryParameters();
        $request->enableBodyFields();
        return $this->submit($request, Model\BankMutation::class);
    }

    /**
     * @generated
     */
    public function deleteBankMutation(int $obj_id): void
    {
        $request = new Request("DELETE", "/v30/bank/{obj_id}", get_defined_vars());
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
        $request = new Request("POST", "/v30/bank/{obj_id}/match", get_defined_vars());
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
        $request = new Request("POST", "/v30/bank/{obj_id}/unmatch", get_defined_vars());
        $request->enablePathParameters("obj_id");
        $request->enableQueryParameters();
        $request->enableBodyFields("sale_invoice_id", "amount");
        $this->submit($request);
    }

    /**
     * @return  Model\BlogAuthor[]
     * @generated
     */
    public function listBlogAuthors(?int $limit, string $order = null): array
    {
        $pageNumber = 1;
        $page = null;
        $result = array();
        while (self::isRequestingAllowed($page, $limit)) {
            $page = $this->listBlogAuthorsPaginated($order, page: $pageNumber);
            $result = array_merge($result, $page->getData());
            $pageNumber++;
        }
        return $result;
    }

    /**
     * @generated
     */
    public function listBlogAuthorsPaginated(string $order = null, int $page = null, int $page_size = null): Model\BlogAuthorPagination
    {
        $request = new Request("GET", "/v30/blogs/authors", get_defined_vars());
        $request->enablePathParameters();
        $request->enableQueryParameters("page", "page_size", "order");
        $request->enableBodyFields();
        return $this->submit($request, Model\BlogAuthorPagination::class);
    }

    /**
     * @generated
     */
    public function createBlogAuthor(string $name, int $id = null, object $description = null, object $image = null): Model\BlogAuthor
    {
        $request = new Request("POST", "/v30/blogs/authors", get_defined_vars());
        $request->enablePathParameters();
        $request->enableQueryParameters();
        $request->enableBodyFields("id", "name", "description", "image");
        return $this->submit($request, Model\BlogAuthor::class);
    }

    /**
     * @generated
     */
    public function retrieveBlogAuthor(int $obj_id): Model\BlogAuthor
    {
        $request = new Request("GET", "/v30/blogs/authors/{obj_id}", get_defined_vars());
        $request->enablePathParameters("obj_id");
        $request->enableQueryParameters();
        $request->enableBodyFields();
        return $this->submit($request, Model\BlogAuthor::class);
    }

    /**
     * @generated
     */
    public function updateBlogAuthor(int $obj_id, string $name, int $id = null, object $description = null, object $image = null): Model\BlogAuthor
    {
        $request = new Request("PUT", "/v30/blogs/authors/{obj_id}", get_defined_vars());
        $request->enablePathParameters("obj_id");
        $request->enableQueryParameters();
        $request->enableBodyFields("id", "name", "description", "image");
        return $this->submit($request, Model\BlogAuthor::class);
    }

    /**
     * @generated
     */
    public function deleteBlogAuthor(int $obj_id): void
    {
        $request = new Request("DELETE", "/v30/blogs/authors/{obj_id}", get_defined_vars());
        $request->enablePathParameters("obj_id");
        $request->enableQueryParameters();
        $request->enableBodyFields();
        $this->submit($request);
    }

    /**
     * @return  Model\Blog[]
     * @generated
     */
    public function listBlogs(?int $limit, string $period_filter = null, int $author_id = null, int $issue_id = null, int $category_id = null, int $published = null, array $visibility = null, string $order = null): array
    {
        $pageNumber = 1;
        $page = null;
        $result = array();
        while (self::isRequestingAllowed($page, $limit)) {
            $page = $this->listBlogsPaginated($period_filter, $author_id, $issue_id, $category_id, $published, $visibility, $order, page: $pageNumber);
            $result = array_merge($result, $page->getData());
            $pageNumber++;
        }
        return $result;
    }

    /**
     * @generated
     */
    public function listBlogsPaginated(string $period_filter = null, int $author_id = null, int $issue_id = null, int $category_id = null, int $published = null, array $visibility = null, string $order = null, int $page = null, int $page_size = null): Model\BlogPagination
    {
        $request = new Request("GET", "/v30/blogs", get_defined_vars());
        $request->enablePathParameters();
        $request->enableQueryParameters("period_filter", "author_id", "issue_id", "category_id", "published", "visibility", "page", "page_size", "order");
        $request->enableBodyFields();
        return $this->submit($request, Model\BlogPagination::class);
    }

    /**
     * @generated
     */
    public function createBlog(string $title, int $category_id, int $id = null, int $author_id = null, int $issue_id = null, bool $published = null, string $published_from = null, string $visibility = null, bool $authentication_required = null, string $memo = null): Model\Blog
    {
        $request = new Request("POST", "/v30/blogs", get_defined_vars());
        $request->enablePathParameters();
        $request->enableQueryParameters();
        $request->enableBodyFields("id", "title", "category_id", "author_id", "issue_id", "published", "published_from", "visibility", "authentication_required", "memo");
        return $this->submit($request, Model\Blog::class);
    }

    /**
     * @generated
     */
    public function retrieveBlog(int $obj_id): Model\BlogWithParagraph
    {
        $request = new Request("GET", "/v30/blogs/{obj_id}", get_defined_vars());
        $request->enablePathParameters("obj_id");
        $request->enableQueryParameters();
        $request->enableBodyFields();
        return $this->submit($request, Model\BlogWithParagraph::class);
    }

    /**
     * @generated
     */
    public function updateBlog(int $obj_id, string $title, int $category_id, int $id = null, int $author_id = null, int $issue_id = null, bool $published = null, string $published_from = null, string $visibility = null, bool $authentication_required = null, string $memo = null, array $paragraphs = null): Model\BlogWithParagraph
    {
        $request = new Request("PUT", "/v30/blogs/{obj_id}", get_defined_vars());
        $request->enablePathParameters("obj_id");
        $request->enableQueryParameters();
        $request->enableBodyFields("id", "title", "category_id", "author_id", "issue_id", "published", "published_from", "visibility", "authentication_required", "memo", "paragraphs");
        return $this->submit($request, Model\BlogWithParagraph::class);
    }

    /**
     * @generated
     */
    public function deleteBlog(int $obj_id): void
    {
        $request = new Request("DELETE", "/v30/blogs/{obj_id}", get_defined_vars());
        $request->enablePathParameters("obj_id");
        $request->enableQueryParameters();
        $request->enableBodyFields();
        $this->submit($request);
    }

    /**
     * @generated
     */
    public function createBlogTextParagraph(int $obj_id, string $content, int $id = null, string $template = null, int $order = null, string $type = null, string $created = null, string $modified = null): Model\BlogTextParagraph
    {
        $request = new Request("POST", "/v30/blogs/{obj_id}/paragraphs/text", get_defined_vars());
        $request->enablePathParameters("obj_id");
        $request->enableQueryParameters();
        $request->enableBodyFields("id", "template", "content", "order", "type", "created", "modified");
        return $this->submit($request, Model\BlogTextParagraph::class);
    }

    /**
     * @generated
     */
    public function createBlogImageParagraph(int $obj_id, int $id = null, string $template = null, string $caption = null, int $order = null, string $type = null, string $created = null, string $modified = null, object $image = null, int $image_id = null): Model\BlogImageParagraph
    {
        $request = new Request("POST", "/v30/blogs/{obj_id}/paragraphs/image", get_defined_vars());
        $request->enablePathParameters("obj_id");
        $request->enableQueryParameters();
        $request->enableBodyFields("id", "template", "caption", "order", "type", "created", "modified", "image", "image_id");
        return $this->submit($request, Model\BlogImageParagraph::class);
    }

    /**
     * @generated
     */
    public function retrieveBlogTextParagraph(int $obj_id): Model\BlogTextParagraph
    {
        $request = new Request("GET", "/v30/blogs/paragraphs/text/{obj_id}", get_defined_vars());
        $request->enablePathParameters("obj_id");
        $request->enableQueryParameters();
        $request->enableBodyFields();
        return $this->submit($request, Model\BlogTextParagraph::class);
    }

    /**
     * @generated
     */
    public function updateBlogTextParagraph(int $obj_id, string $content, int $id = null, string $template = null, int $order = null, string $type = null, string $created = null, string $modified = null): Model\BlogTextParagraph
    {
        $request = new Request("PUT", "/v30/blogs/paragraphs/text/{obj_id}", get_defined_vars());
        $request->enablePathParameters("obj_id");
        $request->enableQueryParameters();
        $request->enableBodyFields("id", "template", "content", "order", "type", "created", "modified");
        return $this->submit($request, Model\BlogTextParagraph::class);
    }

    /**
     * @generated
     */
    public function deleteBlogTextParagraph(int $obj_id): void
    {
        $request = new Request("DELETE", "/v30/blogs/paragraphs/text/{obj_id}", get_defined_vars());
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
        $request = new Request("GET", "/v30/blogs/paragraphs/image/{obj_id}", get_defined_vars());
        $request->enablePathParameters("obj_id");
        $request->enableQueryParameters();
        $request->enableBodyFields();
        return $this->submit($request, Model\BlogImageParagraph::class);
    }

    /**
     * @generated
     */
    public function updateBlogImageParagraph(int $obj_id, int $id = null, string $template = null, string $caption = null, int $order = null, string $type = null, string $created = null, string $modified = null, object $image = null, int $image_id = null): Model\BlogImageParagraph
    {
        $request = new Request("PUT", "/v30/blogs/paragraphs/image/{obj_id}", get_defined_vars());
        $request->enablePathParameters("obj_id");
        $request->enableQueryParameters();
        $request->enableBodyFields("id", "template", "caption", "order", "type", "created", "modified", "image", "image_id");
        return $this->submit($request, Model\BlogImageParagraph::class);
    }

    /**
     * @generated
     */
    public function deleteBlogImageParagraph(int $obj_id): void
    {
        $request = new Request("DELETE", "/v30/blogs/paragraphs/image/{obj_id}", get_defined_vars());
        $request->enablePathParameters("obj_id");
        $request->enableQueryParameters();
        $request->enableBodyFields();
        $this->submit($request);
    }

    /**
     * @return  Model\BlogCategory[]
     * @generated
     */
    public function listBlogCategories(?int $limit, string $order = null): array
    {
        $pageNumber = 1;
        $page = null;
        $result = array();
        while (self::isRequestingAllowed($page, $limit)) {
            $page = $this->listBlogCategoriesPaginated($order, page: $pageNumber);
            $result = array_merge($result, $page->getData());
            $pageNumber++;
        }
        return $result;
    }

    /**
     * @generated
     */
    public function listBlogCategoriesPaginated(string $order = null, int $page = null, int $page_size = null): Model\BlogCategoryPagination
    {
        $request = new Request("GET", "/v30/blogs/categories", get_defined_vars());
        $request->enablePathParameters();
        $request->enableQueryParameters("page", "page_size", "order");
        $request->enableBodyFields();
        return $this->submit($request, Model\BlogCategoryPagination::class);
    }

    /**
     * @generated
     */
    public function createBlogCategory(string $name, int $id = null, string $color = null, string $slug = null, bool $published = null, object $visibility = null, array $websites = null): Model\BlogCategory
    {
        $request = new Request("POST", "/v30/blogs/categories", get_defined_vars());
        $request->enablePathParameters();
        $request->enableQueryParameters();
        $request->enableBodyFields("id", "name", "color", "slug", "published", "visibility", "websites");
        return $this->submit($request, Model\BlogCategory::class);
    }

    /**
     * @generated
     */
    public function retrieveBlogCategory(int $obj_id): Model\BlogCategory
    {
        $request = new Request("GET", "/v30/blogs/categories/{obj_id}", get_defined_vars());
        $request->enablePathParameters("obj_id");
        $request->enableQueryParameters();
        $request->enableBodyFields();
        return $this->submit($request, Model\BlogCategory::class);
    }

    /**
     * @generated
     */
    public function updateBlogCategory(int $obj_id, string $name, int $id = null, string $color = null, string $slug = null, bool $published = null, object $visibility = null, array $websites = null): Model\BlogCategory
    {
        $request = new Request("PUT", "/v30/blogs/categories/{obj_id}", get_defined_vars());
        $request->enablePathParameters("obj_id");
        $request->enableQueryParameters();
        $request->enableBodyFields("id", "name", "color", "slug", "published", "visibility", "websites");
        return $this->submit($request, Model\BlogCategory::class);
    }

    /**
     * @generated
     */
    public function deleteBlogCategory(int $obj_id): void
    {
        $request = new Request("DELETE", "/v30/blogs/categories/{obj_id}", get_defined_vars());
        $request->enablePathParameters("obj_id");
        $request->enableQueryParameters();
        $request->enableBodyFields();
        $this->submit($request);
    }

    /**
     * @return  Model\BlogIssue[]
     * @generated
     */
    public function listBlogIssues(?int $limit, string $order = null): array
    {
        $pageNumber = 1;
        $page = null;
        $result = array();
        while (self::isRequestingAllowed($page, $limit)) {
            $page = $this->listBlogIssuesPaginated($order, page: $pageNumber);
            $result = array_merge($result, $page->getData());
            $pageNumber++;
        }
        return $result;
    }

    /**
     * @generated
     */
    public function listBlogIssuesPaginated(string $order = null, int $page = null, int $page_size = null): Model\BlogIssuePagination
    {
        $request = new Request("GET", "/v30/blogs/issues", get_defined_vars());
        $request->enablePathParameters();
        $request->enableQueryParameters("page", "page_size", "order");
        $request->enableBodyFields();
        return $this->submit($request, Model\BlogIssuePagination::class);
    }

    /**
     * @generated
     */
    public function createBlogIssue(string $name, int $id = null, object $description = null, object $image = null): Model\BlogIssue
    {
        $request = new Request("POST", "/v30/blogs/issues", get_defined_vars());
        $request->enablePathParameters();
        $request->enableQueryParameters();
        $request->enableBodyFields("id", "name", "description", "image");
        return $this->submit($request, Model\BlogIssue::class);
    }

    /**
     * @generated
     */
    public function retrieveBlogIssue(int $obj_id): Model\BlogIssue
    {
        $request = new Request("GET", "/v30/blogs/issues/{obj_id}", get_defined_vars());
        $request->enablePathParameters("obj_id");
        $request->enableQueryParameters();
        $request->enableBodyFields();
        return $this->submit($request, Model\BlogIssue::class);
    }

    /**
     * @generated
     */
    public function updateBlogIssue(int $obj_id, string $name, int $id = null, object $description = null, object $image = null): Model\BlogIssue
    {
        $request = new Request("PUT", "/v30/blogs/issues/{obj_id}", get_defined_vars());
        $request->enablePathParameters("obj_id");
        $request->enableQueryParameters();
        $request->enableBodyFields("id", "name", "description", "image");
        return $this->submit($request, Model\BlogIssue::class);
    }

    /**
     * @generated
     */
    public function deleteBlogIssue(int $obj_id): void
    {
        $request = new Request("DELETE", "/v30/blogs/issues/{obj_id}", get_defined_vars());
        $request->enablePathParameters("obj_id");
        $request->enableQueryParameters();
        $request->enableBodyFields();
        $this->submit($request);
    }

    /**
     * @return  Model\CareerPartnerCategory[]
     * @generated
     */
    public function listCareerPartnerCategories(?int $limit, string $order = null): array
    {
        $pageNumber = 1;
        $page = null;
        $result = array();
        while (self::isRequestingAllowed($page, $limit)) {
            $page = $this->listCareerPartnerCategoriesPaginated($order, page: $pageNumber);
            $result = array_merge($result, $page->getData());
            $pageNumber++;
        }
        return $result;
    }

    /**
     * @generated
     */
    public function listCareerPartnerCategoriesPaginated(string $order = null, int $page = null, int $page_size = null): Model\CareerPartnerCategoryPagination
    {
        $request = new Request("GET", "/v30/career/partners/categories", get_defined_vars());
        $request->enablePathParameters();
        $request->enableQueryParameters("page", "page_size", "order");
        $request->enableBodyFields();
        return $this->submit($request, Model\CareerPartnerCategoryPagination::class);
    }

    /**
     * @generated
     */
    public function createCareerPartnerCategory(string $name, int $id = null, string $color = null, string $slug = null, bool $published = null, object $visibility = null, array $websites = null): Model\CareerPartnerCategory
    {
        $request = new Request("POST", "/v30/career/partners/categories", get_defined_vars());
        $request->enablePathParameters();
        $request->enableQueryParameters();
        $request->enableBodyFields("id", "name", "color", "slug", "published", "visibility", "websites");
        return $this->submit($request, Model\CareerPartnerCategory::class);
    }

    /**
     * @generated
     */
    public function retrieveCareerPartnerCategory(int $obj_id): Model\CareerPartnerCategory
    {
        $request = new Request("GET", "/v30/career/partners/categories/{obj_id}", get_defined_vars());
        $request->enablePathParameters("obj_id");
        $request->enableQueryParameters();
        $request->enableBodyFields();
        return $this->submit($request, Model\CareerPartnerCategory::class);
    }

    /**
     * @generated
     */
    public function updateCareerPartnerCategory(int $obj_id, string $name, int $id = null, string $color = null, string $slug = null, bool $published = null, object $visibility = null, array $websites = null): Model\CareerPartnerCategory
    {
        $request = new Request("PUT", "/v30/career/partners/categories/{obj_id}", get_defined_vars());
        $request->enablePathParameters("obj_id");
        $request->enableQueryParameters();
        $request->enableBodyFields("id", "name", "color", "slug", "published", "visibility", "websites");
        return $this->submit($request, Model\CareerPartnerCategory::class);
    }

    /**
     * @generated
     */
    public function deleteCareerPartnerCategory(int $obj_id): void
    {
        $request = new Request("DELETE", "/v30/career/partners/categories/{obj_id}", get_defined_vars());
        $request->enablePathParameters("obj_id");
        $request->enableQueryParameters();
        $request->enableBodyFields();
        $this->submit($request);
    }

    /**
     * @return  Model\CareerPartner[]
     * @generated
     */
    public function listCareerPartners(?int $limit, int $career_partner_category_id = null, string $order = null): array
    {
        $pageNumber = 1;
        $page = null;
        $result = array();
        while (self::isRequestingAllowed($page, $limit)) {
            $page = $this->listCareerPartnersPaginated($career_partner_category_id, $order, page: $pageNumber);
            $result = array_merge($result, $page->getData());
            $pageNumber++;
        }
        return $result;
    }

    /**
     * @generated
     */
    public function listCareerPartnersPaginated(int $career_partner_category_id = null, string $order = null, int $page = null, int $page_size = null): Model\CareerPartnerPagination
    {
        $request = new Request("GET", "/v30/career/partners", get_defined_vars());
        $request->enablePathParameters();
        $request->enableQueryParameters("career_partner_category_id", "page", "page_size", "order");
        $request->enableBodyFields();
        return $this->submit($request, Model\CareerPartnerPagination::class);
    }

    /**
     * @generated
     */
    public function createCareerPartner(int $id, string $slug, int $category_id, string $invoice_address_field, string $name = null, object $category = null, object $address = null, object $postal_address = null, string $description = null, string $description_short = null, string $email = null, string $url = null, object $logo = null, string $memo = null, string $invoice_reference = null, string $invoice_addressee_attention = null, string $invoice_email = null, array $events = null): Model\CareerPartner
    {
        $request = new Request("POST", "/v30/career/partners", get_defined_vars());
        $request->enablePathParameters();
        $request->enableQueryParameters();
        $request->enableBodyFields("id", "name", "slug", "category_id", "category", "address", "postal_address", "description", "description_short", "email", "url", "logo", "memo", "invoice_reference", "invoice_addressee_attention", "invoice_address_field", "invoice_email", "events");
        return $this->submit($request, Model\CareerPartner::class);
    }

    /**
     * @generated
     */
    public function retrieveCareerPartner(int $obj_id): Model\CareerPartner
    {
        $request = new Request("GET", "/v30/career/partners/{obj_id}", get_defined_vars());
        $request->enablePathParameters("obj_id");
        $request->enableQueryParameters();
        $request->enableBodyFields();
        return $this->submit($request, Model\CareerPartner::class);
    }

    /**
     * @generated
     */
    public function updateCareerPartner(int $obj_id, int $id, string $slug, int $category_id, string $invoice_address_field, string $name = null, object $category = null, object $address = null, object $postal_address = null, string $description = null, string $description_short = null, string $email = null, string $url = null, object $logo = null, string $memo = null, string $invoice_reference = null, string $invoice_addressee_attention = null, string $invoice_email = null, array $events = null): Model\CareerPartner
    {
        $request = new Request("PUT", "/v30/career/partners/{obj_id}", get_defined_vars());
        $request->enablePathParameters("obj_id");
        $request->enableQueryParameters();
        $request->enableBodyFields("id", "name", "slug", "category_id", "category", "address", "postal_address", "description", "description_short", "email", "url", "logo", "memo", "invoice_reference", "invoice_addressee_attention", "invoice_address_field", "invoice_email", "events");
        return $this->submit($request, Model\CareerPartner::class);
    }

    /**
     * @generated
     */
    public function deleteCareerPartner(int $obj_id): void
    {
        $request = new Request("DELETE", "/v30/career/partners/{obj_id}", get_defined_vars());
        $request->enablePathParameters("obj_id");
        $request->enableQueryParameters();
        $request->enableBodyFields();
        $this->submit($request);
    }

    /**
     * @return  Model\SavedReply[]
     * @generated
     */
    public function listSavedReplies(?int $limit, string $order = null): array
    {
        $pageNumber = 1;
        $page = null;
        $result = array();
        while (self::isRequestingAllowed($page, $limit)) {
            $page = $this->listSavedRepliesPaginated($order, page: $pageNumber);
            $result = array_merge($result, $page->getData());
            $pageNumber++;
        }
        return $result;
    }

    /**
     * @generated
     */
    public function listSavedRepliesPaginated(string $order = null, int $page = null, int $page_size = null): Model\SavedReplyPagination
    {
        $request = new Request("GET", "/v30/communication/saved-replies", get_defined_vars());
        $request->enablePathParameters();
        $request->enableQueryParameters("page", "page_size", "order");
        $request->enableBodyFields();
        return $this->submit($request, Model\SavedReplyPagination::class);
    }

    /**
     * @generated
     */
    public function createSavedReply(string $name, int $category_id, int $id = null, string $subject = null, object $message_json = null): Model\SavedReply
    {
        $request = new Request("POST", "/v30/communication/saved-replies", get_defined_vars());
        $request->enablePathParameters();
        $request->enableQueryParameters();
        $request->enableBodyFields("id", "name", "category_id", "subject", "message_json");
        return $this->submit($request, Model\SavedReply::class);
    }

    /**
     * @generated
     */
    public function retrieveSavedReply(int $obj_id): Model\SavedReply
    {
        $request = new Request("GET", "/v30/communication/saved-replies/{obj_id}", get_defined_vars());
        $request->enablePathParameters("obj_id");
        $request->enableQueryParameters();
        $request->enableBodyFields();
        return $this->submit($request, Model\SavedReply::class);
    }

    /**
     * @generated
     */
    public function updateSavedReply(int $obj_id, string $name, int $category_id, int $id = null, string $subject = null, object $message_json = null): Model\SavedReply
    {
        $request = new Request("PUT", "/v30/communication/saved-replies/{obj_id}", get_defined_vars());
        $request->enablePathParameters("obj_id");
        $request->enableQueryParameters();
        $request->enableBodyFields("id", "name", "category_id", "subject", "message_json");
        return $this->submit($request, Model\SavedReply::class);
    }

    /**
     * @generated
     */
    public function deleteSavedReply(int $obj_id): void
    {
        $request = new Request("DELETE", "/v30/communication/saved-replies/{obj_id}", get_defined_vars());
        $request->enablePathParameters("obj_id");
        $request->enableQueryParameters();
        $request->enableBodyFields();
        $this->submit($request);
    }

    /**
     * @return  Model\Country[]
     * @generated
     */
    public function listCountries(?int $limit, string $order = null): array
    {
        $pageNumber = 1;
        $page = null;
        $result = array();
        while (self::isRequestingAllowed($page, $limit)) {
            $page = $this->listCountriesPaginated($order, page: $pageNumber);
            $result = array_merge($result, $page->getData());
            $pageNumber++;
        }
        return $result;
    }

    /**
     * @generated
     */
    public function listCountriesPaginated(string $order = null, int $page = null, int $page_size = null): Model\CountryPagination
    {
        $request = new Request("GET", "/v30/countries", get_defined_vars());
        $request->enablePathParameters();
        $request->enableQueryParameters("page", "page_size", "order");
        $request->enableBodyFields();
        return $this->submit($request, Model\CountryPagination::class);
    }

    /**
     * @generated
     */
    public function retrieveCountry(int $obj_id): Model\Country
    {
        $request = new Request("GET", "/v30/countries/{obj_id}", get_defined_vars());
        $request->enablePathParameters("obj_id");
        $request->enableQueryParameters();
        $request->enableBodyFields();
        return $this->submit($request, Model\Country::class);
    }

    /**
     * @return  Model\EventCategory[]
     * @generated
     */
    public function listEventCategories(?int $limit, string $order = null): array
    {
        $pageNumber = 1;
        $page = null;
        $result = array();
        while (self::isRequestingAllowed($page, $limit)) {
            $page = $this->listEventCategoriesPaginated($order, page: $pageNumber);
            $result = array_merge($result, $page->getData());
            $pageNumber++;
        }
        return $result;
    }

    /**
     * @generated
     */
    public function listEventCategoriesPaginated(string $order = null, int $page = null, int $page_size = null): Model\EventCategoryPagination
    {
        $request = new Request("GET", "/v30/event-categories", get_defined_vars());
        $request->enablePathParameters();
        $request->enableQueryParameters("page", "page_size", "order");
        $request->enableBodyFields();
        return $this->submit($request, Model\EventCategoryPagination::class);
    }

    /**
     * @return  Model\Event[]
     * @generated
     */
    public function listEvents(?int $limit, int $category_id = null, string $period_filter = null, string $published = null, array $participation_billing_enabled = null, int $participating_member_id = null, int $socie_app_id = null, int $member_id = null, string $order = null): array
    {
        $pageNumber = 1;
        $page = null;
        $result = array();
        while (self::isRequestingAllowed($page, $limit)) {
            $page = $this->listEventsPaginated($category_id, $period_filter, $published, $participation_billing_enabled, $participating_member_id, $socie_app_id, $member_id, $order, page: $pageNumber);
            $result = array_merge($result, $page->getData());
            $pageNumber++;
        }
        return $result;
    }

    /**
     * @generated
     */
    public function listEventsPaginated(int $category_id = null, string $period_filter = null, string $published = null, array $participation_billing_enabled = null, int $participating_member_id = null, int $socie_app_id = null, int $member_id = null, string $order = null, int $page = null, int $page_size = null): Model\EventPagination
    {
        $request = new Request("GET", "/v30/events", get_defined_vars());
        $request->enablePathParameters();
        $request->enableQueryParameters("category_id", "period_filter", "published", "participation_billing_enabled", "participating_member_id", "socie_app_id", "member_id", "page", "page_size", "order");
        $request->enableBodyFields();
        return $this->submit($request, Model\EventPagination::class);
    }

    /**
     * @generated
     */
    public function createEvent(int $category_id, string $name, int $id = null, object $category = null, string $status = null, string $slug = null, string $description = null, bool $published = null, string $visibility = null, bool $authentication_required = null, string $start = null, string $end = null, bool $whole_day = null, string $location = null, bool $show_participants = null, bool $show_waiting_list = null, bool $show_rented_items = null, bool $participation_enabled = null, string $participation_mode = null, bool $participation_billing_enabled = null, string $participation_billing_type = null, bool $participation_payment_ideal = null, bool $participation_payment_direct_debit = null, bool $participation_payment_on_invoice = null, string $participation_information_collection_type = null, bool $qr_ticketing_enabled = null, array $ticket_types = null, int $num_tickets = null, int $num_tickets_sold = null, int $num_tickets_max_per_order = null, bool $participant_remarks_enabled = null, string $participant_remarks_placeholder = null, bool $rental_enabled = null, array $rental_categories = null, float $rental_max_price = null, array $career_partners = null, string $website_url = null, string $website_subscribe_url = null, bool $comments_open = null, array $comments = null, array $media = null, string $memo = null): Model\Event
    {
        $request = new Request("POST", "/v30/events", get_defined_vars());
        $request->enablePathParameters();
        $request->enableQueryParameters();
        $request->enableBodyFields("id", "category_id", "category", "status", "slug", "name", "description", "published", "visibility", "authentication_required", "start", "end", "whole_day", "location", "show_participants", "show_waiting_list", "show_rented_items", "participation_enabled", "participation_mode", "participation_billing_enabled", "participation_billing_type", "participation_payment_ideal", "participation_payment_direct_debit", "participation_payment_on_invoice", "participation_information_collection_type", "qr_ticketing_enabled", "ticket_types", "num_tickets", "num_tickets_sold", "num_tickets_max_per_order", "participant_remarks_enabled", "participant_remarks_placeholder", "rental_enabled", "rental_categories", "rental_max_price", "career_partners", "website_url", "website_subscribe_url", "comments_open", "comments", "media", "memo");
        return $this->submit($request, Model\Event::class);
    }

    /**
     * @generated
     */
    public function retrieveEvent(int $obj_id): Model\Event
    {
        $request = new Request("GET", "/v30/events/{obj_id}", get_defined_vars());
        $request->enablePathParameters("obj_id");
        $request->enableQueryParameters();
        $request->enableBodyFields();
        return $this->submit($request, Model\Event::class);
    }

    /**
     * @generated
     */
    public function updateEvent(int $obj_id, int $category_id, string $name, int $id = null, object $category = null, string $status = null, string $slug = null, string $description = null, bool $published = null, string $visibility = null, bool $authentication_required = null, string $start = null, string $end = null, bool $whole_day = null, string $location = null, bool $show_participants = null, bool $show_waiting_list = null, bool $show_rented_items = null, bool $participation_enabled = null, string $participation_mode = null, bool $participation_billing_enabled = null, string $participation_billing_type = null, bool $participation_payment_ideal = null, bool $participation_payment_direct_debit = null, bool $participation_payment_on_invoice = null, string $participation_information_collection_type = null, bool $qr_ticketing_enabled = null, array $ticket_types = null, int $num_tickets = null, int $num_tickets_sold = null, int $num_tickets_max_per_order = null, bool $participant_remarks_enabled = null, string $participant_remarks_placeholder = null, bool $rental_enabled = null, array $rental_categories = null, float $rental_max_price = null, array $career_partners = null, string $website_url = null, string $website_subscribe_url = null, bool $comments_open = null, array $comments = null, array $media = null, string $memo = null): Model\Event
    {
        $request = new Request("PUT", "/v30/events/{obj_id}", get_defined_vars());
        $request->enablePathParameters("obj_id");
        $request->enableQueryParameters();
        $request->enableBodyFields("id", "category_id", "category", "status", "slug", "name", "description", "published", "visibility", "authentication_required", "start", "end", "whole_day", "location", "show_participants", "show_waiting_list", "show_rented_items", "participation_enabled", "participation_mode", "participation_billing_enabled", "participation_billing_type", "participation_payment_ideal", "participation_payment_direct_debit", "participation_payment_on_invoice", "participation_information_collection_type", "qr_ticketing_enabled", "ticket_types", "num_tickets", "num_tickets_sold", "num_tickets_max_per_order", "participant_remarks_enabled", "participant_remarks_placeholder", "rental_enabled", "rental_categories", "rental_max_price", "career_partners", "website_url", "website_subscribe_url", "comments_open", "comments", "media", "memo");
        return $this->submit($request, Model\Event::class);
    }

    /**
     * @generated
     */
    public function deleteEvent(int $obj_id): void
    {
        $request = new Request("DELETE", "/v30/events/{obj_id}", get_defined_vars());
        $request->enablePathParameters("obj_id");
        $request->enableQueryParameters();
        $request->enableBodyFields();
        $this->submit($request);
    }

    /**
     * @return  Model\EventParticipation[]
     * @generated
     */
    public function listEventParticipations(?int $limit, int $obj_id, int $event_id = null, array $status = null, string $has_invoice = null, array $sale_invoice_status = null, int $member_id = null, string $order = null): array
    {
        $pageNumber = 1;
        $page = null;
        $result = array();
        while (self::isRequestingAllowed($page, $limit)) {
            $page = $this->listEventParticipationsPaginated($obj_id, $event_id, $status, $has_invoice, $sale_invoice_status, $member_id, $order, page: $pageNumber);
            $result = array_merge($result, $page->getData());
            $pageNumber++;
        }
        return $result;
    }

    /**
     * @generated
     */
    public function listEventParticipationsPaginated(int $obj_id, int $event_id = null, array $status = null, string $has_invoice = null, array $sale_invoice_status = null, int $member_id = null, string $order = null, int $page = null, int $page_size = null): Model\EventParticipationPagination
    {
        $request = new Request("GET", "/v30/events/{obj_id}/participations", get_defined_vars());
        $request->enablePathParameters("obj_id");
        $request->enableQueryParameters("event_id", "status", "has_invoice", "sale_invoice_status", "member_id", "page", "page_size", "order");
        $request->enableBodyFields();
        return $this->submit($request, Model\EventParticipationPagination::class);
    }

    /**
     * @generated
     */
    public function retrieveEventParticipation(int $obj_id, int $event_id): Model\EventParticipationWithRelations
    {
        $request = new Request("GET", "/v30/events/{event_id}/participations/{obj_id}", get_defined_vars());
        $request->enablePathParameters("obj_id", "event_id");
        $request->enableQueryParameters();
        $request->enableBodyFields();
        return $this->submit($request, Model\EventParticipationWithRelations::class);
    }

    /**
     * @generated
     */
    public function setPresenceOnAllTicketsWithinParticipation(int $obj_id, int $event_id, string $status_presence, float $participation_certificates_credits_override = null, string $participation_certificates_date_override = null): void
    {
        $request = new Request("POST", "/v30/events/{event_id}/participations/{obj_id}/set-presence", get_defined_vars());
        $request->enablePathParameters("obj_id", "event_id");
        $request->enableQueryParameters();
        $request->enableBodyFields("status_presence", "participation_certificates_credits_override", "participation_certificates_date_override");
        $this->submit($request);
    }

    /**
     * @generated
     */
    public function createEventParticipation(int $obj_id, array $tickets, string $addressee = null, string $email = null, int $member_id = null, string $remarks = null, string $invoice_addressee = null, string $invoice_email = null, string $invoice_invoice_reference = null, object $invoice_address = null): Model\EventParticipationBuilder
    {
        $request = new Request("POST", "/v30/events/{obj_id}/sign-up", get_defined_vars());
        $request->enablePathParameters("obj_id");
        $request->enableQueryParameters();
        $request->enableBodyFields("addressee", "email", "tickets", "member_id", "remarks", "invoice_addressee", "invoice_email", "invoice_invoice_reference", "invoice_address");
        return $this->submit($request, Model\EventParticipationBuilder::class);
    }

    /**
     * @return  Model\TicketType[]
     * @generated
     */
    public function listTicketTypes(?int $limit, int $obj_id, string $is_available_for_members = null, string $is_available_for_external = null, array $availability_status = null, string $order = null): array
    {
        $pageNumber = 1;
        $page = null;
        $result = array();
        while (self::isRequestingAllowed($page, $limit)) {
            $page = $this->listTicketTypesPaginated($obj_id, $is_available_for_members, $is_available_for_external, $availability_status, $order, page: $pageNumber);
            $result = array_merge($result, $page->getData());
            $pageNumber++;
        }
        return $result;
    }

    /**
     * @generated
     */
    public function listTicketTypesPaginated(int $obj_id, string $is_available_for_members = null, string $is_available_for_external = null, array $availability_status = null, string $order = null, int $page = null, int $page_size = null): Model\TicketTypePagination
    {
        $request = new Request("GET", "/v30/events/{obj_id}/ticket-types", get_defined_vars());
        $request->enablePathParameters("obj_id");
        $request->enableQueryParameters("is_available_for_members", "is_available_for_external", "availability_status", "page", "page_size", "order");
        $request->enableBodyFields();
        return $this->submit($request, Model\TicketTypePagination::class);
    }

    /**
     * @generated
     */
    public function createTicketType(int $obj_id, string $name, int $vat_category_id, string $availability_status = null, string $available_from = null, string $available_to = null, string $cancel_to = null, string $confirmation_email_text = null, bool $confirmation_email_text_enabled = null, string $description = null, int $event_id = null, int $filter_id = null, int $id = null, string $modified = null, int $num_tickets = null, object $num_tickets_available = null, int $num_tickets_max = null, string $num_tickets_max_per = null, int $num_tickets_sold = null, float $price = null, bool $pricing_enabled = null, object $vat_category = null, string $visibility_level = null, bool $waiting_list_enabled = null, float $participation_certificate_credits = null): Model\EventTicketType
    {
        $request = new Request("POST", "/v30/events/{obj_id}/ticket-types", get_defined_vars());
        $request->enablePathParameters("obj_id");
        $request->enableQueryParameters();
        $request->enableBodyFields("availability_status", "available_from", "available_to", "cancel_to", "confirmation_email_text", "confirmation_email_text_enabled", "description", "event_id", "filter_id", "id", "modified", "name", "num_tickets", "num_tickets_available", "num_tickets_max", "num_tickets_max_per", "num_tickets_sold", "price", "pricing_enabled", "vat_category", "vat_category_id", "visibility_level", "waiting_list_enabled", "participation_certificate_credits");
        return $this->submit($request, Model\EventTicketType::class);
    }

    /**
     * @generated
     */
    public function retrieveTicketType(int $obj_id, int $event_id): Model\EventTicketType
    {
        $request = new Request("GET", "/v30/events/{event_id}/ticket-types/{obj_id}", get_defined_vars());
        $request->enablePathParameters("obj_id", "event_id");
        $request->enableQueryParameters();
        $request->enableBodyFields();
        return $this->submit($request, Model\EventTicketType::class);
    }

    /**
     * @generated
     */
    public function deleteTicketType(int $obj_id, int $event_id): void
    {
        $request = new Request("DELETE", "/v30/events/{event_id}/ticket-types/{obj_id}", get_defined_vars());
        $request->enablePathParameters("obj_id", "event_id");
        $request->enableQueryParameters();
        $request->enableBodyFields();
        $this->submit($request);
    }

    /**
     * @return  Model\GalleryAlbum[]
     * @generated
     */
    public function listGalleryAlbums(?int $limit, string $published = null, string $order = null): array
    {
        $pageNumber = 1;
        $page = null;
        $result = array();
        while (self::isRequestingAllowed($page, $limit)) {
            $page = $this->listGalleryAlbumsPaginated($published, $order, page: $pageNumber);
            $result = array_merge($result, $page->getData());
            $pageNumber++;
        }
        return $result;
    }

    /**
     * @generated
     */
    public function listGalleryAlbumsPaginated(string $published = null, string $order = null, int $page = null, int $page_size = null): Model\GalleryAlbumPagination
    {
        $request = new Request("GET", "/v30/galleries/albums", get_defined_vars());
        $request->enablePathParameters();
        $request->enableQueryParameters("published", "page", "page_size", "order");
        $request->enableBodyFields();
        return $this->submit($request, Model\GalleryAlbumPagination::class);
    }

    /**
     * @generated
     */
    public function retrieveGalleryAlbum(int $obj_id): Model\GalleryAlbum
    {
        $request = new Request("GET", "/v30/galleries/albums/{obj_id}", get_defined_vars());
        $request->enablePathParameters("obj_id");
        $request->enableQueryParameters();
        $request->enableBodyFields();
        return $this->submit($request, Model\GalleryAlbum::class);
    }

    /**
     * @return  Model\GalleryPhoto[]
     * @generated
     */
    public function listGalleryPhotos(?int $limit, int $album_id, string $order = null): array
    {
        $pageNumber = 1;
        $page = null;
        $result = array();
        while (self::isRequestingAllowed($page, $limit)) {
            $page = $this->listGalleryPhotosPaginated($album_id, $order, page: $pageNumber);
            $result = array_merge($result, $page->getData());
            $pageNumber++;
        }
        return $result;
    }

    /**
     * @generated
     */
    public function listGalleryPhotosPaginated(int $album_id, string $order = null, int $page = null, int $page_size = null): Model\GalleryPhotoPagination
    {
        $request = new Request("GET", "/v30/galleries/albums/{album_id}/photos", get_defined_vars());
        $request->enablePathParameters("album_id");
        $request->enableQueryParameters("page", "page_size", "order");
        $request->enableBodyFields();
        return $this->submit($request, Model\GalleryPhotoPagination::class);
    }

    /**
     * @generated
     */
    public function retrieveGalleryPhoto(int $album_id, int $obj_id): Model\GalleryPhoto
    {
        $request = new Request("GET", "/v30/galleries/albums/{album_id}/photos/{obj_id}", get_defined_vars());
        $request->enablePathParameters("album_id", "obj_id");
        $request->enableQueryParameters();
        $request->enableBodyFields();
        return $this->submit($request, Model\GalleryPhoto::class);
    }

    /**
     * @return  Model\GroupFolderListRecursive[]
     * @generated
     */
    public function listGroupFoldersRecursive(?int $limit, string $order = null): array
    {
        $pageNumber = 1;
        $page = null;
        $result = array();
        while (self::isRequestingAllowed($page, $limit)) {
            $page = $this->listGroupFoldersRecursivePaginated($order, page: $pageNumber);
            $result = array_merge($result, $page->getData());
            $pageNumber++;
        }
        return $result;
    }

    /**
     * @generated
     */
    public function listGroupFoldersRecursivePaginated(string $order = null, int $page = null, int $page_size = null): Model\GroupFolderListRecursivePagination
    {
        $request = new Request("GET", "/v30/group-folders/recursive", get_defined_vars());
        $request->enablePathParameters();
        $request->enableQueryParameters("page", "page_size", "order");
        $request->enableBodyFields();
        return $this->submit($request, Model\GroupFolderListRecursivePagination::class);
    }

    /**
     * @return  Model\GroupFolder[]
     * @generated
     */
    public function listGroupFolders(?int $limit, string $published = null, int $parent_id = null, string $order = null): array
    {
        $pageNumber = 1;
        $page = null;
        $result = array();
        while (self::isRequestingAllowed($page, $limit)) {
            $page = $this->listGroupFoldersPaginated($published, $parent_id, $order, page: $pageNumber);
            $result = array_merge($result, $page->getData());
            $pageNumber++;
        }
        return $result;
    }

    /**
     * @generated
     */
    public function listGroupFoldersPaginated(string $published = null, int $parent_id = null, string $order = null, int $page = null, int $page_size = null): Model\GroupFolderPagination
    {
        $request = new Request("GET", "/v30/group-folders", get_defined_vars());
        $request->enablePathParameters();
        $request->enableQueryParameters("published", "parent_id", "page", "page_size", "order");
        $request->enableBodyFields();
        return $this->submit($request, Model\GroupFolderPagination::class);
    }

    /**
     * @generated
     */
    public function createGroupFolder(string $name, string $slug, int $id = null, int $parent_id = null, string $path = null, bool $published = null, string $order_type = null): Model\GroupFolder
    {
        $request = new Request("POST", "/v30/group-folders", get_defined_vars());
        $request->enablePathParameters();
        $request->enableQueryParameters();
        $request->enableBodyFields("id", "parent_id", "name", "slug", "path", "published", "order_type");
        return $this->submit($request, Model\GroupFolder::class);
    }

    /**
     * @generated
     */
    public function retrieveGroupFolder(int $obj_id): Model\GroupFolder
    {
        $request = new Request("GET", "/v30/group-folders/{obj_id}", get_defined_vars());
        $request->enablePathParameters("obj_id");
        $request->enableQueryParameters();
        $request->enableBodyFields();
        return $this->submit($request, Model\GroupFolder::class);
    }

    /**
     * @generated
     */
    public function updateGroupFolder(int $obj_id, string $name, string $slug, int $id = null, int $parent_id = null, string $path = null, bool $published = null, string $order_type = null): Model\GroupFolder
    {
        $request = new Request("PUT", "/v30/group-folders/{obj_id}", get_defined_vars());
        $request->enablePathParameters("obj_id");
        $request->enableQueryParameters();
        $request->enableBodyFields("id", "parent_id", "name", "slug", "path", "published", "order_type");
        return $this->submit($request, Model\GroupFolder::class);
    }

    /**
     * @generated
     */
    public function deleteGroupFolder(int $obj_id): void
    {
        $request = new Request("DELETE", "/v30/group-folders/{obj_id}", get_defined_vars());
        $request->enablePathParameters("obj_id");
        $request->enableQueryParameters();
        $request->enableBodyFields();
        $this->submit($request);
    }

    /**
     * @return  Model\Group[]
     * @generated
     */
    public function listGroups(?int $limit, string $published = null, int $folder_id = null, int $member_id = null, int $socie_app_id = null, string $order = null): array
    {
        $pageNumber = 1;
        $page = null;
        $result = array();
        while (self::isRequestingAllowed($page, $limit)) {
            $page = $this->listGroupsPaginated($published, $folder_id, $member_id, $socie_app_id, $order, page: $pageNumber);
            $result = array_merge($result, $page->getData());
            $pageNumber++;
        }
        return $result;
    }

    /**
     * @generated
     */
    public function listGroupsPaginated(string $published = null, int $folder_id = null, int $member_id = null, int $socie_app_id = null, string $order = null, int $page = null, int $page_size = null): Model\GroupPagination
    {
        $request = new Request("GET", "/v30/groups", get_defined_vars());
        $request->enablePathParameters();
        $request->enableQueryParameters("published", "folder_id", "member_id", "socie_app_id", "page", "page_size", "order");
        $request->enableBodyFields();
        return $this->submit($request, Model\GroupPagination::class);
    }

    /**
     * @generated
     */
    public function retrieveGroup(int $obj_id): Model\GroupWithMemberships
    {
        $request = new Request("GET", "/v30/groups/{obj_id}", get_defined_vars());
        $request->enablePathParameters("obj_id");
        $request->enableQueryParameters();
        $request->enableBodyFields();
        return $this->submit($request, Model\GroupWithMemberships::class);
    }

    /**
     * @generated
     */
    public function updateGroup(int $obj_id, int $id, string $slug, string $start, int $folder_id = null, object $folder = null, string $name = null, object $address = null, object $postal_address = null, string $description = null, string $description_short = null, string $email = null, string $url = null, object $logo = null, string $path = null, bool $published = null, string $end = null, string $memo = null, array $memberships = null): Model\GroupWithMemberships
    {
        $request = new Request("PUT", "/v30/groups/{obj_id}", get_defined_vars());
        $request->enablePathParameters("obj_id");
        $request->enableQueryParameters();
        $request->enableBodyFields("id", "folder_id", "folder", "name", "address", "postal_address", "description", "description_short", "email", "url", "logo", "slug", "path", "published", "start", "end", "memo", "memberships");
        return $this->submit($request, Model\GroupWithMemberships::class);
    }

    /**
     * @generated
     */
    public function deleteGroup(int $obj_id): void
    {
        $request = new Request("DELETE", "/v30/groups/{obj_id}", get_defined_vars());
        $request->enablePathParameters("obj_id");
        $request->enableQueryParameters();
        $request->enableBodyFields();
        $this->submit($request);
    }

    /**
     * @return  Model\GroupMembership[]
     * @generated
     */
    public function listGroupMemberships(?int $limit, int $group_id = null, int $member_id = null, string $order = null): array
    {
        $pageNumber = 1;
        $page = null;
        $result = array();
        while (self::isRequestingAllowed($page, $limit)) {
            $page = $this->listGroupMembershipsPaginated($group_id, $member_id, $order, page: $pageNumber);
            $result = array_merge($result, $page->getData());
            $pageNumber++;
        }
        return $result;
    }

    /**
     * @generated
     */
    public function listGroupMembershipsPaginated(int $group_id = null, int $member_id = null, string $order = null, int $page = null, int $page_size = null): Model\GroupMembershipPagination
    {
        $request = new Request("GET", "/v30/groups/memberships", get_defined_vars());
        $request->enablePathParameters();
        $request->enableQueryParameters("group_id", "member_id", "page", "page_size", "order");
        $request->enableBodyFields();
        return $this->submit($request, Model\GroupMembershipPagination::class);
    }

    /**
     * @generated
     */
    public function createGroupMembership(int $member_id, string $start, int $group_id, int $id = null, string $end = null, string $function = null, bool $may_edit_profile = null, bool $may_manage_memberships = null, bool $may_manage_storage_objects = null, bool $is_self_enroll = null, string $order_type = null, int $order = null, object $group = null): Model\GroupMembership
    {
        $request = new Request("POST", "/v30/groups/memberships", get_defined_vars());
        $request->enablePathParameters();
        $request->enableQueryParameters();
        $request->enableBodyFields("id", "member_id", "start", "end", "function", "may_edit_profile", "may_manage_memberships", "may_manage_storage_objects", "is_self_enroll", "order_type", "order", "group_id", "group");
        return $this->submit($request, Model\GroupMembership::class);
    }

    /**
     * @generated
     */
    public function retrieveGroupMembership(int $obj_id): Model\GroupMembership
    {
        $request = new Request("GET", "/v30/groups/memberships/{obj_id}", get_defined_vars());
        $request->enablePathParameters("obj_id");
        $request->enableQueryParameters();
        $request->enableBodyFields();
        return $this->submit($request, Model\GroupMembership::class);
    }

    /**
     * @generated
     */
    public function updateGroupMembership(int $obj_id, int $member_id, string $start, int $group_id, int $id = null, string $end = null, string $function = null, bool $may_edit_profile = null, bool $may_manage_memberships = null, bool $may_manage_storage_objects = null, bool $is_self_enroll = null, string $order_type = null, int $order = null, object $group = null): Model\GroupMembership
    {
        $request = new Request("PUT", "/v30/groups/memberships/{obj_id}", get_defined_vars());
        $request->enablePathParameters("obj_id");
        $request->enableQueryParameters();
        $request->enableBodyFields("id", "member_id", "start", "end", "function", "may_edit_profile", "may_manage_memberships", "may_manage_storage_objects", "is_self_enroll", "order_type", "order", "group_id", "group");
        return $this->submit($request, Model\GroupMembership::class);
    }

    /**
     * @generated
     */
    public function deleteGroupMembership(int $obj_id): void
    {
        $request = new Request("DELETE", "/v30/groups/memberships/{obj_id}", get_defined_vars());
        $request->enablePathParameters("obj_id");
        $request->enableQueryParameters();
        $request->enableBodyFields();
        $this->submit($request);
    }

    /**
     * @return  Model\Task[]
     * @generated
     */
    public function listTasks(?int $limit, int $author_id = null, int $assignee_id = null, array $subject_type = null, string $is_completed = null, string $order = null): array
    {
        $pageNumber = 1;
        $page = null;
        $result = array();
        while (self::isRequestingAllowed($page, $limit)) {
            $page = $this->listTasksPaginated($author_id, $assignee_id, $subject_type, $is_completed, $order, page: $pageNumber);
            $result = array_merge($result, $page->getData());
            $pageNumber++;
        }
        return $result;
    }

    /**
     * @generated
     */
    public function listTasksPaginated(int $author_id = null, int $assignee_id = null, array $subject_type = null, string $is_completed = null, string $order = null, int $page = null, int $page_size = null): Model\TaskPagination
    {
        $request = new Request("GET", "/v30/tasks", get_defined_vars());
        $request->enablePathParameters();
        $request->enableQueryParameters("author_id", "assignee_id", "subject_type", "is_completed", "page", "page_size", "order");
        $request->enableBodyFields();
        return $this->submit($request, Model\TaskPagination::class);
    }

    /**
     * @generated
     */
    public function updateTask(int $obj_id, string $type, string $subject_type, int $subject_id, int $id = null, string $text = null, int $author_id = null, string $created = null, string $modified = null, object $author = null, object $subject = null, string $assignee_type = null, int $assignee_id = null, object $assignee = null, bool $is_completed = null, string $completed = null, int $completed_by_id = null, object $completed_by = null): Model\Task
    {
        $request = new Request("PUT", "/v30/tasks/{obj_id}", get_defined_vars());
        $request->enablePathParameters("obj_id");
        $request->enableQueryParameters();
        $request->enableBodyFields("id", "type", "text", "subject_type", "subject_id", "author_id", "created", "modified", "author", "subject", "assignee_type", "assignee_id", "assignee", "is_completed", "completed", "completed_by_id", "completed_by");
        return $this->submit($request, Model\Task::class);
    }

    /**
     * @return  Model\MemberStatusList[]
     * @generated
     */
    public function listMemberStatuses(?int $limit, string $archived = null, string $hidden = null, string $deceased = null, string $order = null): array
    {
        $pageNumber = 1;
        $page = null;
        $result = array();
        while (self::isRequestingAllowed($page, $limit)) {
            $page = $this->listMemberStatusesPaginated($archived, $hidden, $deceased, $order, page: $pageNumber);
            $result = array_merge($result, $page->getData());
            $pageNumber++;
        }
        return $result;
    }

    /**
     * @generated
     */
    public function listMemberStatusesPaginated(string $archived = null, string $hidden = null, string $deceased = null, string $order = null, int $page = null, int $page_size = null): Model\MemberStatusListPagination
    {
        $request = new Request("GET", "/v30/member-statuses", get_defined_vars());
        $request->enablePathParameters();
        $request->enableQueryParameters("archived", "hidden", "deceased", "page", "page_size", "order");
        $request->enableBodyFields();
        return $this->submit($request, Model\MemberStatusListPagination::class);
    }

    /**
     * @generated
     */
    public function retrieveMemberStatus(int $obj_id): Model\MemberStatusWithFieldSettings
    {
        $request = new Request("GET", "/v30/member-statuses/{obj_id}", get_defined_vars());
        $request->enablePathParameters("obj_id");
        $request->enableQueryParameters();
        $request->enableBodyFields();
        return $this->submit($request, Model\MemberStatusWithFieldSettings::class);
    }

    /**
     * @generated
     */
    public function updateMemberStatus(int $obj_id, string $name, int $id = null, string $description = null, bool $archived = null, bool $hidden = null, bool $deceased = null, int $order = null, bool $is_available_for_online_sign_up = null, int $registration_product_offer_id = null, object $registration_product_offer = null, int $membership_fee_product_offer_id = null, object $membership_fee_product_offer = null, array $websites = null, array $websites_member_list = null): Model\MemberStatusWithFieldSettings
    {
        $request = new Request("PUT", "/v30/member-statuses/{obj_id}", get_defined_vars());
        $request->enablePathParameters("obj_id");
        $request->enableQueryParameters();
        $request->enableBodyFields("id", "name", "description", "archived", "hidden", "deceased", "order", "is_available_for_online_sign_up", "registration_product_offer_id", "registration_product_offer", "membership_fee_product_offer_id", "membership_fee_product_offer", "websites", "websites_member_list");
        return $this->submit($request, Model\MemberStatusWithFieldSettings::class);
    }

    /**
     * @generated
     */
    public function deleteMemberStatus(int $obj_id): void
    {
        $request = new Request("DELETE", "/v30/member-statuses/{obj_id}", get_defined_vars());
        $request->enablePathParameters("obj_id");
        $request->enableQueryParameters();
        $request->enableBodyFields();
        $this->submit($request);
    }

    /**
     * @return  Model\LogEntry[]
     * @generated
     */
    public function listMemberLogEntries(?int $limit, int $member_id, int $author_id = null, array $type = null, string $order = null): array
    {
        $pageNumber = 1;
        $page = null;
        $result = array();
        while (self::isRequestingAllowed($page, $limit)) {
            $page = $this->listMemberLogEntriesPaginated($member_id, $author_id, $type, $order, page: $pageNumber);
            $result = array_merge($result, $page->getData());
            $pageNumber++;
        }
        return $result;
    }

    /**
     * @generated
     */
    public function listMemberLogEntriesPaginated(int $member_id, int $author_id = null, array $type = null, string $order = null, int $page = null, int $page_size = null): Model\LogEntryPagination
    {
        $request = new Request("GET", "/v30/members/{member_id}/logs", get_defined_vars());
        $request->enablePathParameters("member_id");
        $request->enableQueryParameters("author_id", "type", "page", "page_size", "order");
        $request->enableBodyFields();
        return $this->submit($request, Model\LogEntryPagination::class);
    }

    /**
     * @generated
     */
    public function retrieveMemberLogEntry(int $log_entry_id, int $member_id): Model\LogEntry
    {
        $request = new Request("GET", "/v30/members/{member_id}/logs/{log_entry_id}", get_defined_vars());
        $request->enablePathParameters("log_entry_id", "member_id");
        $request->enableQueryParameters();
        $request->enableBodyFields();
        return $this->submit($request, Model\LogEntry::class);
    }

    /**
     * @generated
     */
    public function deleteMemberLogEntry(int $log_entry_id, int $member_id): void
    {
        $request = new Request("DELETE", "/v30/members/{member_id}/logs/{log_entry_id}", get_defined_vars());
        $request->enablePathParameters("log_entry_id", "member_id");
        $request->enableQueryParameters();
        $request->enableBodyFields();
        $this->submit($request);
    }

    /**
     * @return  Model\Member[]
     * @generated
     */
    public function listMembers(?int $limit, int $status_id = null, int $socie_app_id = null, string $order = null, array $context = null): array
    {
        $pageNumber = 1;
        $page = null;
        $result = array();
        while (self::isRequestingAllowed($page, $limit)) {
            $page = $this->listMembersPaginated($status_id, $socie_app_id, $order, $context, page: $pageNumber);
            $result = array_merge($result, $page->getData());
            $pageNumber++;
        }
        return $result;
    }

    /**
     * @generated
     */
    public function listMembersPaginated(int $status_id = null, int $socie_app_id = null, string $order = null, array $context = null, int $page = null, int $page_size = null): Model\MemberPagination
    {
        $request = new Request("GET", "/v30/members", get_defined_vars());
        $request->enablePathParameters();
        $request->enableQueryParameters("status_id", "socie_app_id", "page", "page_size", "order", "context");
        $request->enableBodyFields();
        return $this->submit($request, Model\MemberPagination::class);
    }

    /**
     * @generated
     */
    public function createMember(int $status_id, int $id, string $primary_last_name_main, array $context = null, string $member_from = null, string $member_to = null, string $username = null, object $status = null, array $statuses = null, object $gender = null, string $prefix = null, string $initials = null, string $nickname = null, string $given_name = null, string $first_name = null, string $primary_last_name_prefix = null, string $primary_last_name = null, string $secondary_last_name_main = null, string $secondary_last_name_prefix = null, string $secondary_last_name = null, string $last_name_display = null, string $last_name = null, string $search_name = null, string $suffix = null, string $date_of_birth = null, string $email = null, object $phone_mobile = null, object $phone_home = null, object $address = null, int $profile_picture_id = null, object $profile_picture = null, int $formal_picture_id = null, object $formal_picture = null, bool $deleted = null, bool $receive_sms = null, bool $receive_mailings = null, bool $show_almanac = null, bool $show_almanac_addresses = null, bool $show_almanac_phonenumbers = null, bool $show_almanac_email = null, bool $show_almanac_date_of_birth = null, bool $show_almanac_custom_fields = null, string $modified = null, string $memo = null, object $bank_account = null): Model\Member
    {
        $request = new Request("POST", "/v30/members", get_defined_vars());
        $request->enablePathParameters();
        $request->enableQueryParameters("context");
        $request->enableBodyFields("status_id", "member_from", "member_to", "id", "username", "status", "statuses", "gender", "prefix", "initials", "nickname", "given_name", "first_name", "primary_last_name_main", "primary_last_name_prefix", "primary_last_name", "secondary_last_name_main", "secondary_last_name_prefix", "secondary_last_name", "last_name_display", "last_name", "search_name", "suffix", "date_of_birth", "email", "phone_mobile", "phone_home", "address", "profile_picture_id", "profile_picture", "formal_picture_id", "formal_picture", "deleted", "receive_sms", "receive_mailings", "show_almanac", "show_almanac_addresses", "show_almanac_phonenumbers", "show_almanac_email", "show_almanac_date_of_birth", "show_almanac_custom_fields", "modified", "memo", "bank_account");
        return $this->submit($request, Model\Member::class);
    }

    /**
     * @generated
     */
    public function retrieveMember(int $obj_id, array $context = null): Model\MemberWithCustomFields
    {
        $request = new Request("GET", "/v30/members/{obj_id}", get_defined_vars());
        $request->enablePathParameters("obj_id");
        $request->enableQueryParameters("context");
        $request->enableBodyFields();
        return $this->submit($request, Model\MemberWithCustomFields::class);
    }

    /**
     * @generated
     */
    public function updateMember(int $obj_id, int $id, array $context = null, string $username = null, object $status = null, array $statuses = null, object $gender = null, string $prefix = null, string $initials = null, string $nickname = null, string $given_name = null, string $first_name = null, string $primary_last_name_main = null, string $primary_last_name_prefix = null, string $primary_last_name = null, string $secondary_last_name_main = null, string $secondary_last_name_prefix = null, string $secondary_last_name = null, string $last_name_display = null, string $last_name = null, string $search_name = null, string $suffix = null, string $date_of_birth = null, string $email = null, object $phone_mobile = null, object $phone_home = null, object $address = null, int $profile_picture_id = null, object $profile_picture = null, int $formal_picture_id = null, object $formal_picture = null, bool $deleted = null, bool $receive_sms = null, bool $receive_mailings = null, bool $show_almanac = null, bool $show_almanac_addresses = null, bool $show_almanac_phonenumbers = null, bool $show_almanac_email = null, bool $show_almanac_date_of_birth = null, bool $show_almanac_custom_fields = null, string $modified = null, string $memo = null, object $bank_account = null, object $custom_fields = null): Model\MemberWithCustomFields
    {
        $request = new Request("PUT", "/v30/members/{obj_id}", get_defined_vars());
        $request->enablePathParameters("obj_id");
        $request->enableQueryParameters("context");
        $request->enableBodyFields("id", "username", "status", "statuses", "gender", "prefix", "initials", "nickname", "given_name", "first_name", "primary_last_name_main", "primary_last_name_prefix", "primary_last_name", "secondary_last_name_main", "secondary_last_name_prefix", "secondary_last_name", "last_name_display", "last_name", "search_name", "suffix", "date_of_birth", "email", "phone_mobile", "phone_home", "address", "profile_picture_id", "profile_picture", "formal_picture_id", "formal_picture", "deleted", "receive_sms", "receive_mailings", "show_almanac", "show_almanac_addresses", "show_almanac_phonenumbers", "show_almanac_email", "show_almanac_date_of_birth", "show_almanac_custom_fields", "modified", "memo", "bank_account", "custom_fields");
        return $this->submit($request, Model\MemberWithCustomFields::class);
    }

    /**
     * @generated
     */
    public function deleteMember(int $obj_id): void
    {
        $request = new Request("DELETE", "/v30/members/{obj_id}", get_defined_vars());
        $request->enablePathParameters("obj_id");
        $request->enableQueryParameters();
        $request->enableBodyFields();
        $this->submit($request);
    }

    /**
     * @return  Model\MembershipStatus[]
     * @generated
     */
    public function listMembershipStatuses(?int $limit, int $obj_id, string $order = null): array
    {
        $pageNumber = 1;
        $page = null;
        $result = array();
        while (self::isRequestingAllowed($page, $limit)) {
            $page = $this->listMembershipStatusesPaginated($obj_id, $order, page: $pageNumber);
            $result = array_merge($result, $page->getData());
            $pageNumber++;
        }
        return $result;
    }

    /**
     * @generated
     */
    public function listMembershipStatusesPaginated(int $obj_id, string $order = null, int $page = null, int $page_size = null): Model\MembershipStatusPagination
    {
        $request = new Request("GET", "/v30/members/{obj_id}/statuses", get_defined_vars());
        $request->enablePathParameters("obj_id");
        $request->enableQueryParameters("page", "page_size", "order");
        $request->enableBodyFields();
        return $this->submit($request, Model\MembershipStatusPagination::class);
    }

    /**
     * @generated
     */
    public function createMembershipStatus(int $obj_id, int $status_id, int $id = null, string $name = null, string $member_from = null, string $member_to = null, bool $archived = null, bool $deceased = null): Model\MembershipStatus
    {
        $request = new Request("POST", "/v30/members/{obj_id}/statuses", get_defined_vars());
        $request->enablePathParameters("obj_id");
        $request->enableQueryParameters();
        $request->enableBodyFields("id", "name", "status_id", "member_from", "member_to", "archived", "deceased");
        return $this->submit($request, Model\MembershipStatus::class);
    }

    /**
     * @generated
     */
    public function retrieveMembershipStatus(int $obj_id, int $membership_status_id): Model\MembershipStatus
    {
        $request = new Request("GET", "/v30/members/{obj_id}/statuses/{membership_status_id}", get_defined_vars());
        $request->enablePathParameters("obj_id", "membership_status_id");
        $request->enableQueryParameters();
        $request->enableBodyFields();
        return $this->submit($request, Model\MembershipStatus::class);
    }

    /**
     * @generated
     */
    public function updateMembershipStatus(int $obj_id, int $membership_status_id, int $status_id, int $id = null, string $name = null, string $member_from = null, string $member_to = null, bool $archived = null, bool $deceased = null): Model\MembershipStatus
    {
        $request = new Request("PUT", "/v30/members/{obj_id}/statuses/{membership_status_id}", get_defined_vars());
        $request->enablePathParameters("obj_id", "membership_status_id");
        $request->enableQueryParameters();
        $request->enableBodyFields("id", "name", "status_id", "member_from", "member_to", "archived", "deceased");
        return $this->submit($request, Model\MembershipStatus::class);
    }

    /**
     * @generated
     */
    public function deleteMembershipStatus(int $obj_id, int $membership_status_id): void
    {
        $request = new Request("DELETE", "/v30/members/{obj_id}/statuses/{membership_status_id}", get_defined_vars());
        $request->enablePathParameters("obj_id", "membership_status_id");
        $request->enableQueryParameters();
        $request->enableBodyFields();
        $this->submit($request);
    }

    /**
     * @return  Model\ElasticMember[]
     * @generated
     */
    public function searchMembers(?int $limit, string $term, string $order = null): array
    {
        $pageNumber = 1;
        $page = null;
        $result = array();
        while (self::isRequestingAllowed($page, $limit)) {
            $page = $this->searchMembersPaginated($term, $order, page: $pageNumber);
            $result = array_merge($result, $page->getData());
            $pageNumber++;
        }
        return $result;
    }

    /**
     * @generated
     */
    public function searchMembersPaginated(string $term, string $order = null, int $page = null, int $page_size = null): Model\ElasticMemberPagination
    {
        $request = new Request("GET", "/v30/members/search", get_defined_vars());
        $request->enablePathParameters();
        $request->enableQueryParameters("term", "page", "page_size", "order");
        $request->enableBodyFields();
        return $this->submit($request, Model\ElasticMemberPagination::class);
    }

    /**
     * @return  Model\News[]
     * @generated
     */
    public function listNews(?int $limit, string $period_filter = null, string $actual = null, string $comments_open = null, array $visibility = null, string $order = null): array
    {
        $pageNumber = 1;
        $page = null;
        $result = array();
        while (self::isRequestingAllowed($page, $limit)) {
            $page = $this->listNewsPaginated($period_filter, $actual, $comments_open, $visibility, $order, page: $pageNumber);
            $result = array_merge($result, $page->getData());
            $pageNumber++;
        }
        return $result;
    }

    /**
     * @generated
     */
    public function listNewsPaginated(string $period_filter = null, string $actual = null, string $comments_open = null, array $visibility = null, string $order = null, int $page = null, int $page_size = null): Model\NewsPagination
    {
        $request = new Request("GET", "/v30/news", get_defined_vars());
        $request->enablePathParameters();
        $request->enableQueryParameters("period_filter", "actual", "comments_open", "visibility", "page", "page_size", "order");
        $request->enableBodyFields();
        return $this->submit($request, Model\NewsPagination::class);
    }

    /**
     * @generated
     */
    public function createNews(string $title, string $published_from, string $actual_to, int $id = null, object $content = null, bool $is_published = null, bool $is_actual = null, array $media = null, array $comments = null, string $memo = null, array $websites = null): Model\News
    {
        $request = new Request("POST", "/v30/news", get_defined_vars());
        $request->enablePathParameters();
        $request->enableQueryParameters();
        $request->enableBodyFields("id", "title", "content", "published_from", "actual_to", "is_published", "is_actual", "media", "comments", "memo", "websites");
        return $this->submit($request, Model\News::class);
    }

    /**
     * @generated
     */
    public function retrieveNews(int $obj_id): Model\News
    {
        $request = new Request("GET", "/v30/news/{obj_id}", get_defined_vars());
        $request->enablePathParameters("obj_id");
        $request->enableQueryParameters();
        $request->enableBodyFields();
        return $this->submit($request, Model\News::class);
    }

    /**
     * @generated
     */
    public function updateNews(int $obj_id, string $title, string $published_from, string $actual_to, int $id = null, object $content = null, bool $is_published = null, bool $is_actual = null, array $media = null, array $comments = null, string $memo = null, array $websites = null): Model\News
    {
        $request = new Request("PUT", "/v30/news/{obj_id}", get_defined_vars());
        $request->enablePathParameters("obj_id");
        $request->enableQueryParameters();
        $request->enableBodyFields("id", "title", "content", "published_from", "actual_to", "is_published", "is_actual", "media", "comments", "memo", "websites");
        return $this->submit($request, Model\News::class);
    }

    /**
     * @generated
     */
    public function deleteNews(int $obj_id): void
    {
        $request = new Request("DELETE", "/v30/news/{obj_id}", get_defined_vars());
        $request->enablePathParameters("obj_id");
        $request->enableQueryParameters();
        $request->enableBodyFields();
        $this->submit($request);
    }

    /**
     * @return  Model\Notification[]
     * @generated
     */
    public function listNotifications(?int $limit, string $order = null): array
    {
        $pageNumber = 1;
        $page = null;
        $result = array();
        while (self::isRequestingAllowed($page, $limit)) {
            $page = $this->listNotificationsPaginated($order, page: $pageNumber);
            $result = array_merge($result, $page->getData());
            $pageNumber++;
        }
        return $result;
    }

    /**
     * @generated
     */
    public function listNotificationsPaginated(string $order = null, int $page = null, int $page_size = null): Model\NotificationPagination
    {
        $request = new Request("GET", "/v30/notifications", get_defined_vars());
        $request->enablePathParameters();
        $request->enableQueryParameters("page", "page_size", "order");
        $request->enableBodyFields();
        return $this->submit($request, Model\NotificationPagination::class);
    }

    /**
     * @return  Model\OrganisationCategory[]
     * @generated
     */
    public function listOrganisationCategories(?int $limit, string $order = null): array
    {
        $pageNumber = 1;
        $page = null;
        $result = array();
        while (self::isRequestingAllowed($page, $limit)) {
            $page = $this->listOrganisationCategoriesPaginated($order, page: $pageNumber);
            $result = array_merge($result, $page->getData());
            $pageNumber++;
        }
        return $result;
    }

    /**
     * @generated
     */
    public function listOrganisationCategoriesPaginated(string $order = null, int $page = null, int $page_size = null): Model\OrganisationCategoryPagination
    {
        $request = new Request("GET", "/v30/organisations/categories", get_defined_vars());
        $request->enablePathParameters();
        $request->enableQueryParameters("page", "page_size", "order");
        $request->enableBodyFields();
        return $this->submit($request, Model\OrganisationCategoryPagination::class);
    }

    /**
     * @generated
     */
    public function createOrganisationCategory(string $name, int $id = null, string $color = null, object $slug = null, bool $published = null, object $visibility = null, array $websites = null, string $order_type = null): Model\OrganisationCategory
    {
        $request = new Request("POST", "/v30/organisations/categories", get_defined_vars());
        $request->enablePathParameters();
        $request->enableQueryParameters();
        $request->enableBodyFields("id", "name", "color", "slug", "published", "visibility", "websites", "order_type");
        return $this->submit($request, Model\OrganisationCategory::class);
    }

    /**
     * @generated
     */
    public function retrieveOrganisationCategory(int $obj_id): Model\OrganisationCategory
    {
        $request = new Request("GET", "/v30/organisations/categories/{obj_id}", get_defined_vars());
        $request->enablePathParameters("obj_id");
        $request->enableQueryParameters();
        $request->enableBodyFields();
        return $this->submit($request, Model\OrganisationCategory::class);
    }

    /**
     * @generated
     */
    public function updateOrganisationCategory(int $obj_id, string $name, int $id = null, string $color = null, object $slug = null, bool $published = null, object $visibility = null, array $websites = null, string $order_type = null): Model\OrganisationCategory
    {
        $request = new Request("PUT", "/v30/organisations/categories/{obj_id}", get_defined_vars());
        $request->enablePathParameters("obj_id");
        $request->enableQueryParameters();
        $request->enableBodyFields("id", "name", "color", "slug", "published", "visibility", "websites", "order_type");
        return $this->submit($request, Model\OrganisationCategory::class);
    }

    /**
     * @generated
     */
    public function deleteOrganisationCategory(int $obj_id): void
    {
        $request = new Request("DELETE", "/v30/organisations/categories/{obj_id}", get_defined_vars());
        $request->enablePathParameters("obj_id");
        $request->enableQueryParameters();
        $request->enableBodyFields();
        $this->submit($request);
    }

    /**
     * @return  Model\Organisation[]
     * @generated
     */
    public function listOrganisations(?int $limit, int $category_id = null, array $sbi_code = null, array $legal_form = null, int $member_id = null, string $order = null): array
    {
        $pageNumber = 1;
        $page = null;
        $result = array();
        while (self::isRequestingAllowed($page, $limit)) {
            $page = $this->listOrganisationsPaginated($category_id, $sbi_code, $legal_form, $member_id, $order, page: $pageNumber);
            $result = array_merge($result, $page->getData());
            $pageNumber++;
        }
        return $result;
    }

    /**
     * @generated
     */
    public function listOrganisationsPaginated(int $category_id = null, array $sbi_code = null, array $legal_form = null, int $member_id = null, string $order = null, int $page = null, int $page_size = null): Model\OrganisationPagination
    {
        $request = new Request("GET", "/v30/organisations", get_defined_vars());
        $request->enablePathParameters();
        $request->enableQueryParameters("category_id", "sbi_code", "legal_form", "member_id", "page", "page_size", "order");
        $request->enableBodyFields();
        return $this->submit($request, Model\OrganisationPagination::class);
    }

    /**
     * @generated
     */
    public function createOrganisation(int $id, string $slug, int $category_id, string $invoice_address_field, string $name = null, object $category = null, object $address = null, object $postal_address = null, string $description = null, string $description_short = null, string $email = null, string $url = null, object $logo = null, string $memo = null, string $invoice_reference = null, string $invoice_addressee_attention = null, string $invoice_email = null): Model\Organisation
    {
        $request = new Request("POST", "/v30/organisations", get_defined_vars());
        $request->enablePathParameters();
        $request->enableQueryParameters();
        $request->enableBodyFields("id", "name", "slug", "category_id", "category", "address", "postal_address", "description", "description_short", "email", "url", "logo", "memo", "invoice_reference", "invoice_addressee_attention", "invoice_address_field", "invoice_email");
        return $this->submit($request, Model\Organisation::class);
    }

    /**
     * @generated
     */
    public function retrieveOrganisation(int $obj_id): Model\Organisation
    {
        $request = new Request("GET", "/v30/organisations/{obj_id}", get_defined_vars());
        $request->enablePathParameters("obj_id");
        $request->enableQueryParameters();
        $request->enableBodyFields();
        return $this->submit($request, Model\Organisation::class);
    }

    /**
     * @generated
     */
    public function updateOrganisation(int $obj_id, int $id, string $slug, int $category_id, string $invoice_address_field, string $name = null, object $category = null, object $address = null, object $postal_address = null, string $description = null, string $description_short = null, string $email = null, string $url = null, object $logo = null, string $memo = null, string $invoice_reference = null, string $invoice_addressee_attention = null, string $invoice_email = null): Model\Organisation
    {
        $request = new Request("PUT", "/v30/organisations/{obj_id}", get_defined_vars());
        $request->enablePathParameters("obj_id");
        $request->enableQueryParameters();
        $request->enableBodyFields("id", "name", "slug", "category_id", "category", "address", "postal_address", "description", "description_short", "email", "url", "logo", "memo", "invoice_reference", "invoice_addressee_attention", "invoice_address_field", "invoice_email");
        return $this->submit($request, Model\Organisation::class);
    }

    /**
     * @generated
     */
    public function deleteOrganisation(int $obj_id): void
    {
        $request = new Request("DELETE", "/v30/organisations/{obj_id}", get_defined_vars());
        $request->enablePathParameters("obj_id");
        $request->enableQueryParameters();
        $request->enableBodyFields();
        $this->submit($request);
    }

    /**
     * @return  Model\OrganisationMembership[]
     * @generated
     */
    public function listOrganisationMemberships(?int $limit, int $organisation_id = null, int $member_id = null, string $order = null): array
    {
        $pageNumber = 1;
        $page = null;
        $result = array();
        while (self::isRequestingAllowed($page, $limit)) {
            $page = $this->listOrganisationMembershipsPaginated($organisation_id, $member_id, $order, page: $pageNumber);
            $result = array_merge($result, $page->getData());
            $pageNumber++;
        }
        return $result;
    }

    /**
     * @generated
     */
    public function listOrganisationMembershipsPaginated(int $organisation_id = null, int $member_id = null, string $order = null, int $page = null, int $page_size = null): Model\OrganisationMembershipPagination
    {
        $request = new Request("GET", "/v30/organisations/memberships", get_defined_vars());
        $request->enablePathParameters();
        $request->enableQueryParameters("organisation_id", "member_id", "page", "page_size", "order");
        $request->enableBodyFields();
        return $this->submit($request, Model\OrganisationMembershipPagination::class);
    }

    /**
     * @generated
     */
    public function createOrganisationMembership(int $member_id, string $start, int $organisation_id, int $id = null, string $end = null, string $function = null, bool $may_edit_profile = null, bool $may_manage_memberships = null, bool $may_manage_storage_objects = null, bool $is_self_enroll = null, string $order_type = null, int $order = null, object $organisation = null): Model\OrganisationMembership
    {
        $request = new Request("POST", "/v30/organisations/memberships", get_defined_vars());
        $request->enablePathParameters();
        $request->enableQueryParameters();
        $request->enableBodyFields("id", "member_id", "start", "end", "function", "may_edit_profile", "may_manage_memberships", "may_manage_storage_objects", "is_self_enroll", "order_type", "order", "organisation_id", "organisation");
        return $this->submit($request, Model\OrganisationMembership::class);
    }

    /**
     * @generated
     */
    public function retrieveOrganisationMembership(int $obj_id): Model\OrganisationMembership
    {
        $request = new Request("GET", "/v30/organisations/memberships/{obj_id}", get_defined_vars());
        $request->enablePathParameters("obj_id");
        $request->enableQueryParameters();
        $request->enableBodyFields();
        return $this->submit($request, Model\OrganisationMembership::class);
    }

    /**
     * @generated
     */
    public function updateOrganisationMembership(int $obj_id, int $member_id, string $start, int $organisation_id, int $id = null, string $end = null, string $function = null, bool $may_edit_profile = null, bool $may_manage_memberships = null, bool $may_manage_storage_objects = null, bool $is_self_enroll = null, string $order_type = null, int $order = null, object $organisation = null): Model\OrganisationMembership
    {
        $request = new Request("PUT", "/v30/organisations/memberships/{obj_id}", get_defined_vars());
        $request->enablePathParameters("obj_id");
        $request->enableQueryParameters();
        $request->enableBodyFields("id", "member_id", "start", "end", "function", "may_edit_profile", "may_manage_memberships", "may_manage_storage_objects", "is_self_enroll", "order_type", "order", "organisation_id", "organisation");
        return $this->submit($request, Model\OrganisationMembership::class);
    }

    /**
     * @generated
     */
    public function deleteOrganisationMembership(int $obj_id): void
    {
        $request = new Request("DELETE", "/v30/organisations/memberships/{obj_id}", get_defined_vars());
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
        $request = new Request("GET", "/v30/pricing", get_defined_vars());
        $request->enablePathParameters();
        $request->enableQueryParameters("members", "plan");
        $request->enableBodyFields();
        return $this->submit($request, Model\PricingResponse::class);
    }

    /**
     * @return  Model\ProductFolderListRecursive[]
     * @generated
     */
    public function listProductFoldersRecursive(?int $limit, string $published = null, int $parent_id = null, string $order = null): array
    {
        $pageNumber = 1;
        $page = null;
        $result = array();
        while (self::isRequestingAllowed($page, $limit)) {
            $page = $this->listProductFoldersRecursivePaginated($published, $parent_id, $order, page: $pageNumber);
            $result = array_merge($result, $page->getData());
            $pageNumber++;
        }
        return $result;
    }

    /**
     * @generated
     */
    public function listProductFoldersRecursivePaginated(string $published = null, int $parent_id = null, string $order = null, int $page = null, int $page_size = null): Model\ProductFolderListRecursivePagination
    {
        $request = new Request("GET", "/v30/product-folders/recursive", get_defined_vars());
        $request->enablePathParameters();
        $request->enableQueryParameters("published", "parent_id", "page", "page_size", "order");
        $request->enableBodyFields();
        return $this->submit($request, Model\ProductFolderListRecursivePagination::class);
    }

    /**
     * @return  Model\ProductFolder[]
     * @generated
     */
    public function listProductFolders(?int $limit, string $published = null, int $parent_id = null, string $order = null): array
    {
        $pageNumber = 1;
        $page = null;
        $result = array();
        while (self::isRequestingAllowed($page, $limit)) {
            $page = $this->listProductFoldersPaginated($published, $parent_id, $order, page: $pageNumber);
            $result = array_merge($result, $page->getData());
            $pageNumber++;
        }
        return $result;
    }

    /**
     * @generated
     */
    public function listProductFoldersPaginated(string $published = null, int $parent_id = null, string $order = null, int $page = null, int $page_size = null): Model\ProductFolderPagination
    {
        $request = new Request("GET", "/v30/product-folders", get_defined_vars());
        $request->enablePathParameters();
        $request->enableQueryParameters("published", "parent_id", "page", "page_size", "order");
        $request->enableBodyFields();
        return $this->submit($request, Model\ProductFolderPagination::class);
    }

    /**
     * @generated
     */
    public function createProductFolder(string $name, string $slug, int $id = null, int $parent_id = null, bool $published = null, string $path = null): Model\ProductFolder
    {
        $request = new Request("POST", "/v30/product-folders", get_defined_vars());
        $request->enablePathParameters();
        $request->enableQueryParameters();
        $request->enableBodyFields("id", "parent_id", "name", "slug", "published", "path");
        return $this->submit($request, Model\ProductFolder::class);
    }

    /**
     * @generated
     */
    public function retrieveProductFolder(int $obj_id): Model\ProductFolder
    {
        $request = new Request("GET", "/v30/product-folders/{obj_id}", get_defined_vars());
        $request->enablePathParameters("obj_id");
        $request->enableQueryParameters();
        $request->enableBodyFields();
        return $this->submit($request, Model\ProductFolder::class);
    }

    /**
     * @generated
     */
    public function updateProductFolder(int $obj_id, string $name, string $slug, int $id = null, int $parent_id = null, bool $published = null, string $path = null): Model\ProductFolder
    {
        $request = new Request("PUT", "/v30/product-folders/{obj_id}", get_defined_vars());
        $request->enablePathParameters("obj_id");
        $request->enableQueryParameters();
        $request->enableBodyFields("id", "parent_id", "name", "slug", "published", "path");
        return $this->submit($request, Model\ProductFolder::class);
    }

    /**
     * @generated
     */
    public function deleteProductFolder(int $obj_id): void
    {
        $request = new Request("DELETE", "/v30/product-folders/{obj_id}", get_defined_vars());
        $request->enablePathParameters("obj_id");
        $request->enableQueryParameters();
        $request->enableBodyFields();
        $this->submit($request);
    }

    /**
     * @return  Model\Product[]
     * @generated
     */
    public function listProducts(?int $limit, string $published = null, string $status = null, int $folder_id = null, string $order = null): array
    {
        $pageNumber = 1;
        $page = null;
        $result = array();
        while (self::isRequestingAllowed($page, $limit)) {
            $page = $this->listProductsPaginated($published, $status, $folder_id, $order, page: $pageNumber);
            $result = array_merge($result, $page->getData());
            $pageNumber++;
        }
        return $result;
    }

    /**
     * @generated
     */
    public function listProductsPaginated(string $published = null, string $status = null, int $folder_id = null, string $order = null, int $page = null, int $page_size = null): Model\ProductPagination
    {
        $request = new Request("GET", "/v30/products", get_defined_vars());
        $request->enablePathParameters();
        $request->enableQueryParameters("published", "status", "folder_id", "page", "page_size", "order");
        $request->enableBodyFields();
        return $this->submit($request, Model\ProductPagination::class);
    }

    /**
     * @generated
     */
    public function createProduct(int $id = null, int $product_offer_id = null, object $folder = null, string $name = null, string $description = null, array $media = null, bool $published = null, float $price = null, object $vat_category = null, float $vat_percentage = null, string $type = null, bool $is_archived = null, string $created = null, string $modified = null, string $memo = null): Model\Product
    {
        $request = new Request("POST", "/v30/products", get_defined_vars());
        $request->enablePathParameters();
        $request->enableQueryParameters();
        $request->enableBodyFields("id", "product_offer_id", "folder", "name", "description", "media", "published", "price", "vat_category", "vat_percentage", "type", "is_archived", "created", "modified", "memo");
        return $this->submit($request, Model\Product::class);
    }

    /**
     * @generated
     */
    public function retrieveProduct(int $obj_id): Model\Product
    {
        $request = new Request("GET", "/v30/products/{obj_id}", get_defined_vars());
        $request->enablePathParameters("obj_id");
        $request->enableQueryParameters();
        $request->enableBodyFields();
        return $this->submit($request, Model\Product::class);
    }

    /**
     * @generated
     */
    public function updateProduct(int $obj_id, int $id = null, int $product_offer_id = null, object $folder = null, string $name = null, string $description = null, array $media = null, bool $published = null, float $price = null, object $vat_category = null, float $vat_percentage = null, string $type = null, bool $is_archived = null, string $created = null, string $modified = null, string $memo = null): Model\Product
    {
        $request = new Request("PUT", "/v30/products/{obj_id}", get_defined_vars());
        $request->enablePathParameters("obj_id");
        $request->enableQueryParameters();
        $request->enableBodyFields("id", "product_offer_id", "folder", "name", "description", "media", "published", "price", "vat_category", "vat_percentage", "type", "is_archived", "created", "modified", "memo");
        return $this->submit($request, Model\Product::class);
    }

    /**
     * @generated
     */
    public function deleteProduct(int $obj_id): void
    {
        $request = new Request("DELETE", "/v30/products/{obj_id}", get_defined_vars());
        $request->enablePathParameters("obj_id");
        $request->enableQueryParameters();
        $request->enableBodyFields();
        $this->submit($request);
    }

    /**
     * @return  Model\LogEntry[]
     * @generated
     */
    public function listSaleInvoiceLogEntries(?int $limit, int $obj_id, int $author_id = null, array $type = null, string $order = null): array
    {
        $pageNumber = 1;
        $page = null;
        $result = array();
        while (self::isRequestingAllowed($page, $limit)) {
            $page = $this->listSaleInvoiceLogEntriesPaginated($obj_id, $author_id, $type, $order, page: $pageNumber);
            $result = array_merge($result, $page->getData());
            $pageNumber++;
        }
        return $result;
    }

    /**
     * @generated
     */
    public function listSaleInvoiceLogEntriesPaginated(int $obj_id, int $author_id = null, array $type = null, string $order = null, int $page = null, int $page_size = null): Model\LogEntryPagination
    {
        $request = new Request("GET", "/v30/sale-invoices/{obj_id}/logs", get_defined_vars());
        $request->enablePathParameters("obj_id");
        $request->enableQueryParameters("author_id", "type", "page", "page_size", "order");
        $request->enableBodyFields();
        return $this->submit($request, Model\LogEntryPagination::class);
    }

    /**
     * @generated
     */
    public function retrieveSaleInvoiceLogEntry(int $log_entry_id, int $obj_id): Model\LogEntry
    {
        $request = new Request("GET", "/v30/sale-invoices/{obj_id}/logs/{log_entry_id}", get_defined_vars());
        $request->enablePathParameters("log_entry_id", "obj_id");
        $request->enableQueryParameters();
        $request->enableBodyFields();
        return $this->submit($request, Model\LogEntry::class);
    }

    /**
     * @generated
     */
    public function deleteSaleInvoiceLogEntry(int $log_entry_id, int $obj_id): void
    {
        $request = new Request("DELETE", "/v30/sale-invoices/{obj_id}/logs/{log_entry_id}", get_defined_vars());
        $request->enablePathParameters("log_entry_id", "obj_id");
        $request->enableQueryParameters();
        $request->enableBodyFields();
        $this->submit($request);
    }

    /**
     * @return  Model\SaleInvoice[]
     * @generated
     */
    public function listSaleInvoices(?int $limit, int $entity_id = null, string $period_filter = null, array $invoice_status = null, array $invoice_num_reminders_send = null, array $invoice_type = null, array $category = null, int $product_offer_id = null, int $member_id = null, int $collection_id = null, string $use_direct_debit = null, string $contribution_start = null, string $contribution_end = null, string $order = null): array
    {
        $pageNumber = 1;
        $page = null;
        $result = array();
        while (self::isRequestingAllowed($page, $limit)) {
            $page = $this->listSaleInvoicesPaginated($entity_id, $period_filter, $invoice_status, $invoice_num_reminders_send, $invoice_type, $category, $product_offer_id, $member_id, $collection_id, $use_direct_debit, $contribution_start, $contribution_end, $order, page: $pageNumber);
            $result = array_merge($result, $page->getData());
            $pageNumber++;
        }
        return $result;
    }

    /**
     * @generated
     */
    public function listSaleInvoicesPaginated(int $entity_id = null, string $period_filter = null, array $invoice_status = null, array $invoice_num_reminders_send = null, array $invoice_type = null, array $category = null, int $product_offer_id = null, int $member_id = null, int $collection_id = null, string $use_direct_debit = null, string $contribution_start = null, string $contribution_end = null, string $order = null, int $page = null, int $page_size = null): Model\SaleInvoicePagination
    {
        $request = new Request("GET", "/v30/sale-invoices", get_defined_vars());
        $request->enablePathParameters();
        $request->enableQueryParameters("entity_id", "period_filter", "invoice_status", "invoice_num_reminders_send", "invoice_type", "category", "product_offer_id", "member_id", "collection_id", "use_direct_debit", "contribution_start", "contribution_end", "page", "page_size", "order");
        $request->enableBodyFields();
        return $this->submit($request, Model\SaleInvoicePagination::class);
    }

    /**
     * @generated
     */
    public function retrieveSaleInvoice(int $obj_id): Model\SaleInvoice
    {
        $request = new Request("GET", "/v30/sale-invoices/{obj_id}", get_defined_vars());
        $request->enablePathParameters("obj_id");
        $request->enableQueryParameters();
        $request->enableBodyFields();
        return $this->submit($request, Model\SaleInvoice::class);
    }

    /**
     * @generated
     */
    public function deleteSaleInvoice(int $obj_id): void
    {
        $request = new Request("DELETE", "/v30/sale-invoices/{obj_id}", get_defined_vars());
        $request->enablePathParameters("obj_id");
        $request->enableQueryParameters();
        $request->enableBodyFields();
        $this->submit($request);
    }

    /**
     * @generated
     */
    public function remindASaleInvoice(int $obj_id): void
    {
        $request = new Request("POST", "/v30/sale-invoices/{obj_id}/remind", get_defined_vars());
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
        $request = new Request("POST", "/v30/sale-invoices/{obj_id}/mark-uncollectible", get_defined_vars());
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
        $request = new Request("POST", "/v30/sale-invoices/{obj_id}/mark-collectible", get_defined_vars());
        $request->enablePathParameters("obj_id");
        $request->enableQueryParameters();
        $request->enableBodyFields();
        $this->submit($request);
    }

    /**
     * @return  Model\SaleInvoiceItem[]
     * @generated
     */
    public function listSaleInvoiceItems(?int $limit, int $obj_id, string $order = null): array
    {
        $pageNumber = 1;
        $page = null;
        $result = array();
        while (self::isRequestingAllowed($page, $limit)) {
            $page = $this->listSaleInvoiceItemsPaginated($obj_id, $order, page: $pageNumber);
            $result = array_merge($result, $page->getData());
            $pageNumber++;
        }
        return $result;
    }

    /**
     * @generated
     */
    public function listSaleInvoiceItemsPaginated(int $obj_id, string $order = null, int $page = null, int $page_size = null): Model\SaleInvoiceItemPagination
    {
        $request = new Request("GET", "/v30/sale-invoices/{obj_id}/items", get_defined_vars());
        $request->enablePathParameters("obj_id");
        $request->enableQueryParameters("page", "page_size", "order");
        $request->enableBodyFields();
        return $this->submit($request, Model\SaleInvoiceItemPagination::class);
    }

    /**
     * @return  Model\SaleInvoiceWorkflow[]
     * @generated
     */
    public function listSaleInvoiceWorkflows(?int $limit, string $order = null): array
    {
        $pageNumber = 1;
        $page = null;
        $result = array();
        while (self::isRequestingAllowed($page, $limit)) {
            $page = $this->listSaleInvoiceWorkflowsPaginated($order, page: $pageNumber);
            $result = array_merge($result, $page->getData());
            $pageNumber++;
        }
        return $result;
    }

    /**
     * @generated
     */
    public function listSaleInvoiceWorkflowsPaginated(string $order = null, int $page = null, int $page_size = null): Model\SaleInvoiceWorkflowPagination
    {
        $request = new Request("GET", "/v30/sale-invoices/workflows", get_defined_vars());
        $request->enablePathParameters();
        $request->enableQueryParameters("page", "page_size", "order");
        $request->enableBodyFields();
        return $this->submit($request, Model\SaleInvoiceWorkflowPagination::class);
    }

    /**
     * @return  Model\StorageObject[]
     * @generated
     */
    public function listStorageObjects(?int $limit, string $order = null): array
    {
        $pageNumber = 1;
        $page = null;
        $result = array();
        while (self::isRequestingAllowed($page, $limit)) {
            $page = $this->listStorageObjectsPaginated($order, page: $pageNumber);
            $result = array_merge($result, $page->getData());
            $pageNumber++;
        }
        return $result;
    }

    /**
     * @generated
     */
    public function listStorageObjectsPaginated(string $order = null, int $page = null, int $page_size = null): Model\StorageObjectPagination
    {
        $request = new Request("GET", "/v30/storage", get_defined_vars());
        $request->enablePathParameters();
        $request->enableQueryParameters("page", "page_size", "order");
        $request->enableBodyFields();
        return $this->submit($request, Model\StorageObjectPagination::class);
    }

    /**
     * @generated
     */
    public function createStorageObject(int $id = null, object $url = null, object $url_sm = null, object $url_md = null, object $url_lg = null, object $is_image = null, object $type = null): Model\StorageObject
    {
        $request = new Request("POST", "/v30/storage", get_defined_vars());
        $request->enablePathParameters();
        $request->enableQueryParameters();
        $request->enableBodyFields("id", "url", "url_sm", "url_md", "url_lg", "is_image", "type");
        return $this->submit($request, Model\StorageObject::class);
    }

    /**
     * @generated
     */
    public function retrieveStorageObject(int $obj_id): Model\StorageObject
    {
        $request = new Request("GET", "/v30/storage/{obj_id}", get_defined_vars());
        $request->enablePathParameters("obj_id");
        $request->enableQueryParameters();
        $request->enableBodyFields();
        return $this->submit($request, Model\StorageObject::class);
    }

    /**
     * @generated
     */
    public function updateStorageObject(int $obj_id, int $id = null, object $url = null, object $url_sm = null, object $url_md = null, object $url_lg = null, object $is_image = null, object $type = null): Model\StorageObject
    {
        $request = new Request("PUT", "/v30/storage/{obj_id}", get_defined_vars());
        $request->enablePathParameters("obj_id");
        $request->enableQueryParameters();
        $request->enableBodyFields("id", "url", "url_sm", "url_md", "url_lg", "is_image", "type");
        return $this->submit($request, Model\StorageObject::class);
    }

    /**
     * @generated
     */
    public function deleteStorageObject(int $obj_id): void
    {
        $request = new Request("DELETE", "/v30/storage/{obj_id}", get_defined_vars());
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
        $request = new Request("PUT", "/v30/storage/{obj_id}/file-content", get_defined_vars());
        $request->enablePathParameters("obj_id");
        $request->enableQueryParameters();
        $request->enableBodyFields();
        $this->submit($request);
    }

    /**
     * @return  Model\Webhook[]
     * @generated
     */
    public function listWebhooks(?int $limit, string $order = null): array
    {
        $pageNumber = 1;
        $page = null;
        $result = array();
        while (self::isRequestingAllowed($page, $limit)) {
            $page = $this->listWebhooksPaginated($order, page: $pageNumber);
            $result = array_merge($result, $page->getData());
            $pageNumber++;
        }
        return $result;
    }

    /**
     * @generated
     */
    public function listWebhooksPaginated(string $order = null, int $page = null, int $page_size = null): Model\WebhookPagination
    {
        $request = new Request("GET", "/v30/webhooks", get_defined_vars());
        $request->enablePathParameters();
        $request->enableQueryParameters("page", "page_size", "order");
        $request->enableBodyFields();
        return $this->submit($request, Model\WebhookPagination::class);
    }

    /**
     * @generated
     */
    public function createWebhook(int $id = null, string $url = null, object $headers = null, string $version = null, string $signal = null, string $technical_contact_email = null, string $http_basic_auth_key = null, bool $http_basic_auth_enabled = null): Model\Webhook
    {
        $request = new Request("POST", "/v30/webhooks", get_defined_vars());
        $request->enablePathParameters();
        $request->enableQueryParameters();
        $request->enableBodyFields("id", "url", "headers", "version", "signal", "technical_contact_email", "http_basic_auth_key", "http_basic_auth_enabled");
        return $this->submit($request, Model\Webhook::class);
    }

    /**
     * @generated
     */
    public function retrieveWebhook(int $obj_id): Model\Webhook
    {
        $request = new Request("GET", "/v30/webhooks/{obj_id}", get_defined_vars());
        $request->enablePathParameters("obj_id");
        $request->enableQueryParameters();
        $request->enableBodyFields();
        return $this->submit($request, Model\Webhook::class);
    }

    /**
     * @generated
     */
    public function updateWebhook(int $obj_id, int $id = null, string $url = null, object $headers = null, string $version = null, string $signal = null, string $technical_contact_email = null, string $http_basic_auth_key = null, bool $http_basic_auth_enabled = null): Model\Webhook
    {
        $request = new Request("PUT", "/v30/webhooks/{obj_id}", get_defined_vars());
        $request->enablePathParameters("obj_id");
        $request->enableQueryParameters();
        $request->enableBodyFields("id", "url", "headers", "version", "signal", "technical_contact_email", "http_basic_auth_key", "http_basic_auth_enabled");
        return $this->submit($request, Model\Webhook::class);
    }

    /**
     * @generated
     */
    public function deleteWebhook(int $obj_id): void
    {
        $request = new Request("DELETE", "/v30/webhooks/{obj_id}", get_defined_vars());
        $request->enablePathParameters("obj_id");
        $request->enableQueryParameters();
        $request->enableBodyFields();
        $this->submit($request);
    }

    /**
     * @return  Model\WebhookCall[]
     * @generated
     */
    public function listWebhookCalls(?int $limit, int $obj_id, string $period_filter = null, array $status_code = null, string $order = null): array
    {
        $pageNumber = 1;
        $page = null;
        $result = array();
        while (self::isRequestingAllowed($page, $limit)) {
            $page = $this->listWebhookCallsPaginated($obj_id, $period_filter, $status_code, $order, page: $pageNumber);
            $result = array_merge($result, $page->getData());
            $pageNumber++;
        }
        return $result;
    }

    /**
     * @generated
     */
    public function listWebhookCallsPaginated(int $obj_id, string $period_filter = null, array $status_code = null, string $order = null, int $page = null, int $page_size = null): Model\WebhookCallPagination
    {
        $request = new Request("GET", "/v30/webhooks/{obj_id}/calls", get_defined_vars());
        $request->enablePathParameters("obj_id");
        $request->enableQueryParameters("period_filter", "status_code", "page", "page_size", "order");
        $request->enableBodyFields();
        return $this->submit($request, Model\WebhookCallPagination::class);
    }

    /**
     * @return  Model\Webpage[]
     * @generated
     */
    public function listWebpages(?int $limit, string $published = null, int $website_id = null, int $template_id = null, string $order = null): array
    {
        $pageNumber = 1;
        $page = null;
        $result = array();
        while (self::isRequestingAllowed($page, $limit)) {
            $page = $this->listWebpagesPaginated($published, $website_id, $template_id, $order, page: $pageNumber);
            $result = array_merge($result, $page->getData());
            $pageNumber++;
        }
        return $result;
    }

    /**
     * @generated
     */
    public function listWebpagesPaginated(string $published = null, int $website_id = null, int $template_id = null, string $order = null, int $page = null, int $page_size = null): Model\WebpagePagination
    {
        $request = new Request("GET", "/v30/webpages", get_defined_vars());
        $request->enablePathParameters();
        $request->enableQueryParameters("published", "website_id", "template_id", "page", "page_size", "order");
        $request->enableBodyFields();
        return $this->submit($request, Model\WebpagePagination::class);
    }

    /**
     * @generated
     */
    public function retrieveWebpage(int $obj_id): Model\WebpageWithContent
    {
        $request = new Request("GET", "/v30/webpages/{obj_id}", get_defined_vars());
        $request->enablePathParameters("obj_id");
        $request->enableQueryParameters();
        $request->enableBodyFields();
        return $this->submit($request, Model\WebpageWithContent::class);
    }

    /**
     * @return  Model\Website[]
     * @generated
     */
    public function listWebsites(?int $limit, string $published = null, int $template_id = null, string $order = null): array
    {
        $pageNumber = 1;
        $page = null;
        $result = array();
        while (self::isRequestingAllowed($page, $limit)) {
            $page = $this->listWebsitesPaginated($published, $template_id, $order, page: $pageNumber);
            $result = array_merge($result, $page->getData());
            $pageNumber++;
        }
        return $result;
    }

    /**
     * @generated
     */
    public function listWebsitesPaginated(string $published = null, int $template_id = null, string $order = null, int $page = null, int $page_size = null): Model\WebsitePagination
    {
        $request = new Request("GET", "/v30/websites", get_defined_vars());
        $request->enablePathParameters();
        $request->enableQueryParameters("published", "template_id", "page", "page_size", "order");
        $request->enableBodyFields();
        return $this->submit($request, Model\WebsitePagination::class);
    }

    /**
     * @generated
     */
    public function retrieveWebsite(int $obj_id): Model\Website
    {
        $request = new Request("GET", "/v30/websites/{obj_id}", get_defined_vars());
        $request->enablePathParameters("obj_id");
        $request->enableQueryParameters();
        $request->enableBodyFields();
        return $this->submit($request, Model\Website::class);
    }

    /**
     * @return  Model\Webpage[]
     * @generated
     */
    public function listWebsiteWebpages(?int $limit, int $obj_id, string $published = null, int $website_id = null, int $template_id = null, string $order = null): array
    {
        $pageNumber = 1;
        $page = null;
        $result = array();
        while (self::isRequestingAllowed($page, $limit)) {
            $page = $this->listWebsiteWebpagesPaginated($obj_id, $published, $website_id, $template_id, $order, page: $pageNumber);
            $result = array_merge($result, $page->getData());
            $pageNumber++;
        }
        return $result;
    }

    /**
     * @generated
     */
    public function listWebsiteWebpagesPaginated(int $obj_id, string $published = null, int $website_id = null, int $template_id = null, string $order = null, int $page = null, int $page_size = null): Model\WebpagePagination
    {
        $request = new Request("GET", "/v30/websites/{obj_id}/webpages", get_defined_vars());
        $request->enablePathParameters("obj_id");
        $request->enableQueryParameters("published", "website_id", "template_id", "page", "page_size", "order");
        $request->enableBodyFields();
        return $this->submit($request, Model\WebpagePagination::class);
    }
}
