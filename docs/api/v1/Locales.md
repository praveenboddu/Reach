# Locales API Documentation
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

#### GET /v1/locales/{id}

Retrieve information about a locale

#### Parameters

id Required a unique locale id from locales table

#### Example GET Request

````
http://pboddu-dev.buoy.co/v1/locales/{id}
````

#### Example GET Response

````
# HTTP 200 OK
{
    "id": 1,
    "name": "buoy_jerseycity",
    "location": "Grove Street, Jersey Ciyt",
    "clientId": 1,
    "created": "2015-03-08 11:47:37"
}
````


## <a name="post"></a>Post

#### POST /v1/locales?name=NAME&location=LOCATION

Create an entry for a locale

#### Parameters

name Required Name of the locale

location Required Address of the locale

#### Example POST Request

````
curl -XPOST --data "name=buoy_jerseycity&location=Grove+Street%2C+Jersey+Ciyt" http://pboddu-dev.buoy.co/v1/locales
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



