<?php

use Tests\BrowserKitTestCase;

/**
 * Class SearchFormTest.
 */
class SearchFormTest extends BrowserKitTestCase
{
    public function testSearchPageWithNoQuery()
    {
        $this->actingAs($this->admin)
             ->visit('/admin/search');
        if( env('ENABLE_SIDEBAR_SEARCH', false) ){
            $this->seePageIs('/admin/dashboard')
                 ->see('Please enter a search term.');
        }
        else {
            $this->dontSeeElement('q');
        }
    }

    public function testSearchFormRedirectsToResults()
    {
        $this->actingAs($this->admin)
                 ->visit('/admin/dashboard');
        if( env('ENABLE_SIDEBAR_SEARCH', false) ){
            $this->type('Test Query', 'q')
                 ->press('search-btn')
                 ->seePageIs('/admin/search?q=Test%20Query')
                 ->see('Search Results for Test Query');
        } else {
            $this->dontSeeElement('q');
        }
    }
}
