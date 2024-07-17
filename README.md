# Congressus API client


## Basics

All you need to use this library is an API token/key from Congressus. Use this token to instatiate a `Client`. You can either use `Client` itself or you can subclass it.

`Client` has a method for each possible call to the Congressus API. You can use these methods either directly, or in methods of a subclass to create more complicated requests. The latter is how this library is the most powerful, because you can make a class that completely suits your needs.


## Making requests

The names of the methods in `Client` are the camelCase version of the names in [Congressus's API documentation](https://api.congressus.nl/v30/docs). For example, API call *List Group memberships* is done by `Client`'s method `listGroupMemberships()`.

The path parameters, query parameters and request body fields are passed as arguments to these methods. Their names in `Client` are always the same as in the [API documentation](https://api.congressus.nl/v30/docs).


## Example

```PHP
// Instatiate an API client with a token stored in environment variable "MyCongressusToken":
$client = new Client(getenv("MyCongressusToken"));

// Request a listing of the next 5 events in order of most to least soon:
$upcomingEvents = $client->listEvents(limit: 5, order: "start:asc");

// Print the events
echo "The next 5 events are:" . PHP_EOL
foreach ($upcomingEvents as $event) {
    echo $nextEvent->getName() . PHP_EOL;
}
```