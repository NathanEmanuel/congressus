<?php
/**
 * Member
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
 * Member Class Doc Comment
 *
 * @category Class
 * @package  OpenAPI\Client
 * @author   OpenAPI Generator team
 * @link     https://openapi-generator.tech
 * @implements \ArrayAccess<string, mixed>
 */
class Member implements ModelInterface, ArrayAccess, \JsonSerializable
{
    public const DISCRIMINATOR = null;

    /**
      * The original name of the model.
      *
      * @var string
      */
    protected static $openAPIModelName = 'Member';

    /**
      * Array of property to type mappings. Used for (de)serialization
      *
      * @var string[]
      */
    protected static $openAPITypes = [
        'id' => 'int',
        'username' => 'string',
        'status' => '\OpenAPI\Client\Model\MembershipStatus',
        'statuses' => '\OpenAPI\Client\Model\MembershipStatus[]',
        'gender' => 'string',
        'prefix' => 'string',
        'initials' => 'string',
        'nickname' => 'string',
        'given_name' => 'string',
        'first_name' => 'string',
        'primary_last_name_main' => 'string',
        'primary_last_name_prefix' => 'string',
        'primary_last_name' => 'string',
        'secondary_last_name_main' => 'string',
        'secondary_last_name_prefix' => 'string',
        'secondary_last_name' => 'string',
        'last_name_display' => 'string',
        'last_name' => 'string',
        'search_name' => 'string',
        'suffix' => 'string',
        'date_of_birth' => '\DateTime',
        'email' => 'string',
        'phone_mobile' => '\OpenAPI\Client\Model\PhoneNumber',
        'phone_home' => '\OpenAPI\Client\Model\PhoneNumber',
        'address' => '\OpenAPI\Client\Model\Address',
        'profile_picture_id' => 'int',
        'profile_picture' => '\OpenAPI\Client\Model\StorageObject',
        'formal_picture_id' => 'int',
        'formal_picture' => '\OpenAPI\Client\Model\StorageObject',
        'deleted' => 'bool',
        'receive_sms' => 'bool',
        'receive_mailings' => 'bool',
        'show_almanac' => 'bool',
        'show_almanac_addresses' => 'bool',
        'show_almanac_phonenumbers' => 'bool',
        'show_almanac_email' => 'bool',
        'show_almanac_date_of_birth' => 'bool',
        'show_almanac_custom_fields' => 'bool',
        'modified' => '\DateTime',
        'memo' => 'string',
        'bank_account' => '\OpenAPI\Client\Model\BankAccount'
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
        'username' => null,
        'status' => null,
        'statuses' => null,
        'gender' => null,
        'prefix' => null,
        'initials' => null,
        'nickname' => null,
        'given_name' => null,
        'first_name' => null,
        'primary_last_name_main' => null,
        'primary_last_name_prefix' => null,
        'primary_last_name' => null,
        'secondary_last_name_main' => null,
        'secondary_last_name_prefix' => null,
        'secondary_last_name' => null,
        'last_name_display' => null,
        'last_name' => null,
        'search_name' => null,
        'suffix' => null,
        'date_of_birth' => 'date',
        'email' => null,
        'phone_mobile' => null,
        'phone_home' => null,
        'address' => null,
        'profile_picture_id' => null,
        'profile_picture' => null,
        'formal_picture_id' => null,
        'formal_picture' => null,
        'deleted' => null,
        'receive_sms' => null,
        'receive_mailings' => null,
        'show_almanac' => null,
        'show_almanac_addresses' => null,
        'show_almanac_phonenumbers' => null,
        'show_almanac_email' => null,
        'show_almanac_date_of_birth' => null,
        'show_almanac_custom_fields' => null,
        'modified' => 'date-time',
        'memo' => null,
        'bank_account' => null
    ];

    /**
      * Array of nullable properties. Used for (de)serialization
      *
      * @var boolean[]
      */
    protected static array $openAPINullables = [
        'id' => false,
        'username' => false,
        'status' => false,
        'statuses' => false,
        'gender' => true,
        'prefix' => true,
        'initials' => true,
        'nickname' => true,
        'given_name' => true,
        'first_name' => true,
        'primary_last_name_main' => true,
        'primary_last_name_prefix' => true,
        'primary_last_name' => false,
        'secondary_last_name_main' => true,
        'secondary_last_name_prefix' => true,
        'secondary_last_name' => true,
        'last_name_display' => true,
        'last_name' => false,
        'search_name' => true,
        'suffix' => true,
        'date_of_birth' => true,
        'email' => true,
        'phone_mobile' => true,
        'phone_home' => true,
        'address' => true,
        'profile_picture_id' => true,
        'profile_picture' => true,
        'formal_picture_id' => true,
        'formal_picture' => true,
        'deleted' => true,
        'receive_sms' => false,
        'receive_mailings' => false,
        'show_almanac' => false,
        'show_almanac_addresses' => false,
        'show_almanac_phonenumbers' => false,
        'show_almanac_email' => false,
        'show_almanac_date_of_birth' => false,
        'show_almanac_custom_fields' => false,
        'modified' => true,
        'memo' => true,
        'bank_account' => true
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
        'username' => 'username',
        'status' => 'status',
        'statuses' => 'statuses',
        'gender' => 'gender',
        'prefix' => 'prefix',
        'initials' => 'initials',
        'nickname' => 'nickname',
        'given_name' => 'given_name',
        'first_name' => 'first_name',
        'primary_last_name_main' => 'primary_last_name_main',
        'primary_last_name_prefix' => 'primary_last_name_prefix',
        'primary_last_name' => 'primary_last_name',
        'secondary_last_name_main' => 'secondary_last_name_main',
        'secondary_last_name_prefix' => 'secondary_last_name_prefix',
        'secondary_last_name' => 'secondary_last_name',
        'last_name_display' => 'last_name_display',
        'last_name' => 'last_name',
        'search_name' => 'search_name',
        'suffix' => 'suffix',
        'date_of_birth' => 'date_of_birth',
        'email' => 'email',
        'phone_mobile' => 'phone_mobile',
        'phone_home' => 'phone_home',
        'address' => 'address',
        'profile_picture_id' => 'profile_picture_id',
        'profile_picture' => 'profile_picture',
        'formal_picture_id' => 'formal_picture_id',
        'formal_picture' => 'formal_picture',
        'deleted' => 'deleted',
        'receive_sms' => 'receive_sms',
        'receive_mailings' => 'receive_mailings',
        'show_almanac' => 'show_almanac',
        'show_almanac_addresses' => 'show_almanac_addresses',
        'show_almanac_phonenumbers' => 'show_almanac_phonenumbers',
        'show_almanac_email' => 'show_almanac_email',
        'show_almanac_date_of_birth' => 'show_almanac_date_of_birth',
        'show_almanac_custom_fields' => 'show_almanac_custom_fields',
        'modified' => 'modified',
        'memo' => 'memo',
        'bank_account' => 'bank_account'
    ];

