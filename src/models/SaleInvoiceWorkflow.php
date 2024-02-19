<?php
/**
 * SaleInvoiceWorkflow
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
 * SaleInvoiceWorkflow Class Doc Comment
 *
 * @category Class
 * @package  OpenAPI\Client
 * @author   OpenAPI Generator team
 * @link     https://openapi-generator.tech
 * @implements \ArrayAccess<string, mixed>
 */
class SaleInvoiceWorkflow implements ModelInterface, ArrayAccess, \JsonSerializable
{
    public const DISCRIMINATOR = null;

    /**
      * The original name of the model.
      *
      * @var string
      */
    protected static $openAPIModelName = 'SaleInvoiceWorkflow';

    /**
      * Array of property to type mappings. Used for (de)serialization
      *
      * @var string[]
      */
    protected static $openAPITypes = [
        'created' => '\DateTime',
        'modified' => '\DateTime',
        'id' => 'int',
        'type' => 'string',
        'name' => 'string',
        'memo' => 'string',
        'deleted' => 'bool',
        'payment_conditions' => 'string',
        'sale_invoice_default_delivery_method' => 'string',
        'sale_invoice_email_subject' => 'string',
        'sale_invoice_email_text' => 'string',
        'sale_invoice_due_interval' => 'int',
        'use_direct_debit' => 'bool',
        'direct_debit_payment_conditions' => 'string',
        'direct_debit_default_delivery_method' => 'string',
        'direct_debit_email_subject' => 'string',
        'direct_debit_email_text' => 'string',
        'direct_debit_due_interval' => 'int',
        'first_reminder_enabled' => 'bool',
        'first_reminder_email_text' => 'string',
        'first_reminder_email_subject' => 'string',
        'first_reminder_auto_send' => 'bool',
        'first_reminder_due_interval' => 'int',
        'first_reminder_auto_send_in_days' => 'int',
        'second_reminder_enabled' => 'bool',
        'second_reminder_email_text' => 'string',
        'second_reminder_email_subject' => 'string',
        'second_reminder_due_interval' => 'int',
        'second_reminder_auto_send' => 'bool',
        'second_reminder_auto_send_in_days' => 'int',
        'last_reminder_enabled' => 'bool',
        'last_reminder_email_text' => 'string',
        'last_reminder_email_subject' => 'string',
        'last_reminder_due_interval' => 'int',
        'last_reminder_auto_send' => 'bool',
        'last_reminder_auto_send_in_days' => 'int',
        'paid_send_email' => 'bool',
        'paid_email' => 'string',
        'paid_email_subject' => 'string',
        'direct_debit_paid_send_email' => 'bool',
        'direct_debit_paid_email' => 'string',
        'direct_debit_storno_send_email' => 'bool',
        'direct_debit_storno_email' => 'string',
        'direct_debit_storno_email_subject' => 'string'
    ];

    /**
      * Array of property to format mappings. Used for (de)serialization
      *
      * @var string[]
      * @phpstan-var array<string, string|null>
      * @psalm-var array<string, string|null>
      */
    protected static $openAPIFormats = [
        'created' => 'date-time',
        'modified' => 'date-time',
        'id' => null,
        'type' => null,
        'name' => null,
        'memo' => null,
        'deleted' => null,
        'payment_conditions' => null,
        'sale_invoice_default_delivery_method' => null,
        'sale_invoice_email_subject' => null,
        'sale_invoice_email_text' => null,
        'sale_invoice_due_interval' => null,
        'use_direct_debit' => null,
        'direct_debit_payment_conditions' => null,
        'direct_debit_default_delivery_method' => null,
        'direct_debit_email_subject' => null,
        'direct_debit_email_text' => null,
        'direct_debit_due_interval' => null,
        'first_reminder_enabled' => null,
        'first_reminder_email_text' => null,
        'first_reminder_email_subject' => null,
        'first_reminder_auto_send' => null,
        'first_reminder_due_interval' => null,
        'first_reminder_auto_send_in_days' => null,
        'second_reminder_enabled' => null,
        'second_reminder_email_text' => null,
        'second_reminder_email_subject' => null,
        'second_reminder_due_interval' => null,
        'second_reminder_auto_send' => null,
        'second_reminder_auto_send_in_days' => null,
        'last_reminder_enabled' => null,
        'last_reminder_email_text' => null,
        'last_reminder_email_subject' => null,
        'last_reminder_due_interval' => null,
        'last_reminder_auto_send' => null,
        'last_reminder_auto_send_in_days' => null,
        'paid_send_email' => null,
        'paid_email' => null,
        'paid_email_subject' => null,
        'direct_debit_paid_send_email' => null,
        'direct_debit_paid_email' => null,
        'direct_debit_storno_send_email' => null,
        'direct_debit_storno_email' => null,
        'direct_debit_storno_email_subject' => null
    ];

    /**
      * Array of nullable properties. Used for (de)serialization
      *
      * @var boolean[]
      */
    protected static array $openAPINullables = [
        'created' => true,
        'modified' => true,
        'id' => false,
        'type' => true,
        'name' => true,
        'memo' => true,
        'deleted' => true,
        'payment_conditions' => true,
        'sale_invoice_default_delivery_method' => true,
        'sale_invoice_email_subject' => true,
        'sale_invoice_email_text' => true,
        'sale_invoice_due_interval' => true,
        'use_direct_debit' => true,
        'direct_debit_payment_conditions' => true,
        'direct_debit_default_delivery_method' => true,
        'direct_debit_email_subject' => true,
        'direct_debit_email_text' => true,
        'direct_debit_due_interval' => true,
        'first_reminder_enabled' => true,
        'first_reminder_email_text' => true,
        'first_reminder_email_subject' => true,
        'first_reminder_auto_send' => true,
        'first_reminder_due_interval' => true,
        'first_reminder_auto_send_in_days' => true,
        'second_reminder_enabled' => true,
        'second_reminder_email_text' => true,
        'second_reminder_email_subject' => true,
        'second_reminder_due_interval' => true,
        'second_reminder_auto_send' => true,
        'second_reminder_auto_send_in_days' => true,
        'last_reminder_enabled' => true,
        'last_reminder_email_text' => true,
        'last_reminder_email_subject' => true,
        'last_reminder_due_interval' => true,
        'last_reminder_auto_send' => true,
        'last_reminder_auto_send_in_days' => true,
        'paid_send_email' => true,
        'paid_email' => true,
        'paid_email_subject' => true,
        'direct_debit_paid_send_email' => true,
        'direct_debit_paid_email' => true,
        'direct_debit_storno_send_email' => true,
        'direct_debit_storno_email' => true,
        'direct_debit_storno_email_subject' => true
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
        'created' => 'created',
        'modified' => 'modified',
        'id' => 'id',
        'type' => 'type',
        'name' => 'name',
        'memo' => 'memo',
        'deleted' => 'deleted',
        'payment_conditions' => 'payment_conditions',
        'sale_invoice_default_delivery_method' => 'sale_invoice_default_delivery_method',
        'sale_invoice_email_subject' => 'sale_invoice_email_subject',
        'sale_invoice_email_text' => 'sale_invoice_email_text',
        'sale_invoice_due_interval' => 'sale_invoice_due_interval',
        'use_direct_debit' => 'use_direct_debit',
        'direct_debit_payment_conditions' => 'direct_debit_payment_conditions',
        'direct_debit_default_delivery_method' => 'direct_debit_default_delivery_method',
        'direct_debit_email_subject' => 'direct_debit_email_subject',
        'direct_debit_email_text' => 'direct_debit_email_text',
        'direct_debit_due_interval' => 'direct_debit_due_interval',
        'first_reminder_enabled' => 'first_reminder_enabled',
        'first_reminder_email_text' => 'first_reminder_email_text',
        'first_reminder_email_subject' => 'first_reminder_email_subject',
        'first_reminder_auto_send' => 'first_reminder_auto_send',
        'first_reminder_due_interval' => 'first_reminder_due_interval',
        'first_reminder_auto_send_in_days' => 'first_reminder_auto_send_in_days',
        'second_reminder_enabled' => 'second_reminder_enabled',
        'second_reminder_email_text' => 'second_reminder_email_text',
        'second_reminder_email_subject' => 'second_reminder_email_subject',
        'second_reminder_due_interval' => 'second_reminder_due_interval',
        'second_reminder_auto_send' => 'second_reminder_auto_send',
        'second_reminder_auto_send_in_days' => 'second_reminder_auto_send_in_days',
        'last_reminder_enabled' => 'last_reminder_enabled',
        'last_reminder_email_text' => 'last_reminder_email_text',
        'last_reminder_email_subject' => 'last_reminder_email_subject',
        'last_reminder_due_interval' => 'last_reminder_due_interval',
        'last_reminder_auto_send' => 'last_reminder_auto_send',
        'last_reminder_auto_send_in_days' => 'last_reminder_auto_send_in_days',
        'paid_send_email' => 'paid_send_email',
        'paid_email' => 'paid_email',
        'paid_email_subject' => 'paid_email_subject',
        'direct_debit_paid_send_email' => 'direct_debit_paid_send_email',
        'direct_debit_paid_email' => 'direct_debit_paid_email',
        'direct_debit_storno_send_email' => 'direct_debit_storno_send_email',
        'direct_debit_storno_email' => 'direct_debit_storno_email',
        'direct_debit_storno_email_subject' => 'direct_debit_storno_email_subject'
    ];

