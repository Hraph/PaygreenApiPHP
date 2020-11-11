# Hraph\PaygreenApi\GestionDuneAssociationApi

All URIs are relative to *https://paygreen.fr*

Method | HTTP request | Description
------------- | ------------- | -------------
[**apiIdentifiantSolidarityGet**](GestionDuneAssociationApi.md#apiIdentifiantSolidarityGet) | **GET** /api/{identifiant}/solidarity | Liste des associations



## apiIdentifiantSolidarityGet

> \Hraph\PaygreenApi\Model\InlineResponse20015 apiIdentifiantSolidarityGet($identifiant, $authorization)

Liste des associations

Obtenir la liste des associations

### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');


$apiInstance = new Hraph\PaygreenApi\Api\GestionDuneAssociationApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client()
);
$identifiant = 'identifiant_example'; // string | Votre identifiant PayGreen
$authorization = 'authorization_example'; // string | Votre clé privée PayGreen (Bearer : votre-clé-privée)

try {
    $result = $apiInstance->apiIdentifiantSolidarityGet($identifiant, $authorization);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling GestionDuneAssociationApi->apiIdentifiantSolidarityGet: ', $e->getMessage(), PHP_EOL;
}
?>
```

### Parameters


Name | Type | Description  | Notes
------------- | ------------- | ------------- | -------------
 **identifiant** | **string**| Votre identifiant PayGreen |
 **authorization** | **string**| Votre clé privée PayGreen (Bearer : votre-clé-privée) |

### Return type

[**\Hraph\PaygreenApi\Model\InlineResponse20015**](../Model/InlineResponse20015.md)

### Authorization

No authorization required

### HTTP request headers

- **Content-Type**: Not defined
- **Accept**: application/json

[[Back to top]](#) [[Back to API list]](../../README.md#documentation-for-api-endpoints)
[[Back to Model list]](../../README.md#documentation-for-models)
[[Back to README]](../../README.md)

