<?php


namespace App\Service;


use App\Dto\MetalDto;
use App\Entity\Supplier;
use GuzzleHttp\Client;
use Symfony\Contracts\HttpClient\HttpClientInterface;

class MetalService implements MetalServiceInterface
{
    /**
     * @var HttpClientInterface
     */
    private $client;

    private $api_url;

    public function __construct(HttpClientInterface $client, $api_url)
    {
        $this->client = $client;

        $this->api_url = $api_url;
    }

    /**
     * @param Supplier $supplier_id
     * @return MetalDto
     * @throws MetalException
     * @throws \Symfony\Contracts\HttpClient\Exception\ClientExceptionInterface
     * @throws \Symfony\Contracts\HttpClient\Exception\RedirectionExceptionInterface
     * @throws \Symfony\Contracts\HttpClient\Exception\ServerExceptionInterface
     * @throws \Symfony\Contracts\HttpClient\Exception\TransportExceptionInterface
     */
    public function metal($supplier_id): MetalDto
    {
        $url = sprintf($this->api_url, $supplier_id);
        $response = $this->client->request('GET', $url);
        if ($response->getStatusCode() == 200) {
            return MetalDto::from($response->getContent());
        }

        throw new MetalException('Metal for supplier not found');
    }
}