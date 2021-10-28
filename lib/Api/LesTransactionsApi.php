<?php
/**
 * LesTransactionsApi
 * PHP version 7.3
 *
 * @category Class
 * @package  Hraph\PaygreenApi
 * @author   OpenAPI Generator team
 * @link     https://openapi-generator.tech
 */

/**
 * Intégration de PayGreen par API
 *
 * # API d'intégration complète<br /> <br /> Cette documentation est la compilation de toutes nos documentations d'intégration de la solution de paiement PayGreen, qu'il s'agisse d'une intégration simple, sur un CMS ou sur une marketplace notamment.<br /> <br /> Si vous intégrez PayGreen dans une optique bien précise, n'hésitez pas à consulter nos documentations simplifiées&nbsp;:<br /> - [API de paiement](api-documentation-categorie?cat=paiement)&nbsp;: la documentation pour intégrer le plus simplement PayGreen sur votre e-commerce.<br /> - [API d'intégration sur un CMS](api-documentation-categorie?cat=cms)&nbsp;: intégrez PayGreen sur votre CMS.<br /> - [API d'intégration pour une MarketPlace](api-documentation-categorie?cat=mkp)&nbsp;: intégrez PayGreen sur votre MarketPlace.<br /> <br /> > Nous nous efforçons d'étoffer et de clarifier cette documentation au fil du temps afin de simplifier au maximum l'intégration de notre solution. Toutefois, si certains points demeurent problématiques, notre équipe technique est joignable à l'adresse serviceclient@paygreen.fr et vous répondra dans les meilleurs délais.<br /> ## Flux de paiement<br /> <br /> Le schéma suivant représente le fonctionnement de cette API lorsqu'un consommateur effectue un paiement sur un site e-commerce&nbsp;:<br /> <br /> ![Schéma de flux](../api/img/schema-flux.svg)<br /> <br /> 1. Le consommateur remplit et **valide son panier**.<br /> 2. Le e-commerce envoie à PayGreen les informations permettant de **créer le paiement**.<br /> 3. Le consommateur règle sa commande sur une **interface de paiement PayGreen**&nbsp;: selon la configuration de la boutique, il s'agit soit d'une **page déportée**, soit d'un affichage en iframe (**insite**) sur le site e-commerce.<br /> 4. Le consommateur est automatiquement **redirigé** sur le e-commerce (paramètre `returned_url`).<br /> 5. PayGreen envoie l'**IPN de la transaction** au e-commerce (paramètre `notified_url`). Il s'agit d'une notification permettant au e-commerce de mettre à jour le statut d'une commande. L'IPN contient en effet les informations sur la transaction (*voir le paragraphe consacré dans les chapitres [Les transactions](#tag/Les-transactions) et [Les virements](#tag/Les-virements) pour plus de détails*).<br /> 6. Le e-commerce renvoit une **demande de détails** sur la transaction. Cette étape n'est pas absolument obligatoire, mais elle est fortement recommandée pour des raisons de sécurité&nbsp;: en effet, recevoir une IPN ne garantit pas la véracité des informations transmises (elle peut être envoyée par un tiers souhaitant compromettre vos données). Cette demande permet donc de **vérifier les informations transmises** par l'IPN.<br /> 7. Un message de confirmation informe le consommateur que la transaction **a été effectuée** avec succès (ou a échoué si tel est le cas).<br /> # Pré-requis<br /> ## Identifiant et clé privée<br /> <br /> Pour tout appel API PayGreen, vous aurez besoin de renseigner l'*identifiant PayGreen* (`shop ID`) et parfois, la *clé privée* de la boutique. <br /> Ces deux informations se trouvent à différents endroits sur le [back-office PayGreen](../shop/wizard-activation)&nbsp;:<br /> - En bas à gauche de la ***page d'activation*** (1)&nbsp;;<br /> - Dans la fenêtre accessible sur chaque page du back-office en cliquant sur le lien ***Toutes mes boutiques*** (2).<br /> <br /> ![Capture 1](../api/img/id-privatekey-1.png)<br /> *Capture 1*<br /> <br /> ![Capture 1](../api/img/id-privatekey-2.png)<br /> *Capture 2*<br /> ## Paramétrage de l'interface de paiement<br /> <br /> Beaucoup d'options relatives à l'interface de paiement sont disponibles directement dans le back-office PayGreen&nbsp;: il n'est donc pas nécessaire d'être développeur pour personnaliser la page de paiement. <br /> Parmi les options à votre disposition, le e-commerçant a la possibilité de choisir son type d'interface de paiement&nbsp;:<br /> - Par défaut, il s'agit d'une **page de paiement** externe au site e-commerce, sur laquelle le consommateur est redirigé après validation de son panier. **Aucune manipulation n'est nécessaire pour opter pour ce type d'interface**. Elle présente l'avantage d'être parfaitement responsive sans que vous n'ayez à développer quoi que ce soit. Le e-commerçant peut en outre ajouter son logo et en personnaliser le wording et le fond de la page.<br /> - L'**insite** est le second type d'interface à la disposition du e-commerçant. Il lui permet d'afficher l'interface dans un *iframe* intégré à son site e-commerce&nbsp;: cela permet de conserver un tunnel de paiement uniforme. Cette option n'est accessible que sur activation du module par notre équipe d'account managers (que vous pouvez contacter à serviceclient@paygreen.fr). Une fois le module *insite* activé, il suffit d'afficher sur le e-commerce un iframe ayant pour URL le lien fourni, en y ajoutant à la fin la mention `?display=insite`.<br /> <br /> # Titres restaurant<br /> <br /> Ce chapitre vous concerne si&nbsp;:<br /> 1. Votre activité est liée à la **restauration**.<br /> 2. Vous êtes **conventionné** pour recevoir des paiements en titres restaurant ou pouvez le devenir.<br /> <br /> PayGreen vous permet d'intégrer simplement plusieurs moyens de paiement pour régler des **achats éligibles aux titres restaurant**. Par ailleurs, PayGreen gère intégralement les éventuels **compléments** (en carte bancaire ou American Express).<br /> <br /> ## Les moyens de paiement Restauration<br /> <br /> ### Titres Restaurant Dématérialisés `TRD`<br /> <br /> Ce moyen de paiement vous permet d'encaisser les paiements réalisés via n'importe quelle carte du **réseau Conecs**&nbsp;:<br /> - Apetiz (Natixis)<br /> - Pass Restaurant (de Sodexo)<br /> - Up Chèque Déjeuner<br /> <br /> Si le solde de la carte est insuffisant pour régler la totalité du panier, un **moyen de paiement complémentaire** sera utilisé pour régler le montant restant (*exemple&nbsp;: CB/Visa/MasterCard*). Cette opération est réalisée automatiquement côté PayGreen à partir de la configuration de votre moyen de paiement (réalisée par notre support)&nbsp;: vous n'avez **aucun appel API à effectuer**.<br /> <br /> ### Resto Flash `RESTOFLASH`<br /> <br /> Ce moyen de paiement permet à vos clients de régler leur achat en utilisant leur **compte Resto Flash**. Il s'agit d'un moyen de paiement 100&#37; digital, sans carte à renseigner, et optimisé pour une expérience mobile. Le consommateur alimente son compte Resto Flash avec ses tickets restaurant papier, ce qui lui permet de les utiliser en ligne.<br /> <br /> ### Lunchr `LUNCHR`<br /> <br /> Lunchr est une alternative au réseau Conecs et aux titres restaurant papier. Les employeurs qui choisissent ce prestataire pour les titres restaurant permettent à leurs salariés de disposer d'une carte du réseau MasterCard, sur laquelle le solde journalier est crédité. Les consommateurs peuvent suivre l'évolution de leur solde via une application mobile.<br /> <br /> ## Activer un moyen de paiement<br /> <br /> Par défaut (*sous réserve d'acceptation de vos documents justificatifs ou de votre numéro VAD lors de votre inscription sur PayGreen*) votre boutique peut encaisser des paiements par carte bancaire CB/Visa/MasterCard.<br /> Si vous souhaitez proposer d'autres moyens de paiement à vos clients, il vous suffit d'en faire la demande auprès de notre support à l'adresse serviceclient@paygreen.fr.<br /> <br /> ## Appels API<br /> <br /> Une fois vos moyens de paiement activés par notre support, vous pourrez les utiliser pour créer des transactions. Voici la procédure à suivre&nbsp;:<br /> 1. Envoyez une requête (GET) pour obtenir la [liste de vos moyens de paiement activés](#tag/Les-moyens-de-paiement) (paragraphe **Liste des moyens de paiement**).<br /> 2. Vérifiez que la réponse reçue (*voir l'exemple de réponse dans le lien ci-dessus*) renvoie bien le ou les moyens de paiement souhaités. Cela vous évitera de créer une transaction pour un moyen de paiement désactivé, ce qui ferait échouer la transaction.<br /> 3. Vérifiez le paramètre `availablePaymentMode`&nbsp;: il doit contenir le ou les modes de paiement (*comptant, abonnement&hellip;*) qui peuvent être effectués avec le moyen de paiement correspondant. Cela vous évitera de créer une transaction dont le type n'est pas pris en charge par le moyen de paiement (*exemple&nbsp;: les moyens de paiement \"Titres restaurant\" ne permettent pas de faire du paiement par abonnement*). <br /> 4. Enfin, récupérez le tableau renvoyé dans le paramètre `iframe`&nbsp;: il vous indique, pour chaque mode de paiement, quelle est la **taille minimale conseillée** (en pixels) pour l'iframe qui contiendra l'interface de paiement PayGreen. Nous vous conseillons de respecter ces préconisations afin d'optimiser l'expérience de paiement de vos clients.<br /> 5. Une fois toutes ces informations en main, vous pouvez créer une [transaction](#tag/Les-transactions).
 *
 * The version of the OpenAPI document: 1.0.0
 * Contact: serviceclient@paygreen.fr
 * Generated by: https://openapi-generator.tech
 * OpenAPI Generator version: 5.3.0
 */

/**
 * NOTE: This class is auto generated by OpenAPI Generator (https://openapi-generator.tech).
 * https://openapi-generator.tech
 * Do not edit the class manually.
 */

namespace Hraph\PaygreenApi\Api;

use GuzzleHttp\Client;
use GuzzleHttp\ClientInterface;
use GuzzleHttp\Exception\RequestException;
use GuzzleHttp\Exception\ConnectException;
use GuzzleHttp\Psr7\MultipartStream;
use GuzzleHttp\Psr7\Request;
use GuzzleHttp\RequestOptions;
use Hraph\PaygreenApi\ApiException;
use Hraph\PaygreenApi\Configuration;
use Hraph\PaygreenApi\HeaderSelector;
use Hraph\PaygreenApi\ObjectSerializer;

/**
 * LesTransactionsApi Class Doc Comment
 *
 * @category Class
 * @package  Hraph\PaygreenApi
 * @author   OpenAPI Generator team
 * @link     https://openapi-generator.tech
 */
class LesTransactionsApi
{
    /**
     * @var ClientInterface
     */
    protected $client;

    /**
     * @var Configuration
     */
    protected $config;

    /**
     * @var HeaderSelector
     */
    protected $headerSelector;

    /**
     * @var int Host index
     */
    protected $hostIndex;

    /**
     * @param ClientInterface $client
     * @param Configuration   $config
     * @param HeaderSelector  $selector
     * @param int             $hostIndex (Optional) host index to select the list of hosts if defined in the OpenAPI spec
     */
    public function __construct(
        ClientInterface $client = null,
        Configuration $config = null,
        HeaderSelector $selector = null,
        $hostIndex = 0
    ) {
        $this->client = $client ?: new Client();
        $this->config = $config ?: new Configuration();
        $this->headerSelector = $selector ?: new HeaderSelector();
        $this->hostIndex = $hostIndex;
    }

    /**
     * Set the host index
     *
     * @param int $hostIndex Host index (required)
     */
    public function setHostIndex($hostIndex): void
    {
        $this->hostIndex = $hostIndex;
    }

    /**
     * Get the host index
     *
     * @return int Host index
     */
    public function getHostIndex()
    {
        return $this->hostIndex;
    }

    /**
     * @return Configuration
     */
    public function getConfig()
    {
        return $this->config;
    }

    /**
     * Operation apiIdentifiantPayinsTransactionCancelPost
     *
     * Annulation
     *
     * @param  string $identifiant Votre identifiant PayGreen (required)
     * @param  string $authorization Votre clé privée PayGreen (Bearer : votre-clé-privée) (required)
     * @param  string $id ID de la transaction (required)
     *
     * @throws \Hraph\PaygreenApi\ApiException on non-2xx response
     * @throws \InvalidArgumentException
     * @return \Hraph\PaygreenApi\Model\InlineResponse20012
     */
    public function apiIdentifiantPayinsTransactionCancelPost($identifiant, $authorization, $id)
    {
        list($response) = $this->apiIdentifiantPayinsTransactionCancelPostWithHttpInfo($identifiant, $authorization, $id);
        return $response;
    }

