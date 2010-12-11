<?

// Rates
$PLANET_CREDITS = .0015;		
$PLANET_ORE = .00125;			
$PLANET_FIGHTERS = .00125;		
$PLANET_COLONISTS = 0.0002;		// every tick the amount of colonists is multiplied by 1+this
$PLANET_CREDITSINTEREST = .0020;	// interest on the money held by any planet


// Ticks & Turns
$TICK_LENGTH = 2*60;			// In seconds
$TURNS_PER_TICK = 1;			// This is never less than 1! You can change the time between ticks!
$MAX_TURNS = 8000;			// No user will ever have more than so many turns


// Other
$ALWAYS_SHOW_MAP = 1;			// Als deze 1 is zal de volledige ThisMap weergegeven worden; anders alleen de sectors die al bezocht zijn


//Sectors
$MAP_WIDTH = 8;				// The map will be this*this sectors
$MAX_SECTORS = $MAP_WIDTH*$MAP_WIDTH;	



// MySQL Tabellen
$TABLE[users] = $tableprefix . "users";
$TABLE[gangs] = $tableprefix . "gangs";
$TABLE[sectors] = $tableprefix . "sectors";
$TABLE[timer] = $tableprefix . "timer";
$TABLE[log] = $tableprefix . "log";


// Charachters
$CHARACHTER[1] = "Businessman";
$CHARACHTER[2] = "Computernerd";
$CHARACHTER[3] = "Hitman";
$CHARACHTER[4] = "Junkie";
$CHARACHTER[5] = "SWAT";


// Streets
$STREET[P] = "Pharmacie";
$STREET[A] = "Arms 'r' us";
$STREET[T] = "Telephone";
$STREET[H] = "Hospital";
$STREET[C] = "Community Centre";
$STREET[M] = "Mall";
$STREET[R] = "Restaurant";
$STREET[S] = "Safehouse";
$STREET[W] = "Way Out";
$STREET[X] = "Empty Street";


