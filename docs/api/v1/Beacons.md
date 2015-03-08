# Beacons API Documentation
---

## Table of Contents
---

1. [GET](#get)

2. [GETC](#GetCollection)

3. [POST](#post)

4. [DELETE](#Delete)

5. [PUT](#Put)

6. [HTTP Response Status Codes](#response_status_codes)

## <a name="get"></a>Get

#### GET /v1/beacons/{id}

Retrieve information about a beacon

#### Parameters

id Required a unique beacon id from beacons table

#### Example GET Request

````
http://pboddu-dev.buoy.co/v1/beacons/{id}
````

#### Example GET Response

````
# HTTP 200 OK
{
    "id": 5,
    "beaconId": "eoiuqlwehrjqkjehwr",
    "clientId": 1
}
````


## <a name="post"></a>Post

#### POST /v1/beacons?beaconId=BEACON_ID

Create an entry for a beacon

#### Parameters

beaconId Required the beacon UUID

#### Example POST Request

````
curl -XPOST --data "beaconId=lkjadljadfadf" http://pboddu-dev.buoy.co/v1/beacons
````

#### Example POST Response

````
# HTTP 200 OK
6
````

## <a name="response_status_codes"></a>HTTP Response Status Codes
---

**200** - "OK" - the request has succeded.

**400*** - "Bad Request" - the request could not be understood by the server, probably malformed syntax.

**403** - "Forbidden" - No access.

**404*** - "Not Found" - the request resource is not found.

**500** - "Internal Server Error" - Unexpected error on server.



