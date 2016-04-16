<?php
/*
Template Name: robert
*/
?>
<script src='https://www.google.com/recaptcha/api.js'></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>





		<div class="clear"></div>
	<div class="gdlr-content">

		<!-- Above Sidebar Section-->
		<?php global $gdlr_post_option, $above_sidebar_content, $with_sidebar_content, $below_sidebar_content; ?>
		<?php if(!empty($above_sidebar_content)){ ?>
			<div class="above-sidebar-wrapper"><?php gdlr_print_page_builder($above_sidebar_content); ?></div>
		<?php } ?>
		
		<!-- Sidebar With Content Section-->
		<?php 
			if( !empty($gdlr_post_option['sidebar']) && ($gdlr_post_option['sidebar'] != 'no-sidebar' )){
				global $gdlr_sidebar;
				
				$gdlr_sidebar = array(
					'type'=>$gdlr_post_option['sidebar'],
					'left-sidebar'=>$gdlr_post_option['left-sidebar'], 
					'right-sidebar'=>$gdlr_post_option['right-sidebar']
				); 
				$gdlr_sidebar = gdlr_get_sidebar_class($gdlr_sidebar);
		?>
			<div class="with-sidebar-wrapper">
				<div class="with-sidebar-container container">
					<div class="with-sidebar-left <?php echo $gdlr_sidebar['outer']; ?> columns">
						<div class="with-sidebar-content <?php echo $gdlr_sidebar['center']; ?> columns">
							<?php 
								if( !empty($with_sidebar_content) ){
									gdlr_print_page_builder($with_sidebar_content, false);
								}
								if( !empty($gdlr_post_option['show-content']) && $gdlr_post_option['show-content'] != 'disable' ){
									get_template_part('single/content', 'page');
								}
							?>							
						</div>
						<?php get_sidebar('left'); ?>
						<div class="clear"></div>
					</div>
					<?php get_sidebar('right'); ?>
					<div class="clear"></div>
				</div>				
			</div>				
		<?php 
			}else{ 
				if( !empty($with_sidebar_content) ){ 
					echo '<div class="with-sidebar-wrapper">';
					gdlr_print_page_builder($with_sidebar_content);
					echo '</div>';
				}
				if( empty($gdlr_post_option['show-content']) || $gdlr_post_option['show-content'] != 'disable' ){
					//get_template_part('single/content', 'page');
				}
			} 
		?>

		
		<!-- Below Sidebar Section-->
		<?php if(!empty($below_sidebar_content)){ ?>
			<div class="below-sidebar-wrapper"><?php gdlr_print_page_builder($below_sidebar_content); ?></div>
		<?php } ?>

		
	</div><!-- gdlr-content -->
	

<?php 
/*
require_once('sparqllib.php');
$db = sparql_connect('http://dbpedia.org/sparql');
$query = "SELECT ?obje
WHERE { <http://dbpedia.org/resource/Lionel_Messi> <http://dbpedia.org/property/clubs> ?obje }";

$result = sparql_query($query);
$fields = sparql_field_array($result);
while($row = sparql_fetch_array($result))
{
  foreach($fields as $field)
  {
	print $row[$field] "\n";
  }
}
*/
?>


<?php 

