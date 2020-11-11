# Hraph\PaygreenApi\GestionDesDocumentsKYCsApi

All URIs are relative to *https://paygreen.fr*

Method | HTTP request | Description
------------- | ------------- | -------------
[**apiIdentifiantDocumentsGet**](GestionDesDocumentsKYCsApi.md#apiIdentifiantDocumentsGet) | **GET** /api/{identifiant}/documents | Liste des documents
[**apiIdentifiantDocumentsIdDelete**](GestionDesDocumentsKYCsApi.md#apiIdentifiantDocumentsIdDelete) | **DELETE** /api/{identifiant}/documents/{id} | Supprimer un document
[**apiIdentifiantDocumentsIdGet**](GestionDesDocumentsKYCsApi.md#apiIdentifiantDocumentsIdGet) | **GET** /api/{identifiant}/documents/{id} | Obtenir un document
[**apiIdentifiantDocumentsPost**](GestionDesDocumentsKYCsApi.md#apiIdentifiantDocumentsPost) | **POST** /api/{identifiant}/documents | Envoyer des documents



## apiIdentifiantDocumentsGet

> \Hraph\PaygreenApi\Model\InlineResponse2009 apiIdentifiantDocumentsGet($identifiant, $authorization)

Liste des documents

Obtenir la liste des documents nécessaires

### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');


$apiInstance = new Hraph\PaygreenApi\Api\GestionDesDocumentsKYCsApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client()
);
$identifiant = 'identifiant_example'; // string | Votre identifiant PayGreen
$authorization = 'authorization_example'; // string | Votre clé privée PayGreen (Bearer : votre-clé-privée)

try {
    $result = $apiInstance->apiIdentifiantDocumentsGet($identifiant, $authorization);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling GestionDesDocumentsKYCsApi->apiIdentifiantDocumentsGet: ', $e->getMessage(), PHP_EOL;
}
?>
```

### Parameters


Name | Type | Description  | Notes
------------- | ------------- | ------------- | -------------
 **identifiant** | **string**| Votre identifiant PayGreen |
 **authorization** | **string**| Votre clé privée PayGreen (Bearer : votre-clé-privée) |

### Return type

[**\Hraph\PaygreenApi\Model\InlineResponse2009**](../Model/InlineResponse2009.md)

### Authorization

No authorization required

### HTTP request headers

- **Content-Type**: Not defined
- **Accept**: application/json

[[Back to top]](#) [[Back to API list]](../../README.md#documentation-for-api-endpoints)
[[Back to Model list]](../../README.md#documentation-for-models)
[[Back to README]](../../README.md)


## apiIdentifiantDocumentsIdDelete

> apiIdentifiantDocumentsIdDelete($identifiant, $authorization, $id)

Supprimer un document

Supprimer un document à partir de son `id`

### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');


$apiInstance = new Hraph\PaygreenApi\Api\GestionDesDocumentsKYCsApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client()
);
$identifiant = 'identifiant_example'; // string | Votre identifiant PayGreen
$authorization = 'authorization_example'; // string | Votre clé privée PayGreen (Bearer : votre-clé-privée)
$id = 'id_example'; // string | ID d'un document

try {
    $apiInstance->apiIdentifiantDocumentsIdDelete($identifiant, $authorization, $id);
} catch (Exception $e) {
    echo 'Exception when calling GestionDesDocumentsKYCsApi->apiIdentifiantDocumentsIdDelete: ', $e->getMessage(), PHP_EOL;
}
?>
```

### Parameters


Name | Type | Description  | Notes
------------- | ------------- | ------------- | -------------
 **identifiant** | **string**| Votre identifiant PayGreen |
 **authorization** | **string**| Votre clé privée PayGreen (Bearer : votre-clé-privée) |
 **id** | **string**| ID d&#39;un document |

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


## apiIdentifiantDocumentsIdGet

> \Hraph\PaygreenApi\Model\InlineResponse20010 apiIdentifiantDocumentsIdGet($identifiant, $authorization, $id)

Obtenir un document

Obtenir plus d'informations sur un document

### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');


$apiInstance = new Hraph\PaygreenApi\Api\GestionDesDocumentsKYCsApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client()
);
$identifiant = 'identifiant_example'; // string | Votre identifiant PayGreen
$authorization = 'authorization_example'; // string | Votre clé privée PayGreen (Bearer : votre-clé-privée)
$id = 'id_example'; // string | ID d'un document

try {
    $result = $apiInstance->apiIdentifiantDocumentsIdGet($identifiant, $authorization, $id);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling GestionDesDocumentsKYCsApi->apiIdentifiantDocumentsIdGet: ', $e->getMessage(), PHP_EOL;
}
?>
```

### Parameters


Name | Type | Description  | Notes
------------- | ------------- | ------------- | -------------
 **identifiant** | **string**| Votre identifiant PayGreen |
 **authorization** | **string**| Votre clé privée PayGreen (Bearer : votre-clé-privée) |
 **id** | **string**| ID d&#39;un document |

### Return type

[**\Hraph\PaygreenApi\Model\InlineResponse20010**](../Model/InlineResponse20010.md)

### Authorization

No authorization required

### HTTP request headers

- **Content-Type**: Not defined
- **Accept**: application/json

[[Back to top]](#) [[Back to API list]](../../README.md#documentation-for-api-endpoints)
[[Back to Model list]](../../README.md#documentation-for-models)
[[Back to README]](../../README.md)


## apiIdentifiantDocumentsPost

> \Hraph\PaygreenApi\Model\InlineResponse20010 apiIdentifiantDocumentsPost($identifiant, $authorization, $content_type)

Envoyer des documents

Permet d'envoyer un ou des document(s) manquant(s). Ici nous utilisons la méthode classique d'un formulaire : envoi des documents en multipart. Vous pouvez retrouver plus d'informations sur cette technique [ici](https://developer.mozilla.org/fr/docs/HTTP/Headers/Content-Type)

### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');


$apiInstance = new Hraph\PaygreenApi\Api\GestionDesDocumentsKYCsApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client()
);
$identifiant = 'identifiant_example'; // string | Votre identifiant PayGreen
$authorization = 'authorization_example'; // string | Votre clé privée PayGreen (Bearer : votre-clé-privée)
$content_type = 'content_type_example'; // string | multipart/form-data; boundary=-------------------------acebdf13572

try {
    $result = $apiInstance->apiIdentifiantDocumentsPost($identifiant, $authorization, $content_type);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling GestionDesDocumentsKYCsApi->apiIdentifiantDocumentsPost: ', $e->getMessage(), PHP_EOL;
}
?>
```

### Parameters


Name | Type | Description  | Notes
------------- | ------------- | ------------- | -------------
 **identifiant** | **string**| Votre identifiant PayGreen |
 **authorization** | **string**| Votre clé privée PayGreen (Bearer : votre-clé-privée) |
 **content_type** | **string**| multipart/form-data; boundary&#x3D;-------------------------acebdf13572 |

### Return type

[**\Hraph\PaygreenApi\Model\InlineResponse20010**](../Model/InlineResponse20010.md)

### Authorization

No authorization required

### HTTP request headers

- **Content-Type**: Not defined
- **Accept**: application/json

[[Back to top]](#) [[Back to API list]](../../README.md#documentation-for-api-endpoints)
[[Back to Model list]](../../README.md#documentation-for-models)
[[Back to README]](../../README.md)

