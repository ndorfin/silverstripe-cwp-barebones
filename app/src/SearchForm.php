<?php

namespace BareBones;

use SilverStripe\Control\Controller;
use SilverStripe\FullTextSearch\Search\FullTextSearch;
use SilverStripe\FullTextSearch\Search\Queries\SearchQuery;
use SilverStripe\FullTextSearch\Solr\SolrIndex;

class SearchForm extends \SilverStripe\CMS\Search\SearchForm
{

    /**
     * Overrides search form properties
     *
     * @return array
     */
    public function getAttributes()
    {
        $this->setFormAction('/search/SearchForm');
        $this->addExtraClass('search__form');

        $attrs = array_merge(
            parent::getAttributes(),
            ['id' => 'BareBones_' . $this->FormName()],
            $this->attributes
        );

        return $attrs;
    }

    /**
     * Get the search query for display in a "You searched for ..." sentence.
     *
     * @return string
     */
    public function SearchQuery()
    {
        return Controller::curr()->getRequest()->getVar('Search');
    }

    public function getResults()
    {
        // Get request data from request handler
        $request = $this->getRequestHandler()->getRequest();

        $searchTerms = $request->requestVar('Search');
        $query = SearchQuery::create()->addSearchTerm($searchTerms);

        if ($start = $request->requestVar('start')) {
            $query->setStart($start);
        }

        $params = [
            'spellcheck' => 'true',
            'spellcheck.collate' => 'true'
        ];

        // Get the first index
        $indexClasses = FullTextSearch::get_indexes(SolrIndex::class);
        $indexClass = reset($indexClasses);

        /** @var SolrIndex $index */
        $index = $indexClass::singleton();
        $results = $index->search($query, -1, -1, $params);

        return $results;
    }
}
