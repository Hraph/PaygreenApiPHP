# Hraph\PaygreenApi\GestionDeLadresseApi

All URIs are relative to *https://paygreen.fr*

Method | HTTP request | Description
------------- | ------------- | -------------
[**apiIdentifiantAddressGet**](GestionDeLadresseApi.md#apiIdentifiantAddressGet) | **GET** /api/{identifiant}/address | Liste des adresses
[**apiIdentifiantAddressPost**](GestionDeLadresseApi.md#apiIdentifiantAddressPost) | **POST** /api/{identifiant}/address | Créer une adresse



## apiIdentifiantAddressGet

> \Hraph\PaygreenApi\Model\InlineResponse2005 apiIdentifiantAddressGet($identifiant, $authorization)

Liste des adresses

Obtenir la liste de vos adresses

### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');


$apiInstance = new Hraph\PaygreenApi\Api\GestionDeLadresseApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client()
);
$identifiant = 'identifiant_example'; // string | Votre identifiant PayGreen
$authorization = 'authorization_example'; // string | Votre clé privée PayGreen (Bearer : votre-clé-privée)

try {
    $result = $apiInstance->apiIdentifiantAddressGet($identifiant, $authorization);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling GestionDeLadresseApi->apiIdentifiantAddressGet: ', $e->getMessage(), PHP_EOL;
}
?>
```

### Parameters


Name | Type | Description  | Notes
------------- | ------------- | ------------- | -------------
 **identifiant** | **string**| Votre identifiant PayGreen |
 **authorization** | **string**| Votre clé privée PayGreen (Bearer : votre-clé-privée) |

### Return type

[**\Hraph\PaygreenApi\Model\InlineResponse2005**](../Model/InlineResponse2005.md)

### Authorization

No authorization required

### HTTP request headers

- **Content-Type**: Not defined
- **Accept**: application/json

[[Back to top]](#) [[Back to API list]](../../README.md#documentation-for-api-endpoints)
[[Back to Model list]](../../README.md#documentation-for-models)
[[Back to README]](../../README.md)


## apiIdentifiantAddressPost

> \Hraph\PaygreenApi\Model\InlineResponse2006 apiIdentifiantAddressPost($identifiant, $authorization, $address)

Créer une adresse

Créer une nouvelle adresse. Pour créer une nouvelle adresse, vous devez fournir les données présentes dans l'exemple.

### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');


$apiInstance = new Hraph\PaygreenApi\Api\GestionDeLadresseApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client()
);
$identifiant = 'identifiant_example'; // string | Votre identifiant PayGreen
$authorization = 'authorization_example'; // string | Votre clé privée PayGreen (Bearer : votre-clé-privée)
$address = new \Hraph\PaygreenApi\Model\Address(); // \Hraph\PaygreenApi\Model\Address | Modèle d'une adresse

try {
    $result = $apiInstance->apiIdentifiantAddressPost($identifiant, $authorization, $address);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling GestionDeLadresseApi->apiIdentifiantAddressPost: ', $e->getMessage(), PHP_EOL;
}
?>
```

### Parameters


Name | Type | Description  | Notes
------------- | ------------- | ------------- | -------------
 **identifiant** | **string**| Votre identifiant PayGreen |
 **authorization** | **string**| Votre clé privée PayGreen (Bearer : votre-clé-privée) |
 **address** | [**\Hraph\PaygreenApi\Model\Address**](../Model/Address.md)| Modèle d&#39;une adresse |

### Return type

[**\Hraph\PaygreenApi\Model\InlineResponse2006**](../Model/InlineResponse2006.md)

### Authorization

No authorization required

### HTTP request headers

- **Content-Type**: application/json
- **Accept**: application/json

[[Back to top]](#) [[Back to API list]](../../README.md#documentation-for-api-endpoints)
[[Back to Model list]](../../README.md#documentation-for-models)
[[Back to README]](../../README.md)