    /**
     * Operation apiIdentifiantPayinsTransactionCancelPostWithHttpInfo
     *
     * Annulation
     *
     * @param  string $identifiant Votre identifiant PayGreen (required)
     * @param  string $authorization Votre clé privée PayGreen (Bearer : votre-clé-privée) (required)
     * @param  string $id ID de la transaction (required)
     *
     * @throws \Hraph\PaygreenApi\ApiException on non-2xx response
     * @throws \InvalidArgumentException
     * @return array of \Hraph\PaygreenApi\Model\InlineResponse20012, HTTP status code, HTTP response headers (array of strings)
     */
    public function apiIdentifiantPayinsTransactionCancelPostWithHttpInfo($identifiant, $authorization, $id)
    {
        $request = $this->apiIdentifiantPayinsTransactionCancelPostRequest($identifiant, $authorization, $id);

        try {
            $options = $this->createHttpClientOption();
            try {
                $response = $this->client->send($request, $options);
            } catch (RequestException $e) {
                throw new ApiException(
                    "[{$e->getCode()}] {$e->getMessage()}",
                    (int) $e->getCode(),
                    $e->getResponse() ? $e->getResponse()->getHeaders() : null,
                    $e->getResponse() ? (string) $e->getResponse()->getBody() : null
                );
            } catch (ConnectException $e) {
                throw new ApiException(
                    "[{$e->getCode()}] {$e->getMessage()}",
                    (int) $e->getCode(),
                    null,
                    null
                );
            }

            $statusCode = $response->getStatusCode();

            if ($statusCode < 200 || $statusCode > 299) {
                throw new ApiException(
                    sprintf(
                        '[%d] Error connecting to the API (%s)',
                        $statusCode,
                        (string) $request->getUri()
                    ),
                    $statusCode,
                    $response->getHeaders(),
                    (string) $response->getBody()
                );
            }

            switch($statusCode) {
                case 200:
                    if ('\Hraph\PaygreenApi\Model\InlineResponse20012' === '\SplFileObject') {
                        $content = $response->getBody(); //stream goes to serializer
                    } else {
                        $content = (string) $response->getBody();
                    }

                    return [
                        ObjectSerializer::deserialize($content, '\Hraph\PaygreenApi\Model\InlineResponse20012', []),
                        $response->getStatusCode(),
                        $response->getHeaders()
                    ];
            }

            $returnType = '\Hraph\PaygreenApi\Model\InlineResponse20012';
            if ($returnType === '\SplFileObject') {
                $content = $response->getBody(); //stream goes to serializer
            } else {
                $content = (string) $response->getBody();
            }

            return [
                ObjectSerializer::deserialize($content, $returnType, []),
                $response->getStatusCode(),
                $response->getHeaders()
            ];

        } catch (ApiException $e) {
            switch ($e->getCode()) {
                case 200:
                    $data = ObjectSerializer::deserialize(
                        $e->getResponseBody(),
                        '\Hraph\PaygreenApi\Model\InlineResponse20012',
                        $e->getResponseHeaders()
                    );
                    $e->setResponseObject($data);
                    break;
            }
            throw $e;
        }
    }

    /**
     * Operation apiIdentifiantPayinsTransactionCancelPostAsync
     *
     * Annulation
     *
     * @param  string $identifiant Votre identifiant PayGreen (required)
     * @param  string $authorization Votre clé privée PayGreen (Bearer : votre-clé-privée) (required)
     * @param  string $id ID de la transaction (required)
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Promise\PromiseInterface
     */
    public function apiIdentifiantPayinsTransactionCancelPostAsync($identifiant, $authorization, $id)
    {
        return $this->apiIdentifiantPayinsTransactionCancelPostAsyncWithHttpInfo($identifiant, $authorization, $id)
            ->then(
                function ($response) {
                    return $response[0];
                }
            );
    }

    /**
     * Operation apiIdentifiantPayinsTransactionCancelPostAsyncWithHttpInfo
     *
     * Annulation
     *
     * @param  string $identifiant Votre identifiant PayGreen (required)
     * @param  string $authorization Votre clé privée PayGreen (Bearer : votre-clé-privée) (required)
     * @param  string $id ID de la transaction (required)
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Promise\PromiseInterface
     */
    public function apiIdentifiantPayinsTransactionCancelPostAsyncWithHttpInfo($identifiant, $authorization, $id)
    {
        $returnType = '\Hraph\PaygreenApi\Model\InlineResponse20012';
        $request = $this->apiIdentifiantPayinsTransactionCancelPostRequest($identifiant, $authorization, $id);

        return $this->client
            ->sendAsync($request, $this->createHttpClientOption())
            ->then(
                function ($response) use ($returnType) {
                    if ($returnType === '\SplFileObject') {
                        $content = $response->getBody(); //stream goes to serializer
                    } else {
                        $content = (string) $response->getBody();
                    }

                    return [
                        ObjectSerializer::deserialize($content, $returnType, []),
                        $response->getStatusCode(),
                        $response->getHeaders()
                    ];
                },
                function ($exception) {
                    $response = $exception->getResponse();
                    $statusCode = $response->getStatusCode();
                    throw new ApiException(
                        sprintf(
                            '[%d] Error connecting to the API (%s)',
                            $statusCode,
                            $exception->getRequest()->getUri()
                        ),
                        $statusCode,
                        $response->getHeaders(),
                        (string) $response->getBody()
                    );
                }
            );
    }

    /**
     * Create request for operation 'apiIdentifiantPayinsTransactionCancelPost'
     *
     * @param  string $identifiant Votre identifiant PayGreen (required)
     * @param  string $authorization Votre clé privée PayGreen (Bearer : votre-clé-privée) (required)
     * @param  string $id ID de la transaction (required)
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Psr7\Request
     */
    public function apiIdentifiantPayinsTransactionCancelPostRequest($identifiant, $authorization, $id)
    {
        // verify the required parameter 'identifiant' is set
        if ($identifiant === null || (is_array($identifiant) && count($identifiant) === 0)) {
            throw new \InvalidArgumentException(
                'Missing the required parameter $identifiant when calling apiIdentifiantPayinsTransactionCancelPost'
            );
        }
        // verify the required parameter 'authorization' is set
        if ($authorization === null || (is_array($authorization) && count($authorization) === 0)) {
            throw new \InvalidArgumentException(
                'Missing the required parameter $authorization when calling apiIdentifiantPayinsTransactionCancelPost'
            );
        }
        // verify the required parameter 'id' is set
        if ($id === null || (is_array($id) && count($id) === 0)) {
            throw new \InvalidArgumentException(
                'Missing the required parameter $id when calling apiIdentifiantPayinsTransactionCancelPost'
            );
        }

        $resourcePath = '/api/{identifiant}/payins/transaction/cancel';
        $formParams = [];
        $queryParams = [];
        $headerParams = [];
        $httpBody = '';
        $multipart = false;


        // header params
        if ($authorization !== null) {
            $headerParams['Authorization'] = ObjectSerializer::toHeaderValue($authorization);
        }

        // path params
        if ($identifiant !== null) {
            $resourcePath = str_replace(
                '{' . 'identifiant' . '}',
                ObjectSerializer::toPathValue($identifiant),
                $resourcePath
            );
        }
        // path params
        if ($id !== null) {
            $resourcePath = str_replace(
                '{' . 'id' . '}',
                ObjectSerializer::toPathValue($id),
                $resourcePath
            );
        }


        if ($multipart) {
            $headers = $this->headerSelector->selectHeadersForMultipart(
                ['application/json']
            );
        } else {
            $headers = $this->headerSelector->selectHeaders(
                ['application/json'],
                []
            );
        }

        // for model (json/xml)
        if (count($formParams) > 0) {
            if ($multipart) {
                $multipartContents = [];
                foreach ($formParams as $formParamName => $formParamValue) {
                    $formParamValueItems = is_array($formParamValue) ? $formParamValue : [$formParamValue];
                    foreach ($formParamValueItems as $formParamValueItem) {
                        $multipartContents[] = [
                            'name' => $formParamName,
                            'contents' => $formParamValueItem
                        ];
                    }
                }
                // for HTTP post (form)
                $httpBody = new MultipartStream($multipartContents);

            } elseif ($headers['Content-Type'] === 'application/json') {
                $httpBody = \GuzzleHttp\json_encode($formParams);

            } else {
                // for HTTP post (form)
                $httpBody = \GuzzleHttp\Psr7\Query::build($formParams);
            }
        }


        $defaultHeaders = [];
        if ($this->config->getUserAgent()) {
            $defaultHeaders['User-Agent'] = $this->config->getUserAgent();
        }

        $headers = array_merge(
            $defaultHeaders,
            $headerParams,
            $headers
        );

        $query = \GuzzleHttp\Psr7\Query::build($queryParams);
        return new Request(
            'POST',
            $this->config->getHost() . $resourcePath . ($query ? "?{$query}" : ''),
            $headers,
            $httpBody
        );
    }

    /**
     * Operation apiIdentifiantPayinsTransactionCashPost
     *
     * Paiement comptant
     *
     * @param  string $identifiant Votre identifiant PayGreen (required)
     * @param  string $authorization Votre clé privée PayGreen (Bearer : votre-clé-privée) (required)
     * @param  \Hraph\PaygreenApi\Model\Payins $payins Transaction comptant ou à la livraison (required)
     *
     * @throws \Hraph\PaygreenApi\ApiException on non-2xx response
     * @throws \InvalidArgumentException
     * @return \Hraph\PaygreenApi\Model\InlineResponse20012
     */
    public function apiIdentifiantPayinsTransactionCashPost($identifiant, $authorization, $payins)
    {
        list($response) = $this->apiIdentifiantPayinsTransactionCashPostWithHttpInfo($identifiant, $authorization, $payins);
        return $response;
    }

    /**
     * Operation apiIdentifiantPayinsTransactionCashPostWithHttpInfo
     *
     * Paiement comptant
     *
     * @param  string $identifiant Votre identifiant PayGreen (required)
     * @param  string $authorization Votre clé privée PayGreen (Bearer : votre-clé-privée) (required)
     * @param  \Hraph\PaygreenApi\Model\Payins $payins Transaction comptant ou à la livraison (required)
     *
     * @throws \Hraph\PaygreenApi\ApiException on non-2xx response
     * @throws \InvalidArgumentException
     * @return array of \Hraph\PaygreenApi\Model\InlineResponse20012, HTTP status code, HTTP response headers (array of strings)
     */
    public function apiIdentifiantPayinsTransactionCashPostWithHttpInfo($identifiant, $authorization, $payins)
    {
        $request = $this->apiIdentifiantPayinsTransactionCashPostRequest($identifiant, $authorization, $payins);

        try {
            $options = $this->createHttpClientOption();
            try {
                $response = $this->client->send($request, $options);
            } catch (RequestException $e) {
                throw new ApiException(
                    "[{$e->getCode()}] {$e->getMessage()}",
                    (int) $e->getCode(),
                    $e->getResponse() ? $e->getResponse()->getHeaders() : null,
                    $e->getResponse() ? (string) $e->getResponse()->getBody() : null
                );
            } catch (ConnectException $e) {
                throw new ApiException(
                    "[{$e->getCode()}] {$e->getMessage()}",
                    (int) $e->getCode(),
                    null,
                    null
                );
            }

            $statusCode = $response->getStatusCode();

            if ($statusCode < 200 || $statusCode > 299) {
                throw new ApiException(
                    sprintf(
                        '[%d] Error connecting to the API (%s)',
                        $statusCode,
                        (string) $request->getUri()
                    ),
                    $statusCode,
                    $response->getHeaders(),
                    (string) $response->getBody()
                );
            }

            switch($statusCode) {
                case 200:
                    if ('\Hraph\PaygreenApi\Model\InlineResponse20012' === '\SplFileObject') {
                        $content = $response->getBody(); //stream goes to serializer
                    } else {
                        $content = (string) $response->getBody();
                    }

                    return [
                        ObjectSerializer::deserialize($content, '\Hraph\PaygreenApi\Model\InlineResponse20012', []),
                        $response->getStatusCode(),
                        $response->getHeaders()
                    ];
            }

            $returnType = '\Hraph\PaygreenApi\Model\InlineResponse20012';
            if ($returnType === '\SplFileObject') {
                $content = $response->getBody(); //stream goes to serializer
            } else {
                $content = (string) $response->getBody();
            }

            return [
                ObjectSerializer::deserialize($content, $returnType, []),
                $response->getStatusCode(),
                $response->getHeaders()
            ];

        } catch (ApiException $e) {
            switch ($e->getCode()) {
                case 200:
                    $data = ObjectSerializer::deserialize(
                        $e->getResponseBody(),
                        '\Hraph\PaygreenApi\Model\InlineResponse20012',
                        $e->getResponseHeaders()
                    );
                    $e->setResponseObject($data);
                    break;
            }
            throw $e;
        }
    }

    /**
     * Operation apiIdentifiantPayinsTransactionCashPostAsync
     *
     * Paiement comptant
     *
     * @param  string $identifiant Votre identifiant PayGreen (required)
     * @param  string $authorization Votre clé privée PayGreen (Bearer : votre-clé-privée) (required)
     * @param  \Hraph\PaygreenApi\Model\Payins $payins Transaction comptant ou à la livraison (required)
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Promise\PromiseInterface
     */
    public function apiIdentifiantPayinsTransactionCashPostAsync($identifiant, $authorization, $payins)
    {
        return $this->apiIdentifiantPayinsTransactionCashPostAsyncWithHttpInfo($identifiant, $authorization, $payins)
            ->then(
                function ($response) {
                    return $response[0];
                }
            );
    }

