<?php
/**
 * SaleInvoice
 *
 * PHP version 7.4
 *
 * @category Class
 * @package  OpenAPI\Client
 * @author   OpenAPI Generator team
 * @link     https://openapi-generator.tech
 */

/**
 * Congressus API
 *
 * # Introduction The Congressus API allows you to interact with your Congressus administration. The API is RESTful and uses JSON to transport information.  This documentation aims to get you started with your first requests. Make sure to read this introduction completely to know all aspects of our API.  ## REST basics A REST API describes the resources you can access in a clearly defined path structure. This documentation contains a reference for each resource in the API. Before you can use these resources, you need to know the basics of accessing the Congressus REST API.  **Paths and versioning**  The Congressus API resides on the following paths:  https://api.congressus.nl/ `version` / `resource_path` ? `query_params`  - The `version` part of the path indicates the version of the API you want to use. At this moment version v30 is the   current version. By pointing to a specific version, we can make sure you always can expect equal behaviour from our   API. - The `resource_path` part indicates the path of the resource you want to access. Specific paths to resources can be   found in the API documentation. Examples of resource paths are: /members to retrieve all members or   /member/ `obj_id` /statuses to create new member status for a member. - The `query_params` contains all filtering, ordering and pagination information.   ## Authentication The current authentication flow present at Congressus API is by the use of the Bearer Token suggested by OAuth 2.0.  To interact with the Congressus API, you must authenticate by supplying the header `Authorization` with the value `Bearer {access_token}`.  **How do I get an API key?**  At this moment, you can only request access to our API through Congressus Support ([support@congressus.nl](mailto:support@congressus.nl)).  ## Requests There are different approaches for making requests to our API. The command line tool [curl](https://curl.se/) is easy and fast for testing our API. When you want to integrate the API into your own software, you can choose to use a general purpose REST library or to [create your own API client library](https://github.com/OpenAPITools/openapi-generator) based on our OpenAPI specs.  ## Responses Congressus uses conventional HTTP response codes to indicate success or failure of an API request. In general, codes in the 2xx range indicate success, codes in the 4xx range indicate an error that resulted from the provided information (e.g. a required parameter was missing or input data was invalid), and codes in the 5xx range indicate an error with the Congressus API.  ## Pagination Endpoints returning a list of entities, are paginated to prevent large responses. To control the pagination, you can use the `page` and `page_size` parameters. page determines which page to return (default: 1), page_size controls the amount of entities to return (default: 25, maximum: 100).  Each paginated response contains the following information:  - `has_prev` bool - `prev_num` int with previous page number - `has next` bool - `next_num` int with next page number - `data` list with results on current page - `total` int with total number of results  ## Filtering Most list endpoints support filtering to get a subset of the available information. Filtering is done using the query. For some filter attributes, filtering for multiple options is supported by adding the `<filter_attribute>=<value>` multiple times. E.g. `category_id=1&category_id=2`.  ## Ordering Most list endpoints support ordering on one or more attributes. The order is defined using the `order=` parameter in the query part of the endpoint.  Multiple columns can be used for ordering, delimited by a comma. E.g. `order=lastname,initials,first_name`.  Each attribute used in the order parameter could be extended with a sort property `:<sort_property>`. E.g. `order=lastname:desc`.  The following properties are supported throughout our API:  - ```:asc``` ASC NULLS LAST (default)  [comment]: <> (- ```:asc_nulls_last``` ASC NULLS LAST)  [comment]: <> (- ```:asc_nulls_first``` ASC NULLS FIRST) - ```:desc``` DESC NULLS FIRST  [comment]: <> (- ```:desc_nulls_last``` DESC NULLS LAST)  [comment]: <> (- ```:desc_nulls_first``` DESC NULLS FIRST)  ## Searching and location filtering For some resources a dedicated /search endpoint is available, which is optimized for searching large datasets. We use an Elasticsearch database to deliver these results. The schema for these resources is often a concise version of the schema used for regular endpoints, but always contains the primary key (obj_id). If you need the full schema for a resource found through /search, you can perform an additional call to the GET /<obj_id> endpoint.  In most cases, searching has the following query parameters: - `term` - generic term used for the search - `city` or `zip` - a city name or postal code (only Dutch postal codes allowed) - `distance` - distance from the center of the given city or zip (default *5km*)  Results from /search endpoints do not support custom ordering, but are ordered based on relevance (i.e. *score* for term queries and *distance* for all location bound search queries).  ## Rate limiting Usage of the Congressus API is unlimited within the plan and permissions of the account you are using. To prevent fraud and abuse, requests to the API are throttled. You can request the API 60 times each minute and 1000 times per hour.  The API will respond with a **429 Too many requests** response. This response contains the following fields in the headers:  - `X-RateLimit-Limit` The total number of requests allowed for the active window - `X-RateLimit-Remaining` The number of requests remaining in the active window. - `X-RateLimit-Reset` UTC seconds since epoch when the window will be reset. - `Retry-After` Seconds to retry after when the Rate Limit will be reset.  ## Cross-Origin Resource Sharing This API features Cross-Origin Resource Sharing (CORS) implemented in compliance with W3C spec. This allows cross-domain communication from the browser. All responses have a wildcard same-origin, which allows to use our API from any domain or server.   # Webhooks Information in a Congressus administration is constantly changing. If you want to perform actions based on these changes, webhooks help you to achieve this. Instead of querying the API at a certain interval, Congressus will notify you about changes to information in the administration.  ## Usage Webhooks are useful in a broad range of situations. When the state of an resource changes, Congressus will perform a HTTP request to the URL you provide. Based on the payload of the request, you can determine which action you need to perform.  How it works:  - You need a URL that Congressus can call to deliver the payload. The Congressus servers must be able to access this   URL. - You can add HTTP basic authentication or other token authentication in the URL, as long as the URL stays valid. - Your URL always needs to respond with a 200 HTTP status. Upon registration this is checked. - When your URL responds with another HTTP status code, Congressus will retry to deliver the call 10 times. The time   interval between retries is gradually extended. - After each call, Congressus will store the last HTTP status code and HTTP body. Using the webhooks API, you can   retrieve this information for debugging purposes. - You can register as many webhooks as required in an administration. Registration is done by sending a POST request   to the webhooks API.  > **We strongly recommend that you use a secure HTTPS endpoint for receiving payload from Congressus. If you use > unencrypted HTTP, anyone on the network may be able to listen in on sensitive information like members and invoices.**  ## Webhook events Each webhook subscribes to an event. When an event occurs, Congressus will call the webhook using an HTTP request to the provided URL. The following events are available:  **Members** - member - All member related events - member_added - Member added to the administration - member_updated - Existing Member is updated - member_deleted - Member is removed from the administration  **Events** - event - All event related events - event_added - Event added - event_updated - Event updated - event_deleted - Event deleted from the administration  **Sale invoices** - sale_invoices - All sale invoice related events - sale_invoices_added - Sale invoice added - sale_invoices_updated - Sale invoice updated - sale_invoices_deleted - Sale invoice deleted from the administration   ## Payload Each webhook call has a payload based on the category of the event that triggered the webhook. E.g. events in the category **Members** get a payload based on the schema for Members, filled with the data for the resource that triggered the webhook.  Each webhook call contains the following information:  - `webhook_id`-  The id of the webhook that triggered the call - `webhook_event` - The category of events for the webhook - `webhook_event_trigger` -  The trigger that caused the webhook call - `created` - Date and time at which the webhook was triggered - `data` - List which contains the payload(s) in the form of the complete resource that triggered the event   # Upgrading from v20 to v30  Version 3.0 (`v30`) is a major update to the Congressus API. This new API version improves both performance and functionality, but comes with breaking changes.  ## Authentication and authorization changes  API keys used for `v20` are in most cases also valid for `v30`. Our API would notify you with a nice error message when the API key is not usable for `v30`. In that case you can request a new API key through Congressus Support.  The use of API keys in `v30` is bound to the rights of the usergroup of the API key in Congressus Manager. This way you can restrict the rights of an API key to certain resources and operations.  - The authorization header now adheres to the OAuth2.0 specifications. The colon after 'Bearer' is replaced by a space. Use 'Authorization: Bearer {API key}'.  ## Interaction changes We've implemented some additional options in the interaction with the API.  ### Responses - Paginated responses return a JSON-object with the following attributes:   - `has_prev` bool   - `prev_num` int with previous page number   - `has next` bool   - `next_num` int with next page number   - `data` list with results on current page   - `total` int with total number of results  ### Pagination - The max. number of items per page is 100. Use the parameters `page` and `page_size` to navigate. - See <https://api.congressus.nl/v30/docs#section/Introduction/Pagination>  ### Filtering - Filtering is added. It is possible to add filters in the query string of a GET-request. - Filtering options are described per resource in the API documentation.  ### Ordering - Ordering is added. Ordering on multiple columns and multiple directions is possible. - Ordering options are described per resource in the API documentation. - See <https://api.congressus.nl/v30/docs#section/Introduction/Ordering>  ## Member resource changes  Retrieving and creating new members through the API has changed. The following changes are made compared to `v20`:  - GET-request on `/members`   - Name attributes are expended to cover all possible name attributes in Congressus. Attributes for the name of the member in `v20` are also available in `v30`.   - `status` contains an object with the current member status of the member   - `statuses` is added, and contains a full list of all member statuses for the member in the past and future   - `custom_fields` dict is extended to return a list with custom field objects - POST-request on `/members`   - `bank_account.has_sdd_mandate` is no longer available, you can enable a direct debit mandate after adding the member and bank account   - `has_sdd_mandate` is no longer available   - `saldo` is no longer available   - `send_confirmation_email` is no longer available, this functionality is currently not available in `v30`   - `payment_*` fields are no longer available, create and send a sale invoice after creating the new member   - `custom_fields` is not supported currently  ### Context for validation  Validation could be extended with a context. This context defines which fields are available, editable and required for a certain member. This context is set per MemberStatus from within Congressus Manager (settings > member statuses).  Adding the context-parameter to a request ensures that only the fields within that context could be read and updated.  ## Financial resources changes  We only support the new sale invoice functionality in this API. The endpoint `v20/sales` has changed to `v30/sale-invoices`.  - Adding new sale invoices with a POST requires a `collection_id`, `member_id` or addressee information.  ### Managing the invoice_status The invoice status `invoice_status` cannot be set directly from the API, but can be managed through action endpoints like `/send` and `/remind` - New sale invoices get the invoice status 'concept'. - Use the `v30/sale-invoices/{obj_id}/send` endpoint to send a sale invoice. This will update the invoice status to 'open'.  More about Invoice status: https://api.congressus.nl/v30/docs#section/Invoice-status  More about Invoice actions: https://api.congressus.nl/v30/docs#section/Invoice-actions  ## New features and possibilities The `v30` API has a ton of new features and encloses much more information from your Congressus administration. Organisations, Websites, Webpages, Sale invoice workflows, Bank mutations, Webhooks and Storage are currently new.  Keep an eye on the changelog (which we've added just below) for new features.   # Changelog  This is version 3.0 of the Congressus API. In this chapter we describe all changes in v3.0. ## 2022-12-09 Event ticket types endpoints - `EventTicketType` resources can now be created, updated and deleted through the API - The context is now applied at row level according to the status of the Member for the `v30/members` endpoint  ## 2022-06-28 Events updated, MembershipStatus resources added - `Event` resources are now fully operational, including the possibility to add participants / sell tickets through the API. - `MembershipStatus` is now available for Member resources.  ## 2022-06-22 Minor updates and fixes - Feat: /members can be filtered against multiples statuses with the status_id query parameter (i.e: /members?status_id=2&status_id=3). - Feat: the News model now contains a list of websites where the news item is published on - Fix: add the default website to POST /news on create - Fix: sale_invoice_id is now honored when given by the creation of a sale invoice /sale-invoices/<int:obj_id>/send  ## 2022-06-03 Minor updates and fixes - Feat: Additional filtering for /sale-invoices endpoint added (invoice_type 'debit', 'is_credited' and 'is_not_credited'). - Feat: Renamed /groups/folders endpoints to /group-folders for more consistency. Deprecated old endpoints. - Feat: Added member status resources through /member-statuses. - Feat: Added profile_picture and formal_picture to Member resources. - Fix: we incorrectly used 'per_page' as parameter in the Pagination-section of these docs. The correct parameter is **'page_size'**. - Fix: all non-recursive endpoints for Group folders and Product folders returned children, this is resolved.  ## 2022-05-03 Member validation through context added - Added extended validation options for Member-resources by setting a `context` parameter. This context ensures validation according to the field settings as set in Congressus Manager for the member status. - Description for Context validation added to the Member-resources. - Introduction on Context validation added to the [upgrade guide](#section/Upgrading-from-v20-to-v30)  ## 2022-04-22 Upgrade guide from v20 to v30 added - First version for the [upgrade guide](#section/Upgrading-from-v20-to-v30) added  ## 2022-03-23 Additional filtering for Group and Organisation resources - `Group` and `Group membership` resources can use a filter on member_id - `Organisation` and `Organisation membership` resources can use a filter on member_id  ## 2022-03-21 Group and GroupFolder resources added - Group, GroupFolder and GroupMembership resources are added to the API. - `Group folders` are added and use a tree-like structure. - `Organisation` resources have create, update and delete views added. - `Organisation membership` resources are added - Fix: SDD mandates returned and empty list for Member resources.  ## 2021-10-14 Organisation resources added - Both Organisation and Organisation category resources are added to the API.  ## 2021-10-02 Additional filters added for Event participations - `Event participations` have additional filter functionality  ## 2021-09-22 Added resources for Product folders and Sale invoice workflows - `Product folders` are added, using a tree-like structure. - `Sale invoice workflows` are added as resource. Read-only for this moment. - Updated descriptions for Sale invoice attributes.  ## 2021-08-09 additional filters for events and products - Events can now be filtered on published true/false - Products can now be filtered on published and folder_id. More than one folder_id can be given by supplying it more   than once as query param, e.g. `products?folder_id=123&folder_id=456`  ## 2021-08-04 custom fields and descriptions added, publication options added to events and blogs - The retrieve member resource now also shows the custom field information for a member - Many attributes have an additional description added - Publication attributes are added to Event and Blog resources  ## 2021-06-09 website related resources added - Website and Webpage resources added (list and get only) - News resources added - Default order is added for Websites, Webpages, Events and News list endpoints. You can overwrite the default order   with the `order` query param - Improved descriptions for several resources, removed some typo's in the documentation  ## 2021-04-06 initial release - This initial release contains a minor set of resources to work with.
 *
 * The version of the OpenAPI document: 3.0
 * Contact: support@congressus.nl
 * Generated by: https://openapi-generator.tech
 * OpenAPI Generator version: 7.3.0
 */

