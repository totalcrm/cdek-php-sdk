<?php

declare(strict_types=1);

namespace TotalCRM\Cdek;

final class Constants
{
    public const string HOOK_TYPE_STATUS = 'ORDER_STATUS';
    public const string HOOK_PRINT_STATUS = 'PRINT_FORM';
    public const string HOOK_TYPE_OTHER = 'ANYTHING_OTHER';

    public const string PRINT_TYPE_BARCODE = 'barcode';
    public const string PRINT_TYPE_INVOICE = 'receipt';

    public const string AUTH_FAIL = 'Authentication is failed, please check your account and secure';

    public const string SERVICE_INSURANCE = 'INSURANCE';
    public const string SERVICE_WEEKEND_DELIVERY = 'DELIV_WEEKEND';
    public const string SERVICE_DANGEROUS_GOODS = 'DANGER_CARGO';
    public const string SERVICE_PICKUP = 'TAKE_SENDER';
    public const string SERVICE_DELIVERY_TO_DOOR = 'DELIV_RECEIVER';
    public const string SERVICE_PACKAGE_1 = 'PACKAGE_1';
    public const string SERVICE_TRY_AT_HOME = 'TRYING_ON';
    public const string SERVICE_PARTIAL_DELIVERY = 'PART_DELIV';
    public const string SERVICE_CARGO_CHECK = 'INSPECTION_CARGO';
    public const string SERVICE_REVERSE = 'REVERSE';

    public const string STATUS_ACCEPTED = 'ACCEPTED';
    public const string STATUS_CREATED = 'CREATED';
    public const string STATUS_DELETED = 'REMOVED';
    public const string STATUS_TAKEIN = 'RECEIVED_AT_SENDER_WAREHOUSE';
    public const string STATUS_READY_FOR_SHIPMENT_IN_SENDER_CITY = 'READY_FOR_SHIPMENT_IN_SENDER_CITY';
    public const string STATUS_RETURNED_TO_SENDER_CITY_WAREHOUSE = 'RETURNED_TO_SENDER_CITY_WAREHOUSE';
    public const string STATUS_TAKEN_BY_TRANSPORTER_FROM_SENDER_CITY = 'TAKEN_BY_TRANSPORTER_FROM_SENDER_CITY';
    public const string STATUS_SENT_TO_TRANSIT_CITY = 'SENT_TO_TRANSIT_CITY';
    public const string STATUS_ACCEPTED_IN_TRANSIT_CITY = 'ACCEPTED_IN_TRANSIT_CITY';
    public const string STATUS_ACCEPTED_AT_TRANSIT_WAREHOUSE = 'ACCEPTED_AT_TRANSIT_WAREHOUSE';
    public const string STATUS_RETURNED_TO_TRANSIT_WAREHOUSE = 'RETURNED_TO_TRANSIT_WAREHOUSE';
    public const string STATUS_READY_FOR_SHIPMENT_IN_TRANSIT_CITY = 'READY_FOR_SHIPMENT_IN_TRANSIT_CITY';
    public const string STATUS_TAKEN_BY_TRANSPORTER_FROM_TRANSIT_CITY = 'TAKEN_BY_TRANSPORTER_FROM_TRANSIT_CITY';
    public const string STATUS_SENT_TO_RECIPIENT_CITY = 'SENT_TO_RECIPIENT_CITY';
    public const string STATUS_ARRIVED_AT_RECIPIENT_CITY = 'ARRIVED_AT_RECIPIENT_CITY';
    public const string STATUS_ACCEPTED_AT_RECIPIENT_CITY_WAREHOUSE = 'ACCEPTED_AT_RECIPIENT_CITY_WAREHOUSE';
    public const string STATUS_ACCEPTED_AT_PICK_UP_POINT = 'ACCEPTED_AT_PICK_UP_POINT';
    public const string STATUS_TAKEN_BY_COURIER = 'TAKEN_BY_COURIER';
    public const string STATUS_RETURNED_TO_RECIPIENT_CITY_WAREHOUSE = 'RETURNED_TO_RECIPIENT_CITY_WAREHOUSE';
    public const string STATUS_DELIVERED = 'DELIVERED';
    public const string STATUS_NOT_DELIVERED = 'NOT_DELIVERED';

    public const string AUTH_PARAM_CREDENTIAL = 'client_credentials';
    public const string AUTH_KEY_TYPE = 'grant_type';
    public const string AUTH_KEY_CLIENT_ID = 'client_id';
    public const string AUTH_KEY_SECRET = 'client_secret';

    public const int CONNECTION_TIMEOUT = 10;

    public const string API_URL = 'https://api.cdek.ru/v2';
    public const string API_URL_TEST = 'https://api.edu.cdek.ru/v2';
    public const string TEST_ACCOUNT = 'EMscd6r9JnFiQ3bLoyjJY6eM78JrJceI';
    public const string TEST_SECURE = 'PjLZkKBHEiLK3YsjtNrt3TGNG0ahs3kG';

    public const string RELATION_RETURN_ORDER = 'return_order';
    public const string RELATION_DIRECT_ORDER = 'direct_order';
    public const string RELATION_INTAKE = 'intake';
    public const string RELATION_RECEIPT = 'receipt';
    public const string RELATION_BARCODE = 'barcode';
    public const string RELATION_DELIVERY = 'delivery';

    public const int MATERIAL_POLYESTER = 1;
    public const int MATERIAL_NYLON = 2;
    public const int MATERIAL_FLEECE = 3;
    public const int MATERIAL_COTTON = 4;
    public const int MATERIAL_TEXTILES = 5;
    public const int MATERIAL_FLAX = 6;
    public const int MATERIAL_VISCOSE = 7;
    public const int MATERIAL_SILK = 8;
    public const int MATERIAL_WOOL = 9;
    public const int MATERIAL_CASHMERE = 10;
    public const int MATERIAL_LEATHER = 11;
    public const int MATERIAL_LEATHERETTE = 12;
    public const int MATERIAL_FAUX_FUR = 13;
    public const int MATERIAL_SUEDE = 14;
    public const int MATERIAL_POLYURETHANE = 15;
    public const int MATERIAL_SPANDEX = 16;
    public const int MATERIAL_RUBBER = 17;
}