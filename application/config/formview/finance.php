<?php
defined('BASEPATH') OR exit('No direct script access allowed');
/**
 * 2015年12月9日
 * @author Zhangcc
 * @version
 * @des
 */
$config['finance/account_model/insert_account'] = array(
    'name' => 'fa_name',
    'account' => 'fa_account',
    'host' => 'fa_host',
    'fee' => 'fa_fee',
    'fee_max' => 'fa_fee_max',
    'in' => 'fa_in',
    'in_fee' => 'fa_in_fee',
    'out' => 'fa_out',
    'out_fee' => 'fa_out_fee',
    'intime' => 'fa_intime'
        
);
$config['finance/account_model/update_account'] = array(
    'name' => 'fa_name',
    'account' => 'fa_account',
    'host' => 'fa_host',
    'fee' => 'fa_fee',
    'fee_max' => 'fa_fee_max',
    'in' => 'fa_in',
    'in_fee' => 'fa_in_fee',
    'out' => 'fa_out',
    'out_fee' => 'fa_out_fee',
    'intime' => 'fa_intime',
    'balance' => 'fa_balance'
);

/**
 * 财务支出
 */
$config['finance/finance_pay_model/insert'] = array(
    'faid' => 'fp_finance_account_id',
    'in_faid' => 'fp_in_finance_account_id',
    'supplier_id' => 'fp_supplier_id',
    'supplier' => 'fp_supplier',
    'amount' => 'fp_amount',
    'type' => 'fp_type',
    'fee' => 'fp_fee',
    'remark' => 'fp_remark',
    'bank_date' => 'fp_bank_date',
    'creator' => 'fp_creator',
    'create_datetime' => 'fp_create_datetime'
);
$config['finance/finance_pay_model/insert_batch'] = array(
    'faid' => 'fp_finance_account_id',
    'amount' => 'fp_amount',
    'type' => 'fp_type',
    'fee' => 'fp_fee',
    'remark' => 'fp_remark',
    'bank_date' => 'fp_bank_date',
    'creator' => 'fp_creator',
    'create_datetime' => 'fp_create_datetime'
);

$config['finance/finance_pay_model/update'] = array(
    'faid' => 'fp_finance_account_id',
    'in_faid' => 'fp_in_finance_account_id',
    'supplier_id' => 'fp_supplier_id',
    'supplier' => 'fp_supplier',
    'amount' => 'fp_amount',
    'type' => 'fp_type',
    'fee' => 'fp_fee',
    'remark' => 'fp_remark',
    'bank_date' => 'fp_bank_date'
);
/*财务进账清单*/
$config['finance/finance_received_model/insert'] = array(
        'faid' => 'fr_finance_account_id',
        'amount' => 'fr_amount',
        'fee' => 'fr_fee',
        'cargo_no' => 'fr_cargo_no',
        'remark' => 'fr_remark',
        'bank_date' => 'fr_bank_date',
        'creator' => 'fr_creator',
        'create_datetime' => 'fr_create_datetime'
);

$config['finance/finance_received_model/insert_outtime'] = array(
    'faid' => 'fr_finance_account_id',
    'amount' => 'fr_amount',
    'fee' => 'fr_fee',
    'cargo_no' => 'fr_cargo_no',
    'remark' => 'fr_remark',
    'bank_date' => 'fr_bank_date',
    'creator' => 'fr_creator',
    'create_datetime' => 'fr_create_datetime',
    'type' => 'fr_type',
    'did' => 'fr_dealer_id',
    'dealer' => 'fr_dealer',
    'corresponding' => 'fr_Corresponding',
    'status' => 'fr_status'
);

$config['finance/finance_received_model/update'] = array(
    'faid' => 'fr_finance_account_id',
    'amount' => 'fr_amount',
    'fee' => 'fr_fee',
    'cargo_no' => 'fr_cargo_no',
    'remark' => 'fr_remark',
    'bank_date' => 'fr_bank_date'
);

$config['finance/finance_received_model/update_outtime'] = array(
    'fee' => 'fr_fee'
);

$config['finance/finance_received_model/update_finance_received_pointer'] = array(
    'type' => 'fr_type',
    'did' => 'fr_dealer_id',
    'dealer' => 'fr_dealer',
    'corresponding' => 'fr_corresponding',
    'remark' => 'fr_remark'
);


$config['finance/income_pay_model/insert'] = array(
    'type' => 'ip_type',
    'name' => 'ip_name'
);

$config['finance/income_pay_model/update'] = array(
    'type' => 'ip_type',
    'name' => 'ip_name'
);