/**
 * NOTE: This class is auto generated by OpenAPI Generator (https://openapi-generator.tech).
 * https://openapi-generator.tech
 * Do not edit the class manually.
 */

namespace OpenAPI\Client\Model;

use \ArrayAccess;
use \OpenAPI\Client\ObjectSerializer;

/**
 * SaleInvoice Class Doc Comment
 *
 * @category Class
 * @package  OpenAPI\Client
 * @author   OpenAPI Generator team
 * @link     https://openapi-generator.tech
 * @implements \ArrayAccess<string, mixed>
 */
class SaleInvoice implements ModelInterface, ArrayAccess, \JsonSerializable
{
    public const DISCRIMINATOR = null;

    /**
      * The original name of the model.
      *
      * @var string
      */
    protected static $openAPIModelName = 'SaleInvoice';

    /**
      * Array of property to type mappings. Used for (de)serialization
      *
      * @var string[]
      */
    protected static $openAPITypes = [
        'id' => 'int',
        'uuid' => 'string',
        'entity_id' => 'int',
        'entity' => '\OpenAPI\Client\Model\ClientEntity',
        'invoice_date' => '\DateTime',
        'invoice_source' => 'string',
        'invoice_type' => 'string',
        'delivery_method' => 'string',
        'invoice_send_date_time' => '\DateTime',
        'invoice_due_date' => '\DateTime',
        'invoice_reminded_date_time' => '\DateTime',
        'invoice_num_reminders_send' => 'int',
        'invoice_next_due_date' => '\DateTime',
        'invoice_status' => 'string',
        'invoice_reference' => 'string',
        'invoice_number' => 'string',
        'member_id' => 'int',
        'collection_id' => 'int',
        'contribution_start' => '\DateTime',
        'contribution_end' => '\DateTime',
        'use_direct_debit' => 'bool',
        'invoice_workflow_id' => 'int',
        'addressee' => 'string',
        'addressee_attention' => 'string',
        'email' => 'string',
        'address' => '\OpenAPI\Client\Model\Address',
        'items' => '\OpenAPI\Client\Model\SaleInvoiceItem[]',
        'payments' => '\OpenAPI\Client\Model\SaleInvoicePayment[]',
        'price_inclusive_vat' => 'mixed',
        'price_exclusive_vat' => 'mixed',
        'vat' => 'mixed',
        'price_paid' => 'mixed',
        'price_unpaid' => 'mixed',
        'currency' => 'mixed',
        'created' => '\DateTime',
        'modified' => '\DateTime'
    ];

