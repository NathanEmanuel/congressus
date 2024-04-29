# Congressus API client

## Basics

All you need to use this library is an API token/key from Congressus. Use this token to instatiate a `Client`. You can either use `Client` itself (and extend it if needed), or you can subclass it.

`Client` is a subtype of `RawClient`, which has a method for each possible call to the Congressus API. You can use these methods either directly, or in `Client` methods to create more complicated requests.

## Making requests

The names of the methods in `RawClient` are the camelCase version of the names in [Congressus's API documentation](https://api.congressus.nl/v30/docs). For example, API call *List Group memberships* is done by `RawClient`'s method `listGroupMemberships()`.

The path parameters, query parameters and request body fields are passed as arguments to these methods. Their names in `RawClient` are always the same in in the [API documentation](https://api.congressus.nl/v30/docs).

`RawClient` is not an abstract class (that is why it is not named `BaseClient`), but it is still not *supposed* to be instatiated. `RawClient` is *only* supposed to be able to do the 'atomic' API calls. More complicated requests, the ones that consist of multiple calls, are supposed to be done by its subclasses (e.g. `Client`).

## Pages

API calls that return multiple objects are paginated. This library represents these pages in the `Page` class. This class contains the page metadata (e.g. page number) and the data. The data is an array of the data objects on this page. For example, calling `listEvents()` should return a `Page` object. Calling the `getData()` method on this object returns an array of `Event` object. The fields of this object can be retrieved using its relevant getter. For example, `getName()`. What fields each data object has can be found in the [API documentation](https://api.congressus.nl/v30/docs).

## Example

```PHP
// Instatiate an API client with a token stored in environment variable "congressus":
$client = new Client(getenv("congressus"));

// Request a listing of the next 5 events in order most to least soon:
$upcomingEvents = $client->listUpcomingEvents(5);

// Get the soonest event from the array:
$nextEvent = $upcomingEvents[0];

// Print the name of this event:
echo "The next event is: {$nextEvent->getName()}";
```