    /**
     * Operation apiIdentifiantPayinsTransactionCashPostAsyncWithHttpInfo
     *
     * Paiement comptant
     *
     * @param  string $identifiant Votre identifiant PayGreen (required)
     * @param  string $authorization Votre clé privée PayGreen (Bearer : votre-clé-privée) (required)
     * @param  \Hraph\PaygreenApi\Model\Payins $payins Transaction comptant ou à la livraison (required)
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Promise\PromiseInterface
     */
    public function apiIdentifiantPayinsTransactionCashPostAsyncWithHttpInfo($identifiant, $authorization, $payins)
    {
        $returnType = '\Hraph\PaygreenApi\Model\InlineResponse20012';
        $request = $this->apiIdentifiantPayinsTransactionCashPostRequest($identifiant, $authorization, $payins);

        return $this->client
            ->sendAsync($request, $this->createHttpClientOption())
            ->then(
                function ($response) use ($returnType) {
                    if ($returnType === '\SplFileObject') {
                        $content = $response->getBody(); //stream goes to serializer
                    } else {
                        $content = (string) $response->getBody();
                    }

                    return [
                        ObjectSerializer::deserialize($content, $returnType, []),
                        $response->getStatusCode(),
                        $response->getHeaders()
                    ];
                },
                function ($exception) {
                    $response = $exception->getResponse();
                    $statusCode = $response->getStatusCode();
                    throw new ApiException(
                        sprintf(
                            '[%d] Error connecting to the API (%s)',
                            $statusCode,
                            $exception->getRequest()->getUri()
                        ),
                        $statusCode,
                        $response->getHeaders(),
                        (string) $response->getBody()
                    );
                }
            );
    }

    /**
     * Create request for operation 'apiIdentifiantPayinsTransactionCashPost'
     *
     * @param  string $identifiant Votre identifiant PayGreen (required)
     * @param  string $authorization Votre clé privée PayGreen (Bearer : votre-clé-privée) (required)
     * @param  \Hraph\PaygreenApi\Model\Payins $payins Transaction comptant ou à la livraison (required)
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Psr7\Request
     */
    public function apiIdentifiantPayinsTransactionCashPostRequest($identifiant, $authorization, $payins)
    {
        // verify the required parameter 'identifiant' is set
        if ($identifiant === null || (is_array($identifiant) && count($identifiant) === 0)) {
            throw new \InvalidArgumentException(
                'Missing the required parameter $identifiant when calling apiIdentifiantPayinsTransactionCashPost'
            );
        }
        // verify the required parameter 'authorization' is set
        if ($authorization === null || (is_array($authorization) && count($authorization) === 0)) {
            throw new \InvalidArgumentException(
                'Missing the required parameter $authorization when calling apiIdentifiantPayinsTransactionCashPost'
            );
        }
        // verify the required parameter 'payins' is set
        if ($payins === null || (is_array($payins) && count($payins) === 0)) {
            throw new \InvalidArgumentException(
                'Missing the required parameter $payins when calling apiIdentifiantPayinsTransactionCashPost'
            );
        }

        $resourcePath = '/api/{identifiant}/payins/transaction/cash';
        $formParams = [];
        $queryParams = [];
        $headerParams = [];
        $httpBody = '';
        $multipart = false;


        // header params
        if ($authorization !== null) {
            $headerParams['Authorization'] = ObjectSerializer::toHeaderValue($authorization);
        }

        // path params
        if ($identifiant !== null) {
            $resourcePath = str_replace(
                '{' . 'identifiant' . '}',
                ObjectSerializer::toPathValue($identifiant),
                $resourcePath
            );
        }


        if ($multipart) {
            $headers = $this->headerSelector->selectHeadersForMultipart(
                ['application/json']
            );
        } else {
            $headers = $this->headerSelector->selectHeaders(
                ['application/json'],
                ['application/json']
            );
        }

        // for model (json/xml)
        if (isset($payins)) {
            if ($headers['Content-Type'] === 'application/json') {
                $httpBody = \GuzzleHttp\json_encode(ObjectSerializer::sanitizeForSerialization($payins));
            } else {
                $httpBody = $payins;
            }
        } elseif (count($formParams) > 0) {
            if ($multipart) {
                $multipartContents = [];
                foreach ($formParams as $formParamName => $formParamValue) {
                    $formParamValueItems = is_array($formParamValue) ? $formParamValue : [$formParamValue];
                    foreach ($formParamValueItems as $formParamValueItem) {
                        $multipartContents[] = [
                            'name' => $formParamName,
                            'contents' => $formParamValueItem
                        ];
                    }
                }
                // for HTTP post (form)
                $httpBody = new MultipartStream($multipartContents);

            } elseif ($headers['Content-Type'] === 'application/json') {
                $httpBody = \GuzzleHttp\json_encode($formParams);

            } else {
                // for HTTP post (form)
                $httpBody = \GuzzleHttp\Psr7\Query::build($formParams);
            }
        }


        $defaultHeaders = [];
        if ($this->config->getUserAgent()) {
            $defaultHeaders['User-Agent'] = $this->config->getUserAgent();
        }

        $headers = array_merge(
            $defaultHeaders,
            $headerParams,
            $headers
        );

        $query = \GuzzleHttp\Psr7\Query::build($queryParams);
        return new Request(
            'POST',
            $this->config->getHost() . $resourcePath . ($query ? "?{$query}" : ''),
            $headers,
            $httpBody
        );
    }

    /**
     * Operation apiIdentifiantPayinsTransactionIdDelete
     *
     * Remboursement
     *
     * @param  string $identifiant Votre identifiant PayGreen (required)
     * @param  string $authorization Votre clé privée PayGreen (Bearer : votre-clé-privée) (required)
     * @param  string $id ID de la transaction (required)
     *
     * @throws \Hraph\PaygreenApi\ApiException on non-2xx response
     * @throws \InvalidArgumentException
     * @return \Hraph\PaygreenApi\Model\InlineResponse20012
     */
    public function apiIdentifiantPayinsTransactionIdDelete($identifiant, $authorization, $id)
    {
        list($response) = $this->apiIdentifiantPayinsTransactionIdDeleteWithHttpInfo($identifiant, $authorization, $id);
        return $response;
    }

    /**
     * Operation apiIdentifiantPayinsTransactionIdDeleteWithHttpInfo
     *
     * Remboursement
     *
     * @param  string $identifiant Votre identifiant PayGreen (required)
     * @param  string $authorization Votre clé privée PayGreen (Bearer : votre-clé-privée) (required)
     * @param  string $id ID de la transaction (required)
     *
     * @throws \Hraph\PaygreenApi\ApiException on non-2xx response
     * @throws \InvalidArgumentException
     * @return array of \Hraph\PaygreenApi\Model\InlineResponse20012, HTTP status code, HTTP response headers (array of strings)
     */
    public function apiIdentifiantPayinsTransactionIdDeleteWithHttpInfo($identifiant, $authorization, $id)
    {
        $request = $this->apiIdentifiantPayinsTransactionIdDeleteRequest($identifiant, $authorization, $id);

        try {
            $options = $this->createHttpClientOption();
            try {
                $response = $this->client->send($request, $options);
            } catch (RequestException $e) {
                throw new ApiException(
                    "[{$e->getCode()}] {$e->getMessage()}",
                    (int) $e->getCode(),
                    $e->getResponse() ? $e->getResponse()->getHeaders() : null,
                    $e->getResponse() ? (string) $e->getResponse()->getBody() : null
                );
            } catch (ConnectException $e) {
                throw new ApiException(
                    "[{$e->getCode()}] {$e->getMessage()}",
                    (int) $e->getCode(),
                    null,
                    null
                );
            }

            $statusCode = $response->getStatusCode();

            if ($statusCode < 200 || $statusCode > 299) {
                throw new ApiException(
                    sprintf(
                        '[%d] Error connecting to the API (%s)',
                        $statusCode,
                        (string) $request->getUri()
                    ),
                    $statusCode,
                    $response->getHeaders(),
                    (string) $response->getBody()
                );
            }

            switch($statusCode) {
                case 200:
                    if ('\Hraph\PaygreenApi\Model\InlineResponse20012' === '\SplFileObject') {
                        $content = $response->getBody(); //stream goes to serializer
                    } else {
                        $content = (string) $response->getBody();
                    }

                    return [
                        ObjectSerializer::deserialize($content, '\Hraph\PaygreenApi\Model\InlineResponse20012', []),
                        $response->getStatusCode(),
                        $response->getHeaders()
                    ];
            }

            $returnType = '\Hraph\PaygreenApi\Model\InlineResponse20012';
            if ($returnType === '\SplFileObject') {
                $content = $response->getBody(); //stream goes to serializer
            } else {
                $content = (string) $response->getBody();
            }

            return [
                ObjectSerializer::deserialize($content, $returnType, []),
                $response->getStatusCode(),
                $response->getHeaders()
            ];

        } catch (ApiException $e) {
            switch ($e->getCode()) {
                case 200:
                    $data = ObjectSerializer::deserialize(
                        $e->getResponseBody(),
                        '\Hraph\PaygreenApi\Model\InlineResponse20012',
                        $e->getResponseHeaders()
                    );
                    $e->setResponseObject($data);
                    break;
            }
            throw $e;
        }
    }

    /**
     * Operation apiIdentifiantPayinsTransactionIdDeleteAsync
     *
     * Remboursement
     *
     * @param  string $identifiant Votre identifiant PayGreen (required)
     * @param  string $authorization Votre clé privée PayGreen (Bearer : votre-clé-privée) (required)
     * @param  string $id ID de la transaction (required)
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Promise\PromiseInterface
     */
    public function apiIdentifiantPayinsTransactionIdDeleteAsync($identifiant, $authorization, $id)
    {
        return $this->apiIdentifiantPayinsTransactionIdDeleteAsyncWithHttpInfo($identifiant, $authorization, $id)
            ->then(
                function ($response) {
                    return $response[0];
                }
            );
    }

    /**
     * Operation apiIdentifiantPayinsTransactionIdDeleteAsyncWithHttpInfo
     *
     * Remboursement
     *
     * @param  string $identifiant Votre identifiant PayGreen (required)
     * @param  string $authorization Votre clé privée PayGreen (Bearer : votre-clé-privée) (required)
     * @param  string $id ID de la transaction (required)
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Promise\PromiseInterface
     */
    public function apiIdentifiantPayinsTransactionIdDeleteAsyncWithHttpInfo($identifiant, $authorization, $id)
    {
        $returnType = '\Hraph\PaygreenApi\Model\InlineResponse20012';
        $request = $this->apiIdentifiantPayinsTransactionIdDeleteRequest($identifiant, $authorization, $id);

        return $this->client
            ->sendAsync($request, $this->createHttpClientOption())
            ->then(
                function ($response) use ($returnType) {
                    if ($returnType === '\SplFileObject') {
                        $content = $response->getBody(); //stream goes to serializer
                    } else {
                        $content = (string) $response->getBody();
                    }

                    return [
                        ObjectSerializer::deserialize($content, $returnType, []),
                        $response->getStatusCode(),
                        $response->getHeaders()
                    ];
                },
                function ($exception) {
                    $response = $exception->getResponse();
                    $statusCode = $response->getStatusCode();
                    throw new ApiException(
                        sprintf(
                            '[%d] Error connecting to the API (%s)',
                            $statusCode,
                            $exception->getRequest()->getUri()
                        ),
                        $statusCode,
                        $response->getHeaders(),
                        (string) $response->getBody()
                    );
                }
            );
    }

