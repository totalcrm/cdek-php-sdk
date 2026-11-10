<?php

declare(strict_types=1);

namespace TotalCRM\Cdek;

use JMS\Serializer\Naming\IdenticalPropertyNamingStrategy;
use JMS\Serializer\Naming\SerializedNameAnnotationStrategy;
use JMS\Serializer\Serializer;
use JMS\Serializer\SerializerBuilder;
use JsonException;
use Psr\Http\Client\ClientInterface;
use TotalCRM\Cdek\Actions\Barcodes;
use TotalCRM\Cdek\Actions\CalculatorTariff;
use TotalCRM\Cdek\Actions\CalculatorTariffList;
use TotalCRM\Cdek\Actions\Deliveries;
use TotalCRM\Cdek\Actions\Intakes;
use TotalCRM\Cdek\Actions\Invoices;
use TotalCRM\Cdek\Actions\LocationCities;
use TotalCRM\Cdek\Actions\LocationRegions;
use TotalCRM\Cdek\Actions\Offices;
use TotalCRM\Cdek\Actions\Orders;
use TotalCRM\Cdek\Actions\Webhooks;
use TotalCRM\Cdek\Dto\CityList;
use TotalCRM\Cdek\Dto\PickupPointList;
use TotalCRM\Cdek\Dto\RegionList;
use TotalCRM\Cdek\Dto\Response;
use TotalCRM\Cdek\Dto\TariffCodes;
use TotalCRM\Cdek\Dto\WebHookList;
use TotalCRM\Cdek\Exceptions\AuthException;
use TotalCRM\Cdek\Exceptions\ParsingException;
use TotalCRM\Cdek\Exceptions\RequestException;
use TotalCRM\Cdek\Http\Api;
use TotalCRM\Cdek\Http\ApiResponse;

final class Client
{
    private readonly Api $httpClient;
    private readonly Serializer $serializer;

    private ?Orders $orders = null;
    private ?Deliveries $deliveries = null;
    private ?Intakes $intakes = null;
    private ?Webhooks $webhooks = null;
    private ?Offices $offices = null;
    private ?Barcodes $barcodes = null;
    private ?Invoices $invoices = null;
    private ?LocationRegions $regions = null;
    private ?LocationCities $cities = null;
    private ?CalculatorTariffList $calculatorTariffList = null;
    private ?CalculatorTariff $calculatorTariff = null;

    public function __construct(ClientInterface $http, ?string $account = null, ?string $secure = null)
    {
        $this->httpClient = new Api($http, $account, $secure);
        $this->serializer = SerializerBuilder::create()
            ->setPropertyNamingStrategy(
                new SerializedNameAnnotationStrategy(new IdenticalPropertyNamingStrategy())
            )
            ->build();
    }

    public function getAccount(): string
    {
        return $this->httpClient->getAccount();
    }

    public function setAccount(string $account): self
    {
        $this->httpClient->setAccount($account);

        return $this;
    }

    public function getToken(): string
    {
        return $this->httpClient->getToken();
    }

    public function setToken(string $token): self
    {
        $this->httpClient->setToken($token);

        return $this;
    }

    public function getSecure(): string
    {
        return $this->httpClient->getSecure();
    }

    public function setSecure(string $secure): self
    {
        $this->httpClient->setSecure($secure);

        return $this;
    }

    public function isTest(): bool
    {
        return $this->httpClient->isTest();
    }

    public function setTest(bool $test): self
    {
        $this->httpClient->setTest($test);

        return $this;
    }

    public function isExpired(): bool
    {
        return $this->httpClient->isExpired();
    }

    public function getExpire(): int
    {
        return $this->httpClient->getExpire();
    }

    public function setExpire(int $timestamp): self
    {
        $this->httpClient->setExpire($timestamp);

        return $this;
    }

    /**
     * @throws AuthException
     * @throws RequestException
     */
    public function authorize(): bool
    {
        return $this->httpClient->authorize();
    }

    public function intakes(): Intakes
    {
        return $this->intakes ??= new Intakes($this->httpClient, $this->serializer);
    }

    public function orders(): Orders
    {
        return $this->orders ??= new Orders($this->httpClient, $this->serializer);
    }

    public function deliveries(): Deliveries
    {
        return $this->deliveries ??= new Deliveries($this->httpClient, $this->serializer);
    }

    public function offices(): Offices
    {
        return $this->offices ??= new Offices($this->httpClient, $this->serializer);
    }

    public function regions(): LocationRegions
    {
        return $this->regions ??= new LocationRegions($this->httpClient, $this->serializer);
    }

    public function cities(): LocationCities
    {
        return $this->cities ??= new LocationCities($this->httpClient, $this->serializer);
    }

    public function webhooks(): Webhooks
    {
        return $this->webhooks ??= new Webhooks($this->httpClient, $this->serializer);
    }

    public function invoice(): Invoices
    {
        return $this->invoices ??= new Invoices($this->httpClient, $this->serializer);
    }

    public function barcodes(): Barcodes
    {
        return $this->barcodes ??= new Barcodes($this->httpClient, $this->serializer);
    }

    public function calculatorTariffList(): CalculatorTariffList
    {
        return $this->calculatorTariffList ??= new CalculatorTariffList($this->httpClient, $this->serializer);
    }

    public function calculatorTariff(): CalculatorTariff
    {
        return $this->calculatorTariff ??= new CalculatorTariff($this->httpClient, $this->serializer);
    }

    /**
     * @template T of object
     * @param class-string<T> $className
     * @return Response
     * @throws ParsingException
     */
    public function formatResponse(ApiResponse $response, string $className, bool $isEntity = true): Response
    {
        if (!class_exists($className)) {
            throw new ParsingException('Class ' . $className . ' not found');
        }

        try {
            $arrayResponse = json_decode($response->getBody(), true, flags: JSON_THROW_ON_ERROR);
        } catch (JsonException $e) {
            throw new ParsingException('Invalid JSON response: ' . $e->getMessage(), 0, $e);
        }

        /** @var Response $result */
        $result = $this->serializer->fromArray($arrayResponse, Response::class);
        $result->entity = null;

        $payload = $isEntity ? ($arrayResponse['entity'] ?? null) : $arrayResponse;

        if ($payload !== null) {
            $result->entity = $this->serializer->fromArray($payload, $className);
        }

        return $result;
    }

    /**
     * @param class-string $className
     * @return CityList|RegionList|PickupPointList|WebHookList|TariffCodes
     * @throws ParsingException
     */
    public function formatResponseList(
        ApiResponse $response,
        string $className,
        ?string $itemsKey = 'items'
    ): CityList|RegionList|PickupPointList|WebHookList|TariffCodes {
        if (!class_exists($className)) {
            throw new ParsingException('Class ' . $className . ' not found');
        }

        try {
            $arrayResponse = json_decode($response->getBody(), true, flags: JSON_THROW_ON_ERROR);
        } catch (JsonException $e) {
            throw new ParsingException('Invalid JSON response: ' . $e->getMessage(), 0, $e);
        }

        if ($itemsKey !== null) {
            $arrayResponse = [$itemsKey => $arrayResponse];
        }

        return $this->serializer->fromArray($arrayResponse, $className);
    }
}
