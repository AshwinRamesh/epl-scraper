DROP TABLE IF EXISTS player_fixture;
DROP TABLE IF EXISTS fixture;
DROP TABLE IF EXISTS player_yearly_statistics;
DROP TABLE IF EXISTS player_point_details;
DROP TABLE IF EXISTS player_status;
DROP TABLE IF EXISTS player;
DROP TABLE IF EXISTS club;
DROP TABLE IF EXISTS player_type;

CREATE TABLE player_type (
  id INT NOT NULL,
  type VARCHAR(20),
  PRIMARY KEY (id)
);


CREATE TABLE player_status (
  id INT NOT NULL,
  status VARCHAR(20),
  PRIMARY KEY (id)
);

CREATE TABLE club (
  id INT NOT NULL AUTO_INCREMENT,
  name VARCHAR(100) NOT NULL,
  points INT(3) NOT NULL DEFAULT 0,
  wins INT(2) NOT NULL DEFAULT 0,
  losses INT(2) NOT NULL DEFAULT 0,
  goals_for INT(4) NOT NULL DEFAULT 0,
  goals_against INT(4) NOT NULL DEFAULT 0,
  home_points INT(3) NOT NULL DEFAULT 0,
  home_wins INT(2) NOT NULL DEFAULT 0,
  home_losses INT(2) NOT NULL DEFAULT 0,
  home_goals_for INT(4) NOT NULL DEFAULT 0,
  home_goals_against INT(4) NOT NULL DEFAULT 0,
  away_points INT(3) NOT NULL DEFAULT 0,
  away_wins INT(2) NOT NULL DEFAULT 0,
  away_losses INT(2) NOT NULL DEFAULT 0,
  away_goals_for INT(4) NOT NULL DEFAULT 0,
  away_goals_against INT(4) NOT NULL DEFAULT 0,
  goal_difference INT(4) NOT NULL DEFAULT 0,
  played INT(2) NOT NULL DEFAULT 0,
  PRIMARY KEY (id)
);

CREATE TABLE player (
  id INT NOT NULL AUTO_INCREMENT,
  fpl_id INT NOT NULL DEFAULT 0,
  fpl_code INT NOT NULL DEFAULT 0,
  club_id INT NOT NULL,
  first_name VARCHAR(100) NOT NULL,
  last_name VARCHAR(100) NOT NULL,
  squad_number INT(3) DEFAULT 0,
  position INT(1),
  status INT(1),
  dreamteam INT(1), # Boolean ,
  selected_percentage DECIMAL(4,1),
  original_cost DECIMAL (3,1),
  current_cost DECIMAL (3,1),
  max_cost DECIMAL (3,1),
  min_cost DECIMAL (3,1),
  PRIMARY KEY (id),
  FOREIGN KEY (club_id) REFERENCES club(id) ON DELETE CASCADE ON UPDATE CASCADE,
  FOREIGN KEY (position) REFERENCES player_type(id) ON DELETE CASCADE ON UPDATE CASCADE
);


CREATE TABLE fixture (
  id INT NOT NULL AUTO_INCREMENT,
  round INT NOT NULL,
  home_team INT NOT NULL,
  away_team INT NOT NULL,
  home_goals INT NOT NULL DEFAULT 0,
  away_goals INT NOT NULL DEFAULT 0,
  PRIMARY KEY (id),
  FOREIGN KEY (home_team) REFERENCES club(id) ON DELETE CASCADE ON UPDATE CASCADE,
  FOREIGN KEY (away_team) REFERENCES club(id) ON DELETE CASCADE ON UPDATE CASCADE
);

CREATE TABLE player_fixture (
  player_id INT NOT NULL,
  fixture_id INT NOT NULL,
  minutes_played INT NOT NULL DEFAULT 0,
  goals INT DEFAULT 0,
  assists INT DEFAULT 0,
  clean_sheets INT DEFAULT 0,
  goals_conceded INT DEFAULT 0,
  own_goals INT DEFAULT 0,
  penalties_saved INT DEFAULT 0,
  penalties_missed INT DEFAULT 0,
  yellow_card INT DEFAULT 0,
  red_ard INT DEFAULT 0,
  saves INT DEFAULT 0,
  bonus INT DEFAULT 0,
  esp INT DEFAULT 0,
  bps INT DEFAULT 0,
  net_transfers INT DEFAULT 0,
  cost_value INT DEFAULT 0,
  points INT DEFAULT 0,

  PRIMARY KEY (player_id, fixture_id),
  FOREIGN KEY (player_id) REFERENCES player(id) ON DELETE CASCADE ON UPDATE CASCADE,
  FOREIGN KEY (fixture_id) REFERENCES fixture(id) ON DELETE CASCADE ON UPDATE CASCADE
);

CREATE TABLE player_yearly_statistics (
  player_id INT NOT NULL,
  FOREIGN KEY (player_id) REFERENCES player(id) ON DELETE CASCADE ON UPDATE CASCADE
);

CREATE TABLE player_point_details (
  id INT NOT NULL,
  last_fixture_cost DECIMAL(3,1) DEFAULT 0,
  transfers_out INT DEFAULT 0,
  last_fixture_transfers_out INT DEFAULT 0,

  FOREIGN KEY (id) REFERENCES player(id) ON DELETE CASCADE ON UPDATE CASCADE
);

INSERT INTO player_type (id, type) VALUES (1, "Goalkeeper");
INSERT INTO player_type (id, type) VALUES (2, "Defender");
INSERT INTO player_type (id, type) VALUES (3, "Midfielder");
INSERT INTO player_type (id, type) VALUES (4, "Striker");

INSERT INTO player_status (id, status) VALUES (1, "Possible"); # d
INSERT INTO player_status (id, status) VALUES (2, "Doubtful"); # d
INSERT INTO player_status (id, status) VALUES (3, "Unlikely"); # n
INSERT INTO player_status (id, status) VALUES (4, "Available"); #a

INSERT INTO club (name) VALUES ("Arsenal");
INSERT INTO club (name) VALUES ("Liverpool");
INSERT INTO club (name) VALUES ("Chelsea");
INSERT INTO club (name) VALUES ("Southampton");
INSERT INTO club (name) VALUES ("Man City");
INSERT INTO club (name) VALUES ("Tottenham");
INSERT INTO club (name) VALUES ("Everton");
INSERT INTO club (name) VALUES ("Hull City");
INSERT INTO club (name) VALUES ("Man Utd");
INSERT INTO club (name) VALUES ("Aston Villa");
INSERT INTO club (name) VALUES ("Newcastle");
INSERT INTO club (name) VALUES ("West Brom");
INSERT INTO club (name) VALUES ("West Ham");
INSERT INTO club (name) VALUES ("Cardiff");
INSERT INTO club (name) VALUES ("Swansea");
INSERT INTO club (name) VALUES ("Stoke");
INSERT INTO club (name) VALUES ("Fulham");
INSERT INTO club (name) VALUES ("Norwich");
INSERT INTO club (name) VALUES ("Crystal Palace");
INSERT INTO club (name) VALUES ("Sunderland");
