<?php
/**
 * Created by PhpStorm.
 * User: chuangchuangzhang
 * Date: 2017/7/25
 * Time: 11:47
 *
 * Desc: 橱柜清单列表格式
 */
?>
<div class="my-print-data container-fluid">
    <div class="row hidden-print">
        <div class="col-md-12">
            <div class="col-md-6"></div>
            <div class="col-md-6">
                <a class="btn btn-primary" href="<?php echo site_url('chart/print_list/index/read/print?id=' . $Info['opid']);?>" target="_blank"><i class="fa fa-refresh"></i>&nbsp;&nbsp;切换格式</a>
            </div>
        </div>
    </div>
    <div class="page-line row">
        <div class="col-md-offset-2 col-md-8">
            <table class="my-table-condensed table table-bordered table-condensed" >
                <thead>
                <tr>
                    <th colspan="11">橱柜柜体生产制造流程单</th>
                </tr>
                <tr>
                    <th colspan="2">经销商:</th>
                    <th colspan="3"><?php echo $Info['dealer'];?></th>
                    <th colspan="2">图纸号:</th>
                    <th></th>
                    <th>订单号:</th>
                    <th><?php echo $Info['order_product_num'];?></th>
                </tr>
                <tr>
                    <th colspan="2">产品名称:</th>
                    <th colspan="3"><?php echo $Info['product'];?></th>
                    <th colspan="2">要求出厂:</th>
                    <th><?php echo $Info['request_outdate'];?></th>
                    <th>业主:</th>
                    <th><?php echo $Info['owner'];?></th>
                </tr>
                <?php if(!empty($Info['order_product_remark'])){
                    echo <<<END
<tr><th colspan="11">$Info[order_product_remark]</th></tr>
END;
                }?>
                <?php if(!empty($Info['remark'])){
                    echo <<<END
<tr><th colspan="11">$Info[remark]</th></tr>
END;
                }?>
                <tr>
                    <th colspan="11">
                        <?php
                        if(isset($CabinetStruct) && is_array($CabinetStruct) && count($CabinetStruct) > 0){
                            echo <<<END
柜体结构：<span class="my-enhance-1">$CabinetStruct[struct]</span> 
| 地柜结构：<span class="my-enhance-1">$CabinetStruct[dgjg]</span> 
| 地柜前撑：$CabinetStruct[dgqc]
| 地柜后撑：$CabinetStruct[dghc]
| 封边：<span class="my-enhance-1">$CabinetStruct[facefb]</span> 
END;
                        }
                        ?>
                    </th>
                </tr>
                </thead>
            </table>
            <table class="my-table-condensed table table-bordered table-condensed" >
                <tbody>
                <?php
                if(isset($All) && is_array($All) && count($All) > 0){
                    $Html = '';
                    foreach ($All as $key => $value){
                        $OrderProductNum = implode(', ', $value);
                        $Html .= <<<END
<tr><td class="td-sm">$key</td><td >$OrderProductNum</td></tr>
END;
                    }
                    echo $Html;
                }
                ?>
                </tbody>
            </table>
            <?php
            if(isset($Cabinet['Face']) && $Cabinet['Face'] != ''){
                echo <<<END
					<table class="my-table-condensed table table-bordered table-condensed" >
						<tbody>
<tr><td >$Cabinet[Face]</td></tr>
						</tbody>
					</table>
END;
            }
            ?>
            <table class="my-table-condensed table table-bordered table-condensed" >
                <thead>
                <tr>
                    <th rowspan="2">编号</th>
                    <th rowspan="2">板件名称</th>
                    <th colspan="5">开料规格</th>
                    <th rowspan="2">封边</th>
                    <th rowspan="2">颜色</th>
                    <th rowspan="2">备注</th>
                </tr>
                <tr>
                    <th>长</th>
                    <th>宽</th>
                    <th>厚</th>
                    <th>数量</th>
                    <th>面积(m<sup>2</sup>)</th>
                </tr>
                </thead>
                <tbody>
                <?php
                if(isset($Cabinet['List']) && is_array($Cabinet['List']) && count($Cabinet['List']) > 0){
                    $List = $Cabinet['List'];
                    $Html = '';
                    $K = 1;
                    foreach($List as $key => $value){
                        $Html .= <<<END
<tr>
    <td>$K</td>
    <td>$value[plate_name]</td>
    <td>$value[length]</td>
    <td>$value[width]</td>
    <td>$value[thick]</td>
    <td>$value[num]</td>
    <td>$value[area]</td>
    <td>$value[edge]</td>
    <td>$value[good]</td>
    <td>$value[slot]$value[remark]</td>
</tr>
END;
                        $K++;
                    }
                    echo $Html;
                }
                ?>
                </tbody>
            </table>
            <table class="table table-bordered table-condensed" >
                <thead>
                <tr><th colspan="3">统计</th></tr>
                </thead>
                <tbody>
                <?php
                if(isset($Cabinet['Statistic']) && is_array($Cabinet['Statistic']) && count($Cabinet['Statistic']) > 0){
                    $Statistic = $Cabinet['Statistic'];
                    $Html = '';
                    foreach ($Statistic as $key => $value){
                        $Html .= <<<END
<tr><td >{$key}</td><td >$value[amount]</td><td>$value[area]</td></tr>
END;
                    }
                    $Html .= <<<END
<tr><td >合计</td><td >块数:【<span class="my-enhance-3">$Cabinet[Amount]</span>】</td><td>面积:【<span class="my-enhance-3">$Cabinet[Area]</span>】</td></tr>
END;
                    echo $Html;
                }
                if(isset($FourH)){
                    $Html = <<<END
<tr><td >4H合计</td><td >块数:【<span class="my-enhance-3">$FourH[Amount]</span>】</td><td>面积:【<span class="my-enhance-3">$FourH[Area]</span>】</td></tr>
END;
                    echo $Html;
                }
                ?>
                </tbody>
            </table>
            <div>
                开槽:YXC（异型槽用160开槽） 后进19KA、后进19KB（单面通槽） 后进19:（双面通槽）打孔 :A、B（单面孔） C:（双面孔）  ★:（双面加工）
            </div>
        </div>
    </div>
    <?php
    if(isset($Abnormity) && is_array($Abnormity) && count($Abnormity) > 0){
        ?>
        <div class="page-line row">
            <div class="col-md-offset-2 col-md-8" id="printAbnormity">
                <table class="my-table-condensed table table-bordered table-condensed" >
                    <thead>
                    <tr>
                        <th colspan="11">衣柜柜体生产制造流程单-异形单</th>
                    </tr>
                    <tr>
                        <th colspan="2">经销商:</th>
                        <th colspan="3"><?php echo $Info['dealer'];?></th>
                        <th colspan="2">图纸号:</th>
                        <th></th>
                        <th>订单号:</th>
                        <th><?php echo $Info['order_product_num'];?></th>
                    </tr>
                    <tr>
                        <th colspan="2">产品名称:</th>
                        <th colspan="3"><?php echo $Info['product'];?></th>
                        <th colspan="2">要求出厂:</th>
                        <th><?php echo $Info['request_outdate'];?></th>
                        <th>业主:</th>
                        <th><?php echo $Info['owner'];?></th>
                    </tr>
                    <?php if(!empty($Info['order_product_remark'])){
                        echo <<<END
<tr><th colspan="11">$Info[order_product_remark]</th></tr>
END;
                    }?>
                    <?php if(!empty($Info['remark'])){
                        echo <<<END
<tr><th colspan="11">$Info[remark]</th></tr>
END;
                    }?>
                    </thead>
                </table>
                <table class="my-table-condensed table table-bordered table-condensed" >
                    <thead>
                    <tr>
                        <th rowspan="2">编号</th>
                        <th rowspan="2">板件名称</th>
                        <th colspan="5">开料规格</th>
                        <th rowspan="2">封边</th>
                        <th rowspan="2">颜色</th>
                        <th rowspan="2">备注</th>
                    </tr>
                    <tr>
                        <th>长</th>
                        <th>宽</th>
                        <th>厚</th>
                        <th>数量</th>
                        <th>面积(m<sup>2</sup>)</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php
                    if(isset($Abnormity['List']) && is_array($Abnormity['List']) && count($Abnormity['List']) > 0){
                        $List = $Abnormity['List'];
                        $Html = '';
                        $K = 1;
                        foreach($List as $key => $value){
                            $Html .= <<<END
<tr>
    <td>$value[cubicle_name]</td>
    <td>$value[plate_name]</td>
    <td>$value[length]</td>
    <td>$value[width]</td>
    <td>$value[thick]</td>
    <td>$value[num]</td>
    <td>$value[area]</td>
    <td>$value[edge]</td>
    <td>$value[good]</td>
    <td>$value[slot]$value[remark]</td>
</tr>
END;
                            $K++;
                        }
                        echo $Html;
                    }
                    ?>
                    </tbody>
                </table>
                <table class="table table-bordered table-condensed" >
                    <thead>
                    <tr><th colspan="3">统计</th></tr>
                    </thead>
                    <tbody>
                    <?php
                    if(isset($Abnormity['Statistic']) && is_array($Abnormity['Statistic']) && count($Abnormity['Statistic']) > 0){
                        $Statistic = $Abnormity['Statistic'];
                        $Html = '';
                        foreach ($Statistic as $key => $value){
                            $Html .= <<<END
<tr><td >{$key}</td><td >$value[amount]</td><td>$value[area]</td></tr>
END;
                        }
                        $Html .= <<<END
<tr><td >合计</td><td >块数:【<span class="my-enhance-3">$Abnormity[Amount]</span>】</td><td>面积:【<span class="my-enhance-3">$Abnormity[Area]</span>】</td></tr>
END;
                        echo $Html;
                    }
                    ?>
                    </tbody>
                </table>
            </div>
        </div>
    <?php }
    if(isset($Classify) && is_array($Classify) && count($Classify) > 0){
        foreach ($Classify as $ClassifyName => $ClassifyPrintList){
            ?>
            <div class="page-line row">
                <div class="col-md-offset-2 col-md-8" >
                    <table class="my-table-condensed table table-bordered table-condensed" >
                        <thead>
                        <tr>
                            <th colspan="11">衣柜柜体生产制造流程单-<?php echo $ClassifyName;?>清单</th>
                        </tr>
                        <tr>
                            <th colspan="2">经销商:</th>
                            <th colspan="3"><?php echo $Info['dealer'];?></th>
                            <th colspan="2">图纸号:</th>
                            <th></th>
                            <th>订单号:</th>
                            <th><?php echo $Info['order_product_num'];?></th>
                        </tr>
                        <tr>
                            <th colspan="2">产品名称:</th>
                            <th colspan="3"><?php echo $Info['product'];?></th>
                            <th colspan="2">要求出厂:</th>
                            <th><?php echo $Info['request_outdate'];?></th>
                            <th>业主:</th>
                            <th><?php echo $Info['owner'];?></th>
                        </tr>
                        <?php if(!empty($Info['order_product_remark'])){
                            echo <<<END
<tr><th colspan="11">$Info[order_product_remark]</th></tr>
END;
                        }?>
                        <?php if(!empty($Info['remark'])){
                            echo <<<END
<tr><th colspan="11">$Info[remark]</th></tr>
END;
                        }?>
                        </thead>
                    </table>
                    <table class="my-table-condensed table table-bordered table-condensed" >
                        <thead>
                        <tr>
                            <th rowspan="2">编号</th>
                            <th rowspan="2">板件名称</th>
                            <th colspan="5">开料规格</th>
                            <th rowspan="2">封边</th>
                            <th rowspan="2">颜色</th>
                            <th rowspan="2">备注</th>
                        </tr>
                        <tr>
                            <th>长</th>
                            <th>宽</th>
                            <th>厚</th>
                            <th>数量</th>
                            <th>面积(m<sup>2</sup>)</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php
                        if(isset($ClassifyPrintList['List']) && is_array($ClassifyPrintList['List']) && count($ClassifyPrintList['List']) > 0){
                            $List = $ClassifyPrintList['List'];
                            $Html = '';
                            $K = 1;
                            foreach($List as $key => $value){
                                $Html .= <<<END
<tr>
    <td>$value[cubicle_name]</td>
    <td>$value[plate_name]</td>
    <td>$value[length]</td>
    <td>$value[width]</td>
    <td>$value[thick]</td>
    <td>$value[num]</td>
    <td>$value[area]</td>
    <td>$value[edge]</td>
    <td>$value[good]</td>
    <td>$value[slot]$value[remark]</td>
</tr>
END;
                                $K++;
                            }
                            echo $Html;
                        }
                        ?>
                        </tbody>
                    </table>
                    <table class="table table-bordered table-condensed" >
                        <thead>
                        <tr><th colspan="3">统计</th></tr>
                        </thead>
                        <tbody>
                        <?php
                        if(isset($ClassifyPrintList['Statistic']) && is_array($ClassifyPrintList['Statistic']) && count($ClassifyPrintList['Statistic']) > 0){
                            $Statistic = $ClassifyPrintList['Statistic'];
                            $Html = '';
                            foreach ($Statistic as $key => $value){
                                $Html .= <<<END
<tr><td >{$key}</td><td >$value[amount]</td><td>$value[area]</td></tr>
END;
                            }
                            $Html .= <<<END
<tr><td >合计</td><td >块数:【<span class="my-enhance-3">$ClassifyPrintList[Amount]</span>】</td><td>面积:【<span class="my-enhance-3">$ClassifyPrintList[Area]</span>】</td></tr>
END;
                            echo $Html;
                        }
                        ?>
                        </tbody>
                    </table>
                </div>
            </div>
            <?php
        }
    }
    ?>
</div>
</body>
</html>
