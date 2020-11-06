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
    private $oAuthApi;
    /**
     * @var GestionDeLadresseApi
     */
    private $addressApi;
    /**
     * @var GestionDeMesRIBApi
     */
    private $bankApi;
    /**
     * @var GestionDeLadresseApi
     */
    private $shopApi;
    /**
     * @var GestionDeMesBoutiquesApi
     */
    private $shopsApi;
    /**
     * @var GestionDesDocumentsKYCsApi
     */
    private $documentsApi;
    /**
     * @var GestionDesPropritairesApi
     */
    private $shareHolderApi;
    /**
     * @var GestionDuComptePrincipalApi
     */
    private $accountApi;
    /**
     * @var GestionDuneAssociationApi
     */
    private $solidarityApi;
    /**
     * @var LesDonsApi
     */
    private $solidarityIdApi;
    /**
     * @var LesMoyensDePaiementApi
     */
    private $paymentTypeApi;
    /**
     * @var LempreinteDeCarteApi
     */
    private $payinsCardprintApi;
    /**
     * @var LesTransactionsApi
     */
    private $payinsTransactionApi;
    /**
     * @var PaiementMultidestinataireApi
     */
    private $payinsMulticashApi;
    /**
     * @var RechercheApi
     */
    private $payinsSearchApi;
    /**
     * @var LesVirementsApi
     */
    private $payoutTransferApi;

    /**
     * PaygreenApiClient constructor.
     */
    public function __construct(Configuration $config = null,
                                HeaderSelector $selector = null,
                                $host_index = 0)
    {
        $this->config = $config;
        $this->config->setApiKeyPrefix(self::API_KEY_IDENTIFIER, self::API_KEY_PREFIX); // Set api prefix

        $this->headerSelector = $selector;
        $this->httpClient = new Client();

        // Create sub clients
        $this->oAuthApi = new AuthentificationOAuthApi($this->httpClient, $this->config, $this->headerSelector, $host_index);
        $this->addressApi = new GestionDeLadresseApi($this->httpClient, $this->config, $this->headerSelector, $host_index);
        $this->bankApi = new GestionDeMesRIBApi($this->httpClient, $this->config, $this->headerSelector, $host_index);
        $this->shopApi = new GestionDeLadresseApi($this->httpClient, $this->config, $this->headerSelector, $host_index);
        $this->shopsApi = new GestionDeMesBoutiquesApi($this->httpClient, $this->config, $this->headerSelector, $host_index);
        $this->documentsApi = new GestionDesDocumentsKYCsApi($this->httpClient, $this->config, $this->headerSelector, $host_index);
        $this->shareHolderApi = new GestionDesPropritairesApi($this->httpClient, $this->config, $this->headerSelector, $host_index);
        $this->accountApi = new GestionDuComptePrincipalApi($this->httpClient, $this->config, $this->headerSelector, $host_index);
        $this->solidarityApi = new GestionDuneAssociationApi($this->httpClient, $this->config, $this->headerSelector, $host_index);
        $this->solidarityIdApi = new LesDonsApi($this->httpClient, $this->config, $this->headerSelector, $host_index);
        $this->paymentTypeApi = new LesMoyensDePaiementApi($this->httpClient, $this->config, $this->headerSelector, $host_index);
        $this->payinsCardprintApi = new LempreinteDeCarteApi($this->httpClient, $this->config, $this->headerSelector, $host_index);
        $this->payinsTransactionApi = new LesTransactionsApi($this->httpClient, $this->config, $this->headerSelector, $host_index);
        $this->payinsMulticashApi = new PaiementMultidestinataireApi($this->httpClient, $this->config, $this->headerSelector, $host_index);
        $this->payinsSearchApi = new RechercheApi($this->httpClient, $this->config, $this->headerSelector, $host_index);
        $this->payoutTransferApi = new LesVirementsApi($this->httpClient, $this->config, $this->headerSelector, $host_index);
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
     * @param $bool
     */
    public function useSandboxApi($bool)
    {
        if ($bool)
            $this->setHost(self::SANDBOX_API_HOST);
        else
            $this->setHost(self::API_HOST);
    }

    /**
     * @param $apiKey string
     */
    public function setApiKey($apiKey)
    {
        $this->config->setApiKey(self::API_KEY_IDENTIFIER, $apiKey);
    }

    /**
     * @return string
     */
    public function getApiKey()
    {
        return $this->config->getApiKey(self::API_KEY_IDENTIFIER);
    }

    /**
     * @return string
     */
    public function getApiKeyWithPrefix()
    {
        return $this->config->getApiKeyWithPrefix(self::API_KEY_IDENTIFIER);
    }

    /**
     * @param $username string
     */
    public function setUsername($username)
    {
        $this->config->setUsername($username);
    }

    /**
     * @return string
     */
    public function getUsername()
    {
        return $this->config->getUsername();
    }

    /**
     * @return string
     */
    public function getHost()
    {
        return $this->config->getHost();
    }

    /**
     * @param $host string
     */
    public function setHost($host)
    {
        $this->config->setHost($host);
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
     * @return AuthentificationOAuthApi
     */
    public function getOAuthApi()
    {
        return $this->oAuthApi;
    }

    /**
     * @return GestionDeLadresseApi
     */
    public function getAddressApi()
    {
        return $this->addressApi;
    }

    /**
     * @return GestionDeMesRIBApi
     */
    public function getBankApi()
    {
        return $this->bankApi;
    }

    /**
     * @return GestionDeLadresseApi
     */
    public function getShopApi()
    {
        return $this->shopApi;
    }

    /**
     * @return GestionDeMesBoutiquesApi
     */
    public function getShopsApi()
    {
        return $this->shopsApi;
    }

    /**
     * @return GestionDesDocumentsKYCsApi
     */
    public function getDocumentsApi()
    {
        return $this->documentsApi;
    }

    /**
     * @return GestionDesPropritairesApi
     */
    public function getShareHolderApi()
    {
        return $this->shareHolderApi;
    }

    /**
     * @return GestionDuComptePrincipalApi
     */
    public function getAccountApi()
    {
        return $this->accountApi;
    }

    /**
     * @return GestionDuneAssociationApi
     */
    public function getSolidarityApi()
    {
        return $this->solidarityApi;
    }

    /**
     * @return LesDonsApi
     */
    public function getSolidarityIdApi()
    {
        return $this->solidarityIdApi;
    }

    /**
     * @return LesMoyensDePaiementApi
     */
    public function getPaymentTypeApi()
    {
        return $this->paymentTypeApi;
    }

    /**
     * @return LempreinteDeCarteApi
     */
    public function getPayinsCardprintApi()
    {
        return $this->payinsCardprintApi;
    }

    /**
     * @return LesTransactionsApi
     */
    public function getPayinsTransactionApi()
    {
        return $this->payinsTransactionApi;
    }

    /**
     * @return PaiementMultidestinataireApi
     */
    public function getPayinsMulticashApi()
    {
        return $this->payinsMulticashApi;
    }

    /**
     * @return RechercheApi
     */
    public function getPayinsSearchApi()
    {
        return $this->payinsSearchApi;
    }

    /**
     * @return LesVirementsApi
     */
    public function getPayoutTransferApi()
    {
        return $this->payoutTransferApi;
    }
}
