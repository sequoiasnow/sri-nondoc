CUR_TIME = $(shell date)

all: newtables

mysql:
	php init/init.php

newtables:
	php init/newtables.php

alterations:
	php init/alter.php

install:
	sudo npm install

clean:
	rm -rf dist
	rm -rf node_modules

production:
	rm -rf node_modules
	rm -rf init

update:
	sudo git pull

push:
	git add .
	git commit -m 'Automated Push -- $(CUR_TIME)'
	git push
