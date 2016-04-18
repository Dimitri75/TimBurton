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

    function getMovieDetails($film) {
        $film = "<".$film.">";

        $query = SparqlEnum::PREFIX.
            "SELECT DISTINCT ?label ?abstractFr ?abstractEn ?commentFr ?commentEn ?wikiLink ?released ?director ?distributor ?compositor
            WHERE {
                ".$film." rdfs:label ?label .
                OPTIONAL { {".$film." dbp:released ?released} UNION {".$film." prop-fr:annéeDeSortie ?released} } .
                OPTIONAL {
                    { ".$film." dbo:abstract ?abstractFr . FILTER(LANG(?abstractFr) = '" . SparqlEnum::LANG ."') }
                    UNION
                    { ".$film." dbo:abstract ?abstractEn . FILTER(LANGMATCHES(LANG(?abstractEn), 'en')) }
                } .
                OPTIONAL {
                    { ".$film." rdfs:comment ?commentFr . FILTER(LANG(?commentFr) = '" . SparqlEnum::LANG . "') }
                    UNION
                    { ".$film." rdfs:comment ?commentEn . FILTER(LANGMATCHES(LANG(?commentEn), 'en')) }
                } .
                OPTIONAL { ".$film." foaf:isPrimaryTopicOf ?wikiLink } .
                OPTIONAL { ".$film." dbp:producer ?producer } .
                OPTIONAL { ".$film." dbo:director ?director } .
                OPTIONAL { ".$film." dbo:distributor ?distributor } .
                OPTIONAL { ".$film." dbo:musicComposer ?compositor } .
                OPTIONAL { ".$film." dbo:starring ?actor } .
                FILTER (lang(?label) = 'en') .
            }
            LIMIT 1";

        return getSearchUrl($query);
    }

    function getActorsByMovie($movie, $limit) {
        $query = SparqlEnum::PREFIX .
            "SELECT DISTINCT ?actor ?actorName
            WHERE {
                <" . $movie . "> dbo:starring ?actor .
                ?actor rdfs:label ?actorName .
                FILTER (lang(?actorName) = 'en') .
                } 
                LIMIT " . $limit;

        return getSearchUrl($query);
    }

    function getProducersByMovie($movie, $limit){
        $query = SparqlEnum::PREFIX .
            "SELECT DISTINCT ?producer ?producerName
            WHERE { 
                <" . $movie . "> dbp:producer ?producer .
                ?producer rdfs:label ?producerName .
                FILTER (LANG(?producerName) = 'en') .
            } 
            LIMIT " . $limit;

        return getSearchUrl($query);
    }

    function getMoviesByDirector($subject, $limit){
        $subject = removeUrl($subject);

        $query = SparqlEnum::PREFIX.
            "SELECT DISTINCT ?film ?label
            WHERE {
                { ?film a movie:film } UNION { ?film a dbo:Film }
                ?film dbo:director ?director .
                ?film rdfs:label ?label .
                FILTER REGEX(?director, '".$subject."') .
                FILTER (lang(?label) = 'en') .
            }
            LIMIT ".$limit;

        return getSearchUrl($query);
    }

    function getMoviesByProducer($subject, $limit) {
        $subject = removeUrl($subject);

        $query = SparqlEnum::PREFIX.
            "SELECT DISTINCT ?film ?label
                WHERE {
                    { ?film a movie:film } UNION { ?film a dbo:Film }
                    ?film dbp:producer ?producer .
                    ?film rdfs:label ?label .
                    FILTER REGEX(?producer, '".$subject."') .
                    FILTER (lang(?label) = 'en') .
                }
                LIMIT ".$limit;

        return getSearchUrl($query);
    }

    function getMoviesByActor($subject, $limit) {
        $subject = removeUrl($subject);

        $query = SparqlEnum::PREFIX.
            "SELECT DISTINCT ?film ?label
            WHERE { 
                { ?film a movie:film } UNION { ?film a dbo:Film } 
                ?film dbp:starring ?actor. 
                ?film rdfs:label ?label .
                FILTER REGEX(?actor, '" . $subject . "') .
                FILTER (lang(?label) = 'en') . 
            } 
            LIMIT " . $limit;

        return getSearchUrl($query);
    }

    function getMoviesByProducers($subject, $limit){
        $subject = removeUrl($subject);

        $filter = "";
        if(is_array($subject) && !empty($subject)) {
            $object = new ArrayObject($subject);
            $it = $object->getIterator();

            $filter = "FILTER (REGEX(?producer, '" . $it->current() . "')";
            $it->next();
            while ($it->valid()) {
                $filter = $filter . " || REGEX(?producer, '" . $it->current() . "')";
                $it->next();
            }
            $filter = $filter . ") .";
        }

        $query = SparqlEnum::PREFIX.
            "SELECT DISTINCT ?film ?label
                WHERE {
                    { ?film a movie:film } UNION { ?film a dbo:Film }
                    ?film dbp:producer ?producer .
                    ?film rdfs:label ?label .
                    ".$filter."
                    FILTER (lang(?label) = 'en') .
                }
                LIMIT ".$limit;

        return getSearchUrl($query);
    }
?>