<?php

namespace SabyApi;

class Constants
{
    public const SALE_POINTS = 'point/list';

    public const NOMECLATURE_PRICE_LIST = 'nomenclature/price-list';

    public const NOMECLATURE_PRODUCT_LIST = 'nomenclature/list';

    public const NOMECLATURE_STOP_LIST = 'nomenclature/stop-list';

    public const CREATE_ORDER = 'order/create';

    public const GET_ORDER_INFO = 'order/{externalId}';

    public const CANCEL_ORDER = 'order/{externalId}/cancel';

    public const GET_ORDER_STATUS = 'order/{externalId}/state';

    public const GET_PAYMENT_LINK = 'order/{externalId}/payment-link';
}
