<?php
defined('BASEPATH') OR exit('No direct script access allowed');
/**
 * 2015年12月9日
 * @author Zhangcc
 * @version
 * @des
 */
 /*财务账号*/
$config['finance/account_model/select_account'] = array(
        'fa_id' => 'faid',
        'fa_name' => 'name',
        'fa_host' => 'host',
        'fa_account' => 'account',
        'fa_balance' => 'balance',
        'fa_in' => 'in',
        'fa_in_fee' => 'in_fee',
        'fa_out' => 'out',
        'fa_out_fee' => 'out_fee',
        'fa_fee' => 'fee',
        'fa_fee_max' => 'fee_max',
        'fa_intime' => 'intime'
);

$config['finance/account_model/select_account_name'] = array(
    'fa_id' => 'faid',
    'fa_name' => 'name',
    'fa_fee' => 'fee',
    'fa_fee_max' => 'fee_max'
);

$config['finance/account_model/select_intime'] = array(
    'fa_id' => 'faid',
    'fa_name' => 'name',
    'fa_fee' => 'fee',
    'fa_fee_max' => 'fee_max'
);

$config['finance/account_model/select_outtime'] = array(
    'fa_id' => 'faid',
    'fa_name' => 'name',
    'fa_fee' => 'fee',
    'fa_fee_max' => 'fee_max'
);
/**
 * 财务进账
 */
$config['finance/finance_pay_model/select'] = array(
    'fp_id' => 'fpid',
    'a.fa_id' => 'faid',
    'a.fa_name' => 'name',
    'b.fa_id' => 'in_faid',
    'b.fa_name' => 'in_name',
    'fp_type' => 'type',
    'fp_amount' => 'amount',
    'fp_fee' => 'fee',
    'fp_bank_date' => 'bank_date',
    'fp_supplier' => 'supplier',
    'fp_supplier_id' => 'supplier_id',
    'u_truename' => 'creator',
    'fp_create_datetime' => 'create_datetime',
    'fp_remark' => 'remark'
);

$config['finance/finance_pay_model/is_valid_finance_pay'] = array(
    'fp_id' => 'fpid',
    'fa_id' => 'faid',
    'fa_name' => 'name',
    'fp_in_finance_account_id' => 'in_faid',
    'fp_amount' => 'amount',
    'fp_fee' => 'fee',
    'fp_remark' => 'remark',
    'fp_status' => 'status',
    'fp_type' => 'type'
);
/*财务进账*/
    
$config['finance/finance_received_model/select'] = array(
    'fr_id' => 'frid',
    'fa_id' => 'faid',
    'fa_name' => 'name',
    'fr_type' => 'type',
    'fr_cargo_no' => 'cargo_no',
    'fr_amount' => 'amount',
    'fr_fee' => 'fee',
    'fr_dealer_id' => 'did',
    'fr_dealer' => 'dealer',
    'fr_corresponding' => 'corresponding',
    'fr_bank_date' => 'bank_date',
    'u_truename' => 'creator',
    'fr_create_datetime' => 'create_datetime',
    'fr_remark' => 'remark'
);

$config['finance/finance_received_model/select_outtime'] = array(
    'fr_id' => 'frid',
    'fa_id' => 'faid',
    'fa_name' => 'name',
    'fr_type' => 'type',
    'fr_cargo_no' => 'cargo_no',
    'fr_amount' => 'amount',
    'fr_fee' => 'fee',
    'fr_dealer_id' => 'did',
    'fr_dealer' => 'dealer',
    'fr_corresponding' => 'corresponding',
    'fr_bank_date' => 'bank_date',
    'u_truename' => 'creator',
    'fr_create_datetime' => 'create_datetime',
    'fr_remark' => 'remark'
);

$config['finance/finance_received_model/select_for_debt'] = array(
    'fr_id' => 'frid',
    'fa_name' => 'name',
    'fr_amount' => 'amount',
    'fr_corresponding' => 'corresponding',
    'fr_create_datetime' => 'create_datetime',
    'fr_remark' => 'remark'
);

$config['finance/finance_received_model/is_valid_finance_received'] = array(
    'fr_id' => 'frid',
    'fa_id' => 'faid',
    'fa_name' => 'name',
    'fr_cargo_no' => 'cargo_no',
    'fr_dealer_id' => 'did',
    'fr_dealer' => 'dealer',
    'fr_amount' => 'amount',
    'fr_corresponding' => 'corresponding',
    'fr_fee' => 'fee',
    'fr_remark' => 'remark',
    'fr_status' => 'status'
);

$config['finance/income_pay_model/select'] = array(
    'ip_id' => 'ipid',
    'ip_type' => 'type',
    'ip_name' => 'name'
);