    /**
      * Array of property to format mappings. Used for (de)serialization
      *
      * @var string[]
      * @phpstan-var array<string, string|null>
      * @psalm-var array<string, string|null>
      */
    protected static $openAPIFormats = [
        'id' => null,
        'uuid' => null,
        'entity_id' => null,
        'entity' => null,
        'invoice_date' => 'date',
        'invoice_source' => null,
        'invoice_type' => null,
        'delivery_method' => null,
        'invoice_send_date_time' => 'date-time',
        'invoice_due_date' => 'date',
        'invoice_reminded_date_time' => 'date-time',
        'invoice_num_reminders_send' => null,
        'invoice_next_due_date' => 'date',
        'invoice_status' => null,
        'invoice_reference' => null,
        'invoice_number' => null,
        'member_id' => null,
        'collection_id' => null,
        'contribution_start' => 'date',
        'contribution_end' => 'date',
        'use_direct_debit' => null,
        'invoice_workflow_id' => null,
        'addressee' => null,
        'addressee_attention' => null,
        'email' => 'email',
        'address' => null,
        'items' => null,
        'payments' => null,
        'price_inclusive_vat' => null,
        'price_exclusive_vat' => null,
        'vat' => null,
        'price_paid' => null,
        'price_unpaid' => null,
        'currency' => null,
        'created' => 'date-time',
        'modified' => 'date-time'
    ];

    /**
      * Array of nullable properties. Used for (de)serialization
      *
      * @var boolean[]
      */
    protected static array $openAPINullables = [
        'id' => false,
        'uuid' => true,
        'entity_id' => false,
        'entity' => false,
        'invoice_date' => true,
        'invoice_source' => false,
        'invoice_type' => false,
        'delivery_method' => true,
        'invoice_send_date_time' => true,
        'invoice_due_date' => true,
        'invoice_reminded_date_time' => true,
        'invoice_num_reminders_send' => true,
        'invoice_next_due_date' => true,
        'invoice_status' => false,
        'invoice_reference' => true,
        'invoice_number' => true,
        'member_id' => false,
        'collection_id' => false,
        'contribution_start' => true,
        'contribution_end' => true,
        'use_direct_debit' => true,
        'invoice_workflow_id' => true,
        'addressee' => false,
        'addressee_attention' => false,
        'email' => false,
        'address' => false,
        'items' => false,
        'payments' => false,
        'price_inclusive_vat' => true,
        'price_exclusive_vat' => true,
        'vat' => true,
        'price_paid' => true,
        'price_unpaid' => true,
        'currency' => true,
        'created' => true,
        'modified' => true
    ];

    /**
      * If a nullable field gets set to null, insert it here
      *
      * @var boolean[]
      */
    protected array $openAPINullablesSetToNull = [];

    /**
     * Array of property to type mappings. Used for (de)serialization
     *
     * @return array
     */
    public static function openAPITypes()
    {
        return self::$openAPITypes;
    }

    /**
     * Array of property to format mappings. Used for (de)serialization
     *
     * @return array
     */
    public static function openAPIFormats()
    {
        return self::$openAPIFormats;
    }

    /**
     * Array of nullable properties
     *
     * @return array
     */
    protected static function openAPINullables(): array
    {
        return self::$openAPINullables;
    }

    /**
     * Array of nullable field names deliberately set to null
     *
     * @return boolean[]
     */
    private function getOpenAPINullablesSetToNull(): array
    {
        return $this->openAPINullablesSetToNull;
    }

    /**
     * Setter - Array of nullable field names deliberately set to null
     *
     * @param boolean[] $openAPINullablesSetToNull
     */
    private function setOpenAPINullablesSetToNull(array $openAPINullablesSetToNull): void
    {
        $this->openAPINullablesSetToNull = $openAPINullablesSetToNull;
    }

    /**
     * Checks if a property is nullable
     *
     * @param string $property
     * @return bool
     */
    public static function isNullable(string $property): bool
    {
        return self::openAPINullables()[$property] ?? false;
    }

    /**
     * Checks if a nullable property is set to null.
     *
     * @param string $property
     * @return bool
     */
    public function isNullableSetToNull(string $property): bool
    {
        return in_array($property, $this->getOpenAPINullablesSetToNull(), true);
    }

    /**
     * Array of attributes where the key is the local name,
     * and the value is the original name
     *
     * @var string[]
     */
    protected static $attributeMap = [
        'id' => 'id',
        'uuid' => 'uuid',
        'entity_id' => 'entity_id',
        'entity' => 'entity',
        'invoice_date' => 'invoice_date',
        'invoice_source' => 'invoice_source',
        'invoice_type' => 'invoice_type',
        'delivery_method' => 'delivery_method',
        'invoice_send_date_time' => 'invoice_send_date_time',
        'invoice_due_date' => 'invoice_due_date',
        'invoice_reminded_date_time' => 'invoice_reminded_date_time',
        'invoice_num_reminders_send' => 'invoice_num_reminders_send',
        'invoice_next_due_date' => 'invoice_next_due_date',
        'invoice_status' => 'invoice_status',
        'invoice_reference' => 'invoice_reference',
        'invoice_number' => 'invoice_number',
        'member_id' => 'member_id',
        'collection_id' => 'collection_id',
        'contribution_start' => 'contribution_start',
        'contribution_end' => 'contribution_end',
        'use_direct_debit' => 'use_direct_debit',
        'invoice_workflow_id' => 'invoice_workflow_id',
        'addressee' => 'addressee',
        'addressee_attention' => 'addressee_attention',
        'email' => 'email',
        'address' => 'address',
        'items' => 'items',
        'payments' => 'payments',
        'price_inclusive_vat' => 'price_inclusive_vat',
        'price_exclusive_vat' => 'price_exclusive_vat',
        'vat' => 'vat',
        'price_paid' => 'price_paid',
        'price_unpaid' => 'price_unpaid',
        'currency' => 'currency',
        'created' => 'created',
        'modified' => 'modified'
    ];

