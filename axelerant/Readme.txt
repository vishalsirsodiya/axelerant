# Create a custom Drupal 8 module

## Background Information

When logged in as the administrator, the "Site Information" form can be found at the path /admin/config/system/site-information.

## Requirements

This module needs to alter the existing Drupal "Site Information" form. Specifics:

* A new form text field named "Site API Key" needs to be added to the "Site Information" form with the default value of ?No API Key yet?.
* When this form is submitted, the value that the user entered for this field should be saved as the system variable named "siteapikey".
* A Drupal message should inform the user that the Site API Key has been saved with that value.
* When this form is visited after the "Site API Key" is saved, the field should be populated with the correct value.
* The text of the "Save configuration" button should change to "Update Configuration".
* This module also provides a URL that responds with a JSON representation of a given node with the content type "page" only if the previously submitted API Key and a node id (nid) of an appropriate node are present, otherwise it will respond with "access denied".

## Example URL

http://localhost/page_json/FOOBAR12345/17

## Test Evaluation

* Meeting above requirements
* Utilising Drupal-specific solutions (hooks, APIs, etc.))
* Readability of code
* Clear, concise commenting
* List of resources used if any (Internet sites, books, previous knowledge) Total time to complete task

## Test Submission

/************************* Refer below links for this module***************************************************/

form_alter :-
https://drupal.stackexchange.com/questions/156703/how-can-i-add-a-textbox-in-site-information-configuration


Set Value :-
https://www.drupal.org/files/issues/coffee-config_immutable-2424807-1.patch

+    \Drupal::configFactory()->getEditable('coffee.configuration')
     ->set('coffee_menus', $form_state->getValue('coffee_menus'))
     ->save();


Tutorial
https://docs.acquia.com/article/lesson-62-loading-entities
https://docs.acquia.com/articles/building-drupal-8-modules

Json :-
https://www.drupal8.ovh/en/tutoriels/32/return-json-array-as-resut-provide-json-interface


Delete configuration :-
https://www.drupal.org/forum/support/module-development-and-code-questions/2015-09-09/how-to-remove-mymodule-configurations#comment-10820888
// Deleting the views while uninstalling.
 \Drupal::configFactory()->getEditable('views.view.scheduled_content')->delete();

https://drupal.stackexchange.com/questions/214331/how-to-delete-a-particular-variable-from-a-configuration-created-by-a-custom-mod
Drupal::configFactory()->getEditable('abc_settings')->clear($entity->id() . '_options')->save();


Finally I have found below link :-
https://github.com/taherj/siteapi