    /**
     * Create request for operation 'apiIdentifiantPayinsTransactionIdDelete'
     *
     * @param  string $identifiant Votre identifiant PayGreen (required)
     * @param  string $authorization Votre clé privée PayGreen (Bearer : votre-clé-privée) (required)
     * @param  string $id ID de la transaction (required)
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Psr7\Request
     */
    public function apiIdentifiantPayinsTransactionIdDeleteRequest($identifiant, $authorization, $id)
    {
        // verify the required parameter 'identifiant' is set
        if ($identifiant === null || (is_array($identifiant) && count($identifiant) === 0)) {
            throw new \InvalidArgumentException(
                'Missing the required parameter $identifiant when calling apiIdentifiantPayinsTransactionIdDelete'
            );
        }
        // verify the required parameter 'authorization' is set
        if ($authorization === null || (is_array($authorization) && count($authorization) === 0)) {
            throw new \InvalidArgumentException(
                'Missing the required parameter $authorization when calling apiIdentifiantPayinsTransactionIdDelete'
            );
        }
        // verify the required parameter 'id' is set
        if ($id === null || (is_array($id) && count($id) === 0)) {
            throw new \InvalidArgumentException(
                'Missing the required parameter $id when calling apiIdentifiantPayinsTransactionIdDelete'
            );
        }

        $resourcePath = '/api/{identifiant}/payins/transaction/{id}';
        $formParams = [];
        $queryParams = [];
        $headerParams = [];
        $httpBody = '';
        $multipart = false;


        // header params
        if ($authorization !== null) {
            $headerParams['Authorization'] = ObjectSerializer::toHeaderValue($authorization);
        }

        // path params
        if ($identifiant !== null) {
            $resourcePath = str_replace(
                '{' . 'identifiant' . '}',
                ObjectSerializer::toPathValue($identifiant),
                $resourcePath
            );
        }
        // path params
        if ($id !== null) {
            $resourcePath = str_replace(
                '{' . 'id' . '}',
                ObjectSerializer::toPathValue($id),
                $resourcePath
            );
        }


        if ($multipart) {
            $headers = $this->headerSelector->selectHeadersForMultipart(
                ['application/json']
            );
        } else {
            $headers = $this->headerSelector->selectHeaders(
                ['application/json'],
                []
            );
        }

        // for model (json/xml)
        if (count($formParams) > 0) {
            if ($multipart) {
                $multipartContents = [];
                foreach ($formParams as $formParamName => $formParamValue) {
                    $formParamValueItems = is_array($formParamValue) ? $formParamValue : [$formParamValue];
                    foreach ($formParamValueItems as $formParamValueItem) {
                        $multipartContents[] = [
                            'name' => $formParamName,
                            'contents' => $formParamValueItem
                        ];
                    }
                }
                // for HTTP post (form)
                $httpBody = new MultipartStream($multipartContents);

            } elseif ($headers['Content-Type'] === 'application/json') {
                $httpBody = \GuzzleHttp\json_encode($formParams);

            } else {
                // for HTTP post (form)
                $httpBody = \GuzzleHttp\Psr7\Query::build($formParams);
            }
        }


        $defaultHeaders = [];
        if ($this->config->getUserAgent()) {
            $defaultHeaders['User-Agent'] = $this->config->getUserAgent();
        }

        $headers = array_merge(
            $defaultHeaders,
            $headerParams,
            $headers
        );

        $query = \GuzzleHttp\Psr7\Query::build($queryParams);
        return new Request(
            'DELETE',
            $this->config->getHost() . $resourcePath . ($query ? "?{$query}" : ''),
            $headers,
            $httpBody
        );
    }

    /**
     * Operation apiIdentifiantPayinsTransactionIdGet
     *
     * Détails
     *
     * @param  string $identifiant Votre identifiant PayGreen (required)
     * @param  string $authorization Votre clé privée PayGreen (Bearer : votre-clé-privée) (required)
     * @param  string $id ID de la transaction (required)
     *
     * @throws \Hraph\PaygreenApi\ApiException on non-2xx response
     * @throws \InvalidArgumentException
     * @return \Hraph\PaygreenApi\Model\InlineResponse20012
     */
    public function apiIdentifiantPayinsTransactionIdGet($identifiant, $authorization, $id)
    {
        list($response) = $this->apiIdentifiantPayinsTransactionIdGetWithHttpInfo($identifiant, $authorization, $id);
        return $response;
    }

    /**
     * Operation apiIdentifiantPayinsTransactionIdGetWithHttpInfo
     *
     * Détails
     *
     * @param  string $identifiant Votre identifiant PayGreen (required)
     * @param  string $authorization Votre clé privée PayGreen (Bearer : votre-clé-privée) (required)
     * @param  string $id ID de la transaction (required)
     *
     * @throws \Hraph\PaygreenApi\ApiException on non-2xx response
     * @throws \InvalidArgumentException
     * @return array of \Hraph\PaygreenApi\Model\InlineResponse20012, HTTP status code, HTTP response headers (array of strings)
     */
    public function apiIdentifiantPayinsTransactionIdGetWithHttpInfo($identifiant, $authorization, $id)
    {
        $request = $this->apiIdentifiantPayinsTransactionIdGetRequest($identifiant, $authorization, $id);

        try {
            $options = $this->createHttpClientOption();
            try {
                $response = $this->client->send($request, $options);
            } catch (RequestException $e) {
                throw new ApiException(
                    "[{$e->getCode()}] {$e->getMessage()}",
                    (int) $e->getCode(),
                    $e->getResponse() ? $e->getResponse()->getHeaders() : null,
                    $e->getResponse() ? (string) $e->getResponse()->getBody() : null
                );
            } catch (ConnectException $e) {
                throw new ApiException(
                    "[{$e->getCode()}] {$e->getMessage()}",
                    (int) $e->getCode(),
                    null,
                    null
                );
            }

            $statusCode = $response->getStatusCode();

            if ($statusCode < 200 || $statusCode > 299) {
                throw new ApiException(
                    sprintf(
                        '[%d] Error connecting to the API (%s)',
                        $statusCode,
                        (string) $request->getUri()
                    ),
                    $statusCode,
                    $response->getHeaders(),
                    (string) $response->getBody()
                );
            }

            switch($statusCode) {
                case 200:
                    if ('\Hraph\PaygreenApi\Model\InlineResponse20012' === '\SplFileObject') {
                        $content = $response->getBody(); //stream goes to serializer
                    } else {
                        $content = (string) $response->getBody();
                    }

                    return [
                        ObjectSerializer::deserialize($content, '\Hraph\PaygreenApi\Model\InlineResponse20012', []),
                        $response->getStatusCode(),
                        $response->getHeaders()
                    ];
            }

            $returnType = '\Hraph\PaygreenApi\Model\InlineResponse20012';
            if ($returnType === '\SplFileObject') {
                $content = $response->getBody(); //stream goes to serializer
            } else {
                $content = (string) $response->getBody();
            }

            return [
                ObjectSerializer::deserialize($content, $returnType, []),
                $response->getStatusCode(),
                $response->getHeaders()
            ];

        } catch (ApiException $e) {
            switch ($e->getCode()) {
                case 200:
                    $data = ObjectSerializer::deserialize(
                        $e->getResponseBody(),
                        '\Hraph\PaygreenApi\Model\InlineResponse20012',
                        $e->getResponseHeaders()
                    );
                    $e->setResponseObject($data);
                    break;
            }
            throw $e;
        }
    }

    /**
     * Operation apiIdentifiantPayinsTransactionIdGetAsync
     *
     * Détails
     *
     * @param  string $identifiant Votre identifiant PayGreen (required)
     * @param  string $authorization Votre clé privée PayGreen (Bearer : votre-clé-privée) (required)
     * @param  string $id ID de la transaction (required)
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Promise\PromiseInterface
     */
    public function apiIdentifiantPayinsTransactionIdGetAsync($identifiant, $authorization, $id)
    {
        return $this->apiIdentifiantPayinsTransactionIdGetAsyncWithHttpInfo($identifiant, $authorization, $id)
            ->then(
                function ($response) {
                    return $response[0];
                }
            );
    }

    /**
     * Operation apiIdentifiantPayinsTransactionIdGetAsyncWithHttpInfo
     *
     * Détails
     *
     * @param  string $identifiant Votre identifiant PayGreen (required)
     * @param  string $authorization Votre clé privée PayGreen (Bearer : votre-clé-privée) (required)
     * @param  string $id ID de la transaction (required)
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Promise\PromiseInterface
     */
    public function apiIdentifiantPayinsTransactionIdGetAsyncWithHttpInfo($identifiant, $authorization, $id)
    {
        $returnType = '\Hraph\PaygreenApi\Model\InlineResponse20012';
        $request = $this->apiIdentifiantPayinsTransactionIdGetRequest($identifiant, $authorization, $id);

        return $this->client
            ->sendAsync($request, $this->createHttpClientOption())
            ->then(
                function ($response) use ($returnType) {
                    if ($returnType === '\SplFileObject') {
                        $content = $response->getBody(); //stream goes to serializer
                    } else {
                        $content = (string) $response->getBody();
                    }

                    return [
                        ObjectSerializer::deserialize($content, $returnType, []),
                        $response->getStatusCode(),
                        $response->getHeaders()
                    ];
                },
                function ($exception) {
                    $response = $exception->getResponse();
                    $statusCode = $response->getStatusCode();
                    throw new ApiException(
                        sprintf(
                            '[%d] Error connecting to the API (%s)',
                            $statusCode,
                            $exception->getRequest()->getUri()
                        ),
                        $statusCode,
                        $response->getHeaders(),
                        (string) $response->getBody()
                    );
                }
            );
    }

    /**
     * Create request for operation 'apiIdentifiantPayinsTransactionIdGet'
     *
     * @param  string $identifiant Votre identifiant PayGreen (required)
     * @param  string $authorization Votre clé privée PayGreen (Bearer : votre-clé-privée) (required)
     * @param  string $id ID de la transaction (required)
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Psr7\Request
     */
    public function apiIdentifiantPayinsTransactionIdGetRequest($identifiant, $authorization, $id)
    {
        // verify the required parameter 'identifiant' is set
        if ($identifiant === null || (is_array($identifiant) && count($identifiant) === 0)) {
            throw new \InvalidArgumentException(
                'Missing the required parameter $identifiant when calling apiIdentifiantPayinsTransactionIdGet'
            );
        }
        // verify the required parameter 'authorization' is set
        if ($authorization === null || (is_array($authorization) && count($authorization) === 0)) {
            throw new \InvalidArgumentException(
                'Missing the required parameter $authorization when calling apiIdentifiantPayinsTransactionIdGet'
            );
        }
        // verify the required parameter 'id' is set
        if ($id === null || (is_array($id) && count($id) === 0)) {
            throw new \InvalidArgumentException(
                'Missing the required parameter $id when calling apiIdentifiantPayinsTransactionIdGet'
            );
        }

        $resourcePath = '/api/{identifiant}/payins/transaction/{id}';
        $formParams = [];
        $queryParams = [];
        $headerParams = [];
        $httpBody = '';
        $multipart = false;


        // header params
        if ($authorization !== null) {
            $headerParams['Authorization'] = ObjectSerializer::toHeaderValue($authorization);
        }

        // path params
        if ($identifiant !== null) {
            $resourcePath = str_replace(
                '{' . 'identifiant' . '}',
                ObjectSerializer::toPathValue($identifiant),
                $resourcePath
            );
        }
        // path params
        if ($id !== null) {
            $resourcePath = str_replace(
                '{' . 'id' . '}',
                ObjectSerializer::toPathValue($id),
                $resourcePath
            );
        }


        if ($multipart) {
            $headers = $this->headerSelector->selectHeadersForMultipart(
                ['application/json']
            );
        } else {
            $headers = $this->headerSelector->selectHeaders(
                ['application/json'],
                []
            );
        }

        // for model (json/xml)
        if (count($formParams) > 0) {
            if ($multipart) {
                $multipartContents = [];
                foreach ($formParams as $formParamName => $formParamValue) {
                    $formParamValueItems = is_array($formParamValue) ? $formParamValue : [$formParamValue];
                    foreach ($formParamValueItems as $formParamValueItem) {
                        $multipartContents[] = [
                            'name' => $formParamName,
                            'contents' => $formParamValueItem
                        ];
                    }
                }
                // for HTTP post (form)
                $httpBody = new MultipartStream($multipartContents);

            } elseif ($headers['Content-Type'] === 'application/json') {
                $httpBody = \GuzzleHttp\json_encode($formParams);

            } else {
                // for HTTP post (form)
                $httpBody = \GuzzleHttp\Psr7\Query::build($formParams);
            }
        }


        $defaultHeaders = [];
        if ($this->config->getUserAgent()) {
            $defaultHeaders['User-Agent'] = $this->config->getUserAgent();
        }

        $headers = array_merge(
            $defaultHeaders,
            $headerParams,
            $headers
        );

        $query = \GuzzleHttp\Psr7\Query::build($queryParams);
        return new Request(
            'GET',
            $this->config->getHost() . $resourcePath . ($query ? "?{$query}" : ''),
            $headers,
            $httpBody
        );
    }

    /**
     * Operation apiIdentifiantPayinsTransactionIdPatch
     *
     * Modification du montant
     *
     * @param  string $identifiant Votre identifiant PayGreen (required)
     * @param  string $authorization Votre clé privée PayGreen (Bearer : votre-clé-privée) (required)
     * @param  string $id ID de la transaction (required)
     * @param  \Hraph\PaygreenApi\Model\PatchAmount $patch_amount Le montant de la transaction doit être en centimes. (required)
     *
     * @throws \Hraph\PaygreenApi\ApiException on non-2xx response
     * @throws \InvalidArgumentException
     * @return \Hraph\PaygreenApi\Model\InlineResponse20012
     */
    public function apiIdentifiantPayinsTransactionIdPatch($identifiant, $authorization, $id, $patch_amount)
    {
        list($response) = $this->apiIdentifiantPayinsTransactionIdPatchWithHttpInfo($identifiant, $authorization, $id, $patch_amount);
        return $response;
    }

