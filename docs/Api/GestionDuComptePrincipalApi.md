# Hraph\PaygreenApi\GestionDuComptePrincipalApi

All URIs are relative to *https://paygreen.fr*

Method | HTTP request | Description
------------- | ------------- | -------------
[**apiIdentifiantAccountGet**](GestionDuComptePrincipalApi.md#apiIdentifiantAccountGet) | **GET** /api/{identifiant}/account | Afficher le compte principal
[**apiIdentifiantAccountPut**](GestionDuComptePrincipalApi.md#apiIdentifiantAccountPut) | **PUT** /api/{identifiant}/account | Met à jour le compte principal



## apiIdentifiantAccountGet

> \Hraph\PaygreenApi\Model\InlineResponse2003 apiIdentifiantAccountGet($identifiant, $authorization)

Afficher le compte principal

Donne les informations sur le compte principal PayGreen.

### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');


$apiInstance = new Hraph\PaygreenApi\Api\GestionDuComptePrincipalApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client()
);
$identifiant = 'identifiant_example'; // string | Votre identifiant PayGreen
$authorization = 'authorization_example'; // string | Votre clé privée PayGreen (Bearer : votre-clé-privée)

try {
    $result = $apiInstance->apiIdentifiantAccountGet($identifiant, $authorization);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling GestionDuComptePrincipalApi->apiIdentifiantAccountGet: ', $e->getMessage(), PHP_EOL;
}
?>
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
- **Accept**: application/json

[[Back to top]](#) [[Back to API list]](../../README.md#documentation-for-api-endpoints)
[[Back to Model list]](../../README.md#documentation-for-models)
[[Back to README]](../../README.md)


## apiIdentifiantAccountPut

> \Hraph\PaygreenApi\Model\InlineResponse2003 apiIdentifiantAccountPut($identifiant, $authorization, $account)

Met à jour le compte principal

Met à jour les données du compte principal

### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');


$apiInstance = new Hraph\PaygreenApi\Api\GestionDuComptePrincipalApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client()
);
$identifiant = 'identifiant_example'; // string | Votre identifiant PayGreen
$authorization = 'authorization_example'; // string | Votre clé privée PayGreen (Bearer : votre-clé-privée)
$account = new \Hraph\PaygreenApi\Model\Account(); // \Hraph\PaygreenApi\Model\Account | Modèle de données du compte principal PayGreen

try {
    $result = $apiInstance->apiIdentifiantAccountPut($identifiant, $authorization, $account);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling GestionDuComptePrincipalApi->apiIdentifiantAccountPut: ', $e->getMessage(), PHP_EOL;
}
?>
```

### Parameters


Name | Type | Description  | Notes
------------- | ------------- | ------------- | -------------
 **identifiant** | **string**| Votre identifiant PayGreen |
 **authorization** | **string**| Votre clé privée PayGreen (Bearer : votre-clé-privée) |
 **account** | [**\Hraph\PaygreenApi\Model\Account**](../Model/Account.md)| Modèle de données du compte principal PayGreen |

### Return type

[**\Hraph\PaygreenApi\Model\InlineResponse2003**](../Model/InlineResponse2003.md)

### Authorization

No authorization required

### HTTP request headers

- **Content-Type**: application/json
- **Accept**: application/json

[[Back to top]](#) [[Back to API list]](../../README.md#documentation-for-api-endpoints)
[[Back to Model list]](../../README.md#documentation-for-models)
[[Back to README]](../../README.md)