    /**
     * Array of attributes to setter functions (for deserialization of responses)
     *
     * @var string[]
     */
    protected static $setters = [
        'id' => 'setId',
        'username' => 'setUsername',
        'status' => 'setStatus',
        'statuses' => 'setStatuses',
        'gender' => 'setGender',
        'prefix' => 'setPrefix',
        'initials' => 'setInitials',
        'nickname' => 'setNickname',
        'given_name' => 'setGivenName',
        'first_name' => 'setFirstName',
        'primary_last_name_main' => 'setPrimaryLastNameMain',
        'primary_last_name_prefix' => 'setPrimaryLastNamePrefix',
        'primary_last_name' => 'setPrimaryLastName',
        'secondary_last_name_main' => 'setSecondaryLastNameMain',
        'secondary_last_name_prefix' => 'setSecondaryLastNamePrefix',
        'secondary_last_name' => 'setSecondaryLastName',
        'last_name_display' => 'setLastNameDisplay',
        'last_name' => 'setLastName',
        'search_name' => 'setSearchName',
        'suffix' => 'setSuffix',
        'date_of_birth' => 'setDateOfBirth',
        'email' => 'setEmail',
        'phone_mobile' => 'setPhoneMobile',
        'phone_home' => 'setPhoneHome',
        'address' => 'setAddress',
        'profile_picture_id' => 'setProfilePictureId',
        'profile_picture' => 'setProfilePicture',
        'formal_picture_id' => 'setFormalPictureId',
        'formal_picture' => 'setFormalPicture',
        'deleted' => 'setDeleted',
        'receive_sms' => 'setReceiveSms',
        'receive_mailings' => 'setReceiveMailings',
        'show_almanac' => 'setShowAlmanac',
        'show_almanac_addresses' => 'setShowAlmanacAddresses',
        'show_almanac_phonenumbers' => 'setShowAlmanacPhonenumbers',
        'show_almanac_email' => 'setShowAlmanacEmail',
        'show_almanac_date_of_birth' => 'setShowAlmanacDateOfBirth',
        'show_almanac_custom_fields' => 'setShowAlmanacCustomFields',
        'modified' => 'setModified',
        'memo' => 'setMemo',
        'bank_account' => 'setBankAccount'
    ];

