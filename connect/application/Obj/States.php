<?php
class Obj_States {
	
	protected static $states = array(
							'1' => array('name'=>'Alabama' , 'shortName'=>'AL'),
							'2' => array('name'=>'Alaska' , 'shortName'=>'AK'),
							'4' => array('name'=>'Arizona' , 'shortName'=>'AZ'),
							'5' => array('name'=>'Arkansas' , 'shortName'=>'AR'),
							'6' => array('name'=>'California' , 'shortName'=>'CA'),
							'7' => array('name'=>'Colorado' , 'shortName'=>'CO'),
							'8' => array('name'=>'Connecticut' , 'shortName'=>'CT'),
							'9' => array('name'=>'Delaware' , 'shortName'=>'DE'),
							'10' => array('name'=>'Florida' , 'shortName'=>'FL'),
							'11' => array('name'=>'Georgia' , 'shortName'=>'GA'),
							'12' => array('name'=>'Hawaii' , 'shortName'=>'HI'),
							'13' => array('name'=>'Idaho' , 'shortName'=>'ID'),
							'14' => array('name'=>'Illinois' , 'shortName'=>'IL'),
							'15' => array('name'=>'Indiana' , 'shortName'=>'IN'),
							'16' => array('name'=>'Iowa' , 'shortName'=>'IA'),
							'17' => array('name'=>'Kansas' , 'shortName'=>'KS'),
							'18' => array('name'=>'Kentucky' , 'shortName'=>'KY'),
							'19' => array('name'=>'Louisiana' , 'shortName'=>'LA'),
							'20' => array('name'=>'Maine' , 'shortName'=>'ME'),
							'21' => array('name'=>'Maryland' , 'shortName'=>'MD'),
							'22' => array('name'=>'Massachusetts' , 'shortName'=>'MA'),
							'23' => array('name'=>'Michigan' , 'shortName'=>'MI'),
							'24' => array('name'=>'Minnesota' , 'shortName'=>'MN'),
							'25' => array('name'=>'Mississippi' , 'shortName'=>'MS'),
							'26' => array('name'=>'Missouri' , 'shortName'=>'MO'),
							'27' => array('name'=>'Montana' , 'shortName'=>'MT'),
							'28' => array('name'=>'Nebraska' , 'shortName'=>'NE'),
							'29' => array('name'=>'Nevada' , 'shortName'=>'NV'),
							'30' => array('name'=>'New Hampshire' , 'shortName'=>'NH'),
							'31' => array('name'=>'New Jersey' , 'shortName'=>'NJ'),
							'32' => array('name'=>'New Mexico' , 'shortName'=>'NM'),
							'33' => array('name'=>'New York' , 'shortName'=>'NY'),
							'34' => array('name'=>'North Carolina' , 'shortName'=>'NC'),
							'35' => array('name'=>'North Dakota' , 'shortName'=>'ND'),
							'36' => array('name'=>'Ohio' , 'shortName'=>'OH'),
							'37' => array('name'=>'Oklahoma' , 'shortName'=>'OK'),
							'38' => array('name'=>'Oregon' , 'shortName'=>'OR'),
							'39' => array('name'=>'Pennsylvania' , 'shortName'=>'PA'),
							'40' => array('name'=>'Rhode Island' , 'shortName'=>'RI'),
							'41' => array('name'=>'South Carolina' , 'shortName'=>'SC'),
							'42' => array('name'=>'South Dakota' , 'shortName'=>'SD'),
							'43' => array('name'=>'Tennessee' , 'shortName'=>'TN'),
							'44' => array('name'=>'Texas' , 'shortName'=>'TX'),
							'45' => array('name'=>'Utah' , 'shortName'=>'UT'),
							'46' => array('name'=>'Vermont' , 'shortName'=>'VT'),
							'47' => array('name'=>'Virginia' , 'shortName'=>'VA'),
							'48' => array('name'=>'Washington' , 'shortName'=>'WA'),
							'49' => array('name'=>'West Virginia' , 'shortName'=>'WV'),
							'50' => array('name'=>'Wisconsin' , 'shortName'=>'WI'),
							'51' => array('name'=>'Wyoming' , 'shortName'=>'WY'),
							'54' => array('name'=>'District of Columbia' , 'shortName'=>'DC')
	);
	
	
	static function getFullStates() {
		$fullStates = array();
		foreach (self::$states as $id => $states) {
			$fullStates[$id] = $states['name'];
		}	
		return $fullStates;
	}	
	

}