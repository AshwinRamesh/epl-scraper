#!/bin/bash

URL="http://cdn.ismfg.net/static/plfpl/img/shirts/shirt_";

for INT in {1..20};
do
	wget $URL"$INT.png";
done
