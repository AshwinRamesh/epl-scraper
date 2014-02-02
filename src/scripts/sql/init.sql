DROP TABLE IF EXISTS player_fixture;
DROP TABLE IF EXISTS fixture;
DROP TABLE IF EXISTS player_history;
DROP TABLE IF EXISTS player_cost;
DROP TABLE IF EXISTS player_event;
DROP TABLE IF EXISTS player_news;
DROP TABLE IF EXISTS player_transfers;
DROP TABLE IF EXISTS player;
DROP TABLE IF EXISTS player_type;
DROP TABLE IF EXISTS player_status;
DROP TABLE IF EXISTS club;

CREATE TABLE player_type (
  id INT NOT NULL,
  type VARCHAR(20),
  PRIMARY KEY (id)
);

INSERT INTO player_type (id, type) VALUES (1, "Goalkeeper");
INSERT INTO player_type (id, type) VALUES (2, "Defender");
INSERT INTO player_type (id, type) VALUES (3, "Midfielder");
INSERT INTO player_type (id, type) VALUES (4, "Forward");

CREATE TABLE player_status (
  id INT NOT NULL AUTO_INCREMENT,
  status_short CHAR(1) NOT NULL,
  status VARCHAR(20),
  PRIMARY KEY (id)
);

INSERT INTO player_status (id, status) VALUES ("d", "Doubtful");
INSERT INTO player_status (id, status) VALUES ("n", "Unlikely");
INSERT INTO player_status (id, status) VALUES ("i", "Injured");
INSERT INTO player_status (id, status) VALUES ("u", "Unknown");
INSERT INTO player_status (id, status) VALUES ("a", "Available");
INSERT INTO player_status (id, status) VALUES ("s", "Suspended");

CREATE TABLE club (
  id INT(3) NOT NULL auto_increment,
  name VARCHAR(100) NOT NULL,
  short_name VARCHAR(5) NOT NULL,
  PRIMARY KEY (id)
);

INSERT INTO club (name, short_name) VALUES ("Arsenal", "ARS");
INSERT INTO club (name, short_name) VALUES ("Liverpool", "LIV");
INSERT INTO club (name, short_name) VALUES ("Chelsea", "CHE");
INSERT INTO club (name, short_name) VALUES ("Southampton", "SOU");
INSERT INTO club (name, short_name) VALUES ("Man City", "MCI");
INSERT INTO club (name, short_name) VALUES ("Tottenham", "TOT");
INSERT INTO club (name, short_name) VALUES ("Everton", "EVE");
INSERT INTO club (name, short_name) VALUES ("Hull City", "HUL");
INSERT INTO club (name, short_name) VALUES ("Man Utd", "MUN");
INSERT INTO club (name, short_name) VALUES ("Aston Villa", "AVL");
INSERT INTO club (name, short_name) VALUES ("Newcastle", "NEW");
INSERT INTO club (name, short_name) VALUES ("West Brom", "WBA");
INSERT INTO club (name, short_name) VALUES ("West Ham", "WHU");
INSERT INTO club (name, short_name) VALUES ("Cardiff City", "CAR");
INSERT INTO club (name, short_name) VALUES ("Swansea", "SWA");
INSERT INTO club (name, short_name) VALUES ("Stoke City", "STK");
INSERT INTO club (name, short_name) VALUES ("Fulham", "FUL");
INSERT INTO club (name, short_name) VALUES ("Norwich", "NOR");
INSERT INTO club (name, short_name) VALUES ("Crystal Palace", "CRY");
INSERT INTO club (name, short_name) VALUES ("Sunderland", "SUN");

CREATE TABLE player(
  last_modified TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  fpl_id INT NOT NULL,
  fpl_code INT NOT NULL DEFAULT 0,
  club_id INT(6) NOT NULL DEFAULT 0,
  squad_number INT(3),
  first_name VARCHAR(100) NOT NULL,
  second_name VARCHAR(100) NOT NULL,
  web_name VARCHAR(100),
  in_dreamteam INT(1) NOT NULL DEFAULT 0,
  shirt_image_url VARCHAR(200),
  shirt_mobile_image_url VARCHAR(200),
  photo_mobile_url VARCHAR(200),
  type INT(3) NOT NULL,
  total_points INT(5) DEFAULT 0,
  points_per_game INT(3) DEFAULT 0,
  last_season_points INT(4) DEFAULT 0,
  fpl_added VARCHAR(100),
  PRIMARY KEY (fpl_id),
  FOREIGN KEY (club_id) REFERENCES club(id) ON DELETE CASCADE ON UPDATE CASCADE,
  FOREIGN KEY (type) REFERENCES player_type(id) ON DELETE CASCADE ON UPDATE CASCADE
);