    /**
     * Operation apiIdentifiantPayinsTransactionIdPatchWithHttpInfo
     *
     * Modification du montant
     *
     * @param  string $identifiant Votre identifiant PayGreen (required)
     * @param  string $authorization Votre clé privée PayGreen (Bearer : votre-clé-privée) (required)
     * @param  string $id ID de la transaction (required)
     * @param  \Hraph\PaygreenApi\Model\PatchAmount $patch_amount Le montant de la transaction doit être en centimes. (required)
     *
     * @throws \Hraph\PaygreenApi\ApiException on non-2xx response
     * @throws \InvalidArgumentException
     * @return array of \Hraph\PaygreenApi\Model\InlineResponse20012, HTTP status code, HTTP response headers (array of strings)
     */
    public function apiIdentifiantPayinsTransactionIdPatchWithHttpInfo($identifiant, $authorization, $id, $patch_amount)
    {
        $request = $this->apiIdentifiantPayinsTransactionIdPatchRequest($identifiant, $authorization, $id, $patch_amount);

        try {
            $options = $this->createHttpClientOption();
            try {
                $response = $this->client->send($request, $options);
            } catch (RequestException $e) {
                throw new ApiException(
                    "[{$e->getCode()}] {$e->getMessage()}",
                    (int) $e->getCode(),
                    $e->getResponse() ? $e->getResponse()->getHeaders() : null,
                    $e->getResponse() ? (string) $e->getResponse()->getBody() : null
                );
            } catch (ConnectException $e) {
                throw new ApiException(
                    "[{$e->getCode()}] {$e->getMessage()}",
                    (int) $e->getCode(),
                    null,
                    null
                );
            }

            $statusCode = $response->getStatusCode();

            if ($statusCode < 200 || $statusCode > 299) {
                throw new ApiException(
                    sprintf(
                        '[%d] Error connecting to the API (%s)',
                        $statusCode,
                        (string) $request->getUri()
                    ),
                    $statusCode,
                    $response->getHeaders(),
                    (string) $response->getBody()
                );
            }

            switch($statusCode) {
                case 200:
                    if ('\Hraph\PaygreenApi\Model\InlineResponse20012' === '\SplFileObject') {
                        $content = $response->getBody(); //stream goes to serializer
                    } else {
                        $content = (string) $response->getBody();
                    }

                    return [
                        ObjectSerializer::deserialize($content, '\Hraph\PaygreenApi\Model\InlineResponse20012', []),
                        $response->getStatusCode(),
                        $response->getHeaders()
                    ];
            }

            $returnType = '\Hraph\PaygreenApi\Model\InlineResponse20012';
            if ($returnType === '\SplFileObject') {
                $content = $response->getBody(); //stream goes to serializer
            } else {
                $content = (string) $response->getBody();
            }

            return [
                ObjectSerializer::deserialize($content, $returnType, []),
                $response->getStatusCode(),
                $response->getHeaders()
            ];

        } catch (ApiException $e) {
            switch ($e->getCode()) {
                case 200:
                    $data = ObjectSerializer::deserialize(
                        $e->getResponseBody(),
                        '\Hraph\PaygreenApi\Model\InlineResponse20012',
                        $e->getResponseHeaders()
                    );
                    $e->setResponseObject($data);
                    break;
            }
            throw $e;
        }
    }

    /**
     * Operation apiIdentifiantPayinsTransactionIdPatchAsync
     *
     * Modification du montant
     *
     * @param  string $identifiant Votre identifiant PayGreen (required)
     * @param  string $authorization Votre clé privée PayGreen (Bearer : votre-clé-privée) (required)
     * @param  string $id ID de la transaction (required)
     * @param  \Hraph\PaygreenApi\Model\PatchAmount $patch_amount Le montant de la transaction doit être en centimes. (required)
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Promise\PromiseInterface
     */
    public function apiIdentifiantPayinsTransactionIdPatchAsync($identifiant, $authorization, $id, $patch_amount)
    {
        return $this->apiIdentifiantPayinsTransactionIdPatchAsyncWithHttpInfo($identifiant, $authorization, $id, $patch_amount)
            ->then(
                function ($response) {
                    return $response[0];
                }
            );
    }

    /**
     * Operation apiIdentifiantPayinsTransactionIdPatchAsyncWithHttpInfo
     *
     * Modification du montant
     *
     * @param  string $identifiant Votre identifiant PayGreen (required)
     * @param  string $authorization Votre clé privée PayGreen (Bearer : votre-clé-privée) (required)
     * @param  string $id ID de la transaction (required)
     * @param  \Hraph\PaygreenApi\Model\PatchAmount $patch_amount Le montant de la transaction doit être en centimes. (required)
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Promise\PromiseInterface
     */
    public function apiIdentifiantPayinsTransactionIdPatchAsyncWithHttpInfo($identifiant, $authorization, $id, $patch_amount)
    {
        $returnType = '\Hraph\PaygreenApi\Model\InlineResponse20012';
        $request = $this->apiIdentifiantPayinsTransactionIdPatchRequest($identifiant, $authorization, $id, $patch_amount);

        return $this->client
            ->sendAsync($request, $this->createHttpClientOption())
            ->then(
                function ($response) use ($returnType) {
                    if ($returnType === '\SplFileObject') {
                        $content = $response->getBody(); //stream goes to serializer
                    } else {
                        $content = (string) $response->getBody();
                    }

                    return [
                        ObjectSerializer::deserialize($content, $returnType, []),
                        $response->getStatusCode(),
                        $response->getHeaders()
                    ];
                },
                function ($exception) {
                    $response = $exception->getResponse();
                    $statusCode = $response->getStatusCode();
                    throw new ApiException(
                        sprintf(
                            '[%d] Error connecting to the API (%s)',
                            $statusCode,
                            $exception->getRequest()->getUri()
                        ),
                        $statusCode,
                        $response->getHeaders(),
                        (string) $response->getBody()
                    );
                }
            );
    }

    /**
     * Create request for operation 'apiIdentifiantPayinsTransactionIdPatch'
     *
     * @param  string $identifiant Votre identifiant PayGreen (required)
     * @param  string $authorization Votre clé privée PayGreen (Bearer : votre-clé-privée) (required)
     * @param  string $id ID de la transaction (required)
     * @param  \Hraph\PaygreenApi\Model\PatchAmount $patch_amount Le montant de la transaction doit être en centimes. (required)
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Psr7\Request
     */
    public function apiIdentifiantPayinsTransactionIdPatchRequest($identifiant, $authorization, $id, $patch_amount)
    {
        // verify the required parameter 'identifiant' is set
        if ($identifiant === null || (is_array($identifiant) && count($identifiant) === 0)) {
            throw new \InvalidArgumentException(
                'Missing the required parameter $identifiant when calling apiIdentifiantPayinsTransactionIdPatch'
            );
        }
        // verify the required parameter 'authorization' is set
        if ($authorization === null || (is_array($authorization) && count($authorization) === 0)) {
            throw new \InvalidArgumentException(
                'Missing the required parameter $authorization when calling apiIdentifiantPayinsTransactionIdPatch'
            );
        }
        // verify the required parameter 'id' is set
        if ($id === null || (is_array($id) && count($id) === 0)) {
            throw new \InvalidArgumentException(
                'Missing the required parameter $id when calling apiIdentifiantPayinsTransactionIdPatch'
            );
        }
        // verify the required parameter 'patch_amount' is set
        if ($patch_amount === null || (is_array($patch_amount) && count($patch_amount) === 0)) {
            throw new \InvalidArgumentException(
                'Missing the required parameter $patch_amount when calling apiIdentifiantPayinsTransactionIdPatch'
            );
        }

        $resourcePath = '/api/{identifiant}/payins/transaction/{id}';
        $formParams = [];
        $queryParams = [];
        $headerParams = [];
        $httpBody = '';
        $multipart = false;


        // header params
        if ($authorization !== null) {
            $headerParams['Authorization'] = ObjectSerializer::toHeaderValue($authorization);
        }

        // path params
        if ($identifiant !== null) {
            $resourcePath = str_replace(
                '{' . 'identifiant' . '}',
                ObjectSerializer::toPathValue($identifiant),
                $resourcePath
            );
        }
        // path params
        if ($id !== null) {
            $resourcePath = str_replace(
                '{' . 'id' . '}',
                ObjectSerializer::toPathValue($id),
                $resourcePath
            );
        }


        if ($multipart) {
            $headers = $this->headerSelector->selectHeadersForMultipart(
                ['application/json']
            );
        } else {
            $headers = $this->headerSelector->selectHeaders(
                ['application/json'],
                ['application/json']
            );
        }

        // for model (json/xml)
        if (isset($patch_amount)) {
            if ($headers['Content-Type'] === 'application/json') {
                $httpBody = \GuzzleHttp\json_encode(ObjectSerializer::sanitizeForSerialization($patch_amount));
            } else {
                $httpBody = $patch_amount;
            }
        } elseif (count($formParams) > 0) {
            if ($multipart) {
                $multipartContents = [];
                foreach ($formParams as $formParamName => $formParamValue) {
                    $formParamValueItems = is_array($formParamValue) ? $formParamValue : [$formParamValue];
                    foreach ($formParamValueItems as $formParamValueItem) {
                        $multipartContents[] = [
                            'name' => $formParamName,
                            'contents' => $formParamValueItem
                        ];
                    }
                }
                // for HTTP post (form)
                $httpBody = new MultipartStream($multipartContents);

            } elseif ($headers['Content-Type'] === 'application/json') {
                $httpBody = \GuzzleHttp\json_encode($formParams);

            } else {
                // for HTTP post (form)
                $httpBody = \GuzzleHttp\Psr7\Query::build($formParams);
            }
        }


        $defaultHeaders = [];
        if ($this->config->getUserAgent()) {
            $defaultHeaders['User-Agent'] = $this->config->getUserAgent();
        }

        $headers = array_merge(
            $defaultHeaders,
            $headerParams,
            $headers
        );

        $query = \GuzzleHttp\Psr7\Query::build($queryParams);
        return new Request(
            'PATCH',
            $this->config->getHost() . $resourcePath . ($query ? "?{$query}" : ''),
            $headers,
            $httpBody
        );
    }

    /**
     * Operation apiIdentifiantPayinsTransactionIdPut
     *
     * Confirmer une transaction
     *
     * @param  string $identifiant Votre identifiant PayGreen (required)
     * @param  string $authorization Votre clé privée PayGreen (Bearer : votre-clé-privée) (required)
     * @param  string $id ID de la transaction (required)
     * @param  \Hraph\PaygreenApi\Model\ExecuteTransaction $execute_transaction Le montant de la transaction doit être en centimes. (required)
     *
     * @throws \Hraph\PaygreenApi\ApiException on non-2xx response
     * @throws \InvalidArgumentException
     * @return \Hraph\PaygreenApi\Model\InlineResponse20012
     */
    public function apiIdentifiantPayinsTransactionIdPut($identifiant, $authorization, $id, $execute_transaction)
    {
        list($response) = $this->apiIdentifiantPayinsTransactionIdPutWithHttpInfo($identifiant, $authorization, $id, $execute_transaction);
        return $response;
    }

    /**
     * Operation apiIdentifiantPayinsTransactionIdPutWithHttpInfo
     *
     * Confirmer une transaction
     *
     * @param  string $identifiant Votre identifiant PayGreen (required)
     * @param  string $authorization Votre clé privée PayGreen (Bearer : votre-clé-privée) (required)
     * @param  string $id ID de la transaction (required)
     * @param  \Hraph\PaygreenApi\Model\ExecuteTransaction $execute_transaction Le montant de la transaction doit être en centimes. (required)
     *
     * @throws \Hraph\PaygreenApi\ApiException on non-2xx response
     * @throws \InvalidArgumentException
     * @return array of \Hraph\PaygreenApi\Model\InlineResponse20012, HTTP status code, HTTP response headers (array of strings)
     */
    public function apiIdentifiantPayinsTransactionIdPutWithHttpInfo($identifiant, $authorization, $id, $execute_transaction)
    {
        $request = $this->apiIdentifiantPayinsTransactionIdPutRequest($identifiant, $authorization, $id, $execute_transaction);

        try {
            $options = $this->createHttpClientOption();
            try {
                $response = $this->client->send($request, $options);
            } catch (RequestException $e) {
                throw new ApiException(
                    "[{$e->getCode()}] {$e->getMessage()}",
                    (int) $e->getCode(),
                    $e->getResponse() ? $e->getResponse()->getHeaders() : null,
                    $e->getResponse() ? (string) $e->getResponse()->getBody() : null
                );
            } catch (ConnectException $e) {
                throw new ApiException(
                    "[{$e->getCode()}] {$e->getMessage()}",
                    (int) $e->getCode(),
                    null,
                    null
                );
            }

            $statusCode = $response->getStatusCode();

            if ($statusCode < 200 || $statusCode > 299) {
                throw new ApiException(
                    sprintf(
                        '[%d] Error connecting to the API (%s)',
                        $statusCode,
                        (string) $request->getUri()
                    ),
                    $statusCode,
                    $response->getHeaders(),
                    (string) $response->getBody()
                );
            }

            switch($statusCode) {
                case 200:
                    if ('\Hraph\PaygreenApi\Model\InlineResponse20012' === '\SplFileObject') {
                        $content = $response->getBody(); //stream goes to serializer
                    } else {
                        $content = (string) $response->getBody();
                    }

                    return [
                        ObjectSerializer::deserialize($content, '\Hraph\PaygreenApi\Model\InlineResponse20012', []),
                        $response->getStatusCode(),
                        $response->getHeaders()
                    ];
            }

            $returnType = '\Hraph\PaygreenApi\Model\InlineResponse20012';
            if ($returnType === '\SplFileObject') {
                $content = $response->getBody(); //stream goes to serializer
            } else {
                $content = (string) $response->getBody();
            }

            return [
                ObjectSerializer::deserialize($content, $returnType, []),
                $response->getStatusCode(),
                $response->getHeaders()
            ];

        } catch (ApiException $e) {
            switch ($e->getCode()) {
                case 200:
                    $data = ObjectSerializer::deserialize(
                        $e->getResponseBody(),
                        '\Hraph\PaygreenApi\Model\InlineResponse20012',
                        $e->getResponseHeaders()
                    );
                    $e->setResponseObject($data);
                    break;
            }
            throw $e;
        }
    }

