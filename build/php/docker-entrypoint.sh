echo 'alias sf="php bin/console"' >> ~/.bashrc

sf doctrine:migrations:migrate -n
sf assets:install %PUBLIC_DIR%