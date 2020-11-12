<?php
/**
 * Shop
 *
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

namespace Hraph\PaygreenApi\Model;

use \ArrayAccess;
use \Hraph\PaygreenApi\ObjectSerializer;

/**
 * Shop Class Doc Comment
 *
 * @category Class
 * @package  Hraph\PaygreenApi
 * @author   OpenAPI Generator team
 * @link     https://openapi-generator.tech
 */
class Shop implements ModelInterface, ArrayAccess
{
    const DISCRIMINATOR = null;

    /**
      * The original name of the model.
      *
      * @var string
      */
    protected static $openAPIModelName = 'Shop';

    /**
      * Array of property to type mappings. Used for (de)serialization
      *
      * @var string[]
      */
    protected static $openAPITypes = [
        'id' => 'string',
        'name' => 'string',
        'url' => 'string',
        'private_key' => 'string',
        'available_mode' => 'string[]',
        'business_identifier' => 'string',
        'company_type' => 'string',
        'description' => 'string',
        'activate' => 'bool',
        'validated_at' => '\DateTime',
        'created_at' => '\DateTime',
        'paiement_type' => 'string',
        'with_vad' => '\Hraph\PaygreenApi\Model\ShopWithVad',
        'without_vad' => '\Hraph\PaygreenApi\Model\ShopWithVad',
        'extra' => 'map[string,string]'
    ];

    /**
      * Array of property to format mappings. Used for (de)serialization
      *
      * @var string[]
      */
    protected static $openAPIFormats = [
        'id' => null,
        'name' => null,
        'url' => null,
        'private_key' => null,
        'available_mode' => null,
        'business_identifier' => null,
        'company_type' => null,
        'description' => null,
        'activate' => null,
        'validated_at' => 'date-time',
        'created_at' => 'date-time',
        'paiement_type' => null,
        'with_vad' => null,
        'without_vad' => null,
        'extra' => null
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
        'id' => 'id',
        'name' => 'name',
        'url' => 'url',
        'private_key' => 'privateKey',
        'available_mode' => 'availableMode',
        'business_identifier' => 'businessIdentifier',
        'company_type' => 'companyType',
        'description' => 'description',
        'activate' => 'activate',
        'validated_at' => 'validatedAt',
        'created_at' => 'createdAt',
        'paiement_type' => 'paiementType',
        'with_vad' => 'withVad',
        'without_vad' => 'withoutVad',
        'extra' => 'extra'
    ];

    /**
     * Array of attributes to setter functions (for deserialization of responses)
     *
     * @var string[]
     */
    protected static $setters = [
        'id' => 'setId',
        'name' => 'setName',
        'url' => 'setUrl',
        'private_key' => 'setPrivateKey',
        'available_mode' => 'setAvailableMode',
        'business_identifier' => 'setBusinessIdentifier',
        'company_type' => 'setCompanyType',
        'description' => 'setDescription',
        'activate' => 'setActivate',
        'validated_at' => 'setValidatedAt',
        'created_at' => 'setCreatedAt',
        'paiement_type' => 'setPaiementType',
        'with_vad' => 'setWithVad',
        'without_vad' => 'setWithoutVad',
        'extra' => 'setExtra'
    ];