    /**
     * Array of attributes to setter functions (for deserialization of responses)
     *
     * @var string[]
     */
    protected static $setters = [
        'id' => 'setId',
        'uuid' => 'setUuid',
        'entity_id' => 'setEntityId',
        'entity' => 'setEntity',
        'invoice_date' => 'setInvoiceDate',
        'invoice_source' => 'setInvoiceSource',
        'invoice_type' => 'setInvoiceType',
        'delivery_method' => 'setDeliveryMethod',
        'invoice_send_date_time' => 'setInvoiceSendDateTime',
        'invoice_due_date' => 'setInvoiceDueDate',
        'invoice_reminded_date_time' => 'setInvoiceRemindedDateTime',
        'invoice_num_reminders_send' => 'setInvoiceNumRemindersSend',
        'invoice_next_due_date' => 'setInvoiceNextDueDate',
        'invoice_status' => 'setInvoiceStatus',
        'invoice_reference' => 'setInvoiceReference',
        'invoice_number' => 'setInvoiceNumber',
        'member_id' => 'setMemberId',
        'collection_id' => 'setCollectionId',
        'contribution_start' => 'setContributionStart',
        'contribution_end' => 'setContributionEnd',
        'use_direct_debit' => 'setUseDirectDebit',
        'invoice_workflow_id' => 'setInvoiceWorkflowId',
        'addressee' => 'setAddressee',
        'addressee_attention' => 'setAddresseeAttention',
        'email' => 'setEmail',
        'address' => 'setAddress',
        'items' => 'setItems',
        'payments' => 'setPayments',
        'price_inclusive_vat' => 'setPriceInclusiveVat',
        'price_exclusive_vat' => 'setPriceExclusiveVat',
        'vat' => 'setVat',
        'price_paid' => 'setPricePaid',
        'price_unpaid' => 'setPriceUnpaid',
        'currency' => 'setCurrency',
        'created' => 'setCreated',
        'modified' => 'setModified'
    ];

    /**
     * Array of attributes to getter functions (for serialization of requests)
     *
     * @var string[]
     */
    protected static $getters = [
        'id' => 'getId',
        'uuid' => 'getUuid',
        'entity_id' => 'getEntityId',
        'entity' => 'getEntity',
        'invoice_date' => 'getInvoiceDate',
        'invoice_source' => 'getInvoiceSource',
        'invoice_type' => 'getInvoiceType',
        'delivery_method' => 'getDeliveryMethod',
        'invoice_send_date_time' => 'getInvoiceSendDateTime',
        'invoice_due_date' => 'getInvoiceDueDate',
        'invoice_reminded_date_time' => 'getInvoiceRemindedDateTime',
        'invoice_num_reminders_send' => 'getInvoiceNumRemindersSend',
        'invoice_next_due_date' => 'getInvoiceNextDueDate',
        'invoice_status' => 'getInvoiceStatus',
        'invoice_reference' => 'getInvoiceReference',
        'invoice_number' => 'getInvoiceNumber',
        'member_id' => 'getMemberId',
        'collection_id' => 'getCollectionId',
        'contribution_start' => 'getContributionStart',
        'contribution_end' => 'getContributionEnd',
        'use_direct_debit' => 'getUseDirectDebit',
        'invoice_workflow_id' => 'getInvoiceWorkflowId',
        'addressee' => 'getAddressee',
        'addressee_attention' => 'getAddresseeAttention',
        'email' => 'getEmail',
        'address' => 'getAddress',
        'items' => 'getItems',
        'payments' => 'getPayments',
        'price_inclusive_vat' => 'getPriceInclusiveVat',
        'price_exclusive_vat' => 'getPriceExclusiveVat',
        'vat' => 'getVat',
        'price_paid' => 'getPricePaid',
        'price_unpaid' => 'getPriceUnpaid',
        'currency' => 'getCurrency',
        'created' => 'getCreated',
        'modified' => 'getModified'
    ];

    /**
     * Array of attributes where the key is the local name,
     * and the value is the original name
     *
     * @return array
     */
    public static function attributeMap()
    {
        return self::$attributeMap;
    }

    /**
     * Array of attributes to setter functions (for deserialization of responses)
     *
     * @return array
     */
    public static function setters()
    {
        return self::$setters;
    }

    /**
     * Array of attributes to getter functions (for serialization of requests)
     *
     * @return array
     */
    public static function getters()
    {
        return self::$getters;
    }

    /**
     * The original name of the model.
     *
     * @return string
     */
    public function getModelName()
    {
        return self::$openAPIModelName;
    }

    public const INVOICE_TYPE_EVENT_PARTICIPATION = 'event_participation';
    public const INVOICE_TYPE_WEBSHOP = 'webshop';
    public const INVOICE_TYPE_CONTRIBUTION = 'contribution';
    public const INVOICE_TYPE_PLANNING = 'planning';
    public const INVOICE_TYPE_NULL = 'null';
    public const INVOICE_TYPE_RENTAL = 'rental';

    /**
     * Gets allowable values of the enum
     *
     * @return string[]
     */
    public function getInvoiceTypeAllowableValues()
    {
        return [
            self::INVOICE_TYPE_EVENT_PARTICIPATION,
            self::INVOICE_TYPE_WEBSHOP,
            self::INVOICE_TYPE_CONTRIBUTION,
            self::INVOICE_TYPE_PLANNING,
            self::INVOICE_TYPE_NULL,
            self::INVOICE_TYPE_RENTAL,
        ];
    }

    /**
     * Associative array for storing property values
     *
     * @var mixed[]
     */
    protected $container = [];

    /**
     * Constructor
     *
     * @param mixed[] $data Associated array of property values
     *                      initializing the model
     */
    public function __construct(array $data = null)
    {
        $this->setIfExists('id', $data ?? [], null);
        $this->setIfExists('uuid', $data ?? [], null);
        $this->setIfExists('entity_id', $data ?? [], null);
        $this->setIfExists('entity', $data ?? [], null);
        $this->setIfExists('invoice_date', $data ?? [], null);
        $this->setIfExists('invoice_source', $data ?? [], null);
        $this->setIfExists('invoice_type', $data ?? [], null);
        $this->setIfExists('delivery_method', $data ?? [], null);
        $this->setIfExists('invoice_send_date_time', $data ?? [], null);
        $this->setIfExists('invoice_due_date', $data ?? [], null);
        $this->setIfExists('invoice_reminded_date_time', $data ?? [], null);
        $this->setIfExists('invoice_num_reminders_send', $data ?? [], null);
        $this->setIfExists('invoice_next_due_date', $data ?? [], null);
        $this->setIfExists('invoice_status', $data ?? [], null);
        $this->setIfExists('invoice_reference', $data ?? [], null);
        $this->setIfExists('invoice_number', $data ?? [], null);
        $this->setIfExists('member_id', $data ?? [], null);
        $this->setIfExists('collection_id', $data ?? [], null);
        $this->setIfExists('contribution_start', $data ?? [], null);
        $this->setIfExists('contribution_end', $data ?? [], null);
        $this->setIfExists('use_direct_debit', $data ?? [], null);
        $this->setIfExists('invoice_workflow_id', $data ?? [], null);
        $this->setIfExists('addressee', $data ?? [], null);
        $this->setIfExists('addressee_attention', $data ?? [], null);
        $this->setIfExists('email', $data ?? [], null);
        $this->setIfExists('address', $data ?? [], null);
        $this->setIfExists('items', $data ?? [], null);
        $this->setIfExists('payments', $data ?? [], null);
        $this->setIfExists('price_inclusive_vat', $data ?? [], null);
        $this->setIfExists('price_exclusive_vat', $data ?? [], null);
        $this->setIfExists('vat', $data ?? [], null);
        $this->setIfExists('price_paid', $data ?? [], null);
        $this->setIfExists('price_unpaid', $data ?? [], null);
        $this->setIfExists('currency', $data ?? [], null);
        $this->setIfExists('created', $data ?? [], null);
        $this->setIfExists('modified', $data ?? [], null);
    }

    /**
    * Sets $this->container[$variableName] to the given data or to the given default Value; if $variableName
    * is nullable and its value is set to null in the $fields array, then mark it as "set to null" in the
    * $this->openAPINullablesSetToNull array
    *
    * @param string $variableName
    * @param array  $fields
    * @param mixed  $defaultValue
    */
    private function setIfExists(string $variableName, array $fields, $defaultValue): void
    {
        if (self::isNullable($variableName) && array_key_exists($variableName, $fields) && is_null($fields[$variableName])) {
            $this->openAPINullablesSetToNull[] = $variableName;
        }

        $this->container[$variableName] = $fields[$variableName] ?? $defaultValue;
    }

