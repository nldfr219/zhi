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

INSERT INTO domaines VALUES( '1', 'ac', '������');
INSERT INTO domaines VALUES( '2', 'ad', '������');
INSERT INTO domaines VALUES( '3', 'ae', '������');
INSERT INTO domaines VALUES( '4', 'af', '������');
INSERT INTO domaines VALUES( '5', 'ag', '����ϺͰͲ���');
INSERT INTO domaines VALUES( '6', 'ai', '������');
INSERT INTO domaines VALUES( '7', 'al', '����������');
INSERT INTO domaines VALUES( '8', 'am', '��������');
INSERT INTO domaines VALUES( '9', 'an', '������˹');
INSERT INTO domaines VALUES( '10', 'ao', '������');
INSERT INTO domaines VALUES( '11', 'aq', '�ϼ���');
INSERT INTO domaines VALUES( '12', 'ar', '����͢');
INSERT INTO domaines VALUES( '13', 'as', '����Ħ��');
INSERT INTO domaines VALUES( '14', 'au', '�Ĵ�����');
INSERT INTO domaines VALUES( '15', 'aw', '��³��');
INSERT INTO domaines VALUES( '16', 'az', '�����ݽ�');
INSERT INTO domaines VALUES( '17', 'ba', '����');
INSERT INTO domaines VALUES( '18', 'bb', '�ͰͶ�˹');
INSERT INTO domaines VALUES( '19', 'bd', '�ϼ�����');
INSERT INTO domaines VALUES( '20', 'be', '����ʱ');
INSERT INTO domaines VALUES( '21', 'bf', '�����ɷ���');
INSERT INTO domaines VALUES( '22', 'bg', '��������');
INSERT INTO domaines VALUES( '23', 'bh', '����');
INSERT INTO domaines VALUES( '24', 'bi', '��¡��');
INSERT INTO domaines VALUES( '25', 'bj', '����');
INSERT INTO domaines VALUES( '26', 'bm', '��Ľ��Ⱥ��');
INSERT INTO domaines VALUES( '27', 'bn', '������³������');
INSERT INTO domaines VALUES( '28', 'bo', '����ά��');
INSERT INTO domaines VALUES( '29', 'br', '����');
INSERT INTO domaines VALUES( '30', 'bs', '�͹���');
INSERT INTO domaines VALUES( '31', 'bt', '����');
INSERT INTO domaines VALUES( '32', 'bv', '��ΤȺ��');
INSERT INTO domaines VALUES( '33', 'bw', '��������');
INSERT INTO domaines VALUES( '34', 'by', '�׶���˹');
INSERT INTO domaines VALUES( '35', 'bz', '������');
INSERT INTO domaines VALUES( '36', 'ca', '���ô�');
INSERT INTO domaines VALUES( '37', 'cc', '�ƿ�˹Ⱥ��');
INSERT INTO domaines VALUES( '38', 'cd', '�չ��������񹲺͹�');
INSERT INTO domaines VALUES( '39', 'cf', '�зǹ��͹�');
INSERT INTO domaines VALUES( '40', 'cg', '�չ�');
INSERT INTO domaines VALUES( '41', 'ch', '��ʿ');
INSERT INTO domaines VALUES( '42', 'ci', '��������');
INSERT INTO domaines VALUES( '43', 'ck', '���Ⱥ��');
INSERT INTO domaines VALUES( '44', 'cl', '����');
INSERT INTO domaines VALUES( '45', 'cm', '����¡');
INSERT INTO domaines VALUES( '46', 'cn', '�й�');
INSERT INTO domaines VALUES( '47', 'co', '���ױ���');
INSERT INTO domaines VALUES( '48', 'cr', '��˹�����');
INSERT INTO domaines VALUES( '49', 'cu', '�Ű�');
INSERT INTO domaines VALUES( '50', 'cv', '��ý�');
INSERT INTO domaines VALUES( '51', 'cx', 'ʥ����');
INSERT INTO domaines VALUES( '52', 'cy', '����·˹');
INSERT INTO domaines VALUES( '53', 'cz', '�ݿ˹��͹�');
INSERT INTO domaines VALUES( '54', 'de', '�¹�');
INSERT INTO domaines VALUES( '55', 'dj', '������');
INSERT INTO domaines VALUES( '56', 'dk', '����');
INSERT INTO domaines VALUES( '57', 'dm', '������ӵ�');
INSERT INTO domaines VALUES( '58', 'do', '������ӹ��͹�');
INSERT INTO domaines VALUES( '59', 'dz', '����������');
INSERT INTO domaines VALUES( '60', 'ec', '��϶��');
INSERT INTO domaines VALUES( '61', 'ee', '��ɳ����');
INSERT INTO domaines VALUES( '62', 'eg', '����');
INSERT INTO domaines VALUES( '63', 'eh', '����Ħ��');
INSERT INTO domaines VALUES( '64', 'er', '����������');
INSERT INTO domaines VALUES( '65', 'es', '������');
INSERT INTO domaines VALUES( '66', 'et', '���������');
INSERT INTO domaines VALUES( '67', 'fi', '����');
INSERT INTO domaines VALUES( '68', 'fj', '쳼�');
INSERT INTO domaines VALUES( '69', 'fk', '������Ⱥ��');
INSERT INTO domaines VALUES( '70', 'fm', '�ܿ���������');
INSERT INTO domaines VALUES( '71', 'fo', '����Ⱥ��');
INSERT INTO domaines VALUES( '72', 'fr', '����');
INSERT INTO domaines VALUES( '73', 'ga', '����');
INSERT INTO domaines VALUES( '74', 'gd', '�����ɴ�');
INSERT INTO domaines VALUES( '75', 'ge', '��³����');
INSERT INTO domaines VALUES( '76', 'gf', '����������');
INSERT INTO domaines VALUES( '77', 'gg', '������');
INSERT INTO domaines VALUES( '78', 'gh', '����');
INSERT INTO domaines VALUES( '79', 'gi', 'ֱ������');
INSERT INTO domaines VALUES( '80', 'gl', '������Ⱥ��');
INSERT INTO domaines VALUES( '81', 'gm', '�Ա���');
INSERT INTO domaines VALUES( '82', 'gn', '������');
INSERT INTO domaines VALUES( '83', 'gp', '�ϵ����յ�');
INSERT INTO domaines VALUES( '84', 'gq', '���������');
INSERT INTO domaines VALUES( '85', 'gr', 'ϣ��');
INSERT INTO domaines VALUES( '86', 'gs', '�������Ǻ���ɣ���ε�');
INSERT INTO domaines VALUES( '87', 'gt', 'Σ������');
INSERT INTO domaines VALUES( '88', 'gu', '�ص�');
INSERT INTO domaines VALUES( '89', 'gw', '�����Ǳ���');
INSERT INTO domaines VALUES( '90', 'gy', '������');
INSERT INTO domaines VALUES( '91', 'hk', '���');
INSERT INTO domaines VALUES( '92', 'hm', 'Heard �� McDonald ��');
INSERT INTO domaines VALUES( '93', 'hn', '�鶼��˹');
INSERT INTO domaines VALUES( '94', 'hr', '���޵���');
INSERT INTO domaines VALUES( '95', 'ht', '����');
INSERT INTO domaines VALUES( '96', 'hu', '������');
INSERT INTO domaines VALUES( '97', 'id', 'ӡ��������');
INSERT INTO domaines VALUES( '98', 'ie', '���������͹�');
INSERT INTO domaines VALUES( '99', 'il', '��ɫ��');
INSERT INTO domaines VALUES( '100', 'im', '���˵�');
INSERT INTO domaines VALUES( '101', 'in', 'ӡ��');
INSERT INTO domaines VALUES( '102', 'io', 'Ӣ��ӡ�������');
INSERT INTO domaines VALUES( '103', 'iq', '������');
INSERT INTO domaines VALUES( '104', 'ir', '����');
INSERT INTO domaines VALUES( '105', 'is', '����');
INSERT INTO domaines VALUES( '106', 'it', '�����');
INSERT INTO domaines VALUES( '107', 'je', '������');
INSERT INTO domaines VALUES( '108', 'jm', '�����');
INSERT INTO domaines VALUES( '109', 'jo', 'Լ��');
INSERT INTO domaines VALUES( '110', 'jp', '�ձ�');
INSERT INTO domaines VALUES( '111', 'ke', '������');
INSERT INTO domaines VALUES( '112', 'kg', '������˹˹̹');
INSERT INTO domaines VALUES( '113', 'kh', '������');
INSERT INTO domaines VALUES( '114', 'ki', '�����˹');
INSERT INTO domaines VALUES( '115', 'km', '��Ħ��');
INSERT INTO domaines VALUES( '116', 'kn', 'ʥ���ĺ���ά˹');
INSERT INTO domaines VALUES( '117', 'kp', '������');
INSERT INTO domaines VALUES( '118', 'kr', '�ϳ���');
INSERT INTO domaines VALUES( '119', 'kw', '������');
INSERT INTO domaines VALUES( '120', 'ky', '����Ⱥ��');
INSERT INTO domaines VALUES( '121', 'kz', '������˹̹');
INSERT INTO domaines VALUES( '122', 'la', '�������񹲺͹�');
INSERT INTO domaines VALUES( '123', 'lb', '�����');
INSERT INTO domaines VALUES( '124', 'lc', 'ʥ¶���ǵ�');
INSERT INTO domaines VALUES( '125', 'li', '��֧��ʿ��');
INSERT INTO domaines VALUES( '126', 'lk', '˹������');
INSERT INTO domaines VALUES( '127', 'lr', '��������');
INSERT INTO domaines VALUES( '128', 'ls', '������');
INSERT INTO domaines VALUES( '129', 'lt', '������');
INSERT INTO domaines VALUES( '130', 'lu', '¬ɭ��');
INSERT INTO domaines VALUES( '131', 'lv', '����ά��');
INSERT INTO domaines VALUES( '132', 'ly', '������');
INSERT INTO domaines VALUES( '133', 'ma', 'Ħ���');
INSERT INTO domaines VALUES( '134', 'mc', 'Ħ�ɸ�');
INSERT INTO domaines VALUES( '135', 'md', 'Ħ������');
INSERT INTO domaines VALUES( '136', 'mg', '����˹��');
INSERT INTO domaines VALUES( '137', 'mh', '���ܶ�Ⱥ��');
INSERT INTO domaines VALUES( '138', 'mk', '�����,ǰ��˹���򹲺͹�');
INSERT INTO domaines VALUES( '139', 'ml', '����');
INSERT INTO domaines VALUES( '140', 'mm', '���');
INSERT INTO domaines VALUES( '141', 'mn', '�ɹ�');
INSERT INTO domaines VALUES( '142', 'mo', '����');
INSERT INTO domaines VALUES( '143', 'mp', '����������Ⱥ��');
INSERT INTO domaines VALUES( '144', 'mq', '������˵�');
INSERT INTO domaines VALUES( '145', 'mr', 'ë��������');
INSERT INTO domaines VALUES( '146', 'ms', '�������ص�');
INSERT INTO domaines VALUES( '147', 'mt', '�����');
INSERT INTO domaines VALUES( '148', 'mu', 'ë����˹');
INSERT INTO domaines VALUES( '149', 'mv', '�������');
INSERT INTO domaines VALUES( '150', 'mw', '����ά');
INSERT INTO domaines VALUES( '151', 'mx', 'ī����');
INSERT INTO domaines VALUES( '152', 'my', '��������');
INSERT INTO domaines VALUES( '153', 'mz', 'Īɣ�ȿ�');
INSERT INTO domaines VALUES( '154', 'na', '���ױ���');
INSERT INTO domaines VALUES( '155', 'nc', '�¿��������');
INSERT INTO domaines VALUES( '156', 'ne', '���ն�');
INSERT INTO domaines VALUES( '157', 'nf', 'ŵ���˵�');
INSERT INTO domaines VALUES( '158', 'ng', '��������');
INSERT INTO domaines VALUES( '159', 'ni', '�������');
INSERT INTO domaines VALUES( '160', 'nl', '����');
INSERT INTO domaines VALUES( '161', 'no', 'Ų��');
INSERT INTO domaines VALUES( '162', 'np', '�Ჴ��');
INSERT INTO domaines VALUES( '163', 'nr', '�³');
INSERT INTO domaines VALUES( '164', 'nu', 'Ŧ��');
INSERT INTO domaines VALUES( '165', 'nz', '������');
INSERT INTO domaines VALUES( '166', 'om', '����');
INSERT INTO domaines VALUES( '167', 'pa', '������');
INSERT INTO domaines VALUES( '168', 'pe', '��³');
INSERT INTO domaines VALUES( '169', 'pf', '��������������');
INSERT INTO domaines VALUES( '170', 'pg', '�Ͳ����¼�����');
INSERT INTO domaines VALUES( '171', 'ph', '���ɱ�');
INSERT INTO domaines VALUES( '172', 'pk', '�ͻ�˹̹');
INSERT INTO domaines VALUES( '173', 'pl', '����');
INSERT INTO domaines VALUES( '174', 'pm', 'ʥƤ�������ܿ�¡��');
INSERT INTO domaines VALUES( '175', 'pn', 'Ƥ�ؿ˶���');
INSERT INTO domaines VALUES( '176', 'pr', '�������');
INSERT INTO domaines VALUES( '177', 'pt', '������');
INSERT INTO domaines VALUES( '178', 'pw', '����');
INSERT INTO domaines VALUES( '179', 'py', '������');
INSERT INTO domaines VALUES( '180', 'qa', '������');
INSERT INTO domaines VALUES( '181', 're', '��������');
INSERT INTO domaines VALUES( '182', 'ro', '��������');
INSERT INTO domaines VALUES( '183', 'ru', '����˹����');
INSERT INTO domaines VALUES( '184', 'rw', '¬����');
INSERT INTO domaines VALUES( '185', 'sa', 'ɳ�ذ�����');
INSERT INTO domaines VALUES( '186', 'sb', '������Ⱥ��');
INSERT INTO domaines VALUES( '187', 'sc', '�����');
INSERT INTO domaines VALUES( '188', 'sd', '�յ�');
INSERT INTO domaines VALUES( '189', 'se', '���');
INSERT INTO domaines VALUES( '190', 'sg', '�¼���');
INSERT INTO domaines VALUES( '191', 'sh', '������');
INSERT INTO domaines VALUES( '192', 'si', '˹��������');
INSERT INTO domaines VALUES( '193', 'sj', '˹�߶���Ⱥ��');
INSERT INTO domaines VALUES( '194', 'sk', '˹�工��');
INSERT INTO domaines VALUES( '195', 'sl', '��������');
INSERT INTO domaines VALUES( '196', 'sm', 'ʥ����ŵ');
INSERT INTO domaines VALUES( '197', 'sn', '���ڼӶ�');
INSERT INTO domaines VALUES( '198', 'so', '������');
INSERT INTO domaines VALUES( '199', 'sr', '������');
INSERT INTO domaines VALUES( '200', 'st', 'ʥ��������������');
INSERT INTO domaines VALUES( '201', 'sv', '�����߶�');
INSERT INTO domaines VALUES( '202', 'sy', '������');
INSERT INTO domaines VALUES( '203', 'sz', '˹��ʿ��');
INSERT INTO domaines VALUES( '204', 'tc', '�ؿ�˹�Ϳ���˹Ⱥ��');
INSERT INTO domaines VALUES( '205', 'td', 'է��');
INSERT INTO domaines VALUES( '206', 'tf', '�����ϰ������');
INSERT INTO domaines VALUES( '207', 'tg', '���');
INSERT INTO domaines VALUES( '208', 'th', '̩��');
INSERT INTO domaines VALUES( '209', 'tj', '������˹̹');
INSERT INTO domaines VALUES( '210', 'tk', '�п���Ⱥ��');
INSERT INTO domaines VALUES( '211', 'tm', '������˹̹');
INSERT INTO domaines VALUES( '212', 'tn', 'ͻ��˹');
INSERT INTO domaines VALUES( '213', 'to', '����');
INSERT INTO domaines VALUES( '214', 'tp', '������');
INSERT INTO domaines VALUES( '215', 'tr', '������');
INSERT INTO domaines VALUES( '216', 'tt', '�������Ͷ�͸�');
INSERT INTO domaines VALUES( '217', 'tv', 'ͼ��³');
INSERT INTO domaines VALUES( '218', 'tw', '̨��');
INSERT INTO domaines VALUES( '219', 'tz', '̹ɣ����');
INSERT INTO domaines VALUES( '220', 'ua', '�ڿ���');
INSERT INTO domaines VALUES( '221', 'ug', '�ڸɴ�');
INSERT INTO domaines VALUES( '222', 'uk', 'Ӣ��');
INSERT INTO domaines VALUES( '223', 'gb', '��������');
INSERT INTO domaines VALUES( '224', 'um', '������ԶС��');
INSERT INTO domaines VALUES( '225', 'us', '����');
INSERT INTO domaines VALUES( '226', 'uy', '������');
INSERT INTO domaines VALUES( '227', 'uz', '���ȱ��˹̹');
INSERT INTO domaines VALUES( '228', 'va', '��ظ�');
INSERT INTO domaines VALUES( '229', 'vc', 'ʥͽ��ɭ�غ͸����Ƕ�');
INSERT INTO domaines VALUES( '230', 've', 'ί������');
INSERT INTO domaines VALUES( '231', 'vg', 'Ӣ��ά����Ⱥ��');
INSERT INTO domaines VALUES( '232', 'vi', '����ά����Ⱥ��');
INSERT INTO domaines VALUES( '233', 'vn', 'Խ��');
INSERT INTO domaines VALUES( '234', 'vu', '��Ŭ��ͼ');
INSERT INTO domaines VALUES( '235', 'wf', '����˹�͸�ͼ��Ⱥ��');
INSERT INTO domaines VALUES( '236', 'ws', '����Ħ��');
INSERT INTO domaines VALUES( '237', 'ye', 'Ҳ��');
INSERT INTO domaines VALUES( '238', 'yt', 'Mayotte');
INSERT INTO domaines VALUES( '239', 'yu', '��˹����');
INSERT INTO domaines VALUES( '240', 'za', '�Ϸ�');
INSERT INTO domaines VALUES( '241', 'zm', '�ޱ���');
INSERT INTO domaines VALUES( '242', 'zr', '������');
INSERT INTO domaines VALUES( '243', 'zw', '��Ͳ�Τ');
INSERT INTO domaines VALUES( '244', 'com', '-');
INSERT INTO domaines VALUES( '245', 'net', '-');
INSERT INTO domaines VALUES( '246', 'org', '-');
INSERT INTO domaines VALUES( '247', 'edu', '-');
INSERT INTO domaines VALUES( '248', 'int', '-');
INSERT INTO domaines VALUES( '249', 'arpa', '-');
INSERT INTO domaines VALUES( '250', 'gov', '��������');
INSERT INTO domaines VALUES( '251', 'mil', '���»���');
INSERT INTO domaines VALUES( '252', 'at', '�µ���');
INSERT INTO domaines VALUES( '253', 'cq', '���������');
INSERT INTO domaines VALUES( '254', 'ev', '�����߶�');
INSERT INTO domaines VALUES( '255', 'nt', '������');
INSERT INTO domaines VALUES( '256', 'su', '����');
INSERT INTO domaines VALUES( '257', 'su', 'Ex U.S.R.R.');
INSERT INTO domaines VALUES( '258', 'reverse', '-');
