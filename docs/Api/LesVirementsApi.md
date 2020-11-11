# Hraph\PaygreenApi\LesVirementsApi

All URIs are relative to *https://paygreen.fr*

Method | HTTP request | Description
------------- | ------------- | -------------
[**apiIdentifiantPayoutTransferGet**](LesVirementsApi.md#apiIdentifiantPayoutTransferGet) | **GET** /api/{identifiant}/payout/transfer | Liste des virements
[**apiIdentifiantPayoutTransferIdGet**](LesVirementsApi.md#apiIdentifiantPayoutTransferIdGet) | **GET** /api/{identifiant}/payout/transfer/{id} | Détails
[**apiIdentifiantPayoutTransferPost**](LesVirementsApi.md#apiIdentifiantPayoutTransferPost) | **POST** /api/{identifiant}/payout/transfer | Créer un virement



## apiIdentifiantPayoutTransferGet

> \Hraph\PaygreenApi\Model\InlineResponse20021 apiIdentifiantPayoutTransferGet($identifiant, $authorization)

Liste des virements

Cette requête vous permet d'obtenir la liste des virements de votre boutique

### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');


$apiInstance = new Hraph\PaygreenApi\Api\LesVirementsApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client()
);
$identifiant = 'identifiant_example'; // string | Votre identifiant PayGreen
$authorization = 'authorization_example'; // string | Votre clé privée PayGreen (Bearer : votre-clé-privée)

try {
    $result = $apiInstance->apiIdentifiantPayoutTransferGet($identifiant, $authorization);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling LesVirementsApi->apiIdentifiantPayoutTransferGet: ', $e->getMessage(), PHP_EOL;
}
?>
```

### Parameters


Name | Type | Description  | Notes
------------- | ------------- | ------------- | -------------
 **identifiant** | **string**| Votre identifiant PayGreen |
 **authorization** | **string**| Votre clé privée PayGreen (Bearer : votre-clé-privée) |

### Return type

[**\Hraph\PaygreenApi\Model\InlineResponse20021**](../Model/InlineResponse20021.md)

### Authorization

No authorization required

### HTTP request headers

- **Content-Type**: Not defined
- **Accept**: application/json

[[Back to top]](#) [[Back to API list]](../../README.md#documentation-for-api-endpoints)
[[Back to Model list]](../../README.md#documentation-for-models)
[[Back to README]](../../README.md)


## apiIdentifiantPayoutTransferIdGet

> \Hraph\PaygreenApi\Model\InlineResponse20020 apiIdentifiantPayoutTransferIdGet($identifiant, $authorization, $id)

Détails

Cette requête vous permet d'obtenir tous les détails d'un virement

### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');


$apiInstance = new Hraph\PaygreenApi\Api\LesVirementsApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client()
);
$identifiant = 'identifiant_example'; // string | Votre identifiant PayGreen
$authorization = 'authorization_example'; // string | Votre clé privée PayGreen (Bearer : votre-clé-privée)
$id = 'id_example'; // string | Api.Model.Transfer.id

try {
    $result = $apiInstance->apiIdentifiantPayoutTransferIdGet($identifiant, $authorization, $id);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling LesVirementsApi->apiIdentifiantPayoutTransferIdGet: ', $e->getMessage(), PHP_EOL;
}
?>
```

### Parameters


Name | Type | Description  | Notes
------------- | ------------- | ------------- | -------------
 **identifiant** | **string**| Votre identifiant PayGreen |
 **authorization** | **string**| Votre clé privée PayGreen (Bearer : votre-clé-privée) |
 **id** | **string**| Api.Model.Transfer.id |

### Return type

[**\Hraph\PaygreenApi\Model\InlineResponse20020**](../Model/InlineResponse20020.md)

### Authorization

No authorization required

### HTTP request headers

- **Content-Type**: Not defined
- **Accept**: application/json

[[Back to top]](#) [[Back to API list]](../../README.md#documentation-for-api-endpoints)
[[Back to Model list]](../../README.md#documentation-for-models)
[[Back to README]](../../README.md)


## apiIdentifiantPayoutTransferPost

> \Hraph\PaygreenApi\Model\InlineResponse20020 apiIdentifiantPayoutTransferPost($identifiant, $authorization, $transfer)

Créer un virement

Cette méthode permet de créer un virement. Si vous créez un virement vers un compte bancaire (objet `bank`), votre RIB doit nécessairement être **valide**.<br /> <br /> ### IPN d'un virement<br /> <br /> Le paramètre `callbackUrl` vous permet, s'il est renseigné, d'envoyer une notification (**IPN**) à vos serveurs lors du changement de statut d'un virement (afin de savoir précisément si et quand le virement que vous avez créé a bien été effectué). L'envoi de l'IPN peut parfois prendre plusieurs minutes.<br /> <br /> Il existe 4 statuts de virement&nbsp;:<br /> - `WAITING`&nbsp;: statut d'un virement en attente. Statut par défaut.<br /> - `SUCCESS`&nbsp;: virement effectué avec succès.<br /> - `ERROR`&nbsp;: une erreur est survenue lors du virement (il n'a donc pas pu être effectué).<br /> - `CANCEL`&nbsp;: virement annulé par notre équipe.<br /> <br /> > Dès lors que le statut du virement change (qu'il passe en `SUCCESS`, `ERROR` ou plus rarement, `CANCEL`), l'IPN est envoyée à l'URL renseignée dans le paramètre `callbackUrl`). *Voir le tableau ci-dessous pour le détails des informations renvoyées dans l'IPN*.<br /> <table><tbody><tr><th>Paramètres</th><th>Exemples de valeur</th><th>Commentaires</th></tr><tr><td><code>pid</code></td><td><code>37330ff88bd7f7b0082d031d6eb59bb4</code></td><td>ID du virement</td></tr><tr><td><code>result</code></td><td><code>SUCCESS</code></td><td>Statut du virement. Ne peut être que <code>SUCCESS</code>, <code>ERROR</code> ou <code>CANCEL</code>.</td></tr><tr><td><code>orderId</code></td><td><code>&hellip;</code></td><td>Chaîne de caractère créée par le partenaire bancaire</td></tr><tr><td><code>shopId</code></td><td><code>ce642ce1613b47667dbd3785e5faf666</code></td><td>Votre identifiant unique <code>shop ID</code></td></tr><tr><td><code>amount</code></td><td><code>9900</code></td><td>Montant en centimes</td></tr><tr><td><code>createdAt</code></td><td><code>2018-12-27T11:07:59Z</code></td><td>Date et heure de la création du virement</td></tr><tr><td><code>scheduledAt</code></td><td><code>2018-12-27T11:07:59Z</code></td><td>Date et heure de la planification du virement</td></tr><tr><td><code>answeredAt</code></td><td><code>2018-12-27T11:07:59Z</code></td><td>Date et heure auxquelles le virement a été effectué</td></tr></tbody></table>

### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');


$apiInstance = new Hraph\PaygreenApi\Api\LesVirementsApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client()
);
$identifiant = 'identifiant_example'; // string | Votre identifiant PayGreen
$authorization = 'authorization_example'; // string | Votre clé privée PayGreen (Bearer : votre-clé-privée)
$transfer = new \Hraph\PaygreenApi\Model\Transfer(); // \Hraph\PaygreenApi\Model\Transfer | Modèle de données d'un virement.

try {
    $result = $apiInstance->apiIdentifiantPayoutTransferPost($identifiant, $authorization, $transfer);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling LesVirementsApi->apiIdentifiantPayoutTransferPost: ', $e->getMessage(), PHP_EOL;
}
?>
```

### Parameters


Name | Type | Description  | Notes
------------- | ------------- | ------------- | -------------
 **identifiant** | **string**| Votre identifiant PayGreen |
 **authorization** | **string**| Votre clé privée PayGreen (Bearer : votre-clé-privée) |
 **transfer** | [**\Hraph\PaygreenApi\Model\Transfer**](../Model/Transfer.md)| Modèle de données d&#39;un virement. |

### Return type

[**\Hraph\PaygreenApi\Model\InlineResponse20020**](../Model/InlineResponse20020.md)

### Authorization

No authorization required

### HTTP request headers

- **Content-Type**: application/json
- **Accept**: application/json

[[Back to top]](#) [[Back to API list]](../../README.md#documentation-for-api-endpoints)
[[Back to Model list]](../../README.md#documentation-for-models)
[[Back to README]](../../README.md)