    /**
     * Show all the invalid properties with reasons.
     *
     * @return array invalid properties with reasons
     */
    public function listInvalidProperties()
    {
        $invalidProperties = [];

        if (!is_null($this->container['uuid']) && (mb_strlen($this->container['uuid']) > 63)) {
            $invalidProperties[] = "invalid value for 'uuid', the character length must be smaller than or equal to 63.";
        }

        if ($this->container['invoice_source'] === null) {
            $invalidProperties[] = "'invoice_source' can't be null";
        }
        if ((mb_strlen($this->container['invoice_source']) > 22)) {
            $invalidProperties[] = "invalid value for 'invoice_source', the character length must be smaller than or equal to 22.";
        }

        $allowedValues = $this->getInvoiceTypeAllowableValues();
        if (!is_null($this->container['invoice_type']) && !in_array($this->container['invoice_type'], $allowedValues, true)) {
            $invalidProperties[] = sprintf(
                "invalid value '%s' for 'invoice_type', must be one of '%s'",
                $this->container['invoice_type'],
                implode("', '", $allowedValues)
            );
        }

        if (!is_null($this->container['delivery_method']) && (mb_strlen($this->container['delivery_method']) > 22)) {
            $invalidProperties[] = "invalid value for 'delivery_method', the character length must be smaller than or equal to 22.";
        }

        if (!is_null($this->container['invoice_reference']) && (mb_strlen($this->container['invoice_reference']) > 255)) {
            $invalidProperties[] = "invalid value for 'invoice_reference', the character length must be smaller than or equal to 255.";
        }

        if (!is_null($this->container['invoice_number']) && (mb_strlen($this->container['invoice_number']) > 63)) {
            $invalidProperties[] = "invalid value for 'invoice_number', the character length must be smaller than or equal to 63.";
        }

        if ($this->container['items'] === null) {
            $invalidProperties[] = "'items' can't be null";
        }
        return $invalidProperties;
    }

    /**
     * Validate all the properties in the model
     * return true if all passed
     *
     * @return bool True if all properties are valid
     */
    public function valid()
    {
        return count($this->listInvalidProperties()) === 0;
    }


    /**
     * Gets id
     *
     * @return int|null
     */
    public function getId()
    {
        return $this->container['id'];
    }

    /**
     * Sets id
     *
     * @param int|null $id id
     *
     * @return self
     */
    public function setId($id)
    {
        if (is_null($id)) {
            throw new \InvalidArgumentException('non-nullable id cannot be null');
        }
        $this->container['id'] = $id;

        return $this;
    }

    /**
     * Gets uuid
     *
     * @return string|null
     */
    public function getUuid()
    {
        return $this->container['uuid'];
    }

    /**
     * Sets uuid
     *
     * @param string|null $uuid uuid
     *
     * @return self
     */
    public function setUuid($uuid)
    {
        if (is_null($uuid)) {
            array_push($this->openAPINullablesSetToNull, 'uuid');
        } else {
            $nullablesSetToNull = $this->getOpenAPINullablesSetToNull();
            $index = array_search('uuid', $nullablesSetToNull);
            if ($index !== FALSE) {
                unset($nullablesSetToNull[$index]);
                $this->setOpenAPINullablesSetToNull($nullablesSetToNull);
            }
        }
        if (!is_null($uuid) && (mb_strlen($uuid) > 63)) {
            throw new \InvalidArgumentException('invalid length for $uuid when calling SaleInvoice., must be smaller than or equal to 63.');
        }

        $this->container['uuid'] = $uuid;

        return $this;
    }

    /**
     * Gets entity_id
     *
     * @return int|null
     */
    public function getEntityId()
    {
        return $this->container['entity_id'];
    }

    /**
     * Sets entity_id
     *
     * @param int|null $entity_id ID of the entity to use for this sale invoice.
     *
     * @return self
     */
    public function setEntityId($entity_id)
    {
        if (is_null($entity_id)) {
            throw new \InvalidArgumentException('non-nullable entity_id cannot be null');
        }
        $this->container['entity_id'] = $entity_id;

        return $this;
    }

    /**
     * Gets entity
     *
     * @return \OpenAPI\Client\Model\ClientEntity|null
     */
    public function getEntity()
    {
        return $this->container['entity'];
    }

    /**
     * Sets entity
     *
     * @param \OpenAPI\Client\Model\ClientEntity|null $entity entity
     *
     * @return self
     */
    public function setEntity($entity)
    {
        if (is_null($entity)) {
            throw new \InvalidArgumentException('non-nullable entity cannot be null');
        }
        $this->container['entity'] = $entity;

        return $this;
    }

    /**
     * Gets invoice_date
     *
     * @return \DateTime|null
     */
    public function getInvoiceDate()
    {
        return $this->container['invoice_date'];
    }

    /**
     * Sets invoice_date
     *
     * @param \DateTime|null $invoice_date invoice_date
     *
     * @return self
     */
    public function setInvoiceDate($invoice_date)
    {
        if (is_null($invoice_date)) {
            array_push($this->openAPINullablesSetToNull, 'invoice_date');
        } else {
            $nullablesSetToNull = $this->getOpenAPINullablesSetToNull();
            $index = array_search('invoice_date', $nullablesSetToNull);
            if ($index !== FALSE) {
                unset($nullablesSetToNull[$index]);
                $this->setOpenAPINullablesSetToNull($nullablesSetToNull);
            }
        }
        $this->container['invoice_date'] = $invoice_date;

        return $this;
    }

    /**
     * Gets invoice_source
     *
     * @return string
     */
    public function getInvoiceSource()
    {
        return $this->container['invoice_source'];
    }

    /**
     * Sets invoice_source
     *
     * @param string $invoice_source invoice_source
     *
     * @return self
     */
    public function setInvoiceSource($invoice_source)
    {
        if (is_null($invoice_source)) {
            throw new \InvalidArgumentException('non-nullable invoice_source cannot be null');
        }
        if ((mb_strlen($invoice_source) > 22)) {
            throw new \InvalidArgumentException('invalid length for $invoice_source when calling SaleInvoice., must be smaller than or equal to 22.');
        }

        $this->container['invoice_source'] = $invoice_source;

        return $this;
    }

    /**
     * Gets invoice_type
     *
     * @return string|null
     */
    public function getInvoiceType()
    {
        return $this->container['invoice_type'];
    }

    /**
     * Sets invoice_type
     *
     * @param string|null $invoice_type invoice_type
     *
     * @return self
     */
    public function setInvoiceType($invoice_type)
    {
        if (is_null($invoice_type)) {
            throw new \InvalidArgumentException('non-nullable invoice_type cannot be null');
        }
        $allowedValues = $this->getInvoiceTypeAllowableValues();
        if (!in_array($invoice_type, $allowedValues, true)) {
            throw new \InvalidArgumentException(
                sprintf(
                    "Invalid value '%s' for 'invoice_type', must be one of '%s'",
                    $invoice_type,
                    implode("', '", $allowedValues)
                )
            );
        }
        $this->container['invoice_type'] = $invoice_type;

        return $this;
    }

    /**
     * Gets delivery_method
     *
     * @return string|null
     */
    public function getDeliveryMethod()
    {
        return $this->container['delivery_method'];
    }

    /**
     * Sets delivery_method
     *
     * @param string|null $delivery_method delivery_method
     *
     * @return self
     */
    public function setDeliveryMethod($delivery_method)
    {
        if (is_null($delivery_method)) {
            array_push($this->openAPINullablesSetToNull, 'delivery_method');
        } else {
            $nullablesSetToNull = $this->getOpenAPINullablesSetToNull();
            $index = array_search('delivery_method', $nullablesSetToNull);
            if ($index !== FALSE) {
                unset($nullablesSetToNull[$index]);
                $this->setOpenAPINullablesSetToNull($nullablesSetToNull);
            }
        }
        if (!is_null($delivery_method) && (mb_strlen($delivery_method) > 22)) {
            throw new \InvalidArgumentException('invalid length for $delivery_method when calling SaleInvoice., must be smaller than or equal to 22.');
        }

        $this->container['delivery_method'] = $delivery_method;

        return $this;
    }

    /**
     * Gets invoice_send_date_time
     *
     * @return \DateTime|null
     */
    public function getInvoiceSendDateTime()
    {
        return $this->container['invoice_send_date_time'];
    }

