<?php
    include_once "sparql_base.php";

    function getLabel($subject) {
        $query = constructQuery($subject,
            "rdfs:label ?label .
            FILTER (lang(?label) = 'en')");

        return getSearchUrl($query);
    }

    function getBirthYear($subject) {
        $query = constructQuery($subject,
            "dbo:birthYear ?birthYear");

        return getSearchUrl($query);
    }

    function getAbstract($subject) {
        $query = constructQuery($subject,
            "dbo:abstract ?abstract .
            FILTER(LANG(?abstract) = '".SparqlEnum::LANG."' || LANGMATCHES(LANG(?abstract), 'en'))");

        return getSearchUrl($query);
    }

    function getDepiction($subject) {
        $query = constructQuery($subject,
            "foaf:depiction ?depiction");

        return getSearchUrl($query);
    }

    function getMovieByWikipediaID($id) {
        $query = SparqlEnum::PREFIX.
            "SELECT DISTINCT ?film ?label ?abstract ?wikiLink ?producer ?released ?director ?distributor ?compositor ?actor ?comment
            WHERE {
                { ?film a movie:film } UNION { ?film a dbo:Film }
                ?film dbo:wikiPageID ?wiki .
                ?film rdfs:label ?label .
                OPTIONAL { {?film dbp:released ?released} UNION {?film prop-fr:annéeDeSortie ?released} } .
                OPTIONAL { ?film dbo:abstract ?abstract } .
                OPTIONAL { ?film foaf:isPrimaryTopicOf ?wikiLink } .
                OPTIONAL { ?film dbp:producer ?producer } .
                OPTIONAL { ?film dbo:director ?director } .
                OPTIONAL { ?film dbo:distributor ?distributor } .
                OPTIONAL { ?film dbo:musicComposer ?compositor } .
                OPTIONAL { ?film dbo:starring ?actor } .
                OPTIONAL { ?film rdfs:comment ?comment } .
                FILTER REGEX(?wiki, '".$id."') .
                FILTER (lang(?label) = 'en') .
                FILTER (lang(?abstract) = '".SparqlEnum::LANG."') .
                FILTER (lang(?comment) = '".SparqlEnum::LANG."') .
            }
            LIMIT 1";

//        FILTER(LANG(?abstract) = '".SparqlEnum::LANG."' || LANGMATCHES(LANG(?abstract), 'en')) .
//        FILTER(LANG(?comment) = '".SparqlEnum::LANG."' || LANGMATCHES(LANG(?comment), 'en')) .

        return getSearchUrl($query);
    }

    function getActorsByWikipediaID($id) {

    $query = SparqlEnum::PREFIX .
        "SELECT DISTINCT ?idActor ?actor
            WHERE {
                { ?film a movie:film } UNION { ?film a dbo:Film } 
                ?film dbo:wikiPageID ?wiki . 
                ?film rdfs:label ?label .
                OPTIONAL { {?film dbp:released ?released} UNION {?film prop-fr:annÃ©eDeSortie ?released} } . 
                OPTIONAL { ?film dbo:abstract ?abstract } . OPTIONAL { ?film foaf:isPrimaryTopicOf ?wikiLink } . 
                OPTIONAL { ?film dbp:producer ?producer } . 
                OPTIONAL { ?film dbo:director ?director } . OPTIONAL { ?film dbo:distributor ?distributor } . 
                OPTIONAL { ?film dbo:musicComposer ?compositor } . 
                OPTIONAL { ?film dbo:starring ?actor } . 
                OPTIONAL { ?film rdfs:comment ?comment } . 
                FILTER REGEX(?wiki, '" . $id . "') . 
                FILTER (lang(?label) = 'en') . 
                FILTER (lang(?abstract) = '" . SparqlEnum::LANG . "') . 
                FILTER (lang(?comment) = '" . SparqlEnum::LANG . "') . 
                ?actor dbo:wikiPageID ?idActor .
                } 
                LIMIT 10";

    echo $query;
    return getSearchUrl($query);
}

    function getMoviesByDirector($subject, $limit){

        $subject = removeUrl($subject);

        $query = SparqlEnum::PREFIX.
            "SELECT DISTINCT ?film ?wiki ?label
            WHERE {
                { ?film a movie:film } UNION { ?film a dbo:Film }
                ?film dbo:director ?director .
                ?film rdfs:label ?label .
                ?film dbo:wikiPageID ?wiki .
                FILTER REGEX(?director, '".$subject."') .
                FILTER (lang(?label) = 'en') .
            }
            LIMIT ".$limit;

        return getSearchUrl($query);
    }

    function getMoviesByProducer($subject, $limit) {
        $subject = removeUrl($subject);

        $query = SparqlEnum::PREFIX.
            "SELECT DISTINCT ?film ?wiki ?label
                WHERE {
                    { ?film a movie:film } UNION { ?film a dbo:Film }
                    ?film dbp:producer ?producer .
                    ?film rdfs:label ?label .
                    ?film dbo:wikiPageID ?wiki .
                    FILTER REGEX(?producer, '".$subject."') .
                    FILTER (lang(?label) = 'en') .
                }
                LIMIT ".$limit;

        return getSearchUrl($query);
    }

    function getMoviesByActor($subject, $limit) {
        $subject = removeUrl($subject);

        $query = SparqlEnum::PREFIX.
            "SELECT DISTINCT ?film ?wiki ?label 
            WHERE { 
                { ?film a movie:film } UNION { ?film a dbo:Film } 
                ?film dbp:starring ?actor. 
                ?film rdfs:label ?label . 
                ?film dbo:wikiPageID ?wiki . 
                FILTER REGEX(?actor, '" . $subject . "') . 
                FILTER (lang(?label) = 'en') . 
            } 
            LIMIT " . $limit;

        return getSearchUrl($query);
    }
?>