    /**
     * Operation apiIdentifiantPayinsTransactionIdPutAsync
     *
     * Confirmer une transaction
     *
     * @param  string $identifiant Votre identifiant PayGreen (required)
     * @param  string $authorization Votre clé privée PayGreen (Bearer : votre-clé-privée) (required)
     * @param  string $id ID de la transaction (required)
     * @param  \Hraph\PaygreenApi\Model\ExecuteTransaction $execute_transaction Le montant de la transaction doit être en centimes. (required)
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Promise\PromiseInterface
     */
    public function apiIdentifiantPayinsTransactionIdPutAsync($identifiant, $authorization, $id, $execute_transaction)
    {
        return $this->apiIdentifiantPayinsTransactionIdPutAsyncWithHttpInfo($identifiant, $authorization, $id, $execute_transaction)
            ->then(
                function ($response) {
                    return $response[0];
                }
            );
    }

    /**
     * Operation apiIdentifiantPayinsTransactionIdPutAsyncWithHttpInfo
     *
     * Confirmer une transaction
     *
     * @param  string $identifiant Votre identifiant PayGreen (required)
     * @param  string $authorization Votre clé privée PayGreen (Bearer : votre-clé-privée) (required)
     * @param  string $id ID de la transaction (required)
     * @param  \Hraph\PaygreenApi\Model\ExecuteTransaction $execute_transaction Le montant de la transaction doit être en centimes. (required)
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Promise\PromiseInterface
     */
    public function apiIdentifiantPayinsTransactionIdPutAsyncWithHttpInfo($identifiant, $authorization, $id, $execute_transaction)
    {
        $returnType = '\Hraph\PaygreenApi\Model\InlineResponse20012';
        $request = $this->apiIdentifiantPayinsTransactionIdPutRequest($identifiant, $authorization, $id, $execute_transaction);

        return $this->client
            ->sendAsync($request, $this->createHttpClientOption())
            ->then(
                function ($response) use ($returnType) {
                    if ($returnType === '\SplFileObject') {
                        $content = $response->getBody(); //stream goes to serializer
                    } else {
                        $content = (string) $response->getBody();
                    }

                    return [
                        ObjectSerializer::deserialize($content, $returnType, []),
                        $response->getStatusCode(),
                        $response->getHeaders()
                    ];
                },
                function ($exception) {
                    $response = $exception->getResponse();
                    $statusCode = $response->getStatusCode();
                    throw new ApiException(
                        sprintf(
                            '[%d] Error connecting to the API (%s)',
                            $statusCode,
                            $exception->getRequest()->getUri()
                        ),
                        $statusCode,
                        $response->getHeaders(),
                        (string) $response->getBody()
                    );
                }
            );
    }

    /**
     * Create request for operation 'apiIdentifiantPayinsTransactionIdPut'
     *
     * @param  string $identifiant Votre identifiant PayGreen (required)
     * @param  string $authorization Votre clé privée PayGreen (Bearer : votre-clé-privée) (required)
     * @param  string $id ID de la transaction (required)
     * @param  \Hraph\PaygreenApi\Model\ExecuteTransaction $execute_transaction Le montant de la transaction doit être en centimes. (required)
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Psr7\Request
     */
    public function apiIdentifiantPayinsTransactionIdPutRequest($identifiant, $authorization, $id, $execute_transaction)
    {
        // verify the required parameter 'identifiant' is set
        if ($identifiant === null || (is_array($identifiant) && count($identifiant) === 0)) {
            throw new \InvalidArgumentException(
                'Missing the required parameter $identifiant when calling apiIdentifiantPayinsTransactionIdPut'
            );
        }
        // verify the required parameter 'authorization' is set
        if ($authorization === null || (is_array($authorization) && count($authorization) === 0)) {
            throw new \InvalidArgumentException(
                'Missing the required parameter $authorization when calling apiIdentifiantPayinsTransactionIdPut'
            );
        }
        // verify the required parameter 'id' is set
        if ($id === null || (is_array($id) && count($id) === 0)) {
            throw new \InvalidArgumentException(
                'Missing the required parameter $id when calling apiIdentifiantPayinsTransactionIdPut'
            );
        }
        // verify the required parameter 'execute_transaction' is set
        if ($execute_transaction === null || (is_array($execute_transaction) && count($execute_transaction) === 0)) {
            throw new \InvalidArgumentException(
                'Missing the required parameter $execute_transaction when calling apiIdentifiantPayinsTransactionIdPut'
            );
        }

        $resourcePath = '/api/{identifiant}/payins/transaction/{id}';
        $formParams = [];
        $queryParams = [];
        $headerParams = [];
        $httpBody = '';
        $multipart = false;


        // header params
        if ($authorization !== null) {
            $headerParams['Authorization'] = ObjectSerializer::toHeaderValue($authorization);
        }

        // path params
        if ($identifiant !== null) {
            $resourcePath = str_replace(
                '{' . 'identifiant' . '}',
                ObjectSerializer::toPathValue($identifiant),
                $resourcePath
            );
        }
        // path params
        if ($id !== null) {
            $resourcePath = str_replace(
                '{' . 'id' . '}',
                ObjectSerializer::toPathValue($id),
                $resourcePath
            );
        }


        if ($multipart) {
            $headers = $this->headerSelector->selectHeadersForMultipart(
                ['application/json']
            );
        } else {
            $headers = $this->headerSelector->selectHeaders(
                ['application/json'],
                ['application/json']
            );
        }

        // for model (json/xml)
        if (isset($execute_transaction)) {
            if ($headers['Content-Type'] === 'application/json') {
                $httpBody = \GuzzleHttp\json_encode(ObjectSerializer::sanitizeForSerialization($execute_transaction));
            } else {
                $httpBody = $execute_transaction;
            }
        } elseif (count($formParams) > 0) {
            if ($multipart) {
                $multipartContents = [];
                foreach ($formParams as $formParamName => $formParamValue) {
                    $formParamValueItems = is_array($formParamValue) ? $formParamValue : [$formParamValue];
                    foreach ($formParamValueItems as $formParamValueItem) {
                        $multipartContents[] = [
                            'name' => $formParamName,
                            'contents' => $formParamValueItem
                        ];
                    }
                }
                // for HTTP post (form)
                $httpBody = new MultipartStream($multipartContents);

            } elseif ($headers['Content-Type'] === 'application/json') {
                $httpBody = \GuzzleHttp\json_encode($formParams);

            } else {
                // for HTTP post (form)
                $httpBody = \GuzzleHttp\Psr7\Query::build($formParams);
            }
        }


        $defaultHeaders = [];
        if ($this->config->getUserAgent()) {
            $defaultHeaders['User-Agent'] = $this->config->getUserAgent();
        }

        $headers = array_merge(
            $defaultHeaders,
            $headerParams,
            $headers
        );

        $query = \GuzzleHttp\Psr7\Query::build($queryParams);
        return new Request(
            'PUT',
            $this->config->getHost() . $resourcePath . ($query ? "?{$query}" : ''),
            $headers,
            $httpBody
        );
    }

    /**
     * Operation apiIdentifiantPayinsTransactionSubscriptionPost
     *
     * Paiement abonnement
     *
     * @param  string $identifiant Votre identifiant PayGreen (required)
     * @param  string $authorization Votre clé privée PayGreen (Bearer : votre-clé-privée) (required)
     * @param  \Hraph\PaygreenApi\Model\PayinsRecc $payins_recc Transaction abonnement ou N fois (required)
     *
     * @throws \Hraph\PaygreenApi\ApiException on non-2xx response
     * @throws \InvalidArgumentException
     * @return \Hraph\PaygreenApi\Model\InlineResponse20012
     */
    public function apiIdentifiantPayinsTransactionSubscriptionPost($identifiant, $authorization, $payins_recc)
    {
        list($response) = $this->apiIdentifiantPayinsTransactionSubscriptionPostWithHttpInfo($identifiant, $authorization, $payins_recc);
        return $response;
    }

    /**
     * Operation apiIdentifiantPayinsTransactionSubscriptionPostWithHttpInfo
     *
     * Paiement abonnement
     *
     * @param  string $identifiant Votre identifiant PayGreen (required)
     * @param  string $authorization Votre clé privée PayGreen (Bearer : votre-clé-privée) (required)
     * @param  \Hraph\PaygreenApi\Model\PayinsRecc $payins_recc Transaction abonnement ou N fois (required)
     *
     * @throws \Hraph\PaygreenApi\ApiException on non-2xx response
     * @throws \InvalidArgumentException
     * @return array of \Hraph\PaygreenApi\Model\InlineResponse20012, HTTP status code, HTTP response headers (array of strings)
     */
    public function apiIdentifiantPayinsTransactionSubscriptionPostWithHttpInfo($identifiant, $authorization, $payins_recc)
    {
        $request = $this->apiIdentifiantPayinsTransactionSubscriptionPostRequest($identifiant, $authorization, $payins_recc);

        try {
            $options = $this->createHttpClientOption();
            try {
                $response = $this->client->send($request, $options);
            } catch (RequestException $e) {
                throw new ApiException(
                    "[{$e->getCode()}] {$e->getMessage()}",
                    (int) $e->getCode(),
                    $e->getResponse() ? $e->getResponse()->getHeaders() : null,
                    $e->getResponse() ? (string) $e->getResponse()->getBody() : null
                );
            } catch (ConnectException $e) {
                throw new ApiException(
                    "[{$e->getCode()}] {$e->getMessage()}",
                    (int) $e->getCode(),
                    null,
                    null
                );
            }

            $statusCode = $response->getStatusCode();

            if ($statusCode < 200 || $statusCode > 299) {
                throw new ApiException(
                    sprintf(
                        '[%d] Error connecting to the API (%s)',
                        $statusCode,
                        (string) $request->getUri()
                    ),
                    $statusCode,
                    $response->getHeaders(),
                    (string) $response->getBody()
                );
            }

            switch($statusCode) {
                case 200:
                    if ('\Hraph\PaygreenApi\Model\InlineResponse20012' === '\SplFileObject') {
                        $content = $response->getBody(); //stream goes to serializer
                    } else {
                        $content = (string) $response->getBody();
                    }

                    return [
                        ObjectSerializer::deserialize($content, '\Hraph\PaygreenApi\Model\InlineResponse20012', []),
                        $response->getStatusCode(),
                        $response->getHeaders()
                    ];
            }

            $returnType = '\Hraph\PaygreenApi\Model\InlineResponse20012';
            if ($returnType === '\SplFileObject') {
                $content = $response->getBody(); //stream goes to serializer
            } else {
                $content = (string) $response->getBody();
            }

            return [
                ObjectSerializer::deserialize($content, $returnType, []),
                $response->getStatusCode(),
                $response->getHeaders()
            ];

        } catch (ApiException $e) {
            switch ($e->getCode()) {
                case 200:
                    $data = ObjectSerializer::deserialize(
                        $e->getResponseBody(),
                        '\Hraph\PaygreenApi\Model\InlineResponse20012',
                        $e->getResponseHeaders()
                    );
                    $e->setResponseObject($data);
                    break;
            }
            throw $e;
        }
    }

    /**
     * Operation apiIdentifiantPayinsTransactionSubscriptionPostAsync
     *
     * Paiement abonnement
     *
     * @param  string $identifiant Votre identifiant PayGreen (required)
     * @param  string $authorization Votre clé privée PayGreen (Bearer : votre-clé-privée) (required)
     * @param  \Hraph\PaygreenApi\Model\PayinsRecc $payins_recc Transaction abonnement ou N fois (required)
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Promise\PromiseInterface
     */
    public function apiIdentifiantPayinsTransactionSubscriptionPostAsync($identifiant, $authorization, $payins_recc)
    {
        return $this->apiIdentifiantPayinsTransactionSubscriptionPostAsyncWithHttpInfo($identifiant, $authorization, $payins_recc)
            ->then(
                function ($response) {
                    return $response[0];
                }
            );
    }