    /**
     * Array of attributes to getter functions (for serialization of requests)
     *
     * @var string[]
     */
    protected static $getters = [
        'id' => 'getId',
        'name' => 'getName',
        'url' => 'getUrl',
        'private_key' => 'getPrivateKey',
        'available_mode' => 'getAvailableMode',
        'business_identifier' => 'getBusinessIdentifier',
        'company_type' => 'getCompanyType',
        'description' => 'getDescription',
        'activate' => 'getActivate',
        'validated_at' => 'getValidatedAt',
        'created_at' => 'getCreatedAt',
        'paiement_type' => 'getPaiementType',
        'with_vad' => 'getWithVad',
        'without_vad' => 'getWithoutVad',
        'extra' => 'getExtra'
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

    const PAIEMENT_TYPE_WITH_VAD = 'withVAD';
    const PAIEMENT_TYPE_WITHOUT_VAD = 'withoutVAD';
    

    
    /**
     * Gets allowable values of the enum
     *
     * @return string[]
     */
    public function getPaiementTypeAllowableValues()
    {
        return [
            self::PAIEMENT_TYPE_WITH_VAD,
            self::PAIEMENT_TYPE_WITHOUT_VAD,
        ];
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
        $this->container['id'] = isset($data['id']) ? $data['id'] : null;
        $this->container['name'] = isset($data['name']) ? $data['name'] : null;
        $this->container['url'] = isset($data['url']) ? $data['url'] : null;
        $this->container['private_key'] = isset($data['private_key']) ? $data['private_key'] : null;
        $this->container['available_mode'] = isset($data['available_mode']) ? $data['available_mode'] : null;
        $this->container['business_identifier'] = isset($data['business_identifier']) ? $data['business_identifier'] : null;
        $this->container['company_type'] = isset($data['company_type']) ? $data['company_type'] : null;
        $this->container['description'] = isset($data['description']) ? $data['description'] : null;
        $this->container['activate'] = isset($data['activate']) ? $data['activate'] : null;
        $this->container['validated_at'] = isset($data['validated_at']) ? $data['validated_at'] : null;
        $this->container['created_at'] = isset($data['created_at']) ? $data['created_at'] : null;
        $this->container['paiement_type'] = isset($data['paiement_type']) ? $data['paiement_type'] : null;
        $this->container['with_vad'] = isset($data['with_vad']) ? $data['with_vad'] : null;
        $this->container['without_vad'] = isset($data['without_vad']) ? $data['without_vad'] : null;
        $this->container['extra'] = isset($data['extra']) ? $data['extra'] : null;
    }

    /**
     * Show all the invalid properties with reasons.
     *
     * @return array invalid properties with reasons
     */
    public function listInvalidProperties()
    {
        $invalidProperties = [];

        if ($this->container['name'] === null) {
            $invalidProperties[] = "'name' can't be null";
        }
        if ($this->container['url'] === null) {
            $invalidProperties[] = "'url' can't be null";
        }
        if ($this->container['available_mode'] === null) {
            $invalidProperties[] = "'available_mode' can't be null";
        }
        if ($this->container['business_identifier'] === null) {
            $invalidProperties[] = "'business_identifier' can't be null";
        }
        if ($this->container['company_type'] === null) {
            $invalidProperties[] = "'company_type' can't be null";
        }
        if ($this->container['description'] === null) {
            $invalidProperties[] = "'description' can't be null";
        }
        if ($this->container['paiement_type'] === null) {
            $invalidProperties[] = "'paiement_type' can't be null";
        }
        $allowedValues = $this->getPaiementTypeAllowableValues();
        if (!is_null($this->container['paiement_type']) && !in_array($this->container['paiement_type'], $allowedValues, true)) {
            $invalidProperties[] = sprintf(
                "invalid value for 'paiement_type', must be one of '%s'",
                implode("', '", $allowedValues)
            );
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
     * Gets id
     *
     * @return string|null
     */
    public function getId()
    {
        return $this->container['id'];
    }

    /**
     * Sets id
     *
     * @param string|null $id id
     *
     * @return $this
     */
    public function setId($id)
    {
        $this->container['id'] = $id;

        return $this;
    }

    /**
     * Gets name
     *
     * @return string
     */
    public function getName()
    {
        return $this->container['name'];
    }

    /**
     * Sets name
     *
     * @param string $name name
     *
     * @return $this
     */
    public function setName($name)
    {
        $this->container['name'] = $name;

        return $this;
    }

    /**
     * Gets url
     *
     * @return string
     */
    public function getUrl()
    {
        return $this->container['url'];
    }

    /**
     * Sets url
     *
     * @param string $url url
     *
     * @return $this
     */
    public function setUrl($url)
    {
        $this->container['url'] = $url;

        return $this;
    }

    /**
     * Gets private_key
     *
     * @return string|null
     */
    public function getPrivateKey()
    {
        return $this->container['private_key'];
    }

    /**
     * Sets private_key
     *
     * @param string|null $private_key private_key
     *
     * @return $this
     */
    public function setPrivateKey($private_key)
    {
        $this->container['private_key'] = $private_key;

        return $this;
    }

    /**
     * Gets available_mode
     *
     * @return string[]
     */
    public function getAvailableMode()
    {
        return $this->container['available_mode'];
    }

    /**
     * Sets available_mode
     *
     * @param string[] $available_mode available_mode
     *
     * @return $this
     */
    public function setAvailableMode($available_mode)
    {
        $this->container['available_mode'] = $available_mode;

        return $this;
    }

    /**
     * Gets business_identifier
     *
     * @return string
     */
    public function getBusinessIdentifier()
    {
        return $this->container['business_identifier'];
    }

    /**
     * Sets business_identifier
     *
     * @param string $business_identifier business_identifier
     *
     * @return $this
     */
    public function setBusinessIdentifier($business_identifier)
    {
        $this->container['business_identifier'] = $business_identifier;

        return $this;
    }

    /**
     * Gets company_type
     *
     * @return string
     */
    public function getCompanyType()
    {
        return $this->container['company_type'];
    }

    /**
     * Sets company_type
     *
     * @param string $company_type company_type
     *
     * @return $this
     */
    public function setCompanyType($company_type)
    {
        $this->container['company_type'] = $company_type;

        return $this;
    }

    /**
     * Gets description
     *
     * @return string
     */
    public function getDescription()
    {
        return $this->container['description'];
    }

    /**
     * Sets description
     *
     * @param string $description description
     *
     * @return $this
     */
    public function setDescription($description)
    {
        $this->container['description'] = $description;

        return $this;
    }

    /**
     * Gets activate
     *
     * @return bool|null
     */
    public function getActivate()
    {
        return $this->container['activate'];
    }

    /**
     * Sets activate
     *
     * @param bool|null $activate activate
     *
     * @return $this
     */
    public function setActivate($activate)
    {
        $this->container['activate'] = $activate;

        return $this;
    }

    /**
     * Gets validated_at
     *
     * @return \DateTime|null
     */
    public function getValidatedAt()
    {
        return $this->container['validated_at'];
    }

    /**
     * Sets validated_at
     *
     * @param \DateTime|null $validated_at validated_at
     *
     * @return $this
     */
    public function setValidatedAt($validated_at)
    {
        $this->container['validated_at'] = $validated_at;

        return $this;
    }

    /**
     * Gets created_at
     *
     * @return \DateTime|null
     */
    public function getCreatedAt()
    {
        return $this->container['created_at'];
    }

    /**
     * Sets created_at
     *
     * @param \DateTime|null $created_at created_at
     *
     * @return $this
     */
    public function setCreatedAt($created_at)
    {
        $this->container['created_at'] = $created_at;

        return $this;
    }

    /**
     * Gets paiement_type
     *
     * @return string
     */
    public function getPaiementType()
    {
        return $this->container['paiement_type'];
    }

    /**
     * Sets paiement_type
     *
     * @param string $paiement_type paiement_type
     *
     * @return $this
     */
    public function setPaiementType($paiement_type)
    {
        $allowedValues = $this->getPaiementTypeAllowableValues();
        if (!in_array($paiement_type, $allowedValues, true)) {
            throw new \InvalidArgumentException(
                sprintf(
                    "Invalid value for 'paiement_type', must be one of '%s'",
                    implode("', '", $allowedValues)
                )
            );
        }
        $this->container['paiement_type'] = $paiement_type;

        return $this;
    }

    /**
     * Gets with_vad
     *
     * @return \Hraph\PaygreenApi\Model\ShopWithVad|null
     */
    public function getWithVad()
    {
        return $this->container['with_vad'];
    }

    /**
     * Sets with_vad
     *
     * @param \Hraph\PaygreenApi\Model\ShopWithVad|null $with_vad with_vad
     *
     * @return $this
     */
    public function setWithVad($with_vad)
    {
        $this->container['with_vad'] = $with_vad;

        return $this;
    }

    /**
     * Gets without_vad
     *
     * @return \Hraph\PaygreenApi\Model\ShopWithVad|null
     */
    public function getWithoutVad()
    {
        return $this->container['without_vad'];
    }

    /**
     * Sets without_vad
     *
     * @param \Hraph\PaygreenApi\Model\ShopWithVad|null $without_vad without_vad
     *
     * @return $this
     */
    public function setWithoutVad($without_vad)
    {
        $this->container['without_vad'] = $without_vad;

        return $this;
    }

    /**
     * Gets extra
     *
     * @return map[string,string]|null
     */
    public function getExtra()
    {
        return $this->container['extra'];
    }

    /**
     * Sets extra
     *
     * @param map[string,string]|null $extra extra
     *
     * @return $this
     */
    public function setExtra($extra)
    {
        $this->container['extra'] = $extra;

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
     * @return mixed
     */
    public function offsetGet($offset)
    {
        return isset($this->container[$offset]) ? $this->container[$offset] : null;
    }

    /**
     * Sets value based on offset.
     *
     * @param integer $offset Offset
     * @param mixed   $value  Value to be set
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


