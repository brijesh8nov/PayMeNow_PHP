<?php
	class paymenow{
		protected $wsdlURL = 'https://trans.merchantpartners.com/Web/services/TransactionService?wsdl'; //DON'T CHANGE THIS
		protected $acctid = 'TEST0';// CHANGE THIS ACCORDING TO THE ACCOUNT ID, THIS IS TEST
		protected $subid = '';// ADD THIS IF ENABLED IN THE PAYMENOW CONSOLE
		
		private function createccinfo($formvars){
			$param = array(
				'acctid' => $this->acctid,
				'subid' => $this->subid,
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
			$client = new nusoap_client($this->wsdlURL,'wsdl');
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
