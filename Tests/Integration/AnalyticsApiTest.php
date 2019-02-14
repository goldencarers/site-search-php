<?php
/**
 * This file is part of the Swiftype Site Search PHP Client package.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Swiftype\SiteSearch\Tests\Integration;

/**
 * Integration tests for the Search API.
 *
 * @package Swiftype\SiteSearch\Test\Integration
 *
 * @author  Aurélien FOUCRET <aurelien.foucret@elastic.co>
 */
class AnalyticsApiTest extends AbstractClientTestCase
{
    /**
     * Test count method for Engine Analytics API.
     *
     * @param string $method
     *
     * @testWith ["getEngineSearchCountAnalytics"]
     *           ["getEngineClicksCountAnalytics"]
     *           ["getEngineAutoselectsCountAnalytics"]
     */
    public function testEngineAnalyticsCountMethod($method)
    {
        $counts = self::getDefaultClient()->$method(self::getDefaultEngineName());

        foreach ($counts as list($date, $count)) {
            $this->assertNotFalse(\DateTime::createFromFormat('Y-m-d', $date));
            $this->assertInternalType('int', $count);
        }
    }

    /**
     * Test top queries method for Engine Analytics API.
     *
     * @param string $method
     *
     * @testWith ["getEngineTopQueriesAnalytics"]
     *           ["getEngineTopNoResultQueriesAnalytics"]
     */
    public function testEngineAnalyticsTopQueriesMethod($method)
    {
        $topQueries = self::getDefaultClient()->$method(self::getDefaultEngineName());

        foreach ($topQueries as list($queryText, $count)) {
            $this->assertInternalType('string', $queryText);
            $this->assertInternalType('int', $count);
        }
    }

    /**
     * Test count method for Document Types Analytics API.
     *
     * @param string $method
     *
     * @testWith ["getDocumentTypeSearchCountAnalytics"]
     *           ["getDocumentTypeClicksCountAnalytics"]
     *           ["getDocumentTypeAutoselectsCountAnalytics"]
     */
    public function testDocumentTypeAnalyticsCountMethod($method)
    {
        $counts = self::getDefaultClient()->$method(self::getDefaultEngineName(), 'page');

        foreach ($counts as list($date, $count)) {
            $this->assertNotFalse(\DateTime::createFromFormat('Y-m-d', $date));
            $this->assertInternalType('int', $count);
        }
    }

    /**
     * Test top queries method for Document Types Analytics API.
     *
     * @param string $method
     *
     * @testWith ["getDocumentTypeTopQueriesAnalytics"]
     *           ["getDocumentTypeTopNoResultQueriesAnalytics"]
     */
    public function testDocumentTypeAnalyticsTopQueriesMethod($method)
    {
        $topQueries = self::getDefaultClient()->$method(self::getDefaultEngineName(), 'page');

        foreach ($topQueries as list($queryText, $count)) {
            $this->assertInternalType('string', $queryText);
            $this->assertInternalType('int', $count);
        }
    }

    /**
     * Test calling the log clickthrough API.
     */
    public function testLogClickthrough()
    {
        $client = self::getDefaultClient();
        $engine = self::getDefaultEngineName();

        $searchResponse = $client->search($engine, 'search engine');
        $clickRecord = current($searchResponse['records']['page']);

        $this->assertEmpty($client->logClickthrough($engine, 'page', $clickRecord['external_id'], 'search engine'));
    }

    /**
     * @return string
     */
    protected static function getDefaultEngineName()
    {
        return 'kb-demo';
    }
}