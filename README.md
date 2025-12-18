# Congressus API client


## Interacting with the REST API

All you need to use this library with the REST API is an API token/key from Congressus, which you can get [here](https://manager.congressus.nl/settings/integrations/apps). Use this token to instatiate a `Client`. You can either use `Client` itself or you can subclass it.

`Client` has a method for each possible call to the Congressus API. You can use these methods either directly, or in methods of a subclass to create more complicated requests. The latter is how this library is the most powerful, because you can make a class that completely suits your needs.


### Making requests

The names of the methods in `Client` are the camelCase version of the names in [Congressus's API documentation](https://api.congressus.nl/v30/docs). For example, API call *List Group memberships* is done by `Client`'s method `listGroupMemberships()`.

The path parameters, query parameters and request body fields are passed as arguments to these methods. Their names in `Client` are always the same as in the [API documentation](https://api.congressus.nl/v30/docs).


### Example

```PHP
// Instatiate an API client with a token stored in environment variable "CONGRESSUS_API_TOKEN":
$client = new Client(getenv("CONGRESSUS_API_TOKEN")); // KEEP TOKEN SECURE!

// Request a listing of the next 5 events in order of most to least soon:
$upcomingEvents = $client->listEvents(limit: 5, order: "start:asc");

// Print the events
echo "The next 5 events are:" . PHP_EOL
foreach ($upcomingEvents as $event) {
    echo $nextEvent->getName() . PHP_EOL;
}
```

## OAuth2

This library supports authentication via Congressus using OAuth2. The library handles all of the auth flow. All you need to do is registering your OAuth2 application with Congressus, which you can do [here](https://manager.congressus.nl/settings/integrations/apps).

Fill in the redirect URI of your app, your desired access token validity (using default is okay), and the scope you want for your application. It is recommended to also enable refresh tokens and silent grants. Refresh tokens are automatically used by the library to obtain an new access token once it expires. Your application does not need to take care of this.

### Using the library

Once you registered your application, you must instantiate a `CongressusOAuth2` object and provide it with the following 4 parameters:

- **Client ID**. You get this from Congressus Manager.
- **Client secret**. You get this from Congressus Manager.
- **The domain of your association**. Note that redirected domains do not work. If you are unsure what domain to use, go to your association's Congressus website and copy the entire URL in the browser's address bar. The library will parse the correct domain for you.
- **Scope**. This can be the whole scope that you gave your app access to in Congressus Manager or it can be a subset of it.

Once you instantiated the object, you can handle user requests with `handleRequest()`. This will receive incoming requests from the user and authenticate them. This method will successfully terminate once the auth flow is successfully finished and you have received the user's access token. If you just need to authenticate a user, you are now done, but OAuth2 allows you to do a little bit more.

You can retrieve the access token and its metadata with `getAccessToken()`. This is primarily useful for debug purposes. In your production application, there should be no need to call this method, because the library will handle the auth flow for you!

Once a user is successfully authenticated, you can retrieve the data that the application has access to in its scope using `getResourceOwner()`. Note that this do _not_ return a `Member` or `MemberWithCustomFields` object. Instead, it returns a `CongressusResourceOwner` object, which contains less data. If you need more information about the member, you can use their member ID from the resource owner object and request all of their data using this library's REST API functions.


### Example

```PHP
$oath2 = new CongressusOAuth2(
    getenv('CLIENT_ID'),
    getenv('CLIENT_SECRET'), // KEEP THIS SECURE!
    'https://www.isaacnewton.utwente.nl/home', // Copied from browser
    ['openid']
);

$oath2->handleRequest();
$member = $oath2->getResourceOwner();
$memberId = $member->getId(); // Can be used to fetch MemberWithCustomFields
```