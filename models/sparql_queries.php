<?php
    include_once "sparql_base.php";

    function getLabel($subject) {
        $query = constructQuery($subject,
            "rdfs:label ?label .
            OPTIONAL { ?label xml:lang ?lang . FILTER (?lang='fr') }");
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
            FILTER (LANG(?abstract)='fr')");

        return getSearchUrl($query);
    }

    function getDepiction($subject) {
        $query = constructQuery($subject,
            "foaf:depiction ?depiction");

        return getSearchUrl($query);
    }

    function getMovieByWikipediaID($id) {
        $query = SparqlEnum::PREFIX.
            "SELECT DISTINCT ?film ?label ?abstract ?wikiLink ?producer ?released ?director ?distributor ?compositor ?actor
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
                FILTER REGEX(?wiki, '".$id."') .
                FILTER (lang(?label) = 'fr') .
                FILTER (lang(?abstract) = 'fr') .
            }
            LIMIT 1";

        return getSearchUrl($query);
    }

    function getMoviesByDirector($subject, $limit) {
        $query = SparqlEnum::PREFIX.
            "SELECT DISTINCT ?film ?wiki ?label
            WHERE {
                { ?film a movie:film } UNION { ?film a dbo:Film }
                ?film dbo:director ?director .
                ?film rdfs:label ?label .
                ?film dbo:wikiPageID ?wiki .
                FILTER REGEX(?director, '".$subject."') .
                FILTER (lang(?label) = 'fr') .
            }
            LIMIT ".$limit;

        return getSearchUrl($query);
    }

    function getMoviesByProducer($subject, $limit) {
        $query = SparqlEnum::PREFIX.
            "SELECT DISTINCT ?film ?wiki ?label
                WHERE {
                    { ?film a movie:film } UNION { ?film a dbo:Film }
                    ?film dbp:producer ?producer .
                    ?film rdfs:label ?label .
                    ?film dbo:wikiPageID ?wiki .
                    FILTER REGEX(?producer, '".$subject."') .
                    FILTER (lang(?label) = 'fr') .
                }
                LIMIT ".$limit;

        return getSearchUrl($query);
    }
?>