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
    public function getBank();

    /**
     * @return GestionDeLadresseApi
     */
    public function getShop();

    /**
     * @return GestionDeMesBoutiquesApi
     */
    public function getShops();

    /**
     * @return GestionDesDocumentsKYCsApi
     */
    public function getDocuments();

    /**
     * @return GestionDesPropritairesApi
     */
    public function getShareHolder();

    /**
     * @return GestionDuComptePrincipalApi
     */
    public function getAccount();

    /**
     * @return GestionDuneAssociationApi
     */
    public function getSolidarity();

    /**
     * @return LesDonsApi
     */
    public function getSolidarityId();

    /**
     * @return LesMoyensDePaiementApi
     */
    public function getPaymentType();

    /**
     * @return LempreinteDeCarteApi
     */
    public function getPayinsCardprint();

    /**
     * @return LesTransactionsApi
     */
    public function getPayinsTransaction();

    /**
     * @return PaiementMultidestinataireApi
     */
    public function getPayinsMulticash();
    /**
     * @return RechercheApi
     */
    public function getPayinsSearch();

    /**
     * @return LesVirementsApi
     */
    public function getPayoutTransfer();
}
