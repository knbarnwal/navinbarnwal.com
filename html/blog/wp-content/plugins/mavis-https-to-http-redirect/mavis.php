<?php
/*
Plugin Name: Mavis HTTPS to HTTP Redirection
Plugin URI: http://www.phkcorp.com?do=wordpress
Description: Forcing the redirect to non-secure session when secured session is active
Version: 1.4.2
Author: PHK Corporation
Author URI: http://www.phkcorp.com
*/

/*  Copyright 2009  PHK Corporation  (email : phkcorp2005@gmail.com)

    This program is free software; you can redistribute it and/or modify
    it under the terms of the GNU General Public License as published by
    the Free Software Foundation; either version 2 of the License, or
    (at your option) any later version.

    This program is distributed in the hope that it will be useful,
    but WITHOUT ANY WARRANTY; without even the implied warranty of
    MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
    GNU General Public License for more details.

    You should have received a copy of the GNU General Public License
    along with this program; if not, write to the Free Software
    Foundation, Inc., 51 Franklin St, Fifth Floor, Boston, MA  02110-1301  USA
*/

/*
Table definition:

-- --------------------------------------------------------

--
-- Table structure for table `wp_fxclub_settings`
--

CREATE TABLE IF NOT EXISTS `wp_mavis_settings` (
  `page` varchar(255) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------
*/

function addMavisSettingsTable ()
{
	global $wpdb;

	if (is_admin()) {

		$query = "CREATE TABLE IF NOT EXISTS `wp_mavis_settings` (
  				`page` varchar(255) NOT NULL)
				ENGINE=MyISAM DEFAULT CHARSET=latin1;";

		$wpdb->query($query);
	} // endif of is_admin()
}

//// Add page to options menu.
function addMavisToManagementPage()
{
    // Add a new submenu under Options:
    add_options_page('Mavis HTTPS/HTTP Redirection', 'Mavis HTTPS/HTTP Redirection', 8, 'mavis', 'displayMavisManagementPage');
}

