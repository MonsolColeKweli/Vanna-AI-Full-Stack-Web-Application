<?php 
class final_rest
{



/**
 * @api  /api/v1/setTemp/
 * @apiName setTemp
 * @apiDescription Add remote temperature measurement
 *
 * @apiParam {string} location
 * @apiParam {String} sensor
 * @apiParam {double} value
 *
 * @apiSuccess {Integer} status
 * @apiSuccess {string} message
 *
 * @apiSuccessExample Success-Response:
 *     HTTP/1.1 200 OK
 *     {
 *              "status":0,
 *              "message": ""
 *     }
 *
 * @apiError Invalid data types
 *
 * @apiErrorExample Error-Response:
 *     HTTP/1.1 200 OK
 *     {
 *              "status":1,
 *              "message":"Error Message"
 *     }
 *
 */
	public static function setTemp ($location, $sensor, $value)

	{
		if (!is_numeric($value)) {
			$retData["status"]=1;
			$retData["message"]="'$value' is not numeric";
		}
		else {
			try {
				EXEC_SQL("insert into temperature (location, sensor, value, date) values (?,?,?,CURRENT_TIMESTAMP)",$location, $sensor, $value);
				$retData["status"]=0;
				$retData["message"]="insert of '$value' for location: '$location' and sensor '$sensor' accepted";
			}
			catch  (Exception $e) {
				$retData["status"]=1;
				$retData["message"]=$e->getMessage();
			}
		}

		return json_encode ($retData);
	}

	/**
 * @api  /api/v1/addLog/
 * @apiName addLog
 * @apiDescription Add record to logfile
 *
 * @apiParam {string} level
 * @apiParam {String} systemPrompt
 * @apiParam {String} userPrompt
 * @apiParam {string} chatResponse
 * @apiParam {Integer} inputTokens
 * @apiParam {Integer} outputTokens
 *
 * @apiSuccess {Integer} status
 * @apiSuccess {string} message
 *
 * @apiSuccessExample Success-Response:
 *     HTTP/1.1 200 OK
 *     {
 *              "status":0,
 *              "message": ""
 *     }
 *
 * @apiError Invalid data types
 *
 * @apiErrorExample Error-Response:
 *     HTTP/1.1 200 OK
 *     {
 *              "status":1,
 *              "message":"Error Message"
 *     }
 *
 */
	public static function addLog ($function, $logdata)
	{
			try {
				EXEC_SQL("insert into log (function,logdata) values (?,?)",$function, $logdata);
				$retData["status"]=0;
				$retData["message"]="LOG: '$function' with data: '$logdata'";
			}
			catch  (Exception $e) {
				$retData["status"]=1;
				$retData["message"]="LOG ERROR";
			}
		return json_encode ($retData);
	}


/**
 * @api  /api/v1/getLevel/
 * @apiName getLevel
 * @apiDescription Return all level data from database
 *
 * @apiSuccess {Integer} status
 * @apiSuccess {string} message
 *
 * @apiSuccessExample Success-Response:
 *     HTTP/1.1 200 OK
 *     {
 *              "status":0,
 *              "message": ""
 *              "result": [
 *                { 
 *                  levelID: 1,
 *                  description: "",
 *                  prompt: ""
 *              ]
 *     }
 *
 * @apiError Invalid data types
 *
 * @apiErrorExample Error-Response:
 *     HTTP/1.1 200 OK
 *     {
 *              "status":1,
 *              "message":"Error Message"
 *     }
 *
 */
  public static function getLevel () {
		return json_encode ($retData);
  }



/**
 * @api  /api/v1/getLog/
 * @apiName getLog
 * @apiDescription Retrieve Log Records

 * @apiSuccess {Integer} status
 * @apiSuccess {string} message
 *
 * @apiSuccessExample Success-Response:
 *     HTTP/1.1 200 OK
 *     {
 *              "status":0,
 *              "message": ""
 *              "result": [
 *                { 
 *                  timeStamp: "YYYY-MM-DD HH:MM:SS",
 *                  level: "",
 *                  systemPrompt: "",
 *                  userPrompt: "",
 *                  chatResponse: "",
 *                  inputTokens: 0,
 *                  outputTokens: 0
 *              ]
 *     }
 *
 * @apiError Invalid data types
 *
 * @apiErrorExample Error-Response:
 *     HTTP/1.1 200 OK
 *     {
 *              "status":1,
 *              "message":"Error Message"
 *     }
 *
 */
  public static function getLog () {
		try {
			$retData["status"]=0;
			//$retData["message"]="DATE: '$date' with records: '$limit'";
			$retData["message"]=GET_SQL("select * from queries");
		}
		catch  (Exception $e) {
			$retData["status"]=1;
			$retData["message"]="LOG ERROR";
		}
	return json_encode ($retData);
  }


