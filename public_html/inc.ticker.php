<?

/*
   Wat gebeurt er allemaal tijdens 1 tick?
   * Turns worden bijgeschreven
   * Elke sector en elke shop krijgt nieuwe producten:
     * Altijd ammo!
     * Geen producten als meer dan gemiddeld 15 per sector.
     * Shops krijgen altijd nieuwe stock!
*/



// Nieuwe time wordt opgeslagen
$nieuw = $oud + $TICK_LENGTH*$p;
mysql_query("UPDATE $TABLE[timer] SET laatste='$nieuw'");



// Turns bijschrijven
$c = $TURNS_PER_TICK*$p;
mysql_query("UPDATE $TABLE[users] SET turns=turns+$c");

// Zorgen dat er niemand boven het maximum uitkomt
mysql_query("UPDATE $TABLE[users] SET turns=$MAX_TURNS WHERE turns>$MAX_TURNS");


