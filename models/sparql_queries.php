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

    function getMovies($subject) {
        $query = SparqlEnum::PREFIX.
            "SELECT DISTINCT ?film
            WHERE {
            { ?film a movie:film } UNION { ?film a dbo:Film }
            ?film dbo:director ?director .
            FILTER REGEX(str(?director), "."'".$subject."'".")
            }
            LIMIT 100";

        return getSearchUrl($query);
    }
?>