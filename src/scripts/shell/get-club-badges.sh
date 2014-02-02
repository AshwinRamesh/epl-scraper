#!/bin/bash

URL="http://cdn.ismfg.net/static/plfpl/img/badges/badge_";

for INT in {1..20};
do
	wget $URL"$INT.png";
done
