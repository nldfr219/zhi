CREATE TABLE archives (
   code int(11) DEFAULT '0' NOT NULL auto_increment,
   annee int(11) DEFAULT '0' NOT NULL,
   mois int(11) DEFAULT '0' NOT NULL,
   vpm int(11) DEFAULT '0' NOT NULL,
   topVis blob NOT NULL,
   topNavOS blob NOT NULL,
   topOS blob NOT NULL,
   topNav blob NOT NULL,
   vph blob NOT NULL,
   topRef blob NOT NULL,
   topDom blob NOT NULL,
   vpj blob NOT NULL,
   PRIMARY KEY (code),
   KEY annee (annee),
   KEY mois (mois)
);

CREATE TABLE counter (
   num int not null,
   today int not null,
   time int not null
);
insert into counter(num,today,time) values(0,0,0);

CREATE TABLE useronline (
   zeit int(15) NOT NULL,
   ip varchar(15) NOT NULL,
   PRIMARY KEY (zeit),
   KEY ip (ip)
);

CREATE TABLE visiteurs (
   AGENT char(100),
   REFERER char(200),
   ADDR char(50) NOT NULL,
   DATE char(20),
   HOST char(100),
   CODE int(11) DEFAULT '0' NOT NULL auto_increment,
   REF_HOST char(100),
   PRIMARY KEY (CODE),
   KEY ADDR (ADDR)
);

CREATE TABLE domaines (
   code int(11) DEFAULT '0' NOT NULL auto_increment,
   domaine char(20) NOT NULL,
   description char(50) NOT NULL,
   PRIMARY KEY (code)
);

