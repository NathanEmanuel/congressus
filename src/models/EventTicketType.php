<?php
/**
 * EventTicketType
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
 * EventTicketType Class Doc Comment
 *
 * @category Class
 * @package  OpenAPI\Client
 * @author   OpenAPI Generator team
 * @link     https://openapi-generator.tech
 * @implements \ArrayAccess<string, mixed>
 */
class EventTicketType implements ModelInterface, ArrayAccess, \JsonSerializable
{
    public const DISCRIMINATOR = null;

    /**
      * The original name of the model.
      *
      * @var string
      */
    protected static $openAPIModelName = 'EventTicketType';

    /**
      * Array of property to type mappings. Used for (de)serialization
      *
      * @var string[]
      */
    protected static $openAPITypes = [
        'availability_status' => 'string',
        'available_from' => '\DateTime',
        'available_to' => '\DateTime',
        'cancel_to' => '\DateTime',
        'confirmation_email_text' => 'string',
        'confirmation_email_text_enabled' => 'bool',
        'description' => 'string',
        'event_id' => 'int',
        'filter_id' => 'int',
        'id' => 'int',
        'modified' => '\DateTime',
        'name' => 'string',
        'num_tickets' => 'int',
        'num_tickets_available' => 'mixed',
        'num_tickets_max' => 'int',
        'num_tickets_max_per' => 'string',
        'num_tickets_sold' => 'int',
        'price' => 'float',
        'pricing_enabled' => 'bool',
        'vat_category' => '\OpenAPI\Client\Model\VatCategory',
        'vat_category_id' => 'int',
        'visibility_level' => 'string',
        'waiting_list_enabled' => 'bool',
        'participation_certificate_credits' => 'float'
    ];

    /**
      * Array of property to format mappings. Used for (de)serialization
      *
      * @var string[]
      * @phpstan-var array<string, string|null>
      * @psalm-var array<string, string|null>
      */
    protected static $openAPIFormats = [
        'availability_status' => null,
        'available_from' => 'date-time',
        'available_to' => 'date-time',
        'cancel_to' => 'date-time',
        'confirmation_email_text' => null,
        'confirmation_email_text_enabled' => null,
        'description' => null,
        'event_id' => null,
        'filter_id' => null,
        'id' => null,
        'modified' => 'date-time',
        'name' => null,
        'num_tickets' => null,
        'num_tickets_available' => null,
        'num_tickets_max' => null,
        'num_tickets_max_per' => null,
        'num_tickets_sold' => null,
        'price' => null,
        'pricing_enabled' => null,
        'vat_category' => null,
        'vat_category_id' => null,
        'visibility_level' => null,
        'waiting_list_enabled' => null,
        'participation_certificate_credits' => null
    ];

    /**
      * Array of nullable properties. Used for (de)serialization
      *
      * @var boolean[]
      */
    protected static array $openAPINullables = [
        'availability_status' => false,
        'available_from' => true,
        'available_to' => true,
        'cancel_to' => true,
        'confirmation_email_text' => true,
        'confirmation_email_text_enabled' => false,
        'description' => true,
        'event_id' => true,
        'filter_id' => true,
        'id' => false,
        'modified' => true,
        'name' => false,
        'num_tickets' => false,
        'num_tickets_available' => true,
        'num_tickets_max' => true,
        'num_tickets_max_per' => true,
        'num_tickets_sold' => false,
        'price' => true,
        'pricing_enabled' => true,
        'vat_category' => false,
        'vat_category_id' => true,
        'visibility_level' => false,
        'waiting_list_enabled' => true,
        'participation_certificate_credits' => true
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
        'availability_status' => 'availability_status',
        'available_from' => 'available_from',
        'available_to' => 'available_to',
        'cancel_to' => 'cancel_to',
        'confirmation_email_text' => 'confirmation_email_text',
        'confirmation_email_text_enabled' => 'confirmation_email_text_enabled',
        'description' => 'description',
        'event_id' => 'event_id',
        'filter_id' => 'filter_id',
        'id' => 'id',
        'modified' => 'modified',
        'name' => 'name',
        'num_tickets' => 'num_tickets',
        'num_tickets_available' => 'num_tickets_available',
        'num_tickets_max' => 'num_tickets_max',
        'num_tickets_max_per' => 'num_tickets_max_per',
        'num_tickets_sold' => 'num_tickets_sold',
        'price' => 'price',
        'pricing_enabled' => 'pricing_enabled',
        'vat_category' => 'vat_category',
        'vat_category_id' => 'vat_category_id',
        'visibility_level' => 'visibility_level',
        'waiting_list_enabled' => 'waiting_list_enabled',
        'participation_certificate_credits' => 'participation_certificate_credits'
    ];

