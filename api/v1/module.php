<?php
	/*	/module/
	 *		/key/
	 *			/all
	 *			/list						moduleListKeys()
	 *			/{key-name}/
	 *				/files					moduleListFiles($key)
	 *				/paths					moduleListPaths($key)
	 *				/providers				moduleListProviders($key)
	 *		/provider/
	 *			/all
	 *			/list						moduleList()
	 *			/{provider-name}/
	 *				/load					moduleLoad($module)
	 *				/files					moduleFiles($module)
	 *				/provides				moduleProvides($module)
	 */

	/*
		/api/v1/module/key/preassessment/providers
		{
			"assessmentMetadata": {
				"5_1_patient.php": "15b64",
				"5_3_activityDate.php": "512b8",
				"5_4_behavioralHealth.php": "75b51",
				"5_6_nutrition.php": "8c193",
				"5_7_clinic.php": "5a222",
				"5_9_activityType.php": "b526f"
			},
			"chronic": {
				"5_5_chronic.php": "eab43"
			},
			"jsonAssessment": {
				"1_jsonAssessment.php": "a4f81"
			},
			"main": {
				"9_assessmentsStart.php": "ba907",
				"zzzz_assessmentsEnd.php": "f3d9c"
			},
			"old_assessments": {
				"aa_oldassessments.php": "b6584"
			},
			"qualtrics": {
				"5_3_insurance.php": "636c3",
				"5_8_HCHScreening.php": "bbe01"
			}
		}
	*/

	require_once $_SERVER['DOCUMENT_ROOT'] . '/include/module.php';

	$methods["/key/list"] = function($subURI, $context, $getVars) {
		$response = array();

		// TODO: Move to library
		foreach(moduleListKeys() as $module) {
			array_push($response, $module);
		}

		$context["response"] = $response;
		return $context;
	};

	$methods["/key"] = function($subURI, $context, $getVars) {
		$explodedURI = explodeURI($subURI);
		$response = array();

		if(!array_key_exists(0, $explodedURI)) {
			$context['error'] = 'Method not implemented';
		} else if(array_key_exists(1, $explodedURI)) {
			switch($explodedURI[1]) {
				case 'files':
					$response = moduleListFiles($explodedURI[0]);
					break;
				case 'paths':
					$response = moduleListPaths($explodedURI[0]);
					break;
				case 'providers':
					$response = moduleListProviders($explodedURI[0]);
					break;
				case 'truncatedPaths':
					$response = moduleListTruncatedPaths($explodedURI[0]);
					break;
			}
		} else {
			$response['files'] = moduleListFiles($explodedURI[0]);
			$response['paths'] = moduleListPaths($explodedURI[0]);
			$response['providers'] = moduleListProviders($explodedURI[0]);
			$response['truncatedPaths'] = moduleListTruncatedPaths($explodedURI[0]);
		}

		if(!empty($response))
			$context['response'] = $response;
		return $context;
	};

	$methods["/provider/list"] = function($subURI, $context, $getVars) {
		$response = array();

		// TODO: Move to library
		foreach(moduleList() as $module) {
			array_push($response, $module);
		}

		$context["response"] = $response;
		return $context;
	};

	$methods["/provider"] = function($subURI, $context, $getVars) {
		$explodedURI = explodeURI($subURI);

		if(!array_key_exists(0, $explodedURI)) {
			$context['error'] = 'Method not implemented';
			return;
		}

		if(array_key_exists(1, $explodedURI)) {
			switch($explodedURI[1]) {
				case 'files':
					$response = moduleFiles($explodedURI[0]);
					break;
				case 'provides':
					$response = moduleProvides($explodedURI[0]);
					break;
				default:
					$context['error'] = 'Method not implemented';
					break;
			}
		} else {
			$response['files'] = moduleFiles($explodedURI[0]);
			$response['provides'] = moduleProvides($explodedURI[0]);
		}

		if(!empty($response))
			$context['response'] = $response;
		return $context;
	};
?>
