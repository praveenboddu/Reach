Reach
========================


How to set up OAuth authorization
--------------
```php app/console acme:oauth-server:client:create --redirect-uri="http://reach.local/" --grant-type="authorization_code" --grant-type="password" --grant-type="refresh_token" --grant-type="token" --grant-type="client_credentials"```

Where ```http://reach.local/``` should be replaced with the site address

Keep those public_id and secret somewhere private, since that’s the credentials for the client application to access your backend using oauth.

Check if it works: 
    Execute in browser: ```http://reach.local/app_dev.php/oauth/v2/token?client_id=&client_secret=&grant_type=client_credentials``` You have to copy/paste client id and secret to url parameters. 
    
If you see response like this one, then we did everything correctly: ```{"access_token":"YTk0YTVjZDY0YWI2ZmE0NjRiODQ4OWIyNjZkNjZlMTdiZGZlNmI3MDNjZGQwYTZkMDNiMjliNDg3NWYwZWI0MQ","expires_in":3600,"token_type":"bearer","scope":"user","refresh_token":"ZDU1MDY1OTc4NGNlNzQ5NWFiYTEzZTE1OGY5MWNjMmViYTBiNmRjOTNlY2ExNzAxNWRmZTM1NjI3ZDkwNDdjNQ"}```

Then, you can access API providing access_token as a parameter:

```http://reach.local/v1/beaconevents?access_token=YTk0YTVjZDY0YWI2ZmE0NjRiODQ4OWIyNjZkNjZlMTdiZGZlNmI3MDNjZGQwYTZkMDNiMjliNDg3NWYwZWI0MQ```
