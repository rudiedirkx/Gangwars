<?php

// Rates
$PLANET_CREDITS			= .0015;	
$PLANET_ORE				= .00125;	
$PLANET_FIGHTERS		= .00125;	
$PLANET_COLONISTS		= .0002;	// every tick the amount of colonists is multiplied by 1+this
$PLANET_CREDITSINTEREST	= .0020;	// interest on the money held by any planet


// Ticks & Turns
$TICK_LENGTH			= 2*60;		// In seconds
$TURNS_PER_TICK			= 1;		// This is never less than 1! You can change the time between ticks!
$MAX_TURNS				= 5000;		// No user will ever have more than so many turns
$TICKS_START			= 2000;		// Amount of ticks a new user starts with


// Other
$ALWAYS_SHOW_MAP		= FALSE;	// If TRUE, the complete ThisMap will be shown; else only the visited sectors


// Sectors
$MAP_WIDTH				= 8;		// The map will be this*this sectors
$MAX_SECTORS			= $MAP_WIDTH*$MAP_WIDTH;
$VOORUITKIJKEN			= 1;		// Als dit 0 is, kan je alleen de vakjes van de BUSKAART zien, waar ja naartoe kan

// Merchandise
$QUASI_MAX_ITEMS		= 15;
$PCT_PER_ITEM			= 6.2;


// Charachters
$CHARACHTER[1]			= "Businessman";
$CHARACHTER[2]			= "Computernerd";
$CHARACHTER[3]			= "Hitman";
$CHARACHTER[4]			= "Junkie";
$CHARACHTER[5]			= "SWAT-Officer";


// Charachter eigenschappen
$MAX_AANTAL[1]			= 11;
$MAX_AANTAL[2]			= 5;
$MAX_AANTAL[3]			= 8;
$MAX_AANTAL[4]			= 6;
$MAX_AANTAL[5]			= 8;

$MAX_GEWICHT[1]			= 65;
$MAX_GEWICHT[2]			= 76;
$MAX_GEWICHT[3]			= 130;
$MAX_GEWICHT[4]			= 130;
$MAX_GEWICHT[5]			= 142;

$MAX_RUIMTE[1]			= 110;
$MAX_RUIMTE[2]			= 90;
$MAX_RUIMTE[3]			= 120;
$MAX_RUIMTE[4]			= 78;
$MAX_RUIMTE[5]			= 130;


// Streets
$STREET['P']			= "Pharmacie";
$STREET['A']			= "Arms 'r' us";
$STREET['T']			= "Telephone";
$STREET['C']			= "Community Centre";
$STREET['H']			= "Hospital";
$STREET['M']			= "Mall";
$STREET['R']			= "Restaurant";
$STREET['S']			= "Safehouse";
$STREET['W']			= "Way Out";
$STREET['X']			= "Nothing";


?>