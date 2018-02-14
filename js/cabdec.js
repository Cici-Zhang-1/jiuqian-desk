var Platesname = new Array();
Platesname['zlb'] = '左立板';
Platesname['ylb'] = '右立板';
Platesname['zqjlbh'] = '左切角立板宽边';
Platesname['zqjlbs'] = '左切角立板深边';
Platesname['yqjlbh'] = '右切角立板宽边';
Platesname['yqjlbs'] = '右切角立板深边';
Platesname['dingb'] = '顶板';
Platesname['dib'] = '底板';
Platesname['beib'] = '背板';
Platesname['ybeib'] = '硬背板';
Platesname['hdgb'] = '活动隔板';
Platesname['gdgb'] = '固定隔板';
Platesname['zjfb'] = '转角柜封板';
Platesname['blt'] = '吊柜背拉条';
Platesname['qc'] = '前撑';
Platesname['hc'] = '后撑';
Platesname['zyb'] = '左板';
Platesname['qhb'] = '前板';
Platesname['zyyb'] = '右板';
Platesname['qhhb'] = '后板';
Platesname['shy'] = '三合一';
Platesname['ld'] = '螺钉';
Platesname['pz'] = '平装';
Platesname['sz'] = '竖装';
Platesname['fzt'] = '防撞条';
Platesname['ts'] = '同色';

var groove = 10; /**背板插槽长度*/