    /**
     * Array of attributes to setter functions (for deserialization of responses)
     *
     * @var string[]
     */
    protected static $setters = [
        'created' => 'setCreated',
        'modified' => 'setModified',
        'id' => 'setId',
        'type' => 'setType',
        'name' => 'setName',
        'memo' => 'setMemo',
        'deleted' => 'setDeleted',
        'payment_conditions' => 'setPaymentConditions',
        'sale_invoice_default_delivery_method' => 'setSaleInvoiceDefaultDeliveryMethod',
        'sale_invoice_email_subject' => 'setSaleInvoiceEmailSubject',
        'sale_invoice_email_text' => 'setSaleInvoiceEmailText',
        'sale_invoice_due_interval' => 'setSaleInvoiceDueInterval',
        'use_direct_debit' => 'setUseDirectDebit',
        'direct_debit_payment_conditions' => 'setDirectDebitPaymentConditions',
        'direct_debit_default_delivery_method' => 'setDirectDebitDefaultDeliveryMethod',
        'direct_debit_email_subject' => 'setDirectDebitEmailSubject',
        'direct_debit_email_text' => 'setDirectDebitEmailText',
        'direct_debit_due_interval' => 'setDirectDebitDueInterval',
        'first_reminder_enabled' => 'setFirstReminderEnabled',
        'first_reminder_email_text' => 'setFirstReminderEmailText',
        'first_reminder_email_subject' => 'setFirstReminderEmailSubject',
        'first_reminder_auto_send' => 'setFirstReminderAutoSend',
        'first_reminder_due_interval' => 'setFirstReminderDueInterval',
        'first_reminder_auto_send_in_days' => 'setFirstReminderAutoSendInDays',
        'second_reminder_enabled' => 'setSecondReminderEnabled',
        'second_reminder_email_text' => 'setSecondReminderEmailText',
        'second_reminder_email_subject' => 'setSecondReminderEmailSubject',
        'second_reminder_due_interval' => 'setSecondReminderDueInterval',
        'second_reminder_auto_send' => 'setSecondReminderAutoSend',
        'second_reminder_auto_send_in_days' => 'setSecondReminderAutoSendInDays',
        'last_reminder_enabled' => 'setLastReminderEnabled',
        'last_reminder_email_text' => 'setLastReminderEmailText',
        'last_reminder_email_subject' => 'setLastReminderEmailSubject',
        'last_reminder_due_interval' => 'setLastReminderDueInterval',
        'last_reminder_auto_send' => 'setLastReminderAutoSend',
        'last_reminder_auto_send_in_days' => 'setLastReminderAutoSendInDays',
        'paid_send_email' => 'setPaidSendEmail',
        'paid_email' => 'setPaidEmail',
        'paid_email_subject' => 'setPaidEmailSubject',
        'direct_debit_paid_send_email' => 'setDirectDebitPaidSendEmail',
        'direct_debit_paid_email' => 'setDirectDebitPaidEmail',
        'direct_debit_storno_send_email' => 'setDirectDebitStornoSendEmail',
        'direct_debit_storno_email' => 'setDirectDebitStornoEmail',
        'direct_debit_storno_email_subject' => 'setDirectDebitStornoEmailSubject'
    ];

