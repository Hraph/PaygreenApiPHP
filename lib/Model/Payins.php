<?php
/**
 * Payins
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
 * Payins Class Doc Comment
 *
 * @category Class
 * @package  Hraph\PaygreenApi
 * @author   OpenAPI Generator team
 * @link     https://openapi-generator.tech
 * @implements \ArrayAccess<TKey, TValue>
 * @template TKey int|null
 * @template TValue mixed|null
 */
class Payins implements ModelInterface, ArrayAccess, \JsonSerializable
{
    public const DISCRIMINATOR = null;

    /**
      * The original name of the model.
      *
      * @var string
      */
    protected static $openAPIModelName = 'Payins';

    /**
      * Array of property to type mappings. Used for (de)serialization
      *
      * @var string[]
      */
    protected static $openAPITypes = [
        'order_id' => 'string',
        'amount' => 'int',
        'currency' => 'string',
        'payment_type' => 'string',
        'returned_url' => 'string',
        'notified_url' => 'string',
        'id_fingerprint' => 'int',
        'buyer' => '\Hraph\PaygreenApi\Model\PayinsBuyer',
        'metadata' => 'string[]',
        'eligible_amount' => 'string[]',
        'card' => '\Hraph\PaygreenApi\Model\PayinsCard',
        'with_payment_link' => 'bool',
        'emails' => 'string[]',
        'content_mail' => 'string',
        'ttl' => 'string'
    ];

    /**
      * Array of property to format mappings. Used for (de)serialization
      *
      * @var string[]
      * @phpstan-var array<string, string|null>
      * @psalm-var array<string, string|null>
      */
    protected static $openAPIFormats = [
        'order_id' => null,
        'amount' => 'int64',
        'currency' => null,
        'payment_type' => null,
        'returned_url' => null,
        'notified_url' => null,
        'id_fingerprint' => 'int64',
        'buyer' => null,
        'metadata' => null,
        'eligible_amount' => null,
        'card' => null,
        'with_payment_link' => null,
        'emails' => null,
        'content_mail' => null,
        'ttl' => null
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
        'order_id' => 'orderId',
        'amount' => 'amount',
        'currency' => 'currency',
        'payment_type' => 'paymentType',
        'returned_url' => 'returned_url',
        'notified_url' => 'notified_url',
        'id_fingerprint' => 'idFingerprint',
        'buyer' => 'buyer',
        'metadata' => 'metadata',
        'eligible_amount' => 'eligibleAmount',
        'card' => 'card',
        'with_payment_link' => 'withPaymentLink',
        'emails' => 'emails',
        'content_mail' => 'contentMail',
        'ttl' => 'ttl'
    ];

    /**
     * Array of attributes to setter functions (for deserialization of responses)
     *
     * @var string[]
     */
    protected static $setters = [
        'order_id' => 'setOrderId',
        'amount' => 'setAmount',
        'currency' => 'setCurrency',
        'payment_type' => 'setPaymentType',
        'returned_url' => 'setReturnedUrl',
        'notified_url' => 'setNotifiedUrl',
        'id_fingerprint' => 'setIdFingerprint',
        'buyer' => 'setBuyer',
        'metadata' => 'setMetadata',
        'eligible_amount' => 'setEligibleAmount',
        'card' => 'setCard',
        'with_payment_link' => 'setWithPaymentLink',
        'emails' => 'setEmails',
        'content_mail' => 'setContentMail',
        'ttl' => 'setTtl'
    ];

    /**
     * Array of attributes to getter functions (for serialization of requests)
     *
     * @var string[]
     */
    protected static $getters = [
        'order_id' => 'getOrderId',
        'amount' => 'getAmount',
        'currency' => 'getCurrency',
        'payment_type' => 'getPaymentType',
        'returned_url' => 'getReturnedUrl',
        'notified_url' => 'getNotifiedUrl',
        'id_fingerprint' => 'getIdFingerprint',
        'buyer' => 'getBuyer',
        'metadata' => 'getMetadata',
        'eligible_amount' => 'getEligibleAmount',
        'card' => 'getCard',
        'with_payment_link' => 'getWithPaymentLink',
        'emails' => 'getEmails',
        'content_mail' => 'getContentMail',
        'ttl' => 'getTtl'
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
        $this->container['order_id'] = $data['order_id'] ?? null;
        $this->container['amount'] = $data['amount'] ?? null;
        $this->container['currency'] = $data['currency'] ?? null;
        $this->container['payment_type'] = $data['payment_type'] ?? null;
        $this->container['returned_url'] = $data['returned_url'] ?? null;
        $this->container['notified_url'] = $data['notified_url'] ?? null;
        $this->container['id_fingerprint'] = $data['id_fingerprint'] ?? null;
        $this->container['buyer'] = $data['buyer'] ?? null;
        $this->container['metadata'] = $data['metadata'] ?? null;
        $this->container['eligible_amount'] = $data['eligible_amount'] ?? null;
        $this->container['card'] = $data['card'] ?? null;
        $this->container['with_payment_link'] = $data['with_payment_link'] ?? null;
        $this->container['emails'] = $data['emails'] ?? null;
        $this->container['content_mail'] = $data['content_mail'] ?? null;
        $this->container['ttl'] = $data['ttl'] ?? null;
    }

