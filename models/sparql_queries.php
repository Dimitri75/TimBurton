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
        $query = "PREFIX imdb: <http://data.linkedmdb.org/resource/mobie/>
            SELECT ?movieName
            WHERE {
            ?director imdb:director_name ".$subject.".
            ?movie imdb:director ?director;
            <http://purl.org/dc/terms/title> ?movieName.
            }";

        return getSearchUrl($query);
    }
?>