    /**
     * Array of attributes to setter functions (for deserialization of responses)
     *
     * @var string[]
     */
    protected static $setters = [
        'availability_status' => 'setAvailabilityStatus',
        'available_from' => 'setAvailableFrom',
        'available_to' => 'setAvailableTo',
        'cancel_to' => 'setCancelTo',
        'confirmation_email_text' => 'setConfirmationEmailText',
        'confirmation_email_text_enabled' => 'setConfirmationEmailTextEnabled',
        'description' => 'setDescription',
        'event_id' => 'setEventId',
        'filter_id' => 'setFilterId',
        'id' => 'setId',
        'modified' => 'setModified',
        'name' => 'setName',
        'num_tickets' => 'setNumTickets',
        'num_tickets_available' => 'setNumTicketsAvailable',
        'num_tickets_max' => 'setNumTicketsMax',
        'num_tickets_max_per' => 'setNumTicketsMaxPer',
        'num_tickets_sold' => 'setNumTicketsSold',
        'price' => 'setPrice',
        'pricing_enabled' => 'setPricingEnabled',
        'vat_category' => 'setVatCategory',
        'vat_category_id' => 'setVatCategoryId',
        'visibility_level' => 'setVisibilityLevel',
        'waiting_list_enabled' => 'setWaitingListEnabled',
        'participation_certificate_credits' => 'setParticipationCertificateCredits'
    ];