function getUrlDbpediaAbstract($term)
{
   $format = 'json';
   
   
   
   
 if ( "Franck Ribéry" == "Arjen Robben" || "Franck Ribéry" == "Franck Ribéry" ){
    $query = 
 "PREFIX dbp: <http://dbpedia.org/resource/>
prefix dbpedia-owl: <http://dbpedia.org/ontology/>
PREFIX dbpedia2: <http://dbpedia.org/property/>
PREFIX xsd: <http://www.w3.org/2001/XMLSchema#> 
select DISTINCT count(?clubs) as ?nbclubs, ?currentclubbb, ?currentclubb, ?abstract, ?goals, ?currentclub, ?birthDate where { 
  dbp:".$term." dbpedia-owl:abstract ?abstract . FILTER(LANG(?abstract) = 'fr') .
  dbp:".$term." dbpedia2:birthDate ?birthDate .
  dbp:".$term." dbpedia2:clubs ?clubs .
  dbp:".$term." dbpedia2:goals ?goals .
  dbp:".$term." dbpedia2:currentclub ?currentclub .
bind( strafter(str(?currentclub),'http://dbpedia.org/resource/') as ?currentclubb)
bind(replace(?currentclubb,'_',' ') as ?currentclubbb)
 }";
 }
 else if ( "Franck Ribéry" == "Arturo Vidal" ){
	$query = 
   "   
   PREFIX dbp: <http://dbpedia.org/resource/>
prefix dbpedia-owl: <http://dbpedia.org/ontology/>
PREFIX dbpedia2: <http://dbpedia.org/property/>
PREFIX xsd: <http://www.w3.org/2001/XMLSchema#> 
select DISTINCT count(?clubs) as ?nbclubs, ?equipe, ?currentclubbb, ?currentclubb, ?abstract, ?goals, ?currentclub, ?birthDate, ?annee,xsd:integer(?butt) as ?but, ?nbmatch, ?pName, xsd:date(?yearss) as ?years  where { 
  <http://dbpedia.org/resource/Arturo_Vidal> dbpedia-owl:abstract ?abstract . FILTER(LANG(?abstract) = 'fr') .

  <http://dbpedia.org/resource/Arturo_Vidal> dbpedia2:birthDate ?birthDate ;
   dbpedia2:clubs ?clubs ;
   dbpedia2:goals ?goals ;
   dbpedia2:currentclub ?currentclub .
  
  values ?player { <http://dbpedia.org/resource/Arturo_Vidal> }
     ?player dbpedia-owl:careerStation [ dbpedia-owl:numberOfGoals ?butt ; dbpedia-owl:numberOfMatches ?nbmatch ; dbpedia-owl:team ?team ; dbpedia-owl:years ?yearss ].
bind( strafter(str(?team),'http://dbpedia.org/resource/') as ?pName)
bind(year(?yearss) as ?annee)
bind(replace(?pName,'_',' ') as ?equipe)
bind( strafter(str(?currentclub),'http://dbpedia.org/resource/') as ?currentclubb)
bind(replace(?currentclubb,'_',' ') as ?currentclubbb)
}";
}  else if ( "Franck Ribéry" == "Sebastian Rode" ){
	$query = 
   "   
   PREFIX dbp: <http://dbpedia.org/resource/>
prefix dbpedia-owl: <http://dbpedia.org/ontology/>
PREFIX dbpedia2: <http://dbpedia.org/property/>
PREFIX xsd: <http://www.w3.org/2001/XMLSchema#> 
select DISTINCT count(?clubs) as ?nbclubs, ?equipe, ?currentclubbb, ?currentclubb, ?abstract, ?goals, ?currentclub, ?birthDate, ?annee,xsd:integer(?butt) as ?but, ?nbmatch, ?pName, xsd:date(?yearss) as ?years  where { 
  <http://dbpedia.org/resource/Sebastian_Rode> dbpedia-owl:abstract ?abstract . FILTER(LANG(?abstract) = 'fr') .

  <http://dbpedia.org/resource/Sebastian_Rode> dbpedia2:birthDate ?birthDate ;
   dbpedia2:clubs ?clubs ;
   dbpedia2:goals ?goals ;
   dbpedia2:currentclub ?currentclub .
  
  values ?player { <http://dbpedia.org/resource/Sebastian_Rode> }
     ?player dbpedia-owl:careerStation [ dbpedia-owl:numberOfGoals ?butt ; dbpedia-owl:numberOfMatches ?nbmatch ; dbpedia-owl:team ?team ; dbpedia-owl:years ?yearss ].
bind( strafter(str(?team),'http://dbpedia.org/resource/') as ?pName)
bind(year(?yearss) as ?annee)
bind(replace(?pName,'_',' ') as ?equipe)
bind( strafter(str(?currentclub),'http://dbpedia.org/resource/') as ?currentclubb)
bind(replace(?currentclubb,'_',' ') as ?currentclubbb)
}";
}  else if ( "Franck Ribéry" == "Philipp Lahm" ){
	$query = 
   "   
   PREFIX dbp: <http://dbpedia.org/resource/>
prefix dbpedia-owl: <http://dbpedia.org/ontology/>
PREFIX dbpedia2: <http://dbpedia.org/property/>
PREFIX xsd: <http://www.w3.org/2001/XMLSchema#> 
select DISTINCT count(?clubs) as ?nbclubs, ?equipe, ?currentclubbb, ?currentclubb, ?abstract, ?goals, ?currentclub, ?birthDate, ?annee,xsd:integer(?butt) as ?but, ?nbmatch, ?pName, xsd:date(?yearss) as ?years  where { 
  <http://dbpedia.org/resource/Philipp_Lahm> dbpedia-owl:abstract ?abstract . FILTER(LANG(?abstract) = 'fr') .

  <http://dbpedia.org/resource/Philipp_Lahm> dbpedia2:birthDate ?birthDate ;
   dbpedia2:clubs ?clubs ;
   dbpedia2:goals ?goals ;
   dbpedia2:currentclub ?currentclub .
  
  values ?player { <http://dbpedia.org/resource/Philipp_Lahm> }
     ?player dbpedia-owl:careerStation [ dbpedia-owl:numberOfGoals ?butt ; dbpedia-owl:numberOfMatches ?nbmatch ; dbpedia-owl:team ?team ; dbpedia-owl:years ?yearss ].
bind( strafter(str(?team),'http://dbpedia.org/resource/') as ?pName)
bind(year(?yearss) as ?annee)
bind(replace(?pName,'_',' ') as ?equipe)
bind( strafter(str(?currentclub),'http://dbpedia.org/resource/') as ?currentclubb)
bind(replace(?currentclubb,'_',' ') as ?currentclubbb)
}";
}  else if ( "Franck Ribéry" == "David Alaba" ){
	$query = 
   "   
   PREFIX dbp: <http://dbpedia.org/resource/>
prefix dbpedia-owl: <http://dbpedia.org/ontology/>
PREFIX dbpedia2: <http://dbpedia.org/property/>
PREFIX xsd: <http://www.w3.org/2001/XMLSchema#> 
select DISTINCT count(?clubs) as ?nbclubs, ?equipe, ?currentclubbb, ?currentclubb, ?abstract, ?goals, ?currentclub, ?birthDate, ?annee,xsd:integer(?butt) as ?but, ?nbmatch, ?pName, xsd:date(?yearss) as ?years  where { 
  <http://dbpedia.org/resource/David_Alaba> dbpedia-owl:abstract ?abstract . FILTER(LANG(?abstract) = 'fr') .

  <http://dbpedia.org/resource/David_Alaba> dbpedia2:birthDate ?birthDate ;
   dbpedia2:clubs ?clubs ;
   dbpedia2:goals ?goals ;
   dbpedia2:currentclub ?currentclub .
  
  values ?player { <http://dbpedia.org/resource/David_Alaba> }
     ?player dbpedia-owl:careerStation [ dbpedia-owl:numberOfGoals ?butt ; dbpedia-owl:numberOfMatches ?nbmatch ; dbpedia-owl:team ?team ; dbpedia-owl:years ?yearss ].
bind( strafter(str(?team),'http://dbpedia.org/resource/') as ?pName)
bind(year(?yearss) as ?annee)
bind(replace(?pName,'_',' ') as ?equipe)
bind( strafter(str(?currentclub),'http://dbpedia.org/resource/') as ?currentclubb)
bind(replace(?currentclubb,'_',' ') as ?currentclubbb)
}";
}  else if ( "Franck Ribéry" == "Franck Ribéry" ){
	$query = 
   "   
   PREFIX dbp: <http://dbpedia.org/resource/>
prefix dbpedia-owl: <http://dbpedia.org/ontology/>
PREFIX dbpedia2: <http://dbpedia.org/property/>
PREFIX xsd: <http://www.w3.org/2001/XMLSchema#> 
select DISTINCT count(?clubs) as ?nbclubs, ?equipe, ?currentclubbb, ?currentclubb, ?abstract, ?goals, ?currentclub, ?birthDate, ?annee,xsd:integer(?butt) as ?but, ?nbmatch, ?pName, xsd:date(?yearss) as ?years  where { 
  <http://dbpedia.org/resource/Franck_Ribéry> dbpedia-owl:abstract ?abstract . FILTER(LANG(?abstract) = 'fr') .

  <http://dbpedia.org/resource/Franck_Ribéry> dbpedia2:birthDate ?birthDate ;
   dbpedia2:clubs ?clubs ;
   dbpedia2:goals ?goals ;
   dbpedia2:currentclub ?currentclub .
  
  values ?player { <http://dbpedia.org/resource/Franck_Ribéry> }
     ?player dbpedia-owl:careerStation [ dbpedia-owl:numberOfGoals ?butt ; dbpedia-owl:numberOfMatches ?nbmatch ; dbpedia-owl:team ?team ; dbpedia-owl:years ?yearss ].
bind( strafter(str(?team),'http://dbpedia.org/resource/') as ?pName)
bind(year(?yearss) as ?annee)
bind(replace(?pName,'_',' ') as ?equipe)
bind( strafter(str(?currentclub),'http://dbpedia.org/resource/') as ?currentclubb)
bind(replace(?currentclubb,'_',' ') as ?currentclubbb)
}";
}  else if ( "Franck Ribéry" == "Bayern Munich" ){
	$query = 
   "   
   PREFIX dbp: <http://dbpedia.org/resource/>
prefix dbpedia-owl: <http://dbpedia.org/ontology/>
PREFIX dbpedia2: <http://dbpedia.org/property/>
PREFIX xsd: <http://www.w3.org/2001/XMLSchema#> 

select DISTINCT ?ppleague, ?ppmanager, ?ppground, xsd:integer(?capacity) as ?capacityy , ?abstract  where { 
  dbp:FC_Bayern_Munich dbpedia-owl:abstract ?abstract . FILTER(LANG(?abstract) = 'fr')
  dbp:FC_Bayern_Munich dbpedia-owl:capacity ?capacity ;
dbpedia-owl:league ?league ;
dbpedia-owl:manager ?manager ;
dbpedia-owl:ground ?ground .
bind( strafter(str(?league),'http://dbpedia.org/resource/') as ?pleague)
bind( strafter(str(?manager),'http://dbpedia.org/resource/') as ?pmanager)
bind( strafter(str(?ground),'http://dbpedia.org/resource/') as ?pground)
bind(replace(?pleague,'_',' ') as ?ppleague)
bind(replace(?pmanager,'_',' ') as ?ppmanager)
bind(replace(?pground,'_',' ') as ?ppground)
}";
}
 else {
   $query = 
   "PREFIX dbp: <http://dbpedia.org/resource/>
prefix dbpedia-owl: <http://dbpedia.org/ontology/>
PREFIX dbpedia2: <http://dbpedia.org/property/>
PREFIX xsd: <http://www.w3.org/2001/XMLSchema#> 
select DISTINCT count(?clubs) as ?nbclubs, ?equipe, ?currentclubbb, ?currentclubb, ?abstract, ?alias, ?goals, ?currentclub, ?birthDate, ?annee,xsd:integer(?butt) as ?but, ?nbmatch, ?pName, xsd:date(?yearss) as ?years  where { 
  dbp:".$term." dbpedia-owl:abstract ?abstract . FILTER(LANG(?abstract) = 'fr') .
  dbp:".$term." dbpedia-owl:alias ?alias .
  dbp:".$term." dbpedia2:birthDate ?birthDate .
  dbp:".$term." dbpedia2:clubs ?clubs .
  dbp:".$term." dbpedia2:goals ?goals .
  dbp:".$term." dbpedia2:currentclub ?currentclub .
  
  values ?player { dbp:".$term." }
     ?player dbpedia-owl:careerStation [ dbpedia-owl:numberOfGoals ?butt ; dbpedia-owl:numberOfMatches ?nbmatch ; dbpedia-owl:team ?team ; dbpedia-owl:years ?yearss ].
bind( strafter(str(?team),'http://dbpedia.org/resource/') as ?pName)
bind(year(?yearss) as ?annee)
bind(replace(?pName,'_',' ') as ?equipe)
bind( strafter(str(?currentclub),'http://dbpedia.org/resource/') as ?currentclubb)
bind(replace(?currentclubb,'_',' ') as ?currentclubbb)
}";
 }
   $searchUrl = 'http://dbpedia.org/sparql?'
      .'query='.urlencode($query)
      .'&format='.$format;
	  
   return $searchUrl;
}

function request($url){
 
   // is curl installed?
   if (!function_exists('curl_init')){ 
      die('CURL is not installed!');
   }
 
   // get curl handle
   $ch= curl_init();
 
   // set request url
   curl_setopt($ch, 
      CURLOPT_URL, 
      $url);
 
   // return response, don't print/echo
   curl_setopt($ch, 
      CURLOPT_RETURNTRANSFER, 
      true);
 
   /*
   Here you find more options for curl:
   http://www.php.net/curl_setopt
   */		
 
   $response = curl_exec($ch);
 
   curl_close($ch);
 
   return $response;
}
function printArray($array, $spaces = "")
{
   $retValue = "";
	
   if(is_array($array))
   {	
      $spaces = $spaces
         ."&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;";
      $retValue = $retValue."<br/>";
      foreach(array_keys($array) as $key)
      {
         $retValue = $retValue.$spaces
            ."<strong>".$key."</strong>"
            .printArray($array[$key], 
               $spaces);
      }		
      $spaces = substr($spaces, 0, -30);
   }
   else $retValue = 
      $retValue." - ".$array."<br/>";
	
   return $retValue;
}

if ( "Franck Ribéry" == "Robert Lewandowski" ) { 
	$term ="Robert_Lewandowski";
} elseif ( "Franck Ribéry" == "Arturo Vidal" ) {
	$term ="Arturo_Vidal";
} elseif ( "Franck Ribéry" == "Manuel Neuer" ) {
	$term ="Manuel_Neuer";
} elseif ( "Franck Ribéry" == "Tom Starke" ) {
	$term ="Tom_Starke";
} elseif ( "Franck Ribéry" == "Sven Ulreich" ) {
	$term ="Sven_Ulreich";
} elseif ( "Franck Ribéry" == "Mehdi Benatia" ) {
	$term ="Mehdi_Benatia";
} elseif ( "Franck Ribéry" == "Rafinha" ) {
	$term ="Rafael_Alcántara";
} elseif ( "Franck Ribéry" == "Jan Kirchhoff" ) {
	$term ="Jan_Kirchhoff";
} elseif ( "Franck Ribéry" == "Jérôme Boateng" ) {
	$term ="Jérôme_Boateng";
} elseif ( "Franck Ribéry" == "Juan Bernat" ) {
	$term ="Juan_Bernat";
} elseif ( "Franck Ribéry" == "Philipp Lahm" ) {
	$term ="Philipp_Lahm";
} elseif ( "Franck Ribéry" == "David Alaba" ) {
	$term ="David_Alaba";
} elseif ( "Franck Ribéry" == "Holger Badstuber" ) {
	$term ="Holger_Badstuber";
} elseif ( "Franck Ribéry" == "Franck Ribéry" ) {
	$term ="Franck_Ribéry";
} elseif ( "Franck Ribéry" == "Javi Martínez" ) {
	$term ="Javi_Mart%C3%ADnez";
} elseif ( "Franck Ribéry" == "Arjen Robben" ) {
	$term ="Arjen_Robben";
} elseif ( "Franck Ribéry" == "Xabi Alonso" ) {
	$term ="Xabi_Alonso";
} elseif ( "Franck Ribéry" == "Gianluca Gaudino" ) {
	$term ="Gianluca_Gaudino";
} elseif ( "Franck Ribéry" == "Mario Götze" ) {
	$term ="Mario_Götze";
} elseif ( "Franck Ribéry" == "Sebastian Rode" ) {
	$term ="Sebastian_Rode";
}  elseif ( "Franck Ribéry" == "Thomas Müller" ) {
	$term ="Thomas_Müller";
}
$requestURL = getUrlDbpediaAbstract($term);
$responseArray = json_decode(
	request($requestURL),
	true); 
?>
<div style="padding:5%">

<?php if ( "Franck Ribéry" == "Bayern Munich" ) { ?>

<h1>Un petit résumé </h1>
<?php echo $responseArray["results"]
   ["bindings"][0]
   ["abstract"]["value"] ?>
   <br/>
   
 Le manager du Bayern Munich est <?php echo $responseArray["results"]
   ["bindings"][0]
   ["ppmanager"]["value"] ?> . La league est la <?php echo $responseArray["results"]
   ["bindings"][0]
   ["ppleague"]["value"] ?> .Le stade est <?php echo $responseArray["results"]
   ["bindings"][0]
   ["ppground"]["value"] ?> et il contient <?php echo $responseArray["results"]
   ["bindings"][0]
   ["capacityy"]["value"] ?>  places.

<?php }	else { ?>
<h1>Biographie </h1>
<?php echo $responseArray["results"]
   ["bindings"][0]
   ["abstract"]["value"] ?>
   <br/>
 <?php if ( "Franck Ribéry" == "Robert Lewandowski" ) { ?>
<h1>Alias </h1> 
   Son surnom est : <?php echo $responseArray["results"]
   ["bindings"][0]
   ["alias"]["value"] ?>
   <br/>
 <?php } ?>
<h1>Date de naissance </h1> 
   Il est né le <?php echo $responseArray["results"]
   ["bindings"][0]
   ["birthDate"]["value"] ?>
   <br/>
<h1>Equipe</h1> 
   Il a eu <?php echo $responseArray["results"]
   ["bindings"][0]
   ["nbclubs"]["value"] ?> clubs
   <br/>
   Il joue au <?php echo $responseArray["results"]
   ["bindings"][0]
   ["currentclubbb"]["value"] ?> actuellement
   <h1>Carrière</h1> 
   Il a joué <?php echo $responseArray["results"]
   ["bindings"][0]
   ["equipe"]["value"] ?> au début des années <?php echo $responseArray["results"]
   ["bindings"][0]
   ["annee"]["value"] ?> où il a joué <?php echo $responseArray["results"]
   ["bindings"][0]
   ["nbmatch"]["value"] ?> matchs pour un total de <?php echo $responseArray["results"]
   ["bindings"][0]
   ["but"]["value"] ?> buts.
   <br/>
   Il a joué <?php echo $responseArray["results"]
   ["bindings"][4]
   ["equipe"]["value"] ?> au début des années <?php echo $responseArray["results"]
   ["bindings"][4]
   ["annee"]["value"] ?> où il a joué <?php echo $responseArray["results"]
   ["bindings"][4]
   ["nbmatch"]["value"] ?> matchs pour un total de <?php echo $responseArray["results"]
   ["bindings"][4]
   ["but"]["value"] ?> buts.
   <br/>
   Il a joué <?php echo $responseArray["results"]
   ["bindings"][8]
   ["equipe"]["value"] ?> au début des années <?php echo $responseArray["results"]
   ["bindings"][8]
   ["annee"]["value"] ?> où il a joué <?php echo $responseArray["results"]
   ["bindings"][8]
   ["nbmatch"]["value"] ?> matchs pour un total de <?php echo $responseArray["results"]
   ["bindings"][8]
   ["but"]["value"] ?> buts.
   <br/>
   Il a joué <?php echo $responseArray["results"]
   ["bindings"][12]
   ["equipe"]["value"] ?> au début des années <?php echo $responseArray["results"]
   ["bindings"][12]
   ["annee"]["value"] ?> où il a joué <?php echo $responseArray["results"]
   ["bindings"][12]
   ["nbmatch"]["value"] ?> matchs pour un total de <?php echo $responseArray["results"]
   ["bindings"][12]
   ["but"]["value"] ?> buts.
   <br/>
   Il a joué <?php echo $responseArray["results"]
   ["bindings"][15]
   ["equipe"]["value"] ?> au début des années <?php echo $responseArray["results"]
   ["bindings"][15]
   ["annee"]["value"] ?> où il a joué <?php echo $responseArray["results"]
   ["bindings"][15]
   ["nbmatch"]["value"] ?> matchs pour un total de <?php echo $responseArray["results"]
   ["bindings"][15]
   ["but"]["value"] ?> buts.
   <br/>
 </div>
<?php } ?>