    /**
     * Sets invoice_send_date_time
     *
     * @param \DateTime|null $invoice_send_date_time invoice_send_date_time
     *
     * @return self
     */
    public function setInvoiceSendDateTime($invoice_send_date_time)
    {
        if (is_null($invoice_send_date_time)) {
            array_push($this->openAPINullablesSetToNull, 'invoice_send_date_time');
        } else {
            $nullablesSetToNull = $this->getOpenAPINullablesSetToNull();
            $index = array_search('invoice_send_date_time', $nullablesSetToNull);
            if ($index !== FALSE) {
                unset($nullablesSetToNull[$index]);
                $this->setOpenAPINullablesSetToNull($nullablesSetToNull);
            }
        }
        $this->container['invoice_send_date_time'] = $invoice_send_date_time;

        return $this;
    }

    /**
     * Gets invoice_due_date
     *
     * @return \DateTime|null
     */
    public function getInvoiceDueDate()
    {
        return $this->container['invoice_due_date'];
    }

    /**
     * Sets invoice_due_date
     *
     * @param \DateTime|null $invoice_due_date invoice_due_date
     *
     * @return self
     */
    public function setInvoiceDueDate($invoice_due_date)
    {
        if (is_null($invoice_due_date)) {
            array_push($this->openAPINullablesSetToNull, 'invoice_due_date');
        } else {
            $nullablesSetToNull = $this->getOpenAPINullablesSetToNull();
            $index = array_search('invoice_due_date', $nullablesSetToNull);
            if ($index !== FALSE) {
                unset($nullablesSetToNull[$index]);
                $this->setOpenAPINullablesSetToNull($nullablesSetToNull);
            }
        }
        $this->container['invoice_due_date'] = $invoice_due_date;

        return $this;
    }

    /**
     * Gets invoice_reminded_date_time
     *
     * @return \DateTime|null
     */
    public function getInvoiceRemindedDateTime()
    {
        return $this->container['invoice_reminded_date_time'];
    }

    /**
     * Sets invoice_reminded_date_time
     *
     * @param \DateTime|null $invoice_reminded_date_time invoice_reminded_date_time
     *
     * @return self
     */
    public function setInvoiceRemindedDateTime($invoice_reminded_date_time)
    {
        if (is_null($invoice_reminded_date_time)) {
            array_push($this->openAPINullablesSetToNull, 'invoice_reminded_date_time');
        } else {
            $nullablesSetToNull = $this->getOpenAPINullablesSetToNull();
            $index = array_search('invoice_reminded_date_time', $nullablesSetToNull);
            if ($index !== FALSE) {
                unset($nullablesSetToNull[$index]);
                $this->setOpenAPINullablesSetToNull($nullablesSetToNull);
            }
        }
        $this->container['invoice_reminded_date_time'] = $invoice_reminded_date_time;

        return $this;
    }

    /**
     * Gets invoice_num_reminders_send
     *
     * @return int|null
     */
    public function getInvoiceNumRemindersSend()
    {
        return $this->container['invoice_num_reminders_send'];
    }

    /**
     * Sets invoice_num_reminders_send
     *
     * @param int|null $invoice_num_reminders_send invoice_num_reminders_send
     *
     * @return self
     */
    public function setInvoiceNumRemindersSend($invoice_num_reminders_send)
    {
        if (is_null($invoice_num_reminders_send)) {
            array_push($this->openAPINullablesSetToNull, 'invoice_num_reminders_send');
        } else {
            $nullablesSetToNull = $this->getOpenAPINullablesSetToNull();
            $index = array_search('invoice_num_reminders_send', $nullablesSetToNull);
            if ($index !== FALSE) {
                unset($nullablesSetToNull[$index]);
                $this->setOpenAPINullablesSetToNull($nullablesSetToNull);
            }
        }
        $this->container['invoice_num_reminders_send'] = $invoice_num_reminders_send;

        return $this;
    }

    /**
     * Gets invoice_next_due_date
     *
     * @return \DateTime|null
     */
    public function getInvoiceNextDueDate()
    {
        return $this->container['invoice_next_due_date'];
    }

    /**
     * Sets invoice_next_due_date
     *
     * @param \DateTime|null $invoice_next_due_date invoice_next_due_date
     *
     * @return self
     */
    public function setInvoiceNextDueDate($invoice_next_due_date)
    {
        if (is_null($invoice_next_due_date)) {
            array_push($this->openAPINullablesSetToNull, 'invoice_next_due_date');
        } else {
            $nullablesSetToNull = $this->getOpenAPINullablesSetToNull();
            $index = array_search('invoice_next_due_date', $nullablesSetToNull);
            if ($index !== FALSE) {
                unset($nullablesSetToNull[$index]);
                $this->setOpenAPINullablesSetToNull($nullablesSetToNull);
            }
        }
        $this->container['invoice_next_due_date'] = $invoice_next_due_date;

        return $this;
    }

    /**
     * Gets invoice_status
     *
     * @return string|null
     */
    public function getInvoiceStatus()
    {
        return $this->container['invoice_status'];
    }

    /**
     * Sets invoice_status
     *
     * @param string|null $invoice_status Status of the sale invoice. Follows the workflow. Cannot be set directly; use actions `send`, `remind` and `pay` instead.
     *
     * @return self
     */
    public function setInvoiceStatus($invoice_status)
    {
        if (is_null($invoice_status)) {
            throw new \InvalidArgumentException('non-nullable invoice_status cannot be null');
        }
        $this->container['invoice_status'] = $invoice_status;

        return $this;
    }

    /**
     * Gets invoice_reference
     *
     * @return string|null
     */
    public function getInvoiceReference()
    {
        return $this->container['invoice_reference'];
    }

    /**
     * Sets invoice_reference
     *
     * @param string|null $invoice_reference invoice_reference
     *
     * @return self
     */
    public function setInvoiceReference($invoice_reference)
    {
        if (is_null($invoice_reference)) {
            array_push($this->openAPINullablesSetToNull, 'invoice_reference');
        } else {
            $nullablesSetToNull = $this->getOpenAPINullablesSetToNull();
            $index = array_search('invoice_reference', $nullablesSetToNull);
            if ($index !== FALSE) {
                unset($nullablesSetToNull[$index]);
                $this->setOpenAPINullablesSetToNull($nullablesSetToNull);
            }
        }
        if (!is_null($invoice_reference) && (mb_strlen($invoice_reference) > 255)) {
            throw new \InvalidArgumentException('invalid length for $invoice_reference when calling SaleInvoice., must be smaller than or equal to 255.');
        }

        $this->container['invoice_reference'] = $invoice_reference;

        return $this;
    }

    /**
     * Gets invoice_number
     *
     * @return string|null
     */
    public function getInvoiceNumber()
    {
        return $this->container['invoice_number'];
    }

    /**
     * Sets invoice_number
     *
     * @param string|null $invoice_number invoice_number
     *
     * @return self
     */
    public function setInvoiceNumber($invoice_number)
    {
        if (is_null($invoice_number)) {
            array_push($this->openAPINullablesSetToNull, 'invoice_number');
        } else {
            $nullablesSetToNull = $this->getOpenAPINullablesSetToNull();
            $index = array_search('invoice_number', $nullablesSetToNull);
            if ($index !== FALSE) {
                unset($nullablesSetToNull[$index]);
                $this->setOpenAPINullablesSetToNull($nullablesSetToNull);
            }
        }
        if (!is_null($invoice_number) && (mb_strlen($invoice_number) > 63)) {
            throw new \InvalidArgumentException('invalid length for $invoice_number when calling SaleInvoice., must be smaller than or equal to 63.');
        }

        $this->container['invoice_number'] = $invoice_number;

        return $this;
    }

    /**
     * Gets member_id
     *
     * @return int|null
     */
    public function getMemberId()
    {
        return $this->container['member_id'];
    }

    /**
     * Sets member_id
     *
     * @param int|null $member_id member_id
     *
     * @return self
     */
    public function setMemberId($member_id)
    {
        if (is_null($member_id)) {
            throw new \InvalidArgumentException('non-nullable member_id cannot be null');
        }
        $this->container['member_id'] = $member_id;

        return $this;
    }

