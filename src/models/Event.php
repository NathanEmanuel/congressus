<?php
/**
 * Event
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
 * Event Class Doc Comment
 *
 * @category Class
 * @package  OpenAPI\Client
 * @author   OpenAPI Generator team
 * @link     https://openapi-generator.tech
 * @implements \ArrayAccess<string, mixed>
 */
class Event implements ModelInterface, ArrayAccess, \JsonSerializable
{
    public const DISCRIMINATOR = null;

    /**
      * The original name of the model.
      *
      * @var string
      */
    protected static $openAPIModelName = 'Event';

    /**
      * Array of property to type mappings. Used for (de)serialization
      *
      * @var string[]
      */
    protected static $openAPITypes = [
        'id' => 'int',
        'category_id' => 'int',
        'category' => '\OpenAPI\Client\Model\EventCategoryBase',
        'status' => 'string',
        'slug' => 'string',
        'name' => 'string',
        'description' => 'string',
        'published' => 'bool',
        'visibility' => 'string',
        'authentication_required' => 'bool',
        'start' => '\DateTime',
        'end' => '\DateTime',
        'whole_day' => 'bool',
        'location' => 'string',
        'show_participants' => 'bool',
        'show_waiting_list' => 'bool',
        'show_rented_items' => 'bool',
        'participation_enabled' => 'bool',
        'participation_mode' => 'string',
        'participation_billing_enabled' => 'bool',
        'participation_billing_type' => 'string',
        'participation_payment_ideal' => 'bool',
        'participation_payment_direct_debit' => 'bool',
        'participation_payment_on_invoice' => 'bool',
        'participation_information_collection_type' => 'string',
        'qr_ticketing_enabled' => 'bool',
        'ticket_types' => '\OpenAPI\Client\Model\EventTicketType[]',
        'num_tickets' => 'int',
        'num_tickets_sold' => 'int',
        'num_tickets_max_per_order' => 'int',
        'participant_remarks_enabled' => 'bool',
        'participant_remarks_placeholder' => 'string',
        'rental_enabled' => 'bool',
        'rental_categories' => '\OpenAPI\Client\Model\RentalCategory[]',
        'rental_max_price' => 'float',
        'career_partners' => '\OpenAPI\Client\Model\CareerPartner1[]',
        'website_url' => 'string',
        'website_subscribe_url' => 'string',
        'comments_open' => 'bool',
        'comments' => '\OpenAPI\Client\Model\EventComment[]',
        'media' => '\OpenAPI\Client\Model\StorageObject[]',
        'memo' => 'string'
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
        'category_id' => null,
        'category' => null,
        'status' => null,
        'slug' => null,
        'name' => null,
        'description' => null,
        'published' => null,
        'visibility' => null,
        'authentication_required' => null,
        'start' => 'date-time',
        'end' => 'date-time',
        'whole_day' => null,
        'location' => null,
        'show_participants' => null,
        'show_waiting_list' => null,
        'show_rented_items' => null,
        'participation_enabled' => null,
        'participation_mode' => null,
        'participation_billing_enabled' => null,
        'participation_billing_type' => null,
        'participation_payment_ideal' => null,
        'participation_payment_direct_debit' => null,
        'participation_payment_on_invoice' => null,
        'participation_information_collection_type' => null,
        'qr_ticketing_enabled' => null,
        'ticket_types' => null,
        'num_tickets' => null,
        'num_tickets_sold' => null,
        'num_tickets_max_per_order' => null,
        'participant_remarks_enabled' => null,
        'participant_remarks_placeholder' => null,
        'rental_enabled' => null,
        'rental_categories' => null,
        'rental_max_price' => null,
        'career_partners' => null,
        'website_url' => 'url',
        'website_subscribe_url' => 'url',
        'comments_open' => null,
        'comments' => null,
        'media' => null,
        'memo' => null
    ];

    /**
      * Array of nullable properties. Used for (de)serialization
      *
      * @var boolean[]
      */
    protected static array $openAPINullables = [
        'id' => false,
        'category_id' => false,
        'category' => false,
        'status' => false,
        'slug' => true,
        'name' => false,
        'description' => true,
        'published' => false,
        'visibility' => false,
        'authentication_required' => false,
        'start' => false,
        'end' => false,
        'whole_day' => true,
        'location' => true,
        'show_participants' => true,
        'show_waiting_list' => true,
        'show_rented_items' => true,
        'participation_enabled' => false,
        'participation_mode' => false,
        'participation_billing_enabled' => false,
        'participation_billing_type' => false,
        'participation_payment_ideal' => false,
        'participation_payment_direct_debit' => false,
        'participation_payment_on_invoice' => false,
        'participation_information_collection_type' => false,
        'qr_ticketing_enabled' => false,
        'ticket_types' => false,
        'num_tickets' => true,
        'num_tickets_sold' => true,
        'num_tickets_max_per_order' => false,
        'participant_remarks_enabled' => false,
        'participant_remarks_placeholder' => false,
        'rental_enabled' => false,
        'rental_categories' => false,
        'rental_max_price' => true,
        'career_partners' => true,
        'website_url' => false,
        'website_subscribe_url' => false,
        'comments_open' => true,
        'comments' => true,
        'media' => true,
        'memo' => false
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
        'category_id' => 'category_id',
        'category' => 'category',
        'status' => 'status',
        'slug' => 'slug',
        'name' => 'name',
        'description' => 'description',
        'published' => 'published',
        'visibility' => 'visibility',
        'authentication_required' => 'authentication_required',
        'start' => 'start',
        'end' => 'end',
        'whole_day' => 'whole_day',
        'location' => 'location',
        'show_participants' => 'show_participants',
        'show_waiting_list' => 'show_waiting_list',
        'show_rented_items' => 'show_rented_items',
        'participation_enabled' => 'participation_enabled',
        'participation_mode' => 'participation_mode',
        'participation_billing_enabled' => 'participation_billing_enabled',
        'participation_billing_type' => 'participation_billing_type',
        'participation_payment_ideal' => 'participation_payment_ideal',
        'participation_payment_direct_debit' => 'participation_payment_direct_debit',
        'participation_payment_on_invoice' => 'participation_payment_on_invoice',
        'participation_information_collection_type' => 'participation_information_collection_type',
        'qr_ticketing_enabled' => 'qr_ticketing_enabled',
        'ticket_types' => 'ticket_types',
        'num_tickets' => 'num_tickets',
        'num_tickets_sold' => 'num_tickets_sold',
        'num_tickets_max_per_order' => 'num_tickets_max_per_order',
        'participant_remarks_enabled' => 'participant_remarks_enabled',
        'participant_remarks_placeholder' => 'participant_remarks_placeholder',
        'rental_enabled' => 'rental_enabled',
        'rental_categories' => 'rental_categories',
        'rental_max_price' => 'rental_max_price',
        'career_partners' => 'career_partners',
        'website_url' => 'website_url',
        'website_subscribe_url' => 'website_subscribe_url',
        'comments_open' => 'comments_open',
        'comments' => 'comments',
        'media' => 'media',
        'memo' => 'memo'
    ];

