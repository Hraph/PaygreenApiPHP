<?php


namespace Hraph\PaygreenApi;

use GuzzleHttp\Client;
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

interface PaygreenApiClientInterface
{
    /**
     * @return Configuration|null
     */
    public function getConfig();

    /**
     * @param Configuration|null $config
     */
    public function setConfig($config);

    /**
     * @param $bool
     */
    public function useSandboxApi($bool);

    /**
     * @param $apiKey string
     */
    public function setApiKey($apiKey);
    /**
     * @return string
     */
    public function getApiKey();

    /**
     * @return string
     */
    public function getAccessToken();

    /**
     * @param string $accessToken
     * @return string
     */
    public function setAccessToken($accessToken);

    /**
     * @return string
     */
    public function getHost();

    /**
     * @param $host string
     */
    public function setHost($host);

    /**
     * @return HeaderSelector|null
     */
    public function getHeaderSelector();
    /**
     * @param HeaderSelector|null $headerSelector
     */
    public function setHeaderSelector($headerSelector);

    /**
     * @return Client
     */
    public function getHttpClient();

    /**
     * @param Client $httpClient
     */
    public function setHttpClient($httpClient);

    /**
     * @return GestionDeMesRIBApi
     */
    public function getBankApi();

    /**
     * @return GestionDeLadresseApi
     */
    public function getShopApi();

    /**
     * @return GestionDeMesBoutiquesApi
     */
    public function getShopsApi();

    /**
     * @return GestionDesDocumentsKYCsApi
     */
    public function getDocumentsApi();

    /**
     * @return GestionDesPropritairesApi
     */
    public function getShareHolderApi();

    /**
     * @return GestionDuComptePrincipalApi
     */
    public function getAccountApi();

    /**
     * @return GestionDuneAssociationApi
     */
    public function getSolidarityApi();

    /**
     * @return LesDonsApi
     */
    public function getSolidarityIdApi();

    /**
     * @return LesMoyensDePaiementApi
     */
    public function getPaymentTypeApi();

    /**
     * @return LempreinteDeCarteApi
     */
    public function getPayinsCardprintApi();

    /**
     * @return LesTransactionsApi
     */
    public function getPayinsTransactionApi();

    /**
     * @return PaiementMultidestinataireApi
     */
    public function getPayinsMulticashApi();
    /**
     * @return RechercheApi
     */
    public function getPayinsSearchApi();

    /**
     * @return LesVirementsApi
     */
    public function getPayoutTransferApi();
}
