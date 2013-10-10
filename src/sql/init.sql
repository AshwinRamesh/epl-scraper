DROP TABLE IF EXISTS player;
DROP TABLE IF EXISTS club;
DROP TABLE IF EXISTS fixture;
DROP TABLE IF EXISTS player_fixture;
DROP TABLE IF EXISTS player_yearly_statistics;

CREATE TABLE club (
  id INT NOT NULL AUTO_INCREMENT,
  name VARCHAR(100) NOT NULL,
  points INT(3) NOT NULL DEFAULT 0,
  wins INT(3) NOT NULL DEFAULT 0,
  losses INT(3) NOT NULL DEFAULT 0,
  goals_for INT(4) NOT NULL DEFAULT 0,
  goals_against INT(4) NOT NULL DEFAULT 0,
  home_points INT(3) NOT NULL DEFAULT 0,
  home_wins INT(3) NOT NULL DEFAULT 0,
  home_losses INT(3) NOT NULL DEFAULT 0,
  home_goals_for INT(4) NOT NULL DEFAULT 0,
  home_goals_against INT(4) NOT NULL DEFAULT 0,
  away_points INT(3) NOT NULL DEFAULT 0,
  away_wins INT(3) NOT NULL DEFAULT 0,
  away_losses INT(3) NOT NULL DEFAULT 0,
  away_goals_for INT(4) NOT NULL DEFAULT 0,
  away_goals_against INT(4) NOT NULL DEFAULT 0,
  goal_difference INT(4) NOT NULL DEFAULT 0,
  played INT(3) NOT NULL DEFAULT 0
  PRIMARY KEY (id)
);

CREATE TABLE player (
  id INT NOT NULL AUTO_INCREMENT,
  fpl_id INT NOT NULL DEFAULT -1,
  fpl_code INT NOT NULL DEFAULT -1,
  club_id INT NOT NULL,
  first_name VARCHAR(100) NOT NULL,
  last_name VARCHAR(100) NOT NULL,
  squad_number INT(3) DEFAULT -1,
  last_fixture_cost DECIMAL(4,1) DEFAULT -1,
  total_transfers_out INT(10) DEFAULT 0,
  last_fixture_transfers_out INT(10) DEFAULT 0,

  FOREIGN KEY (club_id) REFERENCES club(id)


);


CREATE TABLE fixture (


);

CREATE TABLE player_fixture (

);

CREATE TABLE player_yearly_statistics (

);
