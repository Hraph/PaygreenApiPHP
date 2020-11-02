# Hraph\PaygreenApi\AuthentificationOAuthApi

All URIs are relative to *https://paygreen.fr*

Method | HTTP request | Description
------------- | ------------- | -------------
[**apiAuthAccessTokenPost**](AuthentificationOAuthApi.md#apiAuthAccessTokenPost) | **POST** /api/auth/accessToken | Contrôle OAuth
[**apiAuthAuthorizeGet**](AuthentificationOAuthApi.md#apiAuthAuthorizeGet) | **GET** /api/auth/authorize | Affichage de la page d&#39;authentification PayGreen
[**apiAuthPost**](AuthentificationOAuthApi.md#apiAuthPost) | **POST** /api/auth/ | Création d&#39;un token d&#39;accès au protocole OAuth



## apiAuthAccessTokenPost

> \Hraph\PaygreenApi\Model\InlineResponse2002 apiAuthAccessTokenPost($client_id, $grant_type, $code)

Contrôle OAuth

Cette méthode permet de contrôler le retour après l'authentification OAuth, et permet de **récupérer les données de la boutique** (*voir l'exemple de réponse pour la liste complète des informations retournées*).

### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');


$apiInstance = new Hraph\PaygreenApi\Api\AuthentificationOAuthApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client()
);
$client_id = 'client_id_example'; // string | Variable OAuth contenant `accessPublic`. Exemple&nbsp;: xxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxx
$grant_type = 'grant_type_example'; // string | Variable OAuth contenant la valeur du \"grant type\" OAuth (valeur: authorization_code)
$code = 'code_example'; // string | Variable OAuth contenant le code generate après l'appel authorize OAuth

try {
    $result = $apiInstance->apiAuthAccessTokenPost($client_id, $grant_type, $code);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling AuthentificationOAuthApi->apiAuthAccessTokenPost: ', $e->getMessage(), PHP_EOL;
}
?>
```

### Parameters


Name | Type | Description  | Notes
------------- | ------------- | ------------- | -------------
 **client_id** | **string**| Variable OAuth contenant &#x60;accessPublic&#x60;. Exemple&amp;nbsp;: xxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxx |
 **grant_type** | **string**| Variable OAuth contenant la valeur du \&quot;grant type\&quot; OAuth (valeur: authorization_code) |
 **code** | **string**| Variable OAuth contenant le code generate après l&#39;appel authorize OAuth |

### Return type

[**\Hraph\PaygreenApi\Model\InlineResponse2002**](../Model/InlineResponse2002.md)

### Authorization

No authorization required

### HTTP request headers

- **Content-Type**: Not defined
- **Accept**: application/json

[[Back to top]](#) [[Back to API list]](../../README.md#documentation-for-api-endpoints)
[[Back to Model list]](../../README.md#documentation-for-models)
[[Back to README]](../../README.md)


## apiAuthAuthorizeGet

> \Hraph\PaygreenApi\Model\InlineResponse2001 apiAuthAuthorizeGet($client_id, $redirect_uri, $response_type)

Affichage de la page d'authentification PayGreen

Cette méthode permet d'afficher la page d'authentification PayGreen. Via cette infertace, vos utilisateurs pourront se connecter ou s'inscrire sur PayGreen en utilisant le protocole OAuth&nbsp;: une partie des informations sont pré-remplies grâce aux informations transmises dans la méthode de création d'un token d'accès (détaillée précédemment).

### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');


$apiInstance = new Hraph\PaygreenApi\Api\AuthentificationOAuthApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client()
);
$client_id = 'client_id_example'; // string | Variable OAuth contenant `accessPublic`. Exemple&nbsp;: xxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxx
$redirect_uri = 'redirect_uri_example'; // string | Variable OAuth contenant l'URL de retour une fois l'utilisateur identifié. Par exemple : http://example.com/mon-url-de-retour
$response_type = 'response_type_example'; // string | Variable OAuth concernant le style de réponse. Par exemple : code

try {
    $result = $apiInstance->apiAuthAuthorizeGet($client_id, $redirect_uri, $response_type);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling AuthentificationOAuthApi->apiAuthAuthorizeGet: ', $e->getMessage(), PHP_EOL;
}
?>
```

### Parameters


Name | Type | Description  | Notes
------------- | ------------- | ------------- | -------------
 **client_id** | **string**| Variable OAuth contenant &#x60;accessPublic&#x60;. Exemple&amp;nbsp;: xxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxx |
 **redirect_uri** | **string**| Variable OAuth contenant l&#39;URL de retour une fois l&#39;utilisateur identifié. Par exemple : http://example.com/mon-url-de-retour |
 **response_type** | **string**| Variable OAuth concernant le style de réponse. Par exemple : code |

### Return type

[**\Hraph\PaygreenApi\Model\InlineResponse2001**](../Model/InlineResponse2001.md)

### Authorization

No authorization required

### HTTP request headers

- **Content-Type**: Not defined
- **Accept**: application/json

[[Back to top]](#) [[Back to API list]](../../README.md#documentation-for-api-endpoints)
[[Back to Model list]](../../README.md#documentation-for-models)
[[Back to README]](../../README.md)


## apiAuthPost

> \Hraph\PaygreenApi\Model\InlineResponse200 apiAuthPost($auth_access_token)

Création d'un token d'accès au protocole OAuth

Cette méthode permet de créer un token d'accès au protocole OAuth **PayGreen Connect&nbsp;:** vous recevez dans la réponse les paramètres `accessPublic` et `accessSecret` qui vous seront utiles pour la suite.

### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');


$apiInstance = new Hraph\PaygreenApi\Api\AuthentificationOAuthApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client()
);
$auth_access_token = new \Hraph\PaygreenApi\Model\AuthAccessToken(); // \Hraph\PaygreenApi\Model\AuthAccessToken | Token d'accès OAuth

try {
    $result = $apiInstance->apiAuthPost($auth_access_token);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling AuthentificationOAuthApi->apiAuthPost: ', $e->getMessage(), PHP_EOL;
}
?>
```

### Parameters


Name | Type | Description  | Notes
------------- | ------------- | ------------- | -------------
 **auth_access_token** | [**\Hraph\PaygreenApi\Model\AuthAccessToken**](../Model/AuthAccessToken.md)| Token d&#39;accès OAuth |

### Return type

[**\Hraph\PaygreenApi\Model\InlineResponse200**](../Model/InlineResponse200.md)

### Authorization

No authorization required

### HTTP request headers

- **Content-Type**: application/json
- **Accept**: application/json

[[Back to top]](#) [[Back to API list]](../../README.md#documentation-for-api-endpoints)
[[Back to Model list]](../../README.md#documentation-for-models)
[[Back to README]](../../README.md)

