#!/bin/bash

rsync -azvr --exclude-from './exclude.txt' ./ jubby@johnstoncode.com:/var/www/antivibes
ssh jubby@johnstoncode.com "cd /var/www/antivibes && composer install"