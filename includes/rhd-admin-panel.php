<?php
/**
 * Theme Options Admin Panel
 *
 * Sample admin settings page
 *
 * @package WordPress
 * @subpackage rhd
 */


class RHD_Settings
{
	/**
	* Holds the values to be used in the fields callbacks
	*/
	private $options;

	/**
	* Start up
	*/
	public function __construct()
	{
		add_action( 'admin_menu', array( $this, 'rhd_admin_menu' ) );
		add_action( 'admin_init', array( $this, 'rhd_register_settings' ) );
	}

	/**
	* Add options page
	*/
	public function rhd_admin_menu()
	{
		add_menu_page(
			'RHD General Settings',
			'Uprising Options',
			'manage_options',
			'rhd_settings',
			array( $this, 'create_admin_page' ),
			'dashicons-smiley',
			8
		);
	}

	/**
	* Options page callback
	*/
	public function create_admin_page()
	{
		// Set class property
		$this->options = get_option( 'rhd_theme_settings' );
	?>
	<div class="wrap">
		<h2>RHD Sample Settings</h2>
		<form method="post" action="options.php">
			<?php
				// This prints out all hidden setting fields
				settings_fields( 'rhd_theme_settings' );
				do_settings_sections( 'rhd-settings-admin' );
				submit_button();
			?>
		</form>
	</div>
	<?php
	}

	/**
	* Register and add settings
	*/
	public function rhd_register_settings()
	{
		register_setting(
			'rhd_theme_settings', // Option group
			'rhd_theme_settings', // Option name
			array( $this, 'sanitize' ) // Sanitize
		);

		add_settings_section(
			'rhd_donors_section',
			'The Uprising Superhero Lists',
			array( $this, 'print_donors_section_info' ),
			'rhd-settings-admin'
		);

		add_settings_section(
			'rhd_social_section', // ID
			'Social Links', // Title
			array( $this, 'print_social_section_info' ), // Callback
			'rhd-settings-admin' // Page
		);

		add_settings_field(
			'rhd_youtube_url', // ID
			'YouTube URL: ', // Title
			array( $this, 'youtube_url_cb' ), // Callback
			'rhd-settings-admin', // Page
			'rhd_social_section' // Section
		);

		add_settings_field(
			'rhd_twitter_url', // ID
			'Twitter URL: ', // Title
			array( $this, 'twitter_url_cb' ), // Callback
			'rhd-settings-admin', // Page
			'rhd_social_section' // Section
		);

		add_settings_field(
			'rhd_facebook_url', // ID
			'Facebook URL: ', // Title
			array( $this, 'facebook_url_cb' ), // Callback
			'rhd-settings-admin', // Page
			'rhd_social_section' // Section
		);

		add_settings_field(
			'rhd_leadership_gifts', // ID
			'Leadership Gifts', // Title
			array( $this, 'leadership_gifts_cb' ), // Callback
			'rhd-settings-admin', // Page
			'rhd_donors_section' // Section
		);

		add_settings_field(
			'rhd_recurring_donors', // ID
			'Recurring Donors', // Title
			array( $this, 'recurring_donors_cb' ), // Callback
			'rhd-settings-admin', // Page
			'rhd_donors_section' // Section
		);

		add_settings_field(
			'rhd_one_time_donors', // ID
			'One-Time Donors', // Title
			array( $this, 'one_time_donors_cb' ), // Callback
			'rhd-settings-admin', // Page
			'rhd_donors_section' // Section
		);

		add_settings_field(
			'rhd_volunteers', // ID
			'Volunteers', // Title
			array( $this, 'volunteers_cb' ), // Callback
			'rhd-settings-admin', // Page
			'rhd_donors_section' // Section
		);
		
		add_settings_field(
			'rhd_levelup_donors', // ID
			'LevelUp Donors', // Title
			array( $this, 'levelup_cb' ), // Callback
			'rhd-settings-admin', // Page
			'rhd_donors_section' // Section
		);
		
		add_settings_field(
			'rhd_swarm_donors', // ID
			'SWARM Donors', // Title
			array( $this, 'swarm_cb' ), // Callback
			'rhd-settings-admin', // Page
			'rhd_donors_section' // Section
		);
	}