    /**
     * Operation apiIdentifiantPayinsTransactionSubscriptionPostAsyncWithHttpInfo
     *
     * Paiement abonnement
     *
     * @param  string $identifiant Votre identifiant PayGreen (required)
     * @param  string $authorization Votre clé privée PayGreen (Bearer : votre-clé-privée) (required)
     * @param  \Hraph\PaygreenApi\Model\PayinsRecc $payins_recc Transaction abonnement ou N fois (required)
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Promise\PromiseInterface
     */
    public function apiIdentifiantPayinsTransactionSubscriptionPostAsyncWithHttpInfo($identifiant, $authorization, $payins_recc)
    {
        $returnType = '\Hraph\PaygreenApi\Model\InlineResponse20012';
        $request = $this->apiIdentifiantPayinsTransactionSubscriptionPostRequest($identifiant, $authorization, $payins_recc);

        return $this->client
            ->sendAsync($request, $this->createHttpClientOption())
            ->then(
                function ($response) use ($returnType) {
                    if ($returnType === '\SplFileObject') {
                        $content = $response->getBody(); //stream goes to serializer
                    } else {
                        $content = (string) $response->getBody();
                    }

                    return [
                        ObjectSerializer::deserialize($content, $returnType, []),
                        $response->getStatusCode(),
                        $response->getHeaders()
                    ];
                },
                function ($exception) {
                    $response = $exception->getResponse();
                    $statusCode = $response->getStatusCode();
                    throw new ApiException(
                        sprintf(
                            '[%d] Error connecting to the API (%s)',
                            $statusCode,
                            $exception->getRequest()->getUri()
                        ),
                        $statusCode,
                        $response->getHeaders(),
                        (string) $response->getBody()
                    );
                }
            );
    }

    /**
     * Create request for operation 'apiIdentifiantPayinsTransactionSubscriptionPost'
     *
     * @param  string $identifiant Votre identifiant PayGreen (required)
     * @param  string $authorization Votre clé privée PayGreen (Bearer : votre-clé-privée) (required)
     * @param  \Hraph\PaygreenApi\Model\PayinsRecc $payins_recc Transaction abonnement ou N fois (required)
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Psr7\Request
     */
    public function apiIdentifiantPayinsTransactionSubscriptionPostRequest($identifiant, $authorization, $payins_recc)
    {
        // verify the required parameter 'identifiant' is set
        if ($identifiant === null || (is_array($identifiant) && count($identifiant) === 0)) {
            throw new \InvalidArgumentException(
                'Missing the required parameter $identifiant when calling apiIdentifiantPayinsTransactionSubscriptionPost'
            );
        }
        // verify the required parameter 'authorization' is set
        if ($authorization === null || (is_array($authorization) && count($authorization) === 0)) {
            throw new \InvalidArgumentException(
                'Missing the required parameter $authorization when calling apiIdentifiantPayinsTransactionSubscriptionPost'
            );
        }
        // verify the required parameter 'payins_recc' is set
        if ($payins_recc === null || (is_array($payins_recc) && count($payins_recc) === 0)) {
            throw new \InvalidArgumentException(
                'Missing the required parameter $payins_recc when calling apiIdentifiantPayinsTransactionSubscriptionPost'
            );
        }

        $resourcePath = '/api/{identifiant}/payins/transaction/subscription';
        $formParams = [];
        $queryParams = [];
        $headerParams = [];
        $httpBody = '';
        $multipart = false;


        // header params
        if ($authorization !== null) {
            $headerParams['Authorization'] = ObjectSerializer::toHeaderValue($authorization);
        }

        // path params
        if ($identifiant !== null) {
            $resourcePath = str_replace(
                '{' . 'identifiant' . '}',
                ObjectSerializer::toPathValue($identifiant),
                $resourcePath
            );
        }


        if ($multipart) {
            $headers = $this->headerSelector->selectHeadersForMultipart(
                ['application/json']
            );
        } else {
            $headers = $this->headerSelector->selectHeaders(
                ['application/json'],
                ['application/json']
            );
        }

        // for model (json/xml)
        if (isset($payins_recc)) {
            if ($headers['Content-Type'] === 'application/json') {
                $httpBody = \GuzzleHttp\json_encode(ObjectSerializer::sanitizeForSerialization($payins_recc));
            } else {
                $httpBody = $payins_recc;
            }
        } elseif (count($formParams) > 0) {
            if ($multipart) {
                $multipartContents = [];
                foreach ($formParams as $formParamName => $formParamValue) {
                    $formParamValueItems = is_array($formParamValue) ? $formParamValue : [$formParamValue];
                    foreach ($formParamValueItems as $formParamValueItem) {
                        $multipartContents[] = [
                            'name' => $formParamName,
                            'contents' => $formParamValueItem
                        ];
                    }
                }
                // for HTTP post (form)
                $httpBody = new MultipartStream($multipartContents);

            } elseif ($headers['Content-Type'] === 'application/json') {
                $httpBody = \GuzzleHttp\json_encode($formParams);

            } else {
                // for HTTP post (form)
                $httpBody = \GuzzleHttp\Psr7\Query::build($formParams);
            }
        }


        $defaultHeaders = [];
        if ($this->config->getUserAgent()) {
            $defaultHeaders['User-Agent'] = $this->config->getUserAgent();
        }

        $headers = array_merge(
            $defaultHeaders,
            $headerParams,
            $headers
        );

        $query = \GuzzleHttp\Psr7\Query::build($queryParams);
        return new Request(
            'POST',
            $this->config->getHost() . $resourcePath . ($query ? "?{$query}" : ''),
            $headers,
            $httpBody
        );
    }

    /**
     * Operation apiIdentifiantPayinsTransactionTokenizePost
     *
     * Paiement avec confirmation
     *
     * @param  string $identifiant Votre identifiant PayGreen (required)
     * @param  string $authorization Votre clé privée PayGreen (Bearer : votre-clé-privée) (required)
     * @param  \Hraph\PaygreenApi\Model\Payins $payins Transaction comptant ou à la livraison (required)
     *
     * @throws \Hraph\PaygreenApi\ApiException on non-2xx response
     * @throws \InvalidArgumentException
     * @return \Hraph\PaygreenApi\Model\InlineResponse20012
     */
    public function apiIdentifiantPayinsTransactionTokenizePost($identifiant, $authorization, $payins)
    {
        list($response) = $this->apiIdentifiantPayinsTransactionTokenizePostWithHttpInfo($identifiant, $authorization, $payins);
        return $response;
    }

    /**
     * Operation apiIdentifiantPayinsTransactionTokenizePostWithHttpInfo
     *
     * Paiement avec confirmation
     *
     * @param  string $identifiant Votre identifiant PayGreen (required)
     * @param  string $authorization Votre clé privée PayGreen (Bearer : votre-clé-privée) (required)
     * @param  \Hraph\PaygreenApi\Model\Payins $payins Transaction comptant ou à la livraison (required)
     *
     * @throws \Hraph\PaygreenApi\ApiException on non-2xx response
     * @throws \InvalidArgumentException
     * @return array of \Hraph\PaygreenApi\Model\InlineResponse20012, HTTP status code, HTTP response headers (array of strings)
     */
    public function apiIdentifiantPayinsTransactionTokenizePostWithHttpInfo($identifiant, $authorization, $payins)
    {
        $request = $this->apiIdentifiantPayinsTransactionTokenizePostRequest($identifiant, $authorization, $payins);

        try {
            $options = $this->createHttpClientOption();
            try {
                $response = $this->client->send($request, $options);
            } catch (RequestException $e) {
                throw new ApiException(
                    "[{$e->getCode()}] {$e->getMessage()}",
                    (int) $e->getCode(),
                    $e->getResponse() ? $e->getResponse()->getHeaders() : null,
                    $e->getResponse() ? (string) $e->getResponse()->getBody() : null
                );
            } catch (ConnectException $e) {
                throw new ApiException(
                    "[{$e->getCode()}] {$e->getMessage()}",
                    (int) $e->getCode(),
                    null,
                    null
                );
            }

            $statusCode = $response->getStatusCode();

            if ($statusCode < 200 || $statusCode > 299) {
                throw new ApiException(
                    sprintf(
                        '[%d] Error connecting to the API (%s)',
                        $statusCode,
                        (string) $request->getUri()
                    ),
                    $statusCode,
                    $response->getHeaders(),
                    (string) $response->getBody()
                );
            }

            switch($statusCode) {
                case 200:
                    if ('\Hraph\PaygreenApi\Model\InlineResponse20012' === '\SplFileObject') {
                        $content = $response->getBody(); //stream goes to serializer
                    } else {
                        $content = (string) $response->getBody();
                    }

                    return [
                        ObjectSerializer::deserialize($content, '\Hraph\PaygreenApi\Model\InlineResponse20012', []),
                        $response->getStatusCode(),
                        $response->getHeaders()
                    ];
            }

            $returnType = '\Hraph\PaygreenApi\Model\InlineResponse20012';
            if ($returnType === '\SplFileObject') {
                $content = $response->getBody(); //stream goes to serializer
            } else {
                $content = (string) $response->getBody();
            }

            return [
                ObjectSerializer::deserialize($content, $returnType, []),
                $response->getStatusCode(),
                $response->getHeaders()
            ];

        } catch (ApiException $e) {
            switch ($e->getCode()) {
                case 200:
                    $data = ObjectSerializer::deserialize(
                        $e->getResponseBody(),
                        '\Hraph\PaygreenApi\Model\InlineResponse20012',
                        $e->getResponseHeaders()
                    );
                    $e->setResponseObject($data);
                    break;
            }
            throw $e;
        }
    }

    /**
     * Operation apiIdentifiantPayinsTransactionTokenizePostAsync
     *
     * Paiement avec confirmation
     *
     * @param  string $identifiant Votre identifiant PayGreen (required)
     * @param  string $authorization Votre clé privée PayGreen (Bearer : votre-clé-privée) (required)
     * @param  \Hraph\PaygreenApi\Model\Payins $payins Transaction comptant ou à la livraison (required)
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Promise\PromiseInterface
     */
    public function apiIdentifiantPayinsTransactionTokenizePostAsync($identifiant, $authorization, $payins)
    {
        return $this->apiIdentifiantPayinsTransactionTokenizePostAsyncWithHttpInfo($identifiant, $authorization, $payins)
            ->then(
                function ($response) {
                    return $response[0];
                }
            );
    }

    /**
     * Operation apiIdentifiantPayinsTransactionTokenizePostAsyncWithHttpInfo
     *
     * Paiement avec confirmation
     *
     * @param  string $identifiant Votre identifiant PayGreen (required)
     * @param  string $authorization Votre clé privée PayGreen (Bearer : votre-clé-privée) (required)
     * @param  \Hraph\PaygreenApi\Model\Payins $payins Transaction comptant ou à la livraison (required)
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Promise\PromiseInterface
     */
    public function apiIdentifiantPayinsTransactionTokenizePostAsyncWithHttpInfo($identifiant, $authorization, $payins)
    {
        $returnType = '\Hraph\PaygreenApi\Model\InlineResponse20012';
        $request = $this->apiIdentifiantPayinsTransactionTokenizePostRequest($identifiant, $authorization, $payins);

        return $this->client
            ->sendAsync($request, $this->createHttpClientOption())
            ->then(
                function ($response) use ($returnType) {
                    if ($returnType === '\SplFileObject') {
                        $content = $response->getBody(); //stream goes to serializer
                    } else {
                        $content = (string) $response->getBody();
                    }

                    return [
                        ObjectSerializer::deserialize($content, $returnType, []),
                        $response->getStatusCode(),
                        $response->getHeaders()
                    ];
                },
                function ($exception) {
                    $response = $exception->getResponse();
                    $statusCode = $response->getStatusCode();
                    throw new ApiException(
                        sprintf(
                            '[%d] Error connecting to the API (%s)',
                            $statusCode,
                            $exception->getRequest()->getUri()
                        ),
                        $statusCode,
                        $response->getHeaders(),
                        (string) $response->getBody()
                    );
                }
            );
    }

