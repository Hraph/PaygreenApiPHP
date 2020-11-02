<?php
/**
 * AuthentificationOAuthApi
 * PHP version 5
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
 * OpenAPI Generator version: 4.3.1
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
use GuzzleHttp\Psr7\MultipartStream;
use GuzzleHttp\Psr7\Request;
use GuzzleHttp\RequestOptions;
use Hraph\PaygreenApi\ApiException;
use Hraph\PaygreenApi\Configuration;
use Hraph\PaygreenApi\HeaderSelector;
use Hraph\PaygreenApi\ObjectSerializer;

/**
 * AuthentificationOAuthApi Class Doc Comment
 *
 * @category Class
 * @package  Hraph\PaygreenApi
 * @author   OpenAPI Generator team
 * @link     https://openapi-generator.tech
 */
class AuthentificationOAuthApi
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
     * @param int             $host_index (Optional) host index to select the list of hosts if defined in the OpenAPI spec
     */
    public function __construct(
        ClientInterface $client = null,
        Configuration $config = null,
        HeaderSelector $selector = null,
        $host_index = 0
    ) {
        $this->client = $client ?: new Client();
        $this->config = $config ?: new Configuration();
        $this->headerSelector = $selector ?: new HeaderSelector();
        $this->hostIndex = $host_index;
    }

    /**
     * Set the host index
     *
     * @param  int Host index (required)
     */
    public function setHostIndex($host_index)
    {
        $this->hostIndex = $host_index;
    }

    /**
     * Get the host index
     *
     * @return Host index
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
     * Operation apiAuthAccessTokenPost
     *
     * Contrôle OAuth
     *
     * @param  string $client_id Variable OAuth contenant &#x60;accessPublic&#x60;. Exemple&amp;nbsp;: xxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxx (required)
     * @param  string $grant_type Variable OAuth contenant la valeur du \&quot;grant type\&quot; OAuth (valeur: authorization_code) (required)
     * @param  string $code Variable OAuth contenant le code generate après l&#39;appel authorize OAuth (required)
     *
     * @throws \Hraph\PaygreenApi\ApiException on non-2xx response
     * @throws \InvalidArgumentException
     * @return \Hraph\PaygreenApi\Model\InlineResponse2002
     */
    public function apiAuthAccessTokenPost($client_id, $grant_type, $code)
    {
        list($response) = $this->apiAuthAccessTokenPostWithHttpInfo($client_id, $grant_type, $code);
        return $response;
    }

    /**
     * Operation apiAuthAccessTokenPostWithHttpInfo
     *
     * Contrôle OAuth
     *
     * @param  string $client_id Variable OAuth contenant &#x60;accessPublic&#x60;. Exemple&amp;nbsp;: xxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxx (required)
     * @param  string $grant_type Variable OAuth contenant la valeur du \&quot;grant type\&quot; OAuth (valeur: authorization_code) (required)
     * @param  string $code Variable OAuth contenant le code generate après l&#39;appel authorize OAuth (required)
     *
     * @throws \Hraph\PaygreenApi\ApiException on non-2xx response
     * @throws \InvalidArgumentException
     * @return array of \Hraph\PaygreenApi\Model\InlineResponse2002, HTTP status code, HTTP response headers (array of strings)
     */
    public function apiAuthAccessTokenPostWithHttpInfo($client_id, $grant_type, $code)
    {
        $request = $this->apiAuthAccessTokenPostRequest($client_id, $grant_type, $code);

        try {
            $options = $this->createHttpClientOption();
            try {
                $response = $this->client->send($request, $options);
            } catch (RequestException $e) {
                throw new ApiException(
                    "[{$e->getCode()}] {$e->getMessage()}",
                    $e->getCode(),
                    $e->getResponse() ? $e->getResponse()->getHeaders() : null,
                    $e->getResponse() ? (string) $e->getResponse()->getBody() : null
                );
            }

            $statusCode = $response->getStatusCode();

            if ($statusCode < 200 || $statusCode > 299) {
                throw new ApiException(
                    sprintf(
                        '[%d] Error connecting to the API (%s)',
                        $statusCode,
                        $request->getUri()
                    ),
                    $statusCode,
                    $response->getHeaders(),
                    $response->getBody()
                );
            }

            $responseBody = $response->getBody();
            switch($statusCode) {
                case 200:
                    if ('\Hraph\PaygreenApi\Model\InlineResponse2002' === '\SplFileObject') {
                        $content = $responseBody; //stream goes to serializer
                    } else {
                        $content = (string) $responseBody;
                    }

                    return [
                        ObjectSerializer::deserialize($content, '\Hraph\PaygreenApi\Model\InlineResponse2002', []),
                        $response->getStatusCode(),
                        $response->getHeaders()
                    ];
            }

            $returnType = '\Hraph\PaygreenApi\Model\InlineResponse2002';
            $responseBody = $response->getBody();
            if ($returnType === '\SplFileObject') {
                $content = $responseBody; //stream goes to serializer
            } else {
                $content = (string) $responseBody;
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
                        '\Hraph\PaygreenApi\Model\InlineResponse2002',
                        $e->getResponseHeaders()
                    );
                    $e->setResponseObject($data);
                    break;
            }
            throw $e;
        }
    }

    /**
     * Operation apiAuthAccessTokenPostAsync
     *
     * Contrôle OAuth
     *
     * @param  string $client_id Variable OAuth contenant &#x60;accessPublic&#x60;. Exemple&amp;nbsp;: xxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxx (required)
     * @param  string $grant_type Variable OAuth contenant la valeur du \&quot;grant type\&quot; OAuth (valeur: authorization_code) (required)
     * @param  string $code Variable OAuth contenant le code generate après l&#39;appel authorize OAuth (required)
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Promise\PromiseInterface
     */
    public function apiAuthAccessTokenPostAsync($client_id, $grant_type, $code)
    {
        return $this->apiAuthAccessTokenPostAsyncWithHttpInfo($client_id, $grant_type, $code)
            ->then(
                function ($response) {
                    return $response[0];
                }
            );
    }

    /**
     * Operation apiAuthAccessTokenPostAsyncWithHttpInfo
     *
     * Contrôle OAuth
     *
     * @param  string $client_id Variable OAuth contenant &#x60;accessPublic&#x60;. Exemple&amp;nbsp;: xxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxx (required)
     * @param  string $grant_type Variable OAuth contenant la valeur du \&quot;grant type\&quot; OAuth (valeur: authorization_code) (required)
     * @param  string $code Variable OAuth contenant le code generate après l&#39;appel authorize OAuth (required)
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Promise\PromiseInterface
     */
    public function apiAuthAccessTokenPostAsyncWithHttpInfo($client_id, $grant_type, $code)
    {
        $returnType = '\Hraph\PaygreenApi\Model\InlineResponse2002';
        $request = $this->apiAuthAccessTokenPostRequest($client_id, $grant_type, $code);

        return $this->client
            ->sendAsync($request, $this->createHttpClientOption())
            ->then(
                function ($response) use ($returnType) {
                    $responseBody = $response->getBody();
                    if ($returnType === '\SplFileObject') {
                        $content = $responseBody; //stream goes to serializer
                    } else {
                        $content = (string) $responseBody;
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
                        $response->getBody()
                    );
                }
            );
    }

    /**
     * Create request for operation 'apiAuthAccessTokenPost'
     *
     * @param  string $client_id Variable OAuth contenant &#x60;accessPublic&#x60;. Exemple&amp;nbsp;: xxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxx (required)
     * @param  string $grant_type Variable OAuth contenant la valeur du \&quot;grant type\&quot; OAuth (valeur: authorization_code) (required)
     * @param  string $code Variable OAuth contenant le code generate après l&#39;appel authorize OAuth (required)
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Psr7\Request
     */
    protected function apiAuthAccessTokenPostRequest($client_id, $grant_type, $code)
    {
        // verify the required parameter 'client_id' is set
        if ($client_id === null || (is_array($client_id) && count($client_id) === 0)) {
            throw new \InvalidArgumentException(
                'Missing the required parameter $client_id when calling apiAuthAccessTokenPost'
            );
        }
        // verify the required parameter 'grant_type' is set
        if ($grant_type === null || (is_array($grant_type) && count($grant_type) === 0)) {
            throw new \InvalidArgumentException(
                'Missing the required parameter $grant_type when calling apiAuthAccessTokenPost'
            );
        }
        // verify the required parameter 'code' is set
        if ($code === null || (is_array($code) && count($code) === 0)) {
            throw new \InvalidArgumentException(
                'Missing the required parameter $code when calling apiAuthAccessTokenPost'
            );
        }

        $resourcePath = '/api/auth/accessToken';
        $formParams = [];
        $queryParams = [];
        $headerParams = [];
        $httpBody = '';
        $multipart = false;



        // path params
        if ($client_id !== null) {
            $resourcePath = str_replace(
                '{' . 'client_id' . '}',
                ObjectSerializer::toPathValue($client_id),
                $resourcePath
            );
        }
        // path params
        if ($grant_type !== null) {
            $resourcePath = str_replace(
                '{' . 'grant_type' . '}',
                ObjectSerializer::toPathValue($grant_type),
                $resourcePath
            );
        }
        // path params
        if ($code !== null) {
            $resourcePath = str_replace(
                '{' . 'code' . '}',
                ObjectSerializer::toPathValue($code),
                $resourcePath
            );
        }

        // body params
        $_tempBody = null;

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
        if (isset($_tempBody)) {
            // $_tempBody is the method argument, if present
            if ($headers['Content-Type'] === 'application/json') {
                $httpBody = \GuzzleHttp\json_encode(ObjectSerializer::sanitizeForSerialization($_tempBody));
            } else {
                $httpBody = $_tempBody;
            }
        } elseif (count($formParams) > 0) {
            if ($multipart) {
                $multipartContents = [];
                foreach ($formParams as $formParamName => $formParamValue) {
                    $multipartContents[] = [
                        'name' => $formParamName,
                        'contents' => $formParamValue
                    ];
                }
                // for HTTP post (form)
                $httpBody = new MultipartStream($multipartContents);

            } elseif ($headers['Content-Type'] === 'application/json') {
                $httpBody = \GuzzleHttp\json_encode($formParams);

            } else {
                // for HTTP post (form)
                $httpBody = \GuzzleHttp\Psr7\build_query($formParams);
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

        $query = \GuzzleHttp\Psr7\build_query($queryParams);
        return new Request(
            'POST',
            $this->config->getHost() . $resourcePath . ($query ? "?{$query}" : ''),
            $headers,
            $httpBody
        );
    }

    /**
     * Operation apiAuthAuthorizeGet
     *
     * Affichage de la page d'authentification PayGreen
     *
     * @param  string $client_id Variable OAuth contenant &#x60;accessPublic&#x60;. Exemple&amp;nbsp;: xxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxx (required)
     * @param  string $redirect_uri Variable OAuth contenant l&#39;URL de retour une fois l&#39;utilisateur identifié. Par exemple : http://example.com/mon-url-de-retour (required)
     * @param  string $response_type Variable OAuth concernant le style de réponse. Par exemple : code (required)
     *
     * @throws \Hraph\PaygreenApi\ApiException on non-2xx response
     * @throws \InvalidArgumentException
     * @return \Hraph\PaygreenApi\Model\InlineResponse2001
     */
    public function apiAuthAuthorizeGet($client_id, $redirect_uri, $response_type)
    {
        list($response) = $this->apiAuthAuthorizeGetWithHttpInfo($client_id, $redirect_uri, $response_type);
        return $response;
    }

    /**
     * Operation apiAuthAuthorizeGetWithHttpInfo
     *
     * Affichage de la page d'authentification PayGreen
     *
     * @param  string $client_id Variable OAuth contenant &#x60;accessPublic&#x60;. Exemple&amp;nbsp;: xxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxx (required)
     * @param  string $redirect_uri Variable OAuth contenant l&#39;URL de retour une fois l&#39;utilisateur identifié. Par exemple : http://example.com/mon-url-de-retour (required)
     * @param  string $response_type Variable OAuth concernant le style de réponse. Par exemple : code (required)
     *
     * @throws \Hraph\PaygreenApi\ApiException on non-2xx response
     * @throws \InvalidArgumentException
     * @return array of \Hraph\PaygreenApi\Model\InlineResponse2001, HTTP status code, HTTP response headers (array of strings)
     */
    public function apiAuthAuthorizeGetWithHttpInfo($client_id, $redirect_uri, $response_type)
    {
        $request = $this->apiAuthAuthorizeGetRequest($client_id, $redirect_uri, $response_type);

        try {
            $options = $this->createHttpClientOption();
            try {
                $response = $this->client->send($request, $options);
            } catch (RequestException $e) {
                throw new ApiException(
                    "[{$e->getCode()}] {$e->getMessage()}",
                    $e->getCode(),
                    $e->getResponse() ? $e->getResponse()->getHeaders() : null,
                    $e->getResponse() ? (string) $e->getResponse()->getBody() : null
                );
            }

            $statusCode = $response->getStatusCode();

            if ($statusCode < 200 || $statusCode > 299) {
                throw new ApiException(
                    sprintf(
                        '[%d] Error connecting to the API (%s)',
                        $statusCode,
                        $request->getUri()
                    ),
                    $statusCode,
                    $response->getHeaders(),
                    $response->getBody()
                );
            }

            $responseBody = $response->getBody();
            switch($statusCode) {
                case 200:
                    if ('\Hraph\PaygreenApi\Model\InlineResponse2001' === '\SplFileObject') {
                        $content = $responseBody; //stream goes to serializer
                    } else {
                        $content = (string) $responseBody;
                    }

                    return [
                        ObjectSerializer::deserialize($content, '\Hraph\PaygreenApi\Model\InlineResponse2001', []),
                        $response->getStatusCode(),
                        $response->getHeaders()
                    ];
            }

            $returnType = '\Hraph\PaygreenApi\Model\InlineResponse2001';
            $responseBody = $response->getBody();
            if ($returnType === '\SplFileObject') {
                $content = $responseBody; //stream goes to serializer
            } else {
                $content = (string) $responseBody;
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
                        '\Hraph\PaygreenApi\Model\InlineResponse2001',
                        $e->getResponseHeaders()
                    );
                    $e->setResponseObject($data);
                    break;
            }
            throw $e;
        }
    }

    /**
     * Operation apiAuthAuthorizeGetAsync
     *
     * Affichage de la page d'authentification PayGreen
     *
     * @param  string $client_id Variable OAuth contenant &#x60;accessPublic&#x60;. Exemple&amp;nbsp;: xxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxx (required)
     * @param  string $redirect_uri Variable OAuth contenant l&#39;URL de retour une fois l&#39;utilisateur identifié. Par exemple : http://example.com/mon-url-de-retour (required)
     * @param  string $response_type Variable OAuth concernant le style de réponse. Par exemple : code (required)
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Promise\PromiseInterface
     */
    public function apiAuthAuthorizeGetAsync($client_id, $redirect_uri, $response_type)
    {
        return $this->apiAuthAuthorizeGetAsyncWithHttpInfo($client_id, $redirect_uri, $response_type)
            ->then(
                function ($response) {
                    return $response[0];
                }
            );
    }

    /**
     * Operation apiAuthAuthorizeGetAsyncWithHttpInfo
     *
     * Affichage de la page d'authentification PayGreen
     *
     * @param  string $client_id Variable OAuth contenant &#x60;accessPublic&#x60;. Exemple&amp;nbsp;: xxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxx (required)
     * @param  string $redirect_uri Variable OAuth contenant l&#39;URL de retour une fois l&#39;utilisateur identifié. Par exemple : http://example.com/mon-url-de-retour (required)
     * @param  string $response_type Variable OAuth concernant le style de réponse. Par exemple : code (required)
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Promise\PromiseInterface
     */
    public function apiAuthAuthorizeGetAsyncWithHttpInfo($client_id, $redirect_uri, $response_type)
    {
        $returnType = '\Hraph\PaygreenApi\Model\InlineResponse2001';
        $request = $this->apiAuthAuthorizeGetRequest($client_id, $redirect_uri, $response_type);

        return $this->client
            ->sendAsync($request, $this->createHttpClientOption())
            ->then(
                function ($response) use ($returnType) {
                    $responseBody = $response->getBody();
                    if ($returnType === '\SplFileObject') {
                        $content = $responseBody; //stream goes to serializer
                    } else {
                        $content = (string) $responseBody;
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
                        $response->getBody()
                    );
                }
            );
    }

    /**
     * Create request for operation 'apiAuthAuthorizeGet'
     *
     * @param  string $client_id Variable OAuth contenant &#x60;accessPublic&#x60;. Exemple&amp;nbsp;: xxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxx (required)
     * @param  string $redirect_uri Variable OAuth contenant l&#39;URL de retour une fois l&#39;utilisateur identifié. Par exemple : http://example.com/mon-url-de-retour (required)
     * @param  string $response_type Variable OAuth concernant le style de réponse. Par exemple : code (required)
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Psr7\Request
     */
    protected function apiAuthAuthorizeGetRequest($client_id, $redirect_uri, $response_type)
    {
        // verify the required parameter 'client_id' is set
        if ($client_id === null || (is_array($client_id) && count($client_id) === 0)) {
            throw new \InvalidArgumentException(
                'Missing the required parameter $client_id when calling apiAuthAuthorizeGet'
            );
        }
        // verify the required parameter 'redirect_uri' is set
        if ($redirect_uri === null || (is_array($redirect_uri) && count($redirect_uri) === 0)) {
            throw new \InvalidArgumentException(
                'Missing the required parameter $redirect_uri when calling apiAuthAuthorizeGet'
            );
        }
        // verify the required parameter 'response_type' is set
        if ($response_type === null || (is_array($response_type) && count($response_type) === 0)) {
            throw new \InvalidArgumentException(
                'Missing the required parameter $response_type when calling apiAuthAuthorizeGet'
            );
        }

        $resourcePath = '/api/auth/authorize';
        $formParams = [];
        $queryParams = [];
        $headerParams = [];
        $httpBody = '';
        $multipart = false;

        // query params
        if (is_array($client_id)) {
            $client_id = ObjectSerializer::serializeCollection($client_id, '', true);
        }
        if ($client_id !== null) {
            $queryParams['client_id'] = $client_id;
        }
        // query params
        if (is_array($redirect_uri)) {
            $redirect_uri = ObjectSerializer::serializeCollection($redirect_uri, '', true);
        }
        if ($redirect_uri !== null) {
            $queryParams['redirect_uri'] = $redirect_uri;
        }
        // query params
        if (is_array($response_type)) {
            $response_type = ObjectSerializer::serializeCollection($response_type, '', true);
        }
        if ($response_type !== null) {
            $queryParams['response_type'] = $response_type;
        }



        // body params
        $_tempBody = null;

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
        if (isset($_tempBody)) {
            // $_tempBody is the method argument, if present
            if ($headers['Content-Type'] === 'application/json') {
                $httpBody = \GuzzleHttp\json_encode(ObjectSerializer::sanitizeForSerialization($_tempBody));
            } else {
                $httpBody = $_tempBody;
            }
        } elseif (count($formParams) > 0) {
            if ($multipart) {
                $multipartContents = [];
                foreach ($formParams as $formParamName => $formParamValue) {
                    $multipartContents[] = [
                        'name' => $formParamName,
                        'contents' => $formParamValue
                    ];
                }
                // for HTTP post (form)
                $httpBody = new MultipartStream($multipartContents);

            } elseif ($headers['Content-Type'] === 'application/json') {
                $httpBody = \GuzzleHttp\json_encode($formParams);

            } else {
                // for HTTP post (form)
                $httpBody = \GuzzleHttp\Psr7\build_query($formParams);
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

        $query = \GuzzleHttp\Psr7\build_query($queryParams);
        return new Request(
            'GET',
            $this->config->getHost() . $resourcePath . ($query ? "?{$query}" : ''),
            $headers,
            $httpBody
        );
    }

    /**
     * Operation apiAuthPost
     *
     * Création d'un token d'accès au protocole OAuth
     *
     * @param  \Hraph\PaygreenApi\Model\AuthAccessToken $auth_access_token Token d&#39;accès OAuth (required)
     *
     * @throws \Hraph\PaygreenApi\ApiException on non-2xx response
     * @throws \InvalidArgumentException
     * @return \Hraph\PaygreenApi\Model\InlineResponse200
     */
    public function apiAuthPost($auth_access_token)
    {
        list($response) = $this->apiAuthPostWithHttpInfo($auth_access_token);
        return $response;
    }

    /**
     * Operation apiAuthPostWithHttpInfo
     *
     * Création d'un token d'accès au protocole OAuth
     *
     * @param  \Hraph\PaygreenApi\Model\AuthAccessToken $auth_access_token Token d&#39;accès OAuth (required)
     *
     * @throws \Hraph\PaygreenApi\ApiException on non-2xx response
     * @throws \InvalidArgumentException
     * @return array of \Hraph\PaygreenApi\Model\InlineResponse200, HTTP status code, HTTP response headers (array of strings)
     */
    public function apiAuthPostWithHttpInfo($auth_access_token)
    {
        $request = $this->apiAuthPostRequest($auth_access_token);

        try {
            $options = $this->createHttpClientOption();
            try {
                $response = $this->client->send($request, $options);
            } catch (RequestException $e) {
                throw new ApiException(
                    "[{$e->getCode()}] {$e->getMessage()}",
                    $e->getCode(),
                    $e->getResponse() ? $e->getResponse()->getHeaders() : null,
                    $e->getResponse() ? (string) $e->getResponse()->getBody() : null
                );
            }

            $statusCode = $response->getStatusCode();

            if ($statusCode < 200 || $statusCode > 299) {
                throw new ApiException(
                    sprintf(
                        '[%d] Error connecting to the API (%s)',
                        $statusCode,
                        $request->getUri()
                    ),
                    $statusCode,
                    $response->getHeaders(),
                    $response->getBody()
                );
            }

            $responseBody = $response->getBody();
            switch($statusCode) {
                case 200:
                    if ('\Hraph\PaygreenApi\Model\InlineResponse200' === '\SplFileObject') {
                        $content = $responseBody; //stream goes to serializer
                    } else {
                        $content = (string) $responseBody;
                    }

                    return [
                        ObjectSerializer::deserialize($content, '\Hraph\PaygreenApi\Model\InlineResponse200', []),
                        $response->getStatusCode(),
                        $response->getHeaders()
                    ];
            }

            $returnType = '\Hraph\PaygreenApi\Model\InlineResponse200';
            $responseBody = $response->getBody();
            if ($returnType === '\SplFileObject') {
                $content = $responseBody; //stream goes to serializer
            } else {
                $content = (string) $responseBody;
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
                        '\Hraph\PaygreenApi\Model\InlineResponse200',
                        $e->getResponseHeaders()
                    );
                    $e->setResponseObject($data);
                    break;
            }
            throw $e;
        }
    }

    /**
     * Operation apiAuthPostAsync
     *
     * Création d'un token d'accès au protocole OAuth
     *
     * @param  \Hraph\PaygreenApi\Model\AuthAccessToken $auth_access_token Token d&#39;accès OAuth (required)
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Promise\PromiseInterface
     */
    public function apiAuthPostAsync($auth_access_token)
    {
        return $this->apiAuthPostAsyncWithHttpInfo($auth_access_token)
            ->then(
                function ($response) {
                    return $response[0];
                }
            );
    }

    /**
     * Operation apiAuthPostAsyncWithHttpInfo
     *
     * Création d'un token d'accès au protocole OAuth
     *
     * @param  \Hraph\PaygreenApi\Model\AuthAccessToken $auth_access_token Token d&#39;accès OAuth (required)
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Promise\PromiseInterface
     */
    public function apiAuthPostAsyncWithHttpInfo($auth_access_token)
    {
        $returnType = '\Hraph\PaygreenApi\Model\InlineResponse200';
        $request = $this->apiAuthPostRequest($auth_access_token);

        return $this->client
            ->sendAsync($request, $this->createHttpClientOption())
            ->then(
                function ($response) use ($returnType) {
                    $responseBody = $response->getBody();
                    if ($returnType === '\SplFileObject') {
                        $content = $responseBody; //stream goes to serializer
                    } else {
                        $content = (string) $responseBody;
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
                        $response->getBody()
                    );
                }
            );
    }

    /**
     * Create request for operation 'apiAuthPost'
     *
     * @param  \Hraph\PaygreenApi\Model\AuthAccessToken $auth_access_token Token d&#39;accès OAuth (required)
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Psr7\Request
     */
    protected function apiAuthPostRequest($auth_access_token)
    {
        // verify the required parameter 'auth_access_token' is set
        if ($auth_access_token === null || (is_array($auth_access_token) && count($auth_access_token) === 0)) {
            throw new \InvalidArgumentException(
                'Missing the required parameter $auth_access_token when calling apiAuthPost'
            );
        }

        $resourcePath = '/api/auth/';
        $formParams = [];
        $queryParams = [];
        $headerParams = [];
        $httpBody = '';
        $multipart = false;




        // body params
        $_tempBody = null;
        if (isset($auth_access_token)) {
            $_tempBody = $auth_access_token;
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
        if (isset($_tempBody)) {
            // $_tempBody is the method argument, if present
            if ($headers['Content-Type'] === 'application/json') {
                $httpBody = \GuzzleHttp\json_encode(ObjectSerializer::sanitizeForSerialization($_tempBody));
            } else {
                $httpBody = $_tempBody;
            }
        } elseif (count($formParams) > 0) {
            if ($multipart) {
                $multipartContents = [];
                foreach ($formParams as $formParamName => $formParamValue) {
                    $multipartContents[] = [
                        'name' => $formParamName,
                        'contents' => $formParamValue
                    ];
                }
                // for HTTP post (form)
                $httpBody = new MultipartStream($multipartContents);

            } elseif ($headers['Content-Type'] === 'application/json') {
                $httpBody = \GuzzleHttp\json_encode($formParams);

            } else {
                // for HTTP post (form)
                $httpBody = \GuzzleHttp\Psr7\build_query($formParams);
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

        $query = \GuzzleHttp\Psr7\build_query($queryParams);
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