function diaogui(Base){
	var platesarr = {};
	
	var thick = Base['thick']*1; //厚度
    var good = Base['good'];  //颜色, 板材
    var thin = '5'+good.substr(2);
    var facefb = Base['edge']  //正面工艺,防撞条
    var height = Base['height'] == ''?0:parseInt(Base['height']);//高
    var depth = Base['depth'] == ''?0:parseInt(Base['depth']);//深
    var width = Base['width'] == ''?0:parseInt(Base['width']);//宽   
    var num = Base['num'] == ''?0:parseInt(Base['num']);//块
    var zjgsize = Base['size'] == ''?0:parseInt(Base['size']);//转角柜尺寸
    var gbj = parseInt(Base['gbj']);//转角柜活动隔板扣，默认50
    var gbh = Base['gbh'] == undefined?false:Base['gbh'];//隔板有无，活动，固定
    var gbg = Base['gbg'] == undefined?false:Base['gbg'];
    var bb = Base['bb'] == undefined?0:Base['bb'];//背板有无
    var zqjwidth = Base['zqjwidth'] == ''?0:parseInt(Base['zqjwidth']);//左切角宽
    var zqjdepth = Base['zqjdepth'] == ''?0:parseInt(Base['zqjdepth']);//左切角深
    var yqjwidth = Base['yqjwidth'] == ''?0:parseInt(Base['yqjwidth']);//右切角宽
    var yqjdepth = Base['yqjdepth'] == ''?0:parseInt(Base['yqjdepth']);//右切角深
    var wbl = Base['wbl'] == undefined?false:Base['wbl'];  //微波炉
    
	if(facefb == '单孔防撞条' && wbl === false){
		facefb = "正面防撞条";
	}else{
		facefb = '';
	}
	
	if(zqjwidth > 0 && zqjdepth > 0){//左切角，左立板，切角立板
        //左立板
		platesarr['zlb'] = {
			'width':depth-zqjdepth,
			'length' : height,
			'num': num,
			'edge': facefb,
			'good': good
		};
		//切角立板横
		platesarr['zqjlbh'] = {
            'width': zqjwidth,
            'length' : height-thick*2,
            'num': num,
            'good': good
        };
		///切角立板竖
		platesarr['zqjlbs'] = {
            'width':zqjdepth,
            'length' : height-thick*2,
            'num': num,
            'good': good
        };
		if(bb != 0){
			//开背板槽
			platesarr['zqjlbs']['slot'] = height-thick*2;
		}
    }else{
		platesarr['zlb'] = {
            'width':depth,
            'length' : height,
            'num': num,
			'edge': facefb,
            'good': good
        };
		if(bb != 0){
			//开背板槽
            platesarr['zlb']['slot'] = height;
		}
    }
	
    if(yqjwidth > 0 && yqjdepth > 0)
    {
		//右立板
		platesarr['ylb'] = {
            'width':depth-yqjdepth,
            'length' : height,
            'num': num,
            'edge': facefb,
            'good': good
        };
		//切角立板横
		platesarr['yqjlbh'] = {
            'width': yqjwidth,
            'length' : height-thick*2,
            'num': num,
            'good': good
        };
		//切角立板竖
		platesarr['yqjlbs'] = {
            'width': yqjdepth,
            'length' : height-thick*2,
            'num': num,
            'good': good
        };
		if(bb != 0){
			//开背板槽
            platesarr['yqjlbs']['slot'] = height-thick*2;
		}
    }else{
		platesarr['ylb'] = {
            'width': depth,
            'length' : height,
            'num': num,
			'edge': facefb,
            'good': good
        };
		if(bb != 0){
            //开背板槽
            platesarr['ylb']['slot'] = height;
        }
    }
    
	//顶板
	platesarr['dingb'] = {
        'width': depth,
        'length' : width-thick*2,
        'num': num,
        'edge': facefb,
        'good': good
    };
	if(bb != 0){
		platesarr['dingb']['slot'] = width-thick*2;
	}
	
	//底板
	platesarr['dib'] = {
        'length' : width-thick*2,
        'num': num,
        'edge': facefb,
        'good': good
    };
	if(wbl !== false){
		platesarr['dib']['width'] = 400;
		platesarr['dib']['remark'] = '底板捣圆边';
	}else{
		platesarr['dib']['width'] = depth;
	}
	if(bb != 0){
		//底板开槽
	    platesarr['dib']['slot'] = width-thick*2;
	}
	
    //活动隔板
    if(gbh == 'h'){
		platesarr['hdgb'] = {
	        'width': depth-gbj,
	        'length' : width-thick*2-2,
	        'num': num,
	        'good': good
	    };
    }
    //固定隔板
    if(gbg == 'g'){
		platesarr['gdgb'] = {
            'width': depth-25,
            'length' : width-thick*2,
            'num': num,
            'good': good
        };
    }
	// 转角柜开门尺寸
    if(zjgsize > 0){//转角柜封板
        platesarr['zjfb'] = {
            'width': width-zjgsize-thick,
            'length' : height-thick*2,
            'num': num,
            'good': good
        };
    }
	//背拉条
    if(width > 700){
		platesarr['blt'] = {
            //'width': 80,
            'width': 100,       /*小胡要求背拉条改为100*/
            'length' : height-thick*2,
            'num': num,
            'good': good
        };
    }
	
    //背板
    if(bb == 1){
		platesarr['beib'] = {
			'width': height-thick*2+groove,
			'num': num,
			'good': thin
		};
        if(zqjwidth > 0 && zqjdepth > 0 && (yqjwidth == 0 && yqjdepth == 0)){
			//有切角左
            platesarr['beib']['length'] = width-thick*2+groove-zqjwidth;
        }else if(yqjwidth > 0 && yqjdepth > 0 && (zqjwidth == 0 && zqjdepth == 0)){
			//有切角右
            platesarr['beib']['length'] = width-thick*2+groove-yqjwidth;
        }else if(yqjwidth > 0 && yqjdepth > 0 && (zqjwidth > 0 && zqjdepth > 0)){
			//有切角左右都有
            platesarr['beib']['length'] = width-thick*2+groove-yqjwidth-zqjwidth;
        }else if(yqjwidth == 0 && yqjdepth == 0 && (zqjwidth == 0 && zqjdepth == 0)){
			//无切角
            platesarr['beib']['length'] = width-thick*2+groove;
        }
    }
	return platesarr;
};

