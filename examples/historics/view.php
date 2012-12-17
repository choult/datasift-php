<?php
/**
 * DataSift client
 *
 * This software is the intellectual property of MediaSift Ltd., and is covered
 * by retained intellectual property rights, including copyright.
 *
 * @category  DataSift
 * @package   PHP-client
 * @author    Stuart Dallas <stuart@3ft9.com>
 * @copyright 2011 MediaSift Ltd.
 * @license   http://www.debian.org/misc/bsd.license BSD License (3 Clause)
 * @link      http://www.mediasift.com
 */

/**
 * This script views Historics queries in your account.
 *
 * NB: Most of the error handling (exception catching) has been removed for
 * the sake of simplicity. Nearly everything in this library may throw
 * exceptions, and production code should catch them. See the documentation
 * for full details.
 */

// Include the shared convenience class
require dirname(__FILE__).'/env.php';

// Create the env object. This reads the command line arguments, creates the
// user object, and provides access to both along with helper functions
$env = new Env();

// Make sure we have at least one playback ID
if (count($env->args) == 0) {
	die('Please specify at least one playback ID!'.PHP_EOL);
}

// Cycle through the IDs passed on the command line
foreach ($env->args as $playback_id) {
	try {
		$hist = $env->user->getHistoric($playback_id);
		$env->displayHistoricDetails($hist);
	} catch (Exception $e) {
		echo get_class($e).' '.$e->getMessage().PHP_EOL;
	}
	echo '--'.PHP_EOL;
}
