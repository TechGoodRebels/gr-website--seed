=== Clean Filenames ===
Contributors: samuelaguilera
Tags: utf-8, international characters, filename, sanitize, upload, hebrew, cyrillic
Requires at least: 4.9
Requires PHP: 5.6
Tested up to: 5.9.3
Stable tag: 1.2.3
License: GPL2

Removes or replace international or special characters that can make your filenames not compliant with some servers or services.     

== Description ==

= Features =

= It takes the following steps for getting cleaner and safe to use filenames =

* Removes or replace special/international characters that can make your filenames not compliant with servers that don't have support for international locales and filenames, or third-party services. (e.g. 'España.png' will become 'Espana.png', 'prüfen' will become 'prufen').
* Replaces any '+' in the filename with '-' (e.g. 'A+nice+picture.png' will become 'A-nice-picture.png').
* Replaces any '.' character before the one used for file extension with '-'(e.g. 'A.nice.picture.png' will become 'A-nice-picture.png').
* After running all character replacement filters, a filter is applied to ensure that the filename only contains letters, numbers, underscores, dashes, and dots. Any other character will be removed from the filename.
* And finally all letters in the filename are set to lowercase to prevent issues with case insensitive systems. 

This reduces problems with some servers, services, plugins... That may have problems handling filenames with special or international characters.

The plugin does its job during file upload process, so it'll change only filenames for files being *uploaded after plugin activation*.

It supports a large number of international characters, including but not only, characters from belarusian, cyrillic alphabet, czech, german, hebrew, hungarian, russian, polish, spanish, ukrainian, and some other special characters (e.g. №, @, $, etc.).

If you have any questions or need support, please check FAQ for additional information before asking.

= Requirements =

* WordPress 3.0 or higher
    	
== Installation ==

* Simply install from your WP dashboard or upload it using FTP. No configuration needed.

== Frequently Asked Questions ==

= Will change filenames for files uploaded before activating the plugin? =

No. The plugin does its job just after a file is uploaded and before it's saved to your server, so it'll change only filenames for files being uploaded after plugin activation.

= I would like to do additional changes to the filename, is that possible? =

Since 1.2.2 version, you can use the scf_friendly_filename filter to perform additional changes to the filename after all the changes done by the plugin.

Example:

`add_filter ('scf_friendly_filename', 'first_character_uppercase', 10, 1);
function first_character_uppercase ( $friendly_filename ){
	// Make sure first character is always uppercase. 
	$friendly_filename = ucfirst( $friendly_filename );      
	return $friendly_filename;
}`

= My language is not listed in the plugin description, will it still replace my language characters? =

Probably. Simply give it a try and see how it goes. This plugin doesn't store anything in your site or anywhere, and makes no permanent changes to the site, disabling the plugin is enough to go back to WP default filename handling. Therefore trying and uninstalling the plugin if it doesn't fit your needs it's a completely safe and clean task.
                                  
== Changelog ==

= 1.2.3 =

* Added additional support for files uploaded using single upload Gravity Forms fields. Thanks to my buddy David Smith! :)

= 1.2.2 =

* Added filter scf_friendly_filename to allow additional changes to the filename before returning it to WP. 
* Minor changes to make code 100% compliant with WordPress Coding Standards. This doesn't means any change in the plugin functionality, it's just code cosmetic.

= 1.2 =

* Added remove_accents() WP core function as first step instead of previous own custom replacement array for accents.

= 1.1.1 =

* Minor coding standards improvements.

= 1.1 =

* Fixed bug introduced in 1.0.9. Thanks to Edu from etmsoft for reporting it.

= 1.0.9 =

* Added: All letters in the filename are set to lowercase to prevent issues with case insensitive systems.

= 1.0.8 =

* Added support for Hebrew (letters will be replaced, puntuation and ligatures will be removed). e.g. 'א' will be replaced by 'a', and 'װ' will be removed from the filename.
* After running all character replacement filters, a last filter is applied to ensure that the filename only contains letters, numbers, underscores, dashes, and dots. Any other character will be removed from the filename.

= 1.0.6 =

* Plugin name changed from Sanitize Spanish Filenames to Clean Filenames to better reflect actual purpose of the plugin (originally it was created only for spanish characters).
* Changed readme content and language.

= 1.0.5 =

* Added: Replaces any '.' character in the filename except for last one (for file extension) with '-'.

= 1.0.4 =

* Added: Replaces any '+' in the filename with '-'.

= 1.0.3 =

* Many more characters and some symbols added. Cleaning not only spanish characters but from other languages too.

= 1.0.2 =

* Fixed a little bug that causes 'º' replaced by 'a' instead of 'o', and same problem for 'ª'.

= 1.0.1 =

* Added characters ü Ü º ª that will be replaced with u U o a

= 1.0 =

* Initial release.

== Upgrade Notice ==

= 1.0.5 =

* Added: Replaces any '.' character in the filename except for last one (for file extension) with '-'.

= 1.0.4 =

* Added: Replaces any '+' in the filename with '-'.

= 1.0.3 =
Recommended upgrade.


