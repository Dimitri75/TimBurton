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
        $query = SparqlEnum::PREFIX.
            "SELECT ?abstractFr ?abstractEn
            WHERE {
                { <" . $subject . "> dbo:abstract ?abstractFr . FILTER(LANG(?abstractFr) = '" . SparqlEnum::LANG ."') }
                UNION
                { <" . $subject . "> dbo:abstract ?abstractEn . FILTER(LANGMATCHES(LANG(?abstractEn), 'en')) }
            }";

        return getSearchUrl($query);
    }

    function getDepiction($subject) {
        $query = constructQuery($subject,
            "foaf:depiction ?depiction");

        return getSearchUrl($query);
    }

    function getMovieByWikipediaID($id) {
        $query = SparqlEnum::PREFIX.
            "SELECT DISTINCT ?film ?label ?abstractEn ?abstractFr ?wikiLink ?producer ?released ?director ?distributor ?compositor ?actor ?commentFr ?commentEn
            WHERE { 
                { ?film a movie:film } UNION { ?film a dbo:Film } ?film dbo:wikiPageID ?wiki . 
                ?film rdfs:label ?label . 
                OPTIONAL { {?film dbp:released ?released} UNION {?film prop-fr:annéeDeSortie ?released} } .
                OPTIONAL {
                    { ?film dbo:abstract ?abstractFr. FILTER(LANG(?abstractFr) = '" . SparqlEnum::LANG ."') }
                    UNION
                    { ?film dbo:abstract ?abstractEn . FILTER(LANGMATCHES(LANG(?abstractEn), 'en')) }
                } .
                OPTIONAL {
                    { ?film rdfs:comment ?commentFr . FILTER(LANG(?commentFr) = '" . SparqlEnum::LANG . "') }
                    UNION
                    { ?film rdfs:comment ?commentEn . FILTER(LANGMATCHES(LANG(?commentEn), 'en')) }
                } .
                OPTIONAL { ?film foaf:isPrimaryTopicOf ?wikiLink } . 
                OPTIONAL { ?film dbp:producer ?producer } . 
                OPTIONAL { ?film dbo:director ?director } . 
                OPTIONAL { ?film dbo:distributor ?distributor } . 
                OPTIONAL { ?film dbo:musicComposer ?compositor } . 
                OPTIONAL { ?film dbo:starring ?actor } . 
                FILTER REGEX(?wiki, '" . $id ."') .
                FILTER (lang(?label) = 'en') . 
            }
            LIMIT 1";

        return getSearchUrl($query);
    }

    function getActorsByWikipediaID($id, $limit) {

    $query = SparqlEnum::PREFIX .
        "SELECT DISTINCT ?idActor ?actor ?actorName
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
                ?actor rdfs:label ?actorName .
                FILTER REGEX(?wiki, '" . $id . "') . 
                FILTER (lang(?label) = 'en') . 
                FILTER (lang(?actorName) = 'en') .
                FILTER (lang(?abstract) = '" . SparqlEnum::LANG . "') . 
                FILTER (lang(?comment) = '" . SparqlEnum::LANG . "') . 
                ?actor dbo:wikiPageID ?idActor .
                } 
                LIMIT ".$limit;

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