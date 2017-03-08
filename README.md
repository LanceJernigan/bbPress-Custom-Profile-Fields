# bbPress Custom Profile Fields
A simple Wordpress plugin that adds a GUI for adding fields to a bbPress profile.

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
        - Function call for use in PHP templates
        - Shortcode to display text anywhere
        - GUI control for selecting locations defined by bbPress hooks
    2. GUI control for adding fields
        - Figure out how to store data (custom post type vs options table)
        - Admin page for adding fields
    3. Custom Edit Sections
        - This should be taken care of through the admin GUI
    4. Settings
        - Will there even need to be settings?
        
##Advanced
So, you want to be able to use this extremely alpha plugin right now?  Follow the steps below.

**_This will not be the desired method in the future and might result in needing to re-setup your fields during a later release._**

    1. add_filter('bbPress_get_fields', 'my_custom_fields');
        - You will need to hook into the filter bbCPF is using to get the initial fields
        - This can be done in your theme's functions.php, a custom plugin, etc.
        
    2. The called function (my_custom_fields in this example) will be given an array of fields and will need to return an array of fields
        - The format for a custom field is as follows:
        
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
        
    3. The plugin will take care of saving the data to the user
        - In order to use the data (in this alpha version) would be to simply call get_user_meta() with the correct parameters
        - The $key to pass to get_user_meta() should be 'bbCPF_{whatever your field's 'name' property is}'
        
##Bonus
Some useful hooks for displaying the saved data are as follows:

**Profile** - bbPress default page when clicking on a user's name

    1. 'bbp_template_before_user_profile' - Before the default fields on the User's profile
    2. 'bbp_template_after_user_profile' - After the default fields on the User's profile
    
**User Details** - bbPress sidebar on user profile (avatar and user navigation)

    1. 'bbp_template_before_user_details' - Above the user's avatar
    2. 'bbp_template_after_user_details' - Below avatar and navigation (bottom of sidebar)