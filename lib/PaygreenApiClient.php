<?php

namespace Hraph\PaygreenApi;

use GuzzleHttp\Client;
use Hraph\PaygreenApi\Api\AuthentificationOAuthApi;
use Hraph\PaygreenApi\Api\GestionDeLadresseApi;
use Hraph\PaygreenApi\Api\GestionDeMesBoutiquesApi;
use Hraph\PaygreenApi\Api\GestionDeMesRIBApi;
use Hraph\PaygreenApi\Api\GestionDesDocumentsKYCsApi;
use Hraph\PaygreenApi\Api\GestionDesPropritairesApi;
use Hraph\PaygreenApi\Api\GestionDuComptePrincipalApi;
use Hraph\PaygreenApi\Api\GestionDuneAssociationApi;
use Hraph\PaygreenApi\Api\LempreinteDeCarteApi;
use Hraph\PaygreenApi\Api\LesDonsApi;
use Hraph\PaygreenApi\Api\LesMoyensDePaiementApi;
use Hraph\PaygreenApi\Api\LesTransactionsApi;
use Hraph\PaygreenApi\Api\LesVirementsApi;
use Hraph\PaygreenApi\Api\PaiementMultidestinataireApi;
use Hraph\PaygreenApi\Api\RechercheApi;

class PaygreenApiClient implements PaygreenApiClientInterface
{
    /**
     * @var Configuration|null
     */
    private $config;
    /**
     * @var HeaderSelector|null
     */
    private $headerSelector;
    /**
     * @var Client
     */
    private $httpClient;

    /**
     * @var AuthentificationOAuthApi
     */
    private $oAuth;
    /**
     * @var GestionDeLadresseApi
     */
    private $address;
    /**
     * @var GestionDeMesRIBApi
     */
    private $bank;
    /**
     * @var GestionDeLadresseApi
     */
    private $shop;
    /**
     * @var GestionDeMesBoutiquesApi
     */
    private $shops;
    /**
     * @var GestionDesDocumentsKYCsApi
     */
    private $documents;
    /**
     * @var GestionDesPropritairesApi
     */
    private $shareHolder;
    /**
     * @var GestionDuComptePrincipalApi
     */
    private $account;
    /**
     * @var GestionDuneAssociationApi
     */
    private $solidarity;
    /**
     * @var LesDonsApi
     */
    private $solidarityId;
    /**
     * @var LesMoyensDePaiementApi
     */
    private $paymentType;
    /**
     * @var LempreinteDeCarteApi
     */
    private $payinsCardprint;
    /**
     * @var LesTransactionsApi
     */
    private $payinsTransaction;
    /**
     * @var PaiementMultidestinataireApi
     */
    private $payinsMulticash;
    /**
     * @var RechercheApi
     */
    private $payinsSearch;
    /**
     * @var LesVirementsApi
     */
    private $payoutTransfer;

