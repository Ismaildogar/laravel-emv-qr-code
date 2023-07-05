# Laravel MU QR code

Generate textual representation of merchant presented national QR code for MU based on EMV®1 QR Code Specification for Payment Systems (EMV QRCPS) – Merchant-Presented Mode published by EMVCo.

Note that you need to pass the textual representation to an external QR code generator which is not included in the package.

EMV® is a registered trademark in the U.S. and other countries and an unregistered trademark elsewhere. The EMV trademark is owned by EMVCo, LLC.
QR Code is a registered trademark of DENSO WAVE

## Features
* Validate first and last element of root data object
* Validate convenience fee data objects based on value of Ti Or Convenience Indicator
* Validate data objects based on length and format Numeric (N), Alphanumeric Special (ans), String (S)
* Calculate Cyclic Redundancy Check
* Generate valid textual representation of QR code

## Requirements

* [Composer](https://getcomposer.org/)
* [Laravel 10.x +](http://laravel.com/)

## Installation

You can install this package on an existing Laravel project with using composer:

```bash
 $ composer require aliirfaan/laravel-mu-qr-code
```

Register the ServiceProvider by editing **config/app.php** file and adding to providers array:

```php
  aliirfaan\LaravelMuQrCode\LaravelMuQrCodeProvider::class,
```
## Usage

```php
<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

// import data objects you want to use
use aliirfaan\LaravelMuQrCode\DataObjects\RootDataObject;
use aliirfaan\LaravelMuQrCode\DataObjects\PayloadFormatIndicator;
use aliirfaan\LaravelMuQrCode\DataObjects\PointOfInitiationMethod;
use aliirfaan\LaravelMuQrCode\DataObjects\GloballyUniqueIdentifier;
use aliirfaan\LaravelMuQrCode\DataObjects\PayeeParticipantCode;
use aliirfaan\LaravelMuQrCode\DataObjects\MerchantAccountNumber;
use aliirfaan\LaravelMuQrCode\DataObjects\MerchantId;
use aliirfaan\LaravelMuQrCode\DataObjects\MuMerchantAccountInformation;
use aliirfaan\LaravelMuQrCode\DataObjects\MerchantCategoryCode;
use aliirfaan\LaravelMuQrCode\DataObjects\TransactionCurrency;
use aliirfaan\LaravelMuQrCode\DataObjects\CountryCode;
use aliirfaan\LaravelMuQrCode\DataObjects\MerchantName;
use aliirfaan\LaravelMuQrCode\DataObjects\MerchantCity;
use aliirfaan\LaravelMuQrCode\DataObjects\AdditionalDataFieldTemplate;
use aliirfaan\LaravelMuQrCode\DataObjects\BillNumber;
use aliirfaan\LaravelMuQrCode\DataObjects\ReferenceLabel;
use aliirfaan\LaravelMuQrCode\DataObjects\MobileNumber;
use aliirfaan\LaravelMuQrCode\DataObjects\PurposeOfTransaction;

class TestController extends Controller
{
    public function test(Request $request)
    {
        try {

            // create root data object
            $rootDataObject = new RootDataObject();

            // create more data objects and add to root data object
            $payloadFormatIndicator = new PayloadFormatIndicator();
            $rootDataObject->pushChildDataObject($payloadFormatIndicator);

            $pointOfInitiationMethod = new PointOfInitiationMethod();
            $pointOfInitiationMethod->setValue(11);
            $rootDataObject->pushChildDataObject($pointOfInitiationMethod);

            // MU Merchant Account Information template
            $muMerchantAccountInformation = new MuMerchantAccountInformation();

            // push to template
            $globallyUniqueIdentifier = new GloballyUniqueIdentifier();
            $globallyUniqueIdentifier->setValue('mu.taucas');
            $muMerchantAccountInformation->pushChildDataObject($globallyUniqueIdentifier);

            $payeeParticipantCode = new PayeeParticipantCode();
            $payeeParticipantCode->setValue('MSTDMXMVXXXX');
            $muMerchantAccountInformation->pushChildDataObject($payeeParticipantCode);

            $merchantAccountNumber = new MerchantAccountNumber();
            $merchantAccountNumber->setValue('01234123412');
            $muMerchantAccountInformation->pushChildDataObject($merchantAccountNumber);

            $merchantId = new MerchantId();
            $merchantId->setValue('000000000000050');
            $muMerchantAccountInformation->pushChildDataObject($merchantId);

            // push template to root data object
            $rootDataObject->pushChildDataObject($muMerchantAccountInformation);

            $merchantCategoryCode = new MerchantCategoryCode();
            $merchantCategoryCode->setValue('9222');
            $rootDataObject->pushChildDataObject($merchantCategoryCode);

            $transactionCurrency = new TransactionCurrency();
            $rootDataObject->pushChildDataObject($transactionCurrency);

            $countryCode = new CountryCode();
            $rootDataObject->pushChildDataObject($countryCode);

            $merchantName = new MerchantName();
            $merchantName->setValue('Bank of Lalaland');
            $rootDataObject->pushChildDataObject($merchantName);

            $merchantCity = new MerchantCity();
            $merchantCity->setValue('Portlouis');
            $rootDataObject->pushChildDataObject($merchantCity);

            // additional data field template
            $additionalDataFieldTemplate = new AdditionalDataFieldTemplate();
            $billNumber = new BillNumber();
            $billNumber->setValue('MCQ459789');
            $additionalDataFieldTemplate->pushChildDataObject($billNumber);

            $mobileNumber = new MobileNumber();
            $mobileNumber->setValue('52516315');
            $additionalDataFieldTemplate->pushChildDataObject($mobileNumber);

            $referenceLabel = new ReferenceLabel();
            $referenceLabel->setValue('MOM123');
            $additionalDataFieldTemplate->pushChildDataObject($referenceLabel);

            $purposeOfTransaction = new PurposeOfTransaction();
            $purposeOfTransaction->setValue('Payment of network fees');
            $additionalDataFieldTemplate->pushChildDataObject($purposeOfTransaction);

            $rootDataObject->pushChildDataObject($additionalDataFieldTemplate);

            $generateRootRepresentationResponse = $rootDataObject->generateRootRepresentation();
            dump($generateRootRepresentationResponse);

            // success response
            /*
            array(5) { 
                ["success"]=> bool(true) 
                ["result"]=> string(207) "00020101021126630009mu.taucas0112MSTDMXMVXXXX02110123412341203150000000000000505204922253034805802MU5916Bank of Lalaland6009Portlouis62620109MCQ4597890208525163150506MOM1230823Payment of network fees630492BC" 
                ["errors"]=> NULL 
                ["message"]=> NULL 
                ["issues"]=> array(0) { } 
            } 
            */

            // error response
            /*
            array(5) { 
                ["success"]=> bool(false) 
                ["result"]=> NULL 
                ["errors"]=> bool(true) 
                ["message"]=> NULL 
                ["issues"]=> array(1) { 
                    ["merchant_category_code"]=> array(1) { 
                        ["value"]=> array(1) { 
                            [0]=> string(33) "The value field must be 4 digits." 
                        } 
                    } 
                } 
            } 
            */
            
        } catch (\Exception $e) {
            report($e);
        }
    }
}
```

## License

The MIT License (MIT)

Copyright (c) 2020

Permission is hereby granted, free of charge, to any person obtaining a copy
of this software and associated documentation files (the "Software"), to deal
in the Software without restriction, including without limitation the rights
to use, copy, modify, merge, publish, distribute, sublicense, and/or sell
copies of the Software, and to permit persons to whom the Software is
furnished to do so, subject to the following conditions:

The above copyright notice and this permission notice shall be included in all
copies or substantial portions of the Software.

THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR
IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY,
FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE
AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER
LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM,
OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN THE
SOFTWARE.