    /**
     * Gets collection_id
     *
     * @return int|null
     */
    public function getCollectionId()
    {
        return $this->container['collection_id'];
    }

    /**
     * Sets collection_id
     *
     * @param int|null $collection_id ID of the collection (Group / Organisation) to which this sale invoice is addressed. Optional.
     *
     * @return self
     */
    public function setCollectionId($collection_id)
    {
        if (is_null($collection_id)) {
            throw new \InvalidArgumentException('non-nullable collection_id cannot be null');
        }
        $this->container['collection_id'] = $collection_id;

        return $this;
    }

    /**
     * Gets contribution_start
     *
     * @return \DateTime|null
     */
    public function getContributionStart()
    {
        return $this->container['contribution_start'];
    }

    /**
     * Sets contribution_start
     *
     * @param \DateTime|null $contribution_start Set a contribution start date when this invoice contains contribution.
     *
     * @return self
     */
    public function setContributionStart($contribution_start)
    {
        if (is_null($contribution_start)) {
            array_push($this->openAPINullablesSetToNull, 'contribution_start');
        } else {
            $nullablesSetToNull = $this->getOpenAPINullablesSetToNull();
            $index = array_search('contribution_start', $nullablesSetToNull);
            if ($index !== FALSE) {
                unset($nullablesSetToNull[$index]);
                $this->setOpenAPINullablesSetToNull($nullablesSetToNull);
            }
        }
        $this->container['contribution_start'] = $contribution_start;

        return $this;
    }

    /**
     * Gets contribution_end
     *
     * @return \DateTime|null
     */
    public function getContributionEnd()
    {
        return $this->container['contribution_end'];
    }

    /**
     * Sets contribution_end
     *
     * @param \DateTime|null $contribution_end Set a contribution end date when this invoice contains contribution for a given period.
     *
     * @return self
     */
    public function setContributionEnd($contribution_end)
    {
        if (is_null($contribution_end)) {
            array_push($this->openAPINullablesSetToNull, 'contribution_end');
        } else {
            $nullablesSetToNull = $this->getOpenAPINullablesSetToNull();
            $index = array_search('contribution_end', $nullablesSetToNull);
            if ($index !== FALSE) {
                unset($nullablesSetToNull[$index]);
                $this->setOpenAPINullablesSetToNull($nullablesSetToNull);
            }
        }
        $this->container['contribution_end'] = $contribution_end;

        return $this;
    }

    /**
     * Gets use_direct_debit
     *
     * @return bool|null
     */
    public function getUseDirectDebit()
    {
        return $this->container['use_direct_debit'];
    }

    /**
     * Sets use_direct_debit
     *
     * @param bool|null $use_direct_debit Set to true to use direct debit to collect this sale invoice. Take care: this value is normally set automatically when the associated member has a valid direct debit mandate, the workflow has direct debit enabled and the association has a valid direct debit contract with the bank.
     *
     * @return self
     */
    public function setUseDirectDebit($use_direct_debit)
    {
        if (is_null($use_direct_debit)) {
            array_push($this->openAPINullablesSetToNull, 'use_direct_debit');
        } else {
            $nullablesSetToNull = $this->getOpenAPINullablesSetToNull();
            $index = array_search('use_direct_debit', $nullablesSetToNull);
            if ($index !== FALSE) {
                unset($nullablesSetToNull[$index]);
                $this->setOpenAPINullablesSetToNull($nullablesSetToNull);
            }
        }
        $this->container['use_direct_debit'] = $use_direct_debit;

        return $this;
    }

    /**
     * Gets invoice_workflow_id
     *
     * @return int|null
     */
    public function getInvoiceWorkflowId()
    {
        return $this->container['invoice_workflow_id'];
    }

    /**
     * Sets invoice_workflow_id
     *
     * @param int|null $invoice_workflow_id ID for the sale invoice workflow for this sale invoice. When omitted, the default workflow for the API is used.
     *
     * @return self
     */
    public function setInvoiceWorkflowId($invoice_workflow_id)
    {
        if (is_null($invoice_workflow_id)) {
            array_push($this->openAPINullablesSetToNull, 'invoice_workflow_id');
        } else {
            $nullablesSetToNull = $this->getOpenAPINullablesSetToNull();
            $index = array_search('invoice_workflow_id', $nullablesSetToNull);
            if ($index !== FALSE) {
                unset($nullablesSetToNull[$index]);
                $this->setOpenAPINullablesSetToNull($nullablesSetToNull);
            }
        }
        $this->container['invoice_workflow_id'] = $invoice_workflow_id;

        return $this;
    }

    /**
     * Gets addressee
     *
     * @return string|null
     */
    public function getAddressee()
    {
        return $this->container['addressee'];
    }

    /**
     * Sets addressee
     *
     * @param string|null $addressee Required when collection_id and member_id are omitted.
     *
     * @return self
     */
    public function setAddressee($addressee)
    {
        if (is_null($addressee)) {
            throw new \InvalidArgumentException('non-nullable addressee cannot be null');
        }
        $this->container['addressee'] = $addressee;

        return $this;
    }

    /**
     * Gets addressee_attention
     *
     * @return string|null
     */
    public function getAddresseeAttention()
    {
        return $this->container['addressee_attention'];
    }

    /**
     * Sets addressee_attention
     *
     * @param string|null $addressee_attention Attention of the addressee, commonly used when the addressee is a company.
     *
     * @return self
     */
    public function setAddresseeAttention($addressee_attention)
    {
        if (is_null($addressee_attention)) {
            throw new \InvalidArgumentException('non-nullable addressee_attention cannot be null');
        }
        $this->container['addressee_attention'] = $addressee_attention;

        return $this;
    }

    /**
     * Gets email
     *
     * @return string|null
     */
    public function getEmail()
    {
        return $this->container['email'];
    }

    /**
     * Sets email
     *
     * @param string|null $email email
     *
     * @return self
     */
    public function setEmail($email)
    {
        if (is_null($email)) {
            throw new \InvalidArgumentException('non-nullable email cannot be null');
        }
        $this->container['email'] = $email;

        return $this;
    }

    /**
     * Gets address
     *
     * @return \OpenAPI\Client\Model\Address|null
     */
    public function getAddress()
    {
        return $this->container['address'];
    }

    /**
     * Sets address
     *
     * @param \OpenAPI\Client\Model\Address|null $address address
     *
     * @return self
     */
    public function setAddress($address)
    {
        if (is_null($address)) {
            throw new \InvalidArgumentException('non-nullable address cannot be null');
        }
        $this->container['address'] = $address;

        return $this;
    }

    /**
     * Gets items
     *
     * @return \OpenAPI\Client\Model\SaleInvoiceItem[]
     */
    public function getItems()
    {
        return $this->container['items'];
    }

    /**
     * Sets items
     *
     * @param \OpenAPI\Client\Model\SaleInvoiceItem[] $items items
     *
     * @return self
     */
    public function setItems($items)
    {
        if (is_null($items)) {
            throw new \InvalidArgumentException('non-nullable items cannot be null');
        }
        $this->container['items'] = $items;

        return $this;
    }

    /**
     * Gets payments
     *
     * @return \OpenAPI\Client\Model\SaleInvoicePayment[]|null
     */
    public function getPayments()
    {
        return $this->container['payments'];
    }

    /**
     * Sets payments
     *
     * @param \OpenAPI\Client\Model\SaleInvoicePayment[]|null $payments payments
     *
     * @return self
     */
    public function setPayments($payments)
    {
        if (is_null($payments)) {
            throw new \InvalidArgumentException('non-nullable payments cannot be null');
        }
        $this->container['payments'] = $payments;

        return $this;
    }

    /**
     * Gets price_inclusive_vat
     *
     * @return mixed|null
     */
    public function getPriceInclusiveVat()
    {
        return $this->container['price_inclusive_vat'];
    }