    /**
     * Show all the invalid properties with reasons.
     *
     * @return array invalid properties with reasons
     */
    public function listInvalidProperties()
    {
        $invalidProperties = [];

        if ($this->container['order_id'] === null) {
            $invalidProperties[] = "'order_id' can't be null";
        }
        if ($this->container['amount'] === null) {
            $invalidProperties[] = "'amount' can't be null";
        }
        if ($this->container['currency'] === null) {
            $invalidProperties[] = "'currency' can't be null";
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
     * Gets order_id
     *
     * @return string
     */
    public function getOrderId()
    {
        return $this->container['order_id'];
    }

    /**
     * Sets order_id
     *
     * @param string $order_id order_id
     *
     * @return self
     */
    public function setOrderId($order_id)
    {
        $this->container['order_id'] = $order_id;

        return $this;
    }

    /**
     * Gets amount
     *
     * @return int
     */
    public function getAmount()
    {
        return $this->container['amount'];
    }

    /**
     * Sets amount
     *
     * @param int $amount Le montant est en centimes.
     *
     * @return self
     */
    public function setAmount($amount)
    {
        $this->container['amount'] = $amount;

        return $this;
    }

    /**
     * Gets currency
     *
     * @return string
     */
    public function getCurrency()
    {
        return $this->container['currency'];
    }

    /**
     * Sets currency
     *
     * @param string $currency currency
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
     * Gets returned_url
     *
     * @return string|null
     */
    public function getReturnedUrl()
    {
        return $this->container['returned_url'];
    }

    /**
     * Sets returned_url
     *
     * @param string|null $returned_url Adresse sur laquelle il faut rediriger le client après que l'action a été effectuée.
     *
     * @return self
     */
    public function setReturnedUrl($returned_url)
    {
        $this->container['returned_url'] = $returned_url;

        return $this;
    }

    /**
     * Gets notified_url
     *
     * @return string|null
     */
    public function getNotifiedUrl()
    {
        return $this->container['notified_url'];
    }

    /**
     * Sets notified_url
     *
     * @param string|null $notified_url Adresse sur laquelle PayGreen peut faire des appels pour mettre à jour le statut.
     *
     * @return self
     */
    public function setNotifiedUrl($notified_url)
    {
        $this->container['notified_url'] = $notified_url;

        return $this;
    }

    /**
     * Gets id_fingerprint
     *
     * @return int|null
     */
    public function getIdFingerprint()
    {
        return $this->container['id_fingerprint'];
    }

    /**
     * Sets id_fingerprint
     *
     * @param int|null $id_fingerprint id_fingerprint
     *
     * @return self
     */
    public function setIdFingerprint($id_fingerprint)
    {
        $this->container['id_fingerprint'] = $id_fingerprint;

        return $this;
    }

    /**
     * Gets buyer
     *
     * @return \Hraph\PaygreenApi\Model\PayinsBuyer|null
     */
    public function getBuyer()
    {
        return $this->container['buyer'];
    }

    /**
     * Sets buyer
     *
     * @param \Hraph\PaygreenApi\Model\PayinsBuyer|null $buyer buyer
     *
     * @return self
     */
    public function setBuyer($buyer)
    {
        $this->container['buyer'] = $buyer;

        return $this;
    }

    /**
     * Gets metadata
     *
     * @return string[]|null
     */
    public function getMetadata()
    {
        return $this->container['metadata'];
    }

    /**
     * Sets metadata
     *
     * @param string[]|null $metadata metadata
     *
     * @return self
     */
    public function setMetadata($metadata)
    {
        $this->container['metadata'] = $metadata;

        return $this;
    }

    /**
     * Gets eligible_amount
     *
     * @return string[]|null
     */
    public function getEligibleAmount()
    {
        return $this->container['eligible_amount'];
    }

    /**
     * Sets eligible_amount
     *
     * @param string[]|null $eligible_amount eligible_amount
     *
     * @return self
     */
    public function setEligibleAmount($eligible_amount)
    {
        $this->container['eligible_amount'] = $eligible_amount;

        return $this;
    }

    /**
     * Gets card
     *
     * @return \Hraph\PaygreenApi\Model\PayinsCard|null
     */
    public function getCard()
    {
        return $this->container['card'];
    }

    /**
     * Sets card
     *
     * @param \Hraph\PaygreenApi\Model\PayinsCard|null $card card
     *
     * @return self
     */
    public function setCard($card)
    {
        $this->container['card'] = $card;

        return $this;
    }

    /**
     * Gets with_payment_link
     *
     * @return bool|null
     */
    public function getWithPaymentLink()
    {
        return $this->container['with_payment_link'];
    }

    /**
     * Sets with_payment_link
     *
     * @param bool|null $with_payment_link with_payment_link
     *
     * @return self
     */
    public function setWithPaymentLink($with_payment_link)
    {
        $this->container['with_payment_link'] = $with_payment_link;

        return $this;
    }

    /**
     * Gets emails
     *
     * @return string[]|null
     */
    public function getEmails()
    {
        return $this->container['emails'];
    }

    /**
     * Sets emails
     *
     * @param string[]|null $emails emails
     *
     * @return self
     */
    public function setEmails($emails)
    {
        $this->container['emails'] = $emails;

        return $this;
    }

    /**
     * Gets content_mail
     *
     * @return string|null
     */
    public function getContentMail()
    {
        return $this->container['content_mail'];
    }

    /**
     * Sets content_mail
     *
     * @param string|null $content_mail content_mail
     *
     * @return self
     */
    public function setContentMail($content_mail)
    {
        $this->container['content_mail'] = $content_mail;

        return $this;
    }

    /**
     * Gets ttl
     *
     * @return string|null
     */
    public function getTtl()
    {
        return $this->container['ttl'];
    }

    /**
     * Sets ttl
     *
     * @param string|null $ttl ttl
     *
     * @return self
     */
    public function setTtl($ttl)
    {
        $this->container['ttl'] = $ttl;

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