    /**
     * PaygreenApiClient constructor.
     */
    public function __construct(Configuration $config = null,
                                HeaderSelector $selector = null,
                                $host_index = 0)
    {
        $this->config = $config;
        $this->headerSelector = $selector;
        $this->httpClient = new Client();

        // Create sub clients
        $this->oAuth = new AuthentificationOAuthApi($this->httpClient, $this->config, $this->headerSelector, $host_index);
        $this->address = new GestionDeLadresseApi($this->httpClient, $this->config, $this->headerSelector, $host_index);
        $this->bank = new GestionDeMesRIBApi($this->httpClient, $this->config, $this->headerSelector, $host_index);
        $this->shop = new GestionDeLadresseApi($this->httpClient, $this->config, $this->headerSelector, $host_index);
        $this->shops = new GestionDeMesBoutiquesApi($this->httpClient, $this->config, $this->headerSelector, $host_index);
        $this->documents = new GestionDesDocumentsKYCsApi($this->httpClient, $this->config, $this->headerSelector, $host_index);
        $this->shareHolder = new GestionDesPropritairesApi($this->httpClient, $this->config, $this->headerSelector, $host_index);
        $this->account = new GestionDuComptePrincipalApi($this->httpClient, $this->config, $this->headerSelector, $host_index);
        $this->solidarity = new GestionDuneAssociationApi($this->httpClient, $this->config, $this->headerSelector, $host_index);
        $this->solidarityId = new LesDonsApi($this->httpClient, $this->config, $this->headerSelector, $host_index);
        $this->paymentType = new LesMoyensDePaiementApi($this->httpClient, $this->config, $this->headerSelector, $host_index);
        $this->payinsCardprint = new LempreinteDeCarteApi($this->httpClient, $this->config, $this->headerSelector, $host_index);
        $this->payinsTransaction = new LesTransactionsApi($this->httpClient, $this->config, $this->headerSelector, $host_index);
        $this->payinsMulticash = new PaiementMultidestinataireApi($this->httpClient, $this->config, $this->headerSelector, $host_index);
        $this->payinsSearch = new RechercheApi($this->httpClient, $this->config, $this->headerSelector, $host_index);
        $this->payoutTransfer = new LesVirementsApi($this->httpClient, $this->config, $this->headerSelector, $host_index);
    }

    /**
     * @return Configuration|null
     */
    public function getConfig()
    {
        return $this->config;
    }

    /**
     * @param Configuration|null $config
     */
    public function setConfig($config)
    {
        $this->config = $config;
    }

    /**
     * @return HeaderSelector|null
     */
    public function getHeaderSelector()
    {
        return $this->headerSelector;
    }

    /**
     * @param HeaderSelector|null $headerSelector
     */
    public function setHeaderSelector($headerSelector)
    {
        $this->headerSelector = $headerSelector;
    }

    /**
     * @return Client
     */
    public function getHttpClient()
    {
        return $this->httpClient;
    }

    /**
     * @param Client $httpClient
     */
    public function setHttpClient($httpClient)
    {
        $this->httpClient = $httpClient;
    }

    /**
     * @return GestionDeMesRIBApi
     */
    public function getBank()
    {
        return $this->bank;
    }

    /**
     * @return GestionDeLadresseApi
     */
    public function getShop()
    {
        return $this->shop;
    }

    /**
     * @return GestionDeMesBoutiquesApi
     */
    public function getShops()
    {
        return $this->shops;
    }

    /**
     * @return GestionDesDocumentsKYCsApi
     */
    public function getDocuments()
    {
        return $this->documents;
    }

    /**
     * @return GestionDesPropritairesApi
     */
    public function getShareHolder()
    {
        return $this->shareHolder;
    }

    /**
     * @return GestionDuComptePrincipalApi
     */
    public function getAccount()
    {
        return $this->account;
    }

    /**
     * @return GestionDuneAssociationApi
     */
    public function getSolidarity()
    {
        return $this->solidarity;
    }

    /**
     * @return LesDonsApi
     */
    public function getSolidarityId()
    {
        return $this->solidarityId;
    }

    /**
     * @return LesMoyensDePaiementApi
     */
    public function getPaymentType()
    {
        return $this->paymentType;
    }

    /**
     * @return LempreinteDeCarteApi
     */
    public function getPayinsCardprint()
    {
        return $this->payinsCardprint;
    }

    /**
     * @return LesTransactionsApi
     */
    public function getPayinsTransaction()
    {
        return $this->payinsTransaction;
    }

    /**
     * @return PaiementMultidestinataireApi
     */
    public function getPayinsMulticash()
    {
        return $this->payinsMulticash;
    }

    /**
     * @return RechercheApi
     */
    public function getPayinsSearch()
    {
        return $this->payinsSearch;
    }

    /**
     * @return LesVirementsApi
     */
    public function getPayoutTransfer()
    {
        return $this->payoutTransfer;
    }
}
