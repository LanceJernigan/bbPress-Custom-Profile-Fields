# bbPress Custom Profile Fields
A simple Wordpress plugin for adding custom profile fields to bbPress.

####Table of Contents
    1. Installation
    2. Setup
    3. Todo
    4. Adding Fields
    5. Formatting a Custom Field
    6. Saving and Retreiving Field Data
    7. Custom Templates


##Installation
    1. Download zip file from this repository
    2. Navigate to wp-admin > plugins
    3. Click 'Add New' at the top
    4. Click 'Upload Plugin'
    5. Upload the zip file you just downloaded
    6. Activate your plugin and you're all set
    
##Setup
Right now, there is no GUI for adding fields (just the underlying framework).
In order to use the plugin currently, navigate to the 'Advanced' section below

##Todo
1. Display saved data on Profile
    - ~~Function call for use in PHP templates~~
    - Shortcode to display text anywhere
    - GUI control for selecting locations defined by bbPress hooks
2. GUI control for adding fields
    - Figure out how to store data (custom post type vs options table)
    - Admin page for adding fields
3. Custom Edit Sections
    - This should be taken care of through the admin GUI
4. Settings
    - Will there even need to be settings?
        
##Adding Fields
In order to add a custom field, you will need to hook into bbCPF's filter for retrieving fields.

    `add_filter('bbCPF_get_fields', 'my_custom_fields');`
    
The function 'my_custom_fields' will receive an array of fields and will need to return an array of fields.  For further help understanding how Wordpress filters work, visit the Wordpress documentation.

**_Documentation for how to format your custom fields is in the next section_** 

##Formatting a Custom Field
        
The format for a custom field is as follows:
        
    [
        /*
         *  label - (string) - Label to display for field on edit page
         *
         *    accepted values - Any valid string
         */
        
          'label' => 'Phone', // Required
        
        /*
         *  name - (string) - Used to save value to user meta
         *
         *    accepted values - Any valid string containing only lowercase alphanumeric values
         *                      No spaces or capital letters
         */
        
          'name' => 'phone', // Required
        
        /*
         *  section - (string) - The section to display field within on edit page
         *
         *    accepted values - 'name', 'contact', 'about', 'account'
         *                       Support for custom sections is on the todo list - no idea when it will be supported
         */
      
          'section' => 'about', // Required
        
        /*
         *  priority - (string) - Before or after default fields in selected section
         *
         *    accepted values - 'before', 'after'
         */
        
          'priority' => 'before', // Defaults to 'after'
        
        /*
         *  default - (string, int) - Default value if no prior value has been stored for this field
         *
         *    accepted values - Any valid string or integer
         */
        
          'default' => '1234567890', // Not Required
    ]
    
##Saving and Retrieving Field Data

This plugin will take care of saving all entered data to the user's custom meta.  There are two options available for retrieving this data once it's saved.

**Option One:**

You can retrieve an array of all registered fields by using:

`bbCPF()->fields->fields`

**Option Two:**

You can retrieve any specific field's value by using get_user_meta().  The specific key for retrieving the user's meta will be the value assigned to the field's 'name' property preceeded by 'bbCPF_'.

`bbCPF_{field name property}`

##Custom Templates

The current version of the plugin merely displays all of the registered fields inside the user's profile.  This display can be changed by adding a custom template to your theme.

Simply add a folder to your theme named `bbpress` with a file named `user-profile.php` inside.  The structure for this file can be copied from `.../plugins/bbpress/templates/default/bbpress/user-profile.php` but the plugin file should not be edited directly.