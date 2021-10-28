# Hraph\PaygreenApi\GestionDeMesRIBApi

All URIs are relative to https://paygreen.fr.

Method | HTTP request | Description
------------- | ------------- | -------------
[**apiIdentifiantBankGet()**](GestionDeMesRIBApi.md#apiIdentifiantBankGet) | **GET** /api/{identifiant}/bank | Afficher mon RIB
[**apiIdentifiantBankPost()**](GestionDeMesRIBApi.md#apiIdentifiantBankPost) | **POST** /api/{identifiant}/bank | Création d&#39;un RIB


## `apiIdentifiantBankGet()`

```php
apiIdentifiantBankGet($identifiant, $authorization): \Hraph\PaygreenApi\Model\InlineResponse20018
```

Afficher mon RIB

Obtenir le ou les RIB de la boutique

### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');



$apiInstance = new Hraph\PaygreenApi\Api\GestionDeMesRIBApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client()
);
$identifiant = 'identifiant_example'; // string | Votre identifiant PayGreen
$authorization = 'authorization_example'; // string | Votre clé privée PayGreen (Bearer : votre-clé-privée)

try {
    $result = $apiInstance->apiIdentifiantBankGet($identifiant, $authorization);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling GestionDeMesRIBApi->apiIdentifiantBankGet: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

Name | Type | Description  | Notes
------------- | ------------- | ------------- | -------------
 **identifiant** | **string**| Votre identifiant PayGreen |
 **authorization** | **string**| Votre clé privée PayGreen (Bearer : votre-clé-privée) |

### Return type

[**\Hraph\PaygreenApi\Model\InlineResponse20018**](../Model/InlineResponse20018.md)

### Authorization

No authorization required

### HTTP request headers

- **Content-Type**: Not defined
- **Accept**: `application/json`

[[Back to top]](#) [[Back to API list]](../../README.md#endpoints)
[[Back to Model list]](../../README.md#models)
[[Back to README]](../../README.md)

## `apiIdentifiantBankPost()`

```php
apiIdentifiantBankPost($identifiant, $authorization, $rib): \Hraph\PaygreenApi\Model\InlineResponse20019
```

Création d'un RIB

Permet de créer un nouveau RIB. Pour créer un RIB, il faut donner les valeurs présentes dans l'exemple. Pour permettre la validation de votre RIB auprès de notre partenaire, il est nécessaire de nous fournir un scan. Vous trouverez toutes les informations nécessaires à l'envoit de documents dans la partie Gestion des Documents/KYC

### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');



$apiInstance = new Hraph\PaygreenApi\Api\GestionDeMesRIBApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client()
);
$identifiant = 'identifiant_example'; // string | Votre identifiant PayGreen
$authorization = 'authorization_example'; // string | Votre clé privée PayGreen (Bearer : votre-clé-privée)
$rib = new \Hraph\PaygreenApi\Model\Rib(); // \Hraph\PaygreenApi\Model\Rib | Modèle de données d'un RIB

try {
    $result = $apiInstance->apiIdentifiantBankPost($identifiant, $authorization, $rib);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling GestionDeMesRIBApi->apiIdentifiantBankPost: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

Name | Type | Description  | Notes
------------- | ------------- | ------------- | -------------
 **identifiant** | **string**| Votre identifiant PayGreen |
 **authorization** | **string**| Votre clé privée PayGreen (Bearer : votre-clé-privée) |
 **rib** | [**\Hraph\PaygreenApi\Model\Rib**](../Model/Rib.md)| Modèle de données d&#39;un RIB |

### Return type

[**\Hraph\PaygreenApi\Model\InlineResponse20019**](../Model/InlineResponse20019.md)

### Authorization

No authorization required

### HTTP request headers

- **Content-Type**: `application/json`
- **Accept**: `application/json`

[[Back to top]](#) [[Back to API list]](../../README.md#endpoints)
[[Back to Model list]](../../README.md#models)
[[Back to README]](../../README.md)
