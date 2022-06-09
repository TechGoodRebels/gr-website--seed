<?php
/**
 * Plugin Name: Clean Filenames
 * Description: Removes or replace special characters that can make your filenames not compliant with some servers or services.
 * Version: 1.2.3
 * Author: Samuel Aguilera
 * Author URI: http://www.samuelaguilera.com
 * License: GPL2
 *
 * @package Clean Filenames
 */

/*
	This program is free software: you can redistribute it and/or modify
	it under the terms of the GNU General Public License version 3 as published by
	the Free Software Foundation.

	This program is distributed in the hope that it will be useful,
	but WITHOUT ANY WARRANTY; without even the implied warranty of
	MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
	GNU General Public License for more details.

	You should have received a copy of the GNU General Public License
*/

add_filter( 'sanitize_file_name', 'sar_clean_filenames', 10, 1 );

/**
 * Filter current filename to replace or remove problematic characters.
 *
 * @param string $filename Current filename.
 */
function sar_clean_filenames( $filename ) {

		$original_chars = array(
			// Cyrillic alphabet.
			'/А/',
			'/Б/',
			'/В/',
			'/Г/',
			'/Д/',
			'/Е/',
			'/Ж/',
			'/З/',
			'/И/',
			'/Й/',
			'/К/',
			'/Л/',
			'/М/',
			'/Н/',
			'/О/',
			'/П/',
			'/Р/',
			'/С/',
			'/Т/',
			'/У/',
			'/Ф/',
			'/Х/',
			'/Ц/',
			'/Ч/',
			'/Ш/',
			'/Щ/',
			'/Ь/',
			'/Ю/',
			'/Я/',
			'/а/',
			'/б/',
			'/в/',
			'/г/',
			'/д/',
			'/е/',
			'/ж/',
			'/з/',
			'/и/',
			'/й/',
			'/к/',
			'/л/',
			'/м/',
			'/н/',
			'/о/',
			'/п/',
			'/р/',
			'/с/',
			'/т/',
			'/у/',
			'/ф/',
			'/х/',
			'/ц/',
			'/ч/',
			'/ш/',
			'/щ/',
			'/ь/',
			'/ю/',
			'/я/',

			// Ukrainian.
			'/Ґ/',
			'/ґ/',
			'/Є/',
			'/є/',
			'/І/',
			'/і/',
			'/Ї/',
			'/ї/',

			// Russian.
			'/Ё/',
			'/ё/',
			'/Ы/',
			'/ы/',
			'/Ъ/',
			'/ъ/',
			'/Э/',
			'/э/',

			// Belarusian.
			'/Ў/',
			'/ў/',

			// Hebrew.
			'/א/',
			'/ב/',
			'/ג/',
			'/ד/',
			'/ה/',
			'/ו/',
			'/ז/',
			'/ח/',
			'/ט/',
			'/י/',
			'/ך/',
			'/כ/',
			'/ל/',
			'/ם/',
			'/מ/',
			'/ן/',
			'/נ/',
			'/ס/',
			'/ע/',
			'/ף/',
			'/פ/',
			'/ץ/',
			'/צ/',
			'/ק/',
			'/ר/',
			'/ש/',
			'/ת/',

			// Other.
			'/×/',
			'/№/',
			'/“/',
			'/”/',
			'/«/',
			'/»/',
			'/„/',
			'/@/',
			'/%/',
			'/‘/',
			'/’/',
			'/`/',
			'/´/',
			'/[\s\+]/',
			'/\.(?=.*\.)/',
		);

		$sanitized_chars = array(
			// Cyrillic alphabet.
			'a',
			'b',
			'v',
			'h',
			'd',
			'e',
			'zh',
			'z',
			'y',
			'j',
			'k',
			'l',
			'm',
			'n',
			'o',
			'p',
			'r',
			's',
			't',
			'u',
			'f',
			'h',
			'c',
			'ch',
			'sh',
			'shh',
			'',
			'ju',
			'ja',
			'a',
			'b',
			'v',
			'h',
			'd',
			'e',
			'zh',
			'z',
			'y',
			'j',
			'k',
			'l',
			'm',
			'n',
			'o',
			'p',
			'r',
			's',
			't',
			'u',
			'f',
			'h',
			'c',
			'ch',
			'sh',
			'sch',
			'',
			'ju',
			'ja',

			// Ukrainian.
			'g',
			'g',
			'je',
			'je',
			'i',
			'i',
			'ji',
			'ji',

			// Russian.
			'jo',
			'jo',
			'y',
			'y',
			'',
			'',
			'ye',
			'ye',

			// Belorussian.
			'u',
			'u',

			// Hebrew symbols don't have an equivalent one latin letter, replacing for first letter of each symbol to prevent too large filenames.
			// 'alef','bet','gimel','dalet','he','vat','zayin','het','tet','yod','final-kaf','kaf','lamed','final-mem','mem','final-num','num','samekh','ayin','final-pe','pe','final-tsadi','tsadi','qof','resh','shin','tav'.
			'a',
			'b',
			'g',
			'd',
			'h',
			'v',
			'z',
			'h',
			't',
			'y',
			'f',
			'k',
			'l',
			'f',
			'm',
			'f',
			'n',
			's',
			'a',
			'f',
			'p',
			'f',
			't',
			'q',
			'r',
			's',
			't',

			// Other.
			'x',
			'',
			'',
			'',
			'',
			'',
			'',
			'',
			'',
			'',
			'',
			'',
			'',
			'-',
			'-',
		);

		// First step of cleanup using WP core function.
		$friendly_filename = remove_accents( $filename );

		// Replacing additional characters.
		$friendly_filename = preg_replace( $original_chars, $sanitized_chars, $friendly_filename );

		// At this point we should have a clean filename, but we're going to remove any character not covered by the above replacements,  just in case.
		$friendly_filename = preg_replace( '/[^a-zA-Z0-9_\.-]/', '', $friendly_filename ); // Allow only letters, numbers, underscores, dots, dashes.

		// Finally all letters in the filename are set to lowercase to prevent issues with case insensitive systems.
		$friendly_filename = strtolower( $friendly_filename );

		// Allow additional changes.
		$friendly_filename = apply_filters( 'scf_friendly_filename', $friendly_filename );

		return $friendly_filename;

}

if ( class_exists( 'GFCommon' ) ) {

	add_action( 'gform_pre_process', 'sar_clean_gf_temp_files' );

	/**
	 * Adds additional support for files uploaded using single upload Gravity Forms fields. Thanks to my buddy David Smith! :)
	 *
	 * @param array $form The form object.
	 */
	function sar_clean_gf_temp_files( $form ) {
		if ( ! empty( $_FILES ) ) {
			foreach ( $_FILES as &$file ) {
				$file['name'] = sar_clean_filenames( $file['name'] );
				GFCommon::log_debug( __METHOD__ . '(): Clean Filename: ' . $file['name'] );
			}
		}
		return $form;
	}
}
