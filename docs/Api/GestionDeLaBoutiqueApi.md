# Hraph\PaygreenApi\GestionDeLaBoutiqueApi

All URIs are relative to https://paygreen.fr.

Method | HTTP request | Description
------------- | ------------- | -------------
[**apiIdentifiantShopGet()**](GestionDeLaBoutiqueApi.md#apiIdentifiantShopGet) | **GET** /api/{identifiant}/shop | Afficher la boutique
[**apiIdentifiantShopPatch()**](GestionDeLaBoutiqueApi.md#apiIdentifiantShopPatch) | **PATCH** /api/{identifiant}/shop | Création et activation d&#39;un compte
[**apiIdentifiantShopPost()**](GestionDeLaBoutiqueApi.md#apiIdentifiantShopPost) | **POST** /api/{identifiant}/shop | Multi-boutiques : création d&#39;une boutique
[**apiIdentifiantShopPut()**](GestionDeLaBoutiqueApi.md#apiIdentifiantShopPut) | **PUT** /api/{identifiant}/shop | Mettre à jour la boutique
[**apiIdentifiantShopShopIdGet()**](GestionDeLaBoutiqueApi.md#apiIdentifiantShopShopIdGet) | **GET** /api/{identifiant}/shop/{shopId} | Multi-boutiques : afficher une boutique
[**apiIdentifiantShopShopIdPut()**](GestionDeLaBoutiqueApi.md#apiIdentifiantShopShopIdPut) | **PUT** /api/{identifiant}/shop/{shopId} | Multi-boutiques : mettre à jour une boutique


## `apiIdentifiantShopGet()`

```php
apiIdentifiantShopGet($identifiant, $authorization): \Hraph\PaygreenApi\Model\InlineResponse2002
```

Afficher la boutique

Cette méthode permet de récupérer la configuration de la boutique (*boutique principale dans le cas du **Multi-boutiques***).

### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');



$apiInstance = new Hraph\PaygreenApi\Api\GestionDeLaBoutiqueApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client()
);
$identifiant = 'identifiant_example'; // string | Votre identifiant PayGreen
$authorization = 'authorization_example'; // string | Votre clé privée PayGreen (Bearer : votre-clé-privée)

try {
    $result = $apiInstance->apiIdentifiantShopGet($identifiant, $authorization);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling GestionDeLaBoutiqueApi->apiIdentifiantShopGet: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

Name | Type | Description  | Notes
------------- | ------------- | ------------- | -------------
 **identifiant** | **string**| Votre identifiant PayGreen |
 **authorization** | **string**| Votre clé privée PayGreen (Bearer : votre-clé-privée) |

### Return type

[**\Hraph\PaygreenApi\Model\InlineResponse2002**](../Model/InlineResponse2002.md)

### Authorization

No authorization required

### HTTP request headers

- **Content-Type**: Not defined
- **Accept**: `application/json`

[[Back to top]](#) [[Back to API list]](../../README.md#endpoints)
[[Back to Model list]](../../README.md#models)
[[Back to README]](../../README.md)

## `apiIdentifiantShopPatch()`

```php
apiIdentifiantShopPatch($identifiant, $authorization, $shop_patch): \Hraph\PaygreenApi\Model\InlineResponse2002
```

Création et activation d'un compte

Cette méthode a deux actions&nbsp;:<br /> 1. Faire une demande de création d'un compte chez l'un de nos **partenaires bancaires** (liés aux **moyens de paiement** souhaités). Pour demander la création du compte, il vous suffit de passer le paramètre `validate` à `true`. Sinon, laissez ce paramètre à `false`.<br /> 2. Passer la boutique **en production** ou **en test**&nbsp;: le paramètre `activate` permet, s'il est égal à `true`, de passer la boutique en production, ce qui permet au e-commerce d'encaisser les paiements des consommateurs. S'il est égal à `false`, la boutique passera en mode test, auquel cas il n'y aura que des transactions fictives sur le e-commerce (il s'agit du mode à choisir lors de l'intégration de PayGreen). Pas défaut, une boutique est toujours en **mode test**.

### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');



$apiInstance = new Hraph\PaygreenApi\Api\GestionDeLaBoutiqueApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client()
);
$identifiant = 'identifiant_example'; // string | Votre identifiant PayGreen
$authorization = 'authorization_example'; // string | Votre clé privée PayGreen (Bearer : votre-clé-privée)
$shop_patch = new \Hraph\PaygreenApi\Model\ShopPatch(); // \Hraph\PaygreenApi\Model\ShopPatch | - `\"validate\" = true` permet de demander la création du compte de la boutique chez notre partenaire bancaire&nbsp;;<br /> - `\"activate\" = true` permet de passer la boutique en mode production.

try {
    $result = $apiInstance->apiIdentifiantShopPatch($identifiant, $authorization, $shop_patch);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling GestionDeLaBoutiqueApi->apiIdentifiantShopPatch: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

Name | Type | Description  | Notes
------------- | ------------- | ------------- | -------------
 **identifiant** | **string**| Votre identifiant PayGreen |
 **authorization** | **string**| Votre clé privée PayGreen (Bearer : votre-clé-privée) |
 **shop_patch** | [**\Hraph\PaygreenApi\Model\ShopPatch**](../Model/ShopPatch.md)| - &#x60;\&quot;validate\&quot; &#x3D; true&#x60; permet de demander la création du compte de la boutique chez notre partenaire bancaire&amp;nbsp;;&lt;br /&gt; - &#x60;\&quot;activate\&quot; &#x3D; true&#x60; permet de passer la boutique en mode production. |

### Return type

[**\Hraph\PaygreenApi\Model\InlineResponse2002**](../Model/InlineResponse2002.md)

### Authorization

No authorization required

### HTTP request headers

- **Content-Type**: `application/json`
- **Accept**: `application/json`

[[Back to top]](#) [[Back to API list]](../../README.md#endpoints)
[[Back to Model list]](../../README.md#models)
[[Back to README]](../../README.md)

## `apiIdentifiantShopPost()`

```php
apiIdentifiantShopPost($identifiant, $authorization, $shop): \Hraph\PaygreenApi\Model\InlineResponse2002
```

Multi-boutiques : création d'une boutique

Cette méthode permet de créer une nouvelle boutique. La création de la boutique se fait à partir des informations présentes dans l'exemple.<br /> <br /> > **Méthode *Multi-boutiques*&nbsp;:** le multi-boutiques est une option liée aux **MarketPlaces**. Si vous intégrez PayGreen pour un **CMS** ou directement sur un site e-commerce, il est donc inutile de vous intéresser à cette méthode.

### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');



$apiInstance = new Hraph\PaygreenApi\Api\GestionDeLaBoutiqueApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client()
);
$identifiant = 'identifiant_example'; // string | Votre identifiant PayGreen
$authorization = 'authorization_example'; // string | Votre clé privée PayGreen (Bearer : votre-clé-privée)
$shop = new \Hraph\PaygreenApi\Model\Shop(); // \Hraph\PaygreenApi\Model\Shop | Modèle de données d'une boutique

try {
    $result = $apiInstance->apiIdentifiantShopPost($identifiant, $authorization, $shop);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling GestionDeLaBoutiqueApi->apiIdentifiantShopPost: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

Name | Type | Description  | Notes
------------- | ------------- | ------------- | -------------
 **identifiant** | **string**| Votre identifiant PayGreen |
 **authorization** | **string**| Votre clé privée PayGreen (Bearer : votre-clé-privée) |
 **shop** | [**\Hraph\PaygreenApi\Model\Shop**](../Model/Shop.md)| Modèle de données d&#39;une boutique |

### Return type

[**\Hraph\PaygreenApi\Model\InlineResponse2002**](../Model/InlineResponse2002.md)

### Authorization

No authorization required

### HTTP request headers

- **Content-Type**: `application/json`
- **Accept**: `application/json`

[[Back to top]](#) [[Back to API list]](../../README.md#endpoints)
[[Back to Model list]](../../README.md#models)
[[Back to README]](../../README.md)

## `apiIdentifiantShopPut()`

```php
apiIdentifiantShopPut($identifiant, $authorization, $shop): \Hraph\PaygreenApi\Model\InlineResponse2002
```

Mettre à jour la boutique

Cette méthode permet de mettre à jour certaines informations de la boutique (*boutique principale dans le cas du **Multi-boutiques***). Seules les informations présentes dans l'exemple peuvent être modifiées.

### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');



$apiInstance = new Hraph\PaygreenApi\Api\GestionDeLaBoutiqueApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client()
);
$identifiant = 'identifiant_example'; // string | Votre identifiant PayGreen
$authorization = 'authorization_example'; // string | Votre clé privée PayGreen (Bearer : votre-clé-privée)
$shop = new \Hraph\PaygreenApi\Model\Shop(); // \Hraph\PaygreenApi\Model\Shop | Modèle de données d'une boutique

try {
    $result = $apiInstance->apiIdentifiantShopPut($identifiant, $authorization, $shop);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling GestionDeLaBoutiqueApi->apiIdentifiantShopPut: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

Name | Type | Description  | Notes
------------- | ------------- | ------------- | -------------
 **identifiant** | **string**| Votre identifiant PayGreen |
 **authorization** | **string**| Votre clé privée PayGreen (Bearer : votre-clé-privée) |
 **shop** | [**\Hraph\PaygreenApi\Model\Shop**](../Model/Shop.md)| Modèle de données d&#39;une boutique |

### Return type

[**\Hraph\PaygreenApi\Model\InlineResponse2002**](../Model/InlineResponse2002.md)

### Authorization

No authorization required

### HTTP request headers

- **Content-Type**: `application/json`
- **Accept**: `application/json`

[[Back to top]](#) [[Back to API list]](../../README.md#endpoints)
[[Back to Model list]](../../README.md#models)
[[Back to README]](../../README.md)

## `apiIdentifiantShopShopIdGet()`

```php
apiIdentifiantShopShopIdGet($identifiant, $authorization, $shop_id): \Hraph\PaygreenApi\Model\InlineResponse2002
```

Multi-boutiques : afficher une boutique

Cette méthode permet de récupérer la configuration d'une boutique donnée `shopId`.<br /> <br /> > **Méthode *Multi-boutiques*&nbsp;:** le multi-boutiques est une option liée aux **MarketPlaces**. Si vous intégrez PayGreen pour un **CMS** ou directement sur un site e-commerce, il est donc inutile de vous intéresser à cette méthode.

### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');



$apiInstance = new Hraph\PaygreenApi\Api\GestionDeLaBoutiqueApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client()
);
$identifiant = 'identifiant_example'; // string | Votre identifiant PayGreen
$authorization = 'authorization_example'; // string | Votre clé privée PayGreen (Bearer : votre-clé-privée)
$shop_id = 'shop_id_example'; // string | Identifiant unique d'une boutique

try {
    $result = $apiInstance->apiIdentifiantShopShopIdGet($identifiant, $authorization, $shop_id);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling GestionDeLaBoutiqueApi->apiIdentifiantShopShopIdGet: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

Name | Type | Description  | Notes
------------- | ------------- | ------------- | -------------
 **identifiant** | **string**| Votre identifiant PayGreen |
 **authorization** | **string**| Votre clé privée PayGreen (Bearer : votre-clé-privée) |
 **shop_id** | **string**| Identifiant unique d&#39;une boutique |

### Return type

[**\Hraph\PaygreenApi\Model\InlineResponse2002**](../Model/InlineResponse2002.md)

### Authorization

No authorization required

### HTTP request headers

- **Content-Type**: Not defined
- **Accept**: `application/json`

[[Back to top]](#) [[Back to API list]](../../README.md#endpoints)
[[Back to Model list]](../../README.md#models)
[[Back to README]](../../README.md)

## `apiIdentifiantShopShopIdPut()`

```php
apiIdentifiantShopShopIdPut($identifiant, $authorization, $shop_id, $shop): \Hraph\PaygreenApi\Model\InlineResponse2002
```

Multi-boutiques : mettre à jour une boutique

Cette méthode permet de mettre à jour certaines informations d'une boutique donnée `shopId`.<br /> <br /> > **Méthode *Multi-boutiques*&nbsp;:** le multi-boutiques est une option liée aux **MarketPlaces**. Si vous intégrez PayGreen pour un **CMS** ou directement sur un site e-commerce, il est donc inutile de vous intéresser à cette méthode.

### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');



$apiInstance = new Hraph\PaygreenApi\Api\GestionDeLaBoutiqueApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client()
);
$identifiant = 'identifiant_example'; // string | Votre identifiant PayGreen
$authorization = 'authorization_example'; // string | Votre clé privée PayGreen (Bearer : votre-clé-privée)
$shop_id = 'shop_id_example'; // string | Identifiant unique d'une boutique
$shop = new \Hraph\PaygreenApi\Model\Shop(); // \Hraph\PaygreenApi\Model\Shop | Modèle de données d'une boutique

try {
    $result = $apiInstance->apiIdentifiantShopShopIdPut($identifiant, $authorization, $shop_id, $shop);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling GestionDeLaBoutiqueApi->apiIdentifiantShopShopIdPut: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

Name | Type | Description  | Notes
------------- | ------------- | ------------- | -------------
 **identifiant** | **string**| Votre identifiant PayGreen |
 **authorization** | **string**| Votre clé privée PayGreen (Bearer : votre-clé-privée) |
 **shop_id** | **string**| Identifiant unique d&#39;une boutique |
 **shop** | [**\Hraph\PaygreenApi\Model\Shop**](../Model/Shop.md)| Modèle de données d&#39;une boutique |

### Return type

[**\Hraph\PaygreenApi\Model\InlineResponse2002**](../Model/InlineResponse2002.md)

### Authorization

No authorization required

### HTTP request headers

- **Content-Type**: `application/json`
- **Accept**: `application/json`

[[Back to top]](#) [[Back to API list]](../../README.md#endpoints)
[[Back to Model list]](../../README.md#models)
[[Back to README]](../../README.md)
