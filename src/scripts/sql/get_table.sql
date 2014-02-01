SELECT o.* ,
(o.home_wins + o.away_wins) as win,
(o.away_loss + o.home_loss) as lose,
(o.home_draws + o.away_draws) as draw,
(3 * (o.home_wins + o.away_wins) + (o.home_draws + o. away_draws)) as points,
(o.home_draws + o.away_draws + o.home_wins + o.away_wins + o.home_loss + o.away_loss) as games
FROM (
SELECT
    SUM(CASE WHEN home_goals = away_goals AND home_team = %d THEN 1 ELSE 0 END) AS home_draws,
    SUM(CASE WHEN home_goals = away_goals AND away_team = %d THEN 1 ELSE 0 END) AS away_draws,
    SUM(CASE WHEN home_goals > away_goals AND home_team = %d THEN 1 ELSE 0 END) AS home_wins,
    SUM(CASE WHEN home_goals < away_goals AND away_team = %d THEN 1 ELSE 0 END) AS away_wins,
    SUM(CASE WHEN home_goals < away_goals AND home_team = %d THEN 1 ELSE 0 END) AS home_loss,
    SUM(CASE WHEN home_goals > away_goals AND away_team = %d THEN 1 ELSE 0 END) AS away_loss,
    club.name
FROM fixture join club on club.id = %d WHERE home_team = %d OR away_team = %d) as o;
