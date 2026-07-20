<?php

return [

    'site_name' => '十八桥社区支持者门户',

    'links' => [
        [
            'title' => '社区论坛',
            'url'   => 'https://bridge18.qzz.io',
            'desc'  => '参与讨论，了解更多社区动态。',
            'icon'  => '💬',
        ],
        [
            'title' => '千万桥',
            'url'   => 'https://millions.bridge18.qzz.io',
            'desc'  => '加入千万桥 Matrix 聊天室。',
            'icon'  => '🔗',
        ],
        [
            'title' => '爱发电',
            'url'   => 'https://afdian.com/a/Diamochang',
            'desc'  => '支持我们的创作与运营。',
            'icon'  => '❤️',
        ],
        [
            'title' => 'Codeberg',
            'url'   => 'https://codeberg.org/bridgeeighteen',
            'desc'  => '查看我们的开源项目。',
            'icon'  => '📦',
        ],
    ],

    'allowed_card_types' => ['02', '08'],

    'card_type_labels' => [
        '02' => 'NTAG21x',
        '08' => 'T1T',
    ],

];
