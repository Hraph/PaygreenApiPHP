<?php
/**
 * PartnerConfig
 *
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

namespace Hraph\PaygreenApi\Model;

use \ArrayAccess;
use \Hraph\PaygreenApi\ObjectSerializer;

/**
 * PartnerConfig Class Doc Comment
 *
 * @category Class
 * @package  Hraph\PaygreenApi
 * @author   OpenAPI Generator team
 * @link     https://openapi-generator.tech
 * @implements \ArrayAccess<TKey, TValue>
 * @template TKey int|null
 * @template TValue mixed|null
 */
class PartnerConfig implements ModelInterface, ArrayAccess, \JsonSerializable
{
    public const DISCRIMINATOR = null;

    /**
      * The original name of the model.
      *
      * @var string
      */
    protected static $openAPIModelName = 'PartnerConfig';

    /**
      * Array of property to type mappings. Used for (de)serialization
      *
      * @var string[]
      */
    protected static $openAPITypes = [
        'currency' => 'string',
        'payment_type' => 'string',
        'status' => 'string',
        'mode' => 'string',
        'available_payment_mode' => 'string[]',
        'iframe' => 'string[]',
        'is_limited' => 'bool',
        'sold_available' => 'int'
    ];

    /**
      * Array of property to format mappings. Used for (de)serialization
      *
      * @var string[]
      * @phpstan-var array<string, string|null>
      * @psalm-var array<string, string|null>
      */
    protected static $openAPIFormats = [
        'currency' => null,
        'payment_type' => null,
        'status' => null,
        'mode' => null,
        'available_payment_mode' => null,
        'iframe' => null,
        'is_limited' => null,
        'sold_available' => 'int64'
    ];

    /**
     * Array of property to type mappings. Used for (de)serialization
     *
     * @return array
     */
    public static function openAPITypes()
    {
        return self::$openAPITypes;
    }

    /**
     * Array of property to format mappings. Used for (de)serialization
     *
     * @return array
     */
    public static function openAPIFormats()
    {
        return self::$openAPIFormats;
    }

    /**
     * Array of attributes where the key is the local name,
     * and the value is the original name
     *
     * @var string[]
     */
    protected static $attributeMap = [
        'currency' => 'currency',
        'payment_type' => 'paymentType',
        'status' => 'status',
        'mode' => 'mode',
        'available_payment_mode' => 'availablePaymentMode',
        'iframe' => 'iframe',
        'is_limited' => 'isLimited',
        'sold_available' => 'soldAvailable'
    ];

    /**
     * Array of attributes to setter functions (for deserialization of responses)
     *
     * @var string[]
     */
    protected static $setters = [
        'currency' => 'setCurrency',
        'payment_type' => 'setPaymentType',
        'status' => 'setStatus',
        'mode' => 'setMode',
        'available_payment_mode' => 'setAvailablePaymentMode',
        'iframe' => 'setIframe',
        'is_limited' => 'setIsLimited',
        'sold_available' => 'setSoldAvailable'
    ];

    /**
     * Array of attributes to getter functions (for serialization of requests)
     *
     * @var string[]
     */
    protected static $getters = [
        'currency' => 'getCurrency',
        'payment_type' => 'getPaymentType',
        'status' => 'getStatus',
        'mode' => 'getMode',
        'available_payment_mode' => 'getAvailablePaymentMode',
        'iframe' => 'getIframe',
        'is_limited' => 'getIsLimited',
        'sold_available' => 'getSoldAvailable'
    ];

    /**
     * Array of attributes where the key is the local name,
     * and the value is the original name
     *
     * @return array
     */
    public static function attributeMap()
    {
        return self::$attributeMap;
    }

    /**
     * Array of attributes to setter functions (for deserialization of responses)
     *
     * @return array
     */
    public static function setters()
    {
        return self::$setters;
    }

    /**
     * Array of attributes to getter functions (for serialization of requests)
     *
     * @return array
     */
    public static function getters()
    {
        return self::$getters;
    }

    /**
     * The original name of the model.
     *
     * @return string
     */
    public function getModelName()
    {
        return self::$openAPIModelName;
    }


    /**
     * Associative array for storing property values
     *
     * @var mixed[]
     */
    protected $container = [];

    /**
     * Constructor
     *
     * @param mixed[] $data Associated array of property values
     *                      initializing the model
     */
    public function __construct(array $data = null)
    {
        $this->container['currency'] = $data['currency'] ?? null;
        $this->container['payment_type'] = $data['payment_type'] ?? null;
        $this->container['status'] = $data['status'] ?? null;
        $this->container['mode'] = $data['mode'] ?? null;
        $this->container['available_payment_mode'] = $data['available_payment_mode'] ?? null;
        $this->container['iframe'] = $data['iframe'] ?? null;
        $this->container['is_limited'] = $data['is_limited'] ?? null;
        $this->container['sold_available'] = $data['sold_available'] ?? null;
    }

    /**
     * Show all the invalid properties with reasons.
     *
     * @return array invalid properties with reasons
     */
    public function listInvalidProperties()
    {
        $invalidProperties = [];

        if ($this->container['mode'] === null) {
            $invalidProperties[] = "'mode' can't be null";
        }
        return $invalidProperties;
    }

