select player.first_name, player.second_name, player.points_per_game, cost.now_cost, player_type.type
from player join player_cost as cost on cost.player_id = player.fpl_id
join player_type on player_type.id = player.type
join player_news on player_news.player_id = player.fpl_id
where player_news.status = "a" and player.points_per_game > 2
  and player.total_points >= 30 and (cost.now_cost/player.points_per_game < 2.2)
  and player_type.type = "Midfielder"
order by player_type.type desc, player.points_per_game desc, cost.now_cost asc;