    /**
     * Sets price_inclusive_vat
     *
     * @param mixed|null $price_inclusive_vat price_inclusive_vat
     *
     * @return self
     */
    public function setPriceInclusiveVat($price_inclusive_vat)
    {
        if (is_null($price_inclusive_vat)) {
            array_push($this->openAPINullablesSetToNull, 'price_inclusive_vat');
        } else {
            $nullablesSetToNull = $this->getOpenAPINullablesSetToNull();
            $index = array_search('price_inclusive_vat', $nullablesSetToNull);
            if ($index !== FALSE) {
                unset($nullablesSetToNull[$index]);
                $this->setOpenAPINullablesSetToNull($nullablesSetToNull);
            }
        }
        $this->container['price_inclusive_vat'] = $price_inclusive_vat;

        return $this;
    }

    /**
     * Gets price_exclusive_vat
     *
     * @return mixed|null
     */
    public function getPriceExclusiveVat()
    {
        return $this->container['price_exclusive_vat'];
    }

    /**
     * Sets price_exclusive_vat
     *
     * @param mixed|null $price_exclusive_vat price_exclusive_vat
     *
     * @return self
     */
    public function setPriceExclusiveVat($price_exclusive_vat)
    {
        if (is_null($price_exclusive_vat)) {
            array_push($this->openAPINullablesSetToNull, 'price_exclusive_vat');
        } else {
            $nullablesSetToNull = $this->getOpenAPINullablesSetToNull();
            $index = array_search('price_exclusive_vat', $nullablesSetToNull);
            if ($index !== FALSE) {
                unset($nullablesSetToNull[$index]);
                $this->setOpenAPINullablesSetToNull($nullablesSetToNull);
            }
        }
        $this->container['price_exclusive_vat'] = $price_exclusive_vat;

        return $this;
    }

    /**
     * Gets vat
     *
     * @return mixed|null
     */
    public function getVat()
    {
        return $this->container['vat'];
    }

    /**
     * Sets vat
     *
     * @param mixed|null $vat vat
     *
     * @return self
     */
    public function setVat($vat)
    {
        if (is_null($vat)) {
            array_push($this->openAPINullablesSetToNull, 'vat');
        } else {
            $nullablesSetToNull = $this->getOpenAPINullablesSetToNull();
            $index = array_search('vat', $nullablesSetToNull);
            if ($index !== FALSE) {
                unset($nullablesSetToNull[$index]);
                $this->setOpenAPINullablesSetToNull($nullablesSetToNull);
            }
        }
        $this->container['vat'] = $vat;

        return $this;
    }

    /**
     * Gets price_paid
     *
     * @return mixed|null
     */
    public function getPricePaid()
    {
        return $this->container['price_paid'];
    }

    /**
     * Sets price_paid
     *
     * @param mixed|null $price_paid price_paid
     *
     * @return self
     */
    public function setPricePaid($price_paid)
    {
        if (is_null($price_paid)) {
            array_push($this->openAPINullablesSetToNull, 'price_paid');
        } else {
            $nullablesSetToNull = $this->getOpenAPINullablesSetToNull();
            $index = array_search('price_paid', $nullablesSetToNull);
            if ($index !== FALSE) {
                unset($nullablesSetToNull[$index]);
                $this->setOpenAPINullablesSetToNull($nullablesSetToNull);
            }
        }
        $this->container['price_paid'] = $price_paid;

        return $this;
    }

    /**
     * Gets price_unpaid
     *
     * @return mixed|null
     */
    public function getPriceUnpaid()
    {
        return $this->container['price_unpaid'];
    }

    /**
     * Sets price_unpaid
     *
     * @param mixed|null $price_unpaid price_unpaid
     *
     * @return self
     */
    public function setPriceUnpaid($price_unpaid)
    {
        if (is_null($price_unpaid)) {
            array_push($this->openAPINullablesSetToNull, 'price_unpaid');
        } else {
            $nullablesSetToNull = $this->getOpenAPINullablesSetToNull();
            $index = array_search('price_unpaid', $nullablesSetToNull);
            if ($index !== FALSE) {
                unset($nullablesSetToNull[$index]);
                $this->setOpenAPINullablesSetToNull($nullablesSetToNull);
            }
        }
        $this->container['price_unpaid'] = $price_unpaid;

        return $this;
    }

    /**
     * Gets currency
     *
     * @return mixed|null
     */
    public function getCurrency()
    {
        return $this->container['currency'];
    }

    /**
     * Sets currency
     *
     * @param mixed|null $currency currency
     *
     * @return self
     */
    public function setCurrency($currency)
    {
        if (is_null($currency)) {
            array_push($this->openAPINullablesSetToNull, 'currency');
        } else {
            $nullablesSetToNull = $this->getOpenAPINullablesSetToNull();
            $index = array_search('currency', $nullablesSetToNull);
            if ($index !== FALSE) {
                unset($nullablesSetToNull[$index]);
                $this->setOpenAPINullablesSetToNull($nullablesSetToNull);
            }
        }
        $this->container['currency'] = $currency;

        return $this;
    }

    /**
     * Gets created
     *
     * @return \DateTime|null
     */
    public function getCreated()
    {
        return $this->container['created'];
    }

    /**
     * Sets created
     *
     * @param \DateTime|null $created created
     *
     * @return self
     */
    public function setCreated($created)
    {
        if (is_null($created)) {
            array_push($this->openAPINullablesSetToNull, 'created');
        } else {
            $nullablesSetToNull = $this->getOpenAPINullablesSetToNull();
            $index = array_search('created', $nullablesSetToNull);
            if ($index !== FALSE) {
                unset($nullablesSetToNull[$index]);
                $this->setOpenAPINullablesSetToNull($nullablesSetToNull);
            }
        }
        $this->container['created'] = $created;

        return $this;
    }

    /**
     * Gets modified
     *
     * @return \DateTime|null
     */
    public function getModified()
    {
        return $this->container['modified'];
    }

    /**
     * Sets modified
     *
     * @param \DateTime|null $modified modified
     *
     * @return self
     */
    public function setModified($modified)
    {
        if (is_null($modified)) {
            array_push($this->openAPINullablesSetToNull, 'modified');
        } else {
            $nullablesSetToNull = $this->getOpenAPINullablesSetToNull();
            $index = array_search('modified', $nullablesSetToNull);
            if ($index !== FALSE) {
                unset($nullablesSetToNull[$index]);
                $this->setOpenAPINullablesSetToNull($nullablesSetToNull);
            }
        }
        $this->container['modified'] = $modified;

        return $this;
    }
    /**
     * Returns true if offset exists. False otherwise.
     *
     * @param integer $offset Offset
     *
     * @return boolean
     */
    public function offsetExists($offset): bool
    {
        return isset($this->container[$offset]);
    }

    /**
     * Gets offset.
     *
     * @param integer $offset Offset
     *
     * @return mixed|null
     */
    #[\ReturnTypeWillChange]
    public function offsetGet($offset)
    {
        return $this->container[$offset] ?? null;
    }

    /**
     * Sets value based on offset.
     *
     * @param int|null $offset Offset
     * @param mixed    $value  Value to be set
     *
     * @return void
     */
    public function offsetSet($offset, $value): void
    {
        if (is_null($offset)) {
            $this->container[] = $value;
        } else {
            $this->container[$offset] = $value;
        }
    }

    /**
     * Unsets offset.
     *
     * @param integer $offset Offset
     *
     * @return void
     */
    public function offsetUnset($offset): void
    {
        unset($this->container[$offset]);
    }

    /**
     * Serializes the object to a value that can be serialized natively by json_encode().
     * @link https://www.php.net/manual/en/jsonserializable.jsonserialize.php
     *
     * @return mixed Returns data which can be serialized by json_encode(), which is a value
     * of any type other than a resource.
     */
    #[\ReturnTypeWillChange]
    public function jsonSerialize()
    {
       return ObjectSerializer::sanitizeForSerialization($this);
    }

    /**
     * Gets the string presentation of the object
     *
     * @return string
     */
    public function __toString()
    {
        return json_encode(
            ObjectSerializer::sanitizeForSerialization($this),
            JSON_PRETTY_PRINT
        );
    }

    /**
     * Gets a header-safe presentation of the object
     *
     * @return string
     */
    public function toHeaderValue()
    {
        return json_encode(ObjectSerializer::sanitizeForSerialization($this));
    }
}


