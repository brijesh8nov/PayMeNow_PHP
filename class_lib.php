<?php
	class paymenow{
		
		private function createccinfo($formvars){
			$acctid = 'TEST0';// CHANGE THIS ACCORDING TO THE ACCOUNT ID, THIS IS TEST
			$subid = '';// ADD THIS IF ENABLED IN THE PAYMENOW CONSOLE
			$param = array(
				'acctid' => $acctid,
				'subid' => $subid,
				'ccname' => $formvars['ccname'],
				'ccnum' => $formvars['ccnum'],
				'amount' => $formvars['amount'],
				'expmon' => $formvars['expmon'],
				'expyear' => $formvars['expyear']
				);
	
			return $param;		
		}
			
		//function to call nusop and call the webservice
		
		public function callWebService($formvalues){
			require 'nusoap/lib/nusoap.php';
			$wsdlURL = 'https://trans.merchantpartners.com/Web/services/TransactionService?wsdl'; //DON'T CHANGE THIS
			$client = new nusoap_client($wsdlURL,'wsdl');
			$error = $client->getError();
			if($error){
				$result = array(
						'errorMessage' => $error
				);
			}
			else{
				$ccinfoparams = $this->createccinfo($formvalues);
				$result = $client->call('processCCSale',array('ccinfo'=>$ccinfoparams));
			}

			return $result;
		}	
	}
