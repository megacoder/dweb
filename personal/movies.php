<?_head("Movies")?>

<div id="intro">
Pom.
</div>

<?_title("DVDs to buy")?>
<ol>
	<li> A Clockwork Orange
	<li> Antitrust
	<li> Band of Brothers
	<li> Best Laid Plans
	<li> Dr Strangelove or: How I Learned to Stop Worrying and Love the Bomb
	<li> Labyrinth
	<li> Laputa: Castle In The Sky
	<li> Leon
	<li> Lock, Stock and Two Smoking Barrels
	<li> Lost And Delirious
	<li> Much Ado About Nothing
	<li> Nothing To Lose
	<li> Six Degrees of Separation
	<li> Stand By Me
	<li> Tesis
	<li> The Commitments
	<li> The Crying Game
	<li> The Great Dictator
	<li> The Player
	<li> Tilsammans
</ol>

<?_title("DVDs I own")?>
<ol>
	<li> Abre Los Ojos (mark)
	<li> Almost Famous <small>#121</small>
	<li> American Beauty <small>#23</small>
	<li> American History X <small>#58</small>
	<li> Arlington Road
	<li> Bill Elliot
	<li> Blade Runner <small>#75</small>
	<li> Chocolat
	<li> Clockwise
	<li> Crouching Tiger Hidden Dragon <small>#46</small> (mark)
	<li> Deconstructing Harry (mark)
	<li> Desperado
	<li> Edward Scissorhands
	<li> El Mariachi
	<li> Enemy At The Gates
	<li> Eraserhead
	<li> eXistenZ
	<li> Festen <small>#141</small>
	<li> Fight Club <small>#37</small>
	<li> Fucking Åmål
	<li> Gladiator <small>#142</small>
	<li> Iedereen Beroemd!
	<li> Jackie Brown
	<li> La Vita E Bella <small>#54</small>
	<li> Le Fabuleux Destin D'Amélie Poulain <small>#17</small>
	<li> Leaving Las Vegas
	<li> Matrix
	<li> Memento <small>#10</small>
	<li> Monty Python And The Holy Grail <small>#50</small>
	<li> Monty Python's Life of Brian <small>#164</small>
	<li> Monty Python's Meaning of Life
	<li> Natural Born Killers
	<li> One Flew Over The Cockoo's Nest <small>#12</small>
	<li> Pulp Fiction <small>#19</small>
	<li> Reservoir Dogs <small>#72</small>
	<li> Robin Hood (Prince Of Thieves)
	<li> Romeo + Juliet
	<li> Saving Private Ryan (mark)
	<li> Seven Years In Tibet
	<li> Shakespeare In Love
	<li> Shrek <small>#93</small>
	<li> Snatch <small>#194</small>
	<li> Taxi 2
	<li> The Assassin
	<li> The Deer Hunter <small>#95</small>
	<li> The Fifth Element
	<li> The Godfather <small>#1</small>
	<li> The Godfather (Part II) <small>#3</small>
	<li> The Godfather (Part III)
	<li> The Graduate <small>#94</small>
	<li> The Green Mile <small>#101</small>
	<li> The Negotiator
	<li> The Shawshank Redemption <small>#2</small>
	<li> The Sixth Sense <small>#62</small>
	<li> Time Bandits
	<li> Total Recall
	<li> Traffic <small>#157</small>
	<li> Urban Legend
</ol>

<?_title("Movies I saw in a theatre")?>
This is not a complete list (some periods are not covered).
<ul>
<?
  $filmlist=File("film-list.txt");
  reset($filmlist);
  while ($film=current($filmlist)) {
    list($a,$b,$c,$d)=split("\t+",$film);
    list($e)=split("-",$a);
    echo "<li>";
    _link("http://us.imdb.com/Tsearch?title=".urlencode("$c")."&type=substring&year=$e&tv=off",$c);
    if ($a||$b)
      echo " <small>[$a $b]</small>\n";
//    echo " <small>$d</small>\n";
    next($filmlist);
  }
?>
</ul>

<?_foot()?>