INSERT INTO domaines VALUES( '1', 'ac', '基督岛');
INSERT INTO domaines VALUES( '2', 'ad', '安道尔');
INSERT INTO domaines VALUES( '3', 'ae', '阿联酋');
INSERT INTO domaines VALUES( '4', 'af', '阿富汗');
INSERT INTO domaines VALUES( '5', 'ag', '安提瓜和巴布达');
INSERT INTO domaines VALUES( '6', 'ai', '安圭拉');
INSERT INTO domaines VALUES( '7', 'al', '阿尔巴尼亚');
INSERT INTO domaines VALUES( '8', 'am', '亚美尼亚');
INSERT INTO domaines VALUES( '9', 'an', '安的列斯');
INSERT INTO domaines VALUES( '10', 'ao', '安哥拉');
INSERT INTO domaines VALUES( '11', 'aq', '南极洲');
INSERT INTO domaines VALUES( '12', 'ar', '阿根廷');
INSERT INTO domaines VALUES( '13', 'as', '东萨摩亚');
INSERT INTO domaines VALUES( '14', 'au', '澳大利亚');
INSERT INTO domaines VALUES( '15', 'aw', '阿鲁巴');
INSERT INTO domaines VALUES( '16', 'az', '阿塞拜疆');
INSERT INTO domaines VALUES( '17', 'ba', '波黑');
INSERT INTO domaines VALUES( '18', 'bb', '巴巴多斯');
INSERT INTO domaines VALUES( '19', 'bd', '孟加拉国');
INSERT INTO domaines VALUES( '20', 'be', '比利时');
INSERT INTO domaines VALUES( '21', 'bf', '布基纳法索');
INSERT INTO domaines VALUES( '22', 'bg', '保加利亚');
INSERT INTO domaines VALUES( '23', 'bh', '巴林');
INSERT INTO domaines VALUES( '24', 'bi', '布隆迪');
INSERT INTO domaines VALUES( '25', 'bj', '贝宁');
INSERT INTO domaines VALUES( '26', 'bm', '百慕大群岛');
INSERT INTO domaines VALUES( '27', 'bn', '文莱达鲁萨兰国');
INSERT INTO domaines VALUES( '28', 'bo', '玻利维亚');
INSERT INTO domaines VALUES( '29', 'br', '巴西');
INSERT INTO domaines VALUES( '30', 'bs', '巴哈马');
INSERT INTO domaines VALUES( '31', 'bt', '不丹');
INSERT INTO domaines VALUES( '32', 'bv', '布韦群岛');
INSERT INTO domaines VALUES( '33', 'bw', '伯兹瓦纳');
INSERT INTO domaines VALUES( '34', 'by', '白俄罗斯');
INSERT INTO domaines VALUES( '35', 'bz', '伯利兹');
INSERT INTO domaines VALUES( '36', 'ca', '加拿大');
INSERT INTO domaines VALUES( '37', 'cc', '科科斯群岛');
INSERT INTO domaines VALUES( '38', 'cd', '刚果民主人民共和国');
INSERT INTO domaines VALUES( '39', 'cf', '中非共和国');
INSERT INTO domaines VALUES( '40', 'cg', '刚果');
INSERT INTO domaines VALUES( '41', 'ch', '瑞士');
INSERT INTO domaines VALUES( '42', 'ci', '象牙海岸');
INSERT INTO domaines VALUES( '43', 'ck', '库克群岛');
INSERT INTO domaines VALUES( '44', 'cl', '智利');
INSERT INTO domaines VALUES( '45', 'cm', '喀麦隆');
INSERT INTO domaines VALUES( '46', 'cn', '中国');
INSERT INTO domaines VALUES( '47', 'co', '哥伦比亚');
INSERT INTO domaines VALUES( '48', 'cr', '哥斯达黎加');
INSERT INTO domaines VALUES( '49', 'cu', '古巴');
INSERT INTO domaines VALUES( '50', 'cv', '佛得角');
INSERT INTO domaines VALUES( '51', 'cx', '圣诞岛');
INSERT INTO domaines VALUES( '52', 'cy', '塞浦路斯');
INSERT INTO domaines VALUES( '53', 'cz', '捷克共和国');
INSERT INTO domaines VALUES( '54', 'de', '德国');
INSERT INTO domaines VALUES( '55', 'dj', '吉布提');
INSERT INTO domaines VALUES( '56', 'dk', '丹麦');
INSERT INTO domaines VALUES( '57', 'dm', '多米尼加岛');
INSERT INTO domaines VALUES( '58', 'do', '多米尼加共和国');
INSERT INTO domaines VALUES( '59', 'dz', '阿尔及利亚');
INSERT INTO domaines VALUES( '60', 'ec', '厄瓜多尔');
INSERT INTO domaines VALUES( '61', 'ee', '爱沙尼亚');
INSERT INTO domaines VALUES( '62', 'eg', '埃及');
INSERT INTO domaines VALUES( '63', 'eh', '西萨摩亚');
INSERT INTO domaines VALUES( '64', 'er', '厄立特里亚');
INSERT INTO domaines VALUES( '65', 'es', '西班牙');
INSERT INTO domaines VALUES( '66', 'et', '埃塞俄比亚');
INSERT INTO domaines VALUES( '67', 'fi', '芬兰');
INSERT INTO domaines VALUES( '68', 'fj', '斐济');
INSERT INTO domaines VALUES( '69', 'fk', '福克兰群岛');
INSERT INTO domaines VALUES( '70', 'fm', '密克罗尼西亚');
INSERT INTO domaines VALUES( '71', 'fo', '法罗群岛');
INSERT INTO domaines VALUES( '72', 'fr', '法国');
INSERT INTO domaines VALUES( '73', 'ga', '加蓬');
INSERT INTO domaines VALUES( '74', 'gd', '格林纳达');
INSERT INTO domaines VALUES( '75', 'ge', '格鲁吉亚');
INSERT INTO domaines VALUES( '76', 'gf', '法属圭亚那');
INSERT INTO domaines VALUES( '77', 'gg', '根西岛');
INSERT INTO domaines VALUES( '78', 'gh', '加纳');
INSERT INTO domaines VALUES( '79', 'gi', '直布罗陀');
INSERT INTO domaines VALUES( '80', 'gl', '格陵兰群岛');
INSERT INTO domaines VALUES( '81', 'gm', '冈比亚');
INSERT INTO domaines VALUES( '82', 'gn', '几内亚');
INSERT INTO domaines VALUES( '83', 'gp', '瓜德罗普岛');
INSERT INTO domaines VALUES( '84', 'gq', '赤道几内亚');
INSERT INTO domaines VALUES( '85', 'gr', '希腊');
INSERT INTO domaines VALUES( '86', 'gs', '南乔治亚和南桑威治岛');
INSERT INTO domaines VALUES( '87', 'gt', '危地马拉');
INSERT INTO domaines VALUES( '88', 'gu', '关岛');
INSERT INTO domaines VALUES( '89', 'gw', '几内亚比绍');
INSERT INTO domaines VALUES( '90', 'gy', '圭亚那');
INSERT INTO domaines VALUES( '91', 'hk', '香港');
INSERT INTO domaines VALUES( '92', 'hm', 'Heard 和 McDonald 岛');
INSERT INTO domaines VALUES( '93', 'hn', '洪都拉斯');
INSERT INTO domaines VALUES( '94', 'hr', '克罗蒂亚');
INSERT INTO domaines VALUES( '95', 'ht', '海地');
INSERT INTO domaines VALUES( '96', 'hu', '匈牙利');
INSERT INTO domaines VALUES( '97', 'id', '印度尼西亚');
INSERT INTO domaines VALUES( '98', 'ie', '爱尔兰共和国');
INSERT INTO domaines VALUES( '99', 'il', '以色列');
INSERT INTO domaines VALUES( '100', 'im', '男人岛');
INSERT INTO domaines VALUES( '101', 'in', '印度');
INSERT INTO domaines VALUES( '102', 'io', '英属印度洋领地');
INSERT INTO domaines VALUES( '103', 'iq', '伊拉克');
INSERT INTO domaines VALUES( '104', 'ir', '伊朗');
INSERT INTO domaines VALUES( '105', 'is', '冰岛');
INSERT INTO domaines VALUES( '106', 'it', '意大利');
INSERT INTO domaines VALUES( '107', 'je', '泽西岛');
INSERT INTO domaines VALUES( '108', 'jm', '牙买加');
INSERT INTO domaines VALUES( '109', 'jo', '约旦');
INSERT INTO domaines VALUES( '110', 'jp', '日本');
INSERT INTO domaines VALUES( '111', 'ke', '肯尼亚');
INSERT INTO domaines VALUES( '112', 'kg', '吉尔吉斯斯坦');
INSERT INTO domaines VALUES( '113', 'kh', '柬埔塞');
INSERT INTO domaines VALUES( '114', 'ki', '基里巴斯');
INSERT INTO domaines VALUES( '115', 'km', '科摩罗');
INSERT INTO domaines VALUES( '116', 'kn', '圣基茨和尼维斯');
INSERT INTO domaines VALUES( '117', 'kp', '北朝鲜');
INSERT INTO domaines VALUES( '118', 'kr', '南朝鲜');
INSERT INTO domaines VALUES( '119', 'kw', '科威特');
INSERT INTO domaines VALUES( '120', 'ky', '开曼群岛');
INSERT INTO domaines VALUES( '121', 'kz', '哈萨克斯坦');
INSERT INTO domaines VALUES( '122', 'la', '老挝人民共和国');
INSERT INTO domaines VALUES( '123', 'lb', '黎巴嫩');
INSERT INTO domaines VALUES( '124', 'lc', '圣露西亚岛');
INSERT INTO domaines VALUES( '125', 'li', '列支敦士登');
INSERT INTO domaines VALUES( '126', 'lk', '斯里兰卡');
INSERT INTO domaines VALUES( '127', 'lr', '利比里亚');
INSERT INTO domaines VALUES( '128', 'ls', '莱索托');
INSERT INTO domaines VALUES( '129', 'lt', '立陶宛');
INSERT INTO domaines VALUES( '130', 'lu', '卢森堡');
INSERT INTO domaines VALUES( '131', 'lv', '拉脱维亚');
INSERT INTO domaines VALUES( '132', 'ly', '利比亚');
INSERT INTO domaines VALUES( '133', 'ma', '摩洛哥');
INSERT INTO domaines VALUES( '134', 'mc', '摩纳哥');
INSERT INTO domaines VALUES( '135', 'md', '摩尔多瓦');
INSERT INTO domaines VALUES( '136', 'mg', '马达加斯加');
INSERT INTO domaines VALUES( '137', 'mh', '马绍尔群岛');
INSERT INTO domaines VALUES( '138', 'mk', '马其顿,前南斯拉夫共和国');
INSERT INTO domaines VALUES( '139', 'ml', '马里');
INSERT INTO domaines VALUES( '140', 'mm', '缅甸');
INSERT INTO domaines VALUES( '141', 'mn', '蒙古');
INSERT INTO domaines VALUES( '142', 'mo', '澳门');
INSERT INTO domaines VALUES( '143', 'mp', '北马里亚纳群岛');
INSERT INTO domaines VALUES( '144', 'mq', '马提尼克岛');
INSERT INTO domaines VALUES( '145', 'mr', '毛里塔尼亚');
INSERT INTO domaines VALUES( '146', 'ms', '蒙塞拉特岛');
INSERT INTO domaines VALUES( '147', 'mt', '马尔他');
INSERT INTO domaines VALUES( '148', 'mu', '毛里西斯');
INSERT INTO domaines VALUES( '149', 'mv', '马尔代夫');
INSERT INTO domaines VALUES( '150', 'mw', '马拉维');
INSERT INTO domaines VALUES( '151', 'mx', '墨西哥');
INSERT INTO domaines VALUES( '152', 'my', '马来西亚');
INSERT INTO domaines VALUES( '153', 'mz', '莫桑比克');
INSERT INTO domaines VALUES( '154', 'na', '纳米比亚');
INSERT INTO domaines VALUES( '155', 'nc', '新喀里多尼亚');
INSERT INTO domaines VALUES( '156', 'ne', '尼日尔');
INSERT INTO domaines VALUES( '157', 'nf', '诺福克岛');
INSERT INTO domaines VALUES( '158', 'ng', '尼日利亚');
INSERT INTO domaines VALUES( '159', 'ni', '尼加拉瓜');
INSERT INTO domaines VALUES( '160', 'nl', '荷兰');
INSERT INTO domaines VALUES( '161', 'no', '挪威');
INSERT INTO domaines VALUES( '162', 'np', '尼泊尔');
INSERT INTO domaines VALUES( '163', 'nr', '瑙鲁');
INSERT INTO domaines VALUES( '164', 'nu', '纽埃');
INSERT INTO domaines VALUES( '165', 'nz', '新西兰');
INSERT INTO domaines VALUES( '166', 'om', '阿曼');
INSERT INTO domaines VALUES( '167', 'pa', '巴拿马');
INSERT INTO domaines VALUES( '168', 'pe', '秘鲁');
INSERT INTO domaines VALUES( '169', 'pf', '法属玻利尼西亚');
INSERT INTO domaines VALUES( '170', 'pg', '巴布亚新几内亚');
INSERT INTO domaines VALUES( '171', 'ph', '菲律宾');
INSERT INTO domaines VALUES( '172', 'pk', '巴基斯坦');
INSERT INTO domaines VALUES( '173', 'pl', '波兰');
INSERT INTO domaines VALUES( '174', 'pm', '圣皮埃尔和密克隆岛');
INSERT INTO domaines VALUES( '175', 'pn', '皮特克恩岛');
INSERT INTO domaines VALUES( '176', 'pr', '波多黎各');
INSERT INTO domaines VALUES( '177', 'pt', '葡萄牙');
INSERT INTO domaines VALUES( '178', 'pw', '帕劳');
INSERT INTO domaines VALUES( '179', 'py', '巴拉圭');
INSERT INTO domaines VALUES( '180', 'qa', '卡塔尔');
INSERT INTO domaines VALUES( '181', 're', '留尼汪岛');
INSERT INTO domaines VALUES( '182', 'ro', '罗马尼亚');
INSERT INTO domaines VALUES( '183', 'ru', '俄罗斯联邦');
INSERT INTO domaines VALUES( '184', 'rw', '卢旺达');
INSERT INTO domaines VALUES( '185', 'sa', '沙特阿拉伯');
INSERT INTO domaines VALUES( '186', 'sb', '所罗门群岛');
INSERT INTO domaines VALUES( '187', 'sc', '塞舌尔');
INSERT INTO domaines VALUES( '188', 'sd', '苏旦');
INSERT INTO domaines VALUES( '189', 'se', '瑞典');
INSERT INTO domaines VALUES( '190', 'sg', '新加坡');
INSERT INTO domaines VALUES( '191', 'sh', '海伦娜');
INSERT INTO domaines VALUES( '192', 'si', '斯洛文尼亚');
INSERT INTO domaines VALUES( '193', 'sj', '斯瓦尔巴群岛');
INSERT INTO domaines VALUES( '194', 'sk', '斯洛伐克');
INSERT INTO domaines VALUES( '195', 'sl', '塞拉利昂');
INSERT INTO domaines VALUES( '196', 'sm', '圣马力诺');
INSERT INTO domaines VALUES( '197', 'sn', '塞内加尔');
INSERT INTO domaines VALUES( '198', 'so', '索马里');
INSERT INTO domaines VALUES( '199', 'sr', '苏里南');
INSERT INTO domaines VALUES( '200', 'st', '圣多美和普林西比');
INSERT INTO domaines VALUES( '201', 'sv', '萨尔瓦多');
INSERT INTO domaines VALUES( '202', 'sy', '叙利亚');
INSERT INTO domaines VALUES( '203', 'sz', '斯威士兰');
INSERT INTO domaines VALUES( '204', 'tc', '特克斯和凯科斯群岛');
INSERT INTO domaines VALUES( '205', 'td', '乍得');
INSERT INTO domaines VALUES( '206', 'tf', '法属南半球领地');
INSERT INTO domaines VALUES( '207', 'tg', '多哥');
INSERT INTO domaines VALUES( '208', 'th', '泰国');
INSERT INTO domaines VALUES( '209', 'tj', '塔吉克斯坦');
INSERT INTO domaines VALUES( '210', 'tk', '托克劳群岛');
INSERT INTO domaines VALUES( '211', 'tm', '土库曼斯坦');
INSERT INTO domaines VALUES( '212', 'tn', '突尼斯');
INSERT INTO domaines VALUES( '213', 'to', '汤加');
INSERT INTO domaines VALUES( '214', 'tp', '东帝汶');
INSERT INTO domaines VALUES( '215', 'tr', '土耳其');
INSERT INTO domaines VALUES( '216', 'tt', '特立尼达和多巴哥');
INSERT INTO domaines VALUES( '217', 'tv', '图瓦鲁');
INSERT INTO domaines VALUES( '218', 'tw', '台湾');
INSERT INTO domaines VALUES( '219', 'tz', '坦桑尼亚');
INSERT INTO domaines VALUES( '220', 'ua', '乌克兰');
INSERT INTO domaines VALUES( '221', 'ug', '乌干达');
INSERT INTO domaines VALUES( '222', 'uk', '英国');
INSERT INTO domaines VALUES( '223', 'gb', '联合王国');
INSERT INTO domaines VALUES( '224', 'um', '美国边远小岛');
INSERT INTO domaines VALUES( '225', 'us', '美国');
INSERT INTO domaines VALUES( '226', 'uy', '乌拉圭');
INSERT INTO domaines VALUES( '227', 'uz', '乌兹别克斯坦');
INSERT INTO domaines VALUES( '228', 'va', '梵地冈');
INSERT INTO domaines VALUES( '229', 'vc', '圣徒文森特和格林那定');
INSERT INTO domaines VALUES( '230', 've', '委内瑞拉');
INSERT INTO domaines VALUES( '231', 'vg', '英属维尔京群岛');
INSERT INTO domaines VALUES( '232', 'vi', '美属维尔京群岛');
INSERT INTO domaines VALUES( '233', 'vn', '越南');
INSERT INTO domaines VALUES( '234', 'vu', '瓦努阿图');
INSERT INTO domaines VALUES( '235', 'wf', '瓦利斯和富图纳群岛');
INSERT INTO domaines VALUES( '236', 'ws', '东萨摩亚');
INSERT INTO domaines VALUES( '237', 'ye', '也门');
INSERT INTO domaines VALUES( '238', 'yt', 'Mayotte');
INSERT INTO domaines VALUES( '239', 'yu', '南斯拉夫');
INSERT INTO domaines VALUES( '240', 'za', '南非');
INSERT INTO domaines VALUES( '241', 'zm', '赞比亚');
INSERT INTO domaines VALUES( '242', 'zr', '扎伊尔');
INSERT INTO domaines VALUES( '243', 'zw', '津巴布韦');
INSERT INTO domaines VALUES( '244', 'com', '-');
INSERT INTO domaines VALUES( '245', 'net', '-');
INSERT INTO domaines VALUES( '246', 'org', '-');
INSERT INTO domaines VALUES( '247', 'edu', '-');
INSERT INTO domaines VALUES( '248', 'int', '-');
INSERT INTO domaines VALUES( '249', 'arpa', '-');
INSERT INTO domaines VALUES( '250', 'gov', '政府部门');
INSERT INTO domaines VALUES( '251', 'mil', '军事机构');
INSERT INTO domaines VALUES( '252', 'at', '奥地利');
INSERT INTO domaines VALUES( '253', 'cq', '赤道几内亚');
INSERT INTO domaines VALUES( '254', 'ev', '萨尔瓦多');
INSERT INTO domaines VALUES( '255', 'nt', '中立区');
INSERT INTO domaines VALUES( '256', 'su', '苏联');
INSERT INTO domaines VALUES( '257', 'su', 'Ex U.S.R.R.');
INSERT INTO domaines VALUES( '258', 'reverse', '-');
