# Paygreen.io API for PHP
PHP SDK for Paygreen.io payment provider

Specications for Paygreen.io API are available [here](https://paygreen.fr/documentation/api-documentation-categorie?cat=all)

## Requirements

PHP 5.5 and later

## Installation & Usage

### Composer

To install via [Composer](http://getcomposer.org/):

Run `composer require hraph/paygreen-api-php`

### Manual Installation

Download the files and include `autoload.php`:

```php
    require_once('/path/to/paygreen-api-php/vendor/autoload.php');
```

## Tests

To run the unit tests:

```bash
composer install
./vendor/bin/phpunit
```

## Getting Started

Please follow the [installation procedure](#installation--usage) and then run the following:

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

## Documentation for API Endpoints

All URIs are relative to *https://paygreen.fr*

Class | Method | HTTP request | Description
------------ | ------------- | ------------- | -------------
*AuthentificationOAuthApi* | [**apiAuthAccessTokenPost**](docs/Api/AuthentificationOAuthApi.md#apiauthaccesstokenpost) | **POST** /api/auth/accessToken | Contrôle OAuth
*AuthentificationOAuthApi* | [**apiAuthAuthorizeGet**](docs/Api/AuthentificationOAuthApi.md#apiauthauthorizeget) | **GET** /api/auth/authorize | Affichage de la page d&#39;authentification PayGreen
*AuthentificationOAuthApi* | [**apiAuthPost**](docs/Api/AuthentificationOAuthApi.md#apiauthpost) | **POST** /api/auth/ | Création d&#39;un token d&#39;accès au protocole OAuth
*GestionDeLaBoutiqueApi* | [**apiIdentifiantShopGet**](docs/Api/GestionDeLaBoutiqueApi.md#apiidentifiantshopget) | **GET** /api/{identifiant}/shop | Afficher la boutique
*GestionDeLaBoutiqueApi* | [**apiIdentifiantShopPatch**](docs/Api/GestionDeLaBoutiqueApi.md#apiidentifiantshoppatch) | **PATCH** /api/{identifiant}/shop | Création et activation d&#39;un compte
*GestionDeLaBoutiqueApi* | [**apiIdentifiantShopPost**](docs/Api/GestionDeLaBoutiqueApi.md#apiidentifiantshoppost) | **POST** /api/{identifiant}/shop | Multi-boutiques : création d&#39;une boutique
*GestionDeLaBoutiqueApi* | [**apiIdentifiantShopPut**](docs/Api/GestionDeLaBoutiqueApi.md#apiidentifiantshopput) | **PUT** /api/{identifiant}/shop | Mettre à jour la boutique
*GestionDeLaBoutiqueApi* | [**apiIdentifiantShopShopIdGet**](docs/Api/GestionDeLaBoutiqueApi.md#apiidentifiantshopshopidget) | **GET** /api/{identifiant}/shop/{shopId} | Multi-boutiques : afficher une boutique
*GestionDeLaBoutiqueApi* | [**apiIdentifiantShopShopIdPut**](docs/Api/GestionDeLaBoutiqueApi.md#apiidentifiantshopshopidput) | **PUT** /api/{identifiant}/shop/{shopId} | Multi-boutiques : mettre à jour une boutique
*GestionDeLadresseApi* | [**apiIdentifiantAddressGet**](docs/Api/GestionDeLadresseApi.md#apiidentifiantaddressget) | **GET** /api/{identifiant}/address | Liste des adresses
*GestionDeLadresseApi* | [**apiIdentifiantAddressPost**](docs/Api/GestionDeLadresseApi.md#apiidentifiantaddresspost) | **POST** /api/{identifiant}/address | Créer une adresse
*GestionDeMesBoutiquesApi* | [**apiIdentifiantShopsGet**](docs/Api/GestionDeMesBoutiquesApi.md#apiidentifiantshopsget) | **GET** /api/{identifiant}/shops | Liste des boutiques
*GestionDeMesRIBApi* | [**apiIdentifiantBankGet**](docs/Api/GestionDeMesRIBApi.md#apiidentifiantbankget) | **GET** /api/{identifiant}/bank | Afficher mon RIB
*GestionDeMesRIBApi* | [**apiIdentifiantBankPost**](docs/Api/GestionDeMesRIBApi.md#apiidentifiantbankpost) | **POST** /api/{identifiant}/bank | Création d&#39;un RIB
*GestionDesDocumentsKYCsApi* | [**apiIdentifiantDocumentsGet**](docs/Api/GestionDesDocumentsKYCsApi.md#apiidentifiantdocumentsget) | **GET** /api/{identifiant}/documents | Liste des documents
*GestionDesDocumentsKYCsApi* | [**apiIdentifiantDocumentsIdDelete**](docs/Api/GestionDesDocumentsKYCsApi.md#apiidentifiantdocumentsiddelete) | **DELETE** /api/{identifiant}/documents/{id} | Supprimer un document
*GestionDesDocumentsKYCsApi* | [**apiIdentifiantDocumentsIdGet**](docs/Api/GestionDesDocumentsKYCsApi.md#apiidentifiantdocumentsidget) | **GET** /api/{identifiant}/documents/{id} | Obtenir un document
*GestionDesDocumentsKYCsApi* | [**apiIdentifiantDocumentsPost**](docs/Api/GestionDesDocumentsKYCsApi.md#apiidentifiantdocumentspost) | **POST** /api/{identifiant}/documents | Envoyer des documents
*GestionDesPropritairesApi* | [**apiIdentifiantShareholderGet**](docs/Api/GestionDesPropritairesApi.md#apiidentifiantshareholderget) | **GET** /api/{identifiant}/shareholder | Liste des propriétaires
*GestionDesPropritairesApi* | [**apiIdentifiantShareholderPost**](docs/Api/GestionDesPropritairesApi.md#apiidentifiantshareholderpost) | **POST** /api/{identifiant}/shareholder | Créer un propriétaire
*GestionDuComptePrincipalApi* | [**apiIdentifiantAccountGet**](docs/Api/GestionDuComptePrincipalApi.md#apiidentifiantaccountget) | **GET** /api/{identifiant}/account | Afficher le compte principal
*GestionDuComptePrincipalApi* | [**apiIdentifiantAccountPut**](docs/Api/GestionDuComptePrincipalApi.md#apiidentifiantaccountput) | **PUT** /api/{identifiant}/account | Met à jour le compte principal
*GestionDuneAssociationApi* | [**apiIdentifiantSolidarityGet**](docs/Api/GestionDuneAssociationApi.md#apiidentifiantsolidarityget) | **GET** /api/{identifiant}/solidarity | Liste des associations
*LempreinteDeCarteApi* | [**apiIdentifiantPayinsCardprintGet**](docs/Api/LempreinteDeCarteApi.md#apiidentifiantpayinscardprintget) | **GET** /api/{identifiant}/payins/cardprint | Liste des empreintes de carte
*LempreinteDeCarteApi* | [**apiIdentifiantPayinsCardprintIdDelete**](docs/Api/LempreinteDeCarteApi.md#apiidentifiantpayinscardprintiddelete) | **DELETE** /api/{identifiant}/payins/cardprint/{id} | Supprimer une empreinte
*LempreinteDeCarteApi* | [**apiIdentifiantPayinsCardprintIdGet**](docs/Api/LempreinteDeCarteApi.md#apiidentifiantpayinscardprintidget) | **GET** /api/{identifiant}/payins/cardprint/{id} | Détails
*LempreinteDeCarteApi* | [**apiIdentifiantPayinsCardprintPost**](docs/Api/LempreinteDeCarteApi.md#apiidentifiantpayinscardprintpost) | **POST** /api/{identifiant}/payins/cardprint | Création d&#39;une empreinte de carte
*LesDonsApi* | [**apiIdentifiantSolidarityIdDelete**](docs/Api/LesDonsApi.md#apiidentifiantsolidarityiddelete) | **DELETE** /api/{identifiant}/solidarity/{id} | Supprimer un don
*LesDonsApi* | [**apiIdentifiantSolidarityIdGet**](docs/Api/LesDonsApi.md#apiidentifiantsolidarityidget) | **GET** /api/{identifiant}/solidarity/{id} | Afficher un don
*LesDonsApi* | [**apiIdentifiantSolidarityIdPatch**](docs/Api/LesDonsApi.md#apiidentifiantsolidarityidpatch) | **PATCH** /api/{identifiant}/solidarity/{id} | Créer un don
*LesMoyensDePaiementApi* | [**apiIdentifiantPaymenttypeGet**](docs/Api/LesMoyensDePaiementApi.md#apiidentifiantpaymenttypeget) | **GET** /api/{identifiant}/paymenttype | Liste des moyens de paiement
*LesTransactionsApi* | [**apiIdentifiantPayinsTransactionCancelPost**](docs/Api/LesTransactionsApi.md#apiidentifiantpayinstransactioncancelpost) | **POST** /api/{identifiant}/payins/transaction/cancel | Annulation
*LesTransactionsApi* | [**apiIdentifiantPayinsTransactionCashPost**](docs/Api/LesTransactionsApi.md#apiidentifiantpayinstransactioncashpost) | **POST** /api/{identifiant}/payins/transaction/cash | Paiement comptant
*LesTransactionsApi* | [**apiIdentifiantPayinsTransactionIdDelete**](docs/Api/LesTransactionsApi.md#apiidentifiantpayinstransactioniddelete) | **DELETE** /api/{identifiant}/payins/transaction/{id} | Remboursement
*LesTransactionsApi* | [**apiIdentifiantPayinsTransactionIdGet**](docs/Api/LesTransactionsApi.md#apiidentifiantpayinstransactionidget) | **GET** /api/{identifiant}/payins/transaction/{id} | Détails
*LesTransactionsApi* | [**apiIdentifiantPayinsTransactionIdPatch**](docs/Api/LesTransactionsApi.md#apiidentifiantpayinstransactionidpatch) | **PATCH** /api/{identifiant}/payins/transaction/{id} | Modification du montant
*LesTransactionsApi* | [**apiIdentifiantPayinsTransactionIdPut**](docs/Api/LesTransactionsApi.md#apiidentifiantpayinstransactionidput) | **PUT** /api/{identifiant}/payins/transaction/{id} | Confirmer une transaction
*LesTransactionsApi* | [**apiIdentifiantPayinsTransactionSubscriptionPost**](docs/Api/LesTransactionsApi.md#apiidentifiantpayinstransactionsubscriptionpost) | **POST** /api/{identifiant}/payins/transaction/subscription | Paiement abonnement
*LesTransactionsApi* | [**apiIdentifiantPayinsTransactionTokenizePost**](docs/Api/LesTransactionsApi.md#apiidentifiantpayinstransactiontokenizepost) | **POST** /api/{identifiant}/payins/transaction/tokenize | Paiement avec confirmation
*LesTransactionsApi* | [**apiIdentifiantPayinsTransactionXtimePost**](docs/Api/LesTransactionsApi.md#apiidentifiantpayinstransactionxtimepost) | **POST** /api/{identifiant}/payins/transaction/xtime | Paiement en plusieurs fois
*LesVirementsApi* | [**apiIdentifiantPayoutTransferGet**](docs/Api/LesVirementsApi.md#apiidentifiantpayouttransferget) | **GET** /api/{identifiant}/payout/transfer | Liste des virements
*LesVirementsApi* | [**apiIdentifiantPayoutTransferIdGet**](docs/Api/LesVirementsApi.md#apiidentifiantpayouttransferidget) | **GET** /api/{identifiant}/payout/transfer/{id} | Détails
*LesVirementsApi* | [**apiIdentifiantPayoutTransferPost**](docs/Api/LesVirementsApi.md#apiidentifiantpayouttransferpost) | **POST** /api/{identifiant}/payout/transfer | Créer un virement
*PaiementMultidestinataireApi* | [**apiIdentifiantPayinsMultiCashPost**](docs/Api/PaiementMultidestinataireApi.md#apiidentifiantpayinsmulticashpost) | **POST** /api/{identifiant}/payins/multi/cash | Créer un paiement multidestinataires
*RechercheApi* | [**apiIdentifiantPayinsSearchGet**](docs/Api/RechercheApi.md#apiidentifiantpayinssearchget) | **GET** /api/{identifiant}/payins/search | Liste des transactions
*RechercheApi* | [**apiIdentifiantPayinsSearchIdGet**](docs/Api/RechercheApi.md#apiidentifiantpayinssearchidget) | **GET** /api/{identifiant}/payins/search/{id} | Plus d&#39;informations


## Documentation For Models

 - [Account](docs/Model/Account.md)
 - [Address](docs/Model/Address.md)
 - [Association](docs/Model/Association.md)
 - [AuthAccessToken](docs/Model/AuthAccessToken.md)
 - [CardPrint](docs/Model/CardPrint.md)
 - [ExecuteTransaction](docs/Model/ExecuteTransaction.md)
 - [InlineResponse200](docs/Model/InlineResponse200.md)
 - [InlineResponse2001](docs/Model/InlineResponse2001.md)
 - [InlineResponse20010](docs/Model/InlineResponse20010.md)
 - [InlineResponse20011](docs/Model/InlineResponse20011.md)
 - [InlineResponse20012](docs/Model/InlineResponse20012.md)
 - [InlineResponse20013](docs/Model/InlineResponse20013.md)
 - [InlineResponse2002](docs/Model/InlineResponse2002.md)
 - [InlineResponse2003](docs/Model/InlineResponse2003.md)
 - [InlineResponse2004](docs/Model/InlineResponse2004.md)
 - [InlineResponse2005](docs/Model/InlineResponse2005.md)
 - [InlineResponse2006](docs/Model/InlineResponse2006.md)
 - [InlineResponse2007](docs/Model/InlineResponse2007.md)
 - [InlineResponse2008](docs/Model/InlineResponse2008.md)
 - [InlineResponse2009](docs/Model/InlineResponse2009.md)
 - [Kyc](docs/Model/Kyc.md)
 - [PartnerConfig](docs/Model/PartnerConfig.md)
 - [PatchAmount](docs/Model/PatchAmount.md)
 - [Payins](docs/Model/Payins.md)
 - [PayinsBuyer](docs/Model/PayinsBuyer.md)
 - [PayinsCard](docs/Model/PayinsCard.md)
 - [PayinsMulti](docs/Model/PayinsMulti.md)
 - [PayinsRecc](docs/Model/PayinsRecc.md)
 - [PayinsReccOrderDetails](docs/Model/PayinsReccOrderDetails.md)
 - [Rib](docs/Model/Rib.md)
 - [Shareholder](docs/Model/Shareholder.md)
 - [Shop](docs/Model/Shop.md)
 - [ShopPatch](docs/Model/ShopPatch.md)
 - [ShopWithVad](docs/Model/ShopWithVad.md)
 - [Solidarity](docs/Model/Solidarity.md)
 - [Transaction](docs/Model/Transaction.md)
 - [TransactionBuyer](docs/Model/TransactionBuyer.md)
 - [TransactionCard](docs/Model/TransactionCard.md)
 - [TransactionDonation](docs/Model/TransactionDonation.md)
 - [TransactionResult](docs/Model/TransactionResult.md)
 - [TransactionSchedules](docs/Model/TransactionSchedules.md)
 - [Transfer](docs/Model/Transfer.md)