    /**
     * Array of attributes to getter functions (for serialization of requests)
     *
     * @var string[]
     */
    protected static $getters = [
        'id' => 'getId',
        'username' => 'getUsername',
        'status' => 'getStatus',
        'statuses' => 'getStatuses',
        'gender' => 'getGender',
        'prefix' => 'getPrefix',
        'initials' => 'getInitials',
        'nickname' => 'getNickname',
        'given_name' => 'getGivenName',
        'first_name' => 'getFirstName',
        'primary_last_name_main' => 'getPrimaryLastNameMain',
        'primary_last_name_prefix' => 'getPrimaryLastNamePrefix',
        'primary_last_name' => 'getPrimaryLastName',
        'secondary_last_name_main' => 'getSecondaryLastNameMain',
        'secondary_last_name_prefix' => 'getSecondaryLastNamePrefix',
        'secondary_last_name' => 'getSecondaryLastName',
        'last_name_display' => 'getLastNameDisplay',
        'last_name' => 'getLastName',
        'search_name' => 'getSearchName',
        'suffix' => 'getSuffix',
        'date_of_birth' => 'getDateOfBirth',
        'email' => 'getEmail',
        'phone_mobile' => 'getPhoneMobile',
        'phone_home' => 'getPhoneHome',
        'address' => 'getAddress',
        'profile_picture_id' => 'getProfilePictureId',
        'profile_picture' => 'getProfilePicture',
        'formal_picture_id' => 'getFormalPictureId',
        'formal_picture' => 'getFormalPicture',
        'deleted' => 'getDeleted',
        'receive_sms' => 'getReceiveSms',
        'receive_mailings' => 'getReceiveMailings',
        'show_almanac' => 'getShowAlmanac',
        'show_almanac_addresses' => 'getShowAlmanacAddresses',
        'show_almanac_phonenumbers' => 'getShowAlmanacPhonenumbers',
        'show_almanac_email' => 'getShowAlmanacEmail',
        'show_almanac_date_of_birth' => 'getShowAlmanacDateOfBirth',
        'show_almanac_custom_fields' => 'getShowAlmanacCustomFields',
        'modified' => 'getModified',
        'memo' => 'getMemo',
        'bank_account' => 'getBankAccount'
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

    public const GENDER_M = 'm';
    public const GENDER_F = 'f';
    public const GENDER_O = 'o';
    public const GENDER_EMPTY = '';

    /**
     * Gets allowable values of the enum
     *
     * @return string[]
     */
    public function getGenderAllowableValues()
    {
        return [
            self::GENDER_M,
            self::GENDER_F,
            self::GENDER_O,
            self::GENDER_EMPTY,
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
        $this->setIfExists('username', $data ?? [], null);
        $this->setIfExists('status', $data ?? [], null);
        $this->setIfExists('statuses', $data ?? [], null);
        $this->setIfExists('gender', $data ?? [], null);
        $this->setIfExists('prefix', $data ?? [], null);
        $this->setIfExists('initials', $data ?? [], null);
        $this->setIfExists('nickname', $data ?? [], null);
        $this->setIfExists('given_name', $data ?? [], null);
        $this->setIfExists('first_name', $data ?? [], null);
        $this->setIfExists('primary_last_name_main', $data ?? [], null);
        $this->setIfExists('primary_last_name_prefix', $data ?? [], null);
        $this->setIfExists('primary_last_name', $data ?? [], null);
        $this->setIfExists('secondary_last_name_main', $data ?? [], null);
        $this->setIfExists('secondary_last_name_prefix', $data ?? [], null);
        $this->setIfExists('secondary_last_name', $data ?? [], null);
        $this->setIfExists('last_name_display', $data ?? [], null);
        $this->setIfExists('last_name', $data ?? [], null);
        $this->setIfExists('search_name', $data ?? [], null);
        $this->setIfExists('suffix', $data ?? [], null);
        $this->setIfExists('date_of_birth', $data ?? [], null);
        $this->setIfExists('email', $data ?? [], null);
        $this->setIfExists('phone_mobile', $data ?? [], null);
        $this->setIfExists('phone_home', $data ?? [], null);
        $this->setIfExists('address', $data ?? [], null);
        $this->setIfExists('profile_picture_id', $data ?? [], null);
        $this->setIfExists('profile_picture', $data ?? [], null);
        $this->setIfExists('formal_picture_id', $data ?? [], null);
        $this->setIfExists('formal_picture', $data ?? [], null);
        $this->setIfExists('deleted', $data ?? [], null);
        $this->setIfExists('receive_sms', $data ?? [], null);
        $this->setIfExists('receive_mailings', $data ?? [], null);
        $this->setIfExists('show_almanac', $data ?? [], null);
        $this->setIfExists('show_almanac_addresses', $data ?? [], null);
        $this->setIfExists('show_almanac_phonenumbers', $data ?? [], null);
        $this->setIfExists('show_almanac_email', $data ?? [], null);
        $this->setIfExists('show_almanac_date_of_birth', $data ?? [], null);
        $this->setIfExists('show_almanac_custom_fields', $data ?? [], null);
        $this->setIfExists('modified', $data ?? [], null);
        $this->setIfExists('memo', $data ?? [], null);
        $this->setIfExists('bank_account', $data ?? [], null);
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
        $allowedValues = $this->getGenderAllowableValues();
        if (!is_null($this->container['gender']) && !in_array($this->container['gender'], $allowedValues, true)) {
            $invalidProperties[] = sprintf(
                "invalid value '%s' for 'gender', must be one of '%s'",
                $this->container['gender'],
                implode("', '", $allowedValues)
            );
        }

        if (!is_null($this->container['gender']) && (mb_strlen($this->container['gender']) > 1)) {
            $invalidProperties[] = "invalid value for 'gender', the character length must be smaller than or equal to 1.";
        }

        if (!is_null($this->container['prefix']) && (mb_strlen($this->container['prefix']) > 255)) {
            $invalidProperties[] = "invalid value for 'prefix', the character length must be smaller than or equal to 255.";
        }

        if (!is_null($this->container['initials']) && (mb_strlen($this->container['initials']) > 255)) {
            $invalidProperties[] = "invalid value for 'initials', the character length must be smaller than or equal to 255.";
        }

        if (!is_null($this->container['nickname']) && (mb_strlen($this->container['nickname']) > 255)) {
            $invalidProperties[] = "invalid value for 'nickname', the character length must be smaller than or equal to 255.";
        }

        if (!is_null($this->container['given_name']) && (mb_strlen($this->container['given_name']) > 255)) {
            $invalidProperties[] = "invalid value for 'given_name', the character length must be smaller than or equal to 255.";
        }

        if (!is_null($this->container['first_name']) && (mb_strlen($this->container['first_name']) > 255)) {
            $invalidProperties[] = "invalid value for 'first_name', the character length must be smaller than or equal to 255.";
        }

        if (!is_null($this->container['primary_last_name_main']) && (mb_strlen($this->container['primary_last_name_main']) > 255)) {
            $invalidProperties[] = "invalid value for 'primary_last_name_main', the character length must be smaller than or equal to 255.";
        }

        if (!is_null($this->container['primary_last_name_prefix']) && (mb_strlen($this->container['primary_last_name_prefix']) > 255)) {
            $invalidProperties[] = "invalid value for 'primary_last_name_prefix', the character length must be smaller than or equal to 255.";
        }

        if (!is_null($this->container['secondary_last_name_main']) && (mb_strlen($this->container['secondary_last_name_main']) > 255)) {
            $invalidProperties[] = "invalid value for 'secondary_last_name_main', the character length must be smaller than or equal to 255.";
        }

        if (!is_null($this->container['secondary_last_name_prefix']) && (mb_strlen($this->container['secondary_last_name_prefix']) > 255)) {
            $invalidProperties[] = "invalid value for 'secondary_last_name_prefix', the character length must be smaller than or equal to 255.";
        }

        if (!is_null($this->container['last_name_display']) && (mb_strlen($this->container['last_name_display']) > 255)) {
            $invalidProperties[] = "invalid value for 'last_name_display', the character length must be smaller than or equal to 255.";
        }

        if (!is_null($this->container['suffix']) && (mb_strlen($this->container['suffix']) > 255)) {
            $invalidProperties[] = "invalid value for 'suffix', the character length must be smaller than or equal to 255.";
        }

        if (!is_null($this->container['email']) && (mb_strlen($this->container['email']) > 255)) {
            $invalidProperties[] = "invalid value for 'email', the character length must be smaller than or equal to 255.";
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
     * Gets username
     *
     * @return string|null
     */
    public function getUsername()
    {
        return $this->container['username'];
    }

    /**
     * Sets username
     *
     * @param string|null $username username
     *
     * @return self
     */
    public function setUsername($username)
    {
        if (is_null($username)) {
            throw new \InvalidArgumentException('non-nullable username cannot be null');
        }
        $this->container['username'] = $username;

        return $this;
    }

    /**
     * Gets status
     *
     * @return \OpenAPI\Client\Model\MembershipStatus|null
     */
    public function getStatus()
    {
        return $this->container['status'];
    }

    /**
     * Sets status
     *
     * @param \OpenAPI\Client\Model\MembershipStatus|null $status status
     *
     * @return self
     */
    public function setStatus($status)
    {
        if (is_null($status)) {
            throw new \InvalidArgumentException('non-nullable status cannot be null');
        }
        $this->container['status'] = $status;

        return $this;
    }

    /**
     * Gets statuses
     *
     * @return \OpenAPI\Client\Model\MembershipStatus[]|null
     */
    public function getStatuses()
    {
        return $this->container['statuses'];
    }

    /**
     * Sets statuses
     *
     * @param \OpenAPI\Client\Model\MembershipStatus[]|null $statuses statuses
     *
     * @return self
     */
    public function setStatuses($statuses)
    {
        if (is_null($statuses)) {
            throw new \InvalidArgumentException('non-nullable statuses cannot be null');
        }
        $this->container['statuses'] = $statuses;

        return $this;
    }

    /**
     * Gets gender
     *
     * @return string|null
     */
    public function getGender()
    {
        return $this->container['gender'];
    }

    /**
     * Sets gender
     *
     * @param string|null $gender gender
     *
     * @return self
     */
    public function setGender($gender)
    {
        if (is_null($gender)) {
            array_push($this->openAPINullablesSetToNull, 'gender');
        } else {
            $nullablesSetToNull = $this->getOpenAPINullablesSetToNull();
            $index = array_search('gender', $nullablesSetToNull);
            if ($index !== FALSE) {
                unset($nullablesSetToNull[$index]);
                $this->setOpenAPINullablesSetToNull($nullablesSetToNull);
            }
        }
        $allowedValues = $this->getGenderAllowableValues();
        if (!is_null($gender) && !in_array($gender, $allowedValues, true)) {
            throw new \InvalidArgumentException(
                sprintf(
                    "Invalid value '%s' for 'gender', must be one of '%s'",
                    $gender,
                    implode("', '", $allowedValues)
                )
            );
        }
        if (!is_null($gender) && (mb_strlen($gender) > 1)) {
            throw new \InvalidArgumentException('invalid length for $gender when calling Member., must be smaller than or equal to 1.');
        }

        $this->container['gender'] = $gender;

        return $this;
    }

    /**
     * Gets prefix
     *
     * @return string|null
     */
    public function getPrefix()
    {
        return $this->container['prefix'];
    }

    /**
     * Sets prefix
     *
     * @param string|null $prefix prefix
     *
     * @return self
     */
    public function setPrefix($prefix)
    {
        if (is_null($prefix)) {
            array_push($this->openAPINullablesSetToNull, 'prefix');
        } else {
            $nullablesSetToNull = $this->getOpenAPINullablesSetToNull();
            $index = array_search('prefix', $nullablesSetToNull);
            if ($index !== FALSE) {
                unset($nullablesSetToNull[$index]);
                $this->setOpenAPINullablesSetToNull($nullablesSetToNull);
            }
        }
        if (!is_null($prefix) && (mb_strlen($prefix) > 255)) {
            throw new \InvalidArgumentException('invalid length for $prefix when calling Member., must be smaller than or equal to 255.');
        }

        $this->container['prefix'] = $prefix;

        return $this;
    }

    /**
     * Gets initials
     *
     * @return string|null
     */
    public function getInitials()
    {
        return $this->container['initials'];
    }

    /**
     * Sets initials
     *
     * @param string|null $initials initials
     *
     * @return self
     */
    public function setInitials($initials)
    {
        if (is_null($initials)) {
            array_push($this->openAPINullablesSetToNull, 'initials');
        } else {
            $nullablesSetToNull = $this->getOpenAPINullablesSetToNull();
            $index = array_search('initials', $nullablesSetToNull);
            if ($index !== FALSE) {
                unset($nullablesSetToNull[$index]);
                $this->setOpenAPINullablesSetToNull($nullablesSetToNull);
            }
        }
        if (!is_null($initials) && (mb_strlen($initials) > 255)) {
            throw new \InvalidArgumentException('invalid length for $initials when calling Member., must be smaller than or equal to 255.');
        }

        $this->container['initials'] = $initials;

        return $this;
    }

    /**
     * Gets nickname
     *
     * @return string|null
     */
    public function getNickname()
    {
        return $this->container['nickname'];
    }

    /**
     * Sets nickname
     *
     * @param string|null $nickname nickname
     *
     * @return self
     */
    public function setNickname($nickname)
    {
        if (is_null($nickname)) {
            array_push($this->openAPINullablesSetToNull, 'nickname');
        } else {
            $nullablesSetToNull = $this->getOpenAPINullablesSetToNull();
            $index = array_search('nickname', $nullablesSetToNull);
            if ($index !== FALSE) {
                unset($nullablesSetToNull[$index]);
                $this->setOpenAPINullablesSetToNull($nullablesSetToNull);
            }
        }
        if (!is_null($nickname) && (mb_strlen($nickname) > 255)) {
            throw new \InvalidArgumentException('invalid length for $nickname when calling Member., must be smaller than or equal to 255.');
        }

        $this->container['nickname'] = $nickname;

        return $this;
    }

    /**
     * Gets given_name
     *
     * @return string|null
     */
    public function getGivenName()
    {
        return $this->container['given_name'];
    }

    /**
     * Sets given_name
     *
     * @param string|null $given_name given_name
     *
     * @return self
     */
    public function setGivenName($given_name)
    {
        if (is_null($given_name)) {
            array_push($this->openAPINullablesSetToNull, 'given_name');
        } else {
            $nullablesSetToNull = $this->getOpenAPINullablesSetToNull();
            $index = array_search('given_name', $nullablesSetToNull);
            if ($index !== FALSE) {
                unset($nullablesSetToNull[$index]);
                $this->setOpenAPINullablesSetToNull($nullablesSetToNull);
            }
        }
        if (!is_null($given_name) && (mb_strlen($given_name) > 255)) {
            throw new \InvalidArgumentException('invalid length for $given_name when calling Member., must be smaller than or equal to 255.');
        }

        $this->container['given_name'] = $given_name;

        return $this;
    }

    /**
     * Gets first_name
     *
     * @return string|null
     */
    public function getFirstName()
    {
        return $this->container['first_name'];
    }

    /**
     * Sets first_name
     *
     * @param string|null $first_name first_name
     *
     * @return self
     */
    public function setFirstName($first_name)
    {
        if (is_null($first_name)) {
            array_push($this->openAPINullablesSetToNull, 'first_name');
        } else {
            $nullablesSetToNull = $this->getOpenAPINullablesSetToNull();
            $index = array_search('first_name', $nullablesSetToNull);
            if ($index !== FALSE) {
                unset($nullablesSetToNull[$index]);
                $this->setOpenAPINullablesSetToNull($nullablesSetToNull);
            }
        }
        if (!is_null($first_name) && (mb_strlen($first_name) > 255)) {
            throw new \InvalidArgumentException('invalid length for $first_name when calling Member., must be smaller than or equal to 255.');
        }

        $this->container['first_name'] = $first_name;

        return $this;
    }

    /**
     * Gets primary_last_name_main
     *
     * @return string|null
     */
    public function getPrimaryLastNameMain()
    {
        return $this->container['primary_last_name_main'];
    }

    /**
     * Sets primary_last_name_main
     *
     * @param string|null $primary_last_name_main primary_last_name_main
     *
     * @return self
     */
    public function setPrimaryLastNameMain($primary_last_name_main)
    {
        if (is_null($primary_last_name_main)) {
            array_push($this->openAPINullablesSetToNull, 'primary_last_name_main');
        } else {
            $nullablesSetToNull = $this->getOpenAPINullablesSetToNull();
            $index = array_search('primary_last_name_main', $nullablesSetToNull);
            if ($index !== FALSE) {
                unset($nullablesSetToNull[$index]);
                $this->setOpenAPINullablesSetToNull($nullablesSetToNull);
            }
        }
        if (!is_null($primary_last_name_main) && (mb_strlen($primary_last_name_main) > 255)) {
            throw new \InvalidArgumentException('invalid length for $primary_last_name_main when calling Member., must be smaller than or equal to 255.');
        }

        $this->container['primary_last_name_main'] = $primary_last_name_main;

        return $this;
    }

    /**
     * Gets primary_last_name_prefix
     *
     * @return string|null
     */
    public function getPrimaryLastNamePrefix()
    {
        return $this->container['primary_last_name_prefix'];
    }

    /**
     * Sets primary_last_name_prefix
     *
     * @param string|null $primary_last_name_prefix primary_last_name_prefix
     *
     * @return self
     */
    public function setPrimaryLastNamePrefix($primary_last_name_prefix)
    {
        if (is_null($primary_last_name_prefix)) {
            array_push($this->openAPINullablesSetToNull, 'primary_last_name_prefix');
        } else {
            $nullablesSetToNull = $this->getOpenAPINullablesSetToNull();
            $index = array_search('primary_last_name_prefix', $nullablesSetToNull);
            if ($index !== FALSE) {
                unset($nullablesSetToNull[$index]);
                $this->setOpenAPINullablesSetToNull($nullablesSetToNull);
            }
        }
        if (!is_null($primary_last_name_prefix) && (mb_strlen($primary_last_name_prefix) > 255)) {
            throw new \InvalidArgumentException('invalid length for $primary_last_name_prefix when calling Member., must be smaller than or equal to 255.');
        }

        $this->container['primary_last_name_prefix'] = $primary_last_name_prefix;

        return $this;
    }

    /**
     * Gets primary_last_name
     *
     * @return string|null
     */
    public function getPrimaryLastName()
    {
        return $this->container['primary_last_name'];
    }

    /**
     * Sets primary_last_name
     *
     * @param string|null $primary_last_name primary_last_name
     *
     * @return self
     */
    public function setPrimaryLastName($primary_last_name)
    {
        if (is_null($primary_last_name)) {
            throw new \InvalidArgumentException('non-nullable primary_last_name cannot be null');
        }
        $this->container['primary_last_name'] = $primary_last_name;

        return $this;
    }

    /**
     * Gets secondary_last_name_main
     *
     * @return string|null
     */
    public function getSecondaryLastNameMain()
    {
        return $this->container['secondary_last_name_main'];
    }

    /**
     * Sets secondary_last_name_main
     *
     * @param string|null $secondary_last_name_main secondary_last_name_main
     *
     * @return self
     */
    public function setSecondaryLastNameMain($secondary_last_name_main)
    {
        if (is_null($secondary_last_name_main)) {
            array_push($this->openAPINullablesSetToNull, 'secondary_last_name_main');
        } else {
            $nullablesSetToNull = $this->getOpenAPINullablesSetToNull();
            $index = array_search('secondary_last_name_main', $nullablesSetToNull);
            if ($index !== FALSE) {
                unset($nullablesSetToNull[$index]);
                $this->setOpenAPINullablesSetToNull($nullablesSetToNull);
            }
        }
        if (!is_null($secondary_last_name_main) && (mb_strlen($secondary_last_name_main) > 255)) {
            throw new \InvalidArgumentException('invalid length for $secondary_last_name_main when calling Member., must be smaller than or equal to 255.');
        }

        $this->container['secondary_last_name_main'] = $secondary_last_name_main;

        return $this;
    }

    /**
     * Gets secondary_last_name_prefix
     *
     * @return string|null
     */
    public function getSecondaryLastNamePrefix()
    {
        return $this->container['secondary_last_name_prefix'];
    }

    /**
     * Sets secondary_last_name_prefix
     *
     * @param string|null $secondary_last_name_prefix secondary_last_name_prefix
     *
     * @return self
     */
    public function setSecondaryLastNamePrefix($secondary_last_name_prefix)
    {
        if (is_null($secondary_last_name_prefix)) {
            array_push($this->openAPINullablesSetToNull, 'secondary_last_name_prefix');
        } else {
            $nullablesSetToNull = $this->getOpenAPINullablesSetToNull();
            $index = array_search('secondary_last_name_prefix', $nullablesSetToNull);
            if ($index !== FALSE) {
                unset($nullablesSetToNull[$index]);
                $this->setOpenAPINullablesSetToNull($nullablesSetToNull);
            }
        }
        if (!is_null($secondary_last_name_prefix) && (mb_strlen($secondary_last_name_prefix) > 255)) {
            throw new \InvalidArgumentException('invalid length for $secondary_last_name_prefix when calling Member., must be smaller than or equal to 255.');
        }

        $this->container['secondary_last_name_prefix'] = $secondary_last_name_prefix;

        return $this;
    }

    /**
     * Gets secondary_last_name
     *
     * @return string|null
     */
    public function getSecondaryLastName()
    {
        return $this->container['secondary_last_name'];
    }

    /**
     * Sets secondary_last_name
     *
     * @param string|null $secondary_last_name secondary_last_name
     *
     * @return self
     */
    public function setSecondaryLastName($secondary_last_name)
    {
        if (is_null($secondary_last_name)) {
            array_push($this->openAPINullablesSetToNull, 'secondary_last_name');
        } else {
            $nullablesSetToNull = $this->getOpenAPINullablesSetToNull();
            $index = array_search('secondary_last_name', $nullablesSetToNull);
            if ($index !== FALSE) {
                unset($nullablesSetToNull[$index]);
                $this->setOpenAPINullablesSetToNull($nullablesSetToNull);
            }
        }
        $this->container['secondary_last_name'] = $secondary_last_name;

        return $this;
    }

    /**
     * Gets last_name_display
     *
     * @return string|null
     */
    public function getLastNameDisplay()
    {
        return $this->container['last_name_display'];
    }

    /**
     * Sets last_name_display
     *
     * @param string|null $last_name_display last_name_display
     *
     * @return self
     */
    public function setLastNameDisplay($last_name_display)
    {
        if (is_null($last_name_display)) {
            array_push($this->openAPINullablesSetToNull, 'last_name_display');
        } else {
            $nullablesSetToNull = $this->getOpenAPINullablesSetToNull();
            $index = array_search('last_name_display', $nullablesSetToNull);
            if ($index !== FALSE) {
                unset($nullablesSetToNull[$index]);
                $this->setOpenAPINullablesSetToNull($nullablesSetToNull);
            }
        }
        if (!is_null($last_name_display) && (mb_strlen($last_name_display) > 255)) {
            throw new \InvalidArgumentException('invalid length for $last_name_display when calling Member., must be smaller than or equal to 255.');
        }

        $this->container['last_name_display'] = $last_name_display;

        return $this;
    }

    /**
     * Gets last_name
     *
     * @return string|null
     */
    public function getLastName()
    {
        return $this->container['last_name'];
    }

    /**
     * Sets last_name
     *
     * @param string|null $last_name last_name
     *
     * @return self
     */
    public function setLastName($last_name)
    {
        if (is_null($last_name)) {
            throw new \InvalidArgumentException('non-nullable last_name cannot be null');
        }
        $this->container['last_name'] = $last_name;

        return $this;
    }

    /**
     * Gets search_name
     *
     * @return string|null
     */
    public function getSearchName()
    {
        return $this->container['search_name'];
    }

    /**
     * Sets search_name
     *
     * @param string|null $search_name search_name
     *
     * @return self
     */
    public function setSearchName($search_name)
    {
        if (is_null($search_name)) {
            array_push($this->openAPINullablesSetToNull, 'search_name');
        } else {
            $nullablesSetToNull = $this->getOpenAPINullablesSetToNull();
            $index = array_search('search_name', $nullablesSetToNull);
            if ($index !== FALSE) {
                unset($nullablesSetToNull[$index]);
                $this->setOpenAPINullablesSetToNull($nullablesSetToNull);
            }
        }
        $this->container['search_name'] = $search_name;

        return $this;
    }

    /**
     * Gets suffix
     *
     * @return string|null
     */
    public function getSuffix()
    {
        return $this->container['suffix'];
    }

    /**
     * Sets suffix
     *
     * @param string|null $suffix suffix
     *
     * @return self
     */
    public function setSuffix($suffix)
    {
        if (is_null($suffix)) {
            array_push($this->openAPINullablesSetToNull, 'suffix');
        } else {
            $nullablesSetToNull = $this->getOpenAPINullablesSetToNull();
            $index = array_search('suffix', $nullablesSetToNull);
            if ($index !== FALSE) {
                unset($nullablesSetToNull[$index]);
                $this->setOpenAPINullablesSetToNull($nullablesSetToNull);
            }
        }
        if (!is_null($suffix) && (mb_strlen($suffix) > 255)) {
            throw new \InvalidArgumentException('invalid length for $suffix when calling Member., must be smaller than or equal to 255.');
        }

        $this->container['suffix'] = $suffix;

        return $this;
    }

    /**
     * Gets date_of_birth
     *
     * @return \DateTime|null
     */
    public function getDateOfBirth()
    {
        return $this->container['date_of_birth'];
    }

    /**
     * Sets date_of_birth
     *
     * @param \DateTime|null $date_of_birth date_of_birth
     *
     * @return self
     */
    public function setDateOfBirth($date_of_birth)
    {
        if (is_null($date_of_birth)) {
            array_push($this->openAPINullablesSetToNull, 'date_of_birth');
        } else {
            $nullablesSetToNull = $this->getOpenAPINullablesSetToNull();
            $index = array_search('date_of_birth', $nullablesSetToNull);
            if ($index !== FALSE) {
                unset($nullablesSetToNull[$index]);
                $this->setOpenAPINullablesSetToNull($nullablesSetToNull);
            }
        }
        $this->container['date_of_birth'] = $date_of_birth;

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
            array_push($this->openAPINullablesSetToNull, 'email');
        } else {
            $nullablesSetToNull = $this->getOpenAPINullablesSetToNull();
            $index = array_search('email', $nullablesSetToNull);
            if ($index !== FALSE) {
                unset($nullablesSetToNull[$index]);
                $this->setOpenAPINullablesSetToNull($nullablesSetToNull);
            }
        }
        if (!is_null($email) && (mb_strlen($email) > 255)) {
            throw new \InvalidArgumentException('invalid length for $email when calling Member., must be smaller than or equal to 255.');
        }

        $this->container['email'] = $email;

        return $this;
    }

    /**
     * Gets phone_mobile
     *
     * @return \OpenAPI\Client\Model\PhoneNumber|null
     */
    public function getPhoneMobile()
    {
        return $this->container['phone_mobile'];
    }

    /**
     * Sets phone_mobile
     *
     * @param \OpenAPI\Client\Model\PhoneNumber|null $phone_mobile phone_mobile
     *
     * @return self
     */
    public function setPhoneMobile($phone_mobile)
    {
        if (is_null($phone_mobile)) {
            array_push($this->openAPINullablesSetToNull, 'phone_mobile');
        } else {
            $nullablesSetToNull = $this->getOpenAPINullablesSetToNull();
            $index = array_search('phone_mobile', $nullablesSetToNull);
            if ($index !== FALSE) {
                unset($nullablesSetToNull[$index]);
                $this->setOpenAPINullablesSetToNull($nullablesSetToNull);
            }
        }
        $this->container['phone_mobile'] = $phone_mobile;

        return $this;
    }

    /**
     * Gets phone_home
     *
     * @return \OpenAPI\Client\Model\PhoneNumber|null
     */
    public function getPhoneHome()
    {
        return $this->container['phone_home'];
    }

    /**
     * Sets phone_home
     *
     * @param \OpenAPI\Client\Model\PhoneNumber|null $phone_home phone_home
     *
     * @return self
     */
    public function setPhoneHome($phone_home)
    {
        if (is_null($phone_home)) {
            array_push($this->openAPINullablesSetToNull, 'phone_home');
        } else {
            $nullablesSetToNull = $this->getOpenAPINullablesSetToNull();
            $index = array_search('phone_home', $nullablesSetToNull);
            if ($index !== FALSE) {
                unset($nullablesSetToNull[$index]);
                $this->setOpenAPINullablesSetToNull($nullablesSetToNull);
            }
        }
        $this->container['phone_home'] = $phone_home;

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
            array_push($this->openAPINullablesSetToNull, 'address');
        } else {
            $nullablesSetToNull = $this->getOpenAPINullablesSetToNull();
            $index = array_search('address', $nullablesSetToNull);
            if ($index !== FALSE) {
                unset($nullablesSetToNull[$index]);
                $this->setOpenAPINullablesSetToNull($nullablesSetToNull);
            }
        }
        $this->container['address'] = $address;

        return $this;
    }

    /**
     * Gets profile_picture_id
     *
     * @return int|null
     */
    public function getProfilePictureId()
    {
        return $this->container['profile_picture_id'];
    }

    /**
     * Sets profile_picture_id
     *
     * @param int|null $profile_picture_id profile_picture_id
     *
     * @return self
     */
    public function setProfilePictureId($profile_picture_id)
    {
        if (is_null($profile_picture_id)) {
            array_push($this->openAPINullablesSetToNull, 'profile_picture_id');
        } else {
            $nullablesSetToNull = $this->getOpenAPINullablesSetToNull();
            $index = array_search('profile_picture_id', $nullablesSetToNull);
            if ($index !== FALSE) {
                unset($nullablesSetToNull[$index]);
                $this->setOpenAPINullablesSetToNull($nullablesSetToNull);
            }
        }
        $this->container['profile_picture_id'] = $profile_picture_id;

        return $this;
    }

    /**
     * Gets profile_picture
     *
     * @return \OpenAPI\Client\Model\StorageObject|null
     */
    public function getProfilePicture()
    {
        return $this->container['profile_picture'];
    }

    /**
     * Sets profile_picture
     *
     * @param \OpenAPI\Client\Model\StorageObject|null $profile_picture profile_picture
     *
     * @return self
     */
    public function setProfilePicture($profile_picture)
    {
        if (is_null($profile_picture)) {
            array_push($this->openAPINullablesSetToNull, 'profile_picture');
        } else {
            $nullablesSetToNull = $this->getOpenAPINullablesSetToNull();
            $index = array_search('profile_picture', $nullablesSetToNull);
            if ($index !== FALSE) {
                unset($nullablesSetToNull[$index]);
                $this->setOpenAPINullablesSetToNull($nullablesSetToNull);
            }
        }
        $this->container['profile_picture'] = $profile_picture;

        return $this;
    }

    /**
     * Gets formal_picture_id
     *
     * @return int|null
     */
    public function getFormalPictureId()
    {
        return $this->container['formal_picture_id'];
    }

    /**
     * Sets formal_picture_id
     *
     * @param int|null $formal_picture_id formal_picture_id
     *
     * @return self
     */
    public function setFormalPictureId($formal_picture_id)
    {
        if (is_null($formal_picture_id)) {
            array_push($this->openAPINullablesSetToNull, 'formal_picture_id');
        } else {
            $nullablesSetToNull = $this->getOpenAPINullablesSetToNull();
            $index = array_search('formal_picture_id', $nullablesSetToNull);
            if ($index !== FALSE) {
                unset($nullablesSetToNull[$index]);
                $this->setOpenAPINullablesSetToNull($nullablesSetToNull);
            }
        }
        $this->container['formal_picture_id'] = $formal_picture_id;

        return $this;
    }

    /**
     * Gets formal_picture
     *
     * @return \OpenAPI\Client\Model\StorageObject|null
     */
    public function getFormalPicture()
    {
        return $this->container['formal_picture'];
    }

    /**
     * Sets formal_picture
     *
     * @param \OpenAPI\Client\Model\StorageObject|null $formal_picture formal_picture
     *
     * @return self
     */
    public function setFormalPicture($formal_picture)
    {
        if (is_null($formal_picture)) {
            array_push($this->openAPINullablesSetToNull, 'formal_picture');
        } else {
            $nullablesSetToNull = $this->getOpenAPINullablesSetToNull();
            $index = array_search('formal_picture', $nullablesSetToNull);
            if ($index !== FALSE) {
                unset($nullablesSetToNull[$index]);
                $this->setOpenAPINullablesSetToNull($nullablesSetToNull);
            }
        }
        $this->container['formal_picture'] = $formal_picture;

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
     * Gets receive_sms
     *
     * @return bool|null
     */
    public function getReceiveSms()
    {
        return $this->container['receive_sms'];
    }

    /**
     * Sets receive_sms
     *
     * @param bool|null $receive_sms receive_sms
     *
     * @return self
     */
    public function setReceiveSms($receive_sms)
    {
        if (is_null($receive_sms)) {
            throw new \InvalidArgumentException('non-nullable receive_sms cannot be null');
        }
        $this->container['receive_sms'] = $receive_sms;

        return $this;
    }

    /**
     * Gets receive_mailings
     *
     * @return bool|null
     */
    public function getReceiveMailings()
    {
        return $this->container['receive_mailings'];
    }

    /**
     * Sets receive_mailings
     *
     * @param bool|null $receive_mailings receive_mailings
     *
     * @return self
     */
    public function setReceiveMailings($receive_mailings)
    {
        if (is_null($receive_mailings)) {
            throw new \InvalidArgumentException('non-nullable receive_mailings cannot be null');
        }
        $this->container['receive_mailings'] = $receive_mailings;

        return $this;
    }

    /**
     * Gets show_almanac
     *
     * @return bool|null
     */
    public function getShowAlmanac()
    {
        return $this->container['show_almanac'];
    }

    /**
     * Sets show_almanac
     *
     * @param bool|null $show_almanac show_almanac
     *
     * @return self
     */
    public function setShowAlmanac($show_almanac)
    {
        if (is_null($show_almanac)) {
            throw new \InvalidArgumentException('non-nullable show_almanac cannot be null');
        }
        $this->container['show_almanac'] = $show_almanac;

        return $this;
    }

    /**
     * Gets show_almanac_addresses
     *
     * @return bool|null
     */
    public function getShowAlmanacAddresses()
    {
        return $this->container['show_almanac_addresses'];
    }

    /**
     * Sets show_almanac_addresses
     *
     * @param bool|null $show_almanac_addresses show_almanac_addresses
     *
     * @return self
     */
    public function setShowAlmanacAddresses($show_almanac_addresses)
    {
        if (is_null($show_almanac_addresses)) {
            throw new \InvalidArgumentException('non-nullable show_almanac_addresses cannot be null');
        }
        $this->container['show_almanac_addresses'] = $show_almanac_addresses;

        return $this;
    }

    /**
     * Gets show_almanac_phonenumbers
     *
     * @return bool|null
     */
    public function getShowAlmanacPhonenumbers()
    {
        return $this->container['show_almanac_phonenumbers'];
    }

    /**
     * Sets show_almanac_phonenumbers
     *
     * @param bool|null $show_almanac_phonenumbers show_almanac_phonenumbers
     *
     * @return self
     */
    public function setShowAlmanacPhonenumbers($show_almanac_phonenumbers)
    {
        if (is_null($show_almanac_phonenumbers)) {
            throw new \InvalidArgumentException('non-nullable show_almanac_phonenumbers cannot be null');
        }
        $this->container['show_almanac_phonenumbers'] = $show_almanac_phonenumbers;

        return $this;
    }

    /**
     * Gets show_almanac_email
     *
     * @return bool|null
     */
    public function getShowAlmanacEmail()
    {
        return $this->container['show_almanac_email'];
    }

    /**
     * Sets show_almanac_email
     *
     * @param bool|null $show_almanac_email show_almanac_email
     *
     * @return self
     */
    public function setShowAlmanacEmail($show_almanac_email)
    {
        if (is_null($show_almanac_email)) {
            throw new \InvalidArgumentException('non-nullable show_almanac_email cannot be null');
        }
        $this->container['show_almanac_email'] = $show_almanac_email;

        return $this;
    }

    /**
     * Gets show_almanac_date_of_birth
     *
     * @return bool|null
     */
    public function getShowAlmanacDateOfBirth()
    {
        return $this->container['show_almanac_date_of_birth'];
    }

    /**
     * Sets show_almanac_date_of_birth
     *
     * @param bool|null $show_almanac_date_of_birth show_almanac_date_of_birth
     *
     * @return self
     */
    public function setShowAlmanacDateOfBirth($show_almanac_date_of_birth)
    {
        if (is_null($show_almanac_date_of_birth)) {
            throw new \InvalidArgumentException('non-nullable show_almanac_date_of_birth cannot be null');
        }
        $this->container['show_almanac_date_of_birth'] = $show_almanac_date_of_birth;

        return $this;
    }

    /**
     * Gets show_almanac_custom_fields
     *
     * @return bool|null
     */
    public function getShowAlmanacCustomFields()
    {
        return $this->container['show_almanac_custom_fields'];
    }

    /**
     * Sets show_almanac_custom_fields
     *
     * @param bool|null $show_almanac_custom_fields show_almanac_custom_fields
     *
     * @return self
     */
    public function setShowAlmanacCustomFields($show_almanac_custom_fields)
    {
        if (is_null($show_almanac_custom_fields)) {
            throw new \InvalidArgumentException('non-nullable show_almanac_custom_fields cannot be null');
        }
        $this->container['show_almanac_custom_fields'] = $show_almanac_custom_fields;

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
     * @param string|null $memo Internal notes for this member
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
     * Gets bank_account
     *
     * @return \OpenAPI\Client\Model\BankAccount|null
     */
    public function getBankAccount()
    {
        return $this->container['bank_account'];
    }

    /**
     * Sets bank_account
     *
     * @param \OpenAPI\Client\Model\BankAccount|null $bank_account bank_account
     *
     * @return self
     */
    public function setBankAccount($bank_account)
    {
        if (is_null($bank_account)) {
            array_push($this->openAPINullablesSetToNull, 'bank_account');
        } else {
            $nullablesSetToNull = $this->getOpenAPINullablesSetToNull();
            $index = array_search('bank_account', $nullablesSetToNull);
            if ($index !== FALSE) {
                unset($nullablesSetToNull[$index]);
                $this->setOpenAPINullablesSetToNull($nullablesSetToNull);
            }
        }
        $this->container['bank_account'] = $bank_account;

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


