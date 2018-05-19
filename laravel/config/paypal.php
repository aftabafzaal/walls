<?php
return [
    'express'=>[
        'client_id'=>'AQeVjlBE6rXT5tHOLWQYH8KN_z253Nr3EmBZViW_xnI3rJgP3UDaQmiCoFBt3iKsf8gA4itnEy5HKZqH',
        'secret'=>'EFEm0vTYvA-DuDX0MbMz3j6SsfjniOFt3K_efk7JDXlUDpIYAsepfyDO8-bBJpiZpuHDH60Z0kBbHso3',
        'success'=>'Payments\PaypalController@success',
        'cancel'=>'Payments\PaypalController@cancel',
        'config'=>
        [
            'mode' => 'sandbox',
            'service.EndPoint' => 'https://api.sandbox.paypal.com',
            'http.ConnectionTimeOut' => 30,
            'log.LogEnabled' => true,
            'log.FileName' => storage_path('logs/paypal.log'),
            'log.LogLevel' => 'FINE'
        ]
    ]
];