# Hraph\PaygreenApi\LesMoyensDePaiementApi

All URIs are relative to *https://paygreen.fr*

Method | HTTP request | Description
------------- | ------------- | -------------
[**apiIdentifiantPaymenttypeGet**](LesMoyensDePaiementApi.md#apiIdentifiantPaymenttypeGet) | **GET** /api/{identifiant}/paymenttype | Liste des moyens de paiement



## apiIdentifiantPaymenttypeGet

> \Hraph\PaygreenApi\Model\InlineResponse20011 apiIdentifiantPaymenttypeGet($identifiant, $authorization)

Liste des moyens de paiement

Cette méthode permet de lister les moyens de paiement disponibles pour votre boutique.<br /> <br /> Notez que cette méthode ne retourne que les moyens de paiement activés&nbsp;: le `status` est donc toujours de `\"2\"`.<br /> Le champ `data` est alors un tableau de moyens de paiement à parcourir.<br /> <br /> Vous avez la possibilité d'affiner cette liste en ajoutant dans l'URL les deux paramètres suivants (optionnels)&nbsp;:<br /> - Affichage d'un seul type de moyen de paiement avec le paramètre `paymentType`&nbsp;: par exemple, `paymentType=CB` permettra de ne retourner que la liste des moyens de paiement **CB/Visa/Mastercard**.<br /> - Affichage des moyens de paiement par devise avec le paramètre `currency`&nbsp; par exemple, `currency=EUR` permet de ne retourner que les moyens de paiement permettant de régler en **euros**.

### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');


$apiInstance = new Hraph\PaygreenApi\Api\LesMoyensDePaiementApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client()
);
$identifiant = 'identifiant_example'; // string | Votre identifiant PayGreen
$authorization = 'authorization_example'; // string | Votre clé privée PayGreen (Bearer : votre-clé-privée)

try {
    $result = $apiInstance->apiIdentifiantPaymenttypeGet($identifiant, $authorization);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling LesMoyensDePaiementApi->apiIdentifiantPaymenttypeGet: ', $e->getMessage(), PHP_EOL;
}
?>
```

### Parameters


Name | Type | Description  | Notes
------------- | ------------- | ------------- | -------------
 **identifiant** | **string**| Votre identifiant PayGreen |
 **authorization** | **string**| Votre clé privée PayGreen (Bearer : votre-clé-privée) |

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

