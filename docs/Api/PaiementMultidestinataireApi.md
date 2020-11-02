# Hraph\PaygreenApi\PaiementMultidestinataireApi

All URIs are relative to *https://paygreen.fr*

Method | HTTP request | Description
------------- | ------------- | -------------
[**apiIdentifiantPayinsMultiCashPost**](PaiementMultidestinataireApi.md#apiIdentifiantPayinsMultiCashPost) | **POST** /api/{identifiant}/payins/multi/cash | Créer un paiement multidestinataires



## apiIdentifiantPayinsMultiCashPost

> \Hraph\PaygreenApi\Model\InlineResponse2008 apiIdentifiantPayinsMultiCashPost($identifiant, $authorization, $payins_multi)

Créer un paiement multidestinataires

Créer un paiement entre plusieurs destinataires. Vous pouvez définir plusieurs destinataires dans le tableau `payments`. Le montant de la transaction doit être en centimes. Pour pouvoir faire des transactions, vous devez vous munir de l'`id` qui vous a été donné lors de votre empreinte de carte et l'utiliser dans le `token` de l'objet `card`.

### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');


$apiInstance = new Hraph\PaygreenApi\Api\PaiementMultidestinataireApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client()
);
$identifiant = 'identifiant_example'; // string | Votre identifiant PayGreen
$authorization = 'authorization_example'; // string | Votre clé privée PayGreen (Bearer : votre-clé-privée)
$payins_multi = new \Hraph\PaygreenApi\Model\PayinsMulti(); // \Hraph\PaygreenApi\Model\PayinsMulti | Modèle d'un paiement multidestinataires

try {
    $result = $apiInstance->apiIdentifiantPayinsMultiCashPost($identifiant, $authorization, $payins_multi);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling PaiementMultidestinataireApi->apiIdentifiantPayinsMultiCashPost: ', $e->getMessage(), PHP_EOL;
}
?>
```

### Parameters


Name | Type | Description  | Notes
------------- | ------------- | ------------- | -------------
 **identifiant** | **string**| Votre identifiant PayGreen |
 **authorization** | **string**| Votre clé privée PayGreen (Bearer : votre-clé-privée) |
 **payins_multi** | [**\Hraph\PaygreenApi\Model\PayinsMulti**](../Model/PayinsMulti.md)| Modèle d&#39;un paiement multidestinataires |

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