	/**
	* Sanitize each setting field as needed
	*
	* @param array $input Contains all settings fields as array keys
	*/
	public function sanitize( $input )
	{
		$new_input = array();

		if( isset( $input['rhd_youtube_url'] ) )
			$new_input['rhd_youtube_url'] = sanitize_text_field( $input['rhd_youtube_url'] );

		if( isset( $input['rhd_twitter_url'] ) )
			$new_input['rhd_twitter_url'] = sanitize_text_field( $input['rhd_twitter_url'] );

		if( isset( $input['rhd_facebook_url'] ) )
			$new_input['rhd_facebook_url'] = sanitize_text_field( $input['rhd_facebook_url'] );

		if( isset( $input['rhd_leadership_gifts'] ) )
			$new_input['rhd_leadership_gifts'] = $input['rhd_leadership_gifts'];

		if( isset( $input['rhd_recurring_donors'] ) )
			$new_input['rhd_recurring_donors'] = $input['rhd_recurring_donors'];

		if( isset( $input['rhd_one_time_donors'] ) )
			$new_input['rhd_one_time_donors'] = $input['rhd_one_time_donors'];

		if( isset( $input['rhd_volunteers'] ) )
			$new_input['rhd_volunteers'] = $input['rhd_volunteers'];
		
		if( isset( $input['rhd_levelup_donors'] ) )
			$new_input['rhd_levelup_donors'] = $input['rhd_levelup_donors'];
		
		if( isset( $input['rhd_swarm_donors'] ) )
			$new_input['rhd_swarm_donors'] = $input['rhd_swarm_donors'];

		return $new_input;
	}

	/**
	* Print the Section text
	*/
	public function print_social_section_info()
	{
		print 'Enter links to your social networks. Full URLs only.';
	}

	public function print_donors_section_info()
	{
		print 'Enter one name per line.';
	}

	/**
	* Input callbacks
	*/
	public function youtube_url_cb( $args )
	{
		printf(
			'<input type="url" id="rhd_youtube_url" name="rhd_theme_settings[rhd_youtube_url]" value="%s" />',
			isset( $this->options['rhd_youtube_url'] ) ? esc_attr( $this->options['rhd_youtube_url']) : ''
		);
	}

	public function twitter_url_cb( $args )
	{
		printf(
			'<input type="url" id="rhd_twitter_url" name="rhd_theme_settings[rhd_twitter_url]" value="%s" />',
			isset( $this->options['rhd_twitter_url'] ) ? esc_attr( $this->options['rhd_twitter_url']) : ''
		);
	}

	public function facebook_url_cb( $args )
	{
		printf(
			'<input type="url" id="rhd_facebook_url" name="rhd_theme_settings[rhd_facebook_url]" value="%s" />',
			isset( $this->options['rhd_facebook_url'] ) ? esc_attr( $this->options['rhd_facebook_url']) : ''
		);
	}

	public function leadership_gifts_cb( $args )
	{
		echo '<textarea id="rhd_leadership_gifts" name="rhd_theme_settings[rhd_leadership_gifts]" rows="10" cols="40">'
			. esc_textarea( $this->options['rhd_leadership_gifts'] )
			. '</textarea>';
	}

	public function recurring_donors_cb( $args )
	{
		echo '<textarea id="rhd_recurring_donors" name="rhd_theme_settings[rhd_recurring_donors]" rows="10" cols="40">'
			. esc_textarea( $this->options['rhd_recurring_donors'] )
			. '</textarea>';
	}

	public function one_time_donors_cb( $args )
	{
		echo '<textarea id="rhd_one_time_donors" name="rhd_theme_settings[rhd_one_time_donors]" rows="10" cols="40">'
			. esc_textarea( $this->options['rhd_one_time_donors'] )
			. '</textarea>';
	}

	public function volunteers_cb( $args )
	{
		echo '<textarea id="rhd_volunteers" name="rhd_theme_settings[rhd_volunteers]" rows="10" cols="40">'
			. esc_textarea( $this->options['rhd_volunteers'] )
			. '</textarea>';
	}
	
	public function levelup_cb( $args )
	{
		echo '<textarea id="rhd_levelup_donors" name="rhd_theme_settings[rhd_levelup_donors]" rows="10" cols="40">'
			. esc_textarea( $this->options['rhd_levelup_donors'] )
			. '</textarea>';
	}
	
	public function swarm_cb( $args )
	{
		echo '<textarea id="rhd_swarm_donors" name="rhd_theme_settings[rhd_swarm_donors]" rows="10" cols="40">'
			. esc_textarea( $this->options['rhd_swarm_donors'] )
			. '</textarea>';
	}
}

if( is_admin() )
	$rhd_settings_page = new RHD_Settings();