    /**
     * Array of attributes to setter functions (for deserialization of responses)
     *
     * @var string[]
     */
    protected static $setters = [
        'id' => 'setId',
        'category_id' => 'setCategoryId',
        'category' => 'setCategory',
        'status' => 'setStatus',
        'slug' => 'setSlug',
        'name' => 'setName',
        'description' => 'setDescription',
        'published' => 'setPublished',
        'visibility' => 'setVisibility',
        'authentication_required' => 'setAuthenticationRequired',
        'start' => 'setStart',
        'end' => 'setEnd',
        'whole_day' => 'setWholeDay',
        'location' => 'setLocation',
        'show_participants' => 'setShowParticipants',
        'show_waiting_list' => 'setShowWaitingList',
        'show_rented_items' => 'setShowRentedItems',
        'participation_enabled' => 'setParticipationEnabled',
        'participation_mode' => 'setParticipationMode',
        'participation_billing_enabled' => 'setParticipationBillingEnabled',
        'participation_billing_type' => 'setParticipationBillingType',
        'participation_payment_ideal' => 'setParticipationPaymentIdeal',
        'participation_payment_direct_debit' => 'setParticipationPaymentDirectDebit',
        'participation_payment_on_invoice' => 'setParticipationPaymentOnInvoice',
        'participation_information_collection_type' => 'setParticipationInformationCollectionType',
        'qr_ticketing_enabled' => 'setQrTicketingEnabled',
        'ticket_types' => 'setTicketTypes',
        'num_tickets' => 'setNumTickets',
        'num_tickets_sold' => 'setNumTicketsSold',
        'num_tickets_max_per_order' => 'setNumTicketsMaxPerOrder',
        'participant_remarks_enabled' => 'setParticipantRemarksEnabled',
        'participant_remarks_placeholder' => 'setParticipantRemarksPlaceholder',
        'rental_enabled' => 'setRentalEnabled',
        'rental_categories' => 'setRentalCategories',
        'rental_max_price' => 'setRentalMaxPrice',
        'career_partners' => 'setCareerPartners',
        'website_url' => 'setWebsiteUrl',
        'website_subscribe_url' => 'setWebsiteSubscribeUrl',
        'comments_open' => 'setCommentsOpen',
        'comments' => 'setComments',
        'media' => 'setMedia',
        'memo' => 'setMemo'
    ];