    /**
     * Validate all the properties in the model
     * return true if all passed
     *
     * @return bool True if all properties are valid
     */
    public function valid()
    {
        return count($this->listInvalidProperties()) === 0;
    }


    /**
     * Gets currency
     *
     * @return string|null
     */
    public function getCurrency()
    {
        return $this->container['currency'];
    }

    /**
     * Sets currency
     *
     * @param string|null $currency currency
     *
     * @return self
     */
    public function setCurrency($currency)
    {
        $this->container['currency'] = $currency;

        return $this;
    }

    /**
     * Gets payment_type
     *
     * @return string|null
     */
    public function getPaymentType()
    {
        return $this->container['payment_type'];
    }

    /**
     * Sets payment_type
     *
     * @param string|null $payment_type payment_type
     *
     * @return self
     */
    public function setPaymentType($payment_type)
    {
        $this->container['payment_type'] = $payment_type;

        return $this;
    }

    /**
     * Gets status
     *
     * @return string|null
     */
    public function getStatus()
    {
        return $this->container['status'];
    }

    /**
     * Sets status
     *
     * @param string|null $status status
     *
     * @return self
     */
    public function setStatus($status)
    {
        $this->container['status'] = $status;

        return $this;
    }

    /**
     * Gets mode
     *
     * @return string
     */
    public function getMode()
    {
        return $this->container['mode'];
    }

    /**
     * Sets mode
     *
     * @param string $mode mode
     *
     * @return self
     */
    public function setMode($mode)
    {
        $this->container['mode'] = $mode;

        return $this;
    }

    /**
     * Gets available_payment_mode
     *
     * @return string[]|null
     */
    public function getAvailablePaymentMode()
    {
        return $this->container['available_payment_mode'];
    }

    /**
     * Sets available_payment_mode
     *
     * @param string[]|null $available_payment_mode available_payment_mode
     *
     * @return self
     */
    public function setAvailablePaymentMode($available_payment_mode)
    {
        $this->container['available_payment_mode'] = $available_payment_mode;

        return $this;
    }

    /**
     * Gets iframe
     *
     * @return string[]|null
     */
    public function getIframe()
    {
        return $this->container['iframe'];
    }

    /**
     * Sets iframe
     *
     * @param string[]|null $iframe iframe
     *
     * @return self
     */
    public function setIframe($iframe)
    {
        $this->container['iframe'] = $iframe;

        return $this;
    }

    /**
     * Gets is_limited
     *
     * @return bool|null
     */
    public function getIsLimited()
    {
        return $this->container['is_limited'];
    }

    /**
     * Sets is_limited
     *
     * @param bool|null $is_limited is_limited
     *
     * @return self
     */
    public function setIsLimited($is_limited)
    {
        $this->container['is_limited'] = $is_limited;

        return $this;
    }

    /**
     * Gets sold_available
     *
     * @return int|null
     */
    public function getSoldAvailable()
    {
        return $this->container['sold_available'];
    }

    /**
     * Sets sold_available
     *
     * @param int|null $sold_available sold_available
     *
     * @return self
     */
    public function setSoldAvailable($sold_available)
    {
        $this->container['sold_available'] = $sold_available;

        return $this;
    }
    /**
     * Returns true if offset exists. False otherwise.
     *
     * @param integer $offset Offset
     *
     * @return boolean
     */
    public function offsetExists($offset)
    {
        return isset($this->container[$offset]);
    }

    /**
     * Gets offset.
     *
     * @param integer $offset Offset
     *
     * @return mixed|null
     */
    public function offsetGet($offset)
    {
        return $this->container[$offset] ?? null;
    }

    /**
     * Sets value based on offset.
     *
     * @param int|null $offset Offset
     * @param mixed    $value  Value to be set
     *
     * @return void
     */
    public function offsetSet($offset, $value)
    {
        if (is_null($offset)) {
            $this->container[] = $value;
        } else {
            $this->container[$offset] = $value;
        }
    }

    /**
     * Unsets offset.
     *
     * @param integer $offset Offset
     *
     * @return void
     */
    public function offsetUnset($offset)
    {
        unset($this->container[$offset]);
    }

    /**
     * Serializes the object to a value that can be serialized natively by json_encode().
     * @link https://www.php.net/manual/en/jsonserializable.jsonserialize.php
     *
     * @return mixed Returns data which can be serialized by json_encode(), which is a value
     * of any type other than a resource.
     */
    public function jsonSerialize()
    {
       return ObjectSerializer::sanitizeForSerialization($this);
    }

    /**
     * Gets the string presentation of the object
     *
     * @return string
     */
    public function __toString()
    {
        return json_encode(
            ObjectSerializer::sanitizeForSerialization($this),
            JSON_PRETTY_PRINT
        );
    }

    /**
     * Gets a header-safe presentation of the object
     *
     * @return string
     */
    public function toHeaderValue()
    {
        return json_encode(ObjectSerializer::sanitizeForSerialization($this));
    }
}