//地柜分解
function digui(Base)
{
	var platesarr = {};
    
    var thick = Base['thick']*1; //厚度
    var good = Base['good'];  //颜色, 板材
    var thin = '5'+good.substr(2);
    var facefb = Base['edge']  //正面工艺,防撞条
    var dgjg = Base['dgjg'];//地柜结构
    var dgqc = Base['dgqc'];//地柜前撑
    var height = Base['height'] == ''?0:parseInt(Base['height']);//高
    var depth = Base['depth'] == ''?0:parseInt(Base['depth']);//深
    var width = Base['width'] == ''?0:parseInt(Base['width']);//宽   
    var num = Base['num'] == ''?0:parseInt(Base['num']);//块
    var zjgsize = Base['size'] == ''?0:parseInt(Base['size']);//转角柜尺寸
    var gbj = parseInt(Base['gbj']);//转角柜活动隔板扣，默认50
    var gbh = Base['gbh'] == undefined?false:Base['gbh'];//隔板有无，活动，固定
    var gbg = Base['gbg'] == undefined?false:Base['gbg'];
    var bb = Base['bb'] == undefined?0:Base['bb'];//背板有无
    var zqjwidth = Base['zqjwidth'] == ''?0:parseInt(Base['zqjwidth']);//左切角宽
    var zqjdepth = Base['zqjdepth'] == ''?0:parseInt(Base['zqjdepth']);//左切角深
    var yqjwidth = Base['yqjwidth'] == ''?0:parseInt(Base['yqjwidth']);//右切角宽
    var yqjdepth = Base['yqjdepth'] == ''?0:parseInt(Base['yqjdepth']);//右切角深
    var zbl = Base['zbl'] == undefined?false:Base['zbl'];//避炉左，右
    var ybl = Base['ybl'] == undefined?false:Base['ybl'];//避炉左，右
    //功能地柜  tlb[贴铝箔]fsbb[防水板白]fsbh[防水板灰]qpg[气瓶柜]
    var gndg = Base['diguiabnormity'] === undefined?false:Base['diguiabnormity'];
	/*if(Base['tlb'] != undefined){
		gndg = Base['tlb'];
	}else if(Base['fsbb'] != undefined){
		gndg = Base['fsbb'];
	}else if(Base['fsbh'] != undefined){
		gndg = Base['fsbh'];
	}else if(Base['qpg'] != undefined){
		gndg = Base['qpg'];
	}else{
		gndg = false;
	}*/
	
    if(facefb == '单孔防撞条'){
        facefb = "正面防撞条";
    }else{
        facefb = '';
    }
    //立板
    if(dgjg == '旁夹底')//地柜旁夹底
    {
        //立板,宽，长，块
        if(zqjwidth > 0 && zqjdepth > 0){
			//左切角，左立板，切角立板
		    //左立板
			platesarr['zlb'] = {
				'width': depth-zqjdepth,
				'length': height,
				'num': num,
				'edge': facefb,
				'good': good
			};
	        //切角立板横
			platesarr['zqjlbh'] = {
                'width': zqjwidth,
                'length': height-thick,
                'num': num,
                'good': good
            };
	        ///切角立板竖
			platesarr['zqjlbs'] = {
                'width': zqjdepth,
                'length': height-thick,
                'num': num,
                'good': good
            };
	        if(bb != 0){
	            //开背板槽
	            platesarr['zqjlbs']['slot'] = height-thick;
	        }
        }else{
			platesarr['zlb'] = {
                'width': depth,
                'length': height,
                'num': num,
                'edge': facefb,
                'good': good
            };
			if(zbl !== false){
                platesarr['zlb']['remark'] = '左避炉';
            }
			if(bb != 0){
	            //开背板槽
	            platesarr['zlb']['slot'] = height;
	        }
        }
        if(yqjwidth > 0 && yqjdepth > 0){
			//右立板
			platesarr['ylb'] = {
                'width': depth-yqjdepth,
                'length': height,
                'num': num,
                'edge': facefb,
                'good': good
            };
	        //切角立板横
			platesarr['yqjlbh'] = {
                'width': yqjwidth,
                'length': height-thick,
                'num': num,
                'good': good
            };
	        //切角立板竖
			platesarr['yqjlbs'] = {
                'width': yqjdepth,
                'length': height-thick,
                'num': num,
                'good': good
            };
	        if(bb != 0){
	            //开背板槽
	            platesarr['yqjlbs']['slot'] = height-thick;
	        }
        }else{
			platesarr['ylb'] = {
                'width': depth,
                'length': height,
                'num': num,
                'edge': facefb,
                'good': good
            };
			if(ybl !== false){
                platesarr['ylb']['remark'] = '右避炉';
            }
			if(bb != 0){
	            //开背板槽
				platesarr['ylb']['slot'] = height;
	        }
        }
		
		//底板
		platesarr['dib'] = {
            'width': depth,
            'length': width-thick*2,
            'num': num,
            'edge': facefb
        };
        if(1 == gndg){
            //贴铝箔
            platesarr['dib']['remark'] = '贴防水铝箔';
            platesarr['dib']['good'] = good;
        }else if(2 == gndg){
        	//多层板
        	platesarr['dib']['good'] = thick+"多层板";
            //白板
            //platesarr['dib']['good'] = thick+"白色防水板";
        }else if(3 == gndg){
            //灰板
            /*platesarr['dib']['good'] = thick+"灰色防水板";*/
        }else if(4 == gndg){
            //气瓶柜
            platesarr['dib']['remark'] = '底板挖320mm半圆';
            platesarr['dib']['good'] = good;
        }else{
            platesarr['dib']['good'] = good;
        }
        if(bb != 0){
            //有背板的需要开槽
            platesarr['dib']['slot'] = width-thick*2;
        }
    }else{
        if(zqjwidth > 0 && zqjdepth > 0){//左切角，左立板，切角立板
            //左切角，左立板，切角立板
            //左立板
			platesarr['zlb'] = {
                'width': depth-zqjdepth,
                'length': height-thick,
                'num': num,
                'edge': facefb,
                'good': good
            };
            //切角立板横
			platesarr['zqjlbh'] = {
                'width': zqjwidth,
                'length': height-thick,
                'num': num,
                'good': good
            };
            ///切角立板竖
			platesarr['zqjlbs'] = {
                'width': zqjdepth,
                'length': height-thick,
                'num': num,
                'good': good
            };
            if(bb != 0){
                //开背板槽
                platesarr['zqjlbs']['slot'] = height-thick;
            }
        }else{
			platesarr['zlb'] = {
                'width': depth,
                'length': height-thick,
                'num': num,
                'edge': facefb,
                'good': good
            };
			if(zbl !== false){
				platesarr['zlb']['remark'] = '左避炉';
            }
			if(bb != 0){
                //开背板槽
                platesarr['zlb']['slot'] = height-thick;
            }
        }
		if(yqjwidth > 0 && yqjdepth > 0){
            //右立板
			platesarr['ylb'] = {
                'width': depth-yqjdepth,
                'length': height-thick,
                'num': num,
                'edge': facefb,
                'good': good
            };
            //切角立板横
			platesarr['yqjlbh'] = {
                'width': yqjwidth,
                'length': height-thick,
                'num': num,
                'good': good
            };
            //切角立板竖
			platesarr['yqjlbs'] = {
                'width': yqjdepth,
                'length': height-thick,
                'num': num,
                'good': good
            };
            if(bb != 0){
                //开背板槽
                platesarr['yqjlbs']['slot'] = height-thick;
            }
        }else{
			platesarr['ylb'] = {
                'width': depth,
                'length': height-thick,
                'num': num,
                'edge': facefb,
                'good': good
            };
			if(ybl !== false){
                platesarr['ylb']['remark'] = '右避炉';
            }
            if(bb != 0){
                //开背板槽
				platesarr['ylb']['slot'] = height-thick;
            }
        }
        //底板
		platesarr['dib'] = {
            'width': depth,
            'length': width,
            'num': num,
            'edge': facefb
        };
		if(1 == gndg){
            //贴铝箔
            platesarr['dib']['remark'] = '贴防水铝箔';
            platesarr['dib']['good'] = good;
        }else if(2 == gndg){
        	//多层板
        	platesarr['dib']['good'] = thick+"多层板";
            //白板
            /*platesarr['dib']['good'] = thick+"白色防水板";*/
        }else if(3 == gndg){
            //灰板
            /*platesarr['dib']['good'] = thick+"灰色防水板";*/
        }else if(4 == gndg){
            //气瓶柜
            platesarr['dib']['remark'] = '底板挖320mm半圆';
            platesarr['dib']['good'] = good;
        }else{
            platesarr['dib']['good'] = good;
        }
		if(bb != 0){
			//有背板的需要开槽
			platesarr['dib']['slot'] = width;
		}
    }
	
	//活动隔板
    if(gbh == 'h' && gndg == false){
		platesarr['hdgb'] = {
            'width': depth-gbj,
            'length': width-thick*2-2,
            'num': num,
            'good': good
        };
    }
    //固定隔板
    if(gbg == 'g' && gndg == false){
		platesarr['gdgb'] = {
            'width': depth-25,
            'length': width-thick*2,
            'num': num,
            'good': good
        };
    }
    // 转角柜开门尺寸
    if(zjgsize > 0){//转角柜封板
        platesarr['zjfb'] = {
            'width': width-zjgsize-thick,
            'num': num,
            'good': good
        };
		if(dgqc == '平装'){
			platesarr['zjfb']['length'] = height-thick*2;
		}else{
			platesarr['zjfb']['length'] = height-thick-81;
		}
    }
	//连接条,前撑
    if(dgqc != '无'){
    	platesarr['qc'] = {
            //'width': 80, 小胡要求修改后前拉条宽度为70 2017-04-04
            'width': 70,
	        'length': width-thick*2,
	        'num': num,
	        'good': good
	    };
    }
	
    //后撑
	platesarr['hc'] = {
        //'width': 80,   小胡要求修改后称的宽度为100   2016-06-01
        'width': 100,
        'num': num,
        'good': good
    };
	if(zqjwidth > 0 && zqjdepth > 0 && (yqjwidth == 0 && yqjdepth == 0)){
        platesarr['hc']['length'] = width-thick*2-zqjwidth;
		if(bb != 0){
			//platesarr['hc']['slot'] = width-thick*2-zqjwidth;         小胡要求修改背板不开槽    2016:06:01
		}
	}else if(yqjwidth > 0 && yqjdepth > 0 && (zqjwidth == 0 && zqjdepth == 0)){
        platesarr['hc']['length'] = width-thick*2-yqjwidth;
		if(bb != 0){
            //platesarr['hc']['slot'] = width-thick*2-yqjwidth;
        }
	}else if(yqjwidth > 0 && yqjdepth > 0 && (zqjwidth > 0 && zqjdepth > 0)){
        platesarr['hc']['length'] = width-thick*2-yqjwidth-zqjwidth;
		if(bb != 0){
            //platesarr['hc']['slot'] = width-thick*2-yqjwidth-zqjwidth;
        }
	}else if(yqjwidth == 0 && yqjdepth == 0 && (zqjwidth == 0 && zqjdepth == 0)){
        platesarr['hc']['length'] = width-thick*2;
		if(bb != 0){
            //platesarr['hc']['slot'] = width-thick*2;
        }
	}
    //背板
    if(bb == 1){
		platesarr['beib'] = {
	        //'width': height-80-thick+groove,              小胡要求背板宽度直接减80       2016:06:01
            'width': height-80,
	        'num': num,
	        'good': thin
	    };
        if(zqjwidth > 0 && zqjdepth > 0 && (yqjwidth == 0 && yqjdepth == 0)){
            //有切角左
            platesarr['beib']['length'] = width-thick*2+groove-zqjwidth;
        }else if(yqjwidth > 0 && yqjdepth > 0 && (zqjwidth == 0 && zqjdepth == 0)){
            //有切角右
            platesarr['beib']['length'] = width-thick*2+groove-yqjwidth;
        }else if(yqjwidth > 0 && yqjdepth > 0 && (zqjwidth > 0 && zqjdepth > 0)){
            //有切角左右都有
            platesarr['beib']['length'] = width-thick*2+groove-yqjwidth-zqjwidth;
        }else if(yqjwidth == 0 && yqjdepth == 0 && (zqjwidth == 0 && zqjdepth == 0)){
            //无切角
            platesarr['beib']['length'] = width-thick*2+groove;
        }
    }
	return platesarr;
};

