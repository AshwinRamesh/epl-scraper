select fixture.gameweek from fixture where fixture.played = 0 order by gameweek asc limit 1; -- get current gameweek

select fixture.*, c1.name as home, c2.name as away from fixture
    join club as c1 on c1.id = fixture.home_team
    join club as c2 on c2.id = fixture.away_team
    where gameweek = %d order by kickoff_time asc; -- need result from last query for this
