#IP Consumer Auth
================

Drupal 8 custom Authentication Provider using an IP Consumer While List

This idea is enable anonymous user access to Drupal 8 REST Resources using their IP address as validation method

This module enable an UI to add a whiles list of IP consumers.

#Usage

Using the contrib module <a href="https://www.drupal.org/project/restui/git-instructions" target="_blank">Rest UI</a> (I recommend to use the git version until Drupal 8 get a first release) you can enable REST Resources using the Authentication Provier **ip_consumer_auth as you can see in the following image.

![REST UI](https://github.com/enzolutions/ip_consumer_auth/blob/master/images/custom_authentication_provider.png "REST UI")

Remember enable the specific permission for REST Resource to anonymous user as you can see in the following image.

![REST Resource permission](https://github.com/enzolutions/ip_consumer_auth/blob/master/images/rest_anonymous_permission.png "REST Resource permission")

If you are interested in create your own Drupal 8 Authentication Provider you can read the blog entry [How to create an Authentication Provider in Drupal 8](http://enzolutions.com/articles/2014/12/28/how-to-create-an-authentication-provider-in-drupal-8)