    /**
     * Array of attributes to getter functions (for serialization of requests)
     *
     * @var string[]
     */
    protected static $getters = [
        'created' => 'getCreated',
        'modified' => 'getModified',
        'id' => 'getId',
        'type' => 'getType',
        'name' => 'getName',
        'memo' => 'getMemo',
        'deleted' => 'getDeleted',
        'payment_conditions' => 'getPaymentConditions',
        'sale_invoice_default_delivery_method' => 'getSaleInvoiceDefaultDeliveryMethod',
        'sale_invoice_email_subject' => 'getSaleInvoiceEmailSubject',
        'sale_invoice_email_text' => 'getSaleInvoiceEmailText',
        'sale_invoice_due_interval' => 'getSaleInvoiceDueInterval',
        'use_direct_debit' => 'getUseDirectDebit',
        'direct_debit_payment_conditions' => 'getDirectDebitPaymentConditions',
        'direct_debit_default_delivery_method' => 'getDirectDebitDefaultDeliveryMethod',
        'direct_debit_email_subject' => 'getDirectDebitEmailSubject',
        'direct_debit_email_text' => 'getDirectDebitEmailText',
        'direct_debit_due_interval' => 'getDirectDebitDueInterval',
        'first_reminder_enabled' => 'getFirstReminderEnabled',
        'first_reminder_email_text' => 'getFirstReminderEmailText',
        'first_reminder_email_subject' => 'getFirstReminderEmailSubject',
        'first_reminder_auto_send' => 'getFirstReminderAutoSend',
        'first_reminder_due_interval' => 'getFirstReminderDueInterval',
        'first_reminder_auto_send_in_days' => 'getFirstReminderAutoSendInDays',
        'second_reminder_enabled' => 'getSecondReminderEnabled',
        'second_reminder_email_text' => 'getSecondReminderEmailText',
        'second_reminder_email_subject' => 'getSecondReminderEmailSubject',
        'second_reminder_due_interval' => 'getSecondReminderDueInterval',
        'second_reminder_auto_send' => 'getSecondReminderAutoSend',
        'second_reminder_auto_send_in_days' => 'getSecondReminderAutoSendInDays',
        'last_reminder_enabled' => 'getLastReminderEnabled',
        'last_reminder_email_text' => 'getLastReminderEmailText',
        'last_reminder_email_subject' => 'getLastReminderEmailSubject',
        'last_reminder_due_interval' => 'getLastReminderDueInterval',
        'last_reminder_auto_send' => 'getLastReminderAutoSend',
        'last_reminder_auto_send_in_days' => 'getLastReminderAutoSendInDays',
        'paid_send_email' => 'getPaidSendEmail',
        'paid_email' => 'getPaidEmail',
        'paid_email_subject' => 'getPaidEmailSubject',
        'direct_debit_paid_send_email' => 'getDirectDebitPaidSendEmail',
        'direct_debit_paid_email' => 'getDirectDebitPaidEmail',
        'direct_debit_storno_send_email' => 'getDirectDebitStornoSendEmail',
        'direct_debit_storno_email' => 'getDirectDebitStornoEmail',
        'direct_debit_storno_email_subject' => 'getDirectDebitStornoEmailSubject'
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
        $this->setIfExists('created', $data ?? [], null);
        $this->setIfExists('modified', $data ?? [], null);
        $this->setIfExists('id', $data ?? [], null);
        $this->setIfExists('type', $data ?? [], null);
        $this->setIfExists('name', $data ?? [], null);
        $this->setIfExists('memo', $data ?? [], null);
        $this->setIfExists('deleted', $data ?? [], null);
        $this->setIfExists('payment_conditions', $data ?? [], null);
        $this->setIfExists('sale_invoice_default_delivery_method', $data ?? [], null);
        $this->setIfExists('sale_invoice_email_subject', $data ?? [], null);
        $this->setIfExists('sale_invoice_email_text', $data ?? [], null);
        $this->setIfExists('sale_invoice_due_interval', $data ?? [], null);
        $this->setIfExists('use_direct_debit', $data ?? [], null);
        $this->setIfExists('direct_debit_payment_conditions', $data ?? [], null);
        $this->setIfExists('direct_debit_default_delivery_method', $data ?? [], null);
        $this->setIfExists('direct_debit_email_subject', $data ?? [], null);
        $this->setIfExists('direct_debit_email_text', $data ?? [], null);
        $this->setIfExists('direct_debit_due_interval', $data ?? [], null);
        $this->setIfExists('first_reminder_enabled', $data ?? [], null);
        $this->setIfExists('first_reminder_email_text', $data ?? [], null);
        $this->setIfExists('first_reminder_email_subject', $data ?? [], null);
        $this->setIfExists('first_reminder_auto_send', $data ?? [], null);
        $this->setIfExists('first_reminder_due_interval', $data ?? [], null);
        $this->setIfExists('first_reminder_auto_send_in_days', $data ?? [], null);
        $this->setIfExists('second_reminder_enabled', $data ?? [], null);
        $this->setIfExists('second_reminder_email_text', $data ?? [], null);
        $this->setIfExists('second_reminder_email_subject', $data ?? [], null);
        $this->setIfExists('second_reminder_due_interval', $data ?? [], null);
        $this->setIfExists('second_reminder_auto_send', $data ?? [], null);
        $this->setIfExists('second_reminder_auto_send_in_days', $data ?? [], null);
        $this->setIfExists('last_reminder_enabled', $data ?? [], null);
        $this->setIfExists('last_reminder_email_text', $data ?? [], null);
        $this->setIfExists('last_reminder_email_subject', $data ?? [], null);
        $this->setIfExists('last_reminder_due_interval', $data ?? [], null);
        $this->setIfExists('last_reminder_auto_send', $data ?? [], null);
        $this->setIfExists('last_reminder_auto_send_in_days', $data ?? [], null);
        $this->setIfExists('paid_send_email', $data ?? [], null);
        $this->setIfExists('paid_email', $data ?? [], null);
        $this->setIfExists('paid_email_subject', $data ?? [], null);
        $this->setIfExists('direct_debit_paid_send_email', $data ?? [], null);
        $this->setIfExists('direct_debit_paid_email', $data ?? [], null);
        $this->setIfExists('direct_debit_storno_send_email', $data ?? [], null);
        $this->setIfExists('direct_debit_storno_email', $data ?? [], null);
        $this->setIfExists('direct_debit_storno_email_subject', $data ?? [], null);
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

        if ($this->container['id'] === null) {
            $invalidProperties[] = "'id' can't be null";
        }
        if (!is_null($this->container['type']) && (mb_strlen($this->container['type']) > 63)) {
            $invalidProperties[] = "invalid value for 'type', the character length must be smaller than or equal to 63.";
        }

        if (!is_null($this->container['name']) && (mb_strlen($this->container['name']) > 255)) {
            $invalidProperties[] = "invalid value for 'name', the character length must be smaller than or equal to 255.";
        }

        if (!is_null($this->container['sale_invoice_default_delivery_method']) && (mb_strlen($this->container['sale_invoice_default_delivery_method']) > 255)) {
            $invalidProperties[] = "invalid value for 'sale_invoice_default_delivery_method', the character length must be smaller than or equal to 255.";
        }

        if (!is_null($this->container['sale_invoice_email_subject']) && (mb_strlen($this->container['sale_invoice_email_subject']) > 255)) {
            $invalidProperties[] = "invalid value for 'sale_invoice_email_subject', the character length must be smaller than or equal to 255.";
        }

        if (!is_null($this->container['direct_debit_default_delivery_method']) && (mb_strlen($this->container['direct_debit_default_delivery_method']) > 255)) {
            $invalidProperties[] = "invalid value for 'direct_debit_default_delivery_method', the character length must be smaller than or equal to 255.";
        }

        if (!is_null($this->container['direct_debit_email_subject']) && (mb_strlen($this->container['direct_debit_email_subject']) > 255)) {
            $invalidProperties[] = "invalid value for 'direct_debit_email_subject', the character length must be smaller than or equal to 255.";
        }

        if (!is_null($this->container['first_reminder_email_subject']) && (mb_strlen($this->container['first_reminder_email_subject']) > 255)) {
            $invalidProperties[] = "invalid value for 'first_reminder_email_subject', the character length must be smaller than or equal to 255.";
        }

        if (!is_null($this->container['second_reminder_email_subject']) && (mb_strlen($this->container['second_reminder_email_subject']) > 255)) {
            $invalidProperties[] = "invalid value for 'second_reminder_email_subject', the character length must be smaller than or equal to 255.";
        }

        if (!is_null($this->container['last_reminder_email_subject']) && (mb_strlen($this->container['last_reminder_email_subject']) > 255)) {
            $invalidProperties[] = "invalid value for 'last_reminder_email_subject', the character length must be smaller than or equal to 255.";
        }

        if (!is_null($this->container['paid_email_subject']) && (mb_strlen($this->container['paid_email_subject']) > 255)) {
            $invalidProperties[] = "invalid value for 'paid_email_subject', the character length must be smaller than or equal to 255.";
        }

        if (!is_null($this->container['direct_debit_storno_email_subject']) && (mb_strlen($this->container['direct_debit_storno_email_subject']) > 255)) {
            $invalidProperties[] = "invalid value for 'direct_debit_storno_email_subject', the character length must be smaller than or equal to 255.";
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
     * Gets id
     *
     * @return int
     */
    public function getId()
    {
        return $this->container['id'];
    }

    /**
     * Sets id
     *
     * @param int $id id
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
     * Gets type
     *
     * @return string|null
     */
    public function getType()
    {
        return $this->container['type'];
    }

    /**
     * Sets type
     *
     * @param string|null $type type
     *
     * @return self
     */
    public function setType($type)
    {
        if (is_null($type)) {
            array_push($this->openAPINullablesSetToNull, 'type');
        } else {
            $nullablesSetToNull = $this->getOpenAPINullablesSetToNull();
            $index = array_search('type', $nullablesSetToNull);
            if ($index !== FALSE) {
                unset($nullablesSetToNull[$index]);
                $this->setOpenAPINullablesSetToNull($nullablesSetToNull);
            }
        }
        if (!is_null($type) && (mb_strlen($type) > 63)) {
            throw new \InvalidArgumentException('invalid length for $type when calling SaleInvoiceWorkflow., must be smaller than or equal to 63.');
        }

        $this->container['type'] = $type;

        return $this;
    }

    /**
     * Gets name
     *
     * @return string|null
     */
    public function getName()
    {
        return $this->container['name'];
    }

    /**
     * Sets name
     *
     * @param string|null $name name
     *
     * @return self
     */
    public function setName($name)
    {
        if (is_null($name)) {
            array_push($this->openAPINullablesSetToNull, 'name');
        } else {
            $nullablesSetToNull = $this->getOpenAPINullablesSetToNull();
            $index = array_search('name', $nullablesSetToNull);
            if ($index !== FALSE) {
                unset($nullablesSetToNull[$index]);
                $this->setOpenAPINullablesSetToNull($nullablesSetToNull);
            }
        }
        if (!is_null($name) && (mb_strlen($name) > 255)) {
            throw new \InvalidArgumentException('invalid length for $name when calling SaleInvoiceWorkflow., must be smaller than or equal to 255.');
        }

        $this->container['name'] = $name;

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
     * @param string|null $memo memo
     *
     * @return self
     */
    public function setMemo($memo)
    {
        if (is_null($memo)) {
            array_push($this->openAPINullablesSetToNull, 'memo');
        } else {
            $nullablesSetToNull = $this->getOpenAPINullablesSetToNull();
            $index = array_search('memo', $nullablesSetToNull);
            if ($index !== FALSE) {
                unset($nullablesSetToNull[$index]);
                $this->setOpenAPINullablesSetToNull($nullablesSetToNull);
            }
        }
        $this->container['memo'] = $memo;

        return $this;
    }

    /**
     * Gets deleted
     *
     * @return bool|null
     */
    public function getDeleted()
    {
        return $this->container['deleted'];
    }

    /**
     * Sets deleted
     *
     * @param bool|null $deleted deleted
     *
     * @return self
     */
    public function setDeleted($deleted)
    {
        if (is_null($deleted)) {
            array_push($this->openAPINullablesSetToNull, 'deleted');
        } else {
            $nullablesSetToNull = $this->getOpenAPINullablesSetToNull();
            $index = array_search('deleted', $nullablesSetToNull);
            if ($index !== FALSE) {
                unset($nullablesSetToNull[$index]);
                $this->setOpenAPINullablesSetToNull($nullablesSetToNull);
            }
        }
        $this->container['deleted'] = $deleted;

        return $this;
    }

    /**
     * Gets payment_conditions
     *
     * @return string|null
     */
    public function getPaymentConditions()
    {
        return $this->container['payment_conditions'];
    }

    /**
     * Sets payment_conditions
     *
     * @param string|null $payment_conditions payment_conditions
     *
     * @return self
     */
    public function setPaymentConditions($payment_conditions)
    {
        if (is_null($payment_conditions)) {
            array_push($this->openAPINullablesSetToNull, 'payment_conditions');
        } else {
            $nullablesSetToNull = $this->getOpenAPINullablesSetToNull();
            $index = array_search('payment_conditions', $nullablesSetToNull);
            if ($index !== FALSE) {
                unset($nullablesSetToNull[$index]);
                $this->setOpenAPINullablesSetToNull($nullablesSetToNull);
            }
        }
        $this->container['payment_conditions'] = $payment_conditions;

        return $this;
    }

    /**
     * Gets sale_invoice_default_delivery_method
     *
     * @return string|null
     */
    public function getSaleInvoiceDefaultDeliveryMethod()
    {
        return $this->container['sale_invoice_default_delivery_method'];
    }

    /**
     * Sets sale_invoice_default_delivery_method
     *
     * @param string|null $sale_invoice_default_delivery_method sale_invoice_default_delivery_method
     *
     * @return self
     */
    public function setSaleInvoiceDefaultDeliveryMethod($sale_invoice_default_delivery_method)
    {
        if (is_null($sale_invoice_default_delivery_method)) {
            array_push($this->openAPINullablesSetToNull, 'sale_invoice_default_delivery_method');
        } else {
            $nullablesSetToNull = $this->getOpenAPINullablesSetToNull();
            $index = array_search('sale_invoice_default_delivery_method', $nullablesSetToNull);
            if ($index !== FALSE) {
                unset($nullablesSetToNull[$index]);
                $this->setOpenAPINullablesSetToNull($nullablesSetToNull);
            }
        }
        if (!is_null($sale_invoice_default_delivery_method) && (mb_strlen($sale_invoice_default_delivery_method) > 255)) {
            throw new \InvalidArgumentException('invalid length for $sale_invoice_default_delivery_method when calling SaleInvoiceWorkflow., must be smaller than or equal to 255.');
        }

        $this->container['sale_invoice_default_delivery_method'] = $sale_invoice_default_delivery_method;

        return $this;
    }

    /**
     * Gets sale_invoice_email_subject
     *
     * @return string|null
     */
    public function getSaleInvoiceEmailSubject()
    {
        return $this->container['sale_invoice_email_subject'];
    }

    /**
     * Sets sale_invoice_email_subject
     *
     * @param string|null $sale_invoice_email_subject sale_invoice_email_subject
     *
     * @return self
     */
    public function setSaleInvoiceEmailSubject($sale_invoice_email_subject)
    {
        if (is_null($sale_invoice_email_subject)) {
            array_push($this->openAPINullablesSetToNull, 'sale_invoice_email_subject');
        } else {
            $nullablesSetToNull = $this->getOpenAPINullablesSetToNull();
            $index = array_search('sale_invoice_email_subject', $nullablesSetToNull);
            if ($index !== FALSE) {
                unset($nullablesSetToNull[$index]);
                $this->setOpenAPINullablesSetToNull($nullablesSetToNull);
            }
        }
        if (!is_null($sale_invoice_email_subject) && (mb_strlen($sale_invoice_email_subject) > 255)) {
            throw new \InvalidArgumentException('invalid length for $sale_invoice_email_subject when calling SaleInvoiceWorkflow., must be smaller than or equal to 255.');
        }

        $this->container['sale_invoice_email_subject'] = $sale_invoice_email_subject;

        return $this;
    }

    /**
     * Gets sale_invoice_email_text
     *
     * @return string|null
     */
    public function getSaleInvoiceEmailText()
    {
        return $this->container['sale_invoice_email_text'];
    }

    /**
     * Sets sale_invoice_email_text
     *
     * @param string|null $sale_invoice_email_text sale_invoice_email_text
     *
     * @return self
     */
    public function setSaleInvoiceEmailText($sale_invoice_email_text)
    {
        if (is_null($sale_invoice_email_text)) {
            array_push($this->openAPINullablesSetToNull, 'sale_invoice_email_text');
        } else {
            $nullablesSetToNull = $this->getOpenAPINullablesSetToNull();
            $index = array_search('sale_invoice_email_text', $nullablesSetToNull);
            if ($index !== FALSE) {
                unset($nullablesSetToNull[$index]);
                $this->setOpenAPINullablesSetToNull($nullablesSetToNull);
            }
        }
        $this->container['sale_invoice_email_text'] = $sale_invoice_email_text;

        return $this;
    }

    /**
     * Gets sale_invoice_due_interval
     *
     * @return int|null
     */
    public function getSaleInvoiceDueInterval()
    {
        return $this->container['sale_invoice_due_interval'];
    }

    /**
     * Sets sale_invoice_due_interval
     *
     * @param int|null $sale_invoice_due_interval sale_invoice_due_interval
     *
     * @return self
     */
    public function setSaleInvoiceDueInterval($sale_invoice_due_interval)
    {
        if (is_null($sale_invoice_due_interval)) {
            array_push($this->openAPINullablesSetToNull, 'sale_invoice_due_interval');
        } else {
            $nullablesSetToNull = $this->getOpenAPINullablesSetToNull();
            $index = array_search('sale_invoice_due_interval', $nullablesSetToNull);
            if ($index !== FALSE) {
                unset($nullablesSetToNull[$index]);
                $this->setOpenAPINullablesSetToNull($nullablesSetToNull);
            }
        }
        $this->container['sale_invoice_due_interval'] = $sale_invoice_due_interval;

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
     * @param bool|null $use_direct_debit use_direct_debit
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
     * Gets direct_debit_payment_conditions
     *
     * @return string|null
     */
    public function getDirectDebitPaymentConditions()
    {
        return $this->container['direct_debit_payment_conditions'];
    }

    /**
     * Sets direct_debit_payment_conditions
     *
     * @param string|null $direct_debit_payment_conditions direct_debit_payment_conditions
     *
     * @return self
     */
    public function setDirectDebitPaymentConditions($direct_debit_payment_conditions)
    {
        if (is_null($direct_debit_payment_conditions)) {
            array_push($this->openAPINullablesSetToNull, 'direct_debit_payment_conditions');
        } else {
            $nullablesSetToNull = $this->getOpenAPINullablesSetToNull();
            $index = array_search('direct_debit_payment_conditions', $nullablesSetToNull);
            if ($index !== FALSE) {
                unset($nullablesSetToNull[$index]);
                $this->setOpenAPINullablesSetToNull($nullablesSetToNull);
            }
        }
        $this->container['direct_debit_payment_conditions'] = $direct_debit_payment_conditions;

        return $this;
    }

    /**
     * Gets direct_debit_default_delivery_method
     *
     * @return string|null
     */
    public function getDirectDebitDefaultDeliveryMethod()
    {
        return $this->container['direct_debit_default_delivery_method'];
    }

    /**
     * Sets direct_debit_default_delivery_method
     *
     * @param string|null $direct_debit_default_delivery_method direct_debit_default_delivery_method
     *
     * @return self
     */
    public function setDirectDebitDefaultDeliveryMethod($direct_debit_default_delivery_method)
    {
        if (is_null($direct_debit_default_delivery_method)) {
            array_push($this->openAPINullablesSetToNull, 'direct_debit_default_delivery_method');
        } else {
            $nullablesSetToNull = $this->getOpenAPINullablesSetToNull();
            $index = array_search('direct_debit_default_delivery_method', $nullablesSetToNull);
            if ($index !== FALSE) {
                unset($nullablesSetToNull[$index]);
                $this->setOpenAPINullablesSetToNull($nullablesSetToNull);
            }
        }
        if (!is_null($direct_debit_default_delivery_method) && (mb_strlen($direct_debit_default_delivery_method) > 255)) {
            throw new \InvalidArgumentException('invalid length for $direct_debit_default_delivery_method when calling SaleInvoiceWorkflow., must be smaller than or equal to 255.');
        }

        $this->container['direct_debit_default_delivery_method'] = $direct_debit_default_delivery_method;

        return $this;
    }

    /**
     * Gets direct_debit_email_subject
     *
     * @return string|null
     */
    public function getDirectDebitEmailSubject()
    {
        return $this->container['direct_debit_email_subject'];
    }

    /**
     * Sets direct_debit_email_subject
     *
     * @param string|null $direct_debit_email_subject direct_debit_email_subject
     *
     * @return self
     */
    public function setDirectDebitEmailSubject($direct_debit_email_subject)
    {
        if (is_null($direct_debit_email_subject)) {
            array_push($this->openAPINullablesSetToNull, 'direct_debit_email_subject');
        } else {
            $nullablesSetToNull = $this->getOpenAPINullablesSetToNull();
            $index = array_search('direct_debit_email_subject', $nullablesSetToNull);
            if ($index !== FALSE) {
                unset($nullablesSetToNull[$index]);
                $this->setOpenAPINullablesSetToNull($nullablesSetToNull);
            }
        }
        if (!is_null($direct_debit_email_subject) && (mb_strlen($direct_debit_email_subject) > 255)) {
            throw new \InvalidArgumentException('invalid length for $direct_debit_email_subject when calling SaleInvoiceWorkflow., must be smaller than or equal to 255.');
        }

        $this->container['direct_debit_email_subject'] = $direct_debit_email_subject;

        return $this;
    }

    /**
     * Gets direct_debit_email_text
     *
     * @return string|null
     */
    public function getDirectDebitEmailText()
    {
        return $this->container['direct_debit_email_text'];
    }

    /**
     * Sets direct_debit_email_text
     *
     * @param string|null $direct_debit_email_text direct_debit_email_text
     *
     * @return self
     */
    public function setDirectDebitEmailText($direct_debit_email_text)
    {
        if (is_null($direct_debit_email_text)) {
            array_push($this->openAPINullablesSetToNull, 'direct_debit_email_text');
        } else {
            $nullablesSetToNull = $this->getOpenAPINullablesSetToNull();
            $index = array_search('direct_debit_email_text', $nullablesSetToNull);
            if ($index !== FALSE) {
                unset($nullablesSetToNull[$index]);
                $this->setOpenAPINullablesSetToNull($nullablesSetToNull);
            }
        }
        $this->container['direct_debit_email_text'] = $direct_debit_email_text;

        return $this;
    }

    /**
     * Gets direct_debit_due_interval
     *
     * @return int|null
     */
    public function getDirectDebitDueInterval()
    {
        return $this->container['direct_debit_due_interval'];
    }

    /**
     * Sets direct_debit_due_interval
     *
     * @param int|null $direct_debit_due_interval direct_debit_due_interval
     *
     * @return self
     */
    public function setDirectDebitDueInterval($direct_debit_due_interval)
    {
        if (is_null($direct_debit_due_interval)) {
            array_push($this->openAPINullablesSetToNull, 'direct_debit_due_interval');
        } else {
            $nullablesSetToNull = $this->getOpenAPINullablesSetToNull();
            $index = array_search('direct_debit_due_interval', $nullablesSetToNull);
            if ($index !== FALSE) {
                unset($nullablesSetToNull[$index]);
                $this->setOpenAPINullablesSetToNull($nullablesSetToNull);
            }
        }
        $this->container['direct_debit_due_interval'] = $direct_debit_due_interval;

        return $this;
    }

    /**
     * Gets first_reminder_enabled
     *
     * @return bool|null
     */
    public function getFirstReminderEnabled()
    {
        return $this->container['first_reminder_enabled'];
    }

    /**
     * Sets first_reminder_enabled
     *
     * @param bool|null $first_reminder_enabled first_reminder_enabled
     *
     * @return self
     */
    public function setFirstReminderEnabled($first_reminder_enabled)
    {
        if (is_null($first_reminder_enabled)) {
            array_push($this->openAPINullablesSetToNull, 'first_reminder_enabled');
        } else {
            $nullablesSetToNull = $this->getOpenAPINullablesSetToNull();
            $index = array_search('first_reminder_enabled', $nullablesSetToNull);
            if ($index !== FALSE) {
                unset($nullablesSetToNull[$index]);
                $this->setOpenAPINullablesSetToNull($nullablesSetToNull);
            }
        }
        $this->container['first_reminder_enabled'] = $first_reminder_enabled;

        return $this;
    }

    /**
     * Gets first_reminder_email_text
     *
     * @return string|null
     */
    public function getFirstReminderEmailText()
    {
        return $this->container['first_reminder_email_text'];
    }

    /**
     * Sets first_reminder_email_text
     *
     * @param string|null $first_reminder_email_text first_reminder_email_text
     *
     * @return self
     */
    public function setFirstReminderEmailText($first_reminder_email_text)
    {
        if (is_null($first_reminder_email_text)) {
            array_push($this->openAPINullablesSetToNull, 'first_reminder_email_text');
        } else {
            $nullablesSetToNull = $this->getOpenAPINullablesSetToNull();
            $index = array_search('first_reminder_email_text', $nullablesSetToNull);
            if ($index !== FALSE) {
                unset($nullablesSetToNull[$index]);
                $this->setOpenAPINullablesSetToNull($nullablesSetToNull);
            }
        }
        $this->container['first_reminder_email_text'] = $first_reminder_email_text;

        return $this;
    }

    /**
     * Gets first_reminder_email_subject
     *
     * @return string|null
     */
    public function getFirstReminderEmailSubject()
    {
        return $this->container['first_reminder_email_subject'];
    }

    /**
     * Sets first_reminder_email_subject
     *
     * @param string|null $first_reminder_email_subject first_reminder_email_subject
     *
     * @return self
     */
    public function setFirstReminderEmailSubject($first_reminder_email_subject)
    {
        if (is_null($first_reminder_email_subject)) {
            array_push($this->openAPINullablesSetToNull, 'first_reminder_email_subject');
        } else {
            $nullablesSetToNull = $this->getOpenAPINullablesSetToNull();
            $index = array_search('first_reminder_email_subject', $nullablesSetToNull);
            if ($index !== FALSE) {
                unset($nullablesSetToNull[$index]);
                $this->setOpenAPINullablesSetToNull($nullablesSetToNull);
            }
        }
        if (!is_null($first_reminder_email_subject) && (mb_strlen($first_reminder_email_subject) > 255)) {
            throw new \InvalidArgumentException('invalid length for $first_reminder_email_subject when calling SaleInvoiceWorkflow., must be smaller than or equal to 255.');
        }

        $this->container['first_reminder_email_subject'] = $first_reminder_email_subject;

        return $this;
    }

    /**
     * Gets first_reminder_auto_send
     *
     * @return bool|null
     */
    public function getFirstReminderAutoSend()
    {
        return $this->container['first_reminder_auto_send'];
    }

    /**
     * Sets first_reminder_auto_send
     *
     * @param bool|null $first_reminder_auto_send first_reminder_auto_send
     *
     * @return self
     */
    public function setFirstReminderAutoSend($first_reminder_auto_send)
    {
        if (is_null($first_reminder_auto_send)) {
            array_push($this->openAPINullablesSetToNull, 'first_reminder_auto_send');
        } else {
            $nullablesSetToNull = $this->getOpenAPINullablesSetToNull();
            $index = array_search('first_reminder_auto_send', $nullablesSetToNull);
            if ($index !== FALSE) {
                unset($nullablesSetToNull[$index]);
                $this->setOpenAPINullablesSetToNull($nullablesSetToNull);
            }
        }
        $this->container['first_reminder_auto_send'] = $first_reminder_auto_send;

        return $this;
    }

    /**
     * Gets first_reminder_due_interval
     *
     * @return int|null
     */
    public function getFirstReminderDueInterval()
    {
        return $this->container['first_reminder_due_interval'];
    }

    /**
     * Sets first_reminder_due_interval
     *
     * @param int|null $first_reminder_due_interval first_reminder_due_interval
     *
     * @return self
     */
    public function setFirstReminderDueInterval($first_reminder_due_interval)
    {
        if (is_null($first_reminder_due_interval)) {
            array_push($this->openAPINullablesSetToNull, 'first_reminder_due_interval');
        } else {
            $nullablesSetToNull = $this->getOpenAPINullablesSetToNull();
            $index = array_search('first_reminder_due_interval', $nullablesSetToNull);
            if ($index !== FALSE) {
                unset($nullablesSetToNull[$index]);
                $this->setOpenAPINullablesSetToNull($nullablesSetToNull);
            }
        }
        $this->container['first_reminder_due_interval'] = $first_reminder_due_interval;

        return $this;
    }

    /**
     * Gets first_reminder_auto_send_in_days
     *
     * @return int|null
     */
    public function getFirstReminderAutoSendInDays()
    {
        return $this->container['first_reminder_auto_send_in_days'];
    }

    /**
     * Sets first_reminder_auto_send_in_days
     *
     * @param int|null $first_reminder_auto_send_in_days first_reminder_auto_send_in_days
     *
     * @return self
     */
    public function setFirstReminderAutoSendInDays($first_reminder_auto_send_in_days)
    {
        if (is_null($first_reminder_auto_send_in_days)) {
            array_push($this->openAPINullablesSetToNull, 'first_reminder_auto_send_in_days');
        } else {
            $nullablesSetToNull = $this->getOpenAPINullablesSetToNull();
            $index = array_search('first_reminder_auto_send_in_days', $nullablesSetToNull);
            if ($index !== FALSE) {
                unset($nullablesSetToNull[$index]);
                $this->setOpenAPINullablesSetToNull($nullablesSetToNull);
            }
        }
        $this->container['first_reminder_auto_send_in_days'] = $first_reminder_auto_send_in_days;

        return $this;
    }

    /**
     * Gets second_reminder_enabled
     *
     * @return bool|null
     */
    public function getSecondReminderEnabled()
    {
        return $this->container['second_reminder_enabled'];
    }

    /**
     * Sets second_reminder_enabled
     *
     * @param bool|null $second_reminder_enabled second_reminder_enabled
     *
     * @return self
     */
    public function setSecondReminderEnabled($second_reminder_enabled)
    {
        if (is_null($second_reminder_enabled)) {
            array_push($this->openAPINullablesSetToNull, 'second_reminder_enabled');
        } else {
            $nullablesSetToNull = $this->getOpenAPINullablesSetToNull();
            $index = array_search('second_reminder_enabled', $nullablesSetToNull);
            if ($index !== FALSE) {
                unset($nullablesSetToNull[$index]);
                $this->setOpenAPINullablesSetToNull($nullablesSetToNull);
            }
        }
        $this->container['second_reminder_enabled'] = $second_reminder_enabled;

        return $this;
    }

    /**
     * Gets second_reminder_email_text
     *
     * @return string|null
     */
    public function getSecondReminderEmailText()
    {
        return $this->container['second_reminder_email_text'];
    }

    /**
     * Sets second_reminder_email_text
     *
     * @param string|null $second_reminder_email_text second_reminder_email_text
     *
     * @return self
     */
    public function setSecondReminderEmailText($second_reminder_email_text)
    {
        if (is_null($second_reminder_email_text)) {
            array_push($this->openAPINullablesSetToNull, 'second_reminder_email_text');
        } else {
            $nullablesSetToNull = $this->getOpenAPINullablesSetToNull();
            $index = array_search('second_reminder_email_text', $nullablesSetToNull);
            if ($index !== FALSE) {
                unset($nullablesSetToNull[$index]);
                $this->setOpenAPINullablesSetToNull($nullablesSetToNull);
            }
        }
        $this->container['second_reminder_email_text'] = $second_reminder_email_text;

        return $this;
    }

    /**
     * Gets second_reminder_email_subject
     *
     * @return string|null
     */
    public function getSecondReminderEmailSubject()
    {
        return $this->container['second_reminder_email_subject'];
    }

    /**
     * Sets second_reminder_email_subject
     *
     * @param string|null $second_reminder_email_subject second_reminder_email_subject
     *
     * @return self
     */
    public function setSecondReminderEmailSubject($second_reminder_email_subject)
    {
        if (is_null($second_reminder_email_subject)) {
            array_push($this->openAPINullablesSetToNull, 'second_reminder_email_subject');
        } else {
            $nullablesSetToNull = $this->getOpenAPINullablesSetToNull();
            $index = array_search('second_reminder_email_subject', $nullablesSetToNull);
            if ($index !== FALSE) {
                unset($nullablesSetToNull[$index]);
                $this->setOpenAPINullablesSetToNull($nullablesSetToNull);
            }
        }
        if (!is_null($second_reminder_email_subject) && (mb_strlen($second_reminder_email_subject) > 255)) {
            throw new \InvalidArgumentException('invalid length for $second_reminder_email_subject when calling SaleInvoiceWorkflow., must be smaller than or equal to 255.');
        }

        $this->container['second_reminder_email_subject'] = $second_reminder_email_subject;

        return $this;
    }

    /**
     * Gets second_reminder_due_interval
     *
     * @return int|null
     */
    public function getSecondReminderDueInterval()
    {
        return $this->container['second_reminder_due_interval'];
    }

    /**
     * Sets second_reminder_due_interval
     *
     * @param int|null $second_reminder_due_interval second_reminder_due_interval
     *
     * @return self
     */
    public function setSecondReminderDueInterval($second_reminder_due_interval)
    {
        if (is_null($second_reminder_due_interval)) {
            array_push($this->openAPINullablesSetToNull, 'second_reminder_due_interval');
        } else {
            $nullablesSetToNull = $this->getOpenAPINullablesSetToNull();
            $index = array_search('second_reminder_due_interval', $nullablesSetToNull);
            if ($index !== FALSE) {
                unset($nullablesSetToNull[$index]);
                $this->setOpenAPINullablesSetToNull($nullablesSetToNull);
            }
        }
        $this->container['second_reminder_due_interval'] = $second_reminder_due_interval;

        return $this;
    }

    /**
     * Gets second_reminder_auto_send
     *
     * @return bool|null
     */
    public function getSecondReminderAutoSend()
    {
        return $this->container['second_reminder_auto_send'];
    }

    /**
     * Sets second_reminder_auto_send
     *
     * @param bool|null $second_reminder_auto_send second_reminder_auto_send
     *
     * @return self
     */
    public function setSecondReminderAutoSend($second_reminder_auto_send)
    {
        if (is_null($second_reminder_auto_send)) {
            array_push($this->openAPINullablesSetToNull, 'second_reminder_auto_send');
        } else {
            $nullablesSetToNull = $this->getOpenAPINullablesSetToNull();
            $index = array_search('second_reminder_auto_send', $nullablesSetToNull);
            if ($index !== FALSE) {
                unset($nullablesSetToNull[$index]);
                $this->setOpenAPINullablesSetToNull($nullablesSetToNull);
            }
        }
        $this->container['second_reminder_auto_send'] = $second_reminder_auto_send;

        return $this;
    }

    /**
     * Gets second_reminder_auto_send_in_days
     *
     * @return int|null
     */
    public function getSecondReminderAutoSendInDays()
    {
        return $this->container['second_reminder_auto_send_in_days'];
    }

    /**
     * Sets second_reminder_auto_send_in_days
     *
     * @param int|null $second_reminder_auto_send_in_days second_reminder_auto_send_in_days
     *
     * @return self
     */
    public function setSecondReminderAutoSendInDays($second_reminder_auto_send_in_days)
    {
        if (is_null($second_reminder_auto_send_in_days)) {
            array_push($this->openAPINullablesSetToNull, 'second_reminder_auto_send_in_days');
        } else {
            $nullablesSetToNull = $this->getOpenAPINullablesSetToNull();
            $index = array_search('second_reminder_auto_send_in_days', $nullablesSetToNull);
            if ($index !== FALSE) {
                unset($nullablesSetToNull[$index]);
                $this->setOpenAPINullablesSetToNull($nullablesSetToNull);
            }
        }
        $this->container['second_reminder_auto_send_in_days'] = $second_reminder_auto_send_in_days;

        return $this;
    }

    /**
     * Gets last_reminder_enabled
     *
     * @return bool|null
     */
    public function getLastReminderEnabled()
    {
        return $this->container['last_reminder_enabled'];
    }

    /**
     * Sets last_reminder_enabled
     *
     * @param bool|null $last_reminder_enabled last_reminder_enabled
     *
     * @return self
     */
    public function setLastReminderEnabled($last_reminder_enabled)
    {
        if (is_null($last_reminder_enabled)) {
            array_push($this->openAPINullablesSetToNull, 'last_reminder_enabled');
        } else {
            $nullablesSetToNull = $this->getOpenAPINullablesSetToNull();
            $index = array_search('last_reminder_enabled', $nullablesSetToNull);
            if ($index !== FALSE) {
                unset($nullablesSetToNull[$index]);
                $this->setOpenAPINullablesSetToNull($nullablesSetToNull);
            }
        }
        $this->container['last_reminder_enabled'] = $last_reminder_enabled;

        return $this;
    }

    /**
     * Gets last_reminder_email_text
     *
     * @return string|null
     */
    public function getLastReminderEmailText()
    {
        return $this->container['last_reminder_email_text'];
    }

    /**
     * Sets last_reminder_email_text
     *
     * @param string|null $last_reminder_email_text last_reminder_email_text
     *
     * @return self
     */
    public function setLastReminderEmailText($last_reminder_email_text)
    {
        if (is_null($last_reminder_email_text)) {
            array_push($this->openAPINullablesSetToNull, 'last_reminder_email_text');
        } else {
            $nullablesSetToNull = $this->getOpenAPINullablesSetToNull();
            $index = array_search('last_reminder_email_text', $nullablesSetToNull);
            if ($index !== FALSE) {
                unset($nullablesSetToNull[$index]);
                $this->setOpenAPINullablesSetToNull($nullablesSetToNull);
            }
        }
        $this->container['last_reminder_email_text'] = $last_reminder_email_text;

        return $this;
    }

    /**
     * Gets last_reminder_email_subject
     *
     * @return string|null
     */
    public function getLastReminderEmailSubject()
    {
        return $this->container['last_reminder_email_subject'];
    }

    /**
     * Sets last_reminder_email_subject
     *
     * @param string|null $last_reminder_email_subject last_reminder_email_subject
     *
     * @return self
     */
    public function setLastReminderEmailSubject($last_reminder_email_subject)
    {
        if (is_null($last_reminder_email_subject)) {
            array_push($this->openAPINullablesSetToNull, 'last_reminder_email_subject');
        } else {
            $nullablesSetToNull = $this->getOpenAPINullablesSetToNull();
            $index = array_search('last_reminder_email_subject', $nullablesSetToNull);
            if ($index !== FALSE) {
                unset($nullablesSetToNull[$index]);
                $this->setOpenAPINullablesSetToNull($nullablesSetToNull);
            }
        }
        if (!is_null($last_reminder_email_subject) && (mb_strlen($last_reminder_email_subject) > 255)) {
            throw new \InvalidArgumentException('invalid length for $last_reminder_email_subject when calling SaleInvoiceWorkflow., must be smaller than or equal to 255.');
        }

        $this->container['last_reminder_email_subject'] = $last_reminder_email_subject;

        return $this;
    }

    /**
     * Gets last_reminder_due_interval
     *
     * @return int|null
     */
    public function getLastReminderDueInterval()
    {
        return $this->container['last_reminder_due_interval'];
    }

    /**
     * Sets last_reminder_due_interval
     *
     * @param int|null $last_reminder_due_interval last_reminder_due_interval
     *
     * @return self
     */
    public function setLastReminderDueInterval($last_reminder_due_interval)
    {
        if (is_null($last_reminder_due_interval)) {
            array_push($this->openAPINullablesSetToNull, 'last_reminder_due_interval');
        } else {
            $nullablesSetToNull = $this->getOpenAPINullablesSetToNull();
            $index = array_search('last_reminder_due_interval', $nullablesSetToNull);
            if ($index !== FALSE) {
                unset($nullablesSetToNull[$index]);
                $this->setOpenAPINullablesSetToNull($nullablesSetToNull);
            }
        }
        $this->container['last_reminder_due_interval'] = $last_reminder_due_interval;

        return $this;
    }

    /**
     * Gets last_reminder_auto_send
     *
     * @return bool|null
     */
    public function getLastReminderAutoSend()
    {
        return $this->container['last_reminder_auto_send'];
    }

    /**
     * Sets last_reminder_auto_send
     *
     * @param bool|null $last_reminder_auto_send last_reminder_auto_send
     *
     * @return self
     */
    public function setLastReminderAutoSend($last_reminder_auto_send)
    {
        if (is_null($last_reminder_auto_send)) {
            array_push($this->openAPINullablesSetToNull, 'last_reminder_auto_send');
        } else {
            $nullablesSetToNull = $this->getOpenAPINullablesSetToNull();
            $index = array_search('last_reminder_auto_send', $nullablesSetToNull);
            if ($index !== FALSE) {
                unset($nullablesSetToNull[$index]);
                $this->setOpenAPINullablesSetToNull($nullablesSetToNull);
            }
        }
        $this->container['last_reminder_auto_send'] = $last_reminder_auto_send;

        return $this;
    }

    /**
     * Gets last_reminder_auto_send_in_days
     *
     * @return int|null
     */
    public function getLastReminderAutoSendInDays()
    {
        return $this->container['last_reminder_auto_send_in_days'];
    }

    /**
     * Sets last_reminder_auto_send_in_days
     *
     * @param int|null $last_reminder_auto_send_in_days last_reminder_auto_send_in_days
     *
     * @return self
     */
    public function setLastReminderAutoSendInDays($last_reminder_auto_send_in_days)
    {
        if (is_null($last_reminder_auto_send_in_days)) {
            array_push($this->openAPINullablesSetToNull, 'last_reminder_auto_send_in_days');
        } else {
            $nullablesSetToNull = $this->getOpenAPINullablesSetToNull();
            $index = array_search('last_reminder_auto_send_in_days', $nullablesSetToNull);
            if ($index !== FALSE) {
                unset($nullablesSetToNull[$index]);
                $this->setOpenAPINullablesSetToNull($nullablesSetToNull);
            }
        }
        $this->container['last_reminder_auto_send_in_days'] = $last_reminder_auto_send_in_days;

        return $this;
    }

    /**
     * Gets paid_send_email
     *
     * @return bool|null
     */
    public function getPaidSendEmail()
    {
        return $this->container['paid_send_email'];
    }

    /**
     * Sets paid_send_email
     *
     * @param bool|null $paid_send_email paid_send_email
     *
     * @return self
     */
    public function setPaidSendEmail($paid_send_email)
    {
        if (is_null($paid_send_email)) {
            array_push($this->openAPINullablesSetToNull, 'paid_send_email');
        } else {
            $nullablesSetToNull = $this->getOpenAPINullablesSetToNull();
            $index = array_search('paid_send_email', $nullablesSetToNull);
            if ($index !== FALSE) {
                unset($nullablesSetToNull[$index]);
                $this->setOpenAPINullablesSetToNull($nullablesSetToNull);
            }
        }
        $this->container['paid_send_email'] = $paid_send_email;

        return $this;
    }

    /**
     * Gets paid_email
     *
     * @return string|null
     */
    public function getPaidEmail()
    {
        return $this->container['paid_email'];
    }

    /**
     * Sets paid_email
     *
     * @param string|null $paid_email paid_email
     *
     * @return self
     */
    public function setPaidEmail($paid_email)
    {
        if (is_null($paid_email)) {
            array_push($this->openAPINullablesSetToNull, 'paid_email');
        } else {
            $nullablesSetToNull = $this->getOpenAPINullablesSetToNull();
            $index = array_search('paid_email', $nullablesSetToNull);
            if ($index !== FALSE) {
                unset($nullablesSetToNull[$index]);
                $this->setOpenAPINullablesSetToNull($nullablesSetToNull);
            }
        }
        $this->container['paid_email'] = $paid_email;

        return $this;
    }

    /**
     * Gets paid_email_subject
     *
     * @return string|null
     */
    public function getPaidEmailSubject()
    {
        return $this->container['paid_email_subject'];
    }

    /**
     * Sets paid_email_subject
     *
     * @param string|null $paid_email_subject paid_email_subject
     *
     * @return self
     */
    public function setPaidEmailSubject($paid_email_subject)
    {
        if (is_null($paid_email_subject)) {
            array_push($this->openAPINullablesSetToNull, 'paid_email_subject');
        } else {
            $nullablesSetToNull = $this->getOpenAPINullablesSetToNull();
            $index = array_search('paid_email_subject', $nullablesSetToNull);
            if ($index !== FALSE) {
                unset($nullablesSetToNull[$index]);
                $this->setOpenAPINullablesSetToNull($nullablesSetToNull);
            }
        }
        if (!is_null($paid_email_subject) && (mb_strlen($paid_email_subject) > 255)) {
            throw new \InvalidArgumentException('invalid length for $paid_email_subject when calling SaleInvoiceWorkflow., must be smaller than or equal to 255.');
        }

        $this->container['paid_email_subject'] = $paid_email_subject;

        return $this;
    }

    /**
     * Gets direct_debit_paid_send_email
     *
     * @return bool|null
     */
    public function getDirectDebitPaidSendEmail()
    {
        return $this->container['direct_debit_paid_send_email'];
    }

    /**
     * Sets direct_debit_paid_send_email
     *
     * @param bool|null $direct_debit_paid_send_email direct_debit_paid_send_email
     *
     * @return self
     */
    public function setDirectDebitPaidSendEmail($direct_debit_paid_send_email)
    {
        if (is_null($direct_debit_paid_send_email)) {
            array_push($this->openAPINullablesSetToNull, 'direct_debit_paid_send_email');
        } else {
            $nullablesSetToNull = $this->getOpenAPINullablesSetToNull();
            $index = array_search('direct_debit_paid_send_email', $nullablesSetToNull);
            if ($index !== FALSE) {
                unset($nullablesSetToNull[$index]);
                $this->setOpenAPINullablesSetToNull($nullablesSetToNull);
            }
        }
        $this->container['direct_debit_paid_send_email'] = $direct_debit_paid_send_email;

        return $this;
    }

    /**
     * Gets direct_debit_paid_email
     *
     * @return string|null
     */
    public function getDirectDebitPaidEmail()
    {
        return $this->container['direct_debit_paid_email'];
    }

    /**
     * Sets direct_debit_paid_email
     *
     * @param string|null $direct_debit_paid_email direct_debit_paid_email
     *
     * @return self
     */
    public function setDirectDebitPaidEmail($direct_debit_paid_email)
    {
        if (is_null($direct_debit_paid_email)) {
            array_push($this->openAPINullablesSetToNull, 'direct_debit_paid_email');
        } else {
            $nullablesSetToNull = $this->getOpenAPINullablesSetToNull();
            $index = array_search('direct_debit_paid_email', $nullablesSetToNull);
            if ($index !== FALSE) {
                unset($nullablesSetToNull[$index]);
                $this->setOpenAPINullablesSetToNull($nullablesSetToNull);
            }
        }
        $this->container['direct_debit_paid_email'] = $direct_debit_paid_email;

        return $this;
    }

    /**
     * Gets direct_debit_storno_send_email
     *
     * @return bool|null
     */
    public function getDirectDebitStornoSendEmail()
    {
        return $this->container['direct_debit_storno_send_email'];
    }

    /**
     * Sets direct_debit_storno_send_email
     *
     * @param bool|null $direct_debit_storno_send_email direct_debit_storno_send_email
     *
     * @return self
     */
    public function setDirectDebitStornoSendEmail($direct_debit_storno_send_email)
    {
        if (is_null($direct_debit_storno_send_email)) {
            array_push($this->openAPINullablesSetToNull, 'direct_debit_storno_send_email');
        } else {
            $nullablesSetToNull = $this->getOpenAPINullablesSetToNull();
            $index = array_search('direct_debit_storno_send_email', $nullablesSetToNull);
            if ($index !== FALSE) {
                unset($nullablesSetToNull[$index]);
                $this->setOpenAPINullablesSetToNull($nullablesSetToNull);
            }
        }
        $this->container['direct_debit_storno_send_email'] = $direct_debit_storno_send_email;

        return $this;
    }

    /**
     * Gets direct_debit_storno_email
     *
     * @return string|null
     */
    public function getDirectDebitStornoEmail()
    {
        return $this->container['direct_debit_storno_email'];
    }

    /**
     * Sets direct_debit_storno_email
     *
     * @param string|null $direct_debit_storno_email direct_debit_storno_email
     *
     * @return self
     */
    public function setDirectDebitStornoEmail($direct_debit_storno_email)
    {
        if (is_null($direct_debit_storno_email)) {
            array_push($this->openAPINullablesSetToNull, 'direct_debit_storno_email');
        } else {
            $nullablesSetToNull = $this->getOpenAPINullablesSetToNull();
            $index = array_search('direct_debit_storno_email', $nullablesSetToNull);
            if ($index !== FALSE) {
                unset($nullablesSetToNull[$index]);
                $this->setOpenAPINullablesSetToNull($nullablesSetToNull);
            }
        }
        $this->container['direct_debit_storno_email'] = $direct_debit_storno_email;

        return $this;
    }

    /**
     * Gets direct_debit_storno_email_subject
     *
     * @return string|null
     */
    public function getDirectDebitStornoEmailSubject()
    {
        return $this->container['direct_debit_storno_email_subject'];
    }

    /**
     * Sets direct_debit_storno_email_subject
     *
     * @param string|null $direct_debit_storno_email_subject direct_debit_storno_email_subject
     *
     * @return self
     */
    public function setDirectDebitStornoEmailSubject($direct_debit_storno_email_subject)
    {
        if (is_null($direct_debit_storno_email_subject)) {
            array_push($this->openAPINullablesSetToNull, 'direct_debit_storno_email_subject');
        } else {
            $nullablesSetToNull = $this->getOpenAPINullablesSetToNull();
            $index = array_search('direct_debit_storno_email_subject', $nullablesSetToNull);
            if ($index !== FALSE) {
                unset($nullablesSetToNull[$index]);
                $this->setOpenAPINullablesSetToNull($nullablesSetToNull);
            }
        }
        if (!is_null($direct_debit_storno_email_subject) && (mb_strlen($direct_debit_storno_email_subject) > 255)) {
            throw new \InvalidArgumentException('invalid length for $direct_debit_storno_email_subject when calling SaleInvoiceWorkflow., must be smaller than or equal to 255.');
        }

        $this->container['direct_debit_storno_email_subject'] = $direct_debit_storno_email_subject;

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