//二节滑道屉箱
function ejhd(Base){
    var platesarr = {};
    
    var thick = Base['thick'] == '' ? 0:parseInt(Base['thick']);
    var good = Base['good'];
	var thin = '5'+Base['good'].substr(2);
    var dgjg = Base['dgjg'];//地柜结构
    var height = Base['height'] == '' ? 0:parseInt(Base['height']);//高
    var depth = Base['depth'] == '' ? 0:parseInt(Base['depth']);//深
    var width = Base['width'] == '' ? 0:parseInt(Base['width']);//宽   
    var num = Base['num'] == '' ? 0:parseInt(Base['num']);//块
    var coe_height = 50;//高系数
    var coe_bottom = 22;//底板系数
    if(thick == 18)coe_bottom=26
    var coe_slide_e = 26;//二节滑道屉箱－滑道系数
    var coe_slide_y = 12;//隐藏滑轨屉箱－滑道系数
    
    //左右板
	platesarr['zyb'] = {
		'width': height-coe_height,
		'length': depth,
		'num': num,
		'slot': depth,
		'good': good
	};
	platesarr['zyyb'] = {
        'width': height-coe_height,
        'length': depth,
        'num': num,
        'slot': depth,
        'good': good
    };
    
    //前后板
	platesarr['qhb'] = {
        'width': height-coe_height,
        'length': width-coe_slide_e-thick*2*2,
        'num': num,
        'slot': width-coe_slide_e-thick*2*2,
        'good': good
    };
	
	platesarr['qhhb'] = {
        'width': height-coe_height,
        'length': width-coe_slide_e-thick*2*2,
        'num': num,
        'slot': width-coe_slide_e-thick*2*2,
        'good': good
    };
	
    //抽屉背板
	platesarr['beib'] = {
        'width': width-coe_slide_e-thick*2*2+thick*2-coe_bottom,
        'length': depth-coe_bottom,
        'num': num,
        'good': thin
    };
	return platesarr;    
}

