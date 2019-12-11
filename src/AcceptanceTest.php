<?php

declare(strict_types=1);
include_once("HTMLParser.php");

use PHPUnit\Framework\TestCase;

class AcceptanceTest extends TestCase
{
    private $htmlParser;

    public function setUp(): void{
        $this->htmlParser = new HTMLParser();
    }

    public function testGivenPureTextWhenGetParsedDataThenReturnSameText(): void {
        $input='<!-- wp:heading {\"level\":1,\"align\":\"center\"} -->
<h1 style=\"text-align:center\">O Laboratoriju</h1>
<!-- /wp:heading -->

<!-- wp:paragraph {\"align\":\"left\",\"fontSize\":\"regular\"} -->
<p style=\"text-align:left\" class=\"has-regular-font-size\"><strong>Laboratorij ima za opći cilj spojiti istraživanja, razvoj industrijskih projekata i edukaciju u području Web arhitektura, tehnologija, servisa i sučelja. </strong></p>
<!-- /wp:paragraph -->

<!-- wp:paragraph {\"align\":\"center\",\"fontSize\":\"regular\"} -->
<p style=\"text-align:center\" class=\"has-regular-font-size\"><strong> Pojedinačni ciljevi su sljedeći</strong></p>
<!-- /wp:paragraph -->

<!-- wp:list -->
<ul><li>podržati
	i modernizirati nastavni plan i program postojećih kolegija koje
	izvode članovi Laboratorija (Web dizajn i programiranje, Napredne
	web tehnologije i servisi, Uzorci dizajna, Sustavi za elektroničko
	učenje, Izgradnja web aplikacija, Multimedijski sustavi) 
	
	</li><li>predložiti
	nove kolegije na preddiplomskoj, diplomskoj i/ili poslijediplomskoj
	razini koji će dopuniti postojeći nastavni plan i program na
	Fakultetu organizacije i informatike
	</li><li>predložiti
	nove module na preddiplomskoj i/ili diplomskoj razini u području
	web i mobilnih tehnologija u suradnji s drugim laboratorijima na
	Fakultetu organizacije i informatike
	</li><li>sudjelovati
	u prijavi projekata u različitim shemama financiranja za
	prikupljanje sredstava za istraživačke
	projekte, projekte dokaza koncepta posebnih web tehnologija i web
	razvojnih projekata
	</li><li>istraživati
	u području postojećih web protokola (npr. WebSocket) i novih web
	protokola (npr. HTTP/2) i njihove primjene u različitim web
	sustavima
	</li><li>istraživati
	u području postojećih web programskih jezika (npr. JavaScript,
	Java, PHP, Python, Ruby i dr.) i dolazećih web programskih jezika
	(npr. Elm, Kotlin i dr.) i njihove primjene u različitih web
	sustavima
	</li><li>istraživati
	u području web programskih okvira za poslužiteljski dio web
	sustava s obzirom na različite web programske jezike i njihove
	primjene u različitih web sustavima
	</li><li>istraživati
	u području dinamičkih 2D grafičkih prikaza u korisničkom sučelju
	i njihove primjene u različitih web sustavima
	</li><li>istraživati
	u području web programskih okvira za korisničko sučelje (npr.
	Angular, Bootstrap i dr.) i njihove primjene u različitih web
	sustavima
	</li><li>istraživati
	u području postojećih web programskih okvira za korisničko
	sučelje (npr. Angular, Bootstrap i dr.) i njihove primjene u
	različitih web sustavima 
	
	</li><li>istraživati
	u području automatskog generiranja web sustava na temelju
	specifikacija
	</li><li>istraživati
	u području interoperabilnosti web i ostalih programskih sustava
	</li><li>istraživati
	u području interoperabilnosti web i ostalih programskih
	sustavaistraživati
	</li><li>istraživati
	u području web arhitektura 
	
	</li><li>istraživati
	u području web sustava
	</li><li>istraživati
	u području Interneta stvari
	</li><li>istraživati
	u području primjene web sustava u obrazovanju
	</li><li>istraživati
	i promicati dizajn orijentiran korisniku pri razvoju web sustava  
	
	</li><li>istraživati
	i unaprijediti razinu korištenja web inženjeringa i drugih
	relevantnih (međunarodnih) standarda, preporuka i metoda za
	poboljšanje kvalitete web sustava
	</li><li>promicati
	korištenje alata i sustava otvorenog koda za razvoj web sustava 
	
	</li><li>podići
	svijest o važnosti upotrebljivosti, pristupačnosti i dobrog
	korisničkog iskustva u web sustavima, web aplikacijama i
	korisničkim sučeljima općenito
	</li><li>konzultirati
	naručitelje (i partnere
	u industriji) o web tehnologijama, procesu razvoja web sustava,
	njihovoj primjeni upotrebljivosti i pristupačnosti i sl.
	</li><li>razviti
	za naručitelje (i partnere
	u industriji) cjelovite web sustave i/ili projekte dokaza koncepta
	za posebne  web tehnologije
	</li><li>istražiti
	i primijeniti testiranje korisničkog sučelja web sustava pomoću
	automatiziranih sustava (npr. Selenium, JMeter i dr.)
	</li><li>istražiti
	i primijeniti testiranje programskog koda web sustava pomoću
	jediničnih testova (npr. JUnit, TestNG, PHPUnit, XUnit i dr.) 
	
	</li><li>istražiti
	i primijeniti testiranje opterećenja web sustava pomoću
	automatiziranih sustava (npr. JMeter, WebStressTool i dr.)
	</li><li>istražiti
	i primijeniti testiranje sigurnosti web sustava pomoću
	automatiziranih sustava otvorenog koda i web aplikacija (npr. 
	ScanMyServer, SUCURI, Quttera i dr.)
	</li><li>istražiti
	primjenu smjernica za kvalitetan razvoja web sustava (npr. principi
	čistog koda)
	</li><li>istražiti
	primjenu trendova u web dizajnu (npr. flat dizajn, minimalizam,
	animacije, interaktivnost, paralaksa i dr.)
	</li><li>istražiti
	karakteristike i komponente različitih jezika dizajna koji se
	koriste u oblikovanju web i drugih korisničkih sučelja
	</li><li>istražiti
	primjenu programskih paradigmi (objekto orijentirano programiranje,
	funkcionalno programiranje itd.) za razvoj web sustava
	</li><li>istražiti
	primjene različitih načina razvoja softvera (npr. razvoj vođen
	testiranjem, razvoj vođen ponašanjem, i sl.)  u razvoju web
	aplikacija
	</li><li>istražiti
	razvoj web aplikacija prilagođenih za različite uređaje poput
	mobitela, tableta i  televizora
	</li><li>istražiti
	stavove, razmišljanja i sl. profesionalnih programera iz područja
	razvoja web sustava
	</li><li>istražiti
	strukture podataka i pohrane podataka (kao što su baze podataka) u
	web sustavima 
	
	</li><li>istražiti
	prikladnost različitih struktura podataka za komunikaciju putem
	weba (npr. XML, JSON, REST, …) 
	
	</li><li>istražiti
	etička pitanja i probleme u razvoju web sustava (licence,
	plagijati, i sl.)
	</li><li>istražiti
	probleme u razvoju weba i web sustava nastalih zbog promjena
	regulative (npr. net neutrality) i ostalih  sličnih događaja 
	
	</li><li>istražiti
	prikladnost različitih metoda razvoja (npr. agilni pristup razvoju)
	u web okruženjima posebice u kontekstu Internet stvari.ostojećih
	web programskih okvira za korisničko sučelje (npr. Angular,
	Bootstrap i dr.) i njihove primjene u različitih web sustavima
</li></ul>
<!-- /wp:list -->

<!-- wp:paragraph -->
<p> </p>
<!-- /wp:paragraph -->

<!-- wp:paragraph {\"align\":\"center\",\"fontSize\":\"regular\"} -->
<p style=\"text-align:center\" class=\"has-regular-font-size\"><strong> Plan rada</strong></p>
<!-- /wp:paragraph -->

<!-- wp:list -->
<ul><li>godišnje
	objaviti i prezentrati barem dva stručna rada iz područja rada
	Laboratorija na domaćim stručnim konferencijama i savjetovanjima
	</li><li>godišnje
	objaviti i prezentrati barem dva znanstvena rada iz područja rada
	Laboratorija na međunarodnim znanstvenim konferencijama
	</li><li>godišnje
	objaviti barem dva znanstvena rada iz područja rada Laboratorija u
	međunarodnim znanstvenim časopisima
	</li><li>godišnje
	organizirati barem jednu radionicu (ljetnu školu) iz područja rada
	Laboratorija za studente FOI
	</li><li>podržati
	i modernizirati nastavni plan i program postojećih kolegija koje
	izvode članovi Laboratorija (Web dizajn i programiranje, Napredne
	web tehnologije i servisi, Uzorci dizajna, Sustavi za elektroničko
	učenje, Izgradnja web aplikacija, Multimedijski sustavi) 
	
	</li><li>predložiti
	najmanje jedan novi kolegij na preddiplomskoj, diplomskoj i/ili
	poslijediplomskoj razini koji će dopuniti postojeći nastavni plan
	i program na Fakultetu organizacije i informatike
	</li><li>predložiti
	novi modul na preddiplomskoj i/ili diplomskoj razini u području web
	i mobilnih tehnologija u suradnji s drugim laboratorijima na
	Fakultetu organizacije i informatike
	</li><li>godišnje
	sudjelovati u barem jednoj prijavi projekta u različitim shemama
	financiranja za prikupljanje sredstava za istraživačke projekte,
	projekte dokaza koncepta posebnih web tehnologija i web razvojnih
	projekata.
</li></ul>
<!-- /wp:list -->';
        $output="O Laboratoriju\nLaboratorij ima za opći cilj spojiti istraživanja, razvoj industrijskih projekata i edukaciju u području Web arhitektura, tehnologija, servisa i sučelja.\n";
        $this->assertEquals($output,$this->htmlParser->getParsedData($input));
    }
}
