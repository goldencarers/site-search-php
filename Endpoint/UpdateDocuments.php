<?php
/**
 * This file is part of the Elastic Site Search PHP Client package.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Elastic\SiteSearch\Client\Endpoint;

/**
 * Implementation of the UpdateDocuments endpoint.
 *
 * @package Elastic\SiteSearch\Client\Endpoint
 */
class UpdateDocuments extends \Elastic\OpenApi\Codegen\Endpoint\AbstractEndpoint
{
    // phpcs:disable
    /**
     * @var string
     */
    protected $method = 'PUT';

    /**
     * @var string
     */
    protected $uri = '/engines/{engine_name}/document_types/{document_type_id}/documents/bulk_update';

    protected $routeParams = ['engine_name', 'document_type_id'];

    protected $paramWhitelist = ['documents'];
    // phpcs:enable
}