CREATE TABLE player_news(
  player_id INT NOT NULL,
  status CHAR(1) NOT NULL DEFAULT "a",
  news_updated VARCHAR(300),
  news_added VARCHAR(300),
  news VARCHAR(300),
  news_return VARCHAR(300),
  PRIMARY KEY (player_id),
  FOREIGN KEY (player_id) REFERENCES player(fpl_id) ON DELETE CASCADE ON UPDATE CASCADE
);

CREATE TABLE player_event(
  player_id INT NOT NULL,
  event_total INT(3) NOT NULL DEFAULT 0,
  event_points INT(3) NOT NULL DEFAULT 0,
  PRIMARY KEY (player_id),
  FOREIGN KEY (player_id) REFERENCES player(fpl_id) ON DELETE CASCADE ON UPDATE CASCADE
);

CREATE TABLE player_transfers(
  player_id INT NOT NULL,
  transfers_out_event INT(8) NOT NULL DEFAULT 0,
  transfers_in_event INT(8) NOT NULL DEFAULT 0,
  selected INT(8) NOT NULL DEFAULT 0,
  transfers_in INT(8) NOT NULL DEFAULT 0,
  transfers_out INT(8) NOT NULL DEFAULT 0,
  selected_by DECIMAL(4,1) NOT NULL DEFAULT 0,
  PRIMARY KEY (player_id),
  FOREIGN KEY (player_id) REFERENCES player(fpl_id) ON DELETE CASCADE ON UPDATE CASCADE
);

CREATE TABLE player_cost(
  player_id INT NOT NULL,
  event_cost DECIMAL(4,1) NOT NULL DEFAULT 0,
  max_cost DECIMAL(4,1) NOT NULL DEFAULT 0,
  min_cost DECIMAL(4,1) NOT NULL DEFAULT 0,
  now_cost DECIMAL(4,1) NOT NULL DEFAULT 0,
  original_cost DECIMAL(4,1) NOT NULL DEFAULT 0,
  PRIMARY KEY (player_id),
  FOREIGN KEY (player_id) REFERENCES player(fpl_id) ON DELETE CASCADE ON UPDATE CASCADE
);

CREATE TABLE player_history(
  player_id INT NOT NULL,
  season VARCHAR(8) NOT NULL,
  minutes_played INT NOT NULL DEFAULT 0,
  goals INT DEFAULT 0,
  assists INT DEFAULT 0,
  clean_sheet INT DEFAULT 0,
  goals_conceded INT DEFAULT 0,
  own_goals INT DEFAULT 0,
  penalties_saved INT DEFAULT 0,
  penalties_missed INT DEFAULT 0,
  yellow_card INT DEFAULT 0,
  red_card INT DEFAULT 0,
  saves INT DEFAULT 0,
  bonus INT DEFAULT 0,
  esp INT DEFAULT 0,
  bps INT DEFAULT 0,
  value INT DEFAULT 0,
  points INT DEFAULT 0,
  PRIMARY KEY (player_id, season),
  FOREIGN KEY (player_id) REFERENCES player(fpl_id) ON DELETE CASCADE ON UPDATE CASCADE
);

CREATE TABLE fixture(
  id INT NOT NULL AUTO_INCREMENT,
  gameweek INT NOT NULL,
  kickoff_time DATETIME,
  home_team INT NOT NULL,
  away_team INT NOT NULL,
  home_goals INT,
  away_goals INT,
  played INT(1) NOT NULL DEFAULT 0, -- 1 or 0
  PRIMARY KEY (home_team, away_team),
  INDEX `fixture_id_idx` (id),
  FOREIGN KEY (home_team) REFERENCES club(id) ON DELETE CASCADE ON UPDATE CASCADE,
  FOREIGN KEY (away_team) REFERENCES club(id) ON DELETE CASCADE ON UPDATE CASCADE
);

CREATE TABLE player_fixture (
  player_id INT NOT NULL,
  fixture_id INT NOT NULL,
  minutes_played INT NOT NULL DEFAULT 0,
  goals INT DEFAULT 0,
  assists INT DEFAULT 0,
  clean_sheet INT DEFAULT 0,
  goals_conceded INT DEFAULT 0,
  own_goals INT DEFAULT 0,
  penalties_saved INT DEFAULT 0,
  penalties_missed INT DEFAULT 0,
  yellow_card INT DEFAULT 0,
  red_card INT DEFAULT 0,
  saves INT DEFAULT 0,
  bonus INT DEFAULT 0,
  ea_sports_ppi INT DEFAULT 0,
  bonus_point_system INT DEFAULT 0,
  net_transfers INT DEFAULT 0,
  cost_value INT DEFAULT 0,
  points INT DEFAULT 0,

  PRIMARY KEY (player_id, fixture_id),
  FOREIGN KEY (player_id) REFERENCES player(fpl_id) ON DELETE CASCADE ON UPDATE CASCADE,
  FOREIGN KEY (fixture_id) REFERENCES fixture(id) ON DELETE CASCADE ON UPDATE CASCADE
);
