# Hraph\PaygreenApi\GestionDeMesBoutiquesApi

All URIs are relative to https://paygreen.fr.

Method | HTTP request | Description
------------- | ------------- | -------------
[**apiIdentifiantShopsGet()**](GestionDeMesBoutiquesApi.md#apiIdentifiantShopsGet) | **GET** /api/{identifiant}/shops | Liste des boutiques


## `apiIdentifiantShopsGet()`

```php
apiIdentifiantShopsGet($identifiant, $authorization): \Hraph\PaygreenApi\Model\InlineResponse2003
```

Liste des boutiques

Permet de lister toutes vos boutiques.

### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');



$apiInstance = new Hraph\PaygreenApi\Api\GestionDeMesBoutiquesApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client()
);
$identifiant = 'identifiant_example'; // string | Votre identifiant PayGreen
$authorization = 'authorization_example'; // string | Votre clé privée PayGreen (Bearer : votre-clé-privée)

try {
    $result = $apiInstance->apiIdentifiantShopsGet($identifiant, $authorization);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling GestionDeMesBoutiquesApi->apiIdentifiantShopsGet: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

Name | Type | Description  | Notes
------------- | ------------- | ------------- | -------------
 **identifiant** | **string**| Votre identifiant PayGreen |
 **authorization** | **string**| Votre clé privée PayGreen (Bearer : votre-clé-privée) |

### Return type

[**\Hraph\PaygreenApi\Model\InlineResponse2003**](../Model/InlineResponse2003.md)

### Authorization

No authorization required

### HTTP request headers

- **Content-Type**: Not defined
- **Accept**: `application/json`

[[Back to top]](#) [[Back to API list]](../../README.md#endpoints)
[[Back to Model list]](../../README.md#models)
[[Back to README]](../../README.md)