// Display the admin page.
function displayMavisManagementPage()
{
	global $wpdb;

	if (is_admin()) {
		// Create the tables, if they do not exist?
		addMavisSettingsTable();

		if (isset($_POST['mavis_update']))
		{
			//check_admin_referer();

			$securedPage = $_POST['secured_page_tag'];
			if ($securedPage == '') $securedPage = 'checkout,confirm-order';

			$wpdb->query("TRUNCATE TABLE wp_mavis_settings");
			$wpdb->query("insert into wp_mavis_settings (page) values ('".$securedPage."')");

			// echo message updated
			echo "<div class='updated fade'><p>Mavis HTTPS-to-HTTP Redirection settings have been updated.</p></div>";
		}

		$t = $wpdb->get_col("select page from wp_mavis_settings");
		$securedPage = $t[0];

?>
		<div class="wrap">
			<h2>Mavis HTTPS-to-HTTP Redirection</h2>

			<form method="post">
				<fieldset class='options'>
					<legend><h2><u>Settings</u></h2></legend>
					<table class="editform" cellspacing="2" cellpadding="5" width="100%">
						<tr>
							<th width="30%" valign="top" style="padding-top: 10px;">
								Secured Page Permalink tag:
							</th>
							<td>
								<input type='text' size='30' maxlength='80' name='secured_page_tag' id='secured_page_tag' value='<?php echo $securedPage;?>' />
								<br>Used by PHP preg_match function.<br>
								<i>Separate multiple page names with comma's</i>
							</td>
						</tr>
						<tr>
							<td colspan="2">
							<p class="submit"><input type='submit' name='mavis_update' value='Update' /></p>
							</td>
						</tr>
					</table>
				</fieldset>
			</form>
				<fieldset class='options'>
					<legend><h2><u>Tips &amp; Techniques</u></h2></legend>
								<p>The secured page entry is the permalink tag [a unique identified] of your
secured page. That is, this page(s) containing this tag within the URL, will be the only page that will retain
it's secured page status.</p>
<p>Any other page that has the secured session reference within the URL (https:) will then be redirected to the
it's unsecured (http:) counterpart, in this case the same page without the secured session.</p>
				</fieldset>

				<fieldset class='options'>
					<legend><h2><u>About the Architecture</u></h2></legend>
<p>This plugin hooks the 'init' Wordpress Plugin API to examine the headers before they are sent to the browser, and
uses the PHP regular expression matching function '<a href="http://www.php.net/manual/en/function.preg-match.php" target="_blank">preg_match</a>' to check for the existence of the above tag in the URL.
<p>If the tag is NOT found, a new URL is created prepending HTTP: and then the page reloaded with the PHP header() function.</p>
<p>If the tag does exist in the URL, then NO redirection occurs.</p>
				</fieldset>

				<fieldset class='options'>
					<legend><h2><u>Wordpress Development</u></h2></legend>
<p><a href="http://www.phkcorp.com" target="_blank">PHK Corporation</a> is available for custom Wordpress development which includes development of new plugins, modification
of existing plugins, migration of HTML/PSD/Smarty themes to wordpress-compliant <b>seamless</b> themes.</p>
<p>Please email at <a href="mailto:phkcorp2005@gmail.com">phkcorp2005@gmail.com</a> with your programming requirements.</p>
				</fieldset>

                        <fieldset class="options">
                            <legend><h2><u>Support</u></h2></legend>
                            <p>Support is provided from <a href="https://github.com/patrickingle/mavis-https-to-http-redirect/issues" target="_blank">github.com</a> (opens in new window)</p>
                            <p>You must have a free github.com account to post issue requests.</p>
                        </fieldset>
                        
				<fieldset class='options'>
					<legend><h2><u>Plugin PHP Code</u></h2></legend>
<p>Here is the actual plugin code that provides the redirection.</p>
<p>
<code>
global $wpdb;<br>
<br>
$match=0;<br>
<br>
if ($_SERVER['HTTPS'] == "on") {<br>
&nbsp;&nbsp;$url = "http://". $_SERVER['SERVER_NAME'] . $_SERVER['REQUEST_URI'];<br>
&nbsp;&nbsp;$t = $wpdb->get_col("select page from wp_mavis_settings"); <br>
&nbsp;&nbsp;$ay = explode(",",$t[0]);<br>
&nbsp;&nbsp;for ($i=0; $i<count($ay); $i++) {<br>
&nbsp;&nbsp;&nbsp;$sp = "/".$ay[$i]."/";<br>
&nbsp;&nbsp;&nbsp;if (preg_match($sp, $url) == true) {<br>
&nbsp;&nbsp;&nbsp;&nbsp;$match = 1;<br>
&nbsp;&nbsp;&nbsp;}<br>
&nbsp;&nbsp;}<br>
<br>
&nbsp;&nbsp;if ($match == 0) {<br>
&nbsp;&nbsp;&nbsp;header("Location: $url");<br>
&nbsp;&nbsp;&nbsp;exit;<br>
&nbsp;&nbsp;}<br>
} else {<br>
&nbsp;&nbsp;$url = "https://". $_SERVER['SERVER_NAME'] . $_SERVER['REQUEST_URI'];<br>
&nbsp;&nbsp;$t = $wpdb->get_col("select page from wp_mavis_settings"); <br>
&nbsp;&nbsp;$ay = explode(",",$t[0]);<br>
&nbsp;&nbsp;for ($i=0; $i<count($ay); $i++) {<br>
&nbsp;&nbsp;&nbsp;$sp = "/".$ay[$i]."/";<br>
&nbsp;&nbsp;&nbsp;if (preg_match($sp, $url) == true) {<br>
&nbsp;&nbsp;&nbsp;&nbsp;$match = 1;<br>
&nbsp;&nbsp;&nbsp;}<br>
&nbsp;&nbsp;}<br>
<br>
&nbsp;&nbsp;if ($match == 1) {<br><br>
&nbsp;&nbsp;&nbsp;$url = "https://". $_SERVER['SERVER_NAME'] . $_SERVER['REQUEST_URI'];<br>
&nbsp;&nbsp;&nbsp;header("Location: $url");<br>
&nbsp;&nbsp;&nbsp;exit;<br>
&nbsp;&nbsp;}<br>
}<br>
</code>
</p>
				</fieldset>
<?php
	} // endif of is_admin()
}

function mavis_redirect() {
	global $wpdb;

	if (!is_admin()) {
		$match=0;

		if ($_SERVER['HTTPS'] == "on") {
    		$url = "http://". $_SERVER['SERVER_NAME'] . $_SERVER['REQUEST_URI'];
			$t = $wpdb->get_col("select page from wp_mavis_settings");
			$ay = explode(",",$t[0]);
			for ($i=0; $i<count($ay); $i++) {
				$sp = "/".$ay[$i]."/";
				if (preg_match($sp, $url) == true) {
				   $match = 1;
				}
			}

			if ($match == 0) {
				header("Location: $url");
				exit;
			}


			//Original Code:
			//-------------
			//$sp = "/".$t[0]."/";
			//if (preg_match($sp, $url) == false) {
			//	header("Location: $url");
			//	exit;
			//}

		} else {
    		$url = "https://". $_SERVER['SERVER_NAME'] . $_SERVER['REQUEST_URI'];
			$t = $wpdb->get_col("select page from wp_mavis_settings");
			$ay = explode(",",$t[0]);
			for ($i=0; $i<count($ay); $i++) {
				$sp = "/".$ay[$i]."/";
				if (preg_match($sp, $url) == true) {
					$match = 1;
				}
			}

			if ($match == 1) {
   				$url = "https://". $_SERVER['SERVER_NAME'] . $_SERVER['REQUEST_URI'];
				header("Location: $url");
				exit;
			}
		}
	} // endif of !is_admin()
}

//
// Hooks
//

add_action( 'init', 'mavis_redirect', 0 );
add_action('admin_menu', 'addMavisToManagementPage');

?>