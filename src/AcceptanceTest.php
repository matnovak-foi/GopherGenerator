<?php

declare(strict_types=1);
include_once("HTMLParser.php");
include_once("GopherPageCreator.php");

use PHPUnit\Framework\TestCase;

class AcceptanceTest extends TestCase
{
    private $htmlParser;
    private $input='<!-- wp:heading {\"level\":1,\"align\":\"center\"} -->
<h1 style=\"text-align:center\">O Laboratoriju</h1>
<!-- /wp:heading -->

<!-- wp:paragraph {\"align\":\"left\",\"fontSize\":\"regular\"} -->
<p style=\"text-align:left\" class=\"has-regular-font-size\"><strong>Laboratorij ima za opći cilj spojiti istraživanja, razvoj industrijskih projekata i edukaciju u području Web arhitektura, tehnologija, servisa i sučelja. </strong></p>
<!-- /wp:paragraph -->

<!-- wp:paragraph {\"align\":\"center\",\"fontSize\":\"regular\"} -->
<p style=\"text-align:center\" class=\"has-regular-font-size\"><strong> Pojedinačni ciljevi su sljedeći</strong></p>
<!-- /wp:paragraph -->

<!-- wp:list -->
<ul><li>podržati i modernizirati nastavni plan i program postojećih kolegija koje izvode članovi Laboratorija (Web dizajn i programiranje, Napredne web tehnologije i servisi, Uzorci dizajna, Sustavi za elektroničko učenje, Izgradnja web aplikacija, Multimedijski sustavi) 

	</li><li>predložiti nove kolegije na preddiplomskoj, diplomskoj i/ili poslijediplomskoj razini koji će dopuniti postojeći nastavni plan i program na Fakultetu organizacije i informatike
	</li></ul>
<!-- /wp:list -->

<!-- wp:paragraph -->
<p> </p>
<!-- /wp:paragraph -->

<!-- wp:paragraph {\"align\":\"center\",\"fontSize\":\"regular\"} -->
<p style=\"text-align:center\" class=\"has-regular-font-size\"><strong> Plan rada</strong></p>
<!-- /wp:paragraph -->

<!-- wp:list -->
<ul><li>godišnje objaviti i prezentrati barem dva stručna rada iz područja rada Laboratorija na domaćim stručnim konferencijama i savjetovanjima
	</li><li>godišnje objaviti i prezentrati barem dva znanstvena rada iz područja rada Laboratorija na međunarodnim znanstvenim konferencijama
	</li><li>godišnje objaviti barem dva znanstvena rada iz područja rada Laboratorija u međunarodnim znanstvenim časopisima
	</li></ul>
<!-- /wp:list -->';
private $output="O Laboratoriju\nLaboratorij ima za opći cilj spojiti istraživanja, razvoj industrijskih projekata i edukaciju u području Web arhitektura, tehnologija, servisa i sučelja.
Pojedinačni ciljevi su sljedeći
- podržati i modernizirati nastavni plan i program postojećih kolegija koje izvode članovi Laboratorija (Web dizajn i programiranje, Napredne web tehnologije i servisi, Uzorci dizajna, Sustavi za elektroničko učenje, Izgradnja web aplikacija, Multimedijski sustavi)
- predložiti nove kolegije na preddiplomskoj, diplomskoj i/ili poslijediplomskoj razini koji će dopuniti postojeći nastavni plan i program na Fakultetu organizacije i informatike
Plan rada
- godišnje objaviti i prezentrati barem dva stručna rada iz područja rada Laboratorija na domaćim stručnim konferencijama i savjetovanjima
- godišnje objaviti i prezentrati barem dva znanstvena rada iz područja rada Laboratorija na međunarodnim znanstvenim konferencijama
- godišnje objaviti barem dva znanstvena rada iz područja rada Laboratorija u međunarodnim znanstvenim časopisima";

    public function setUp(): void{
        $this->htmlParser = new HTMLParser();
    }

    public function testGivenHTMLTextWhenGetParsedDataThenReturnOnlyText(): void {
        $this->assertEquals($this->output,$this->htmlParser->getParsedData($this->input));
    }

    public function testGivenHTMLTextWhenGetParsedDataAndGenerateGopherPageThenReturnGopherPageWithText(): void {
        $output = $this->htmlParser->getParsedData($this->input);
        $gopherPageCreator = new GopherPageCreator("testFiles/");
        $gopherPageCreator->createPage($output,"PostTitle");
        $fileFullPath="testFiles/PostTitle";
        $file = fopen($fileFullPath,"r");
        $textFromFile = fread($file,filesize($fileFullPath));
        fclose($file);
        $this->assertEquals($this->output,$textFromFile);
        unlink($fileFullPath);
    }
}
