# Hraph\PaygreenApi\LempreinteDeCarteApi

All URIs are relative to https://paygreen.fr.

Method | HTTP request | Description
------------- | ------------- | -------------
[**apiIdentifiantPayinsCardprintGet()**](LempreinteDeCarteApi.md#apiIdentifiantPayinsCardprintGet) | **GET** /api/{identifiant}/payins/cardprint | Liste des empreintes de carte
[**apiIdentifiantPayinsCardprintIdDelete()**](LempreinteDeCarteApi.md#apiIdentifiantPayinsCardprintIdDelete) | **DELETE** /api/{identifiant}/payins/cardprint/{id} | Supprimer une empreinte
[**apiIdentifiantPayinsCardprintIdGet()**](LempreinteDeCarteApi.md#apiIdentifiantPayinsCardprintIdGet) | **GET** /api/{identifiant}/payins/cardprint/{id} | Détails
[**apiIdentifiantPayinsCardprintPost()**](LempreinteDeCarteApi.md#apiIdentifiantPayinsCardprintPost) | **POST** /api/{identifiant}/payins/cardprint | Création d&#39;une empreinte de carte


## `apiIdentifiantPayinsCardprintGet()`

```php
apiIdentifiantPayinsCardprintGet($identifiant, $authorization): \Hraph\PaygreenApi\Model\InlineResponse20013
```

Liste des empreintes de carte

Cette requête vous permet d'obtenir la liste des empreintes de carte de votre boutique

### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');



$apiInstance = new Hraph\PaygreenApi\Api\LempreinteDeCarteApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client()
);
$identifiant = 'identifiant_example'; // string | Votre identifiant PayGreen
$authorization = 'authorization_example'; // string | Votre clé privée PayGreen (Bearer : votre-clé-privée)

try {
    $result = $apiInstance->apiIdentifiantPayinsCardprintGet($identifiant, $authorization);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling LempreinteDeCarteApi->apiIdentifiantPayinsCardprintGet: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

Name | Type | Description  | Notes
------------- | ------------- | ------------- | -------------
 **identifiant** | **string**| Votre identifiant PayGreen |
 **authorization** | **string**| Votre clé privée PayGreen (Bearer : votre-clé-privée) |

### Return type

[**\Hraph\PaygreenApi\Model\InlineResponse20013**](../Model/InlineResponse20013.md)

### Authorization

No authorization required

### HTTP request headers

- **Content-Type**: Not defined
- **Accept**: `application/json`

[[Back to top]](#) [[Back to API list]](../../README.md#endpoints)
[[Back to Model list]](../../README.md#models)
[[Back to README]](../../README.md)

## `apiIdentifiantPayinsCardprintIdDelete()`

```php
apiIdentifiantPayinsCardprintIdDelete($identifiant, $authorization, $id)
```

Supprimer une empreinte

Cette requête permet de supprimer une empreinte de don à partir de son `id`.

### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');



$apiInstance = new Hraph\PaygreenApi\Api\LempreinteDeCarteApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client()
);
$identifiant = 'identifiant_example'; // string | Votre identifiant PayGreen
$authorization = 'authorization_example'; // string | Votre clé privée PayGreen (Bearer : votre-clé-privée)
$id = 'id_example'; // string | Api.Model.CardPrint.id

try {
    $apiInstance->apiIdentifiantPayinsCardprintIdDelete($identifiant, $authorization, $id);
} catch (Exception $e) {
    echo 'Exception when calling LempreinteDeCarteApi->apiIdentifiantPayinsCardprintIdDelete: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

Name | Type | Description  | Notes
------------- | ------------- | ------------- | -------------
 **identifiant** | **string**| Votre identifiant PayGreen |
 **authorization** | **string**| Votre clé privée PayGreen (Bearer : votre-clé-privée) |
 **id** | **string**| Api.Model.CardPrint.id |

### Return type

void (empty response body)

### Authorization

No authorization required

### HTTP request headers

- **Content-Type**: Not defined
- **Accept**: Not defined

[[Back to top]](#) [[Back to API list]](../../README.md#endpoints)
[[Back to Model list]](../../README.md#models)
[[Back to README]](../../README.md)

## `apiIdentifiantPayinsCardprintIdGet()`

```php
apiIdentifiantPayinsCardprintIdGet($identifiant, $authorization, $id): \Hraph\PaygreenApi\Model\InlineResponse20014
```

Détails

Cette requête vous permet d'obtenir tous les détails d'une empreinte de carte.

### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');



$apiInstance = new Hraph\PaygreenApi\Api\LempreinteDeCarteApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client()
);
$identifiant = 'identifiant_example'; // string | Votre identifiant PayGreen
$authorization = 'authorization_example'; // string | Votre clé privée PayGreen (Bearer : votre-clé-privée)
$id = 'id_example'; // string | Api.Model.CardPrint.id

try {
    $result = $apiInstance->apiIdentifiantPayinsCardprintIdGet($identifiant, $authorization, $id);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling LempreinteDeCarteApi->apiIdentifiantPayinsCardprintIdGet: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

Name | Type | Description  | Notes
------------- | ------------- | ------------- | -------------
 **identifiant** | **string**| Votre identifiant PayGreen |
 **authorization** | **string**| Votre clé privée PayGreen (Bearer : votre-clé-privée) |
 **id** | **string**| Api.Model.CardPrint.id |

### Return type

[**\Hraph\PaygreenApi\Model\InlineResponse20014**](../Model/InlineResponse20014.md)

### Authorization

No authorization required

### HTTP request headers

- **Content-Type**: Not defined
- **Accept**: `application/json`

[[Back to top]](#) [[Back to API list]](../../README.md#endpoints)
[[Back to Model list]](../../README.md#models)
[[Back to README]](../../README.md)

## `apiIdentifiantPayinsCardprintPost()`

```php
apiIdentifiantPayinsCardprintPost($identifiant, $authorization, $card_print): \Hraph\PaygreenApi\Model\InlineResponse20014
```

Création d'une empreinte de carte

La création de l'empreinte de carte se traduit pour le consommateur par l'affichage d'une interface de paiement PayGreen, dans laquelle il va renseigner ses informations de carte. Le consommateur **n'est pas débité** lors de l'empreinte.<br /> <br /> Dans le cas d'une empreinte de carte de type `SEPA`, l'interface PayGreen demande des informations sur le consommateur (nom, prénom, date de naissance, mail) ainsi qu'un Iban valide. Une fois ces données confirmées, le consommateur est redirigé chez notre partenaire bancaire pour signer son mandat.<br /> <br /> Pour obtenir cette interface, vous devez envoyer une requête contenant notamment l'identifiant de la commande (`orderId`) et les informations sur l'acheteur (nom, prénom&hellip; dans le `buyer`). <br /> <br /> Le client peut ensuite renseigner ses informations de carte bancaire et valider.<br /> <br /> Dans le cas du TRD Conecs, lors de l'utilisation d'une empreinte de carte, si le montant disponible sur la carte est inférieur au montant demandé, une transaction avec le montant disponible sera créé. Par exemple, si vous demandez 19€ mais que la carte n`a que 10€ de disponible, notre API vous retournera un paiement validé avec un `amount` à 1000 et un `originalAmount` à 1900. C'est à vous de gérer le complément si besoin.<br /> <br /> Une fois l'empreinte de carte effectuée, vous recevez une réponse contenant notamment un `id` (dans le `data`). Vous pourrez alors renseigner cet `id` dans le paramètre `token` de l'objet `card` lors de la création d'un **paiement comptant** ou **paiement par abonnement** ou **paiement en plusieurs fois**.

### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');



$apiInstance = new Hraph\PaygreenApi\Api\LempreinteDeCarteApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client()
);
$identifiant = 'identifiant_example'; // string | Votre identifiant PayGreen
$authorization = 'authorization_example'; // string | Votre clé privée PayGreen (Bearer : votre-clé-privée)
$card_print = new \Hraph\PaygreenApi\Model\CardPrint(); // \Hraph\PaygreenApi\Model\CardPrint | Modèle d'une empreinte de carte.

try {
    $result = $apiInstance->apiIdentifiantPayinsCardprintPost($identifiant, $authorization, $card_print);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling LempreinteDeCarteApi->apiIdentifiantPayinsCardprintPost: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

Name | Type | Description  | Notes
------------- | ------------- | ------------- | -------------
 **identifiant** | **string**| Votre identifiant PayGreen |
 **authorization** | **string**| Votre clé privée PayGreen (Bearer : votre-clé-privée) |
 **card_print** | [**\Hraph\PaygreenApi\Model\CardPrint**](../Model/CardPrint.md)| Modèle d&#39;une empreinte de carte. |

### Return type

[**\Hraph\PaygreenApi\Model\InlineResponse20014**](../Model/InlineResponse20014.md)

### Authorization

No authorization required

### HTTP request headers

- **Content-Type**: `application/json`
- **Accept**: `application/json`

[[Back to top]](#) [[Back to API list]](../../README.md#endpoints)
[[Back to Model list]](../../README.md#models)
[[Back to README]](../../README.md)