    /**
     * Array of attributes to getter functions (for serialization of requests)
     *
     * @var string[]
     */
    protected static $getters = [
        'id' => 'getId',
        'category_id' => 'getCategoryId',
        'category' => 'getCategory',
        'status' => 'getStatus',
        'slug' => 'getSlug',
        'name' => 'getName',
        'description' => 'getDescription',
        'published' => 'getPublished',
        'visibility' => 'getVisibility',
        'authentication_required' => 'getAuthenticationRequired',
        'start' => 'getStart',
        'end' => 'getEnd',
        'whole_day' => 'getWholeDay',
        'location' => 'getLocation',
        'show_participants' => 'getShowParticipants',
        'show_waiting_list' => 'getShowWaitingList',
        'show_rented_items' => 'getShowRentedItems',
        'participation_enabled' => 'getParticipationEnabled',
        'participation_mode' => 'getParticipationMode',
        'participation_billing_enabled' => 'getParticipationBillingEnabled',
        'participation_billing_type' => 'getParticipationBillingType',
        'participation_payment_ideal' => 'getParticipationPaymentIdeal',
        'participation_payment_direct_debit' => 'getParticipationPaymentDirectDebit',
        'participation_payment_on_invoice' => 'getParticipationPaymentOnInvoice',
        'participation_information_collection_type' => 'getParticipationInformationCollectionType',
        'qr_ticketing_enabled' => 'getQrTicketingEnabled',
        'ticket_types' => 'getTicketTypes',
        'num_tickets' => 'getNumTickets',
        'num_tickets_sold' => 'getNumTicketsSold',
        'num_tickets_max_per_order' => 'getNumTicketsMaxPerOrder',
        'participant_remarks_enabled' => 'getParticipantRemarksEnabled',
        'participant_remarks_placeholder' => 'getParticipantRemarksPlaceholder',
        'rental_enabled' => 'getRentalEnabled',
        'rental_categories' => 'getRentalCategories',
        'rental_max_price' => 'getRentalMaxPrice',
        'career_partners' => 'getCareerPartners',
        'website_url' => 'getWebsiteUrl',
        'website_subscribe_url' => 'getWebsiteSubscribeUrl',
        'comments_open' => 'getCommentsOpen',
        'comments' => 'getComments',
        'media' => 'getMedia',
        'memo' => 'getMemo'
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

    public const STATUS_ON_SALE = 'on sale';
    public const STATUS_WAITING_LIST = 'waiting list';
    public const STATUS_SOLD_OUT = 'sold out';
    public const STATUS_NOT_ON_SALE = 'not on sale';
    public const STATUS_NO_PARTICIPATION = 'no participation';
    public const VISIBILITY__PUBLIC = 'public';
    public const VISIBILITY__PROTECTED = 'protected';
    public const VISIBILITY__PRIVATE = 'private';
    public const PARTICIPATION_MODE_NONE = 'none';
    public const PARTICIPATION_MODE_SINGLE = 'single';
    public const PARTICIPATION_MODE_TICKETING = 'ticketing';
    public const PARTICIPATION_BILLING_TYPE_DIRECT = 'direct';
    public const PARTICIPATION_BILLING_TYPE_LATER = 'later';
    public const PARTICIPATION_INFORMATION_COLLECTION_TYPE_ORDER = 'order';
    public const PARTICIPATION_INFORMATION_COLLECTION_TYPE_TICKET = 'ticket';

    /**
     * Gets allowable values of the enum
     *
     * @return string[]
     */
    public function getStatusAllowableValues()
    {
        return [
            self::STATUS_ON_SALE,
            self::STATUS_WAITING_LIST,
            self::STATUS_SOLD_OUT,
            self::STATUS_NOT_ON_SALE,
            self::STATUS_NO_PARTICIPATION,
        ];
    }

    /**
     * Gets allowable values of the enum
     *
     * @return string[]
     */
    public function getVisibilityAllowableValues()
    {
        return [
            self::VISIBILITY__PUBLIC,
            self::VISIBILITY__PROTECTED,
            self::VISIBILITY__PRIVATE,
        ];
    }

    /**
     * Gets allowable values of the enum
     *
     * @return string[]
     */
    public function getParticipationModeAllowableValues()
    {
        return [
            self::PARTICIPATION_MODE_NONE,
            self::PARTICIPATION_MODE_SINGLE,
            self::PARTICIPATION_MODE_TICKETING,
        ];
    }

    /**
     * Gets allowable values of the enum
     *
     * @return string[]
     */
    public function getParticipationBillingTypeAllowableValues()
    {
        return [
            self::PARTICIPATION_BILLING_TYPE_DIRECT,
            self::PARTICIPATION_BILLING_TYPE_LATER,
        ];
    }

    /**
     * Gets allowable values of the enum
     *
     * @return string[]
     */
    public function getParticipationInformationCollectionTypeAllowableValues()
    {
        return [
            self::PARTICIPATION_INFORMATION_COLLECTION_TYPE_ORDER,
            self::PARTICIPATION_INFORMATION_COLLECTION_TYPE_TICKET,
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
        $this->setIfExists('category_id', $data ?? [], null);
        $this->setIfExists('category', $data ?? [], null);
        $this->setIfExists('status', $data ?? [], null);
        $this->setIfExists('slug', $data ?? [], null);
        $this->setIfExists('name', $data ?? [], null);
        $this->setIfExists('description', $data ?? [], null);
        $this->setIfExists('published', $data ?? [], null);
        $this->setIfExists('visibility', $data ?? [], null);
        $this->setIfExists('authentication_required', $data ?? [], null);
        $this->setIfExists('start', $data ?? [], null);
        $this->setIfExists('end', $data ?? [], null);
        $this->setIfExists('whole_day', $data ?? [], null);
        $this->setIfExists('location', $data ?? [], null);
        $this->setIfExists('show_participants', $data ?? [], null);
        $this->setIfExists('show_waiting_list', $data ?? [], null);
        $this->setIfExists('show_rented_items', $data ?? [], null);
        $this->setIfExists('participation_enabled', $data ?? [], null);
        $this->setIfExists('participation_mode', $data ?? [], null);
        $this->setIfExists('participation_billing_enabled', $data ?? [], null);
        $this->setIfExists('participation_billing_type', $data ?? [], null);
        $this->setIfExists('participation_payment_ideal', $data ?? [], null);
        $this->setIfExists('participation_payment_direct_debit', $data ?? [], null);
        $this->setIfExists('participation_payment_on_invoice', $data ?? [], null);
        $this->setIfExists('participation_information_collection_type', $data ?? [], null);
        $this->setIfExists('qr_ticketing_enabled', $data ?? [], null);
        $this->setIfExists('ticket_types', $data ?? [], null);
        $this->setIfExists('num_tickets', $data ?? [], null);
        $this->setIfExists('num_tickets_sold', $data ?? [], null);
        $this->setIfExists('num_tickets_max_per_order', $data ?? [], null);
        $this->setIfExists('participant_remarks_enabled', $data ?? [], null);
        $this->setIfExists('participant_remarks_placeholder', $data ?? [], null);
        $this->setIfExists('rental_enabled', $data ?? [], null);
        $this->setIfExists('rental_categories', $data ?? [], null);
        $this->setIfExists('rental_max_price', $data ?? [], null);
        $this->setIfExists('career_partners', $data ?? [], null);
        $this->setIfExists('website_url', $data ?? [], null);
        $this->setIfExists('website_subscribe_url', $data ?? [], null);
        $this->setIfExists('comments_open', $data ?? [], null);
        $this->setIfExists('comments', $data ?? [], null);
        $this->setIfExists('media', $data ?? [], null);
        $this->setIfExists('memo', $data ?? [], null);
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

        if ($this->container['category_id'] === null) {
            $invalidProperties[] = "'category_id' can't be null";
        }
        $allowedValues = $this->getStatusAllowableValues();
        if (!is_null($this->container['status']) && !in_array($this->container['status'], $allowedValues, true)) {
            $invalidProperties[] = sprintf(
                "invalid value '%s' for 'status', must be one of '%s'",
                $this->container['status'],
                implode("', '", $allowedValues)
            );
        }

        if (!is_null($this->container['slug']) && (mb_strlen($this->container['slug']) > 255)) {
            $invalidProperties[] = "invalid value for 'slug', the character length must be smaller than or equal to 255.";
        }

        if ($this->container['name'] === null) {
            $invalidProperties[] = "'name' can't be null";
        }
        if ((mb_strlen($this->container['name']) > 255)) {
            $invalidProperties[] = "invalid value for 'name', the character length must be smaller than or equal to 255.";
        }

        $allowedValues = $this->getVisibilityAllowableValues();
        if (!is_null($this->container['visibility']) && !in_array($this->container['visibility'], $allowedValues, true)) {
            $invalidProperties[] = sprintf(
                "invalid value '%s' for 'visibility', must be one of '%s'",
                $this->container['visibility'],
                implode("', '", $allowedValues)
            );
        }

        if (!is_null($this->container['location']) && (mb_strlen($this->container['location']) > 255)) {
            $invalidProperties[] = "invalid value for 'location', the character length must be smaller than or equal to 255.";
        }

        $allowedValues = $this->getParticipationModeAllowableValues();
        if (!is_null($this->container['participation_mode']) && !in_array($this->container['participation_mode'], $allowedValues, true)) {
            $invalidProperties[] = sprintf(
                "invalid value '%s' for 'participation_mode', must be one of '%s'",
                $this->container['participation_mode'],
                implode("', '", $allowedValues)
            );
        }

        $allowedValues = $this->getParticipationBillingTypeAllowableValues();
        if (!is_null($this->container['participation_billing_type']) && !in_array($this->container['participation_billing_type'], $allowedValues, true)) {
            $invalidProperties[] = sprintf(
                "invalid value '%s' for 'participation_billing_type', must be one of '%s'",
                $this->container['participation_billing_type'],
                implode("', '", $allowedValues)
            );
        }

        $allowedValues = $this->getParticipationInformationCollectionTypeAllowableValues();
        if (!is_null($this->container['participation_information_collection_type']) && !in_array($this->container['participation_information_collection_type'], $allowedValues, true)) {
            $invalidProperties[] = sprintf(
                "invalid value '%s' for 'participation_information_collection_type', must be one of '%s'",
                $this->container['participation_information_collection_type'],
                implode("', '", $allowedValues)
            );
        }

        if (!is_null($this->container['num_tickets_max_per_order']) && ($this->container['num_tickets_max_per_order'] > 20)) {
            $invalidProperties[] = "invalid value for 'num_tickets_max_per_order', must be smaller than or equal to 20.";
        }

        if (!is_null($this->container['num_tickets_max_per_order']) && ($this->container['num_tickets_max_per_order'] < 0)) {
            $invalidProperties[] = "invalid value for 'num_tickets_max_per_order', must be bigger than or equal to 0.";
        }

        if (!is_null($this->container['participant_remarks_placeholder']) && (mb_strlen($this->container['participant_remarks_placeholder']) > 255)) {
            $invalidProperties[] = "invalid value for 'participant_remarks_placeholder', the character length must be smaller than or equal to 255.";
        }

        if (!is_null($this->container['participant_remarks_placeholder']) && (mb_strlen($this->container['participant_remarks_placeholder']) < 0)) {
            $invalidProperties[] = "invalid value for 'participant_remarks_placeholder', the character length must be bigger than or equal to 0.";
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
     * Gets category_id
     *
     * @return int
     */
    public function getCategoryId()
    {
        return $this->container['category_id'];
    }

    /**
     * Sets category_id
     *
     * @param int $category_id category_id
     *
     * @return self
     */
    public function setCategoryId($category_id)
    {
        if (is_null($category_id)) {
            throw new \InvalidArgumentException('non-nullable category_id cannot be null');
        }
        $this->container['category_id'] = $category_id;

        return $this;
    }

    /**
     * Gets category
     *
     * @return \OpenAPI\Client\Model\EventCategoryBase|null
     */
    public function getCategory()
    {
        return $this->container['category'];
    }

    /**
     * Sets category
     *
     * @param \OpenAPI\Client\Model\EventCategoryBase|null $category category
     *
     * @return self
     */
    public function setCategory($category)
    {
        if (is_null($category)) {
            throw new \InvalidArgumentException('non-nullable category cannot be null');
        }
        $this->container['category'] = $category;

        return $this;
    }

    /**
     * Gets status
     *
     * @return string|null
     */
    public function getStatus()
    {
        return $this->container['status'];
    }

    /**
     * Sets status
     *
     * @param string|null $status Status for participating at this event
     *
     * @return self
     */
    public function setStatus($status)
    {
        if (is_null($status)) {
            throw new \InvalidArgumentException('non-nullable status cannot be null');
        }
        $allowedValues = $this->getStatusAllowableValues();
        if (!in_array($status, $allowedValues, true)) {
            throw new \InvalidArgumentException(
                sprintf(
                    "Invalid value '%s' for 'status', must be one of '%s'",
                    $status,
                    implode("', '", $allowedValues)
                )
            );
        }
        $this->container['status'] = $status;

        return $this;
    }

    /**
     * Gets slug
     *
     * @return string|null
     */
    public function getSlug()
    {
        return $this->container['slug'];
    }

    /**
     * Sets slug
     *
     * @param string|null $slug slug
     *
     * @return self
     */
    public function setSlug($slug)
    {
        if (is_null($slug)) {
            array_push($this->openAPINullablesSetToNull, 'slug');
        } else {
            $nullablesSetToNull = $this->getOpenAPINullablesSetToNull();
            $index = array_search('slug', $nullablesSetToNull);
            if ($index !== FALSE) {
                unset($nullablesSetToNull[$index]);
                $this->setOpenAPINullablesSetToNull($nullablesSetToNull);
            }
        }
        if (!is_null($slug) && (mb_strlen($slug) > 255)) {
            throw new \InvalidArgumentException('invalid length for $slug when calling Event., must be smaller than or equal to 255.');
        }

        $this->container['slug'] = $slug;

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
     * @param string $name name
     *
     * @return self
     */
    public function setName($name)
    {
        if (is_null($name)) {
            throw new \InvalidArgumentException('non-nullable name cannot be null');
        }
        if ((mb_strlen($name) > 255)) {
            throw new \InvalidArgumentException('invalid length for $name when calling Event., must be smaller than or equal to 255.');
        }

        $this->container['name'] = $name;

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
     * @param string|null $description description
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
     * Gets published
     *
     * @return bool|null
     */
    public function getPublished()
    {
        return $this->container['published'];
    }

    /**
     * Sets published
     *
     * @param bool|null $published True when this event is published on the website
     *
     * @return self
     */
    public function setPublished($published)
    {
        if (is_null($published)) {
            throw new \InvalidArgumentException('non-nullable published cannot be null');
        }
        $this->container['published'] = $published;

        return $this;
    }

    /**
     * Gets visibility
     *
     * @return string|null
     */
    public function getVisibility()
    {
        return $this->container['visibility'];
    }

    /**
     * Sets visibility
     *
     * @param string|null $visibility Visibility level set for this event
     *
     * @return self
     */
    public function setVisibility($visibility)
    {
        if (is_null($visibility)) {
            throw new \InvalidArgumentException('non-nullable visibility cannot be null');
        }
        $allowedValues = $this->getVisibilityAllowableValues();
        if (!in_array($visibility, $allowedValues, true)) {
            throw new \InvalidArgumentException(
                sprintf(
                    "Invalid value '%s' for 'visibility', must be one of '%s'",
                    $visibility,
                    implode("', '", $allowedValues)
                )
            );
        }
        $this->container['visibility'] = $visibility;

        return $this;
    }

    /**
     * Gets authentication_required
     *
     * @return bool|null
     */
    public function getAuthenticationRequired()
    {
        return $this->container['authentication_required'];
    }

    /**
     * Sets authentication_required
     *
     * @param bool|null $authentication_required True when only authenticated users are allowed to view this event
     *
     * @return self
     */
    public function setAuthenticationRequired($authentication_required)
    {
        if (is_null($authentication_required)) {
            throw new \InvalidArgumentException('non-nullable authentication_required cannot be null');
        }
        $this->container['authentication_required'] = $authentication_required;

        return $this;
    }

    /**
     * Gets start
     *
     * @return \DateTime|null
     */
    public function getStart()
    {
        return $this->container['start'];
    }

    /**
     * Sets start
     *
     * @param \DateTime|null $start start
     *
     * @return self
     */
    public function setStart($start)
    {
        if (is_null($start)) {
            throw new \InvalidArgumentException('non-nullable start cannot be null');
        }
        $this->container['start'] = $start;

        return $this;
    }

    /**
     * Gets end
     *
     * @return \DateTime|null
     */
    public function getEnd()
    {
        return $this->container['end'];
    }

    /**
     * Sets end
     *
     * @param \DateTime|null $end end
     *
     * @return self
     */
    public function setEnd($end)
    {
        if (is_null($end)) {
            throw new \InvalidArgumentException('non-nullable end cannot be null');
        }
        $this->container['end'] = $end;

        return $this;
    }

    /**
     * Gets whole_day
     *
     * @return bool|null
     */
    public function getWholeDay()
    {
        return $this->container['whole_day'];
    }

    /**
     * Sets whole_day
     *
     * @param bool|null $whole_day whole_day
     *
     * @return self
     */
    public function setWholeDay($whole_day)
    {
        if (is_null($whole_day)) {
            array_push($this->openAPINullablesSetToNull, 'whole_day');
        } else {
            $nullablesSetToNull = $this->getOpenAPINullablesSetToNull();
            $index = array_search('whole_day', $nullablesSetToNull);
            if ($index !== FALSE) {
                unset($nullablesSetToNull[$index]);
                $this->setOpenAPINullablesSetToNull($nullablesSetToNull);
            }
        }
        $this->container['whole_day'] = $whole_day;

        return $this;
    }

    /**
     * Gets location
     *
     * @return string|null
     */
    public function getLocation()
    {
        return $this->container['location'];
    }

    /**
     * Sets location
     *
     * @param string|null $location location
     *
     * @return self
     */
    public function setLocation($location)
    {
        if (is_null($location)) {
            array_push($this->openAPINullablesSetToNull, 'location');
        } else {
            $nullablesSetToNull = $this->getOpenAPINullablesSetToNull();
            $index = array_search('location', $nullablesSetToNull);
            if ($index !== FALSE) {
                unset($nullablesSetToNull[$index]);
                $this->setOpenAPINullablesSetToNull($nullablesSetToNull);
            }
        }
        if (!is_null($location) && (mb_strlen($location) > 255)) {
            throw new \InvalidArgumentException('invalid length for $location when calling Event., must be smaller than or equal to 255.');
        }

        $this->container['location'] = $location;

        return $this;
    }

    /**
     * Gets show_participants
     *
     * @return bool|null
     */
    public function getShowParticipants()
    {
        return $this->container['show_participants'];
    }

    /**
     * Sets show_participants
     *
     * @param bool|null $show_participants show_participants
     *
     * @return self
     */
    public function setShowParticipants($show_participants)
    {
        if (is_null($show_participants)) {
            array_push($this->openAPINullablesSetToNull, 'show_participants');
        } else {
            $nullablesSetToNull = $this->getOpenAPINullablesSetToNull();
            $index = array_search('show_participants', $nullablesSetToNull);
            if ($index !== FALSE) {
                unset($nullablesSetToNull[$index]);
                $this->setOpenAPINullablesSetToNull($nullablesSetToNull);
            }
        }
        $this->container['show_participants'] = $show_participants;

        return $this;
    }

    /**
     * Gets show_waiting_list
     *
     * @return bool|null
     */
    public function getShowWaitingList()
    {
        return $this->container['show_waiting_list'];
    }

    /**
     * Sets show_waiting_list
     *
     * @param bool|null $show_waiting_list show_waiting_list
     *
     * @return self
     */
    public function setShowWaitingList($show_waiting_list)
    {
        if (is_null($show_waiting_list)) {
            array_push($this->openAPINullablesSetToNull, 'show_waiting_list');
        } else {
            $nullablesSetToNull = $this->getOpenAPINullablesSetToNull();
            $index = array_search('show_waiting_list', $nullablesSetToNull);
            if ($index !== FALSE) {
                unset($nullablesSetToNull[$index]);
                $this->setOpenAPINullablesSetToNull($nullablesSetToNull);
            }
        }
        $this->container['show_waiting_list'] = $show_waiting_list;

        return $this;
    }

    /**
     * Gets show_rented_items
     *
     * @return bool|null
     */
    public function getShowRentedItems()
    {
        return $this->container['show_rented_items'];
    }

    /**
     * Sets show_rented_items
     *
     * @param bool|null $show_rented_items show_rented_items
     *
     * @return self
     */
    public function setShowRentedItems($show_rented_items)
    {
        if (is_null($show_rented_items)) {
            array_push($this->openAPINullablesSetToNull, 'show_rented_items');
        } else {
            $nullablesSetToNull = $this->getOpenAPINullablesSetToNull();
            $index = array_search('show_rented_items', $nullablesSetToNull);
            if ($index !== FALSE) {
                unset($nullablesSetToNull[$index]);
                $this->setOpenAPINullablesSetToNull($nullablesSetToNull);
            }
        }
        $this->container['show_rented_items'] = $show_rented_items;

        return $this;
    }

    /**
     * Gets participation_enabled
     *
     * @return bool|null
     */
    public function getParticipationEnabled()
    {
        return $this->container['participation_enabled'];
    }

    /**
     * Sets participation_enabled
     *
     * @param bool|null $participation_enabled Enable sign up for this event
     *
     * @return self
     */
    public function setParticipationEnabled($participation_enabled)
    {
        if (is_null($participation_enabled)) {
            throw new \InvalidArgumentException('non-nullable participation_enabled cannot be null');
        }
        $this->container['participation_enabled'] = $participation_enabled;

        return $this;
    }

    /**
     * Gets participation_mode
     *
     * @return string|null
     */
    public function getParticipationMode()
    {
        return $this->container['participation_mode'];
    }

    /**
     * Sets participation_mode
     *
     * @param string|null $participation_mode Participation mode for this event. Use `\"single\"` for registration (one ticket) or `\"ticketing\"` for multiple tickets per participation.
     *
     * @return self
     */
    public function setParticipationMode($participation_mode)
    {
        if (is_null($participation_mode)) {
            throw new \InvalidArgumentException('non-nullable participation_mode cannot be null');
        }
        $allowedValues = $this->getParticipationModeAllowableValues();
        if (!in_array($participation_mode, $allowedValues, true)) {
            throw new \InvalidArgumentException(
                sprintf(
                    "Invalid value '%s' for 'participation_mode', must be one of '%s'",
                    $participation_mode,
                    implode("', '", $allowedValues)
                )
            );
        }
        $this->container['participation_mode'] = $participation_mode;

        return $this;
    }

    /**
     * Gets participation_billing_enabled
     *
     * @return bool|null
     */
    public function getParticipationBillingEnabled()
    {
        return $this->container['participation_billing_enabled'];
    }

    /**
     * Sets participation_billing_enabled
     *
     * @param bool|null $participation_billing_enabled Enable billing for this event. When enabled, Congressus will handle invoicing and payments.
     *
     * @return self
     */
    public function setParticipationBillingEnabled($participation_billing_enabled)
    {
        if (is_null($participation_billing_enabled)) {
            throw new \InvalidArgumentException('non-nullable participation_billing_enabled cannot be null');
        }
        $this->container['participation_billing_enabled'] = $participation_billing_enabled;

        return $this;
    }

    /**
     * Gets participation_billing_type
     *
     * @return string|null
     */
    public function getParticipationBillingType()
    {
        return $this->container['participation_billing_type'];
    }

    /**
     * Sets participation_billing_type
     *
     * @param string|null $participation_billing_type Define if the participant is billed direct or later. When set to `\"later\"`, it is possible to update prices after the event, before invoices are sent.
     *
     * @return self
     */
    public function setParticipationBillingType($participation_billing_type)
    {
        if (is_null($participation_billing_type)) {
            throw new \InvalidArgumentException('non-nullable participation_billing_type cannot be null');
        }
        $allowedValues = $this->getParticipationBillingTypeAllowableValues();
        if (!in_array($participation_billing_type, $allowedValues, true)) {
            throw new \InvalidArgumentException(
                sprintf(
                    "Invalid value '%s' for 'participation_billing_type', must be one of '%s'",
                    $participation_billing_type,
                    implode("', '", $allowedValues)
                )
            );
        }
        $this->container['participation_billing_type'] = $participation_billing_type;

        return $this;
    }

    /**
     * Gets participation_payment_ideal
     *
     * @return bool|null
     */
    public function getParticipationPaymentIdeal()
    {
        return $this->container['participation_payment_ideal'];
    }

    /**
     * Sets participation_payment_ideal
     *
     * @param bool|null $participation_payment_ideal Enable payment method `iDeal`
     *
     * @return self
     */
    public function setParticipationPaymentIdeal($participation_payment_ideal)
    {
        if (is_null($participation_payment_ideal)) {
            throw new \InvalidArgumentException('non-nullable participation_payment_ideal cannot be null');
        }
        $this->container['participation_payment_ideal'] = $participation_payment_ideal;

        return $this;
    }

    /**
     * Gets participation_payment_direct_debit
     *
     * @return bool|null
     */
    public function getParticipationPaymentDirectDebit()
    {
        return $this->container['participation_payment_direct_debit'];
    }

    /**
     * Sets participation_payment_direct_debit
     *
     * @param bool|null $participation_payment_direct_debit Enable payment method `direct debit`
     *
     * @return self
     */
    public function setParticipationPaymentDirectDebit($participation_payment_direct_debit)
    {
        if (is_null($participation_payment_direct_debit)) {
            throw new \InvalidArgumentException('non-nullable participation_payment_direct_debit cannot be null');
        }
        $this->container['participation_payment_direct_debit'] = $participation_payment_direct_debit;

        return $this;
    }

    /**
     * Gets participation_payment_on_invoice
     *
     * @return bool|null
     */
    public function getParticipationPaymentOnInvoice()
    {
        return $this->container['participation_payment_on_invoice'];
    }

    /**
     * Sets participation_payment_on_invoice
     *
     * @param bool|null $participation_payment_on_invoice Enable payment method `on invoice`
     *
     * @return self
     */
    public function setParticipationPaymentOnInvoice($participation_payment_on_invoice)
    {
        if (is_null($participation_payment_on_invoice)) {
            throw new \InvalidArgumentException('non-nullable participation_payment_on_invoice cannot be null');
        }
        $this->container['participation_payment_on_invoice'] = $participation_payment_on_invoice;

        return $this;
    }

    /**
     * Gets participation_information_collection_type
     *
     * @return string|null
     */
    public function getParticipationInformationCollectionType()
    {
        return $this->container['participation_information_collection_type'];
    }

    /**
     * Sets participation_information_collection_type
     *
     * @param string|null $participation_information_collection_type Define if name and email is required per participation or per ticket.
     *
     * @return self
     */
    public function setParticipationInformationCollectionType($participation_information_collection_type)
    {
        if (is_null($participation_information_collection_type)) {
            throw new \InvalidArgumentException('non-nullable participation_information_collection_type cannot be null');
        }
        $allowedValues = $this->getParticipationInformationCollectionTypeAllowableValues();
        if (!in_array($participation_information_collection_type, $allowedValues, true)) {
            throw new \InvalidArgumentException(
                sprintf(
                    "Invalid value '%s' for 'participation_information_collection_type', must be one of '%s'",
                    $participation_information_collection_type,
                    implode("', '", $allowedValues)
                )
            );
        }
        $this->container['participation_information_collection_type'] = $participation_information_collection_type;

        return $this;
    }

    /**
     * Gets qr_ticketing_enabled
     *
     * @return bool|null
     */
    public function getQrTicketingEnabled()
    {
        return $this->container['qr_ticketing_enabled'];
    }

    /**
     * Sets qr_ticketing_enabled
     *
     * @param bool|null $qr_ticketing_enabled When enabled, Congressus generates tickets with a QR code which could be used to scan tickets at the door of the event. _Please note: additional charges apply for QR tickets_
     *
     * @return self
     */
    public function setQrTicketingEnabled($qr_ticketing_enabled)
    {
        if (is_null($qr_ticketing_enabled)) {
            throw new \InvalidArgumentException('non-nullable qr_ticketing_enabled cannot be null');
        }
        $this->container['qr_ticketing_enabled'] = $qr_ticketing_enabled;

        return $this;
    }

    /**
     * Gets ticket_types
     *
     * @return \OpenAPI\Client\Model\EventTicketType[]|null
     */
    public function getTicketTypes()
    {
        return $this->container['ticket_types'];
    }

    /**
     * Sets ticket_types
     *
     * @param \OpenAPI\Client\Model\EventTicketType[]|null $ticket_types ticket_types
     *
     * @return self
     */
    public function setTicketTypes($ticket_types)
    {
        if (is_null($ticket_types)) {
            throw new \InvalidArgumentException('non-nullable ticket_types cannot be null');
        }
        $this->container['ticket_types'] = $ticket_types;

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
     * @param int|null $num_tickets Capacity for this event. Null means no capacity limit.
     *
     * @return self
     */
    public function setNumTickets($num_tickets)
    {
        if (is_null($num_tickets)) {
            array_push($this->openAPINullablesSetToNull, 'num_tickets');
        } else {
            $nullablesSetToNull = $this->getOpenAPINullablesSetToNull();
            $index = array_search('num_tickets', $nullablesSetToNull);
            if ($index !== FALSE) {
                unset($nullablesSetToNull[$index]);
                $this->setOpenAPINullablesSetToNull($nullablesSetToNull);
            }
        }
        $this->container['num_tickets'] = $num_tickets;

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
     * @param int|null $num_tickets_sold Number of tickets that are sold for this event
     *
     * @return self
     */
    public function setNumTicketsSold($num_tickets_sold)
    {
        if (is_null($num_tickets_sold)) {
            array_push($this->openAPINullablesSetToNull, 'num_tickets_sold');
        } else {
            $nullablesSetToNull = $this->getOpenAPINullablesSetToNull();
            $index = array_search('num_tickets_sold', $nullablesSetToNull);
            if ($index !== FALSE) {
                unset($nullablesSetToNull[$index]);
                $this->setOpenAPINullablesSetToNull($nullablesSetToNull);
            }
        }
        $this->container['num_tickets_sold'] = $num_tickets_sold;

        return $this;
    }

    /**
     * Gets num_tickets_max_per_order
     *
     * @return int|null
     */
    public function getNumTicketsMaxPerOrder()
    {
        return $this->container['num_tickets_max_per_order'];
    }

    /**
     * Sets num_tickets_max_per_order
     *
     * @param int|null $num_tickets_max_per_order Max. number of tickets that can be ordered at once. Only relevant for participation_mode=`\"ticketing\"`.
     *
     * @return self
     */
    public function setNumTicketsMaxPerOrder($num_tickets_max_per_order)
    {
        if (is_null($num_tickets_max_per_order)) {
            throw new \InvalidArgumentException('non-nullable num_tickets_max_per_order cannot be null');
        }

        if (($num_tickets_max_per_order > 20)) {
            throw new \InvalidArgumentException('invalid value for $num_tickets_max_per_order when calling Event., must be smaller than or equal to 20.');
        }
        if (($num_tickets_max_per_order < 0)) {
            throw new \InvalidArgumentException('invalid value for $num_tickets_max_per_order when calling Event., must be bigger than or equal to 0.');
        }

        $this->container['num_tickets_max_per_order'] = $num_tickets_max_per_order;

        return $this;
    }

    /**
     * Gets participant_remarks_enabled
     *
     * @return bool|null
     */
    public function getParticipantRemarksEnabled()
    {
        return $this->container['participant_remarks_enabled'];
    }

    /**
     * Sets participant_remarks_enabled
     *
     * @param bool|null $participant_remarks_enabled Enables participants to add remarks to their order
     *
     * @return self
     */
    public function setParticipantRemarksEnabled($participant_remarks_enabled)
    {
        if (is_null($participant_remarks_enabled)) {
            throw new \InvalidArgumentException('non-nullable participant_remarks_enabled cannot be null');
        }
        $this->container['participant_remarks_enabled'] = $participant_remarks_enabled;

        return $this;
    }

    /**
     * Gets participant_remarks_placeholder
     *
     * @return string|null
     */
    public function getParticipantRemarksPlaceholder()
    {
        return $this->container['participant_remarks_placeholder'];
    }

    /**
     * Sets participant_remarks_placeholder
     *
     * @param string|null $participant_remarks_placeholder Placeholder text for the participant remarks. Could be used for questions etc.
     *
     * @return self
     */
    public function setParticipantRemarksPlaceholder($participant_remarks_placeholder)
    {
        if (is_null($participant_remarks_placeholder)) {
            throw new \InvalidArgumentException('non-nullable participant_remarks_placeholder cannot be null');
        }
        if ((mb_strlen($participant_remarks_placeholder) > 255)) {
            throw new \InvalidArgumentException('invalid length for $participant_remarks_placeholder when calling Event., must be smaller than or equal to 255.');
        }
        if ((mb_strlen($participant_remarks_placeholder) < 0)) {
            throw new \InvalidArgumentException('invalid length for $participant_remarks_placeholder when calling Event., must be bigger than or equal to 0.');
        }

        $this->container['participant_remarks_placeholder'] = $participant_remarks_placeholder;

        return $this;
    }

    /**
     * Gets rental_enabled
     *
     * @return bool|null
     */
    public function getRentalEnabled()
    {
        return $this->container['rental_enabled'];
    }

    /**
     * Sets rental_enabled
     *
     * @param bool|null $rental_enabled Enables rental for participants. Only available when module rental is enabled.
     *
     * @return self
     */
    public function setRentalEnabled($rental_enabled)
    {
        if (is_null($rental_enabled)) {
            throw new \InvalidArgumentException('non-nullable rental_enabled cannot be null');
        }
        $this->container['rental_enabled'] = $rental_enabled;

        return $this;
    }

    /**
     * Gets rental_categories
     *
     * @return \OpenAPI\Client\Model\RentalCategory[]|null
     */
    public function getRentalCategories()
    {
        return $this->container['rental_categories'];
    }

    /**
     * Sets rental_categories
     *
     * @param \OpenAPI\Client\Model\RentalCategory[]|null $rental_categories Rental categories from which participants can rent items
     *
     * @return self
     */
    public function setRentalCategories($rental_categories)
    {
        if (is_null($rental_categories)) {
            throw new \InvalidArgumentException('non-nullable rental_categories cannot be null');
        }
        $this->container['rental_categories'] = $rental_categories;

        return $this;
    }

    /**
     * Gets rental_max_price
     *
     * @return float|null
     */
    public function getRentalMaxPrice()
    {
        return $this->container['rental_max_price'];
    }

    /**
     * Sets rental_max_price
     *
     * @param float|null $rental_max_price Max. rental price per participation. When set to null, no limit is used.
     *
     * @return self
     */
    public function setRentalMaxPrice($rental_max_price)
    {
        if (is_null($rental_max_price)) {
            array_push($this->openAPINullablesSetToNull, 'rental_max_price');
        } else {
            $nullablesSetToNull = $this->getOpenAPINullablesSetToNull();
            $index = array_search('rental_max_price', $nullablesSetToNull);
            if ($index !== FALSE) {
                unset($nullablesSetToNull[$index]);
                $this->setOpenAPINullablesSetToNull($nullablesSetToNull);
            }
        }
        $this->container['rental_max_price'] = $rental_max_price;

        return $this;
    }

    /**
     * Gets career_partners
     *
     * @return \OpenAPI\Client\Model\CareerPartner1[]|null
     */
    public function getCareerPartners()
    {
        return $this->container['career_partners'];
    }

    /**
     * Sets career_partners
     *
     * @param \OpenAPI\Client\Model\CareerPartner1[]|null $career_partners career_partners
     *
     * @return self
     */
    public function setCareerPartners($career_partners)
    {
        if (is_null($career_partners)) {
            array_push($this->openAPINullablesSetToNull, 'career_partners');
        } else {
            $nullablesSetToNull = $this->getOpenAPINullablesSetToNull();
            $index = array_search('career_partners', $nullablesSetToNull);
            if ($index !== FALSE) {
                unset($nullablesSetToNull[$index]);
                $this->setOpenAPINullablesSetToNull($nullablesSetToNull);
            }
        }
        $this->container['career_partners'] = $career_partners;

        return $this;
    }

    /**
     * Gets website_url
     *
     * @return string|null
     */
    public function getWebsiteUrl()
    {
        return $this->container['website_url'];
    }

    /**
     * Sets website_url
     *
     * @param string|null $website_url URL for this event on the website. If the association has multiple websites, the first available website on which this event is published, is used.
     *
     * @return self
     */
    public function setWebsiteUrl($website_url)
    {
        if (is_null($website_url)) {
            throw new \InvalidArgumentException('non-nullable website_url cannot be null');
        }
        $this->container['website_url'] = $website_url;

        return $this;
    }

    /**
     * Gets website_subscribe_url
     *
     * @return string|null
     */
    public function getWebsiteSubscribeUrl()
    {
        return $this->container['website_subscribe_url'];
    }

    /**
     * Sets website_subscribe_url
     *
     * @param string|null $website_subscribe_url URL on the website to subscribe for this event. If the association has multiple websites, the first available website on which this event is published, is used.
     *
     * @return self
     */
    public function setWebsiteSubscribeUrl($website_subscribe_url)
    {
        if (is_null($website_subscribe_url)) {
            throw new \InvalidArgumentException('non-nullable website_subscribe_url cannot be null');
        }
        $this->container['website_subscribe_url'] = $website_subscribe_url;

        return $this;
    }

    /**
     * Gets comments_open
     *
     * @return bool|null
     */
    public function getCommentsOpen()
    {
        return $this->container['comments_open'];
    }

    /**
     * Sets comments_open
     *
     * @param bool|null $comments_open comments_open
     *
     * @return self
     */
    public function setCommentsOpen($comments_open)
    {
        if (is_null($comments_open)) {
            array_push($this->openAPINullablesSetToNull, 'comments_open');
        } else {
            $nullablesSetToNull = $this->getOpenAPINullablesSetToNull();
            $index = array_search('comments_open', $nullablesSetToNull);
            if ($index !== FALSE) {
                unset($nullablesSetToNull[$index]);
                $this->setOpenAPINullablesSetToNull($nullablesSetToNull);
            }
        }
        $this->container['comments_open'] = $comments_open;

        return $this;
    }

    /**
     * Gets comments
     *
     * @return \OpenAPI\Client\Model\EventComment[]|null
     */
    public function getComments()
    {
        return $this->container['comments'];
    }

    /**
     * Sets comments
     *
     * @param \OpenAPI\Client\Model\EventComment[]|null $comments comments
     *
     * @return self
     */
    public function setComments($comments)
    {
        if (is_null($comments)) {
            array_push($this->openAPINullablesSetToNull, 'comments');
        } else {
            $nullablesSetToNull = $this->getOpenAPINullablesSetToNull();
            $index = array_search('comments', $nullablesSetToNull);
            if ($index !== FALSE) {
                unset($nullablesSetToNull[$index]);
                $this->setOpenAPINullablesSetToNull($nullablesSetToNull);
            }
        }
        $this->container['comments'] = $comments;

        return $this;
    }

    /**
     * Gets media
     *
     * @return \OpenAPI\Client\Model\StorageObject[]|null
     */
    public function getMedia()
    {
        return $this->container['media'];
    }

    /**
     * Sets media
     *
     * @param \OpenAPI\Client\Model\StorageObject[]|null $media media
     *
     * @return self
     */
    public function setMedia($media)
    {
        if (is_null($media)) {
            array_push($this->openAPINullablesSetToNull, 'media');
        } else {
            $nullablesSetToNull = $this->getOpenAPINullablesSetToNull();
            $index = array_search('media', $nullablesSetToNull);
            if ($index !== FALSE) {
                unset($nullablesSetToNull[$index]);
                $this->setOpenAPINullablesSetToNull($nullablesSetToNull);
            }
        }
        $this->container['media'] = $media;

        return $this;
    }

    /**
     * Gets memo
     *
     * @return string|null
     */
    public function getMemo()
    {
        return $this->container['memo'];
    }

    /**
     * Sets memo
     *
     * @param string|null $memo Internal notes for this event
     *
     * @return self
     */
    public function setMemo($memo)
    {
        if (is_null($memo)) {
            throw new \InvalidArgumentException('non-nullable memo cannot be null');
        }
        $this->container['memo'] = $memo;

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