//隐藏滑轨屉箱
function ychg(Base){
    var platesarr = new Array()
    
    var thick = Base['thick'] == '' ? 0:parseInt(Base['thick']);
    var good = Base['good'];
	var thin = '5'+Base['good'].substr(2);
    var dgjg = Base['dgjg'];//地柜结构
    var height = Base['height'] == '' ? 0:parseInt(Base['height']);//高
    var depth = Base['depth'] == '' ? 0:parseInt(Base['depth']);//深
    var width = Base['width'] == '' ? 0:parseInt(Base['width']);//宽   
    var num = Base['num'] == '' ? 0:parseInt(Base['num']);//块
    var coe_height = 50;//高系数
    var coe_bottom = 22;//底板系数
    if(thick == 18)coe_bottom=26
    var coe_slide_e = 26;//二节滑道屉箱－滑道系数
    var coe_slide_y = 12;//隐藏滑轨屉箱－滑道系数
    //左右板
	platesarr['zyb'] = {
        'width': height-coe_height,
        'length': depth,
        'num': num,
        //'slot': depth,
        'good': good
    };
	platesarr['zyyb'] = {
        'width': height-coe_height,
        'length': depth,
        'num': num,
        //'slot': depth,
        'good': good
    };
    //前后板
	platesarr['qhb'] = {
        //'width': height-coe_height-10,小胡要求修改-13 20170625
        'width': height-coe_height-13,
        'length': width-coe_slide_y-thick*2*2,
        'num': num,
        //'slot': width-coe_slide_y-thick*2*2,
        'good': good
    };
	platesarr['qhhb'] = {
        'width': height-coe_height-13,
        //'width': height-coe_height-10,
        'length': width-coe_slide_y-thick*2*2,
        'num': num,
        //'slot': width-coe_slide_y-thick*2*2,
        'good': good
    };
    //抽屉背板
	platesarr['ybeib'] = {
        /*'width': width-coe_slide_y-thick*2*2+thick*2-coe_bottom,
        'length': depth-coe_bottom,*/
        'width': depth-thick*2,
        'length': width-coe_slide_y-thick*2*2,
        'num': num,
        'good': good
    };
    
	return platesarr;    
}