  public static function runQuery($query) {
	$ch = curl_init();
	//setup for URL for vanna API
	$hostname = '172.17.15.65';
	$VANNA_URL = "/vanna/api/v0/";
	$Vanna_port = 5000;
	//check if query is empty
	if ($query == null || $query == "") {
		$retData["status"]=1;
		$retData["message"]="Query is empty";
		curl_close($ch);
		return json_encode ($retData);
	}
	//hit vanna API to create query
	try {
		$encodedQuery = urlencode($query);
		$url = "http://" . $hostname . $VANNA_URL . "generate_sql?question=" . $encodedQuery;
		curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_TIMEOUT, 10);
		// Execute and get the response
		$response = curl_exec($ch);
		$httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);

		if ($response === false) {
            $curlErrorMessage = curl_error($ch);
            $retData["status"] = 2;
            $retData["message"] = "Vanna API request failed: " . $curlErrorMessage;
			curl_close($ch);
            return json_encode($retData); // Return early after setting error
        }

		$JsonResponse = json_decode($response, true);
		$SQL_ID = $JsonResponse["id"];
		$SQL_TEXT = $JsonResponse['text'];
	}
	catch (Exception $e) {
			$retData["status"] = 99;
      	  	$retData["message"] = "An unexpected error occurred: " . $e->getMessage();
			curl_close($ch);
        	return json_encode($retData);
		}

		//using query ID, hit vanna to run SQL
		try {
			$url = "http://" . $hostname . $VANNA_URL . "run_sql?id=" . $SQL_ID;
			curl_setopt($ch, CURLOPT_URL, $url);
       		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        	curl_setopt($ch, CURLOPT_TIMEOUT, 10);
			// Execute and get the response
			$response = curl_exec($ch);
			$httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);

			if ($response === false) {
           		$curlErrorMessage = curl_error($ch);
            	$retData["status"] = 2;
            	$retData["message"] = "Vanna API request failed: " . $curlErrorMessage;
				curl_close($ch);
            	return json_encode($retData); // Return early after setting error
        	}
			$JsonResponse2 = json_decode($response, true);
			$DatabaseJson = json_decode($JsonResponse2["df"],true);
			$retData["status"] = 0;
			$retData["SQL_ID"] = $SQL_ID;
			$retData['SQL_TEXT'] = $SQL_TEXT;
			$SQL_DATA =  $DatabaseJson;
			$retData["response"] = $SQL_DATA;
			$SQL_DATA = json_encode($SQL_DATA);

		}
		catch (Exception $e) {
			$retData["status"] = 99;
      	  	$retData["message"] = "An unexpected error occurred: " . $e->getMessage();
			curl_close($ch);
        	return json_encode($retData);
		}
		//save querry, SQl and query ID to SQL server
		EXEC_SQL("insert into queries (query,query_id,query_response,natural_query) values (?,?,?,?)",$SQL_TEXT, $SQL_ID, $SQL_DATA,$query);
		//send response to front end
		curl_close($ch);
		return json_encode($retData);
  }
}

