include=app public resources storage database composer.json artisan tests bootstrap config

main:
	rsync --progress -r -t -avz --no-perms --exclude storage/framework --exclude storage/logs/ --exclude .htaccess $(include) mahmood@106.187.49.19:/opt/webapp/bbmeter

prod:
	rsync --progress -r -t -avz --no-perms --exclude storage/framework --exclude storage/logs/ --exclude .htaccess $(include) dibangladesh@106.187.49.19:public/bangladeshbarometer.org


migrate:
	cp .env .env.o
	cp .env.prod .env
	./artisan migrate
	mv .env.o .env

install:
	rsync --progress --delete -r -t -avz --no-perms app bootstrap config public resources storage vendor .env.example mahmood@106.187.49.19:/opt/webapp/bbmeter

