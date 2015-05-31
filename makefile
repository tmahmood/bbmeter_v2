include=app bootstrap config public vendor .env.example resources
options=--delete -r -t $(include) --no-perms --exclude=.htaccess

#--exclude=storage/logs/*.log --exclude=storage/app/* --exclude=storage/files/* --exclude=storage/framework/sessions/*

main:
	rsync -avz -zz --no-perms --delete -r -t app resources public storage

install:
	rsync --progress --delete -r -t -avz --no-perms app bootstrap config public resources storage vendor .env.example mahmood@106.187.49.19:/srv/http/bbmeter/





