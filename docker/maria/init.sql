-- create schema IF NOT EXISTS klouddosco_db collate utf8_unicode_ci ;
use klouddosco_db;

-- klouddosco_db.report definition

CREATE TABLE report (
  report_id int(11) NOT NULL AUTO_INCREMENT,
  report_msg varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  req_id int(11) DEFAULT NULL,
  created_by int(11) DEFAULT NULL,
  created_date datetime DEFAULT NULL,
  rep_id int(11) DEFAULT NULL,
  status char(1) COLLATE utf8_unicode_ci DEFAULT NULL COMMENT 'R=report, M=Dismiss ,D=Delete',
  PRIMARY KEY (`report_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci COMMENT='table for report';


-- klouddosco_db.req_forum definition

CREATE TABLE req_forum (
  req_id int(11) NOT NULL AUTO_INCREMENT,
  req_topic varchar(250) COLLATE utf8_unicode_ci DEFAULT NULL,
  req_room int(11) NOT NULL,
  req_rating double NULL,
  req_st_date datetime NOT NULL,
  req_en_date datetime NOT NULL,
  req_location varchar(500) COLLATE utf8_unicode_ci NOT NULL,
  req_remark varchar(3000) COLLATE utf8_unicode_ci DEFAULT NULL,
  req_budget varchar(100) DEFAULT NULL,
  req_status char(1) COLLATE utf8_unicode_ci NOT NULL COMMENT 'active,inactive,close,quotation',
  is_public tinyint(1) null,
  is_allow_quot tinyint(1) null,
  is_rating_required tinyint(1) null,
  created_date datetime NOT NULL,
  created_by int(11) NOT NULL,
  updated_date datetime DEFAULT NULL,
  PRIMARY KEY (`req_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- klouddosco_db.user_account definition

CREATE TABLE user_account (
  account_id int(11) NOT NULL AUTO_INCREMENT,
  username varchar(20) COLLATE utf8_unicode_ci DEFAULT NULL,
  password varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  salt char(10) COLLATE utf8_unicode_ci DEFAULT NULL,
  role char(1) COLLATE utf8_unicode_ci DEFAULT NULL COMMENT 'S=Super User, H=Hotel, A=Agent',
  status char(1) COLLATE utf8_unicode_ci DEFAULT NULL COMMENT 'A=Active, I=Inactive',
  email varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  created_date datetime NOT NULL,
  reason varchar(100) NULL,
  PRIMARY KEY (`account_id`),
  UNIQUE KEY user_account_account_id_uindex (`account_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;


-- klouddosco_db.user_score definition

create table user_score
(
	score_id int auto_increment
		primary key,
	voted_to int not null,
	req_id int not null,
	score int not null,
	voted_by int not null,
	voted_date datetime null
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;


-- klouddosco_db.agent_desc definition

CREATE TABLE agent_desc (
  agent_id int(11) NOT NULL AUTO_INCREMENT,
  account_id int(11) NOT NULL,
  agent_type char(1) COLLATE utf8_unicode_ci NOT NULL,
  agent_name varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  agent_address varchar(500) COLLATE utf8_unicode_ci DEFAULT NULL,
  agent_email varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  agent_tel varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`agent_id`),
  KEY agent_desc_FK (`account_id`),
  CONSTRAINT agent_desc_FK FOREIGN KEY (`account_id`) REFERENCES user_account (`account_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;


-- klouddosco_db.hotel_desc definition

CREATE TABLE hotel_desc (
  hotel_id int(11) NOT NULL AUTO_INCREMENT,
  account_id int(11) NOT NULL,
  hotel_name varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  hotel_rate double NOT NULL,
  hotel_location varchar(500) COLLATE utf8_unicode_ci DEFAULT NULL,
  hotel_address varchar(500) COLLATE utf8_unicode_ci DEFAULT NULL,
  hotel_email varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  hotel_tel varchar(20) COLLATE utf8_unicode_ci DEFAULT NULL,
  hotel_map varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`hotel_id`),
  KEY hotel_desc_FK (`account_id`),
  CONSTRAINT hotel_desc_FK FOREIGN KEY (`account_id`) REFERENCES user_account (`account_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;


-- klouddosco_db.quotation definition

create table quotation
(
	quo_id int auto_increment
		primary key,
	quo_title varchar(100) null,
	quo_remark varchar(3000) null,
	quo_total double null,
	created_date datetime not null,
	created_by int not null,
	req_id int not null,
	asset_id int null,
	constraint quotation_req_forum_req_id_fk
		foreign key (req_id) references req_forum (req_id),
	constraint quotation_user_asset_asset_id_fk
		foreign key (asset_id) references user_asset (asset_id)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

create table quotation_detail
(
	quo_detail_id int auto_increment
		primary key,
	room_type varchar(100) null,
	amount int null,
	price_per_one double null,
	remark varchar(500) null,
	quo_id int not null,
	constraint quotation_detail_quotation_quo_id_fk
		foreign key (quo_id) references quotation (quo_id)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- klouddosco_db.rep_forum definition

CREATE TABLE rep_forum (
  rep_id int(11) NOT NULL AUTO_INCREMENT,
  req_id int(11) NOT NULL,
  rep_msg text COLLATE utf8_unicode_ci DEFAULT NULL,
  rep_date datetime DEFAULT NULL,
  rep_by int(11) NOT NULL,
  rep_status char(1) COLLATE utf8_unicode_ci DEFAULT NULL COMMENT 'active,inactive',
  root_rep_by int null,
  PRIMARY KEY (`rep_id`),
  KEY reply_FK (`req_id`),
  CONSTRAINT reply_FK FOREIGN KEY (`req_id`) REFERENCES req_forum (`req_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci COMMENT='reply forum';


-- klouddosco_db.user_asset definition

CREATE TABLE user_asset (
  asset_id int(11) NOT NULL AUTO_INCREMENT,
  account_id int(11) DEFAULT NULL,
  asset_url varchar(200) COLLATE utf8_unicode_ci DEFAULT NULL,
  asset_type char(1) COLLATE utf8_unicode_ci DEFAULT NULL COMMENT '1=logo,2=room,3=user,4=doc,5=license,6=quo',
  PRIMARY KEY (`asset_id`),
  KEY user_asset_FK (`account_id`),
  CONSTRAINT user_asset_FK FOREIGN KEY (`account_id`) REFERENCES user_account (`account_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci COMMENT='pic hotel';


-- klouddosco_db.user_profile definition

CREATE TABLE user_profile (
  profile_id int(11) NOT NULL AUTO_INCREMENT,
  account_id int(11) NOT NULL,
  first_name varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  last_name varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  address varchar(500) COLLATE utf8_unicode_ci DEFAULT NULL,
  tel varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  citizen_id_card varchar(200) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`profile_id`),
  KEY user_profile_FK (`account_id`),
  CONSTRAINT user_profile_FK FOREIGN KEY (`account_id`) REFERENCES user_account (`account_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci COMMENT='profile of hotel user';