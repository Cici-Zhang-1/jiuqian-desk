<?php
defined('BASEPATH') OR exit('No direct script access allowed');
/**
 * 2015年11月26日
 * @author Zhangcc
 * @version
 * @des
 */
$config['library/workflow/order'] = array(
    -1 => array(
        'text' => '已出厂'
    ),
    0 => array(
        'text' => '已作废'
    ),
    1 => array(
        'text' => '新建',
        'next' => array('dismantling' => 2, 1 => 3, 2=> 0),
        'act' => '_act'
    ),
    2 => array(
        'text' => '正在拆单',
        'next' => array('dismantling' => 2, 1 => 3, 2=> 0),
        'act' => '_act'
    ),
    3 => array(
        'text' => '等待核价',
        'next' => array(0=>3,1=>4,2=>0,'redismantle'=>2),
        'act' => '_act'
    ),
    4 => array(
        'text' => '等待报价',
        'next' => array(0=>5,1=>6,2=>0,'redismantle'=>2,'recheck' =>3),
        'act' => '_act'
    ),
    5 => array(
        'text' => '打款生产',
        'next' => array(2=>0, 'received' => 6, 'redismantle' => 2,'recheck' =>3),
        'act' => '_act'
    ),
    6 => array(
        'text' => '等待生产',
        'next' => array('producing' => 7, 2=>0, 'redismantle' => 2,'recheck' =>3),
        'act' => '_act'
    ),
    7 => array(
        'text' => '正在生产',
        'next' => array('ining'=>8),
        'act' => '_act'
    ),
    8 => array(
        'text' => '正在入库',
        'next' => array('ining'=>8, 'money' => 9, 'outting' => 10),
        'act' => '_act',
        'trigger' => '_trigger_ined'
    ),
    9 => array(
        'text' => '打款发货',
        'next' => array('received' => 10),
        'act' => '_act'
    ),
    10 => array(
        'text' => '等待发货',
        'next' => array('logistics' => 11, 'outted' => 12),
        'act' => '_act'
    ),
    11 => array(
        'text' => '物流代收',
        'next' => array('received' => -1, 'reoutting' => 10),
        'act' => '_act'
    ),
    12 => array(
        'text' => '已发货',
        'next' => array('deliveried' => -1, 'reoutting' => 10),
        'act' => '_act'
    ),
);
$config['library/workflow/order_product'] = array(
    0 => array(
        'text' => '已作废'
    ),
    1 => array(
        'text' => '未拆单',
        'next' => array(0 => 2, 1=> 3, 2=> 0),
        'act' => '_act'
    ),
    2 => array(
        'text' => '正在拆单',
        'next' => array(0 => 2, 1=> 3, 2=> 0),
        'act' => '_act',
        'trigger' => '_trigger_dismantling'
    ),
    3 => array(
        'text' => '已拆单',
        'next' => array('redismantle' => 2, 'print' => 4, 'optimize' => 4, 'ining' => 5, 2 => 0),
        'act' => '_act',
        'trigger' => '_trigger_dismantled'
    ), 
    4 => array(
        'text' => '正在生产',
        'next' => array(2 => 0, 'print' => 4, 'optimize' => 4, 'ining' => 5),
        'act' => '_act',
        'trigger' => '_trigger_producing'
    ),
    5 => array(
        'text' => '正在入库',
        'next' => array(2 => 0, 'ining' => 5),
        'act' => '_act',
        'trigger' => '_trigger_ining'
    )
);
$config['library/wokflow/order_product_board'] = array(
    0 => array(
        'text' => '作废'
    ),
    1 => array(
        'text' => '未优化',
        'next' => '0,2',
        'act' => '_act_optimize'
    ),
    2 => array(
        'text' => '已优化',
        'next' => '1',
        'trigger' => '_trigger_optimized'
    )
);