    /**
     * Create request for operation 'apiIdentifiantPayinsTransactionTokenizePost'
     *
     * @param  string $identifiant Votre identifiant PayGreen (required)
     * @param  string $authorization Votre clé privée PayGreen (Bearer : votre-clé-privée) (required)
     * @param  \Hraph\PaygreenApi\Model\Payins $payins Transaction comptant ou à la livraison (required)
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Psr7\Request
     */
    public function apiIdentifiantPayinsTransactionTokenizePostRequest($identifiant, $authorization, $payins)
    {
        // verify the required parameter 'identifiant' is set
        if ($identifiant === null || (is_array($identifiant) && count($identifiant) === 0)) {
            throw new \InvalidArgumentException(
                'Missing the required parameter $identifiant when calling apiIdentifiantPayinsTransactionTokenizePost'
            );
        }
        // verify the required parameter 'authorization' is set
        if ($authorization === null || (is_array($authorization) && count($authorization) === 0)) {
            throw new \InvalidArgumentException(
                'Missing the required parameter $authorization when calling apiIdentifiantPayinsTransactionTokenizePost'
            );
        }
        // verify the required parameter 'payins' is set
        if ($payins === null || (is_array($payins) && count($payins) === 0)) {
            throw new \InvalidArgumentException(
                'Missing the required parameter $payins when calling apiIdentifiantPayinsTransactionTokenizePost'
            );
        }

        $resourcePath = '/api/{identifiant}/payins/transaction/tokenize';
        $formParams = [];
        $queryParams = [];
        $headerParams = [];
        $httpBody = '';
        $multipart = false;


        // header params
        if ($authorization !== null) {
            $headerParams['Authorization'] = ObjectSerializer::toHeaderValue($authorization);
        }

        // path params
        if ($identifiant !== null) {
            $resourcePath = str_replace(
                '{' . 'identifiant' . '}',
                ObjectSerializer::toPathValue($identifiant),
                $resourcePath
            );
        }


        if ($multipart) {
            $headers = $this->headerSelector->selectHeadersForMultipart(
                ['application/json']
            );
        } else {
            $headers = $this->headerSelector->selectHeaders(
                ['application/json'],
                ['application/json']
            );
        }

        // for model (json/xml)
        if (isset($payins)) {
            if ($headers['Content-Type'] === 'application/json') {
                $httpBody = \GuzzleHttp\json_encode(ObjectSerializer::sanitizeForSerialization($payins));
            } else {
                $httpBody = $payins;
            }
        } elseif (count($formParams) > 0) {
            if ($multipart) {
                $multipartContents = [];
                foreach ($formParams as $formParamName => $formParamValue) {
                    $formParamValueItems = is_array($formParamValue) ? $formParamValue : [$formParamValue];
                    foreach ($formParamValueItems as $formParamValueItem) {
                        $multipartContents[] = [
                            'name' => $formParamName,
                            'contents' => $formParamValueItem
                        ];
                    }
                }
                // for HTTP post (form)
                $httpBody = new MultipartStream($multipartContents);

            } elseif ($headers['Content-Type'] === 'application/json') {
                $httpBody = \GuzzleHttp\json_encode($formParams);

            } else {
                // for HTTP post (form)
                $httpBody = \GuzzleHttp\Psr7\Query::build($formParams);
            }
        }


        $defaultHeaders = [];
        if ($this->config->getUserAgent()) {
            $defaultHeaders['User-Agent'] = $this->config->getUserAgent();
        }

        $headers = array_merge(
            $defaultHeaders,
            $headerParams,
            $headers
        );

        $query = \GuzzleHttp\Psr7\Query::build($queryParams);
        return new Request(
            'POST',
            $this->config->getHost() . $resourcePath . ($query ? "?{$query}" : ''),
            $headers,
            $httpBody
        );
    }

    /**
     * Operation apiIdentifiantPayinsTransactionXtimePost
     *
     * Paiement en plusieurs fois
     *
     * @param  string $identifiant Votre identifiant PayGreen (required)
     * @param  string $authorization Votre clé privée PayGreen (Bearer : votre-clé-privée) (required)
     * @param  \Hraph\PaygreenApi\Model\PayinsRecc $payins_recc Transaction abonnement ou N fois (required)
     *
     * @throws \Hraph\PaygreenApi\ApiException on non-2xx response
     * @throws \InvalidArgumentException
     * @return \Hraph\PaygreenApi\Model\InlineResponse20012
     */
    public function apiIdentifiantPayinsTransactionXtimePost($identifiant, $authorization, $payins_recc)
    {
        list($response) = $this->apiIdentifiantPayinsTransactionXtimePostWithHttpInfo($identifiant, $authorization, $payins_recc);
        return $response;
    }

    /**
     * Operation apiIdentifiantPayinsTransactionXtimePostWithHttpInfo
     *
     * Paiement en plusieurs fois
     *
     * @param  string $identifiant Votre identifiant PayGreen (required)
     * @param  string $authorization Votre clé privée PayGreen (Bearer : votre-clé-privée) (required)
     * @param  \Hraph\PaygreenApi\Model\PayinsRecc $payins_recc Transaction abonnement ou N fois (required)
     *
     * @throws \Hraph\PaygreenApi\ApiException on non-2xx response
     * @throws \InvalidArgumentException
     * @return array of \Hraph\PaygreenApi\Model\InlineResponse20012, HTTP status code, HTTP response headers (array of strings)
     */
    public function apiIdentifiantPayinsTransactionXtimePostWithHttpInfo($identifiant, $authorization, $payins_recc)
    {
        $request = $this->apiIdentifiantPayinsTransactionXtimePostRequest($identifiant, $authorization, $payins_recc);

        try {
            $options = $this->createHttpClientOption();
            try {
                $response = $this->client->send($request, $options);
            } catch (RequestException $e) {
                throw new ApiException(
                    "[{$e->getCode()}] {$e->getMessage()}",
                    (int) $e->getCode(),
                    $e->getResponse() ? $e->getResponse()->getHeaders() : null,
                    $e->getResponse() ? (string) $e->getResponse()->getBody() : null
                );
            } catch (ConnectException $e) {
                throw new ApiException(
                    "[{$e->getCode()}] {$e->getMessage()}",
                    (int) $e->getCode(),
                    null,
                    null
                );
            }

            $statusCode = $response->getStatusCode();

            if ($statusCode < 200 || $statusCode > 299) {
                throw new ApiException(
                    sprintf(
                        '[%d] Error connecting to the API (%s)',
                        $statusCode,
                        (string) $request->getUri()
                    ),
                    $statusCode,
                    $response->getHeaders(),
                    (string) $response->getBody()
                );
            }

            switch($statusCode) {
                case 200:
                    if ('\Hraph\PaygreenApi\Model\InlineResponse20012' === '\SplFileObject') {
                        $content = $response->getBody(); //stream goes to serializer
                    } else {
                        $content = (string) $response->getBody();
                    }

                    return [
                        ObjectSerializer::deserialize($content, '\Hraph\PaygreenApi\Model\InlineResponse20012', []),
                        $response->getStatusCode(),
                        $response->getHeaders()
                    ];
            }

            $returnType = '\Hraph\PaygreenApi\Model\InlineResponse20012';
            if ($returnType === '\SplFileObject') {
                $content = $response->getBody(); //stream goes to serializer
            } else {
                $content = (string) $response->getBody();
            }

            return [
                ObjectSerializer::deserialize($content, $returnType, []),
                $response->getStatusCode(),
                $response->getHeaders()
            ];

        } catch (ApiException $e) {
            switch ($e->getCode()) {
                case 200:
                    $data = ObjectSerializer::deserialize(
                        $e->getResponseBody(),
                        '\Hraph\PaygreenApi\Model\InlineResponse20012',
                        $e->getResponseHeaders()
                    );
                    $e->setResponseObject($data);
                    break;
            }
            throw $e;
        }
    }

    /**
     * Operation apiIdentifiantPayinsTransactionXtimePostAsync
     *
     * Paiement en plusieurs fois
     *
     * @param  string $identifiant Votre identifiant PayGreen (required)
     * @param  string $authorization Votre clé privée PayGreen (Bearer : votre-clé-privée) (required)
     * @param  \Hraph\PaygreenApi\Model\PayinsRecc $payins_recc Transaction abonnement ou N fois (required)
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Promise\PromiseInterface
     */
    public function apiIdentifiantPayinsTransactionXtimePostAsync($identifiant, $authorization, $payins_recc)
    {
        return $this->apiIdentifiantPayinsTransactionXtimePostAsyncWithHttpInfo($identifiant, $authorization, $payins_recc)
            ->then(
                function ($response) {
                    return $response[0];
                }
            );
    }

    /**
     * Operation apiIdentifiantPayinsTransactionXtimePostAsyncWithHttpInfo
     *
     * Paiement en plusieurs fois
     *
     * @param  string $identifiant Votre identifiant PayGreen (required)
     * @param  string $authorization Votre clé privée PayGreen (Bearer : votre-clé-privée) (required)
     * @param  \Hraph\PaygreenApi\Model\PayinsRecc $payins_recc Transaction abonnement ou N fois (required)
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Promise\PromiseInterface
     */
    public function apiIdentifiantPayinsTransactionXtimePostAsyncWithHttpInfo($identifiant, $authorization, $payins_recc)
    {
        $returnType = '\Hraph\PaygreenApi\Model\InlineResponse20012';
        $request = $this->apiIdentifiantPayinsTransactionXtimePostRequest($identifiant, $authorization, $payins_recc);

        return $this->client
            ->sendAsync($request, $this->createHttpClientOption())
            ->then(
                function ($response) use ($returnType) {
                    if ($returnType === '\SplFileObject') {
                        $content = $response->getBody(); //stream goes to serializer
                    } else {
                        $content = (string) $response->getBody();
                    }

                    return [
                        ObjectSerializer::deserialize($content, $returnType, []),
                        $response->getStatusCode(),
                        $response->getHeaders()
                    ];
                },
                function ($exception) {
                    $response = $exception->getResponse();
                    $statusCode = $response->getStatusCode();
                    throw new ApiException(
                        sprintf(
                            '[%d] Error connecting to the API (%s)',
                            $statusCode,
                            $exception->getRequest()->getUri()
                        ),
                        $statusCode,
                        $response->getHeaders(),
                        (string) $response->getBody()
                    );
                }
            );
    }

    /**
     * Create request for operation 'apiIdentifiantPayinsTransactionXtimePost'
     *
     * @param  string $identifiant Votre identifiant PayGreen (required)
     * @param  string $authorization Votre clé privée PayGreen (Bearer : votre-clé-privée) (required)
     * @param  \Hraph\PaygreenApi\Model\PayinsRecc $payins_recc Transaction abonnement ou N fois (required)
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Psr7\Request
     */
    public function apiIdentifiantPayinsTransactionXtimePostRequest($identifiant, $authorization, $payins_recc)
    {
        // verify the required parameter 'identifiant' is set
        if ($identifiant === null || (is_array($identifiant) && count($identifiant) === 0)) {
            throw new \InvalidArgumentException(
                'Missing the required parameter $identifiant when calling apiIdentifiantPayinsTransactionXtimePost'
            );
        }
        // verify the required parameter 'authorization' is set
        if ($authorization === null || (is_array($authorization) && count($authorization) === 0)) {
            throw new \InvalidArgumentException(
                'Missing the required parameter $authorization when calling apiIdentifiantPayinsTransactionXtimePost'
            );
        }
        // verify the required parameter 'payins_recc' is set
        if ($payins_recc === null || (is_array($payins_recc) && count($payins_recc) === 0)) {
            throw new \InvalidArgumentException(
                'Missing the required parameter $payins_recc when calling apiIdentifiantPayinsTransactionXtimePost'
            );
        }

        $resourcePath = '/api/{identifiant}/payins/transaction/xtime';
        $formParams = [];
        $queryParams = [];
        $headerParams = [];
        $httpBody = '';
        $multipart = false;


        // header params
        if ($authorization !== null) {
            $headerParams['Authorization'] = ObjectSerializer::toHeaderValue($authorization);
        }

        // path params
        if ($identifiant !== null) {
            $resourcePath = str_replace(
                '{' . 'identifiant' . '}',
                ObjectSerializer::toPathValue($identifiant),
                $resourcePath
            );
        }


        if ($multipart) {
            $headers = $this->headerSelector->selectHeadersForMultipart(
                ['application/json']
            );
        } else {
            $headers = $this->headerSelector->selectHeaders(
                ['application/json'],
                ['application/json']
            );
        }

        // for model (json/xml)
        if (isset($payins_recc)) {
            if ($headers['Content-Type'] === 'application/json') {
                $httpBody = \GuzzleHttp\json_encode(ObjectSerializer::sanitizeForSerialization($payins_recc));
            } else {
                $httpBody = $payins_recc;
            }
        } elseif (count($formParams) > 0) {
            if ($multipart) {
                $multipartContents = [];
                foreach ($formParams as $formParamName => $formParamValue) {
                    $formParamValueItems = is_array($formParamValue) ? $formParamValue : [$formParamValue];
                    foreach ($formParamValueItems as $formParamValueItem) {
                        $multipartContents[] = [
                            'name' => $formParamName,
                            'contents' => $formParamValueItem
                        ];
                    }
                }
                // for HTTP post (form)
                $httpBody = new MultipartStream($multipartContents);

            } elseif ($headers['Content-Type'] === 'application/json') {
                $httpBody = \GuzzleHttp\json_encode($formParams);

            } else {
                // for HTTP post (form)
                $httpBody = \GuzzleHttp\Psr7\Query::build($formParams);
            }
        }


        $defaultHeaders = [];
        if ($this->config->getUserAgent()) {
            $defaultHeaders['User-Agent'] = $this->config->getUserAgent();
        }

        $headers = array_merge(
            $defaultHeaders,
            $headerParams,
            $headers
        );

        $query = \GuzzleHttp\Psr7\Query::build($queryParams);
        return new Request(
            'POST',
            $this->config->getHost() . $resourcePath . ($query ? "?{$query}" : ''),
            $headers,
            $httpBody
        );
    }

    /**
     * Create http client option
     *
     * @throws \RuntimeException on file opening failure
     * @return array of http client options
     */
    protected function createHttpClientOption()
    {
        $options = [];
        if ($this->config->getDebug()) {
            $options[RequestOptions::DEBUG] = fopen($this->config->getDebugFile(), 'a');
            if (!$options[RequestOptions::DEBUG]) {
                throw new \RuntimeException('Failed to open the debug file: ' . $this->config->getDebugFile());
            }
        }

        return $options;
    }
}
