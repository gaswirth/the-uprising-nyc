<?php
/**
 * Roundhouse Designs
 *
 * Custom Search Form
 *
 * @package WordPress
 * @subpackage rhd
 */
?>

<form role="search" method="get" class="search-form" action="<?php echo home_url(); ?>">
    <input type="search" class="search-field" value="" placeholder="I'M LOOKING FOR &hellip;" name="s" title="Search for:" />
    <input type="submit" class="search-submit" value="Search" />
</form>