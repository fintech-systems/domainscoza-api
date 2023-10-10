<?php

use FintechSystems\DomainsCoza\DomainsCoza as DomainsCozaApi;
use FintechSystems\DomainsCoza\Facades\DomainsCoza;
use Illuminate\Support\Facades\Http;

it('can test', function () {
    expect(true)->toBeTrue();
});

// Check phpunit.xml.dist which has to have the exact env setting https://api.domains.co.za/api
it('can read the environment', function () {
    expect(env('DOMAINSCOZA_URL'))->toBeString();
});

it('can call the API without a Facade', function () {
    $domainsCoza = new DomainsCozaApi(
        [
            'url' => env('DOMAINSCOZA_URL'),
            'username' => env('DOMAINSCOZA_USERNAME'),
            'password' => env('DOMAINSCOZA_PASSWORD'),
        ]
    );

    ray($result = $domainsCoza->echoPhrase('Howzit!'))->green();

    expect('Howzit!')->toBe($result);
});

it('can call the API with a Facade', function () {
    ray($result = DomainsCoza::echoPhrase('Howzit again!'))->green();

    expect('Howzit again!')->toBe($result);
});

it('can log in to the API and retrieve a bearer token', function () {
    Http::fake([
        'https://api.domains.co.za/api/login' => Http::response([
            'intReturnCode' => 1,
            'strUUID' => 'foo',
            'strMessage' => 'Successful',
            'token' => 'bar',
            'strApiHost' => 'bas',
        ]),
    ]);

    DomainsCoza::login();

    expect('bar')->toBe(DomainsCoza::token());
});

it('can retrieve a list of domains', function () {
    Http::fake([
        'https://api.domains.co.za/api/login' => Http::response([
            'intReturnCode' => 1,
            'strUUID' => 'foo',
            'strMessage' => 'Successful',
            'token' => 'bar',
            'strApiHost' => 'bas',
        ]),
    ]);

    DomainsCoza::login();

    Http::fake([
        'https://api.domains.co.za/api/domain/list' => Http::response([
            'intReturnCode' => 1,
            'strUUID' => 'foo',
            'strMessage' => 'Successful',
            'arrDomains' => [
                0 => [
                    'strDomainName' => 'bar.example.co.za',
                    'contactName' => 'Eugene van der Merwe',
                    'strContactID' => 'bar',
                    'status' => 'ok',
                    'eppStatus' => 'ok',
                    'strDns' => 0,
                    'createdDate' => 1622189848,
                    'expiryDate' => 1685261848,
                    'suspendDate' => 1685693848,
                    'redemptionDate' => 1686125848,
                    'deleteDate' => 1687853848,
                    'autorenew' => 0,
                    'externalRef' => null,
                    'nameservers' => [],
                ],
                1 => [
                    'strDomainName' => 'bas.example.co.za',
                    'contactName' => 'Eugene van der Merwe',
                    'strContactID' => 'bas',
                    'status' => 'ok',
                    'eppStatus' => 'ok',
                    'strDns' => 0,
                    'createdDate' => 1622189848,
                    'expiryDate' => 1685261848,
                    'suspendDate' => 1685693848,
                    'redemptionDate' => 1686125848,
                    'deleteDate' => 1687853848,
                    'autorenew' => 0,
                    'externalRef' => null,
                    'nameservers' => [],
                ],
            ],
            'intTotal' => 2,
            'intFilterTotal' => 2,
            'intReturnedTotal' => 2,
            'strApiHost' => 'api-server-01',
        ]),
    ]);

    $result = DomainsCoza::list();

    expect($result)->toHaveKey('intReturnCode', 1);
    expect($result)->toHaveKey('strMessage', 'Successful');
    expect($result)->toHaveKey('arrDomains');
    expect($result)->toHaveKey('intTotal');
});

it('can retrieve an EPP contact', function () {
    Http::fake([
        'https://api.domains.co.za/api/login' => Http::response([
            'intReturnCode' => 1,
            'strUUID' => 'foo',
            'strMessage' => 'Successful',
            'token' => 'bar',
            'strApiHost' => 'bas',
        ]),
    ]);

    DomainsCoza::login();

    Http::fake([
        'https://api.domains.co.za/api/domain*' => Http::response([
            'intReturnCode' => 1,
            'strMessage' => 'Successful',
            'strDomainName' => 'example.com',
            'strEppStatus' => 'ok',
            'arrRegistrant' => [
                'strContactID' => 'foo',
                'strContactName' => 'Eugene van der Merwe',
                'strContactEmail' => 'eugene@example.com',
                'strContactNumber' => 'bar',
                'strContactCompany' => 'Fintech Systems',
                'strContactAddress' => [],
                'strContactCity' => 'Stellenbosch',
                'strContactProvince' => 'Western Cape',
                'strContactPostalCode' => '7600',
                'strContactCountry' => 'ZA',
                'strContactFax' => 'bas',
                'strContactType' => 'registrant',
                'strStatus' => 'pendingUpdate',
                'strVerificationStatus' => 'Unverified',
                'arrPendingUpdate' => [],
            ],
            'arrAdmin' => [],
            'arrTech' => [],
            'arrBilling' => [],
            'autorenew' => 'false',
        ]),
    ]);

    $result = DomainsCoza::info('example', 'com');

    expect($result)->toHaveKey('intReturnCode', 1);
    expect($result)->toHaveKey('strMessage', 'Successful');
    expect($result)->toHaveKey('arrRegistrant');
    expect($result)->toHaveKey('arrAdmin');
    expect($result)->toHaveKey('arrTech');
    expect($result)->toHaveKey('arrBilling');
    expect($result)->toHaveKey('autorenew', 'false');
});
