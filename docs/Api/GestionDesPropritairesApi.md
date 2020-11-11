# Hraph\PaygreenApi\GestionDesPropritairesApi

All URIs are relative to *https://paygreen.fr*

Method | HTTP request | Description
------------- | ------------- | -------------
[**apiIdentifiantShareholderGet**](GestionDesPropritairesApi.md#apiIdentifiantShareholderGet) | **GET** /api/{identifiant}/shareholder | Liste des propriétaires
[**apiIdentifiantShareholderPost**](GestionDesPropritairesApi.md#apiIdentifiantShareholderPost) | **POST** /api/{identifiant}/shareholder | Créer un propriétaire



## apiIdentifiantShareholderGet

> \Hraph\PaygreenApi\Model\InlineResponse2007 apiIdentifiantShareholderGet($identifiant, $authorization)

Liste des propriétaires

Obtenir la liste des propriétaires

### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');


$apiInstance = new Hraph\PaygreenApi\Api\GestionDesPropritairesApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client()
);
$identifiant = 'identifiant_example'; // string | Votre identifiant PayGreen
$authorization = 'authorization_example'; // string | Votre clé privée PayGreen (Bearer : votre-clé-privée)

try {
    $result = $apiInstance->apiIdentifiantShareholderGet($identifiant, $authorization);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling GestionDesPropritairesApi->apiIdentifiantShareholderGet: ', $e->getMessage(), PHP_EOL;
}
?>
```

### Parameters


Name | Type | Description  | Notes
------------- | ------------- | ------------- | -------------
 **identifiant** | **string**| Votre identifiant PayGreen |
 **authorization** | **string**| Votre clé privée PayGreen (Bearer : votre-clé-privée) |

### Return type

[**\Hraph\PaygreenApi\Model\InlineResponse2007**](../Model/InlineResponse2007.md)

### Authorization

No authorization required

### HTTP request headers

- **Content-Type**: Not defined
- **Accept**: application/json

[[Back to top]](#) [[Back to API list]](../../README.md#documentation-for-api-endpoints)
[[Back to Model list]](../../README.md#documentation-for-models)
[[Back to README]](../../README.md)


## apiIdentifiantShareholderPost

> \Hraph\PaygreenApi\Model\InlineResponse2008 apiIdentifiantShareholderPost($identifiant, $authorization, $shareholder)

Créer un propriétaire

Créer un nouveau propriétaire. Il vous est possible d'instancier plusieurs personnes en même temps en envoyant un tableau de plusieurs propriétaires.

### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');


$apiInstance = new Hraph\PaygreenApi\Api\GestionDesPropritairesApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client()
);
$identifiant = 'identifiant_example'; // string | Votre identifiant PayGreen
$authorization = 'authorization_example'; // string | Votre clé privée PayGreen (Bearer : votre-clé-privée)
$shareholder = new \Hraph\PaygreenApi\Model\Shareholder(); // \Hraph\PaygreenApi\Model\Shareholder | Modèle d'un propriétaire

try {
    $result = $apiInstance->apiIdentifiantShareholderPost($identifiant, $authorization, $shareholder);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling GestionDesPropritairesApi->apiIdentifiantShareholderPost: ', $e->getMessage(), PHP_EOL;
}
?>
```

### Parameters


Name | Type | Description  | Notes
------------- | ------------- | ------------- | -------------
 **identifiant** | **string**| Votre identifiant PayGreen |
 **authorization** | **string**| Votre clé privée PayGreen (Bearer : votre-clé-privée) |
 **shareholder** | [**\Hraph\PaygreenApi\Model\Shareholder**](../Model/Shareholder.md)| Modèle d&#39;un propriétaire |

### Return type

[**\Hraph\PaygreenApi\Model\InlineResponse2008**](../Model/InlineResponse2008.md)

### Authorization

No authorization required

### HTTP request headers

- **Content-Type**: application/json
- **Accept**: application/json

[[Back to top]](#) [[Back to API list]](../../README.md#documentation-for-api-endpoints)
[[Back to Model list]](../../README.md#documentation-for-models)
[[Back to README]](../../README.md)

