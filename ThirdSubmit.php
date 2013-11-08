<?php
if ($_POST ['formSubmit'] == "Submit") {
	$yamlOutput = "---\n";
	
	$firstName = $_POST ['firstName'];
	$lastName = $_POST ['lastName'];
	$email = $_POST ['email'];
	$attendCeremony = $_POST ['attendCeremony'];
	$attendReception = $_POST ['attendReception'];
	
	$csvOutput = $firstName . ',' . $lastName . ',' . $email . ',' . $attendCeremony . ',' . $attendReception;
	$yamlOutput .= "firstName: " . $firstName . "\n";
	$yamlOutput .= "lastName: " . $lastName . "\n";
	$yamlOutput .= "email: " . $email . "\n";
	$yamlOutput .= "attendCeremony: " . $attendCeremony . "\n";
	$yamlOutput .= "attendReception: " . $attendReception . "\n";
	
	if ($attendReception == "yes") {
		$numberGuests = $_POST ['numberGuests'];
		$totalPeople = 1 + ( int ) $numberGuests;
		$csvOutput .= ',' . $totalPeople;
		$yamlOutput .= "totalPeople: " . $totalPeople . "\n";
		
		$foodChoice0 = $_POST ['foodChoice0'];
		$csvOutput .= ',' . $firstName . ',' . $lastName . ',' . $foodChoice0;
		$yamlOutput .= "foodChoice:\n";
		$yamlOutput .= "\t-\n";
		$yamlOutput .= "\t\tfirstName: " . $firstName . "\n";
		$yamlOutput .= "\t\tlastName: " . $lastName . "\n";
		$yamlOutput .= "\t\tchoice: " . $foodChoice0 . "\n";
		
		for($i = 1; $i < $totalPeople; $i ++) {
			$guestFirst = $_POST ['guest' . $i . 'First'];
			$guestLast = $_POST ['guest' . $i . 'Last'];
			$guestChoice = $_POST ['foodChoice' . $i];
			
			$csvOutput .= ',' . $guestFirst . ',' . $guestLast . ',' . $guestChoice;
			$yamlOutput .= "\t-\n";
			$yamlOutput .= "\t\tfirstName: " . $guestFirst . "\n";
			$yamlOutput .= "\t\tlastName: " . $guestLast . "\n";
			$yamlOutput .= "\t\tchoice: " . $guestChoice . "\n";
		}
	}
	
	$yamlOutput .= "...\n";
	
	$fs = fopen ( "rsvpresults.csv", "a" );
	$fs2 = fopen ( "rsvpresults.yaml", "a" );
	fwrite ( $fs, $csvOutput . "\n" );
	fwrite ( $fs2, $yamlOutput );
	fclose ( $fs );
	fclose ( $fs2 );
	header ( "Location: thankyou.html" );
	exit ();
}
?>
