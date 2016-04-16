<?php
    include_once "sparql_base.php";

    function getBirthName($subject) {
        $query = constructQuery($subject,
            "dbo:birthName ?birthName");

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
            "SELECT DISTINCT ?film ?label ?abstract ?released ?wikiLink
            WHERE {
                { ?film a movie:film } UNION { ?film a dbo:Film }
                ?film dbo:wikiPageID ?wiki .
                ?film rdfs:label ?label .
                OPTIONAL {
                ?film dbp:released ?released .
                ?film dbo:abstract ?abstract .
                ?film foaf:isPrimaryTopicOf ?wikiLink
                }
                FILTER REGEX(?wiki, '".$id."') .
                FILTER (lang(?label) = 'fr') .
                FILTER (lang(?abstract) = 'fr') .
            }
            LIMIT 1";

        return getSearchUrl($query);
    }

    function getMovies($subject) {
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
            LIMIT 100";

        return getSearchUrl($query);
    }
?>