    /**
     * Array of attributes to getter functions (for serialization of requests)
     *
     * @var string[]
     */
    protected static $getters = [
        'availability_status' => 'getAvailabilityStatus',
        'available_from' => 'getAvailableFrom',
        'available_to' => 'getAvailableTo',
        'cancel_to' => 'getCancelTo',
        'confirmation_email_text' => 'getConfirmationEmailText',
        'confirmation_email_text_enabled' => 'getConfirmationEmailTextEnabled',
        'description' => 'getDescription',
        'event_id' => 'getEventId',
        'filter_id' => 'getFilterId',
        'id' => 'getId',
        'modified' => 'getModified',
        'name' => 'getName',
        'num_tickets' => 'getNumTickets',
        'num_tickets_available' => 'getNumTicketsAvailable',
        'num_tickets_max' => 'getNumTicketsMax',
        'num_tickets_max_per' => 'getNumTicketsMaxPer',
        'num_tickets_sold' => 'getNumTicketsSold',
        'price' => 'getPrice',
        'pricing_enabled' => 'getPricingEnabled',
        'vat_category' => 'getVatCategory',
        'vat_category_id' => 'getVatCategoryId',
        'visibility_level' => 'getVisibilityLevel',
        'waiting_list_enabled' => 'getWaitingListEnabled',
        'participation_certificate_credits' => 'getParticipationCertificateCredits'
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

    public const AVAILABILITY_STATUS_AVAILABLE = 'available';
    public const AVAILABILITY_STATUS_LIMITED = 'limited';
    public const AVAILABILITY_STATUS_WAITING_LIST = 'waiting list';
    public const AVAILABILITY_STATUS_SOLD_OUT = 'sold out';
    public const AVAILABILITY_STATUS_AVAILABLE_SOON = 'available soon';
    public const AVAILABILITY_STATUS_UNAVAILABLE = 'unavailable';

    /**
     * Gets allowable values of the enum
     *
     * @return string[]
     */
    public function getAvailabilityStatusAllowableValues()
    {
        return [
            self::AVAILABILITY_STATUS_AVAILABLE,
            self::AVAILABILITY_STATUS_LIMITED,
            self::AVAILABILITY_STATUS_WAITING_LIST,
            self::AVAILABILITY_STATUS_SOLD_OUT,
            self::AVAILABILITY_STATUS_AVAILABLE_SOON,
            self::AVAILABILITY_STATUS_UNAVAILABLE,
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
        $this->setIfExists('availability_status', $data ?? [], null);
        $this->setIfExists('available_from', $data ?? [], null);
        $this->setIfExists('available_to', $data ?? [], null);
        $this->setIfExists('cancel_to', $data ?? [], null);
        $this->setIfExists('confirmation_email_text', $data ?? [], null);
        $this->setIfExists('confirmation_email_text_enabled', $data ?? [], null);
        $this->setIfExists('description', $data ?? [], null);
        $this->setIfExists('event_id', $data ?? [], null);
        $this->setIfExists('filter_id', $data ?? [], null);
        $this->setIfExists('id', $data ?? [], null);
        $this->setIfExists('modified', $data ?? [], null);
        $this->setIfExists('name', $data ?? [], null);
        $this->setIfExists('num_tickets', $data ?? [], null);
        $this->setIfExists('num_tickets_available', $data ?? [], null);
        $this->setIfExists('num_tickets_max', $data ?? [], null);
        $this->setIfExists('num_tickets_max_per', $data ?? [], null);
        $this->setIfExists('num_tickets_sold', $data ?? [], null);
        $this->setIfExists('price', $data ?? [], null);
        $this->setIfExists('pricing_enabled', $data ?? [], null);
        $this->setIfExists('vat_category', $data ?? [], null);
        $this->setIfExists('vat_category_id', $data ?? [], null);
        $this->setIfExists('visibility_level', $data ?? [], null);
        $this->setIfExists('waiting_list_enabled', $data ?? [], null);
        $this->setIfExists('participation_certificate_credits', $data ?? [], null);
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

        $allowedValues = $this->getAvailabilityStatusAllowableValues();
        if (!is_null($this->container['availability_status']) && !in_array($this->container['availability_status'], $allowedValues, true)) {
            $invalidProperties[] = sprintf(
                "invalid value '%s' for 'availability_status', must be one of '%s'",
                $this->container['availability_status'],
                implode("', '", $allowedValues)
            );
        }

        if ($this->container['name'] === null) {
            $invalidProperties[] = "'name' can't be null";
        }
        if ((mb_strlen($this->container['name']) > 255)) {
            $invalidProperties[] = "invalid value for 'name', the character length must be smaller than or equal to 255.";
        }

        if (!is_null($this->container['num_tickets_max_per']) && (mb_strlen($this->container['num_tickets_max_per']) > 255)) {
            $invalidProperties[] = "invalid value for 'num_tickets_max_per', the character length must be smaller than or equal to 255.";
        }

        if (!is_null($this->container['price']) && ($this->container['price'] < 0)) {
            $invalidProperties[] = "invalid value for 'price', must be bigger than or equal to 0.";
        }

        if ($this->container['vat_category_id'] === null) {
            $invalidProperties[] = "'vat_category_id' can't be null";
        }
        if (!is_null($this->container['participation_certificate_credits']) && ($this->container['participation_certificate_credits'] < 0)) {
            $invalidProperties[] = "invalid value for 'participation_certificate_credits', must be bigger than or equal to 0.";
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
     * Gets availability_status
     *
     * @return string|null
     */
    public function getAvailabilityStatus()
    {
        return $this->container['availability_status'];
    }

    /**
     * Sets availability_status
     *
     * @param string|null $availability_status Status for the availability of this ticket type. Ticket types with status \"available\", \"limited\" and \"waiting list\" are available for new participants.
     *
     * @return self
     */
    public function setAvailabilityStatus($availability_status)
    {
        if (is_null($availability_status)) {
            throw new \InvalidArgumentException('non-nullable availability_status cannot be null');
        }
        $allowedValues = $this->getAvailabilityStatusAllowableValues();
        if (!in_array($availability_status, $allowedValues, true)) {
            throw new \InvalidArgumentException(
                sprintf(
                    "Invalid value '%s' for 'availability_status', must be one of '%s'",
                    $availability_status,
                    implode("', '", $allowedValues)
                )
            );
        }
        $this->container['availability_status'] = $availability_status;

        return $this;
    }

    /**
     * Gets available_from
     *
     * @return \DateTime|null
     */
    public function getAvailableFrom()
    {
        return $this->container['available_from'];
    }

    /**
     * Sets available_from
     *
     * @param \DateTime|null $available_from available_from
     *
     * @return self
     */
    public function setAvailableFrom($available_from)
    {
        if (is_null($available_from)) {
            array_push($this->openAPINullablesSetToNull, 'available_from');
        } else {
            $nullablesSetToNull = $this->getOpenAPINullablesSetToNull();
            $index = array_search('available_from', $nullablesSetToNull);
            if ($index !== FALSE) {
                unset($nullablesSetToNull[$index]);
                $this->setOpenAPINullablesSetToNull($nullablesSetToNull);
            }
        }
        $this->container['available_from'] = $available_from;

        return $this;
    }

    /**
     * Gets available_to
     *
     * @return \DateTime|null
     */
    public function getAvailableTo()
    {
        return $this->container['available_to'];
    }

    /**
     * Sets available_to
     *
     * @param \DateTime|null $available_to available_to
     *
     * @return self
     */
    public function setAvailableTo($available_to)
    {
        if (is_null($available_to)) {
            array_push($this->openAPINullablesSetToNull, 'available_to');
        } else {
            $nullablesSetToNull = $this->getOpenAPINullablesSetToNull();
            $index = array_search('available_to', $nullablesSetToNull);
            if ($index !== FALSE) {
                unset($nullablesSetToNull[$index]);
                $this->setOpenAPINullablesSetToNull($nullablesSetToNull);
            }
        }
        $this->container['available_to'] = $available_to;

        return $this;
    }

    /**
     * Gets cancel_to
     *
     * @return \DateTime|null
     */
    public function getCancelTo()
    {
        return $this->container['cancel_to'];
    }

    /**
     * Sets cancel_to
     *
     * @param \DateTime|null $cancel_to cancel_to
     *
     * @return self
     */
    public function setCancelTo($cancel_to)
    {
        if (is_null($cancel_to)) {
            array_push($this->openAPINullablesSetToNull, 'cancel_to');
        } else {
            $nullablesSetToNull = $this->getOpenAPINullablesSetToNull();
            $index = array_search('cancel_to', $nullablesSetToNull);
            if ($index !== FALSE) {
                unset($nullablesSetToNull[$index]);
                $this->setOpenAPINullablesSetToNull($nullablesSetToNull);
            }
        }
        $this->container['cancel_to'] = $cancel_to;

        return $this;
    }

    /**
     * Gets confirmation_email_text
     *
     * @return string|null
     */
    public function getConfirmationEmailText()
    {
        return $this->container['confirmation_email_text'];
    }

    /**
     * Sets confirmation_email_text
     *
     * @param string|null $confirmation_email_text Additional text added to the confirmation email for participants. Only added when the corresponding boolean is set to True
     *
     * @return self
     */
    public function setConfirmationEmailText($confirmation_email_text)
    {
        if (is_null($confirmation_email_text)) {
            array_push($this->openAPINullablesSetToNull, 'confirmation_email_text');
        } else {
            $nullablesSetToNull = $this->getOpenAPINullablesSetToNull();
            $index = array_search('confirmation_email_text', $nullablesSetToNull);
            if ($index !== FALSE) {
                unset($nullablesSetToNull[$index]);
                $this->setOpenAPINullablesSetToNull($nullablesSetToNull);
            }
        }
        $this->container['confirmation_email_text'] = $confirmation_email_text;

        return $this;
    }

    /**
     * Gets confirmation_email_text_enabled
     *
     * @return bool|null
     */
    public function getConfirmationEmailTextEnabled()
    {
        return $this->container['confirmation_email_text_enabled'];
    }

    /**
     * Sets confirmation_email_text_enabled
     *
     * @param bool|null $confirmation_email_text_enabled True when an additional text has to be added to the confirmation email for participants
     *
     * @return self
     */
    public function setConfirmationEmailTextEnabled($confirmation_email_text_enabled)
    {
        if (is_null($confirmation_email_text_enabled)) {
            throw new \InvalidArgumentException('non-nullable confirmation_email_text_enabled cannot be null');
        }
        $this->container['confirmation_email_text_enabled'] = $confirmation_email_text_enabled;

        return $this;
    }

    /**
     * Gets description
     *
     * @return string|null
     */
    public function getDescription()
    {
        return $this->container['description'];
    }

    /**
     * Sets description
     *
     * @param string|null $description Optional description for this ticket type
     *
     * @return self
     */
    public function setDescription($description)
    {
        if (is_null($description)) {
            array_push($this->openAPINullablesSetToNull, 'description');
        } else {
            $nullablesSetToNull = $this->getOpenAPINullablesSetToNull();
            $index = array_search('description', $nullablesSetToNull);
            if ($index !== FALSE) {
                unset($nullablesSetToNull[$index]);
                $this->setOpenAPINullablesSetToNull($nullablesSetToNull);
            }
        }
        $this->container['description'] = $description;

        return $this;
    }

    /**
     * Gets event_id
     *
     * @return int|null
     */
    public function getEventId()
    {
        return $this->container['event_id'];
    }

    /**
     * Sets event_id
     *
     * @param int|null $event_id event_id
     *
     * @return self
     */
    public function setEventId($event_id)
    {
        if (is_null($event_id)) {
            array_push($this->openAPINullablesSetToNull, 'event_id');
        } else {
            $nullablesSetToNull = $this->getOpenAPINullablesSetToNull();
            $index = array_search('event_id', $nullablesSetToNull);
            if ($index !== FALSE) {
                unset($nullablesSetToNull[$index]);
                $this->setOpenAPINullablesSetToNull($nullablesSetToNull);
            }
        }
        $this->container['event_id'] = $event_id;

        return $this;
    }

    /**
     * Gets filter_id
     *
     * @return int|null
     */
    public function getFilterId()
    {
        return $this->container['filter_id'];
    }

    /**
     * Sets filter_id
     *
     * @param int|null $filter_id filter_id
     *
     * @return self
     */
    public function setFilterId($filter_id)
    {
        if (is_null($filter_id)) {
            array_push($this->openAPINullablesSetToNull, 'filter_id');
        } else {
            $nullablesSetToNull = $this->getOpenAPINullablesSetToNull();
            $index = array_search('filter_id', $nullablesSetToNull);
            if ($index !== FALSE) {
                unset($nullablesSetToNull[$index]);
                $this->setOpenAPINullablesSetToNull($nullablesSetToNull);
            }
        }
        $this->container['filter_id'] = $filter_id;

        return $this;
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
     * Gets name
     *
     * @return string
     */
    public function getName()
    {
        return $this->container['name'];
    }

    /**
     * Sets name
     *
     * @param string $name Name for this ticket type
     *
     * @return self
     */
    public function setName($name)
    {
        if (is_null($name)) {
            throw new \InvalidArgumentException('non-nullable name cannot be null');
        }
        if ((mb_strlen($name) > 255)) {
            throw new \InvalidArgumentException('invalid length for $name when calling EventTicketType., must be smaller than or equal to 255.');
        }

        $this->container['name'] = $name;

        return $this;
    }

    /**
     * Gets num_tickets
     *
     * @return int|null
     */
    public function getNumTickets()
    {
        return $this->container['num_tickets'];
    }

    /**
     * Sets num_tickets
     *
     * @param int|null $num_tickets Max. number of tickets that could be sold for this ticket type
     *
     * @return self
     */
    public function setNumTickets($num_tickets)
    {
        if (is_null($num_tickets)) {
            throw new \InvalidArgumentException('non-nullable num_tickets cannot be null');
        }
        $this->container['num_tickets'] = $num_tickets;

        return $this;
    }

    /**
     * Gets num_tickets_available
     *
     * @return mixed|null
     */
    public function getNumTicketsAvailable()
    {
        return $this->container['num_tickets_available'];
    }

    /**
     * Sets num_tickets_available
     *
     * @param mixed|null $num_tickets_available num_tickets_available
     *
     * @return self
     */
    public function setNumTicketsAvailable($num_tickets_available)
    {
        if (is_null($num_tickets_available)) {
            array_push($this->openAPINullablesSetToNull, 'num_tickets_available');
        } else {
            $nullablesSetToNull = $this->getOpenAPINullablesSetToNull();
            $index = array_search('num_tickets_available', $nullablesSetToNull);
            if ($index !== FALSE) {
                unset($nullablesSetToNull[$index]);
                $this->setOpenAPINullablesSetToNull($nullablesSetToNull);
            }
        }
        $this->container['num_tickets_available'] = $num_tickets_available;

        return $this;
    }

    /**
     * Gets num_tickets_max
     *
     * @return int|null
     */
    public function getNumTicketsMax()
    {
        return $this->container['num_tickets_max'];
    }

    /**
     * Sets num_tickets_max
     *
     * @param int|null $num_tickets_max num_tickets_max
     *
     * @return self
     */
    public function setNumTicketsMax($num_tickets_max)
    {
        if (is_null($num_tickets_max)) {
            array_push($this->openAPINullablesSetToNull, 'num_tickets_max');
        } else {
            $nullablesSetToNull = $this->getOpenAPINullablesSetToNull();
            $index = array_search('num_tickets_max', $nullablesSetToNull);
            if ($index !== FALSE) {
                unset($nullablesSetToNull[$index]);
                $this->setOpenAPINullablesSetToNull($nullablesSetToNull);
            }
        }
        $this->container['num_tickets_max'] = $num_tickets_max;

        return $this;
    }

    /**
     * Gets num_tickets_max_per
     *
     * @return string|null
     */
    public function getNumTicketsMaxPer()
    {
        return $this->container['num_tickets_max_per'];
    }

    /**
     * Sets num_tickets_max_per
     *
     * @param string|null $num_tickets_max_per num_tickets_max_per
     *
     * @return self
     */
    public function setNumTicketsMaxPer($num_tickets_max_per)
    {
        if (is_null($num_tickets_max_per)) {
            array_push($this->openAPINullablesSetToNull, 'num_tickets_max_per');
        } else {
            $nullablesSetToNull = $this->getOpenAPINullablesSetToNull();
            $index = array_search('num_tickets_max_per', $nullablesSetToNull);
            if ($index !== FALSE) {
                unset($nullablesSetToNull[$index]);
                $this->setOpenAPINullablesSetToNull($nullablesSetToNull);
            }
        }
        if (!is_null($num_tickets_max_per) && (mb_strlen($num_tickets_max_per) > 255)) {
            throw new \InvalidArgumentException('invalid length for $num_tickets_max_per when calling EventTicketType., must be smaller than or equal to 255.');
        }

        $this->container['num_tickets_max_per'] = $num_tickets_max_per;

        return $this;
    }

    /**
     * Gets num_tickets_sold
     *
     * @return int|null
     */
    public function getNumTicketsSold()
    {
        return $this->container['num_tickets_sold'];
    }

    /**
     * Sets num_tickets_sold
     *
     * @param int|null $num_tickets_sold Number of tickets that are sold for this ticket type
     *
     * @return self
     */
    public function setNumTicketsSold($num_tickets_sold)
    {
        if (is_null($num_tickets_sold)) {
            throw new \InvalidArgumentException('non-nullable num_tickets_sold cannot be null');
        }
        $this->container['num_tickets_sold'] = $num_tickets_sold;

        return $this;
    }

    /**
     * Gets price
     *
     * @return float|null
     */
    public function getPrice()
    {
        return $this->container['price'];
    }

    /**
     * Sets price
     *
     * @param float|null $price Price for this ticket. Set to 0 to show _free_, set to null to hide price.
     *
     * @return self
     */
    public function setPrice($price)
    {
        if (is_null($price)) {
            array_push($this->openAPINullablesSetToNull, 'price');
        } else {
            $nullablesSetToNull = $this->getOpenAPINullablesSetToNull();
            $index = array_search('price', $nullablesSetToNull);
            if ($index !== FALSE) {
                unset($nullablesSetToNull[$index]);
                $this->setOpenAPINullablesSetToNull($nullablesSetToNull);
            }
        }

        if (!is_null($price) && ($price < 0)) {
            throw new \InvalidArgumentException('invalid value for $price when calling EventTicketType., must be bigger than or equal to 0.');
        }

        $this->container['price'] = $price;

        return $this;
    }

    /**
     * Gets pricing_enabled
     *
     * @return bool|null
     */
    public function getPricingEnabled()
    {
        return $this->container['pricing_enabled'];
    }

    /**
     * Sets pricing_enabled
     *
     * @param bool|null $pricing_enabled pricing_enabled
     *
     * @return self
     */
    public function setPricingEnabled($pricing_enabled)
    {
        if (is_null($pricing_enabled)) {
            array_push($this->openAPINullablesSetToNull, 'pricing_enabled');
        } else {
            $nullablesSetToNull = $this->getOpenAPINullablesSetToNull();
            $index = array_search('pricing_enabled', $nullablesSetToNull);
            if ($index !== FALSE) {
                unset($nullablesSetToNull[$index]);
                $this->setOpenAPINullablesSetToNull($nullablesSetToNull);
            }
        }
        $this->container['pricing_enabled'] = $pricing_enabled;

        return $this;
    }

    /**
     * Gets vat_category
     *
     * @return \OpenAPI\Client\Model\VatCategory|null
     */
    public function getVatCategory()
    {
        return $this->container['vat_category'];
    }

    /**
     * Sets vat_category
     *
     * @param \OpenAPI\Client\Model\VatCategory|null $vat_category vat_category
     *
     * @return self
     */
    public function setVatCategory($vat_category)
    {
        if (is_null($vat_category)) {
            throw new \InvalidArgumentException('non-nullable vat_category cannot be null');
        }
        $this->container['vat_category'] = $vat_category;

        return $this;
    }

    /**
     * Gets vat_category_id
     *
     * @return int
     */
    public function getVatCategoryId()
    {
        return $this->container['vat_category_id'];
    }

    /**
     * Sets vat_category_id
     *
     * @param int $vat_category_id vat_category_id
     *
     * @return self
     */
    public function setVatCategoryId($vat_category_id)
    {
        if (is_null($vat_category_id)) {
            array_push($this->openAPINullablesSetToNull, 'vat_category_id');
        } else {
            $nullablesSetToNull = $this->getOpenAPINullablesSetToNull();
            $index = array_search('vat_category_id', $nullablesSetToNull);
            if ($index !== FALSE) {
                unset($nullablesSetToNull[$index]);
                $this->setOpenAPINullablesSetToNull($nullablesSetToNull);
            }
        }
        $this->container['vat_category_id'] = $vat_category_id;

        return $this;
    }

    /**
     * Gets visibility_level
     *
     * @return string|null
     */
    public function getVisibilityLevel()
    {
        return $this->container['visibility_level'];
    }

    /**
     * Sets visibility_level
     *
     * @param string|null $visibility_level visibility_level
     *
     * @return self
     */
    public function setVisibilityLevel($visibility_level)
    {
        if (is_null($visibility_level)) {
            throw new \InvalidArgumentException('non-nullable visibility_level cannot be null');
        }
        $this->container['visibility_level'] = $visibility_level;

        return $this;
    }

    /**
     * Gets waiting_list_enabled
     *
     * @return bool|null
     */
    public function getWaitingListEnabled()
    {
        return $this->container['waiting_list_enabled'];
    }

    /**
     * Sets waiting_list_enabled
     *
     * @param bool|null $waiting_list_enabled waiting_list_enabled
     *
     * @return self
     */
    public function setWaitingListEnabled($waiting_list_enabled)
    {
        if (is_null($waiting_list_enabled)) {
            array_push($this->openAPINullablesSetToNull, 'waiting_list_enabled');
        } else {
            $nullablesSetToNull = $this->getOpenAPINullablesSetToNull();
            $index = array_search('waiting_list_enabled', $nullablesSetToNull);
            if ($index !== FALSE) {
                unset($nullablesSetToNull[$index]);
                $this->setOpenAPINullablesSetToNull($nullablesSetToNull);
            }
        }
        $this->container['waiting_list_enabled'] = $waiting_list_enabled;

        return $this;
    }

    /**
     * Gets participation_certificate_credits
     *
     * @return float|null
     */
    public function getParticipationCertificateCredits()
    {
        return $this->container['participation_certificate_credits'];
    }

    /**
     * Sets participation_certificate_credits
     *
     * @param float|null $participation_certificate_credits Number of credits for the participation certificate. Set to 0 to disable certificate. Set to null to use the default value from the event.
     *
     * @return self
     */
    public function setParticipationCertificateCredits($participation_certificate_credits)
    {
        if (is_null($participation_certificate_credits)) {
            array_push($this->openAPINullablesSetToNull, 'participation_certificate_credits');
        } else {
            $nullablesSetToNull = $this->getOpenAPINullablesSetToNull();
            $index = array_search('participation_certificate_credits', $nullablesSetToNull);
            if ($index !== FALSE) {
                unset($nullablesSetToNull[$index]);
                $this->setOpenAPINullablesSetToNull($nullablesSetToNull);
            }
        }

        if (!is_null($participation_certificate_credits) && ($participation_certificate_credits < 0)) {
            throw new \InvalidArgumentException('invalid value for $participation_certificate_credits when calling EventTicketType., must be bigger than or equal to 0.');
        }

        $this->container['participation_certificate_credits'] = $participation_certificate_credits;

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


