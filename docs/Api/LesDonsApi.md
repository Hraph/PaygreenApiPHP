# Hraph\PaygreenApi\LesDonsApi

All URIs are relative to *https://paygreen.fr*

Method | HTTP request | Description
------------- | ------------- | -------------
[**apiIdentifiantSolidarityIdDelete**](LesDonsApi.md#apiIdentifiantSolidarityIdDelete) | **DELETE** /api/{identifiant}/solidarity/{id} | Supprimer un don
[**apiIdentifiantSolidarityIdGet**](LesDonsApi.md#apiIdentifiantSolidarityIdGet) | **GET** /api/{identifiant}/solidarity/{id} | Afficher un don
[**apiIdentifiantSolidarityIdPatch**](LesDonsApi.md#apiIdentifiantSolidarityIdPatch) | **PATCH** /api/{identifiant}/solidarity/{id} | Créer un don



## apiIdentifiantSolidarityIdDelete

> apiIdentifiantSolidarityIdDelete($identifiant, $authorization, $id)

Supprimer un don

Cette requête permet de supprimer un don à partir de son `id`.

### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');


$apiInstance = new Hraph\PaygreenApi\Api\LesDonsApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client()
);
$identifiant = 'identifiant_example'; // string | Votre identifiant PayGreen
$authorization = 'authorization_example'; // string | Votre clé privée PayGreen (Bearer : votre-clé-privée)
$id = 'id_example'; // string | ID du don

try {
    $apiInstance->apiIdentifiantSolidarityIdDelete($identifiant, $authorization, $id);
} catch (Exception $e) {
    echo 'Exception when calling LesDonsApi->apiIdentifiantSolidarityIdDelete: ', $e->getMessage(), PHP_EOL;
}
?>
```

### Parameters


Name | Type | Description  | Notes
------------- | ------------- | ------------- | -------------
 **identifiant** | **string**| Votre identifiant PayGreen |
 **authorization** | **string**| Votre clé privée PayGreen (Bearer : votre-clé-privée) |
 **id** | **string**| ID du don |

### Return type

void (empty response body)

### Authorization

No authorization required

### HTTP request headers

- **Content-Type**: Not defined
- **Accept**: Not defined

[[Back to top]](#) [[Back to API list]](../../README.md#documentation-for-api-endpoints)
[[Back to Model list]](../../README.md#documentation-for-models)
[[Back to README]](../../README.md)


## apiIdentifiantSolidarityIdGet

> \Hraph\PaygreenApi\Model\InlineResponse20011 apiIdentifiantSolidarityIdGet($identifiant, $authorization, $id)

Afficher un don

Cette requête permet d'obtenir les détails d'un don à partir de son `id`.

### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');


$apiInstance = new Hraph\PaygreenApi\Api\LesDonsApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client()
);
$identifiant = 'identifiant_example'; // string | Votre identifiant PayGreen
$authorization = 'authorization_example'; // string | Votre clé privée PayGreen (Bearer : votre-clé-privée)
$id = 'id_example'; // string | ID du don

try {
    $result = $apiInstance->apiIdentifiantSolidarityIdGet($identifiant, $authorization, $id);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling LesDonsApi->apiIdentifiantSolidarityIdGet: ', $e->getMessage(), PHP_EOL;
}
?>
```

### Parameters


Name | Type | Description  | Notes
------------- | ------------- | ------------- | -------------
 **identifiant** | **string**| Votre identifiant PayGreen |
 **authorization** | **string**| Votre clé privée PayGreen (Bearer : votre-clé-privée) |
 **id** | **string**| ID du don |

### Return type

[**\Hraph\PaygreenApi\Model\InlineResponse20011**](../Model/InlineResponse20011.md)

### Authorization

No authorization required

### HTTP request headers

- **Content-Type**: Not defined
- **Accept**: application/json

[[Back to top]](#) [[Back to API list]](../../README.md#documentation-for-api-endpoints)
[[Back to Model list]](../../README.md#documentation-for-models)
[[Back to README]](../../README.md)


## apiIdentifiantSolidarityIdPatch

> \Hraph\PaygreenApi\Model\InlineResponse20011 apiIdentifiantSolidarityIdPatch($identifiant, $authorization, $id, $solidarity)

Créer un don

Cette requête vous permet de créer un don lié à une transaction. Pour cela, il suffit de renseigner dans l'URL, après `/solidarity/`, l'`id` de la transaction à laquelle on souhaite ajouter un don.

### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');


$apiInstance = new Hraph\PaygreenApi\Api\LesDonsApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client()
);
$identifiant = 'identifiant_example'; // string | Votre identifiant PayGreen
$authorization = 'authorization_example'; // string | Votre clé privée PayGreen (Bearer : votre-clé-privée)
$id = 'id_example'; // string | ID de la transaction
$solidarity = new \Hraph\PaygreenApi\Model\Solidarity(); // \Hraph\PaygreenApi\Model\Solidarity | Modèle de données d'un don.

try {
    $result = $apiInstance->apiIdentifiantSolidarityIdPatch($identifiant, $authorization, $id, $solidarity);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling LesDonsApi->apiIdentifiantSolidarityIdPatch: ', $e->getMessage(), PHP_EOL;
}
?>
```

### Parameters


Name | Type | Description  | Notes
------------- | ------------- | ------------- | -------------
 **identifiant** | **string**| Votre identifiant PayGreen |
 **authorization** | **string**| Votre clé privée PayGreen (Bearer : votre-clé-privée) |
 **id** | **string**| ID de la transaction |
 **solidarity** | [**\Hraph\PaygreenApi\Model\Solidarity**](../Model/Solidarity.md)| Modèle de données d&#39;un don. |

### Return type

[**\Hraph\PaygreenApi\Model\InlineResponse20011**](../Model/InlineResponse20011.md)

### Authorization

No authorization required

### HTTP request headers

- **Content-Type**: application/json
- **Accept**: application/json

[[Back to top]](#) [[Back to API list]](../../README.md#documentation-for-api-endpoints)
[[Back to Model list]](../../README.md#documentation-for-models)
[[Back to README]](../../README.md)

